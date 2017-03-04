<?php

class AlbumphotoController extends Controller
{
	private $_model;
    public $layout="album";
    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'roles'=>array(
                    User::ROLE_MEMBER
                ),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    public function actionUploadphoto(){
        $albumsId = isset($_GET["id"])&&$_GET["id"]?$_GET["id"]:"";
        $albums = Album::model()->findAllByAttributes(array("am_userid"=>User::model()->getId()));
        $this->render('uploadphoto',
            array(
                "albums"=>$albums,
                "albumsId"=>$albumsId,
            )
        );
    }
    public function actionUpload(){
        if (isset($_POST["PHPSESSID"])) {
            session_id($_POST["PHPSESSID"]);
        }
        $path = "/albumphoto/".date("Y");
        if(!is_dir(PIC_PATH.$path)){
            mkdir(PIC_PATH.$path);
        }
        $path = $path."/".date("md");
        if(!is_dir(PIC_PATH.$path)){
            mkdir(PIC_PATH.$path);
        }
        
        $fileName = $path."/".time().rand(100,999).".jpg";
        $targetFile =  PIC_PATH.$fileName;
        $tempFile = $_FILES['Filedata']['tmp_name'];

        $boolUploadFile = move_uploaded_file($tempFile,$targetFile);

        //处理缩略图
        $imageDeal = new Image();
        $imageDeal->formatWithPicture($targetFile,Albumphoto::$photoSize,false);//处理缩略图
        $fileName = Albumphoto::model()->getStaticPhotoUrl($fileName, "_230x250");
        echo "FILEID:/upload".$fileName;exit;
    }
    public function actionCheckSave(){
        $amId = $_POST["amId"];
        $picNum = $_POST["picNum"];
        $msg = Albumphoto::model()->checkCanSavePhoto($amId, $picNum);
        echo json_encode($msg);exit;
    }
    public function actionSave(){
        if(isset($_POST["img"])&&$_POST["img"]){
            $album  = $_POST["album"];
            $beginOrder = 0;
            $picNum = count($_POST["img"]);
            //判断相册是否还能继续上传图片
            $msg = Albumphoto::model()->checkCanSavePhoto($album, $picNum);
            if($msg[0]!="success"){
                throw new CHttpException(404,'The requested page does not exist.');
            }
            //获取最大的order
            $criteria=new CDbCriteria;
            $criteria->select="max(ap_order) as ap_order";
            $criteria->addColumnCondition(array("ap_amid"=>$album));
            $albumphoto = Albumphoto::model()->find($criteria);
            if($albumphoto){
                $beginOrder = $albumphoto->ap_order;
            }
            $photoIdArr = array();//照片id
            foreach ($_POST["img"] as $key=>$value){
                $photo = new Albumphoto();
                $photo->ap_url = str_replace("_230x250", "", $value);
                $photo->ap_amid = $album;//相册id
                $photo->ap_audit = 1;//用户id
                $photo->ap_order = $key+1+$beginOrder;
                $photo->ap_createtime = time();
                $photo->save();
                $photoIdArr[] = $photo->ap_id;
            }
            $uploadPhotoNum = $key+1;
            $albumModel = Album::model()->findByPk($album);
            $albumModel->am_photonum = $albumModel->am_photonum+$uploadPhotoNum;
            $albumModel->update();

            //添加上传图片动态
            $dynamicContent  = Dynamicuser::model()->formartContentType_2($album,$photoIdArr);
            Dynamicuser::model()->addDynamic(2, $dynamicContent);
        }
        $this->redirect(array("album/index"));
    }
    public function actionView(){
        $photoModel = $this->loadModel();
        $albumModel = Album::model()->findByPk($photoModel->ap_amid);
        if($albumModel&&Album::model()->checkAlbumBelongCurrentUser($albumModel)){
            //获取上一张和下一张
            $criteria=new CDbCriteria;
            $criteria->addColumnCondition(array("ap_amid"=>$photoModel->ap_amid));
            $criteria->order = "ap_order";
            $albumphoto = Albumphoto::model()->findAll($criteria);
            $prevId = $nextId = $nowNum = 0;
            foreach($albumphoto as $key=>$value){
                if($value->ap_id==$photoModel->ap_id){//当前的图片
                    $nowNum = $key+1;
                    $prevId = isset($albumphoto[$key-1])?$albumphoto[$key-1]["ap_id"]:$albumphoto[count($albumphoto)-1]["ap_id"];
                    $nextId = isset($albumphoto[$key+1])?$albumphoto[$key+1]["ap_id"]:$albumphoto[0]["ap_id"];
                }
            }
            $this->render('view',
                array(
                    "nowNum"=>$nowNum,
                    "photoModel"=>$photoModel,
                    "albumModel"=>$albumModel,
                    "albumphoto"=>$albumphoto,
                    "prevId"=>$prevId,
                    "nextId"=>$nextId,
                )
            );
        }else{
            $this->redirect(array("/my"));
        }
    }
    public function actionDelalbumphoto(){
        $_GET["id"] = $_POST["id"];
        $photoModel = $this->loadModel();
        $albumModel = Album::model()->findByPk($photoModel->ap_amid);
        if($albumModel&&Album::model()->checkAlbumBelongCurrentUser($albumModel)){
            //删除文件
            Albumphoto::model()->delImg($photoModel->ap_url);
            //删除记录
            $photoModel->delete();
            //相册照片数目减一
            $albumModel->am_photonum = $albumModel->am_photonum-1;
            $albumModel->update();
            echo $photoModel->ap_amid;exit;
        }
        echo "error";exit;
    }
    public function actionDelTmpPhoto(){
        $url = $_POST["url"];
        $url = str_replace("_230x250", "", $url);
        //删除的时候进行简单的判断，只允许删除当天文件夹中的，免得误删除
        $dir = date("Y")."/".date("md");
        if(stripos($url, $dir)!==false){
            //删除文件
            Albumphoto::model()->delImg($url);
        }
        echo "success";exit;
    }
    public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Albumphoto::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
}