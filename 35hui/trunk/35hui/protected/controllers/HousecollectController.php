<?php

class HousecollectController extends Controller
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
				'actions'=>array('ajaxAddCollect'),
				'users'=>array('*'),
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    public function actionAjaxAddCollect(){
        $userId = Yii::app()->user->id;
        /*
         * 1 身份不正确
         * 2 收藏成功
         * 3 已经收藏过了
         */
        $resultInt = 0;
        $va = va();
        $va->check(array(
            'presentId'=>array('not_blank','uint'),
            'officeType'=>array('not_blank',array('eq', 1, 2, 3, 4, 5, 6)),
            'rentorsell'=>array('not_blank',array('uint_length', 0, 2)),
        ));
        if($va->success){
            $userRole = User::model()->getCurrentRole();
            if($userRole==User::personal){//用户身份正确
                $model = new Housecollect();
                $hasCollect = $model->find('hc_puserid=:puserId and hc_presentid=:officeId and hc_officetype=:officeType and hc_rentorsell=:rentorsell',array(
                                ':puserId'=>$userId,
                                ':officeId'=>$va->valid['presentId'],
                                ':officeType'=>$va->valid['officeType'],
                                ':rentorsell'=>$va->valid['rentorsell'],
                            ));
                if($hasCollect!=true){
                    $dba = dba();
                    $model->hc_id = $dba->id('35_housecollect');
                    $model->hc_puserid = $userId;//原来是个人用户id，但是为了以后扩展方便。统一把这个id变成user_id(戴朝清)
                    $model->hc_presentid = $va->valid['presentId'];
                    $model->hc_officetype = $va->valid['officeType'];
                    $model->hc_rentorsell = $va->valid['rentorsell'];
                    $model->hc_recordtime = time();
                    if($model->save()){
                        $resultInt = 2;
                    }
                }else{//已经收藏过了
                    $resultInt = 3;
                }
            }else if($userRole==User::agent){
                $resultInt = 4;//经纪人
            }else{//身份不正确
                $resultInt = 1;
            }
        }
        echo $resultInt;
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
				$this->_model=Housecollect::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='housecollect-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
