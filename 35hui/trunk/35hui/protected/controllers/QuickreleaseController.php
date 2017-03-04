<?php
class QuickreleaseController extends Controller
{
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xE4E8EB,
                'maxLength'=>'6',
              	'minLength'=>'4',
                'testLimit'=>'3',//三次之后更新验证码
            ),
        );
    }


    public function actionIndex(){
        $this->layout='office';
        $this->pageTitle = '专业房产经纪人全程接管 业主委托_新地标';
        $model=new Quickrelease;
        $ownerBuild = '';
        if(isset($_POST['Quickrelease'])){
			$model->attributes=$_POST['Quickrelease'];
            $model->qrl_timestamp = time();
            $ownerBuild = trim($_POST['buidname']);
            if(!$model->qrl_sysid && $ownerBuild){
                $_t = Systembuildinginfo::model()->findByAttributes(array('sbi_buildingname'=>$ownerBuild,'sbi_buildtype'=>1));
                if($_t)
                    $model->qrl_sysid = $_t->sbi_buildingid;
            }
            if($model->save()){
                Yii::app()->user->setFlash('showMessage','showMessage');
                $this->refresh();
            }
		}elseif(isset($_GET['office'])){
            $_model = Systembuildinginfo::model()->findByPk($_GET['office']);
            if($_model){
                $model->qrl_sysid = $_model->sbi_buildingid;
                $ownerBuild = trim($_model->sbi_buildingname);
            }
        }
        $this->render('index',array(
            'model'=>$model,
            'ownerBuild'=>$ownerBuild,
        ));
    }


    /**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='quickrelease-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
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
				$this->_model=Quickrelease::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
}
