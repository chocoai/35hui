<?php

class MsgController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to 'column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='main';

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
				'actions'=>array('sendBoxIndex','receiveBoxIndex','create','delete','view'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    protected function setLayoutByUserRole(){
        $layout="";
        $userRole = User::model()->getCurrentRole();
        if($userRole==User::personal){
            $layout ="//layouts/personal";
        }elseif($userRole==User::agent){
            $layout ="uagent";
        }elseif($userRole==User::company){
            $layout ="ucom";
        }
        if($layout!="")
            $this->layout=$layout;
    }
	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
        $this->setLayoutByUserRole();
		$this->render('view',array(
			'model'=>$this->loadModel(),
            'menu'=>@$_GET['menu'],
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $result = array('result'=>false,'warning'=>'');
        $va = va();
        $va->check(array(
            'toUserId'=>array('not_blank','uint'),
            'title'=>array('not_blank'),
            'content'=>array('not_blank'),
        ));
        if($va->success){
            $model=new Msg;
            if($va->valid['toUserId'] == Yii::app()->user->id)
            {
                $result['warning'] ="不能给自己发送站内信.";
            }else{
                $msgId = Msg::model()->sendMessage(Yii::app()->user->id,$va->valid['toUserId'],$va->valid['title'],$va->valid['content']);
                if($msgId!==false){
                    $result['result'] =true;
                    $result['warning'] ="站内信发送成功.";
                }else{
                    $result['warning'] ="站内信发送失败.";
                }
            }
        }else{
            $result['warning'] ="参数错误,发送站内信失败.";
        }
        echo json_encode($result);
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
            $model = $this->loadModel();
            if($userId==$model->msg_sendid){
                $model->msg_senddel = Msg::$del['del'];
                $model->update();
            }elseif($userId == $model->msg_revid){
                $model->msg_revdel = Msg::$del['del'];
                $model->update();
            }
            header('Location:'.$_SERVER['HTTP_REFERER']);
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
    public function actionSendBoxIndex(){
        $this->setLayoutByUserRole();
		$userId=Yii::app()->user->id;
        //发件箱
		$criteria=new CDbCriteria(array(
			'condition'=>'msg_sendid=:userId and msg_senddel=:senddel',
            'params'=>array(":userId"=>$userId,":senddel"=>Msg::$del['undel']),
			'order'=>'msg_time DESC',
		));
		$sendlist=new CActiveDataProvider('Msg',array(
			'pagination'=>array(
				'pageSize'=>20,
			),
			'criteria'=>$criteria,
		));
        $this->render('sendBoxIndex',array(
			'sendProvider'=>$sendlist,
            'menu'=>@$_GET['menu'],
		));
    }
    public function actionReceiveBoxIndex(){
        $this->setLayoutByUserRole();
		$userId=Yii::app()->user->id;
        //收件箱
		$criteria=new CDbCriteria(array(
			'condition'=>'msg_revid=:userId and msg_revdel=:revdel',
            'params'=>array(":userId"=>$userId,":revdel"=>Msg::$del['undel']),
			'order'=>'msg_time DESC',
		));
		$revlist=new CActiveDataProvider('Msg',array(
			'pagination'=>array(
				'pageSize'=>20,
			),
			'criteria'=>$criteria,
		));
        $this->render('receiveBoxIndex',array(
			'receiveProvider'=>$revlist,
            'menu'=>@$_GET['menu'],
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
