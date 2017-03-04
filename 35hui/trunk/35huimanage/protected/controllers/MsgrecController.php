<?php

class MsgrecController extends Controller
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
        $model = $this->loadModel();
        if($_POST){
            $userId = $model->mr_sendid;
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
            }elseif($type==3){
                if($money){
                    $logDescription = $message."{:money}商务币";
                    Userproperty::model()->addMoney($userId, $money, $logDescription);
                    Yii::app()->user->setFlash('message1',$message.$money."商务币。");
                }
            }
            $mr_replay=$_POST['mr_replay'];
            $model->mr_replay=$_POST['mr_replay'];
            $model->mr_rtime=time();
           if($model->save())
            Yii::app()->user->setFlash('message','处理成功！');
            Yii::app()->user->setFlash('reply',$mr_replay);
            $this->refresh();
        }else{
            $model->mr_isread=1;
            $model->save();
        }
        $this->render('view',array(
            'model'=>$model,
        ));
    }


    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $criteria = new CDbCriteria;
        $criteria->order = 'mr_id desc';
        $status=empty($_POST['status'])?empty($_GET['status'])?'':$_GET['status']:$_POST['status'];
        if($status){
            $_GET['status']=$status;
            if($status==1){
                $criteria->condition='mr_replay=""';
            }else{
                $criteria->condition='mr_replay!=""';
            }
        }
		$dataProvider=new CActiveDataProvider('Msgrec',array(
            'criteria'=>$criteria,
        ));
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
            'status'=>$status,
        ));
    }

    public function actionAdmin()
	{
		$model=new Msgrec('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Msgrec']))
			$model->attributes=$_GET['Msgrec'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

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
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel()
    {
        if($this->_model===null)
        {
            if(isset($_GET['id']))
                $this->_model=Msgrec::model()->findbyPk($_GET['id']);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='msgrec-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
