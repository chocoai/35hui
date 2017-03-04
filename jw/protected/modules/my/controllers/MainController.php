<?php
class MainController extends Controller
{
    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'roles'=>array(
                    User::ROLE_MEMBER,
                    User::ROLE_AUDIENCE
                ),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    public function actionIndex()
    {
        $userId = User::model()->getId();
        $model = User::model()->getUserInfoById($userId);
        $memberModel = Member::model()->findByAttributes(array("mem_userid"=>$model->u_id));
        $this->render('index',array(
            "model"=>$model,
            "memberModel"=>$memberModel
        ));
    }
    
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if( ($error=Yii::app()->errorHandler->error) ) {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }else{
             $this->render('error');
        }
    }
}