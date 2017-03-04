<?php
class ConfigController extends Controller {
    public $layout = "manage";
    public function actionIndex() {
        $list = Config::model()->findAll();
        if(isset ($_POST)&&$_POST){
            foreach($list as $model){
                if($model->conf_value!=trim($_POST["$model->conf_key"])){
                    $model->conf_value = trim($_POST["$model->conf_key"]);
                    $model->update();
                }
            }
            Yii::app()->user->setFlash('message','修改成功');
            $this->redirect(array("index"));
        }
        $this->render('index',array(
                'list'=>$list,
        ));
    }
}
