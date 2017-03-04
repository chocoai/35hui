<?php
class MemberlevelController extends Controller {
    public $layout = "manage";
    private $_model = null;
    public function actionIndex() {
        $criteria=new CDbCriteria;
        $criteria->order = "ml_redboards";
        $allLevel = Memberlevel::model()->findAll($criteria);
        $this->render("index",array(
                "allLevel"=>$allLevel
        ));
    }
    public function actionUpdate() {
        $model = $this->loadModel();
        if(isset($_POST["Memberlevel"])) {
            $model->setAttributes($_POST["Memberlevel"],false);
            if($model->validate()) {
                $model->update();
                Yii::app()->user->setFlash('message','添加');
                $this->redirect(array("index"));
            }
        }
        $this->render("update",array(
                "model"=>$model,
        ));
    }
    public function actionCreate() {
        $model = new Memberlevel();
        if(isset($_POST["Memberlevel"])) {
            $model->setAttributes($_POST["Memberlevel"],false);
            if($model->save()) {
                Yii::app()->user->setFlash('message','添加');
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
            Yii::app()->user->setFlash('message','删除成功');
        }
        $this->redirect(array("index"));
    }
    public function loadModel() {
        if($this->_model===null) {
            if(isset($_GET['id']))
                $this->_model=Memberlevel::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }
}