<?php

class SubwayController extends Controller
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
		$model=new Subway;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Subway']))
		{
			$model->attributes=$_POST['Subway'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->sw_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
    public function actionUpdate(){
        $model=$this->loadModel();
		if(isset($_POST['Subway']))
		{
			$model->attributes=$_POST['Subway'];
			if($model->validate()){
                $model->save();
            }
				$this->redirect(array('view','id'=>$model->sw_id));
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
        $line = Subway::model()->getAllByParentId("1");
		$this->render('index',array(
            "line"=>$line,
		));
	}
    public function actionGetAllstation() {
        $model = $this->loadModel();
        $station = Subway::model()->getAllByParentId($model->sw_id);
        $return  = array();
        foreach($station as $value){
            $return[] = $value->attributes;
        }
        echo json_encode($return);
        exit;
    }
    public function actionGetstationinfo(){
        $model = $this->loadModel();
        $return = $model->attributes;
        echo json_encode($return);
        exit;
    }
    public function actionUpdateposition() {
        if($_POST){
            $model = Subway::model()->findByPk($_POST["stationid"]);
            if($model){
                $model->attributes = $_POST;
                $model->update();
                echo "<script>window.parent.saveSuccess()</script>";
            }
        }
        exit;
    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Subway('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Subway']))
			$model->attributes=$_GET['Subway'];

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
				$this->_model=Subway::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='subway-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionAjaxGetChildren(){
        if(isset($_GET['parentid'])){
            echo json_encode(Subway::model()->getFormatChildrenData($_GET['parentid']));
        }elseif(isset($_GET['id'])){
            echo json_encode(Subway::model()->getFormatChildrenData($_GET['line']));
        }
    }
}
