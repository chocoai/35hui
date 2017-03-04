<?php
class PropcenterController extends Controller {
    public $layout = "manage";
    public function actionIndex() {
        $allProp = Propcenter::model()->findAll();
        $allGift = Giftcenter::model()->findAll();
        $this->render("index",array(
                "allProp"=>$allProp,
                "allGift"=>$allGift
        ));
    }
    public function actionUpdate() {
        $id = $_GET["id"];
        $model = Propcenter::model()->findByPk($id);
        if(isset($_POST["Propcenter"])&&$_POST["Propcenter"]) {
            $oldPicName = $model->pc_url;
            $model->setAttributes($_POST["Propcenter"],false);
            if($model->validate()) {
                //生成缩略图
                if(isset($_FILES["Propcenter"]["name"]["pc_url"])&&$_FILES["Propcenter"]["name"]["pc_url"]) {
                    $path = "/gift";
                    $fileName = time().rand(100,999);
                    $filePath = $path."/".$fileName.".jpg";
                    $targetFile =  PIC_PATH.$filePath;
                    $tempFile = $_FILES['Propcenter']['tmp_name']["pc_url"];
                    $boolUploadFile = move_uploaded_file($tempFile,$targetFile);
//                    处理缩略图
                    $imageDeal = new Image();
                    $imageDeal->formatWithPicture($targetFile,Propcenter::$pc_urlSize);//处理缩略图
                    unlink($targetFile);
                    $suffixName = str_replace(".","_xx.",$targetFile);
                    rename($suffixName, $targetFile);
                    $model->pc_url = "/upload".$filePath;
                    //删除原来的头像
                    if($oldPicName) {
                        @unlink(DOCUMENTROOT.$oldPicName);
                    }
                }else {
                    $model->pc_url = $oldPicName;
                }
                $model->update();
                Yii::app()->user->setFlash('message','更新道具成功');
                $this->redirect(array("index"));
            }
        }
        $this->render("update",array(
                "model"=>$model
        ));
    }
}