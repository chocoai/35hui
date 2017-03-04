<?php

class QuickrequireController extends Controller
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
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

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
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	//审核通过
	public function actionChecked()
	{
		$model=$this->loadModel();
		$model->qrq_check=$model->qrq_check==1?"2":"1";
		$model->update();
		$this->redirect(isset($_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER']  : array('index'));
	}
    //需求解决
    public function actionSettleTime()
	{
		$model=$this->loadModel();
		$model->qrq_settledate=time();
		$model->update();
		$this->redirect(isset($_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER']  : array('index'));
	}
    //延长日期
     public function actionProlongTime()
	{
		$model=$this->loadModel();
		$model->qrq_settledate=$model->qrq_settledate+(86400*7);
		$model->update();
		$this->redirect(isset($_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER']  : array('index'));
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $criteria=new CDbCriteria();
        $criteria->order="qrq_id desc";
		$dataProvider=new CActiveDataProvider('Quickrequire',array(
                        'criteria'=>$criteria,
        ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Quickrequire('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Quickrequire']))
			$model->attributes=$_GET['Quickrequire'];

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
				$this->_model=Quickrequire::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='quickrequire-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
