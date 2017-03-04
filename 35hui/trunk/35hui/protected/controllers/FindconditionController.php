<?php

class FindconditionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/personal';

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('ajaxAddCondition'),
				'users'=>array('*'),
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
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
				$this->_model=Findcondition::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}


    public function actionAjaxAddCondition()
	{
        $resultInt = 0;
        $userId = Yii::app()->user->id;
        if($userId==""){//请先登录
            echo "4";exit;
        }
        $va = va();
        $va->check(array(
            'condition'=>array('not_blank'),
            'officeType'=>array('not_blank',array('uint_length', 1, 6)),
            'rentorsell'=>array('not_blank',array('uint_length', 1, 2)),
        ));
        if($va->success){
            $userRole = User::model()->getCurrentRole();
            if($userRole==User::personal){//用户身份正确
                $condition = json_decode(urldecode($va->valid['condition']),true);
                if(is_array($condition)){//是一个合法的array
                    $model = new Findcondition();
                    $dba = dba();
                    $model->fc_id = $dba->id('35_findcondition');//原来是个人用户id，但是为了以后扩展方便。统一把这个id变成user_id(戴朝清)
                    $model->fc_puserid = $userId;
                    $model->fc_officetype = $va->valid['officeType'];
                    $model->fc_rentorsell = $va->valid['rentorsell'];
                    $model->fc_conditionstr = urldecode($va->valid['condition']);
                    $model->fc_recordtime = time();
                    if($model->save()){
                        $resultInt = 3;//保存成功
                    }
                }else{//协议不合法
                    $resultInt = 2;
                }
            }else{//身份不正确
                $resultInt = 1;
            }
        }
        echo $resultInt;
	}
   
}
