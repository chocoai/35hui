<?php

class DemendcollectController extends Controller
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
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Demendcollect;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Demendcollect']))
		{
			$model->attributes=$_POST['Demendcollect'];
                        $model->dc_register=Manageuser::model()->getNameById(Yii::app()->user->id);
                        $model->dc_time=time();
			if($model->save())
				$this->redirect(array('view','id'=>$model->dc_id));
		}

		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['Demendcollect']))
		{
			$model->attributes=$_POST['Demendcollect'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->dc_id));
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
                $criteria = new CDbCriteria;
                $dc_buildtype = "";
                $dc_type = "";
                $dc_buildname = "";
                if(isset($_GET['dc_buildtype'])&&$_GET['dc_buildtype']!=""){
                    $dc_buildtype = $_GET['dc_buildtype'];
                    $criteria->addColumnCondition(array("dc_buildtype"=>$dc_buildtype));
                }
                if(isset($_GET['dc_type'])&&$_GET['dc_type']!=""){
                    $dc_type = $_GET['dc_type'];
                    $criteria->addColumnCondition(array("dc_type"=>$dc_type));
                }
                if(isset($_GET['dc_buildname'])){
                    $dc_buildname= trim($_GET['dc_buildname']);
                    if($dc_buildname){
                       $criteria->addSearchCondition("dc_buildname",$dc_buildname);
                    }

                }
		$dataProvider=new CActiveDataProvider('Demendcollect',array(
                    'criteria'=>$criteria,
                ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'dc_buildtype'=>$dc_buildtype,
			'dc_type'=>$dc_type,
			'dc_buildname'=>$dc_buildname,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Demendcollect('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Demendcollect']))
			$model->attributes=$_GET['Demendcollect'];

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
				$this->_model=Demendcollect::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='demendcollect-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
