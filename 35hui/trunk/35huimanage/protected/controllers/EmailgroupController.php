<?php

class EmailgroupController extends Controller
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
            $model=new Emailgroup;
            $dataProvider=new CActiveDataProvider('Msgsubscribe');
            if(isset($_POST['Emailgroup'])){
                $to = split(";",$_POST['Emailgroup']['addressee']);
                $emailTitle = $_POST['Emailgroup']['emailtitle'];
                //$emailcontent = '<div style="border: 1px solid rgb(0, 204, 0); width: 700px; font-size: 13px;">';
                $emailcontent = $_POST['Emailgroup']['emailcontent'];
                //$emailcontent .= '</div>';
                for($i=0;$i < count($to);$i++){
                    common::sendMail($to[$i], $emailTitle, $emailcontent);
                }
            }
            $this->render('index',array(
                    'model'=>$model,
                    'dataProvider'=>$dataProvider,
            ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Msg('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Msg']))
			$model->attributes=$_GET['Msg'];

		$this->render('admin',array(
			'model'=>$model,
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
				$this->_model=Msg::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='msg-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
