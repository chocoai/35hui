<?php
class InfoController extends Controller {
    public function filters() {
        return array(
                'accessControl', // perform access control for CRUD operations
        );
    }
    public function accessRules() {
        return array(
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                        "actions"=>array("memberbase","memberjob"),
                        'roles'=>array(
                                User::ROLE_MEMBER,
                        ),
                ),
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                        "actions"=>array(),
                        'roles'=>array(
                                User::ROLE_AUDIENCE
                        ),
                ),
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                        "actions"=>array("index","password","photo","upload","savephoto"),
                        'roles'=>array(
                                User::ROLE_MEMBER,
                                User::ROLE_AUDIENCE
                        ),
                ),
                array('deny',  // deny all users
                        'users'=>array('*'),
                ),
        );
    }
    public function actionIndex(){
        $role = User::model()->getRole();
        if($role==User::ROLE_MEMBER){
            $this->redirect("info/memberbase");
        }else{
            $this->redirect("info/audiencebase");
        }
    }
    /**
     * model基础信息
     */
    public function actionMemberbase() {
        $model = new InfoMemberBaseForm();
        $district = Region::model()->getAllGroupList();
        $section = array();
        if($model->u_district){
            $section = Region::model()->getAllGroupList($model->u_district);
        }
        if(isset($_POST['InfoMemberBaseForm'])){
            if($model->update()){
                Yii::app()->user->setFlash('message','OK');
                $this->redirect(array('memberbase'));
            }
        }
        $this->render('memberbase',array(
            'model'=>$model,
            "district"=>$district,
            "section"=>$section
        ));
    }
    /**
     * 工作
     */
    public function actionMemberjob() {
        $model = new InfoMemberJobForm();
        $district = Region::model()->getAllGroupList();
        $companyname = array();
        if($model->mem_company){
            $comModel = Companymanage::model()->findByPk($model->mem_company);
            if($comModel){
                $companyname = Companymanage::model()->getAllCompanyList($comModel->cm_district);
            }
        }
        if(isset($_POST['InfoMemberJobForm'])){
            if($model->update()){
                Yii::app()->user->setFlash('message','OK');
                $this->redirect(array('memberjob'));
            }
        }
        $this->render('memberjob',array(
            'model'=>$model,
            "district"=>$district,
            "companyname"=>$companyname
        ));
    }
    /**
     * 密码信息
     */
    public function actionPassword() {
        $model = new InfoPasswordForm();
        if($model->scenario && $model->save()) {
            Yii::app()->user->logout();
            $this->redirect(array('/site/index'));
        }
        $this->render('password',array('model'=>$model));
    }
    /**
     * 头像修改
     */
    public function actionPhoto() {
        $userId = User::model()->getId();
        $userModel = User::model()->getUserInfoById($userId);
        $render = "photo";
        $url = "";
        if(isset($_GET["picid"])&&$_GET["picid"]) {
            $file = PIC_PATH."/head/".$userId."/".$_GET["picid"].".jpg";
            if(file_exists($file)) {
                $render = "photo_jiequ";
                $url = "/upload/head/".$userId."/".$_GET["picid"].".jpg";
            }
        }
        $this->render($render,array(
                "model"=>$userModel,
                "url"=>$url,
        ));
    }
    public function actionSavePhoto() {
        $userId = User::model()->getId();
        if(isset($_POST)&&$_POST) {
            $targ_w = 130;
            $targ_h = 140;
            $jpeg_quality = 100;
            $width = 280;//前台显示大图片的宽度

            $src = PIC_PATH."/head/".$userId."/".$_POST["picid"].".jpg";

            $img_r = imagecreatefromjpeg($src);
            $old_width  = imagesx($img_r);
            $proportion = $old_width/$width;
            $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
            imagecopyresampled($dst_r,$img_r,0,0,$proportion*$_POST['x'],$proportion*$_POST['y'],$targ_w,$targ_h,$proportion*$_POST['w'],$proportion*$_POST['h']);
            imagejpeg($dst_r,$src,$jpeg_quality);
            //生成缩略图
            $imageDeal = new Image();
            $imageDeal->formatWithPicture($src,User::$headSize);
            //保存头像
            $model = User::model()->getUserInfoById($userId);
            $oldPhoto = $model->u_photo;
            $model->u_photo = "/upload/head/".$userId."/".$_POST["picid"].".jpg";
            $model->update();
            //删除旧头像
            User::model()->delUserPhoto($oldPhoto);

        }
        $this->redirect(array("/my/info/photo"));
    }
    public function actionUpload() {
        $userId = User::model()->getId();
        if (isset($_POST["PHPSESSID"])) {
            session_id($_POST["PHPSESSID"]);
        }
        $path = "/head/".$userId;
        if(!is_dir(PIC_PATH.$path)) {
            mkdir(PIC_PATH.$path);
        }
        $fileName = time().rand(100,999);
        $filePath = $path."/".$fileName.".jpg";
        $targetFile =  PIC_PATH.$filePath;
        $tempFile = $_FILES['Filedata']['tmp_name'];

        $boolUploadFile = move_uploaded_file($tempFile,$targetFile);

        //处理缩略图
        $imageDeal = new Image();
        $imageDeal->formatWithPicture($targetFile,array());//处理缩略图
        echo "FILEID:".$fileName;
        exit;
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if( ($error=Yii::app()->errorHandler->error) ) {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }else {
            $this->render('error');
        }
    }
}