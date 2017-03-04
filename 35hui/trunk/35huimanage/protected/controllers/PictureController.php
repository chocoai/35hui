<?php
Yii::import('application.common.*');
require_once('image.php');
class PictureController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

      //根据数据类型,返回相对的上一级的目录导航
    protected  function getPicTypeNav($sourceType){
        $navArray = array();
        if($sourceType==Picture::$sourceType['systembuilding']){
            $navArray = array('title'=>'楼盘图片管理','value'=>array('buildingIndex'));
        }elseif($sourceType==Picture::$sourceType['officebaseinfo']){
            $navArray = array('title'=>'写字楼图片管理','value'=>array('officeIndex'));
        }elseif($sourceType==Picture::$sourceType['businesscenter']){
            $navArray = array('title'=>'商务中心图片管理','value'=>array('businessIndex'));
        }
        return $navArray;
    }
    public function actionSourceView(){
        $va = va();
        $va->check(array(
            'sId'=>array('not_blank','uint'),
            'sType'=>array('not_blank','uint')
        ));
        $headpic = "";
        if($va->success){
            $sourceid = $va->valid['sId'];
            switch($va->valid['sType']){
                case 1: //楼盘
                    $sourceModel = Systembuildinginfo::model()->findByPk($sourceid);
                    $headpic = $sourceModel->sbi_titlepic;
                    $sourceName = $sourceModel->sbi_buildingname;
                    break;
                case 2://写字楼、
                    $sourceModel = Officepresentinfo::model()->findByAttributes(array("op_officeid"=>$sourceid));
                    $headpic = $sourceModel->op_titlepicurl;
                    $sourceName = $sourceModel->op_officetitle;
                    break;
                case 3: //商务中心
                    $sourceModel = Businesscenter::model()->findByPk($sourceid);
                    $headpic = $sourceModel->bc_titlepic;
                    $sourceName = $sourceModel->bc_name;
                    break;
                case 5: //商铺
                    $sourceModel = Shoppresentinfo::model()->findByAttributes(array("sp_shopid"=>$sourceid));
                    $headpic = $sourceModel->sp_titlepicurl;
                    $sourceName = $sourceModel->sp_shoptitle;
                    break;
                case 7: //小区
                    $sourceModel = Communitybaseinfo::model()->findByAttributes(array("comy_id"=>$sourceid));
                    $headpic = $sourceModel->comy_titlepic;
                    $sourceName = $sourceModel->comy_name;
                    break;
                case 8: //小区
                    $sourceModel = Residencebaseinfo::model()->findByAttributes(array("rbi_id"=>$sourceid));
                    $headpic = $sourceModel->rbi_titlepicurl;
                    $sourceName = $sourceModel->rbi_title;
                    break;
                case 9: //创意园区楼盘
                    $sourceModel = Creativeparkbaseinfo::model()->findByPk($sourceid);
                    $headpic = $sourceModel->cp_titlepic;
                    $sourceName = $sourceModel->cp_name;
                    break;
            }
            $pictures = Picture::model()->getFormatPicturesByCondition($va->valid['sId'], $va->valid['sType']);
            $this->render('sourceView',array(
                    'sourceName'=>$sourceName,
                    'headpic'=>$headpic,
                    'pictures'=>$pictures,
                    'sId'=>$va->valid['sId'],
                    'sType'=>$va->valid['sType']
            ));
        }else{
            throw new CHttpException(404,'The action of SourceView require "sid" and "stype" parameter.');
        }
    }
    public function actionSetTitle(){
        $sourceid = $_POST['sourceid'];
        $picid = $_POST['picid'];
        $picModel = Picture::model()->findByPk($picid);
        if($picModel){
            //通过判断资源类型，得到要去设置哪个表的标题图
            $p_sourcetype = $picModel->p_sourcetype;
            switch($p_sourcetype){
                case 1: //楼盘
                    $sourceModel = Systembuildinginfo::model()->findByPk($sourceid);
                    $sourceModel->sbi_titlepic = $picid;
                    $sourceModel->save();
                    break;
                case 2://写字楼、
                    $sourceModel = Officepresentinfo::model()->findByAttributes(array("op_officeid"=>$sourceid));
                    $sourceModel->op_titlepicurl = $picid;
                    $sourceModel->save();
                    break;
                case 3: //商务中心
                    $sourceModel = Businesscenter::model()->findByPk(array($sourceid));
                    $sourceModel->bc_titlepic = $picid;
                    $sourceModel->save();
                    break;
                case 5: //商铺
                    $sourceModel = Shoppresentinfo::model()->findByAttributes(array("sp_shopid"=>$sourceid));
                    $sourceModel->sp_titlepicurl = $picid;
                    $sourceModel->save();
                    break;
                case 7: //小区
                    $sourceModel = Communitybaseinfo::model()->findByAttributes(array("comy_id"=>$sourceid));
                    $sourceModel->comy_titlepic = $picid;
                    $sourceModel->save();
                    break;
                case 9: //创意园区
                    $sourceModel = Creativeparkbaseinfo::model()->findByPk($sourceid);
                    $sourceModel->cp_titlepic = $picid;
                    $sourceModel->save();
                    break;
            }
        }
        exit;
    }
    /**
     * 登记房源时删除照片
     */
    public function actionDeleateImage(){
        $filenamestr = $_POST['filenamestr'];
        $delPic = $_POST['delPic'];
        $sourceType = $_POST['sourceType'];
        if($delPic!=""&&$filenamestr!=""){
            $filenamearr = explode("|",$filenamestr);
            $key = array_search($delPic,$filenamearr);
            unset ($filenamearr[$key]);
            //删除上传的图片
            $standard = array();//处理规格配置
            if($sourceType=="office"){
                $standard = Officebaseinfo::$officePicNorm;//房源的配置
            }elseif($sourceType=="business"){
                $standard = Businesscenter::$pictureNorm;//商务中心的配置
            }elseif($va->valid['sourceType']=="shop"){
                $standard = Officebaseinfo::$officePictureNorm;//商铺的配置
            }
            Picture::model()->deleteFile(PIC_PATH.$delPic,$standard);//删除文件
            $filenamestr = implode("|", $filenamearr);
            echo json_encode(array($key-1,$filenamestr));
        }
        exit;
    }
    /**
     * 登记房源时上传照片
     */
	public function actionUploadFrame(){
        $this->layout='frame';
        $this->render('uploadframe',array(
            "type"=>$_GET['type'],
            'sourceType'=>$_GET['sourceType'],
        ));
    }
    public function actionUploadMoreSourcePic(){
        if (isset($_POST["PHPSESSID"])) {
            session_id($_POST["PHPSESSID"]);
        }
        $va = va();
        $va->check(array(
            'type'=>array('not_blank'),
            'sourceType'=>array('not_blank',array('eq','office','business','shop'))//office代表是房源,business代表是商务中心,shop代表商铺
        ));
        if($va->success){
            $pictype = $va->valid['type'];
            if (!empty($_FILES)&&$_FILES['Filedata']['size']<2097152){//最大2M
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
                            $standard = Businesscenter::$pictureNorm;//商务中心的配置
                        }elseif($va->valid['sourceType']=="shop"){
                            $standard = Officebaseinfo::$officePictureNorm;//商铺的配置
                        }
                        if($standard){
                            //处理缩略图
                            $imageDeal = new Image();
                            $result = $imageDeal->formatWithPicture($targetFile,$standard);//处理缩略图
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	
    public function actionUploadPic(){
        $va = va();
        $va->check(array(
            'sId'=>array('not_blank','uint'),
            'sType'=>array('not_blank','uint'),
        ));
       
        if($va->valid['sType']){
            if(isset($_POST['pic'])&&$_POST['pic']) {
                foreach($_POST['pic'] as $key=>$value){
                    foreach($value as $k=>$v){
                        $url = str_replace(PIC_URL, "", $v);
                        $model = new Picture();
                        $dba = dba();
                        $model->p_id = $dba->id('35_picture');
                        $model->p_sourceid = $va->valid['sId'];
                        $model->p_type = $key;
                        $model->p_sourcetype = $va->valid['sType'];
                        $model->p_img = $url;
                        $model->p_tinyimg = $url;
                        $model->p_uploadtime = time();
                        $model->p_title = @$_POST['title'][$key][$k]=="标题"?"":$_POST['title'][$key][$k];
                        $model->save();
                    }
                }
                Yii::app()->user->setFlash('uploadImage','图片上传成功');
                $this->redirect(array('sourceView','sId'=>$model->p_sourceid,'sType'=>$model->p_sourcetype));
            }
            $this->render("uploadPic");
        }else{//必须传入房源类型
            Yii::app()->DRedirect->redirect(Yii::app()->getRequest()->getUrlReferrer(),'访问错误!');
        }
    }
        
    public function actionGetMarkPic(){
        function remove_directory($dir) {
          if ($handle = opendir("$dir")) {
           while (false !== ($item = readdir($handle))) {
             if ($item != "." && $item != "..") {
               if (is_dir("$dir/$item")) {
                 remove_directory("$dir/$item");
               } else {
                 unlink("$dir/$item");
               }
             }
           }
           closedir($handle);
           rmdir($dir);
          }
        }
        if(isset($_GET["delete"])&&$_GET["delete"]){
            @remove_directory(PIC_PATH."/subpanorama/download");
            mkdir(PIC_PATH."/subpanorama/download");
            $this->redirect(array("picture/getmarkpic"));
            exit;
        }
        $this->render("getMarkPic");
    }
    public function actionpicsDownload() {
        $id = $_GET['id'];
        if($id&&$id!="all"){
            $dir=PIC_PATH."/subpanorama/download/".$id;
        }else{
            $dir=PIC_PATH."/subpanorama/download/";
        }
        $zip = new PHPZip();
        $zip->downloadZip($dir, $id.'.rar');
        
        
    }
    public function actionUploadMoreBuildPic1(){
        if (isset($_POST["PHPSESSID"])) {
            session_id($_POST["PHPSESSID"]);
        }
        $picType = $_POST["picType"];
        $sourceType = $_POST["sourceType"];

        $picTypePath = "/subpanorama/download/".$sourceType."/";//得到图片类型路径
        if(!is_dir(PIC_PATH.$picTypePath)){
            mkdir(PIC_PATH.$picTypePath);
        }
        $fileName = Picture::model()->imageName($_FILES['Filedata']['name'],$picTypePath);//得到最新生成的图片名称

        $targetFile =  PIC_PATH.$fileName;

        $tempFile = $_FILES['Filedata']['tmp_name'];
        $boolUploadFile = move_uploaded_file($tempFile,$targetFile);

        if($boolUploadFile){
             $standard = Systembuildinginfo::$pictureNorm;
            
            if($standard){
                //处理缩略图
                $imageDeal = new Image();
                $src=$targetFile;
                $sizeArr=getimagesize($src);
                $marksrc = '/images/sc_mark.png';
                $markSizeArr=getimagesize($_SERVER['DOCUMENT_ROOT'].$marksrc);
                if($markSizeArr[0]<$sizeArr[0]&&$markSizeArr[1]<$sizeArr[1]){
                    $imageDeal->mark($src,$_SERVER['DOCUMENT_ROOT'].$marksrc,$src);//$newImgName
                }

            }

            echo PIC_URL.$fileName;exit;
        }
        exit;
    }
    public function actionDeleteBuildPic(){
        $delPic = $_POST["delPic"];//格式如http://35upload.my360dibiao.com/test/2011/1207/132323553692.jpg
        $delPic = str_replace(PIC_URL, "", $delPic);
        $sourceType = $_POST["sourceType"];
        //删除上传的图片
        $standard = array();//处理规格配置
        if($sourceType==Picture::$sourceType['systembuilding']){//楼盘
            $standard = Systembuildinginfo::$pictureNorm;
        }elseif($sourceType==Picture::$sourceType['officebaseinfo']){//写字楼房源
            $standard = Officebaseinfo::$officePicNorm;
        }elseif($sourceType==Picture::$sourceType['businesscenter']){//商务中心
            $standard = Businesscenter::$pictureNorm;
        }elseif($sourceType==Picture::$sourceType['communitybaseinfo']){//小区
            $standard = Communitybaseinfo::$pictureNorm;
        }elseif($sourceType==Picture::$sourceType['residencebaseinfo']){
            $standard = Residencebaseinfo::$pictureNorm;
        }elseif($sourceType==Picture::$sourceType['cyparkbaseinfo']){
            $standard = Creativeparkbaseinfo::$pictureNorm;
        }
        Picture::model()->deleteFile(PIC_PATH.$delPic,$standard);//删除文件
    }
    /**
     * 楼盘多张上传
     */
    public function actionUploadMoreBuildPic(){
        if (isset($_POST["PHPSESSID"])) {
            session_id($_POST["PHPSESSID"]);
        }
        $picType = $_POST["picType"];
        $sourceType = $_POST["sourceType"];
        
        $picTypePath = Picture::model()->picTypePath($picType);//得到图片类型路径
        
        $fileName = Picture::model()->imageName($_FILES['Filedata']['name'],$picTypePath);//得到最新生成的图片名称

        $targetFile =  PIC_PATH.$fileName;
        
        $tempFile = $_FILES['Filedata']['tmp_name'];
        $boolUploadFile = move_uploaded_file($tempFile,$targetFile);
        
        if($boolUploadFile){
            if($sourceType==Picture::$sourceType['systembuilding']){//楼盘
                $standard = Systembuildinginfo::$pictureNorm;
            }elseif($sourceType==Picture::$sourceType['officebaseinfo']){//写字楼房源
                $standard = Officebaseinfo::$officePicNorm;
            }elseif($sourceType==Picture::$sourceType['businesscenter']){//商务中心
                $standard = Businesscenter::$pictureNorm;
            }elseif($sourceType==Picture::$sourceType['communitybaseinfo']){//小区
                $standard = Communitybaseinfo::$pictureNorm;
            }elseif($sourceType==Picture::$sourceType['residencebaseinfo']){
                $standard = Residencebaseinfo::$pictureNorm;
            }elseif($sourceType==Picture::$sourceType['cyparkbaseinfo']){
                $standard = Creativeparkbaseinfo::$pictureNorm;
            }
            if($standard){
                //处理缩略图
                $imageDeal = new Image();
                $src=$targetFile;
                $result = $imageDeal->formatWithPicture($src,$standard,true);//处理缩略图
            }
            
            echo PIC_URL.$fileName;exit;
        }
        exit;
    }
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
        $model = $this->loadModel();
        $norm = array();
        if($model->p_sourcetype==Picture::$sourceType['systembuilding']){
            $norm = Systembuildinginfo::$pictureNorm;
        }elseif($model->p_sourcetype==Picture::$sourceType['officebaseinfo']){
            $norm = Officebaseinfo::$officePicNorm;
        }elseif($model->p_sourcetype==Picture::$sourceType['businesscenter']){
            $norm = Businesscenter::$pictureNorm;
        }elseif($model->p_sourcetype==Picture::$sourceType['communitybaseinfo']){
            $norm = Communitybaseinfo::$pictureNorm;
        }elseif($model->p_sourcetype==Picture::$sourceType['cyparkbaseinfo']){
            $norm = Creativeparkbaseinfo::$pictureNorm;
        }
        if($model->delete()){//删数据库记录 Creativeparkbaseinfo
            Picture::model()->deleteFile(PIC_PATH.$model->p_img,$norm);//删除文件
        }
        exit;
	}

    /**
     * 
     */
    public function actionIndex(){
        $sourceType=isset($_POST['sourceType'])?$_POST['sourceType']:(isset($_GET['sourceType'])?$_GET['sourceType']:'');
        $sourceid=isset($_POST['sourceid'])?trim($_POST['sourceid']):(isset($_GET['sourceid'])?trim($_GET['sourceid']):'');
        $criteria = new CDbCriteria;
        $criteria->condition='`p_check`=0 AND `p_quote`=0 AND `p_sourcetype` IN(2,5,8,10)';
        $criteria->order='p_id DESC';
        if($sourceType){
            $criteria->condition='`p_check`=0 AND `p_quote`=0 AND `p_sourcetype` ='.$sourceType;
            $_GET['sourceType']=$sourceType;
        }
        if($sourceid){
            $criteria->addInCondition('p_sourceid',explode(',', $sourceid));
            $_GET['sourceid']=$sourceid;
        }
		$dataProvider=new CActiveDataProvider('Picture',array(
            'criteria'=>$criteria,
        ));
        $_render=Yii::app()->request->isAjaxRequest?'renderPartial':'render';
		$this->$_render('index',array(
			'dataProvider'=>$dataProvider,
            'sourceid'=>$sourceid,
            'sourceType'=>$sourceType,
		));
    }
    public function actionPiccheck(){
        if(Yii::app()->request->isAjaxRequest){
            $id=$_POST['id'];//通过
            $id2=$_POST['id2'];//未通过
            $connection = Yii::app()->db;
            if($id){
                $connection->createCommand("UPDATE {{picture}} SET `p_check`=1 WHERE `p_id` IN(".$id.")")->execute();
            }
            if($id2){//未通过
                $_delete=array();
                $pictures=$connection->createCommand("SELECT * FROM {{picture}} WHERE `p_id` IN(".$id2.")")->queryAll();
                $connection->createCommand("DELETE FROM {{picture}} WHERE `p_id` IN(".$id2.")")->execute();
                foreach($pictures as $pic){
                    $_delete[$pic['p_sourcetype']][]=$pic['p_id'];
                    if($pic['p_sourcetype']==Picture::$sourceType['communitybaseinfo']) {
                        $norm = Communitybaseinfo::$pictureNorm;
                    }elseif($pic['p_sourcetype']==Picture::$sourceType['systembuilding']) {
                        $norm = Systembuildinginfo::$pictureNorm;
                    }elseif($pic['p_sourcetype']==Picture::$sourceType['businesscenter']) {
                        $norm = Businesscenter::$pictureNorm;
                    }else{
                        $norm = Officebaseinfo::$officePicNorm;
                    }
                    Picture::model()->deleteFile(PIC_PATH.$pic['p_img'],$norm);//删除文件
                }
                Picture::model()->sendPicDelMsg($_delete);
            }
            echo 'ok';
        }
    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Picture('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Picture']))
			$model->attributes=$_GET['Picture'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
         

        /**
         * 设为精品
         */
        public function actionRevertBuild(){
            
            $model = $this->loadModel();
            $modelPicture=new Picture;
            if(isset($_POST['Picture']['p_type'])&&$_POST['Picture']['p_type']!=''){
                $userId = 0;
              
                if($model->p_sourcetype == 2){//写字楼
                     //赠送积分和商务币
                    $officeModel = Officebaseinfo::model()->findByPk($model->p_sourceid);

                    if($officeModel->ob_sysid){
                        $path=Picture::picTypePath($_POST['Picture']['p_type']);
                        $userId=$officeModel->ob_uid;
                        $modelPicture->p_sourceid=$officeModel->ob_sysid;
                        $modelPicture->p_sourcetype=1;
                        $fileName = $path.Picture::model()->imageName($model->p_img);
                        foreach(Systembuildinginfo::$pictureNorm as $val){
                            $oldName=str_replace(".",$val["suffix"].".",$model->p_img);
                            $newName=str_replace(".",$val["suffix"].".",$fileName);
                            copy(PIC_PATH.$oldName,PIC_PATH.$newName);
                        }
                        copy(PIC_PATH.$model->p_img,PIC_PATH.$fileName);
                        $model->p_img=$fileName;
                        if(isset($_POST['Picture']['p_title'])&&$_POST['Picture']['p_title']){
                        $model->p_title=$_POST['Picture']['p_title'];
                        }
                    }
                }elseif($model->p_sourcetype == 10){//创意园
                     //赠送积分和商务币
                    $creativesourceModel = Creativesource::model()->findByPk($model->p_sourceid);

                    if($creativesourceModel->cr_cpid){
                        $path=Picture::picTypePath($_POST['Picture']['p_type']);
                        $userId=$creativesourceModel->cr_userid;
                        $modelPicture->p_sourceid=$creativesourceModel->cr_cpid;
                        $modelPicture->p_sourcetype=9;
                        $fileName = $path.Picture::model()->imageName($model->p_img);
                        foreach(Systembuildinginfo::$pictureNorm as $val){
                            $oldName=str_replace(".",$val["suffix"].".",$model->p_img);
                            $newName=str_replace(".",$val["suffix"].".",$fileName);
                            copy(PIC_PATH.$oldName,PIC_PATH.$newName);
                        }
                        copy(PIC_PATH.$model->p_img,PIC_PATH.$fileName);
                        $model->p_img=$fileName;
                        if(isset($_POST['Picture']['p_title'])&&$_POST['Picture']['p_title']){
                        $model->p_title=$_POST['Picture']['p_title'];
                        }
                    }
                } else if($model->p_sourcetype == 5){//商铺
                     //赠送积分和商务币
                    $shopModel = Shopbaseinfo::model()->findByPk($model->p_sourceid);
                    if($shopModel->sb_sysid){
                        $userId=$shopModel->sb_uid;
                        $modelPicture->p_sourceid=$shopModel->sb_sysid;
                        $modelPicture->p_sourcetype=1;
                    }
                }else{//住宅
                    //赠送积分和商务币
                    $residenceModel = Residencebaseinfo::model()->findByPk($model->p_sourceid);
                    $userId=$residenceModel->rbi_uid;
                    $modelPicture->p_sourceid=$residenceModel->rbi_communityid;
                    $modelPicture->p_sourcetype=7;
                }
                if($userId){
                    $dba = dba();
                    $modelPicture->p_id = $dba->id('35_picture');
                    $modelPicture->p_type=$_POST['Picture']['p_type'];
                    $modelPicture->p_title=$model->p_title;
                    $modelPicture->p_img=$model->p_img;
                    $modelPicture->p_tinyimg=$model->p_tinyimg;
                    $modelPicture->p_uploadtime=time();
                    $modelPicture->save();
                    $config=Oprationconfig::model()->getConfigByName('picture_attach','0');
                    $description = "成功设为精品，奖励{:money}商务币";
                    Userproperty::model()->addMoney($userId, $config, $description);
                    $config=Oprationconfig::model()->getConfigByName('picture_attach','1');
                    $description = "成功设为精品，奖励{:point}积分";
                    Userproperty::model()->addPoint($userId, $config, $description);
                }
                if($model->p_sourcetype==2||$model->p_sourcetype==10){
                    $this->redirect(array("sourceView",'sId'=>$modelPicture->p_sourceid,'sType'=>$modelPicture->p_sourcetype));
                }else{
                $this->redirect(array("sourceView",'sId'=>$model->p_sourceid,'sType'=>$model->p_sourcetype));
                }
            }
            $this->render('revertBuild',array(
                "model"=>$model,
            ));
        }

         /**
         * 设为精品
         */
        public function actionShowPic(){
            $model = $this->loadModel();
            $this->render('showPic',array(
                "model"=>$model,
            ));
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Picture::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='picture-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
