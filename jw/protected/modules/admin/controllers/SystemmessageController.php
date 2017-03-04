<?php

class SystemmessageController extends Controller {
    public $layout = "manage";
    public function actionIndex() {
        $this->render('index');
    }
    public function actionCreate() {
        if($_POST) {
            $userId = $_POST["userid"];
            $content = $_POST["content"];
            $check = true;
            $return = "success";
            if($userId) {
                $userModel = User::model()->getUserInfoById($userId);
                if($userModel) {
                    Systemmessage::model()->sendMessage($content,$userId);
                }else {
                    $return = "输入的用户不存在！";
                }
            }else {
                Systemmessage::model()->sendMessage($content);
            }
            echo $return;exit;
        }
    }
}