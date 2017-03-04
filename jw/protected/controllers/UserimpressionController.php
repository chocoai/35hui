<?php

class UserimpressionController extends Controller {
    public function actionCreate() {
        if(Yii::app()->user->isGuest) {
            echo "请先登录！";
            exit;
        }
        $toUserId = $_POST["uid"];
        if(!Userimpression::model()->checkAlreadyImpression($toUserId)){
            echo "您已经给此用户添加了印象，不能重复添加！";exit;
        }
        /*开始加印象*/
        if(isset($_POST["content"])&&$_POST["content"]) {//直接添加
            $model = new Userimpressioncontent();
            $model->uic_content = $_POST["content"];
            if(!$model->save()) {
                echo "输入内容不符规范！";
                exit;
            }
            Userimpression::model()->addImpression($toUserId, $model->uic_id);
            echo "success";
            exit;
        }
        if(isset($_POST["contentId"])&&$_POST["contentId"]) {
            $contentId = $_POST["contentId"];
            //判断传入id是否正确
            if(Userimpression::model()->count("ui_userid=".$toUserId." and ui_contentid=".$contentId)!=0) {
                $pressionContent = Userimpressioncontent::model()->findByPk($contentId);
                $pressionContent->uic_supportnum += 1;
                $pressionContent->update();
                Userimpression::model()->addImpression($toUserId, $contentId);
                echo "success";
                exit;
            }
        }
        echo "参数错误";
        exit;
    }
}