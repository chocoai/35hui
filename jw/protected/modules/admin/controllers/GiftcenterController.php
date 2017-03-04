<?php
class GiftcenterController extends Controller {
    public $layout = "manage";
    public function actionCreate() {
        $model = new Giftcenter();
        if(isset($_POST["Giftcenter"])&&$_POST["Giftcenter"]) {
            $oldPicName = $model->gc_url;
            $model->setAttributes($_POST["Giftcenter"],false);
            if($model->validate()) {
                //生成缩略图
                if(isset($_FILES["Giftcenter"]["name"]["gc_url"])&&$_FILES["Giftcenter"]["name"]["gc_url"]){
                    $tempFile = $_FILES['Giftcenter']['tmp_name']["gc_url"];
                    $newName = Propcenter::model()->uploadImg($tempFile, $oldPicName);
                    $oldPicName = $newName;
                }
                $model->gc_url = $oldPicName;
                $model->save();
                Yii::app()->user->setFlash('message','新增礼物成功');
                $this->redirect(array("/admin/propcenter/index"));
            }
        }
        $this->render("create",array(
                "model"=>$model
        ));
    }
    public function actionUpdate() {
        $id = $_GET["id"];
        $model = Giftcenter::model()->findByPk($id);
        if(isset($_POST["Giftcenter"])&&$_POST["Giftcenter"]) {
            $oldPicName = $model->gc_url;
            $model->setAttributes($_POST["Giftcenter"],false);
            if($model->validate()) {
                //生成缩略图
                if(isset($_FILES["Giftcenter"]["name"]["gc_url"])&&$_FILES["Giftcenter"]["name"]["gc_url"]){
                    $tempFile = $_FILES['Giftcenter']['tmp_name']["gc_url"];
                    $newName = Propcenter::model()->uploadImg($tempFile, $oldPicName);
                    $oldPicName = $newName;
                }
                $model->gc_url = $oldPicName;
                $model->update();
                Yii::app()->user->setFlash('message','更新礼物成功');
                $this->redirect(array("/admin/propcenter/index"));
            }
        }
        $this->render("update",array(
                "model"=>$model
        ));
    }
}