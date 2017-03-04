<?php

class CreativecollectController extends Controller
{
    public $layout='frame';
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
		$model = new Creativecollect;
        $districtlist = Region::model()->findAllByAttributes(array('re_parent_id'=>35));
        
		if(isset($_POST['Creativecollect']))
		{
            $model->attributes=$_POST['Creativecollect'];
            $model->cc_userid = $userId;
            $model->cc_releasetime = time();
            $model->cc_name = trim($model->cc_name);
            if($model->validate()&&!Creativecollect::model()->checkBuildExist($model->cc_name)){
                $systemModel = new Creativeparkbaseinfo;
                $systemModel->cp_name = $model->cc_name;
                $systemModel->cp_address = $model->cc_address;
                $systemModel->cp_district = $model->cc_district;
                
                $systemModel->cp_propertyprice = 0;
                $systemModel->cp_openingtime = 0;
                $systemModel->cp_avgrentprice = 0;


                $systemModel->cp_x = "121.47536873817444";//默认位置
                $systemModel->cp_y = "31.232857675162947";
                $systemModel->cp_releasedate = time();

                //计算拼音缩写
                $pinyin = new Pinyin;
                $pinYinArray = $pinyin->doWord(trim($systemModel->cp_name));
                $systemModel->cp_pinyinshortname = $pinYinArray['short'];
                $systemModel->cp_pinyinlongname = $pinYinArray['long'];

                if($systemModel->save()){
                    $model->cc_cpid = $systemModel->cp_id;
                    if($model->save()){
                        echo "<script>window.parent.getOtherBuildInfo(".$model->cc_cpid.")</script>";
                        exit;
                    }
                }
            }
		}
		$this->render('create',array(
			'model'=>$model,
            'districtlist'=>$districtlist,
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
}