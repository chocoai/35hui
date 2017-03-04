<?php

class MedalController extends Controller
{
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
				'roles'=>array(
                    Yii::app()->params['agent'],
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
        $usrid = Yii::app()->user->id;
        $leftMenu = array('','3_1','1_3','2_3');//发布的$_GET['menu']
        $releaseUrl = Yii::app()->createUrl("/manage/release/rent");
        $Medals[4] = Medal::model()->getUserMedal($usrid, 4);
        $Medals[9] = Medal::model()->getUserMedal($usrid, 9);
        $nextMedals[4] = Medal::model()->getNextMedal(4, $Medals[4]->md_rank);
        $nextMedals[9] = Medal::model()->getNextMedal(9, $Medals[9]->md_rank);
		$this->render('index',array(
            'medals'=>$Medals,
            'nextMedals'=>$nextMedals,
            'releaseUrl'=>$releaseUrl,
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
				$this->_model=Medal::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='medal-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
