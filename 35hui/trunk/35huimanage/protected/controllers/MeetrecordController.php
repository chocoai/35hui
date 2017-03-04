<?php

class MeetrecordController extends Controller
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
		$model=new Meetrecord;
		if(isset($_POST['Meetrecord']))
		{
                        $userid=isset($_GET['userid'])&&$_GET['userid'] ? $_GET['userid']:0;
			$model->attributes=$_POST['Meetrecord'];
                        $model->mr_salesman=Manageuser::model()->getNameById(Yii::app()->user->id);
                        $model->mr_time=time();
                        if($userid){
                            $contactmodel=Contactrecord::model()->findByAttributes(array('cr_userid'=>$userid));
                            $model->mr_crid=$contactmodel->cr_id;
                            if($model->save())
                                    $this->redirect(array('view','id'=>$model->mr_id));
                        }else{
                            $fmodel=Followrecord::model()->findByPk($_POST['Meetrecord']['mr_frid']);
                            $model->mr_crid=$fmodel->fr_crid;
                            if($model->save()){
                                    $fmodel->fr_status=1;
                                    if($fmodel->update()){
                                        $this->redirect(array('view','id'=>$model->mr_id));
                                    }
                            }
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

		if(isset($_POST['Meetrecord']))
		{
			$model->attributes=$_POST['Meetrecord'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->mr_id));
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
                        $bmodel=Buyrecord::model()->findAll('br_mrid='.$_GET['id']);
                         if($bmodel){
                             foreach($bmodel as $value){
                                 $bmodel=Buyrecord::model()->findByPk($value->br_id);
                                 $bmodel->delete();
                             }
                         }
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
            $username = "";
            $mr_salesman = "";
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
            if(isset($_GET['username'])){
                $username= trim($_GET['username']);
                if($username){
                    $criteria->with = array(
                        'contact'=>array(
                            'condition'=>"cr_realname like '%".$username."%'",
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
            if(isset($_GET['mr_salesman'])){
                $mr_salesman = trim($_GET['mr_salesman']);
                if($mr_salesman){
                    $criteria->addSearchCondition("mr_salesman",$mr_salesman);
                }

            }
            $criteria->order="mr_time desc";
            $dataProvider=new CActiveDataProvider('Meetrecord',array(
                'criteria'=>$criteria,
            ));
            $this->render('index',array(
                    'dataProvider'=>$dataProvider,
                    'username'=>$username,
                    'mr_salesman'=>$mr_salesman,
                    'district'=>$district,
                    'userid'=>$userid,
            ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Meetrecord('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Meetrecord']))
			$model->attributes=$_GET['Meetrecord'];

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
				$this->_model=Meetrecord::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='meetrecord-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

        /**
         * 购买记录列表.
         */
        public function actionBuy()
        {
            $criteria = new CDbCriteria;
            $criteria->condition="br_mrid=".$_GET['id'];
            $criteria->order="br_time desc";
            $dataProvider=new CActiveDataProvider('Buyrecord',array(
                'criteria'=>$criteria,
            ));
            $this->render('buy',array(
                'dataProvider'=>$dataProvider,
            ));
        }
}
