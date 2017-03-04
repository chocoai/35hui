<?php

class DomainkeyController extends Controller
{
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
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Domainkey;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['dk_name']))
		{
            $name = array();
            foreach($_POST['dk_name'] as $value){
                $value = trim($value);
                if($value!=""){
                    $name[] = $value;
                }
            }
            $name = array_unique($name);
			if($name){
                $model->dk_name = serialize($name);
                $model->kd_key = Domainkey::model()->encodeKey($name[0]);
                if($model->validate()){
                    $model->save();
                    $this->redirect(array('view','id'=>$model->dk_id));
                }
             }else{
                 $model->addError('dk_name', '请输入最少一个域名！');
             }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
    public function actionUpdate(){
        $model = $this->loadModel();
        if(isset($_POST['dk_name']))
		{
            $name = array();
            foreach($_POST['dk_name'] as $value){
                $value = trim($value);
                if($value!=""){
                    $name[] = $value;
                }
            }
            $name = array_unique($name);
			if($name){
                $model->dk_name = serialize($name);
                if($model->update()){
                    $this->redirect(array('view','id'=>$model->dk_id));
                }
             }else{
                 $model->addError('dk_name', '请输入最少一个域名！');
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
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Domainkey');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Domainkey('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Domainkey']))
			$model->attributes=$_GET['Domainkey'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Domainkey::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='domainkey-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
