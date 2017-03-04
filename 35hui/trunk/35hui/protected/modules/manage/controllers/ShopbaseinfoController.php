<?php

class ShopbaseinfoController extends Controller
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
				'actions'=>array('validatenum','rentrelease','rentupdate','sellrelease','sellupdate'),
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
	public function actionRentRelease()
	{
        $shopBaseInfoModel = new Shopbaseinfo();//基本信息
        $shopFacilityInfoModel = new Shopfacilityinfo();//配套设施
        $shopPresentInfoModel = new Shoppresentinfo();//展示信息
        //$shopTagModel = new Shoptag();//标签
        $shopRentInfoModel = new Shoprentinfo();//出租信息
        $userId = Yii::app()->user->id;
        
        if($_POST){
            if(!isset($_POST['sb_cancut'])){
                $_POST['sb_cancut']=0;
            }
            if(isset($_POST["sr_paytype"])&&$_POST["sr_paytype"]['pay']=="1"&&$_POST["sr_paytype"]['f']&&$_POST["sr_paytype"]['y']){
                    $_POST["sr_paytype"]=$_POST["sr_paytype"]['f'].",".$_POST["sr_paytype"]['y'];
            }else{
                    $_POST["sr_paytype"]=0;
            }
            if($_POST["sr_renttype"]=="2"){
                   if($_POST["sr_transferprice"]=="1"){
                       $_POST["sr_transferprice"]=$_POST["transferprice"];
                   }elseif($_POST["sr_transferprice"]=="2"){
                       $_POST["sr_transferprice"]='NULL';
                   }else{
                       $_POST["sr_transferprice"]=0;
                   }
            }else{
                unset($_POST["sr_transferprice"]);
            }
            
            unset($_POST["transferprice"]);
            if(isset($_POST["sb_floor"]['type'])&&$_POST["sb_floor"]['type']=="1"){
                   $_POST["sb_floor"]=$_POST["sb_floor"]['type'].",".$_POST["sb_floor"]['floor'];
            }else if(isset($_POST["sb_floor"]['type'])&&$_POST["sb_floor"]['type']=="2"){
                   $_POST["sb_floor"]=$_POST["sb_floor"]['type'].",".$_POST["sb_floor"]['unfloor'].",".$_POST["sb_floor"]['upfloor'];
            }else if(isset($_POST["sb_floor"]['type'])&&$_POST["sb_floor"]['type']=="3"){
                   $_POST["sb_floor"]=$_POST["sb_floor"]['type'].",".$_POST["sb_floor"]['dufloor'];
            }else{
                $_POST["sb_floor"]="";
            }
            
            foreach($_POST as $key=>$value){
                !is_array($value)?$_POST[$key] = trim($value):"";
            }
            $time = time();
            $shopBaseInfoModel->attributes = $_POST;
            $shopFacilityInfoModel->attributes = $_POST;
            $shopPresentInfoModel->attributes = $_POST;
            $shopRentInfoModel->attributes = $_POST;
            foreach ($shopFacilityInfoModel->attributes as $key=>$val){//由于数据库设置为默认1，需要重新赋值
                $shopFacilityInfoModel->$key = empty($_POST[$key]) ? '0':'1';
            }

            //付默认值
            $shopBaseInfoModel->sb_uid = $userId;
            $shopBaseInfoModel->sb_province = 9;
            $shopBaseInfoModel->sb_city = 35;
            $shopBaseInfoModel->sb_sellorrent = 1;
            $shopBaseInfoModel->sb_updatedate = $time;
            $shopBaseInfoModel->sb_releasedate = $time;
            $shopBaseInfoModel->sb_check = 4;
            //付需要处理的值
            if(isset($_POST['sb_busway_tmp'])){
                $shopBaseInfoModel->sb_busway = implode(",", $_POST['sb_busway_tmp']);
            }
            if(isset($_POST['sb_tag_tmp'])){
                $shopBaseInfoModel->sb_tag = implode(",", $_POST['sb_tag_tmp']);
            }
          
            $shopBaseInfoModel->sb_expiredate = 86400*$shopBaseInfoModel->sb_expiredate;
            //排序积分
            $shopBaseInfoModel->sb_order = common::getOrderConfig('new');
            
            if($shopBaseInfoModel->validate()){
                $picture = $_POST['picture'];
                if(isset($_POST['submit'])&&$_POST['submit']!==null){//提交
                    //计算获得积分。
                    $arr=Oprationconfig::model()->getConfigByName('release');
                    $integral=$arr['3'];
                    if(User::model()->validateRelease($userId, 1, 2)=="success"){//如果验证了可以发布
                        $shopId = Shopbaseinfo::model()->saveRentShop($shopBaseInfoModel, $shopFacilityInfoModel, $shopPresentInfoModel, $shopRentInfoModel, $picture);
                      
                        if($shopId){
                            $description = "商铺出售房源".$shopId."发布成功，奖励{:point}积分";
                            Userproperty::model()->addPoint($userId, $integral, $description);
                            Medal::model()->piwikMedal($userId, 9, 1);//连续发房源任务
                            Yii::app()->user->setFlash('message','发布商铺出租信息成功！'.CHtml::link("为该房源添加一份全景",array("/manage/subpanorama/index","type"=>2,"id"=>$shopId),array("style"=>"color:blue")));
                            
                            $modelUser = User::model()->findByPk($userId);//增加统计数
                            $modelUser->user_housenum=$modelUser->user_housenum+1;
                            $modelUser->user_shopnum=$modelUser->user_shopnum+1;
                            $modelUser->update();
                            $this->redirect(array('manage/rent','sourceType'=>'2'));
                        }
                    }
                }elseif(isset($_POST['sketch'])&&$_POST['sketch']!==null){//保存为草稿
                    $shopBaseInfoModel->sb_check = 8;
                    if(User::model()->validateRelease($userId, 2, 2)=="success"){//如果验证了可以发布
                        $shopId = Shopbaseinfo::model()->saveRentShop($shopBaseInfoModel, $shopFacilityInfoModel, $shopPresentInfoModel,  $shopRentInfoModel, $picture);
                        if($shopId){
                            Yii::app()->user->setFlash('message','保存草稿成功！');
                            $this->Redirect(array('manage/rent','sourceType'=>'2'));
                        }
                    }
                }
                $this->redirect(array('main/error'));
           }
           exit;
        }

        $this->render('rentrelease',array(
            'shopBaseInfoModel'=>$shopBaseInfoModel,
            'shopFacilityInfoModel'=>$shopFacilityInfoModel,//配套设施
            'shopPresentInfoModel'=>$shopPresentInfoModel,//展示信息
            'shopRentInfoModel'=>$shopRentInfoModel,//出租信息
            'menu'=>@$_GET['menu'],
        ));
	}
    public function actionSellRelease()
	{
        $shopBaseInfoModel = new Shopbaseinfo();//基本信息
        $shopFacilityInfoModel = new Shopfacilityinfo();//配套设施
        $shopPresentInfoModel = new Shoppresentinfo();//展示信息
        $shopSellInfoModel = new Shopsellinfo();//出售信息
        $userId = Yii::app()->user->id;

        if($_POST){
             if(isset($_POST["sb_floor"]['type'])&&$_POST["sb_floor"]['type']=="1"){
                   $_POST["sb_floor"]=$_POST["sb_floor"]['type'].",".$_POST["sb_floor"]['floor'];
            }else if(isset($_POST["sb_floor"]['type'])&&$_POST["sb_floor"]['type']=="2"){
                   $_POST["sb_floor"]=$_POST["sb_floor"]['type'].",".$_POST["sb_floor"]['unfloor'].",".$_POST["sb_floor"]['upfloor'];
            }else if(isset($_POST["sb_floor"]['type'])&&$_POST["sb_floor"]['type']=="3"){
                   $_POST["sb_floor"]=$_POST["sb_floor"]['type'].",".$_POST["sb_floor"]['dufloor'];
            }else{
                $_POST["sb_floor"]="";
            }
            foreach($_POST as $key=>$value){
                !is_array($value)?$_POST[$key] = trim($value):"";
            }
            $time = time();

            $shopBaseInfoModel->attributes = $_POST;
            $shopFacilityInfoModel->attributes = $_POST;
            $shopPresentInfoModel->attributes = $_POST;
            $shopSellInfoModel->attributes = $_POST;

            foreach ($shopFacilityInfoModel->attributes as $key=>$val){//由于数据库设置为默认1，需要重新赋值
                $shopFacilityInfoModel->$key = empty($_POST[$key]) ? '0':'1';
            }

            //付默认值
            $shopBaseInfoModel->sb_uid = $userId;
            $shopBaseInfoModel->sb_province = 9;
            $shopBaseInfoModel->sb_city = 35;
            $shopBaseInfoModel->sb_sellorrent = 2;//出售
            $shopBaseInfoModel->sb_updatedate = $time;
            $shopBaseInfoModel->sb_releasedate = $time;
            $shopBaseInfoModel->sb_check = 4;
            //付需要处理的值
            if(isset($_POST['sb_busway_tmp'])){
                $shopBaseInfoModel->sb_busway = implode(",", $_POST['sb_busway_tmp']);
            }
            if(isset($_POST['sb_tag_tmp'])){
                $shopBaseInfoModel->sb_tag = implode(",", $_POST['sb_tag_tmp']);
            }
            
            
            $shopBaseInfoModel->sb_expiredate = 86400*$shopBaseInfoModel->sb_expiredate;
            //排序积分
            $shopBaseInfoModel->sb_order = common::getOrderConfig('new');
   
            if($shopBaseInfoModel->validate()){
                $picture = $_POST['picture'];
                if(isset($_POST['submit'])&&$_POST['submit']!==null){//提交
                    //计算要扣的新币。
                    $arr=Oprationconfig::model()->getConfigByName('release');
                    $integral=$arr['3'];
                  
                    if(User::model()->validateRelease($userId, 1, 2)=="success"){//如果验证了可以发布
                        
                        $shopId = Shopbaseinfo::model()->saveSellShop($shopBaseInfoModel, $shopFacilityInfoModel, $shopPresentInfoModel, $shopSellInfoModel, $picture);
                        
                        if($shopId){
                            //扣除新币。
                            $description = "商铺出售房源".$shopId."发布成功，奖励{:point}积分";
                            Userproperty::model()->addPoint($userId, $integral, $description);
                            Medal::model()->piwikMedal($userId, 9, 1);//连续发房源任务
                            Yii::app()->user->setFlash('message','发布商铺出售信息成功！'.CHtml::link("为该房源添加一份全景",array("subpanorama/index","type"=>2,"id"=>$shopId),array("style"=>"color:blue")));
                            
                            $modelUser = User::model()->findByPk($userId);//增加统计数
                            $modelUser->user_housenum=$modelUser->user_housenum+1;
                            $modelUser->user_shopnum=$modelUser->user_shopnum+1;
                            $modelUser->update();
                            
                            $this->Redirect(array('manage/sell','sourceType'=>'2'));
                        }
                    }
                }elseif(isset($_POST['sketch'])&&$_POST['sketch']!==null){//保存为草稿
                    $shopBaseInfoModel->sb_check = 8;
                    if(User::model()->validateRelease($userId, 2, 2)=="success"){//如果验证了可以发布
                        $shopId = Shopbaseinfo::model()->saveSellShop($shopBaseInfoModel, $shopFacilityInfoModel, $shopPresentInfoModel,$shopSellInfoModel, $picture);
                        if($shopId){
                            Yii::app()->user->setFlash('message','保存草稿成功！');
                            $this->Redirect(array('manage/sell','tag'=>'draft','sourceType'=>'2'));
                        }
                    }
                }
                $this->redirect(array('main/error'));
            }
            exit;
        }

        $this->render('sellrelease',array(
            'shopBaseInfoModel'=>$shopBaseInfoModel,
            'shopFacilityInfoModel'=>$shopFacilityInfoModel,//配套设施
            'shopPresentInfoModel'=>$shopPresentInfoModel,//展示信息
            'shopSellInfoModel'=>$shopSellInfoModel,//出售信息
            'menu'=>@$_GET['menu'],
        ));
	}
        
    public function actionRentUpdate(){
        $session = Yii::app()->session;
        if(!Yii::app()->request->isPostRequest){
            $session['remanageurl']=!empty($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'';
        }
        if(isset($_GET['id'])){
            $shopId = $_GET['id'];
            $userId = Yii::app()->user->id;
            
            $shopBaseInfoModel = Shopbaseinfo::model()->findByPk($shopId);//基本信息
            $shopFacilityInfoModel = Shopfacilityinfo::model()->findByAttributes(array("sf_shopid"=>$shopId));//配套设施
            $shopPresentInfoModel = Shoppresentinfo::model()->findByAttributes(array("sp_shopid"=>$shopId));//展示信息
            $shopRentInfoModel = Shoprentinfo::model()->findByAttributes(array("sr_shopid"=>$shopId));//出租信息

            if($_POST){
                if(!isset($_POST['sb_cancut'])){
                $_POST['sb_cancut']=0;
                }
                if(isset($_POST["sr_paytype"])&&$_POST["sr_paytype"]['pay']=="1"&&$_POST["sr_paytype"]['f']&&$_POST["sr_paytype"]['y']){
                        $_POST["sr_paytype"]=$_POST["sr_paytype"]['f'].",".$_POST["sr_paytype"]['y'];
                }else{
                        $_POST["sr_paytype"]=0;
                }
                if($_POST["sr_renttype"]=="2"){
                       if($_POST["sr_transferprice"]=="1"){
                           $_POST["sr_transferprice"]=$_POST["transferprice"];
                       }elseif($_POST["sr_transferprice"]=="2"){
                           $_POST["sr_transferprice"]='NULL';
                       }else{
                           $_POST["sr_transferprice"]=0;
                       }
                }else{
                    unset($_POST["sr_transferprice"]);
                }
                unset($_POST["transferprice"]);
                
                if(isset($_POST["sb_floor"]['type'])&&$_POST["sb_floor"]['type']=="1"){
                   $_POST["sb_floor"]=$_POST["sb_floor"]['type'].",".$_POST["sb_floor"]['floor'];
                }else if(isset($_POST["sb_floor"]['type'])&&$_POST["sb_floor"]['type']=="2"){
                       $_POST["sb_floor"]=$_POST["sb_floor"]['type'].",".$_POST["sb_floor"]['unfloor'].",".$_POST["sb_floor"]['upfloor'];
                }else if(isset($_POST["sb_floor"]['type'])&&$_POST["sb_floor"]['type']=="3"){
                       $_POST["sb_floor"]=$_POST["sb_floor"]['type'].",".$_POST["sb_floor"]['dufloor'];
                }else{
                    $_POST["sb_floor"]="";
                }
                foreach($_POST as $key=>$value){
                    !is_array($value)?$_POST[$key] = trim($value):"";
                }
                $time = time();
                $shopBaseInfoModel->attributes = $_POST;
                $shopFacilityInfoModel->attributes = $_POST;
                $shopPresentInfoModel->attributes = $_POST;
                $shopRentInfoModel->attributes = $_POST;
               
                //付需要处理的值
                if(isset($_POST['sb_busway_tmp'])){
                    $shopBaseInfoModel->sb_busway = implode(",", $_POST['sb_busway_tmp']);
                }
                if(isset($_POST['sb_tag_tmp'])){
                    $shopBaseInfoModel->sb_tag = implode(",", $_POST['sb_tag_tmp']);
                }
              
                $shopBaseInfoModel->sb_expiredate = 86400*$shopBaseInfoModel->sb_expiredate;
                if($shopBaseInfoModel->validate()){
                    
                    //if(Userproperty::model()->deductMoney($userId, 1, Log::$moneyTemplate['4'])){ echo 1;exit;
                    if( $shopBaseInfoModel->update()&&$shopFacilityInfoModel->update()&&$shopPresentInfoModel->update()&&$shopRentInfoModel->update()){
                        Yii::app()->user->setFlash('message','更新商铺出租信息成功！！');
                    }else{
                        Yii::app()->user->setFlash('message','很遗憾！，修改失败！');
                    }
                    if(!empty($session['remanageurl']))
                        $this->redirect($session['remanageurl']);
                    $this->Redirect(array('manage/rent','sourceType'=>'2'));
                }
            }
            $this->render('rentupdate',array(
                'shopBaseInfoModel'=>$shopBaseInfoModel,
                'shopFacilityInfoModel'=>$shopFacilityInfoModel,//配套设施
                'shopPresentInfoModel'=>$shopPresentInfoModel,//展示信息
                'shopRentInfoModel'=>$shopRentInfoModel,//出租信息
            ));
        }
    }
    public function actionSellUpdate(){
        $session = Yii::app()->session;
        if(!Yii::app()->request->isPostRequest){
            $session['remanageurl']=!empty($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'';
        }
        if(isset($_GET['id'])){
            $shopId = $_GET['id'];
            $userId = Yii::app()->user->id;

            $shopBaseInfoModel = Shopbaseinfo::model()->findByPk($shopId);//基本信息
            $shopFacilityInfoModel = Shopfacilityinfo::model()->findByAttributes(array("sf_shopid"=>$shopId));//配套设施
            $shopPresentInfoModel = Shoppresentinfo::model()->findByAttributes(array("sp_shopid"=>$shopId));//展示信息
            $shopSellInfoModel = Shopsellinfo::model()->findByAttributes(array("ss_shopid"=>$shopId));//出租信息

            //修改需要的最少新币
            $updateNeedMoney=Oprationconfig::model()->getConfigByName('updateLoss', '0');
            $arr=Oprationconfig::model()->getConfigByName('release');
            $tui_num=$arr['1'];
            $ji_num=$arr['2'];

            $hurryNum = User::model()->getOprateState($userId, 4, 2);//急房源数
            $recommendNum = User::model()->getOprateState($userId, 5, 2);//推荐房源数
            if($_POST){
                 if(isset($_POST["sb_floor"]['type'])&&$_POST["sb_floor"]['type']=="1"){
                       $_POST["sb_floor"]=$_POST["sb_floor"]['type'].",".$_POST["sb_floor"]['floor'];
                }else if(isset($_POST["sb_floor"]['type'])&&$_POST["sb_floor"]['type']=="2"){
                       $_POST["sb_floor"]=$_POST["sb_floor"]['type'].",".$_POST["sb_floor"]['unfloor'].",".$_POST["sb_floor"]['upfloor'];
                }else if(isset($_POST["sb_floor"]['type'])&&$_POST["sb_floor"]['type']=="3"){
                       $_POST["sb_floor"]=$_POST["sb_floor"]['type'].",".$_POST["sb_floor"]['dufloor'];
                }else{
                    $_POST["sb_floor"]="";
                }
                foreach($_POST as $key=>$value){
                    !is_array($value)?$_POST[$key] = trim($value):"";
                }
                $time = time();
                $shopBaseInfoModel->attributes = $_POST;
                $shopFacilityInfoModel->attributes = $_POST;
                $shopPresentInfoModel->attributes = $_POST;
                $shopSellInfoModel->attributes = $_POST;

               
                
                foreach ($shopFacilityInfoModel->attributes as $key=>$val){//由于数据库设置为默认1，需要重新赋值
                    if(key_exists($key, Shopfacilityinfo::$facilitiy)){
                        $shopFacilityInfoModel->$key = empty($_POST[$key]) ? '0':'1';
                    }
                }

                //付需要处理的值
                if(isset($_POST['sb_busway_tmp'])){
                    $shopBaseInfoModel->sb_busway = implode(",", $_POST['sb_busway_tmp']);
                }
                if(isset($_POST['sb_tag_tmp'])){
                    $shopBaseInfoModel->sb_tag = implode(",", $_POST['sb_tag_tmp']);
                }
                
                $shopBaseInfoModel->sb_expiredate = 86400*$shopBaseInfoModel->sb_expiredate;
                
                if($shopBaseInfoModel->validate()){
                    //if(Userproperty::model()->deductMoney($userId,$updateNeedMoney, Log::$moneyTemplate['4'])){
                    if( $shopBaseInfoModel->update()&&$shopFacilityInfoModel->update()&&$shopPresentInfoModel->update()&&$shopSellInfoModel->update()){
                        Yii::app()->user->setFlash('message','更新商铺出售信息成功！！');
                    }else{
                        Yii::app()->user->setFlash('message','很遗憾！，修改失败！');
                    }
                    if(!empty($session['remanageurl']))
                        $this->redirect($session['remanageurl']);
                    $this->Redirect(array('manage/sell','sourceType'=>'2'));
                }
                exit;
            }

            $this->render('sellupdate',array(
                'shopBaseInfoModel'=>$shopBaseInfoModel,
                'shopFacilityInfoModel'=>$shopFacilityInfoModel,//配套设施
                'shopPresentInfoModel'=>$shopPresentInfoModel,//展示信息
                'shopSellInfoModel'=>$shopSellInfoModel,//出售信息
            ));
        }
    }
    /**
     * 验证商铺是否可以发布或者保存
     */
    public function actionValidateNum(){
        $userid = Yii::app()->user->id;
        $type = 2;
        if($_GET['name']=="submit"){//发布
            $type = 1;
        }
        $return = User::model()->validateRelease($userid, $type, 2);
        echo $return;
        exit;
    }
}
