<?php

class BuyproductController extends Controller
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
				'actions'=>array('index','list','create','choosesource','setsource',"viewsource"),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    public function actionIndex(){
        $usrId = Yii::app()->user->id;
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array(
            "sp_userid"=>$usrId,
            "sp_state"=>0//可用状态
        ));
        $allProduct = Buyproduct::model()->findAll($criteria);
        $this->render('index',array(
            "allProduct"=>$allProduct,
        ));
    }
    /**
     * 当前用户所有已购买的记录
     */
    public function actionList() {
        $usrId = Yii::app()->user->id;
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array(
            "sp_userid"=>$usrId,
        ));
        $criteria->order = "sp_id desc";
        $dataProvider=new CActiveDataProvider('Buyproduct', array(
            'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>20,
			),
		));
        $this->render('list',array(
            "dataProvider"=>$dataProvider,
        ));
    }
	/**
	 * 所有用户都能购买
	 */
	public function actionCreate()
	{
        $p_id = $_POST['id'];
        $p_lastbuydaty = intval($_POST['days']);//购买天数
        $userId = Yii::app()->user->id;
        
        $productgridModel = Productgrid::model()->findByPk($p_id);
        //验证输入天数
        if($p_lastbuydaty>$productgridModel->p_maxbuydays||$p_lastbuydaty<1){
            echo "输入错误";
            exit;
        }
        
        //现验证此位置是否可以购买
        if(in_array($productgridModel->p_positiontype, array(3,4))){//用户类型的判断
            if(Productgrid::model()->checkPositionCanBuyUserType($p_id)!="success") {
                echo "此位置不能购买";
                exit;
            }
        }else{//写字楼类型的判断
            if(!Productgrid::model()->checkPositionCanBuy($p_id)) {
                echo "此位置不能购买";
                exit;
            }
        }
        //如果是只能设置全景的位置，则要判断当前用户是否发布过全景房源
        if($productgridModel->p_position==6){
            //判断是否发布过写字楼全景
            if($productgridModel->p_positiontype==1){
                $checkModel = Officebaseinfo::model()->with("offictag")->find("ob_uid=:ob_uid and ot_ispanorama=:ot_ispanorama",array(":ob_uid"=>$userId,":ot_ispanorama"=>1));
                if(!$checkModel){
                    echo "此模块需要发布过全景房源的用户才能购买，您还未发布过任何全景房源，购买失败！";
                    exit;
                }
            }elseif($productgridModel->p_positiontype==2){//判断是否发布过商铺全景
                $checkModel = Shopbaseinfo::model()->with("shopTag")->find("sb_uid=:sb_uid and st_ispanorama=:st_ispanorama",array(":sb_uid"=>$userId,":st_ispanorama"=>1));
                if(!$checkModel){
                    echo "此模块需要发布过全景房源的用户才能购买，您还未发布过任何全景房源，购买失败！";
                    exit;
                }
            }
        }
        
        
        //验证用户新币是否足够,先扣除新币;
        $needMoney = $productgridModel->p_nowprice*$p_lastbuydaty;
        $logDescription = Log::$moneyTemplate[3];
        if(!Userproperty::model()->deductMoney($userId, $needMoney, $logDescription)){
            echo "很遗憾，此次购买需要花费".$needMoney."新币，您的余额不足，不能购买！";
            exit;
        }
        //全部验证通过，可以购买
        $time = time();
        //把别人购买的设置为不可用状态
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array(
            "sp_positionid"=>$p_id,
            "sp_state"=>0//可用状态
        ));
        $oldModel = Buyproduct::model()->find($criteria);
        //如果有别人购买的还没有过期
        if($oldModel){
            //如果别人的使用时间还没结束，则要退相应的新币
            $expireTime = $oldModel->sp_buytime+$oldModel->sp_buydays*86400;//过期时间
            if($expireTime>$time) {//如果当前时间小于过期时间，则表明此位置是被抢占的。需要给旧的购买用户退还新币
                $remainderDate = $expireTime - $time;//剩余使用时间(秒)
                $remainderDate = ceil($remainderDate/3600);//还剩余的小时数
                $returnPrice = ($oldModel->sp_buyprice/24)*$remainderDate;//退还新币数目
                if($returnPrice){
                    $oldModel->sp_returnprice = $returnPrice;
                    Userproperty::model()->addMoney($oldModel->sp_userid, $returnPrice, "精品位置被抢占，退还{:money}新币");
                }
            }
            $oldModel->sp_cannotusetime = $time;
            $oldModel->sp_state = 1;
            $oldModel->update();
        }
        
        $buyproductModel = new Buyproduct();
        $buyproductModel->sp_positionid = $p_id;
        $buyproductModel->sp_userid = $userId;
        $buyproductModel->sp_buyprice = $productgridModel->p_nowprice;
        $buyproductModel->sp_buydays = $p_lastbuydaty;
        $buyproductModel->sp_buytime = $time;
        
        //如果位置是用户类型，则要同时把用户加进去。并查看位置是否有过期的，有则要变成不可用状态
        if(in_array($productgridModel->p_positiontype, array(3,4))){
            $buyproductModel->sp_sourceid = $userId;
            Buyproduct::model()->changeTypeToUnUsedByPageAndPosition($productgridModel->p_page, $productgridModel->p_position);
        }

        //修改精品配置表中的最后购买时间和当前价格
        $productgridModel->p_nowprice = intval($productgridModel->p_baseprice*$productgridModel->p_raisespercent)+$productgridModel->p_nowprice;//修改涨价后的价格
        $productgridModel->p_lastbuytime = $time;
        $productgridModel->p_lastbuydatys = $p_lastbuydaty;
        if($buyproductModel->save()&&$productgridModel->update()){
            echo "success";
        }else{
            echo "系统内部错误，购买失败！";
        }
        exit;
	}
    public function actionChooseSource(){
        $this->layout = "frame";
        $userId = Yii::app()->user->id;
        $model = $this->loadModel();
        //判断只能是自己购买的位置才能操作
        if($model->sp_userid!=$userId){
            throw new CHttpException(404,'The requested page does not exist.');
        }
        $positiontype = $model->productgrid->p_positiontype;//位置类型

        //得到用户发布的所有房源
        $show = array();
        if($positiontype==1){//写字楼
            $type = "office";
            $criteria=new CDbCriteria();
            $criteria->with = array("offictag","presentInfo");
            $criteria->addColumnCondition(array(
                "ob_uid"=>$userId,
                "ot_check"=>4,
            ));
            if(isset($_POST['name'])&&$_POST['name']!="") {
                $criteria->addSearchCondition("ob_officename",$_POST['name']);
                $show['name'] = $_POST['name'];
            }
            if(isset($_POST['title'])&&$_POST['title']!="") {
                $criteria->addSearchCondition("op_officetitle",$_POST['title']);
                $show['title'] = $_POST['title'];
            }
            $className = "Officebaseinfo";
        }else if($positiontype==2){//商铺
            $type = "shop";
            $criteria=new CDbCriteria();
            $criteria->with = array("shopTag","presentInfo");
            $criteria->addColumnCondition(array(
                "sb_uid"=>$userId,
                "st_check"=>4,
            ));
            if(isset($_POST['title'])&&$_POST['title']!="") {
                $criteria->addSearchCondition("sp_shoptitle",$_POST['title']);
                $show['title'] = $_POST['title'];
            }
            $className = "Shopbaseinfo";
        }else if($positiontype==9){//住宅
            $type = "residence";
            $criteria=new CDbCriteria();
            $criteria->with = array("residenceTag","community");
            $criteria->addColumnCondition(array(
                "rbi_uid"=>$userId,
                "rt_check"=>4,
            ));
            if(isset($_POST['title'])&&$_POST['title']!="") {
                $criteria->addSearchCondition("rbi_title",$_POST['title']);
                $show['title'] = $_POST['title'];
            }
            $className = "Residencebaseinfo";
        }else{
            throw new CHttpException(404,'The requested page does not exist.');
        }
        $dataProvider=new CActiveDataProvider($className, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>15,
            ),
        ));
        $this->render('choosesource',array(
            'dataProvider'=>$dataProvider,
            'type'=>$type,
            "show"=>$show,
            'id'=>$_GET['id'],
        ));
    }

	/**
	 * 暂时只提供了房源精品的修改
	 */
	public function actionSetSource()
	{
		$model = $this->loadModel();
        $sourceid =$_GET['sourceid'];//要显示的资源id
        $userId = Yii::app()->user->id;
        //先判断格子是否属于当前用户。
        if($model->sp_userid!=$userId){
            echo "禁止操作！";
            exit;
        }

        switch ($model->productgrid->p_positiontype){
            default:
                break;
            case 1: //写字楼
                $officeModel = Officebaseinfo::model()->findByPk($sourceid);
                //如果是只能设置全景的位置，则要判断要设置的房源是否是全景房源
                if($model->productgrid->p_position==6&&$officeModel->offictag->ot_ispanorama!=1){
                    echo "此模块只能设置全景房源，请选择其他房源";
                    exit;
                }
                if($this->isHaveSeted($userId, $sourceid, $model)){
                    echo "该全景房源已经设置过了，请选择其他房源";
                    exit;
                }
                if($officeModel&&$officeModel->ob_uid==$userId){//新数据也是可用的数据
                    $model->sp_sourceid = $sourceid;
                    $model->update();
                    echo "success";exit;
                }
                break;
            case 2: //商铺
                $shopModel = Shopbaseinfo::model()->findByPk($sourceid);
                //如果是只能设置全景的位置，则要判断要设置的房源是否是全景房源
                if($model->productgrid->p_position==6&&$shopModel->shopTag->st_ispanorama!=1){
                    echo "此模块只能设置全景房源，请选择其他房源";
                    exit;
                }
                if($this->isHaveSeted($userId, $sourceid, $model)){
                    echo "该全景房源已经设置过了，请选择其他房源";
                    exit;
                }
                if($shopModel&&$shopModel->sb_uid==$userId){//新数据也是可用的数据
                    $model->sp_sourceid = $sourceid;
                    $model->update();
                    echo "success";exit;
                }
                break;
            case 9: //住宅
                $residenceModel = Residencebaseinfo::model()->findByPk($sourceid);
                //如果是只能设置全景的位置，则要判断要设置的房源是否是全景房源
                if($model->productgrid->p_position==6&&$residenceModel->residenceTag->rt_ispanorama!=1){
                    echo "此模块只能设置全景房源，请选择其他房源";
                    exit;
                }
                if($this->isHaveSeted($userId, $sourceid, $model)){
                    echo "该全景房源已经设置过了，请选择其他房源";
                    exit;
                }
                if($residenceModel&&$residenceModel->rbi_uid==$userId){//新数据也是可用的数据
                    $model->sp_sourceid = $sourceid;
                    $model->update();
                    echo "success";exit;
                }
                break;
        }
        echo "内部错误，设置失败";//修改失败
        exit;
	}
    /**
     * 检查是否设置了
     * @param <int> $userId
     * @param <int> $sourceid
     * @param <object> $model
     * @return <int>
     */
    public function isHaveSeted($userId,$sourceid,$model){
        $sql = 'select `p_id` from {{productgrid}} where p_page = ? and p_position =? ';
        $list = Productgrid::model()->findAllBySql($sql, array($model->productgrid->p_page,$model->productgrid->p_position));
        $p_idArr = array();
        foreach ($list as $value) {
            $p_idArr[] = $value->p_id;
        }
        if( ! empty($p_idArr)){
            $criteria=new CDbCriteria;
            $criteria->addColumnCondition(array(
                "sp_userid"=>$userId,
                "sp_state"=>0,//可用状态
                //'sp_positionid'=>$p_idArr,
                'sp_sourceid'=>$sourceid,
            ));
            $criteria->addInCondition('sp_positionid',$p_idArr);
            return Buyproduct::model()->count($criteria);
        }
        return 0;
    }
    public function actionViewSource() {
        $model = $this->loadModel();
        $sourceid = $model->sp_sourceid;
        switch ($model->productgrid->p_positiontype){
            default:
                break;
            case 1: //写字楼
                $officeModel = Officebaseinfo::model()->findByPk($sourceid);
                $url = $officeModel->ob_sellorrent == 1?"/officebaseinfo/rentView":"/officebaseinfo/saleView";
                $this->Redirect(array($url,"id"=>$sourceid));
                break;
            case 2: //商铺
                $this->Redirect(array("/shop/view","id"=>$sourceid));
                break;
            case 9: //住宅
                $this->Redirect(array("/communitybaseinfo/viewResidence","id"=>$sourceid));
                break;
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
				$this->_model=Buyproduct::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='buyproduct-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
