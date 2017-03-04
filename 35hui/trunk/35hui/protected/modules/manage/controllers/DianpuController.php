<?php

class DianpuController extends Controller
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
				'actions'=>array("gonggao"),
				'roles'=>array(
                    Yii::app()->params['agent'],
                ),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    public function actionGongGao(){
        $usrid=Yii::app()->user->id;
		
		$uagent=Uagent::model()->find('ua_uid='.$usrid);
		if(isset($_POST['Uagent']))
		{
			$uagent->attributes = $_POST['Uagent'];
			 if($uagent->validate()){
			 	$uagent->save();
                Yii::app()->user->setFlash('message','修改经纪人公告成功！');
			 }
		}
		$this->render('gonggao',array(
			'model'=>$uagent,
		));
    }

}
