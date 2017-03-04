<?php

class SystemmessageController extends Controller
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
                    User::ROLE_AUDIENCE,
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
        $criteria=new CDbCriteria();
        $criteria->addColumnCondition(array("sm_userid"=>$userId));
        $criteria->order = "sm_createtime desc";
        $dataProvider =  new CActiveDataProvider("Systemmessage", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>20,
                        ),

        ));
        $this->render("index",array(
                "dataProvider"=>$dataProvider,
        ));
	}
    public function actionDel() {
        if(isset($_POST["id"])&&$_POST["id"]) {
            $userId = User::model()->getId();
            $criteria=new CDbCriteria;
            $criteria->addInCondition("sm_id",$_POST["id"]);
            $criteria->addColumnCondition(array("sm_userid"=>$userId));
            Systemmessage::model()->deleteAll($criteria);
        }
        $this->redirect("index");
    }
}