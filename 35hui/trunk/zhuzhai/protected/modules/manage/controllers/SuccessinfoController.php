<?php

class SuccessinfoController extends Controller
{
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
            array('allow',
                        'actions'=>array("index","create","update","delete"),
                        'roles'=>array(Yii::app()->params['agent']),
                ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $userId = Yii::app()->user->id;
        $all = Successinfo::model()->findAllByAttributes(array("si_userid"=>$userId));
        if(count($all)>=25){
            Yii::app()->user->setFlash('message','您最多只能添加25个成功案例！');
            $this->redirect(array('index'));
        }

		$model=new Successinfo;
		if(isset($_POST['Successinfo']))
		{
			$model->attributes=$_POST['Successinfo'];
            $model->si_userid = $userId;
            $model->si_successtime = strtotime($model->si_successtime);
			if($model->validate()){
                $model->save();
                Yii::app()->user->setFlash('message','添加成功案例成功！');
                $this->redirect(array('index'));
            }
				
		}
		$this->render('form',array(
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
		if(isset($_POST['Successinfo']))
		{
			$model->attributes=$_POST['Successinfo'];
            $model->si_successtime = strtotime($model->si_successtime);
			if($model->validate()){
                $model->update();
                Yii::app()->user->setFlash('message','修改成功案例成功！');
                $this->redirect(array('index'));
            }
		}

		$this->render('form',array(
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
			$userId=Yii::app()->user->id;
            $msgId = array();
            if(isset($_POST["check"])){//批量删除
                $msgId = array_keys($_POST["check"]);

            }else{
                $msgId = array($_GET['id']);
            }
            if($msgId){
                foreach($msgId as $value){
                    $model = Successinfo::model()->findbyPk($value);
                    if($userId==$model->si_userid){
                        $model->delete();
                    }
                }
            }
		}
		else{
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
        $this->redirect(array("index"));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $criteria=new CDbCriteria;
        $criteria->order = "si_successtime desc";
        $criteria->addColumnCondition(array("si_userid"=>Yii::app()->user->id));
		$dataProvider=new CActiveDataProvider('Successinfo',array(
            "pagination"=>array("pagesize"=>15),
            'criteria'=>$criteria,
        ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
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
				$this->_model=Successinfo::model()->findbyPk($_GET['id']);
			if($this->_model===null){
                throw new CHttpException(404,'The requested page does not exist.');
            }
            if($this->_model->si_userid!=Yii::app()->user->id){
                throw new CHttpException(404,'The requested page does not exist.');
            }
		}
		return $this->_model;
	}

}
