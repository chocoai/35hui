<?php

class AttentionController extends Controller
{
	public function actionCreate()
	{
        if(Yii::app()->user->isGuest){
            echo "请先登录！";exit;
        }
        if(!isset ($_POST["id"])||$_POST["id"]==""){
            echo "内部错误！";exit;
        }
        $loginUserId = User::model()->getId();
        if($loginUserId==$_POST["id"]){
            echo "不能关注自己！";exit;
        }
        if(!Attention::model()->checkIfAlreadyAttention($_POST["id"])){
            echo "您已经关注了该用户！";exit;
        }
        if(!User::model()->checkUserIsMember($_POST["id"])){
             echo "该用户不能被关注！";exit;
        }
        $model = new Attention();
        $model->at_userid = $loginUserId;
        $model->at_attentionuserid = $_POST["id"];
        $model->at_createtime = time();
        if($model->save()){
            echo "success";exit;
        }
		echo "内部错误！";exit;
	}
}