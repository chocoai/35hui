<?php

class BuyregionController extends Controller
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
                'actions'=>array('index',"regionframe","updatesource","unrecommend"),
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
        $userId = Yii::app()->user->id;
        //查看是否购买过版块，如果没有，则跳转到帮助页
        $userRegion = Buyregion::model()->getUserRegion($userId);
        if(!$userRegion){
            $this->redirect(array("help/buyregion"));
        }
		$this->render('index',array(
            "userRegion"=>$userRegion,
		));
	}
    /*
     * 页面弹出层
     */
    public function actionRegionFrame(){
        $this->layout='frame';
        $userId = Yii::app()->user->id;
        $id = $_GET["id"];
        
        $model = Buyregion::model()->findByAttributes(array(
            "br_id"=>$id,
            "br_userid"=>$userId,
            "br_status"=>1,
        ));
        if(!$model){
            exit;
        }
        switch ($model->br_sourcetype){
            case 1:
                $type="office";break;
            case 2:
                $type="shop";break;
            case 3:
                $type="residence";break;

        }
        //没有搜索时的房源类型
        $show = array();
        //有搜索，就用搜索中的值
        if(isset($_POST)&&!empty($_POST)){
            $show = $_POST;//post中包含kwd，shopid/officeid，sellorrent，type, section
        }
        //默认值
        $show["sellorrent"] = $model->br_sellorrent;
        $show["section"] = $model->br_regionid;
        if($type == "office"){
            $dataProvider =  Buyregion::model()->getOfficeDataProvider($show);
        }elseif($type == "shop"){
            $dataProvider =  Buyregion::model()->getShopDataProvider($show);
        }else{
            $dataProvider =  Buyregion::model()->getResidenceDataProvider($show);
        }
        $this->render('regionframe',array(
            "model"=>$model,
            'dataProvider'=>$dataProvider,
            'show'=>$show,
            "id"=>$id,
            "type"=>$type,
        ));
    }
    /*
     * 经纪人后台推荐
     */
    public function actionUpdateSource(){
        $indexnum = Buyregion::$maxSetNum;//设置最多能推荐多少个
        $userId = Yii::app()->user->id;
        $sourceId = $_GET["sourceid"];
        $brId = $_GET["id"];
        $model = Buyregion::model()->findByAttributes(array(
            "br_id"=>$brId,
            "br_userid"=>$userId,
            "br_status"=>1,
        ));
        if(!$model){
            exit;
        }
        $allUagent = Ucom::model()->getAllUagentsIdByUcuid($userId);
        $type = $model->br_sourcetype;
        if($type==1){
            //先判断用户是否合法。
            $officeModel = Officebaseinfo::model()->findByPk($sourceId);
            if($officeModel!=""&&array_search($officeModel->ob_uid, $allUagent)!==FALSE){
                //查看现在已经推荐了多少个，如果小于给定值，才能执行推荐。
                $criteria = new CDbCriteria;
                $criteria->addInCondition("ob_uid",$allUagent);
                $criteria->addColumnCondition(array(
                    "ob_section"=>$model->br_regionid,
                    "ob_sellorrent"=>$model->br_sellorrent,
                    "ob_buildingtype"=>3
                ));
                $criteria->with = array(
                    'offictag'=>array(
                        'condition'=>"ot_check=4 and ot_isbuyregion=1",
                    ),
                );
                $homelist = Officebaseinfo::model()->findAll($criteria);
                if (count($homelist)<$indexnum){
                    $model = Officetag::model()->findbyAttributes(array("ot_officeid"=>$sourceId));
                    $model->ot_isbuyregion = 1;
                    if($model->update()){
                        echo 1;exit;
                    }
                }else{
                    echo 0;exit;
                }
            }
        }elseif($type == 2){
            $shopModel = Shopbaseinfo::model()->findByPk($sourceId);
            if($shopModel!=""&&array_search($shopModel->sb_uid, $allUagent)!==FALSE){
                //查看现在已经推荐了多少个，如果小于给定值，才能执行推荐。
                $criteria = new CDbCriteria;
                $criteria->addInCondition("sb_uid",$allUagent);
                $criteria->addColumnCondition(array(
                    "sb_section"=>$model->br_regionid,
                    "sb_sellorrent"=>$model->br_sellorrent,
                ));
                $criteria->with = array(
                    'shopTag'=>array(
                        'condition'=>"st_check=4 and st_isbuyregion=1",
                    ),
                );
                $homelist = Shopbaseinfo::model()->findAll($criteria);
                if (count($homelist)<$indexnum){
                    $model = Shoptag::model()->findbyAttributes(array("st_shopid"=>$sourceId));
                    $model->st_isbuyregion = 1;
                    if($model->update()){
                        echo 1;exit;
                    }
                }else{
                    echo 0;exit;
                }
            }
            
        }else{
            //先判断用户是否合法。
            $residence = Residencebaseinfo::model()->findByPk($sourceId);
            if($residence!=""&&array_search($residence->rbi_uid, $allUagent)!==FALSE){
                //查看现在已经推荐了多少个，如果小于给定值，才能执行推荐。
                $criteria = new CDbCriteria;
                $criteria->addInCondition("rbi_uid",$allUagent);
                $criteria->addColumnCondition(array(
                    "comy_section"=>$model->br_regionid,
                    "rbi_rentorsell"=>$model->br_sellorrent,
                ));
                $criteria->with = array(
                    'residenceTag'=>array(
                        'condition'=>"rt_check=4 and rt_isbuyregion=1",
                    ),"community",
                );
                $homelist = Residencebaseinfo::model()->findAll($criteria);
                if (count($homelist)<$indexnum){
                    $model = Residencetag::model()->findbyAttributes(array("rt_rbiid"=>$sourceId));
                    $model->rt_isbuyregion = 1;
                    if($model->update()){
                        echo 1;exit;
                    }
                }else{
                    echo 0;exit;
                }
            }
        }
    }
    /*
     * 经纪人后台取消推荐
     */
    public function actionUnRecommend(){
        $userId = Yii::app()->user->id;
        $brId = $_GET['brId'];
        $sourceId = $_GET['sourceId'];
        $buyRegionModel = Buyregion::model()->findByPk($brId);
        if(!$buyRegionModel){
            exit();
        }
        $sourceType = $buyRegionModel->br_sourcetype;
        if($sourceType==1){//写字楼
            $model = Officebaseinfo::model()->findByPk($sourceId);
            if($model!=""&&$model->ob_section==$buyRegionModel->br_regionid&&$model->ob_sellorrent==$buyRegionModel->br_sellorrent){
                $tagModel = Officetag::model()->findbyAttributes(array("ot_officeid"=>$sourceId));
                $tagModel->ot_isbuyregion = 0;
                $tagModel->update();
                echo 1;exit;
            }
        }elseif($sourceType==2){
            $model = Shopbaseinfo::model()->findByPk($sourceId);
            if($model!=""&&$model->sb_section==$buyRegionModel->br_regionid&&$model->sb_sellorrent==$buyRegionModel->br_sellorrent){
                $tagModel = Shoptag::model()->findbyAttributes(array("st_shopid"=>$sourceId));
                $tagModel->st_isbuyregion = 0;
                $tagModel->update();
                echo 1;exit;
            }
        }else{
            $model = Residencebaseinfo::model()->findByPk($sourceId);
            if($model!=""&&$model->community->comy_section==$buyRegionModel->br_regionid&&$model->rbi_rentorsell==$buyRegionModel->br_sellorrent){
                $tagModel = Residencetag::model()->findbyAttributes(array("rt_rbiid"=>$sourceId));
                $tagModel->rt_isbuyregion = 0;
                $tagModel->update();
                echo 1;exit;
            }
        }
        exit();
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
				$this->_model=Buyregion::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='buyregion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
