<?php

class MsgController extends Controller
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
	public function actionCreate()
	{
        $va=va();
        $va->check(array(
            'toUserId'=>array('not_blank','uint')
        ));
        if($va->success){
            $model=new Msg;
            $model->msg_revid = $va->valid['toUserId'];
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['Msg']))
            {
                $model->attributes=$_POST['Msg'];
                $model->msg_sendid = 0;//0代表系统管理员
                $model->msg_type = Msg::$msgtype['normal'];
                $model->msg_time = time();
                $model->msg_senddel = Msg::$del['undel'];
                $model->msg_revdel = Msg::$del['undel'];
                $model->msg_isread = Msg::$readstatu['unread'];
                if($model->msg_revid==0){
                    Yii::app()->user->setFlash('sendState','不能给自己发送站内信');
                    $this->redirect(array('msg/index'));
                }else{
                    if($model->save()){
                        Yii::app()->user->setFlash('sendState','站内信发送成功');
                        $this->redirect(array('view','id'=>$model->msg_id));
                    }
                }
            }

            $this->render('create',array(
                'model'=>$model,
            ));
        }else{
			throw new CHttpException(400,'错误的页面,请不要再访问此链接.');
        }
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
        $criteria=new CDbCriteria;
        $criteria->order="msg_id desc";
        if(isset($_GET["type"])&&$_GET["type"]){
            if($_GET["type"]=="manage"){ $criteria->condition="msg_revid=0";}
        }
        
        //$criteria->condition="msg_sendid=0";
        $dataProvider=new CActiveDataProvider('Msg', array(
                        'pagination'=>array(
                                'pageSize'=>10,
                        ),
                        'criteria'=>$criteria,
        ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Msg('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Msg']))
			$model->attributes=$_GET['Msg'];

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
				$this->_model=Msg::model()->findbyPk($_GET['id']);
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
