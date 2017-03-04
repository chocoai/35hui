<?php

class OrderrefreshschemeController extends Controller
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
				'actions'=>array("index"),
				 'roles'=>array(
                    Yii::app()->params['agent'],
                ),
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
	public function create()
	{
        $userId = Yii::app()->user->id;
        $maxSaveNum = 5;//一个用户最多可以保存的方案数
        
        if($_POST){
            $hourSelectArr = $_POST['hourSelect'];
            $minuteSelect = $_POST['minuteSelect'];
            $schemeName = $_POST['schemeName'];
            $schemeId = $_POST['schemeId'];
            
            $schemeTime = array();
            foreach($hourSelectArr as $key=>$value){
                $hour = $minute = "";
                $hour = $hourSelectArr[$key] != -1?$hourSelectArr[$key]:"";
                $minute = $minuteSelect[$key] != -1?$minuteSelect[$key]:"";
                if($hour!=""&&$minute!=""){//如果小时和分钟都选择了。
                    $schemeTime[] = $hour.$minute;
                }
            }
            if($schemeTime){//可以保存数据
                //判断是增加还是修改。
                if($schemeId!=""){//修改
                    $model = Orderrefreshscheme::model()->findByPk($schemeId);
                    if($model&&$model->ors_userid==$userId){
                        $model->ors_schemename = $schemeName;
                        $model->ors_schemetime = serialize($schemeTime);
                        $model->update();
                    }
                }else{//增加
                    $num = Orderrefreshscheme::model()->count("ors_userid=:ors_userid",array("ors_userid"=>$userId));
                    if($num<$maxSaveNum){
                        $model=new Orderrefreshscheme;
                        $model->ors_userid = $userId;
                        $model->ors_schemename = $schemeName;
                        $model->ors_schemetime = serialize($schemeTime);
                        $model->save();
                    }
                }
            }
        }
	}


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        //通过登录用户的角色，来判断要进入的页面
        $userId = Yii::app()->user->id;
        if($_POST){
            $this->create();
            $this->redirect(array("index"));
        }
        $schemes = Orderrefreshscheme::model()->getAllSchemeByUserId($userId);
		$this->render('index',array(
            'schemes'=>$schemes,
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
				$this->_model=Orderrefreshscheme::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='orderrefreshscheme-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
