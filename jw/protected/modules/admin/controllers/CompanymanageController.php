<?php
class CompanymanageController extends Controller {
    public $layout = "manage";
    private $_model = null;
    public function actionIndex() {
        $criteria=new CDbCriteria;
        $dataProvider =  new CActiveDataProvider("Companymanage", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>20,
                        ),

        ));
        $this->render("index",array(
                "dataProvider"=>$dataProvider
        ));
    }
    public function actionCreate() {
        $model = new Companymanage();
        $district = Region::model()->getAllGroupList();
        if(isset($_POST['Companymanage'])&&$_POST['Companymanage']) {
            $post = array_map('trim',$_POST['Companymanage']);
            $model->setAttributes($post,false);
            if($model->validate()) {
                $check = Companymanage::model()->count("cm_district=".$model->cm_district." and cm_companyname='".$model->cm_companyname."'");
                if($check) {
                    $model->addError("cm_companyname","该区域下已经存在此公司");
                }else {
                    $model->save();
                    Yii::app()->user->setFlash('message','添加新公司成功');
                    $this->redirect(array("index"));
                }

            }
        }
        $this->render("create",array(
                "model"=>$model,
                "district"=>$district
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
        $district = Region::model()->getAllGroupList();
        if(isset($_POST['Companymanage'])&&$_POST['Companymanage']) {
            $post = array_map('trim',$_POST['Companymanage']);
            $model->setAttributes($post,false);
            if($model->validate()) {
                $check = Companymanage::model()->count("cm_id!=".$model->cm_id." and cm_district=".$model->cm_district." and cm_companyname='".$model->cm_companyname."'");
                if($check) {
                    $model->addError("cm_companyname","该区域下已经存在此公司");
                }else {
                    $model->update();
                    Yii::app()->user->setFlash('message','修改成功');
                    $this->redirect(array("index"));
                }

            }
        }
        $this->render("update",array(
                "model"=>$model,
                "district"=>$district
        ));
    }
    public function loadModel() {
        if($this->_model===null) {
            if(isset($_GET['id']))
                $this->_model=Companymanage::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }
}