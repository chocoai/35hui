<?php

class CreativedongController extends Controller
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        if(empty($_GET['cpid']) || !($parkModel=Creativeparkbaseinfo::model()->findByPk($_GET['cpid'])))
            throw new CHttpException(404,'你必须传递一个创意园区的ID才能创建楼栋.');

		$model=new Creativedong;
        $model->cd_cpid=$parkModel->cp_id;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Creativedong']))
		{
			$model->attributes=$_POST['Creativedong'];
			if($model->save())
				$this->redirect(array('admin','cpid'=>$model->cd_cpid));
		}
		$this->render('create',array(
			'model'=>$model,
            'parkModel'=>$parkModel,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Creativedong']))
		{
			$model->attributes=$_POST['Creativedong'];
			if($model->save())
				$this->redirect(array('admin','cpid'=>$model->cd_cpid));
		}

		$this->render('update',array(
			'model'=>$model,
            'parkModel'=>Creativeparkbaseinfo::model()->findByPk($model->cd_cpid)
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
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Creativedong('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Creativedong']))
			$model->attributes=$_GET['Creativedong'];

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
				$this->_model=Creativedong::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='creativedong-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
