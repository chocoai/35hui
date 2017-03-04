<?php

class MsgController extends Controller
{
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('sendBox','receiveBox','huifu','delete','view',"gonggao"),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    public function actionGongGao(){
        switch(User::model()->getCurrentRole()) {
            case User::personal :
                $dataProvider = Post::model()->getAllPostByRole(Post::psersonal);
                break;
            case User::company :
                $dataProvider = Post::model()->getAllPostByRole(Post::company);
                break;
            case User::agent :
                $dataProvider = Post::model()->getAllPostByRole(Post::agent);
                break;
            default:
                $this->redirect(array('main/error'));
                break;
        }
        $this->render('gonggao',array(
                'dataProvider'=>$dataProvider
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
	public function actionHuifu()
	{
        $this->loadModel();
        //此处发件人就是收件人
        $model = new Msg;
        $model->msg_revid = $this->_model->msg_sendid;//收件人
        $model->msg_sendid = Yii::app()->user->id;//发件人
        $model->msg_title = 'R：'.CHtml::encode($this->_model->msg_title);

        if(isset($_POST["Msg"])&&$_POST["Msg"]){
            $model->attributes = $_POST["Msg"];
            $model->msg_time = time();
            if($model->save()){
                $this->redirect(array("sendbox"));
            }
        }
        $this->render('huifu',array(
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
                    $model = Msg::model()->findbyPk($value);
                    if($userId==$model->msg_sendid){
                        $model->msg_senddel = Msg::$del['del'];
                        $model->update();
                    }elseif($userId == $model->msg_revid){
                        $model->msg_revdel = Msg::$del['del'];
                        $model->update();
                    }
                }
            }
            
            header('Location:'.$_SERVER['HTTP_REFERER']);
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
    public function actionSendBox(){
		$userId=Yii::app()->user->id;
        //发件箱
		$criteria=new CDbCriteria(array(
			'condition'=>'msg_sendid=:userId and msg_senddel=:senddel',
            'params'=>array(":userId"=>$userId,":senddel"=>Msg::$del['undel']),
			'order'=>'msg_time DESC',
		));
		$dataProvider=new CActiveDataProvider('Msg',array(
			'pagination'=>array(
				'pageSize'=>20,
			),
			'criteria'=>$criteria,
		));
        $this->render('sendBox',array(
			'dataProvider'=>$dataProvider,
		));
    }
    public function actionReceiveBox(){
		$userId=Yii::app()->user->id;
        //收件箱
		$criteria=new CDbCriteria(array(
			'condition'=>'msg_revid=:userId and msg_revdel=:revdel',
            'params'=>array(":userId"=>$userId,":revdel"=>Msg::$del['undel']),
			'order'=>'msg_time DESC',
		));
		$dataProvider=new CActiveDataProvider('Msg',array(
			'pagination'=>array(
				'pageSize'=>20,
			),
			'criteria'=>$criteria,
		));
        $this->render('receiveBox',array(
			'dataProvider'=>$dataProvider,
		));
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		$userId=Yii::app()->user->id;
		if($this->_model===null)
		{
			if(isset($_GET['id']))
			{
				$this->_model=Msg::model()->findbyPk($_GET['id']);
				if($userId!==$this->_model->msg_sendid && $userId !== $this->_model->msg_revid)
				{
					throw new CHttpException(400,'您无权查看他人信件');
				}
				if($userId == $this->_model->msg_revid && $this->_model->msg_isread == Msg::$readstatu['unread'])
				{
                    $this->_model->msg_isread = Msg::$readstatu['read'];
					//标记已读
                    $this->_model->update();
				}
			}
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='msg-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
