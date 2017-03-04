<?php

class SourceorderrefreshController extends Controller
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
				'actions'=>array('view','create','delete'),
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
	 * Displays a particular model.
	 */
	public function actionView()
	{
        $sourceId = $_GET['sourceid'];//选择的房源
        $type = $_GET['type'];//选择的房源类型
        
        //通过登录用户的角色，来判断要进入的页面
        $usrid = Yii::app()->user->id;

        $sourceType="";
        $type=="office"?$sourceType="1":"";
        $type=="shop"?$sourceType="2":"";
        $type=="residence"?$sourceType="3":"";
        $type=="creative"?$sourceType="4":"";
        if($sourceType!=""){
            $sourceOrderRefresh = Sourceorderrefresh::model()->findAllByAttributes(array("sor_sourceid"=>$sourceId,"sor_sourcetype"=>$sourceType));
            switch($sourceType){
                default:
                    $title=$url="";
                    break;
                case 1:
                    $sourceModel = Officebaseinfo::model()->findByPk($sourceId);
                    $title = @$sourceModel->buildingInfo->sbi_buildingname;
                    $url = "/officebaseinfo/view";
                    break;
                case 2:
                    $sourceModel = Shoppresentinfo::model()->findByAttributes(array("sp_shopid"=>$sourceId));
                    $title = $sourceModel->sp_shoptitle;
                    $url = "/shop/view";
                    break;
                case 3:
                    $sourceModel = Residencebaseinfo::model()->findByAttributes(array("rbi_id"=>$sourceId));
                    $title = $sourceModel->rbi_title;
                    $url = "/communitybaseinfo/viewResidence";
                    break;
                case 4:
                    $sourceModel = Creativesource::model()->findByPk($sourceId);
                    $title = @$sourceModel->parkbaseinfo->cp_name;
                    $url = "/creativesource/view";
                    break;
            }
            $this->render('view',array(
                'sourceOrderRefresh'=>$sourceOrderRefresh,
                'title'=>$title,
                'url'=>$url,
                'sourceId'=>$sourceId,
            ));
        }
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $userId = Yii::app()->user->id;
        $this->layout = "frame";
        $sourceId = $_GET['sourceid'];//选择的房源
        $type = $_GET['type'];//选择的房源类型
        $sourceType="";
        $type=="office"?$sourceType="1":"";
        $type=="shop"?$sourceType="2":"";
        $type=="residence"?$sourceType="3":"";
        $type=="creative"?$sourceType="4":"";
        if($_POST){//点击确定之后
            $sourceIdArr = explode("_", $sourceId);
            if(count($sourceIdArr)<2){//如果没选择房源。
                echo "<script type='text/javascript'>parent.closeTip()</script>";
                exit;
            }
            
            if($sourceType==""){
                echo "<script type='text/javascript'>parent.closeTip()</script>";
                exit;
            }

            $hourSelectArr = $_POST['hourSelect'];
            $minuteSelect = $_POST['minuteSelect'];
            $days = $_POST['SetDay'];
            $releasetime = time();
            $deadline = Sourceorderrefresh::model()->getDeadLine($days);//获得截止日期
            
            foreach($hourSelectArr as $key=>$value){
                $hour = $minute = "";
                $hour = $hourSelectArr[$key] != -1?$hourSelectArr[$key]:"";
                $minute = $minuteSelect[$key] != -1?$minuteSelect[$key]:"";
                if($hour!=""&&$minute!=""){//如果小时和分钟都选择了。则保存数据
                    foreach($sourceIdArr as $k=>$v){//循环所有选择的房源
                        if($sourceIdArr[$k]){
                            $canSave = false;
                            switch ($sourceType){//判断房源是否属于当前登录用户
                                case 1:
                                    $officeModel = Officebaseinfo::model()->findByPk($sourceIdArr[$k]);
                                    if($officeModel&&$officeModel->ob_uid==$userId){
                                        $canSave = true;
                                    }
                                    break;
                                case 2:
                                    $shopModel = Shopbaseinfo::model()->findByPk($sourceIdArr[$k]);
                                    if($shopModel&&$shopModel->sb_uid==$userId){
                                        $canSave = true;
                                    }
                                    break;
                                case 3:
                                    $residenceModel = Residencebaseinfo::model()->findByPk($sourceIdArr[$k]);
                                    if($residenceModel&&$residenceModel->rbi_uid==$userId){
                                        $canSave = true;
                                    }
                                    break;
                                case 4:
                                    $creativeModel = Creativesource::model()->findByPk($sourceIdArr[$k]);
                                    if($creativeModel&&$creativeModel->cr_userid==$userId){
                                        $canSave = true;
                                    }
                                    break;
                            }
                            if($canSave){
                                
                                $model=new Sourceorderrefresh;
                                $model->sor_ordertime = $hour.$minute;
                                $model->sor_sourceid = $sourceIdArr[$k];
                                $model->sor_sourcetype = $sourceType;
                                $model->sor_releasetime = $releasetime;
                                $model->sor_deadline = $deadline;
                                $model->save();
                            }
                        }
                    }
                }
            }
            echo "<script type='text/javascript'>parent.closeTip(true)</script>";
            exit;
        }
        $role = User::model()->getCurrentRole();
        switch($role) {
            default:
                $this->redirect('/site/login');
                break;
            case User::personal :
                $operateNum = 0;
                break;
            case User::agent :
                $operateNum = Uagent::model()->getAllOperateNum($userId,3);
                break;
        }
        $schemes = Orderrefreshscheme::model()->getAllSchemeByUserId($userId);//用户的预约方案
        $this->render('create',array(
			'sourceId'=>$sourceId,
            'sourceType'=>$sourceType,
            'operateNum'=>$operateNum,
            'schemes'=>$schemes,
		));
	}
	/**
	 * Deletes a particular model.
	 * 取消预约刷新
	 */
	public function actionDelete()
	{
        $userId = Yii::app()->user->id;
        $sourceId = $_POST['sourceId'];
        $sourceArr = array($sourceId);
        $type = $_POST['type'];

        $sourceType="";
        $type=="office"?$sourceType="1":"";
        $type=="shop"?$sourceType="2":"";
        $type=="residence"?$sourceType="3":"";
        $type=="creative"?$sourceType="4":"";

        //如果id是以_链接的，则要分割多个id
        if(preg_match("/_+/",$sourceId)){
            $sourceId = substr($sourceId, 0, strlen($sourceId)-1);
            $sourceArr = explode("_", $sourceId);
        }
        
        switch ($sourceType){
            default:
                break;
            case 1:
                foreach($sourceArr as $value){
                    $officeModel = Officebaseinfo::model()->findByPk($value);
                    if($officeModel&&$officeModel->ob_uid==$userId){
                        Sourceorderrefresh::model()->deleteAllByAttributes(array("sor_sourceid"=>$value,"sor_sourcetype"=>$sourceType));
                    }
                }
                break;
            case 2:
                foreach($sourceArr as $value){
                    $shopModel = Shopbaseinfo::model()->findByPk($value);
                    if($shopModel&&$shopModel->sb_uid==$userId){
                        Sourceorderrefresh::model()->deleteAllByAttributes(array("sor_sourceid"=>$value,"sor_sourcetype"=>$sourceType));
                    }
                }
                break;
            case 3://住宅
                foreach($sourceArr as $value){
                    $residenceModel = Residencebaseinfo::model()->findByPk($value);
                    if($residenceModel&&$residenceModel->rbi_uid==$userId){
                        Sourceorderrefresh::model()->deleteAllByAttributes(array("sor_sourceid"=>$value,"sor_sourcetype"=>$sourceType));
                    }
                }
                break;
            case 4://创意园区
                foreach($sourceArr as $value){
                    $creativeModel = Creativesource::model()->findByPk($value);
                    if($creativeModel&&$creativeModel->cr_userid==$userId){
                        Sourceorderrefresh::model()->deleteAllByAttributes(array("sor_sourceid"=>$value,"sor_sourcetype"=>$sourceType));
                    }
                }
                break;
        }
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
				$this->_model=Sourceorderrefresh::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='sourceorderrefresh-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
