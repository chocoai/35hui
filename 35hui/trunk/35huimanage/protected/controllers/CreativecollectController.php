<?php

class CreativecollectController extends Controller
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
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("cc_state"=>0));
		$dataProvider=new CActiveDataProvider('Creativecollect',array(
            'criteria'=>$criteria,
        ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$model=$this->loadModel();
		$this->render('view',array(
			'model'=>$model,
		));
	}
    public function actionAudit(){
        $type = $_GET['type'];
        $model = $this->loadModel();
        if($model&&$model->cc_state==0){//只有未审核状态才能审核
            if($type=="pass"){//审核通过
                $model->cc_state = 1;
                $model->update();
                $this->redirect(array('/creativeparkbaseinfo/update','id'=>$model->cc_cpid));//systembuildinginfo/update/id/1325
            }elseif($type=="unpass"){//审核不通过
                $model->cc_state = 2;
                $model->update();
                //删除创意园表数据
                $sysmodel = Creativeparkbaseinfo::model()->findByPk($model->cc_cpid);
                if($sysmodel){
                    $sysmodel->delete();
                }
            }
        }
        $this->Redirect(array("index"));
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
				$this->_model=Creativecollect::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='creativecollect-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
