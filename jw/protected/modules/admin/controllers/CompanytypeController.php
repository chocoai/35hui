<?php
class CompanytypeController extends Controller {
    public $layout = "manage";
    private $_model = null;
    public function actionIndex(){
        $all = Companytype::model()->findAll();
        $this->render("index",array(
                "all"=>$all,
        ));
    }
    public function actionCreate() {
        $model = new Companytype();
        if(isset($_POST['Companytype'])&&$_POST['Companytype']) {
            $post = array_map('trim',$_POST['Companytype']);
            $model->setAttributes($post,false);
            if($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('message','添加新类型成功');
                $this->redirect(array("index"));
            }
        }
        $this->render("create",array(
                "model"=>$model,
        ));
    }
    public function actionDel() {
        $model = $this->loadModel();
        if($model) {
            $model->delete();
        }
        $this->redirect(array("index"));
    }
    public function actionUpdate() {
        $model = $this->loadModel();
        if(isset($_POST['Companytype'])&&$_POST['Companytype']) {
            $post = array_map('trim',$_POST['Companytype']);
            $model->setAttributes($post,false);
            if($model->validate()) {
                $model->update();
                Yii::app()->user->setFlash('message','修改成功');
                $this->redirect(array("index"));
            }
        }
        $this->render("update",array(
                "model"=>$model,
        ));
    }
    public function loadModel() {
        if($this->_model===null) {
            if(isset($_GET['id']))
                $this->_model=Companytype::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }
}