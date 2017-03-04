<?php

class BuildcollectController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='frame';

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
				'actions'=>array('create',"ajaxcheckbuildname"),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        Yii::import('application.common.*');
        $userId = Yii::app()->user->id;
		$model=new Buildcollect;
        $districtlist = Region::model()->findAllByAttributes(array('re_parent_id'=>35));
        //显示内外环
        $loopRecord = Searchcondition::model()->findAllByAttributes(array('sc_parentid'=>Searchcondition::loopTypeId));
        foreach($loopRecord as $record){
            $allLoop[$record->sc_minvalue]=$record->sc_title;
        }
		if(isset($_POST['Buildcollect']))
		{
            $model->attributes=$_POST['Buildcollect'];
            $model->bc_userid = $userId;
            $model->bc_province = 9;
            $model->bc_city = 35;
            $model->bc_releasetime = time();
            if($model->validate()&&!Buildcollect::model()->checkBuildExist($model->bc_buildname)){
                $systemModel = new Systembuildinginfo;
                $systemModel->sbi_buildingname = $_POST['Buildcollect']['bc_buildname'];
                $systemModel->sbi_address = $_POST['Buildcollect']['bc_buildaddress'];
                $systemModel->sbi_province = 9;
                $systemModel->sbi_city = 35;
                $systemModel->sbi_district = $_POST['Buildcollect']['bc_district'];
                $systemModel->sbi_section = $_POST['Buildcollect']['bc_section'];
                $systemModel->sbi_loop = $_POST['Buildcollect']['bc_loop'];
                $systemModel->sbi_propertyprice = 0;
                $systemModel->sbi_openingtime = 0;
                $systemModel->sbi_avgrentprice = 0;
                $systemModel->sbi_avgsellprice = 0;

                

                $systemModel->sbi_x = $_POST['sbi_x'];
                $systemModel->sbi_y = $_POST['sbi_y'];
                $systemModel->sbi_recordtime = time();

                //计算拼音缩写
                $pinyin = new Pinyin;
                $pinYinArray = $pinyin->doWord(trim($systemModel->sbi_buildingname));
                $systemModel->sbi_pinyinshortname = $pinYinArray['short'];
                $systemModel->sbi_pinyinlongname = $pinYinArray['long'];
                
                if($systemModel->save()){
                    $buildId = $systemModel->sbi_buildingid;
                    $dba = dba();
                    $model->bc_id = $dba->id("35_bargindata");
                    $model->bc_sysid = $buildId;
                    if($model->save()){
                        echo "<script>window.parent.getOtherBuildInfo(".$buildId.")</script>";
                        exit;
                    }
                }
            }
		}
		$this->render('create',array(
			'model'=>$model,
            'districtlist'=>$districtlist,
            'allLoop'=>$allLoop,
		));
	}
    public function actionAjaxCheckBuildName(){
        if(isset($_POST['buildName'])&&$_POST['buildName']!=""){
            if(!Buildcollect::model()->checkBuildExist($_POST['buildName'])){
                echo "1";//可以使用
                exit;
            }
        }
        echo "2";//不可以使用
        exit;
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
				$this->_model=Buildcollect::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='buildcollect-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
