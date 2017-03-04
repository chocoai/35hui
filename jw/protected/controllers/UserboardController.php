<?php

class UserboardController extends Controller
{
	public function actionCreate()
	{
		if(Yii::app()->user->isGuest){
            echo "请先登录！";exit;
        }
        $info =  $_POST["info"];
        $arr = explode("_",$info);
        if(count($arr)!=2){
            echo "传入参数错误！";exit;
        }
        $id = $arr[0];
        $type = $arr[1];
        if(!array_key_exists($type, Userboard::$ub_boardtype)){
            echo "打牌类型错误！";exit;
        }
        $loginUserId = User::model()->getId();
        if($loginUserId==$id){
            echo "不能给自己打牌！";exit;
        }
        $userModel = User::model()->findByPk($id);
        if(!$userModel||$userModel->u_role!=1){
            echo "只能给model会员打牌！";exit;
        }
        $gold = Config::model()->getValueByKey("add_userboard_price");
        $logDescription = "给用户打牌";
        if(!User::model()->reduceGoldNum($loginUserId, $gold, $logDescription)) {
            echo "需要花费".$gold."个金币，您的余额不足！";
            exit;
        }
        //打牌
        if(Userboard::model()->addUserBoard($id, $type)){
            echo "success";exit;
        }
		echo "内部错误！";exit;
	}
    public function actionAlbumBorardCreate(){
        if(Yii::app()->user->isGuest){
            echo "请先登录！";exit;
        }
        if(!isset ($_POST["id"])||$_POST["id"]==""){
            echo "内部错误！";exit;
        }
        if(!array_key_exists($_POST["type"], Userboard::$ub_boardtype)){
            echo "打牌类型错误！";exit;
        }
        $loginUserId = User::model()->getId();
        $albumModel = Album::model()->findByPk($_POST["id"]);
        if(!$albumModel||$loginUserId==$albumModel->am_userid){
            echo "不能给自己打牌！";exit;
        }
        $userModel = User::model()->findByPk($albumModel->am_userid);
        if(!$userModel||$userModel->u_role!=1){
            echo "只能给model会员打牌！";exit;
        }
        $gold = Config::model()->getValueByKey("add_userboard_price");
        $logDescription = "给用户打牌";
        if(!User::model()->reduceGoldNum($loginUserId, $gold, $logDescription)) {
            echo "需要花费".$gold."个金币，您的余额不足！";
            exit;
        }
        //打牌
        if(Userboard::model()->addAlbumBoard($_POST["id"], $_POST["type"])){
            echo "success";exit;
        }
		echo "内部错误！";exit;
    }
}