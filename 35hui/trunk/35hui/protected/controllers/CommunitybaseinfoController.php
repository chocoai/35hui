<?php

class CommunitybaseinfoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = 'community';
    private $_model;
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
				'actions'=>array('view','comment','addComment','picture','searchIndex','sellIndex','rentIndex','index','viewResidence','viewRent','viewSell',"PreViewRent","PreViewSell","preViewResidence","DTRentIndex","DTsearchIndex"),
				'users'=>array('*'),
			),
            array('allow',  // allow all login users to perform 'index' and 'view' actions
				'actions'=>array('searchxiaoqu','collect','ishave'),
				'users'=>array('@'),
			),
		);
	}
    public function actionCollect(){
        Yii::import('application.common.*');
        $this->layout = 'frame';
		$model=new Communitybaseinfo;

		if(isset($_POST['comy_name']))
		{
            //设置默认省市
            $model->comy_province = 9;
            $model->comy_city = 35;
            $model->comy_inserttime = time();
            $model->comy_iscollect = 1;
            $model->comy_introduce = '暂无资料';
            $model->comy_developer = '暂无资料';
            $model->comy_propertyname = '暂无资料';
            $model->comy_propertytel = '暂无资料';
            $model->comy_propertyprice = 0;
            $model->comy_avgsellprice = 0;
            $model->comy_cubagerate = 0;
            $model->comy_afforestation = 0;
            $model->comy_householdnum = 0;
            $model->comy_parking = 0;
            $model->comy_buildingera = 0;
            $model->comy_saleaddress = '暂无资料';
            $model->comy_houseown = 0;
            $model->comy_titlepic = 0;
            $model->comy_saletel = '暂无资料';
            $model->comy_x = '0';
            $model->comy_y = '0';
            $model->comy_traffic = '暂无资料';
            $model->comy_buildingarea = 0;
            $model->comy_school = '暂无资料';
            $model->comy_shopping = '暂无资料';
            $model->comy_bank = '暂无资料';
            $model->comy_hospital = '暂无资料';
            $model->comy_dining = '暂无资料';
            $model->comy_vegetables = '暂无资料';
            $model->comy_other = '暂无资料';
            $model->comy_score = 0;
            $model->comy_ratingnum = 0;
            $model->comy_line = '暂无资料';
            $model->attributes=$_POST;

            //计算拼音缩写
            $pinyin = new Pinyin;
            $pinYinArray = $pinyin->doWord(trim($model->comy_name));
            $model->comy_pinyinshortname = $pinYinArray['short'];
            $model->comy_pinyinlongname = $pinYinArray['long'];

            //计算轨道交通
            if($model->validate() && !Communitybaseinfo::model()->findByAttributes(array("comy_name"=>$model->comy_name))){
                if($model->save()){
                    $buildId = $model->comy_id;//(id,year,name,add)
                    header("Content-type: text/html; charset=utf-8");
                    echo "<script>window.parent.getOtherBuildInfo(".$buildId.",0,'".CHtml::encode($model->comy_name)."','".CHtml::encode($model->comy_address)."');</script>";
                    exit;
                }
            }
		}
        $districtlist = Region::model()->findAllByAttributes(array('re_parent_id'=>35));
		$this->render('_collectform',array(
			'model'=>$model,
            'districtlist'=>$districtlist,
		));
	}
    public function actionIshave(){
        $r = 1;//不可用
        if(isset($_GET['name'])&&$_GET['name']!=""){
            if(!Communitybaseinfo::model()->findByAttributes(array("comy_name"=>$_GET['name'])) ){
                $r = 2;
            }
        }
        echo $r;
        exit;
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
    public function actionView(){
        $model = $this->loadModel();
        $pictures = Picture::model()->getAllPictures($model->comy_id,Picture::$sourceType['communitybaseinfo']);//小区图片
        $addImpression = $this->newImpression($model);
        $impressions = Impression::model()->getSeveralImpression($model->comy_id,Impression::communitybaseinfo); //小区印象
        $communityinfo_rent = Residencebaseinfo::model()->getSellorRentInfoByCommunityid($model->comy_id,1,4);//出租
        $communityinfo_sell = Residencebaseinfo::model()->getSellorRentInfoByCommunityid($model->comy_id,2,4);//二手房

        $result = 0;//0代表失败,1代表成功,2代表已经评分过,不能再评分了,3代表没有登录
        if (Yii::app()->user->isGuest) {//没有登录
            $result = 3;
        }else{//已经登录
            $userId = Yii::app()->user->id;
            $publishState = Communityrating::model()->checkRated($userId,$model->comy_id);
            if($publishState){
                $result = 2;
            }else{
                if(isset($_POST['score'])){
                    $score = $_POST['score'][0];
                    $addLog = Communityrating::model()->addRateLog($userId,$model->comy_id,$score);//添加评分记录
                    if($addLog) {
                        $model->comy_score = $model->comy_score+$score;
                        $model->comy_ratingnum = $model->comy_ratingnum+1;
                        $model->update();
                        $result = 2;
                    }
                }
            }
        }
        $this->render('view',array(
            'model'=>$model,
            'pictures'=>$pictures,
            'impressions'=>$impressions,
            'addImpression'=>$addImpression,
            'newImpression'=>new Impression(),
            'communityinfo_rent'=>$communityinfo_rent,
            'communityinfo_sell'=>$communityinfo_sell,
            'result'=>$result,
        ));
    }

     protected function newImpression($communityInfo){
        $result = 0;//0代表没有发表,1代表成功,2代表失败,3代表表单字符串为空,4代表发表过,5代表没有登录
        if(isset($_POST['Impression'])){
            if (Yii::app()->user->isGuest) {//没有登录
                $result = 5;
            }else{//已经登录
                $userId = Yii::app()->user->id;
                if(empty($_POST['Impression']['im_description'])){//印象表单为空字符串
                    $result = 3;
                }else{
                    if(strlen($_POST['Impression']['im_description'])>30){//长度超过15个汉字
                        $result = 6;
                    }else{
                        $publishState = Impression::model()->checkPublished($userId,$communityInfo->comy_id,Impression::communitybaseinfo);
                        if($publishState){//发表过
                            $result = 4;
                        }else{
                            $result = 2;//不是成功就是失败
                            $impression = new Impression();
                            if($communityInfo){
                                $impression->setAttribute('im_sourceid',$communityInfo->comy_id);
                                $impression->setAttribute('im_sourcetype',Impression::communitybaseinfo);
                            }
                            $impression->attributes=$_POST['Impression'];
                            $addIm = Impression::model()->addImpression($impression);//增加新的印象
                            if($addIm){
                                $addLog = Userimpression::model()->addPublishLog($userId,$impression->im_id);//添加发表记录
                                if($addLog){
                                    $result = 1;
                                }
                            }
                        }
                    }
                }
            }
        }
        return $result;
    }

     public function loadModel() {
        if($this->_model===null) {
            if(isset($_GET['id']))
                $this->_model=Communitybaseinfo::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'很抱歉，您所访问的小区不存在！');
        }
        return $this->_model;
    }

    public function actionComment(){
        $model = $this->loadModel();
        $newComment=new Communitycomment;
        $commentsProvider = Communitycomment::model()->getCommentByCommunityId($model->comy_id,5);
        $seotkd = Seotkd::model()->findByPk(11);//SEO优化
        $this->render('comment',array(
              'commentsProvider'=>$commentsProvider,
              'newComment'=>$newComment,
              'model'=>$model,
              'seotkd'=>$seotkd
         ));
    }
    
    public function actionAddComment(){
        $comment=new Communitycomment;
        $model = $this->loadModel();
        if(isset($_POST['ajax']) && $_POST['ajax']==='communitycomment-form')
		{
			echo CActiveForm::validate($comment);
			Yii::app()->end();
		}

        if(isset($_POST['Communitycomment']))
        {
            if(Yii::app()->user->isGuest){
                echo  "请先登录!";
            }else{
                $comment->attributes=$_POST['Communitycomment'];
                $result = $model->addComment($comment);
                echo $result['speak'];
            }
        }
    }
    
    public function actionpicture(){
        $model = $this->loadModel();
        $pictures = Picture::model()->getPicturesByCondition($model->comy_id,Picture::$sourceType['communitybaseinfo']);
        $seotkd = Seotkd::model()->findByPk(11);//SEO优化
        $this->render('picture',array(
            'model'=>$model,
            'pictures'=>$pictures,
            'seotkd'=>$seotkd
        ));
    }

    //楼盘选项
	public function actionSearchXiaoqu(){
        $keyw=$_GET['keyw'];
        $dba = dba();
        $sql = "SELECT `comy_id` AS 'id',`comy_name` AS 'name',`comy_address` AS 'add',`comy_buildingera` AS 'year'
            FROM `35_communitybaseinfo`
                WHERE `comy_name` LIKE '%".$keyw."%'
            ORDER BY `comy_id` DESC LIMIT 10" ;
        $list = $dba->select($sql);
        echo json_encode($list);
		exit;
	}

    
    private function searchIndex($searchMenu){
        $get = SearchMenu::explodeAllParamsToArray();
        $criteria=new CDbCriteria();
        $criteria = self::getOrderCondition($criteria, $get);
        $dataProvider = new CActiveDataProvider('Communitybaseinfo',array(
			'pagination'=>array(
                'pageSize'=>20,
            ),
            'criteria'=>$criteria,
        ));
        $seotkd = Seotkd::model()->findByPk(11);//SEO优化
        $this->render('searchIndex',array(
            'dataProvider'=>$dataProvider,
            'options'=>$get,
            'searchMenu'=>$searchMenu,
            'seotkd'=>$seotkd
        ));
    }
    public function actionSearchIndex(){
      $searchMenu = array(1,16,20);
      self::searchIndex($searchMenu);
    }
    public function actionDTSearchIndex(){
        $searchMenu = array(18,16,20);
        self::searchIndex($searchMenu);
    }
    
    public function getOrderCondition($criteria,$get){
        if($criteria->condition==""){//如果开始的时侯condition为空，则有个默认的condition
            $criteria->condition = "1";
        }
        //添加搜索条件
        if(isset($get['district'])&&$get['district']!=""){
            $criteria->condition .= " and comy_district=".$get['district'];
        }
        if(isset($get['section'])&&$get['section']!=""){
            $criteria->condition .= " and comy_section=".$get['section'];
        }
        if(isset($get['line'])&&$get['line']!=""){
            $criteria->condition .= " and comy_line like '%".",".$get['line'].","."%'";
        }
        if(isset($get['station'])&&$get['station']!=""){
            $criteria->condition .= " and comy_traffic like '%".",".$get['station'].","."%'";
        }
        if(isset($get['cavgPrice'])&&$get['cavgPrice']!=""){
            $result = Searchcondition::model()->getConditionValue($get['cavgPrice']);
            if(!empty($result)){
                $criteria->condition .= " and comy_avgsellprice between '".$result['min']."' and '".$result['max']."'";
            }
        }
        if(isset($get['pType'])&&$get['pType']!=""){
            $result = Searchcondition::model()->getConditionValue($get['pType']);
            if(!empty($result)){
                $criteria->condition .= " and comy_propertytype between '".$result['min']."' and '".$result['max']."'";
            }
        }
        if(isset($get['keyword'])&&$get['keyword']!=""){
            $keyword = $get['keyword'];
            $idArr = common::getIdsBySphinxSearch($keyword, Yii::app()->params['communityIndex'],"array");
            $criteria->addInCondition('comy_id', $idArr);
        }
        //过滤排序状态
        if(isset($get['order'])&&$get['order']=="sd"){//如果设置平均售价价的排序，并且排序向下
           $criteria->order =" comy_avgsellprice desc";
        }
        if(isset($get['order'])&&$get['order']=="su"){//如果设置平均售价价的排序，并且排序向上
           $criteria->order =" comy_avgsellprice asc";
        }
        if(isset($get['order'])&&$get['order']=="asdf"){//如果设置平均售价价的排序，并且排序向下
           $criteria->addColumnCondition(array("sw_id"=>$get['order']));
        }
       // $criteria->with = array("subway");
        return $criteria;
    }

     public function actionSellIndex(){
         $searchMenu = array(1,3,5,10);
         self::sellIndex($searchMenu);
     }
     public function actionDTSellIndex(){
        $searchMenu = array(18,3,5,10);
         self::sellIndex($searchMenu);
     }

     private function sellIndex($searchMenu){
        $get = SearchMenu::explodeAllParamsToArray();
        $dataProvider = Residencebaseinfo::model()->getDataProvider($get,'sale','rbi_rentorsell=2');
        $seotkd = Seotkd::model()->findByPk(11);//SEO优化
        $this->render('sellIndex',array(
            'dataProvider'=>$dataProvider,
            'options'=>$get,//生成的数组。在前台生成连接时使用
            'type'=>"sale",//页面类型。是租还是售，供前台区别连接的时候使用
            'searchMenu'=>$searchMenu,
            'seotkd'=>$seotkd,//SEO优化
        ));
     }
     
     public function actionRentIndex(){
        $searchMenu = array(1,17,3,19,20,10);
        self::rentIndex($searchMenu);
     }
     public function actionDTRentIndex(){
        $searchMenu = array(18,17,3,19,20,10);
        self::rentIndex($searchMenu);
     }
     private function rentIndex($searchMenu){
        $get = SearchMenu::explodeAllParamsToArray();
        $dataProvider = Residencebaseinfo::model()->getDataProvider($get,'rent','rbi_rentorsell=1');
        $seotkd = Seotkd::model()->findByPk(11);//SEO优化
        $this->render('rentIndex',array(
            'dataProvider'=>$dataProvider,
            'options'=>$get,//生成的数组。在前台生成连接时使用
            'type'=>"rent",//页面类型。是租还是售，供前台区别连接的时候使用
            'searchMenu'=>$searchMenu,
            'seotkd'=>$seotkd,
        ));
     }

     public function actionIndex(){
         if(($data=Yii::app()->cache->get('communityindex_data'))===false){
            $data = array();
        //得到首页滚动栏
        $scrolllist = Buyproduct::model()->getProductByPageAndPosition(13,6);
        $data['scrolllist']=&$scrolllist;
         //热门小区
        $hotcommunity = Communitybaseinfo::model()->getHotCommunity(2);
        $data['hotcommunity']=&$hotcommunity;
        //金牌经纪人
        $golduagent = Buyproduct::model()->getProductByPageAndPosition(13,9);
        $data['golduagent']=&$golduagent;
        //最新出租
        $rentZhuzhai = Residencebaseinfo::model()->getRecentZhuzhai(1, 16);
        $data['rentZhuzhai']=&$rentZhuzhai;
        //最新出售
        $sellZhuzhai = Residencebaseinfo::model()->getRecentZhuzhai(2, 16);
        $data['sellZhuzhai']=&$sellZhuzhai;

        $seotkd = Seotkd::model()->findByPk(11);//SEO优化
        $data['seotkd']=&$seotkd;
            Yii::app()->cache->set('communityindex_data',$data,Yii::app()->params['dataDurationIndex']);
        }else{
            extract($data);
        }
        $this->render('index',array(
            'scrolllist'=>$scrolllist,//首页滚动栏
            'hotcommunity'=>$hotcommunity,//热门小区
            'golduagent'=>$golduagent,//金牌经纪人
            'loginform'=>new LoginForm,//登录
            "seotkd"=>$seotkd,
            'rentZhuzhai'=>$rentZhuzhai,
            'sellZhuzhai'=>$sellZhuzhai
        ));
     }

     public function actionViewRent(){
        //只显示发布状态的房源
        $residenceId = $_GET['id'];
        $tagInfo = Residencetag::model()->findByAttributes(array('rt_rbiid'=>$residenceId));
        if(!$tagInfo||$tagInfo->rt_check!=4){
            throw new CHttpException(404,'您请求的房源不存在或者已经下线！');
        }
        self::viewRentInfo();
     }
     //预览出租
     public function actionPreViewRent(){
        self::viewRentInfo();
     }
     
     public function actionViewSell(){
        //只显示发布状态的房源
        $residenceId = $_GET['id'];
        $tagInfo = Residencetag::model()->findByAttributes(array('rt_rbiid'=>$residenceId));
        if(!$tagInfo||$tagInfo->rt_check!=4){
            throw new CHttpException(404,'您请求的房源不存在或者已经下线！');
        }
        self::viewSellInfo();
     }
     //预览出售
     public function actionPreViewSell(){
        self::viewSellInfo();
     }
     public function actionViewResidence(){
        $residenceId = $_GET['id'];
        $residenceModel = Residencebaseinfo::model()->findByPk($residenceId);
        if(common::isCanAddVisit('zhuzhai_visit_ids', $residenceModel->rbi_id)){
            $residenceModel->rbi_visit++;
            $residenceModel->rbi_order+=common::getOrderConfigVisit($residenceModel->rbi_visit);
            $residenceModel->update();
        }
        if($residenceModel->rbi_rentorsell==1){//出租
           $this->Redirect(array("communitybaseinfo/viewRent","id"=>$residenceId));//转向出租详细页面
        }elseif($residenceModel->rbi_rentorsell==2){//出售
           $this->Redirect(array("communitybaseinfo/viewSell","id"=>$residenceId));//转向二手房详细页面
        }
    }
    public function actionPreViewResidence(){
        $residenceId = $_GET['id'];
        $residenceModel = Residencebaseinfo::model()->findByPk($residenceId);
        if($residenceModel->rbi_rentorsell==1){//出租
           $this->Redirect(array("communitybaseinfo/preViewRent","id"=>$residenceId));//转向出租详细页面
        }elseif($residenceModel->rbi_rentorsell==2){//出售
           $this->Redirect(array("communitybaseinfo/preViewSell","id"=>$residenceId));//转向二手房详细页面
        }
    }
     private function viewRentInfo(){
        $residenceId = $_GET['id'];
        $residenceModel = Residencebaseinfo::model()->findByPk($residenceId);
        RecentView::addViewTrace($residenceId, RecentView::residencebaseinfo, RecentView::rent);//添加最近浏览
        $ownerInfo = User::model()->findByPk($residenceModel->rbi_uid);//得到发布者的user信息
        if(!$ownerInfo){
            throw new CHttpException(404,'此房源所属的经纪人已经被删除，访问失败！');
        }
        $communityInfo = Communitybaseinfo::model()->findByPk($residenceModel->rbi_communityid);//小区信息
        $pictures = Picture::model()->getAllPictures($residenceId,Picture::$sourceType['residencebaseinfo']);//住宅图片

        $this->render('viewRent',array(
            'residenceModel'=>$residenceModel,
            'ownerInfo'=>$ownerInfo,
            'communityInfo'=>$communityInfo,
            'pictures'=>$pictures,
        ));
     }
     private function viewSellInfo(){
        $residenceId = $_GET['id'];
        $residenceModel = Residencebaseinfo::model()->findByPk($residenceId);
        RecentView::addViewTrace($residenceId, RecentView::residencebaseinfo, RecentView::sell);//添加最近浏览
        $ownerInfo = User::model()->findByPk($residenceModel->rbi_uid);//得到发布者的user信息
        if(!$ownerInfo){
            throw new CHttpException(404,'此房源所属的经纪人已经被删除，访问失败！');
        }
        $communityInfo = Communitybaseinfo::model()->findByPk($residenceModel->rbi_communityid);//小区信息
        $pictures = Picture::model()->getAllPictures($residenceId,Picture::$sourceType['residencebaseinfo']);//住宅图片
        $this->render('viewSell',array(
            'residenceModel'=>$residenceModel,
            'ownerInfo'=>$ownerInfo,
            'communityInfo'=>$communityInfo,
            'pictures'=>$pictures,
        ));
     }

    /**
     * 改变首页滚动房源
     */
    public function actionChangeIndexScroll(){
        $residenceId = $_GET['residenceId'];
        $url = Residencebaseinfo::model()->getPanoIdBySourceId($residenceId);
        echo $url;
        exit;
    }
}
