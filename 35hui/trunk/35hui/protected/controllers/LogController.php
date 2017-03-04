<?php

class LogController extends Controller
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
				'actions'=>array('ajaxClearLog'),
				'users'=>array('@'),//所有登录用户都可以删除
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    public function actionAjaxClearLog(){
        $reInt = 2;
        $va = va();
        $va->check(array(
            'type'=>array('not_blank',array('eq',Log::integral,Log::money))
        ));
        if($va->success){
            if(Yii::app()->user->isGuest){
                $reInt=3;//未登录
            }else{
                $deleteCount = Log::model()->deleteAllByAttributes(
                    array(
                        'lg_userid'=>Yii::app()->user->id,
                        'lg_type'=>$va->valid['type']
                    )
                );
                if($deleteCount>0)
                    $reInt=1;
            }
        }
        echo $reInt;
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
				$this->_model=Log::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='log-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
