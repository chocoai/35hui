<?php
Yii::import('application.common.*');
require_once('image.php');
class ImageinfoController  extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
            array('allow',
                'actions'=>array("SaveHeadPic","uploadmoresourcepic","uploadmorepic","DeleatePanoramaImage","panoramauploadframe","deleateimage","uploadframe","pictureCut"),
				'users'=>array('@'),//所有注册用户都可使用
            ),
            array('allow',
                'actions'=>array("puserlogoupload"),
				'roles'=>array(Yii::app()->params['personal']),
            ),
            array('allow',
                'actions'=>array("uaphotoupload","uascardupload","uabcardupload","ualicenseupload"),
				'roles'=>array(Yii::app()->params['agent']),
            ),
            array('allow',
                'actions'=>array("ucrecogniseupload","uclogoupload"),
				'roles'=>array(Yii::app()->params['company']),
            ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    /**
     * 登记房源时删除照片
     */
    public function actionDeleateImage(){
        $delPic = $_POST['delPic'];
        $sourceType = $_POST['sourceType'];
        //删除上传的图片
        $standard = array();//处理规格配置
        if($sourceType=="office"){
            $standard = Officebaseinfo::$officePicNorm;//房源的配置
        }elseif($sourceType=="business"){
            $standard = Officebaseinfo::$businessPicNorm;//商务中心的配置
        }elseif($sourceType=="shop"){
            $standard = Officebaseinfo::$officePicNorm;//商铺的配置
        }
        Picture::model()->deleteFile(PIC_PATH.$delPic,$standard);//删除文件
        exit;
    }
    /**
     * 登记房源时上传照片
     */
	public function actionUploadFrame(){
        $this->layout='frame';
        $p_type=isset($_GET['p_type'])?$_GET['p_type']:0;
        $this->render('uploadframe',array(
            "type"=>$_GET['type'],
            'sourceType'=>$_GET['sourceType'],
            'p_type'=>$p_type,
        ));
    }
    public function actionUploadMoreSourcePic(){
        if (isset($_POST["PHPSESSID"])) {
            session_id($_POST["PHPSESSID"]);
        }
        $va = va();
        $va->check(array(
            'type'=>array('not_blank'),
            'sourceType'=>array('not_blank',array('eq','office','business','shop','residence'))//office代表是房源,business代表是商务中心,shop代表商铺
        ));
        if($va->success){
            $pictype = $va->valid['type'];
            $interpic = false;
            while(!empty($_FILES['Filedata']['size'])){
                $_imgsize = getimagesize($_FILES['Filedata']['tmp_name']);
                if(is_array($_imgsize) && count($_imgsize)>3){
                    if($_imgsize[0]<200 || $_imgsize[1]<200)//图片小于200*200
                        break;
                    if(max($_imgsize[0],$_imgsize[1])/min($_imgsize[0],$_imgsize[1])>2)//长短边比值超过2:1
                        break;
                }else
                    break;
                if($_FILES['Filedata']['size']>3145728 || $_FILES['Filedata']['size']<20480 )//图片大小限定 20KB~3MB
                    break;
                
                $interpic=true;
                break;
            }
            if ($interpic){
                $path = Picture::model()->picTypePath($pictype);//得到图片类型路径
                $originfilename = strtolower($_FILES['Filedata']['name']); //文件名
                $fileext = strtolower(substr($originfilename,strrpos($originfilename,'.'))); //后缀名
                //验证文件格式是否正确
                $patn = "/jpg$|jpeg$|gif$|png$/i";

                if(preg_match($patn,$fileext)){
                    $fileName = Picture::model()->imageName($originfilename,$path);//包含了路径的新的文件名称
                    $targetFile =  PIC_PATH.$fileName;
                    $tempFile = $_FILES['Filedata']['tmp_name'];
             
                    $boolUploadFile = move_uploaded_file($tempFile,$targetFile);

                    if($boolUploadFile){
                        $standard = null;//处理规格配置
                        if($va->valid['sourceType']=="office"){
                            $standard = Officebaseinfo::$officePicNorm;//房源的配置
                        }elseif($va->valid['sourceType']=="business"){
                            $standard = Officebaseinfo::$businessPicNorm;//商务中心的配置
                        }elseif($va->valid['sourceType']=="shop"){
                            $standard = Officebaseinfo::$officePicNorm;//商铺的配置
                        }else{
                            $standard = Officebaseinfo::$officePicNorm;//住宅的配置
                        }
      
                        if($standard){
                            //处理缩略图
                            $imageDeal = new Image();
                            $result = $imageDeal->formatWithPicture($targetFile,$standard,true);//处理缩略图
                        }
                        if(isset($_POST['oneUpload'])&&$_POST['oneUpload']==1){//单张上传
                            echo '<script type="text/javascript">parent.uploadOnePicSuccess("'.PIC_URL.$fileName.'")</script>';exit;
                        }else{
                            echo PIC_URL.$fileName;exit;
                        }
                    }
                }
            }else{//图片太大，只有在上传单张图片的时候才提示错误
                if(isset($_POST['oneUpload'])&&$_POST['oneUpload']==1){//单张上传
                    echo '<script type="text/javascript">parent.uploadOnePicFalse()</script>';exit;
                }
            }
        }
        exit;
    }

    /**
     * 上传多张图片。可以在用户上传全景图片时使用
     */
    function actionUploadMorePic(){
        if (isset($_POST["PHPSESSID"])) {
            session_id($_POST["PHPSESSID"]);
        }
        $this->layout='frame';
        $basedir = "/subpanorama/";
        $tmp = intval($_POST['dir']);
        if($tmp!=""&&$tmp>time()){//判断一下从post中得到的值是否被恶意修改过。
            $filedir = $_POST['dir'];
        }else{
            $this->redirect(array('main/error'));
        }

        $path = $basedir.$filedir."/";

        if (!empty($_FILES)&&$_FILES['Filedata']['size']<4194304){//最大4M
            $originfilename = $_FILES['Filedata']['name']; //文件名
            $fileext = strtolower(substr($originfilename,strrpos($originfilename,'.'))); //后缀名
            //验证文件格式是否正确
            $patn = "/jpg$|jpeg$|gif$|png$/i";
            if(preg_match($patn,$fileext)){
                if(!is_dir(PIC_PATH.$path)){
                    mkdir(PIC_PATH.$path);
                }
                $fileName = Picture::model()->imageName($originfilename,$path);//包含了路径的新的文件名称
                $targetFile =  PIC_PATH.$fileName;
                $tempFile = $_FILES['Filedata']['tmp_name'];
                move_uploaded_file($tempFile,$targetFile);
                //处理缩略图
                $imageDeal = new Image();
                if($imageDeal->formatWithPicture($targetFile,Subpanorama::$standard,false,false)){
                    //完成之后要显示缩略图
                    $fileName = str_replace(".",Subpanorama::$standard[1]['suffix'].".",$fileName);
                }
                
                if(isset($_POST['oneUpload'])&&$_POST['oneUpload']==1){//单张上传
                    echo '<script type="text/javascript">parent.uploadOnePicSuccess("'.PIC_URL.$fileName.'")</script>';exit;
                }else{
                    echo PIC_URL.$fileName;exit;
                }
            }
        }else{//图片太大，只有在上传单张图片的时候才提示错误
            if(isset($_POST['oneUpload'])&&$_POST['oneUpload']==1){//单张上传
                echo '<script type="text/javascript">parent.uploadOnePicFalse()</script>';exit;
            }
        }
    }
    public function actionDeleatePanoramaImage(){
        $delPic = $_POST['delPic'];
        if($delPic!=""){
            $delPic = str_replace(PIC_URL, "", $delPic);
            $delPic = str_replace(Subpanorama::$standard[1]["suffix"], "", $delPic);
            //删除上传的图片
            Picture::model()->deleteFile(PIC_PATH.$delPic, Subpanorama::$standard);//删除文件
        }
        exit;
    }
   
    
    public function actionSaveHeadPic(){
        $userId = Yii::app()->user->id;
        $filename = time().".jpg";
        switch(User::model()->getCurrentRole()) {
            case User::personal :
                $picTypePath = "/puser/";
                $model = Unormal::model()->findByAttributes(array("puser_uid"=>$userId));
                $oldPic = $model->puser_logopath;
                $filedName = "puser_logopath";
                $model->puser_logoaudit =0;
                break;
            case User::agent :
                $picTypePath = "/ua/";
                $model = Uagent::model()->findByAttributes(array("ua_uid"=>$userId));
                $oldPic = $model->ua_photourl;
                $filedName = "ua_photourl";
                $model->ua_photoaudit =0;
                break;
            default:
                $this->redirect(array('main/error'));
                break;
        }
        
        $fileDir = $picTypePath.Yii::app()->user->name;
        if(!is_dir(PIC_PATH.$fileDir)){
            mkdir(PIC_PATH.$fileDir);
        }
        $filePath = PIC_PATH.$fileDir."/".$filename;//文件目录
        $model[$filedName] = $fileDir."/".$filename;

        if (isset($GLOBALS["HTTP_RAW_POST_DATA"])){
            $jpg = $GLOBALS["HTTP_RAW_POST_DATA"];
            header("Content-Type: image/jpeg");
            $file = fopen($filePath,"w");//打开文件准备写入
            fwrite($file,$jpg);//写入
            fclose($file);//关闭
        }
        $model->save();
        @unlink(PIC_PATH.$oldPic);
        echo "success";
        exit;
    }
}