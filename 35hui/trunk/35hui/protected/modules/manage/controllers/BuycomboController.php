<?php

class BuycomboController extends Controller
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
				'actions'=>array('index'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        //通过登录用户的角色，来判断要进入的页面
        $userId = Yii::app()->user->id;
        $allNum1 = Uagent::model()->getAllOperateNum($userId, 1);
        $allNum2 = Uagent::model()->getAllOperateNum($userId, 2);
        $allNum3 = Uagent::model()->getAllOperateNum($userId, 3);
        $allNum = array($allNum1, $allNum2, $allNum3);

        $model = Uagent::model()->findByAttributes(array("ua_uid"=>$userId));
        $comboModel = Uagent::model()->getAgentCombo($model);//经纪人购买的套餐
        
        $combo = Combo::model()->findAll();


		$this->render('index',array(
            "allNum"=>$allNum,
            "combo"=>$combo,
            'userId'=>$userId,
            "model"=>$model,
            "comboModel"=>$comboModel,
		));
	}
    public function actionUpgrade(){
//        $grade = isset($_GET['grade'])?(int)$_GET['grade']:0;
//        if(!in_array((string)$grade,array('1','2','3')))
//            exit('很抱歉，您还不能执行此次升级！');
//        $userId = Yii::app()->user->id;
//        $time = time();
//        //$ckeck = Buycombo::model()->checkUserCanBuyCombo($userId, $comboId);
//        $ckeck = User::model()->checkUserCanUpGrade();
//        if($ckeck!="success"){//不可以购买
//            $str = "很抱歉，您还不能执行此次升级！";
//            $ckeck=="4"?$str="个人用户不能升级！":"";
//            $ckeck=="5"?$str="请先完成公司认证在执行此操作！":"";
//            $ckeck=="6"?$str="请先完成身份认证和名片认证在执行此操作！":"";
//            echo $str;
//            exit;
//        }
//        //判断新币是否足够
//        $comboModel = Combo::model()->findByAttributes(array('cb_userlevel'=>$grade));
//        if(empty($comboModel)) exit('很抱歉，您还不能执行此次升级！');
//        $needMoney = $comboModel->cb_comboprice;//需要的新币
//        $giveintegral = $comboModel->cb_giveintegral;//赠送的积分
//        if(Userproperty::model()->deductMoney($userId, $needMoney, "功能升级成功，扣除{:money}新币")){
//            Userproperty::model()->addPoint($userId, $giveintegral, "功能升级成功，赠送{:point}积分");
//            //往购买表中增加数据
//            if(($_mode=User::model()->findByPk($userId))){
//                $_mode->user_grade=$grade;
//                $_mode->update();
//            }
//            echo "success";
//            exit;
//        }else{
//            echo "很抱歉，您的新币不足，购买失败！";
//            exit;
//        }
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
				$this->_model=Buycombo::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='buycombo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
