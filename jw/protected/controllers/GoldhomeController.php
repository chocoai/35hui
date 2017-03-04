<?php

class GoldhomeController extends Controller {
    public function actionCreate() {
        if(Yii::app()->user->isGuest) {
            echo "请先登录！";
            exit;
        }
        if(!isset ($_POST["id"])||$_POST["id"]=="") {
            echo "内部错误！";
            exit;
        }
        $loginUserId = User::model()->getId();
        if($loginUserId==$_POST["id"]) {
            echo "不能收藏自己！";
            exit;
        }
        if(!Goldhome::model()->checkIfAlreadyAdd($_POST["id"])) {
            echo "您已经收藏了该用户！";
            exit;
        }
        if(!User::model()->checkUserIsMember($_POST["id"])){
             echo "该用户不能被收藏！";exit;
        }
        $gold = Config::model()->getValueByKey("add_goldhome_price");
        $logDescription = "收藏用户";
        if(!User::model()->reduceGoldNum($loginUserId, $gold, $logDescription)) {
            echo "需要花费".$gold."个金币，您的余额不足！";
            exit;
        }
        $model = new Goldhome();
        $model->gh_userid = $loginUserId;
        $model->gh_golehomeuserid = $_POST["id"];
        $model->gh_createtime = time();
        $model->save();
        echo "success";
        exit;
    }
}