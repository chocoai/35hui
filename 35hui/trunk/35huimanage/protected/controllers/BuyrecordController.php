<?php

class BuyrecordController extends Controller
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
		$model=new Buyrecord;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Buyrecord']))
		{
                        $userid=isset($_GET['userid'])&&$_GET['userid'] ? $_GET['userid']:0;
			$model->attributes=$_POST['Buyrecord'];
                        $model->br_salesman=Manageuser::model()->getNameById(Yii::app()->user->id);
			$model->br_time=time();
                        if($userid){
                            $contactmodel=Contactrecord::model()->findByAttributes(array('cr_userid'=>$userid));
                            $model->br_crid=$contactmodel->cr_id;
                            if($model->save())
                                    $this->redirect(array('view','id'=>$model->br_id));
                        } else{
                            $mmodel=Meetrecord::model()->findByPk($_POST['Buyrecord']['br_mrid']);
                            $model->br_crid=$mmodel->mr_crid;
                            if($model->save())
                                    $this->redirect(array('view','id'=>$model->br_id));
                        }
		}

		$this->render('create',array(
			'model'=>$model,
                        'id'=>$_GET['id'],
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

		if(isset($_POST['Buyrecord']))
		{
			$model->attributes=$_POST['Buyrecord'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->br_id));
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
            $mr_salesman = "";
            $br_contractno = "";
            $district = "";
            $userid=0;
            if(isset($_GET['userid']) && $_GET['userid']){
                $userid=$_GET['userid'];
                $criteria->with = array(
                    'contact'=>array(
                        'condition'=>"cr_userid =".$userid,
                    ),
                );
            }else{
                $criteria->with = array(
                    'contact'=>array(
                        'condition'=>"cr_isregistered =0",
                    ),
                );
            }
             if(isset($_GET['mr_salesman'])){
                $mr_salesman= trim($_GET['mr_salesman']);
                if($mr_salesman){
                    $criteria->with = array(
                        'meet'=>array(
                            'condition'=>"mr_salesman like '%".$mr_salesman."%'",
                        ),
                    );
                }

            }
            if(isset($_GET['district'])){
                $district = $_GET['district'];
                if($district){
                    $criteria->with = array(
                        'contact'=>array(
                            'condition'=>"cr_district =".$district." and cr_isregistered =0",
                        ),
                    );
                }

            }

            if(isset($_GET['br_contractno'])){
                $br_contractno = trim($_GET['br_contractno']);
                if($br_contractno){
                    $criteria->addSearchCondition("br_contractno",$br_contractno);
                }

            }
            $criteria->order='br_time desc';
            $dataProvider=new CActiveDataProvider('Buyrecord',array(
                'criteria'=>$criteria,
            ));

            $this->render('index',array(
                    'dataProvider'=>$dataProvider,
                    'mr_salesman'=>$mr_salesman,
                    'br_contractno'=>$br_contractno,
                    'district'=>$district,
                    'userid'=>$userid,
            ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Buyrecord('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Buyrecord']))
			$model->attributes=$_GET['Buyrecord'];

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
				$this->_model=Buyrecord::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='buyrecord-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
