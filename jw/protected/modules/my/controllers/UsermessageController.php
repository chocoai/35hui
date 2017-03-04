<?php

class UsermessageController extends Controller {
    public function filters() {
        return array(
                'accessControl', // perform access control for CRUD operations
        );
    }
    public function accessRules() {
        return array(
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                        'roles'=>array(
                                User::ROLE_MEMBER,
                                User::ROLE_AUDIENCE,
                        ),
                ),
                array('deny',  // deny all users
                        'users'=>array('*'),
                ),
        );
    }
    /**
     * 收件箱
     */
    public function actionIndex() {
        $userId = User::model()->getId();
        $criteria=new CDbCriteria();
        $criteria->addColumnCondition(array("um_userid"=>$userId));
        $criteria->addCondition("um_delstate=0 or um_delstate=2");
        $criteria->order = "um_createtime desc";
        $dataProvider =  new CActiveDataProvider("Usermessage", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>20,
                        ),

        ));
        $this->render("index",array(
                "dataProvider"=>$dataProvider,
        ));
    }
    /**
     * 发件箱
     */
    public function actionSendindex() {
        $userId = User::model()->getId();
        $criteria=new CDbCriteria();
        $criteria->addColumnCondition(array("um_fromid"=>$userId));
        $criteria->addCondition("um_delstate=0 or um_delstate=1");
        $criteria->order = "um_createtime desc";
        $dataProvider =  new CActiveDataProvider("Usermessage", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>20,
                        ),

        ));
        $this->render("sendindex",array(
                "dataProvider"=>$dataProvider,
        ));
    }
    /**
     * 发送消息
     */
    public function actionCreate() {
        $return = "error";
        if($_POST) {
            $userId = User::model()->getId();
            $model = new Usermessage();
            $model->um_userid = $_POST["id"];
            $model->um_fromid = $userId;
            $model->um_title = htmlspecialchars($_POST["title"]);
            $model->um_content = htmlspecialchars($_POST["content"]);
            $model->um_createtime = time();
            $model->um_readstate = 0;
            $model->um_delstate = 0;
            if($model->save()) {
                $return = "success";
            }
        }
        echo $return;
        exit;
    }
    /**
     * 回复消息
     */
    public function actionReply() {
        $return = "error";
        if($_POST) {
            $userId = User::model()->getId();
            $baseModel = Usermessage::model()->findByPk($_POST["umid"]);
            if($baseModel&&$baseModel->um_userid==$userId) {//只能回复自己的短信
                $model = new Usermessage();
                $model->um_userid = $baseModel->um_fromid;
                $model->um_fromid = $userId;
                $model->um_replyidumid = $_POST["umid"];
                $model->um_title = htmlspecialchars($_POST["title"]);
                $model->um_content = htmlspecialchars($_POST["content"]);
                $model->um_createtime = time();
                $model->um_readstate = 0;
                $model->um_delstate = 0;
                if($model->save()) {
                    $return = "success";
                }
            }

        }
        echo $return;
        exit;
    }
    public function actionView() {
        $id = $_GET["id"];
        $userId = User::model()->getId();
        $userMessageModel = Usermessage::model()->findByPk($id);
        if($userMessageModel) {
            if($userMessageModel->um_userid==$userId||$userMessageModel->um_fromid==$userId) {
                if($userMessageModel->um_userid==$userId&&$userMessageModel->um_readstate==0) {//改变阅读状态
                    $userMessageModel->um_readstate = 1;
                    $userMessageModel->update();
                }
                $this->render("view",array(
                        "userMessageModel"=>$userMessageModel,
                        "userId"=>$userId
                ));
            }
        }
    }
    public function actionDel() {
        if(isset($_POST["id"])&&$_POST["id"]) {
            $userId = User::model()->getId();
            $criteria=new CDbCriteria;
            $criteria->select = "um_id,um_userid,um_fromid,um_delstate";
            $criteria->addInCondition("um_id",$_POST["id"]);
            $allInfo = Usermessage::model()->findAll($criteria);
            foreach($allInfo as $value) {
                if($value->um_userid==$userId) {
                    $value->um_delstate = $value->um_delstate+1;
                    $value->um_delstate>3?$value->um_delstate=3:"";
                    $value->update();
                }elseif($value->um_fromid==$userId) {
                    $value->um_delstate = $value->um_delstate+2;
                    $value->um_delstate>3?$value->um_delstate=3:"";
                    $value->update();
                }
            }
        }
        $return = DOMAIN."/my/usermessage";
        if(isset($_SERVER["HTTP_REFERER"])&&$_SERVER["HTTP_REFERER"]){
            $return = $_SERVER["HTTP_REFERER"];
        }
        header("Location:".$return);
    }
}