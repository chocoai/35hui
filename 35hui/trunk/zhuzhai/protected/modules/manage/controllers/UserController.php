<?php

class UserController extends Controller
{
    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

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
                        'actions'=>array('changepwd',"changehead"),
                        'users'=>array('@'),
                ),
                array('allow',
                        'actions'=>array("index","shenfen","mingpian","gongsi"),
                        'roles'=>array(Yii::app()->params['agent']),
                ),
                array('allow',
                        'actions'=>array("comindex","yunying"),
                        'roles'=>array(Yii::app()->params['company']),
                ),
            array('allow',
                        'actions'=>array("perindex"),
                        'roles'=>array(Yii::app()->params['personal']),
                ),
                array('deny',  // deny all users
                        'users'=>array('*'),
                ),
        );
    }
    public function actionPerindex(){
        $model = User::model()->findByPk(Yii::app()->user->id);
        if(isset($_POST['User']))
        {
            $model->attributes=$_POST['User'];
            $model = User::model()->checkTelAndEmail($model);
            if(!$model->hasErrors()){
                $model->update();
                Yii::app()->user->setFlash('message','修改基本信息成功！');
                $this->redirect(array("perindex"));
            }
        }
        $this->render('perindex',array(
            'model'=>$model,
        ));
    }
    
    /**
     * 经纪人修改经纪人信息
     */
    public function actionIndex(){
        $userid = Yii::app()->user->id;
        $model=Uagent::model()->findByAttributes(array("ua_uid"=>$userid));
        $userModel = User::model()->findByPk($userid);
        $districtlist = array();
        $sectionlist = array();
        if($model->ua_district!=0){
            $districtlist = Region::model()->findAllByAttributes(array('re_parent_id'=>$model->ua_city));
            if($model->ua_section!=0){
                $sectionlist = Region::model()->findAllByAttributes(array('re_parent_id'=>$model->ua_district));
            }
        }
        if(isset($_POST['Uagent'])){
            $model->attributes=$_POST['Uagent'];
            $userModel->attributes=$_POST['User'];
            $userModel = User::model()->checkTelAndEmail($userModel);
            if($model->validate()&&!$userModel->hasErrors()){
                $model->save();
                $userModel->update();
                $model->userInfo->user_mainbusiness=$_POST['mainbusiness'];
                Yii::app()->user->setState('mainbusiness',$_POST['mainbusiness']);
                Yii::app()->user->setState('mainbusinessname',User::$mainBusiness[$_POST['mainbusiness']]);
                $model->userInfo->update();
                Yii::app()->user->setFlash('message','修改用户信息成功！');
                $this->redirect(array("index"));
            }
        }

        $this->render('index',array(
                'model'=>$model,
                'userModel'=>$userModel,
                'districtlist'=>$districtlist,
                'sectionlist'=>$sectionlist,
        ));
    }
    public function actionChangeHead(){
        $userId = Yii::app()->user->id;
        $userHead = User::model()->getUserHeadPic($userId);
        $role = User::model()->getCurrentRole();
        switch($role) {
            case User::personal :
                $type = "avatar";
                break;
            case User::company :
                $type = "logo";
                break;
            case User::agent :
                $type = "avatar";
                break;
            default:
                $this->redirect(array('main/error'));
                break;
        }
        $this->render('changehead', array(
                "role"=>$role,
                "type"=>$type,
                "userHead"=>$userHead,
        ));
    }
    public function actionShenFen(){
        Yii::import('application.common.*');
        require_once('image.php');
        $userId = Yii::app()->user->id;
        $uagent = Uagent::model()->find("ua_uid=:ua_uid",array("ua_uid"=>$userId));
        $model=new LogoForm;
        if(isset($_POST['LogoForm'])){
            $model->attributes=$_POST['LogoForm'];
            $imageForm=CUploadedFile::getInstance($model,'logo');

            if($model->validate()){
                try{
                    $uagent = Uagent::model()->findByAttributes(array("ua_uid"=>$userId));
                    $oldurl = PIC_PATH.$uagent->ua_scardurl;
                    Picture::model()->deleteFile($oldurl,Uagent::$idCardPicNorm);
                    $picTypePath = "/ua/";
                    if(!is_dir(PIC_PATH.$picTypePath.Yii::app()->user->name)){//if folder named by username don't exist, create the folder under dir::puser
                        mkdir(PIC_PATH.$picTypePath.Yii::app()->user->name);
                    }
                    $uagent->ua_scardurl = Picture::model()->imageName($imageForm->name,$picTypePath.Yii::app()->user->name.DS);//得到最新生成的图片名称

                    $boolUploadFile = $imageForm->saveAs(PIC_PATH.$uagent->ua_scardurl);//save logo to real path
                    if($boolUploadFile){
                        $imageDeal = new Image();
                        $result = $imageDeal->formatWithPicture(PIC_PATH.$uagent->ua_scardurl,Uagent::$idCardPicNorm);//处理缩略图
                        $uagent->ua_scardaudit = 0;//代表审核状态是审核中
                        if($uagent->save()){
                            $this->Redirect(array("shenfen"));
                        }
                    }
                }catch(Exception $e){
                    $this->redirect(array('main/error'));
                }
            }
        }
        $this->render('shenfen', array(
                'model'=>$model,
                'uagent'=>$uagent,
        ));
    }
    public function actionmingpian(){
        Yii::import('application.common.*');
        require_once('image.php');
        $userId = Yii::app()->user->id;
        $uagent = Uagent::model()->find("ua_uid=:ua_uid",array("ua_uid"=>$userId));
        $model=new LogoForm;
        if(isset($_POST['LogoForm'])){
            $model->attributes=$_POST['LogoForm'];
            $imageForm=CUploadedFile::getInstance($model,'logo');
            if($model->validate()){
                try{
                    $uagent = Uagent::model()->findByAttributes(array("ua_uid"=>$userId));
                    $oldurl = PIC_PATH.$uagent->ua_bcardurl;
                    Picture::model()->deleteFile($oldurl,Uagent::$businessPicNorm);
                    $picTypePath = "/ua/";
                    if(!is_dir(PIC_PATH.$picTypePath.Yii::app()->user->name)){//if folder named by username don't exist, create the folder under dir::puser
                        mkdir(PIC_PATH.$picTypePath.Yii::app()->user->name);
                    }
                    $uagent->ua_bcardurl = Picture::model()->imageName($imageForm->name,$picTypePath.Yii::app()->user->name.DS);//得到最新生成的图片名称
                    $boolUploadFile = $imageForm->saveAs(PIC_PATH.$uagent->ua_bcardurl);//save logo to real path
                    if($boolUploadFile){
                        $imageDeal = new Image();
                        $result = $imageDeal->formatWithPicture(PIC_PATH.$uagent->ua_bcardurl,Uagent::$businessPicNorm);//处理缩略图
                        $uagent->ua_bcardaudit = 0;//代表审核状态是审核中
                        if($uagent->save()){
                            $this->Redirect(array("mingpian"));
                        }
                    }
                }catch(Exception $e){
                    $this->redirect(array('main/error'));
                }
            }
        }
        $this->render('mingpian', array(
                'model'=>$model,
                'uagent'=>$uagent,
        ));
    }
    

    public function actionChangepwd()
    {
        $model = new ChangePwdForm;
        if(isset($_POST['ChangePwdForm']))
        {
            $model->attributes=$_POST['ChangePwdForm'];
            if($model->validate())
            {
                $userid = Yii::app()->user->id;
                if($model->newpwd !== $model->renewpwd)
                {
                    $model->addError('renewpwd','2次密码要一样');
                }else{
                    $user=User::model()->find('user_id=?',array(Yii::app()->user->id));
                    if($user->validatePassword($model->originpwd))//判断初始密码是否正确
                    {
                        $salt = User::generateSalt();
                        $password =  User::hashPassword($model->newpwd,$salt);
                        try
                        {
                            $dba = dba();
                            $effectRows = $dba->execute('UPDATE 35_user SET `user_pwd`=?,`user_salt`=?  WHERE `user_id`=?',$password,$salt,$userid);
                            if($effectRows>0){
                                Yii::app()->user->setFlash('message','更新密码成功！');
//                                同步修改bbs密码
                                $email = User::model()->getUserEmail($userid);
                                uc_user_edit(Yii::app()->user->name, $model->originpwd, $model->newpwd, $email);
                            }else{
                                Yii::app()->user->setFlash('message','更新密码失败！');
                            }
                            $this->Redirect(array("changepwd"));
                        }catch(Exception $e){
                            $this->redirect(array('main/error'));
                        }
                    }else{
                        $model->addError('originpwd','初始密码错误');
                    }
                }

            }
        }
        $this->render('changepwd',array(
                'model'=>$model,
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
                $this->_model=User::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }
}
