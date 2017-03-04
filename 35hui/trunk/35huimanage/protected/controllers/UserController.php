<?php

class UserController extends Controller
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
     * 给用户赠送积分和商务币
     */
    public function actionGiveMP(){
        
        $userId = @$_GET['userid'];
        $userModel = User::model()->findByPk($userId);
        if(!$userModel){
            $this->redirect(array("site/error"));
        }
        $role = $userModel->user_role;
        switch($role) {
            default:
                $name = "";
                break;
            case User::personal :
                $name = $userModel->user_name;
                break;
            case User::company :
                $name = $userModel->companyinfo->uc_fullname;
                break;
            case User::agent :
                $name = $userModel->agentinfo->ua_realname;
                break;
        }
        if($_POST){
            $type=$_POST['type'];
            $point = $_POST['point'];
            $money = $_POST['money'];
            $reason = $_POST['reason'];
            $message = "由于".$reason."，系统奖励";
            if($type==1){//全部
                if($money){
                    $logDescription = $message."{:money}商务币。";
                    Userproperty::model()->addMoney($userId, $money, $logDescription);
                    Yii::app()->user->setFlash('message1',$message.$money."商务币。");
                }
                if($point){
                    $logDescription = $message."{:point}积分";
                    Userproperty::model()->addPoint($userId, $point, $logDescription);
                    Yii::app()->user->setFlash('message2',$message.$point."积分。");
                }
            }elseif($type==2){//积分
                if($point){
                    $logDescription = $message."{:point}积分";
                    Userproperty::model()->addPoint($userId, $point, $logDescription);
                    Yii::app()->user->setFlash('message2',$message.$point."积分。");
                }
            }else{
                if($money){
                    $logDescription = $message."{:money}商务币";
                    Userproperty::model()->addMoney($userId, $money, $logDescription);
                    Yii::app()->user->setFlash('message1',$message.$money."商务币。");
                }
            }
            Yii::app()->user->setFlash('message','赠送成功！');
            $this->refresh();
        }
        $this->render('givemp',array(
            "name"=>$name,
		));
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
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->user_id));
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

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->user_id));
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
        $user_role = empty($_POST['user_role'])?empty($_GET['user_role'])?'':$_GET['user_role']:$_POST['user_role'];
        $user_name = empty($_POST['user_name'])?empty($_GET['user_name'])?'':trim($_GET['user_name']):trim($_POST['user_name']);
        $criteria = new CDbCriteria;
        if( $user_role){
            $_GET['user_role']=$user_role;
            $criteria->addColumnCondition(array("user_role"=>$user_role));
            if($user_name) {
                $_GET['user_name']=$user_name;
                if($user_role==User::agent) {
                    $criteria->with='agentinfo';
                    $criteria->addSearchCondition('ua_realname',$user_name);
                }elseif($user_role==User::company) {
                    $criteria->with='companyinfo';//User::personal
                    $criteria->addSearchCondition('uc_fullname',$user_name);
                }else {
                    $criteria->addSearchCondition('user_name',$user_name);
                }
            }
        }
		$dataProvider=new CActiveDataProvider('User',array(
            'criteria'=>$criteria,
        ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'user_role'=>$user_role,
            'user_name'=>$user_name,
            'model'=>new User,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

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
				$this->_model=User::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
