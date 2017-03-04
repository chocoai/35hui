<?php

class AdvpopController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    /**
     * Displays a particular model.
     */
    public function actionView() {
        $this->render('view',array(
                'model'=>$this->loadModel(),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model=new Advpop;
        if(isset($_POST['Advpop'])) {
            if( ! empty($_FILES['adp_picurl']['name']) ) {
                //$path = PIC_PATH.'/advertisement/';
                $attext = strtolower(substr($_FILES['adp_picurl']['name'],strrpos($_FILES['adp_picurl']['name'], '.')+1));
                $tempFile = $_FILES['adp_picurl']['tmp_name'];
                if( ! in_array($attext, array('jpg','gif','jpeg'))) {
                    throw new CHttpException(404,'The type of the upload file\'s extensions is not supported.');
                }
                $model->attributes=$_POST['Advpop'];
                $filename = '/advertisement/'.time().'.'.$attext;
                $model->adp_picurl = $filename;
                $model->adp_uploadtime = time();
                if(move_uploaded_file($tempFile,PIC_PATH.$filename)){
                    if($model->save()){
                        $this->redirect(array('view','id'=>$model->adp_id));
                    }
                }else{
                    throw new CHttpException(400,'The file move failed.');
                }
            }
        }

        $this->render('create',array(
                'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     */
    public function actionUpdate() {
        $model=$this->loadModel();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Advpop'])) {
            if( ! empty($_FILES['adp_picurl']['name']) ) {
                //$path = PIC_PATH.'/advertisement/';
                $attext = strtolower(substr($_FILES['adp_picurl']['name'],strrpos($_FILES['adp_picurl']['name'], '.')+1));
                $tempFile = $_FILES['adp_picurl']['tmp_name'];
                if( ! in_array($attext, array('jpg','gif','jpeg'))) {
                    throw new CHttpException(404,'The type of the upload file\'s extensions is not supported.');
                }
                $filename = $model->adp_picurl;//防止被改变
                $model->attributes=$_POST['Advpop'];
                //$filename = '/advertisement/'.time().'.'.$attext;
                $model->adp_picurl = $filename;
                $model->adp_uploadtime = time();
                if(move_uploaded_file($tempFile,PIC_PATH.$filename)){
                    if($model->save()){
                        $this->redirect(array('view','id'=>$model->adp_id));
                    }
                }else{
                    throw new CHttpException(400,'The file move failed.');
                }
            }
        }

        $this->render('update',array(
                'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     */
    public function actionDelete() {
        if(Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel();
            $file = PIC_PATH.$this->_model->adp_picurl;
            $this->_model->delete();
            file_exists($file) && unlink($file);
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $criteria = new CDbCriteria;
        //$criteria->group = 'adp_position';
        $criteria->order = "adp_position, adp_id desc";
        $dataProvider=new CActiveDataProvider('Advpop',array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>10,
                        ),
        ));
        $this->render('index',array(
                'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model=new Advpop('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Advpop']))
            $model->attributes=$_GET['Advpop'];

        $this->render('admin',array(
                'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel() {
        if($this->_model===null) {
            if(isset($_GET['id']))
                $this->_model=Advpop::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if(isset($_POST['ajax']) && $_POST['ajax']==='advpop-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
