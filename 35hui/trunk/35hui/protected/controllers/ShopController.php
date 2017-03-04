<?php

class ShopController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = 'shop';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','rentIndex','sellIndex','view','changeindexscroll','preview','getBuild','newBuild'),
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionIndex()
	{
       
        if($this->beginCache("siteindex_data",array('duration'=>Yii::app()->params['duration']))) {
            $data=array();
            $friendLink = Friendlink::model()->getAllFriendLink();
            $data['friendLink']=&$friendLink;
            $seotkd = Seotkd::model()->findByPk(6);
            $data['seotkd']=&$seotkd;
            $uagentNum = Uagent::model()->count();
            $data['uagentNum']=&$uagentNum;

            $criteria=new CDbCriteria;
            $criteria->condition = "sp_type=2";
            $criteria->order = "sp_order";
            $scrollPicture = Scrollpicture::model()->findAll($criteria);
            $data['scrollPicture']=&$scrollPicture;
            extract($data);
            
            //最新出租
            $rentShop = Shopbaseinfo::model()->getRecentShop(1, 6);
            //最新出售
            $sellShop = Shopbaseinfo::model()->getRecentShop(2, 6);
            //最新转让
            $transferShop=Shopbaseinfo::model()->getRecentShop(3, 5);

            $criteria=new CDbCriteria;
            $criteria->limit=6;
            $criteria->select="fid,tid,dateline,subject,displayorder,moderated";
            $criteria->order="dateline desc";
            $criteria->condition="fid=37 and displayorder=0 and moderated=0";
            $bbs=Forum_thread::model()->findAll($criteria);
            $criteria->condition="fid!=37 and displayorder=0 and moderated=0";
            $bbsAll=Forum_thread::model()->findAll($criteria);
            
            $this->Render("index",array(
                'bbs'=>$bbs,
                'bbsAll'=>$bbsAll,
                'uagentNum'=>$uagentNum,
                'scrollPicture'=>$scrollPicture,
                'friendLink'=>$friendLink,
                'rentShop'=>$rentShop,//最新出租
                'sellShop'=>$sellShop,//最新出售
                'transferShop'=>$transferShop,//最新转让
                "seotkd"=>$seotkd,
            ));
            $this->endCache();
        }
	}
    /**
     * 改变首页滚动房源
     */
    public function actionChangeIndexScroll(){
        $shopId = $_GET['shopId'];
        $url = Shopbaseinfo::model()->getPanoIdBySourceId($shopId);
        echo $url;
        exit;
    }
    public function actionRentIndex(){
        $get = SearchMenu::explodeAllParamsToArray();
        $dataProvider = Shopbaseinfo::model()->getDataProvider($get, 'rent','sb_city='.Yii::app()->params['defaultCity'].' AND sb_sellorrent=1 AND sb_check=4');//默认条件:上海城市的租房信息
        $seotkd = Seotkd::model()->findByPk(14);//SEO优化
        $this->render('rentIndex',array(
            'dataProvider'=>$dataProvider,
            'url'=>$this->getId()."/".$this->getAction()->getId(),//连接地址
            'options'=>$get,//生成的数组。在前台生成连接时使用
            'type'=>"rent",//页面类型。是租还是售，供前台区别连接的时候使用
            'seotkd'=>$seotkd,//SEO优化
             'saleOrRent'=>"1",
        ));
    }
    public function actionTransferIndex(){
        $get = SearchMenu::explodeAllParamsToArray();
        $dataProvider = Shopbaseinfo::model()->getDataProvider($get, 'transfer','sb_city='.Yii::app()->params['defaultCity'].' AND sb_sellorrent=1 AND sb_check=4');//默认条件:上海城市的租房信息

        $seotkd = Seotkd::model()->findByPk(16);//SEO优化
        $this->render('rentIndex',array(
            'dataProvider'=>$dataProvider,
            'url'=>$this->getId()."/".$this->getAction()->getId(),//连接地址
            'options'=>$get,//生成的数组。在前台生成连接时使用
            'type'=>"transfer",//页面类型。是租还是售，供前台区别连接的时候使用
            'seotkd'=>$seotkd,//SEO优化
             'saleOrRent'=>"3",
        ));
    }
    public function actionSellIndex(){
        $get = SearchMenu::explodeAllParamsToArray();
        $dataProvider = Shopbaseinfo::model()->getDataProvider($get, 'sale','sb_city='.Yii::app()->params['defaultCity'].' AND sb_sellorrent=2 AND sb_check=4');//默认条件:上海城市的租房信息

        $seotkd = Seotkd::model()->findByPk(15);//SEO优化
        $this->render('sellIndex',array(
            'dataProvider'=>$dataProvider,
            'url'=>$this->getId()."/".$this->getAction()->getId(),//连接地址
            'options'=>$get,//生成的数组。在前台生成连接时使用
            'type'=>"sale",//页面类型。是租还是售，供前台区别连接的时候使用
            'seotkd'=>$seotkd,//SEO优化
        ));
    }
    public function actionView(){
        //只显示发布状态的房源
        $shopId = $_GET['id'];
        $shopInfo = Shopbaseinfo::model()->findByAttributes(array('sb_shopid'=>$shopId));
        if(!$shopInfo||$shopInfo->sb_check!=4){
            throw new CHttpException(404,'您请求的房源不存在或者已经下线！');
        }
        self::viewInfo();
    }
    //商铺预览
    public function actionPreview(){
        self::viewInfo();
    }
    private function viewInfo(){
        $shopId = $_GET['id'];
        $shopModel = Shopbaseinfo::model()->findByPk($shopId);
        if($shopModel->sb_sellorrent==1){//出租
            RecentView::addViewTrace($shopId, RecentView::shopbaseinfo, RecentView::rent);//添加最近浏览
//            $shopTags = Tags::model()->getTagsByTypeAndMarke(Tags::shop,Tags::rent,10);//标签
        }elseif($shopModel->sb_sellorrent==2){//出售
            RecentView::addViewTrace($shopId, RecentView::shopbaseinfo, RecentView::sell);//添加最近浏览
//            $shopTags = Tags::model()->getTagsByTypeAndMarke(Tags::shop,Tags::sell,10);//标签
        }
        if($shopModel->sb_sellorrent==1){
            $type=CHtml::link("出租",array("/shop/rentIndex"));
            if(isset($shopModel->rentInfo->sr_renttype)&&$shopModel->rentInfo->sr_renttype=="2"){
                $type=CHtml::link("转让",array("/shop/transferIndex"));
            }
        }else{
            $type=CHtml::link("出售",array("/shop/sellIndex"));
        }
        if(common::isCanAddVisit('shop_visit_ids', $shopModel->sb_shopid)){
            $shopModel->sb_visit++;
            $shopModel->sb_order+=common::getOrderConfigVisit($shopModel->sb_visit);
            $shopModel->update();
        }

        $ownerInfo = User::model()->findByPk($shopModel->sb_uid);//得到发布者的user信息
        if(!$ownerInfo){
            throw new CHttpException(404,'此房源所属的经纪人已经被删除，访问失败！');
        }

        $pictures = Picture::model()->findAll('`p_sourceid`=? AND `p_sourcetype`=?',array($shopId,Picture::$sourceType['shopbaseinfo']));
       


        $this->render('view',array(
            'shopModel'=>$shopModel,
            'ownerInfo'=>$ownerInfo,
            'type'=>$type,
            'pictures'=>$pictures,
//            'shopTags'=>$shopTags,
            //'recentComment'=>$recentComment,
            //'impressions'=>$impressions,
        ));
    }
     public function actionPicList(){
        $albums="";
        $id="";
        if(isset($_GET["id"])&&$_GET["id"]){
            $id=$_GET["id"];
             $albums = Picture::model()->findAll(array('condition'=>'p_sourcetype=5 AND p_sourceid='.$id));
        }
       $this->renderPartial('piclist',array(
            "data"=>$albums,
       ));

    }

    /**
     *	根据选中区域的ID查询出该区域下所有的标志性建筑名
     */
    public function actionGetBuild() {
        if(Yii::app()->request->isAjaxRequest) {
            $id = $_REQUEST['id'];
            $list = Region::model()->getChildrenById($id);
            echo CJSON::encode($list);
        }
    }
    
}
