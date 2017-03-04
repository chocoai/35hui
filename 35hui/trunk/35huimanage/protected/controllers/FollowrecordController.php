<?php

class FollowrecordController extends Controller
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
                $msgtip = "";
                $isregistered=0;
		$model=new Followrecord;
                $contactmodel=array();
                if(isset($_GET['userid'])&&$_GET['userid']!=""){
                    $contactmodel=Contactrecord::model()->findByAttributes(array('cr_userid'=>$_GET['userid']));
                }else{
                    $contactmodel=Contactrecord::model()->findByPk($_GET['id']);
                }

		if(isset($_POST['Followrecord']))
		{
			$model->attributes=$_POST['Followrecord'];
                        $contactmodel->attributes=$_POST['Contactrecord'];
			$model->fr_salesman=Manageuser::model()->getNameById(Yii::app()->user->id);
			$model->fr_followtime=time();
                        if(isset($_POST['Contactrecord']['cr_isregistered']) && $_POST['Contactrecord']['cr_isregistered']){
                            $uagent=Uagent::model()->findByAttributes(array('ua_realname'=>$contactmodel->cr_realname));
                            if($uagent){
                                $contactmodel->cr_userid=$uagent->ua_uid;
                                $contactmodel->cr_isregistered=1;
                                if($model->save()){
                                    $contactmodel->update();
                                    $this->redirect(array('view','id'=>$model->fr_id));
                                }
                            }
                            $msgtip="该联系人未注册或者姓名不一致，请修改";
                        }else{
                            if($model->save()){
                                    $contactmodel->update();
                                    $this->redirect(array('view','id'=>$model->fr_id));
                            }
                        }
		}

		$this->render('create',array(
			'model'=>$model,
			'contactmodel'=>$contactmodel,
                        'id'=>$contactmodel->cr_id,
			'userid'=>$contactmodel->cr_userid,
			'msgtip'=>$msgtip,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
                $msgtip = "";
		$model=$this->loadModel();
                $contactmodel=Contactrecord::model()->findByPk($model->fr_crid);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Followrecord']))
		{
			$model->attributes=$_POST['Followrecord'];
                        $contactmodel->attributes=$_POST['Contactrecord'];
                         if(isset($_POST['Contactrecord']['cr_isregistered']) && $_POST['Contactrecord']['cr_isregistered']){
                            $uagent=Uagent::model()->findByAttributes(array('ua_realname'=>$contactmodel->cr_realname));
                            if($uagent){
                                $contactmodel->cr_userid=$uagent->ua_uid;
                                $contactmodel->cr_isregistered=1;
                                if($model->save()){
                                   $contactmodel->update();
                                   $this->redirect(array('view','id'=>$model->fr_id));
                                }
                            }
                            $msgtip="该联系人未注册或者姓名不一致，请修改";
                        }else{
                            if($model->save()){
                                   $contactmodel->update();
                                   $this->redirect(array('view','id'=>$model->fr_id));
                            }
                        }
		}

		$this->render('update',array(
			'model'=>$model,
			'contactmodel'=>$contactmodel,
			'msgtip'=>$msgtip,
			'userid'=>$contactmodel->cr_userid,
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
                      $mmodel=Meetrecord::model()->findAll('mr_frid='.$_GET['id']);
                      if($mmodel){
                             foreach($mmodel as $mvalue){
                                 $bmodel=Buyrecord::model()->findAll('br_mrid='.$mvalue->mr_id);
                                 if($bmodel){
                                     foreach($bmodel as $value){
                                         $bmodel=Buyrecord::model()->findByPk($value->br_id);
                                         $bmodel->delete();
                                     }
                                 }
                                 $mmodel=Meetrecord::model()->findByPk($mvalue->mr_id);
                                 $mmodel->delete();
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
            $fr_salesman = "";
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
            if(isset($_GET['fr_salesman'])){
                $fr_salesman = trim($_GET['fr_salesman']);
                if($fr_salesman){
                    $criteria->addSearchCondition("fr_salesman",$fr_salesman);
                }

            }
            if(isset($_GET['district'])&&$_GET['district']!=""){
                $district = $_GET['district'];
                if($district){
                    $criteria->with = array(
                        'contact'=>array(
                            'condition'=>"cr_district =".$district." and cr_isregistered =0",
                        ),
                    );
                }
            }
            if(isset($_GET['fr_crid'])&&$_GET['fr_crid']!=""){
                $criteria->addColumnCondition(array("fr_crid"=>$_GET['fr_crid']));
            }
            $criteria->order="fr_followtime desc";
            $dataProvider=new CActiveDataProvider('Followrecord',array(
                'criteria'=>$criteria,
            ));
            $this->render('index',array(
                    'dataProvider'=>$dataProvider,
                    'username'=>$username,
                    'fr_salesman'=>$fr_salesman,
                    'district'=>$district,
                    'userid'=>$userid,
            ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Followrecord('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Followrecord']))
			$model->attributes=$_GET['Followrecord'];

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
				$this->_model=Followrecord::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='followrecord-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

          /**
     * 面谈记录列表.
     */
    public function actionMeet()
    {
        $criteria = new CDbCriteria;
        $criteria->condition="mr_frid=".$_GET['id'];
        $criteria->order="mr_time desc";
        $dataProvider=new CActiveDataProvider('Meetrecord',array(
            'criteria'=>$criteria,
        ));

        $this->render('meet',array(
            'dataProvider'=>$dataProvider,
        ));
    }
}
