<?php

class FriendlinkController extends Controller
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
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $this->pageTitle = "友情链接-新地标";
        $this->layout = "help";
        $criteria=new CDbCriteria;
        $criteria->addCondition("fl_type!=0");
        $criteria->order = "fl_type,fl_order";
        $model = Friendlink::model()->findAll($criteria);
        $allFriendLink = array();
        foreach($model as $value){
            $allFriendLink[$value->fl_type][] = $value;
        }
		$this->render('index',array(
			'allFriendLink'=>$allFriendLink,
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
				$this->_model=Friendlink::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='friendlink-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
