<?php

class ProductgridController extends Controller
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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('uagent'),
				'roles'=>array(
                    Yii::app()->params['agent'],
                ),
			),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('company'),
				'roles'=>array(
                    Yii::app()->params['company'],
                ),
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
        $criteria=new CDbCriteria();
        $criteria->addColumnCondition(array("p_index"=>1));
        $criteria->addInCondition("p_positiontype",array(1, 2, 9));//用户后台只能显示写字楼,商铺和住宅

        $dataProvider=new CActiveDataProvider('Productgrid', array(
            'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>10,
			),
		));
        //通过登录用户的角色，来判断要进入的页面
        $usrid = Yii::app()->user->id;
        $role = User::model()->getCurrentRole();
        
		$this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
	}
    /**
     * 经纪人推荐
     */
    public function actionUagent() {
        $criteria=new CDbCriteria();
        $criteria->addColumnCondition(array("p_index"=>1,"p_positiontype"=>3));

        $dataProvider=new CActiveDataProvider('Productgrid', array(
            'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>10,
			),
		));
        //通过登录用户的角色，来判断要进入的页面
        $usrid = Yii::app()->user->id;
		$this->render('uagent',array(
            'dataProvider'=>$dataProvider,
        ));
	}
    /**
     * 中介公司推荐
     */
    public function actionCompany() {
        $criteria=new CDbCriteria();
        $criteria->addColumnCondition(array("p_index"=>1,"p_positiontype"=>4));

        $dataProvider=new CActiveDataProvider('Productgrid', array(
            'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>10,
			),
		));
        //通过登录用户的角色，来判断要进入的页面
        $usrid = Yii::app()->user->id;
		$this->render('company',array(
            'dataProvider'=>$dataProvider,
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
				$this->_model=Productgrid::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='productgrid-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
