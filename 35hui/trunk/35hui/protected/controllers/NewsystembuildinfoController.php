<?php

class NewsystembuildinfoController extends Controller
{
 public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
        		'maxLength'=>'4',
              	'minLength'=>'4',
                'testLimit'=>'30',//三次之后更新验证码
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
                'class'=>'CViewAction',
            ),
        );
    }
    /**
     * @var string the default layout for the views. Defaults to 'column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='office';

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    //揪错
    public function actionCreateerror(){
        $va = va();
        $va->check(array(
            'buildId'=>array('not_blank'),
            'econtent'=>array('not_blank'),
        ));
        if($va->success){
            $model=new Error();
            $model->e_buildid=$_POST['buildId'];
            $model->e_content=$_POST['econtent'];
            if(Yii::app()->user->isGuest){
                $model->e_nickname=$_POST['username'];
                $model->e_telphone=$_POST['telphone'];
                $model->e_email=$_POST['email'];
            }else{
                $model->e_userid = Yii::app()->user->id;
            }

            $model->verifyCode=$_POST['verifyCode'];
            $model->e_state=0;//默认未受理
            $model->e_date=time();

            if($model->save()){
                echo "1";//成功
            }else{
               echo $model->errors['verifyCode'][0];
            }
        }else{
            echo 2;
        }
    }
	/*
    public function actionBuildList(){
        $criteria=new CDbCriteria();
        $get = SearchMenu::explodeAllParamsToArray();
        $criteria = self::getOtherOrderCondition($criteria, $get);
        $criteria->addCondition('sbi_buildtype=1');//查询楼盘
        $dataProvider = new CActiveDataProvider('Systembuildinginfo',array(
			'pagination'=>array(
                'pageSize'=>20,
            ),
            'criteria'=>$criteria,
        ));
        $this->render('buildlist',array(
            'dataProvider'=>$dataProvider,
            'options'=>$get,//生成的数组。在前台生成连接时使用
        ));
    }
	*/
    public function actionPicList(){
        $albums="";
        $id="";
        if(isset($_GET["id"])&&$_GET["id"]){
            $id=$_GET["id"];
             $albums = Picture::model()->findAll(array('condition'=>'p_sourcetype=1 AND p_sourceid='.$id));
        }
       $this->renderPartial('piclist',array(
            "data"=>$albums,
       ));
        
    }
    public function actionShopBuildList(){
        $this->layout='shop';
        $get = SearchMenu::explodeAllParamsToArray();
        $criteria=new CDbCriteria();
        $criteria = self::getOtherOrderCondition($criteria, $get);
        $criteria->addCondition('sbi_buildtype=2');//查询商业广场
        $dataProvider = new CActiveDataProvider('Systembuildinginfo',array(
			'pagination'=>array(
                'pageSize'=>20,
            ),
            'criteria'=>$criteria,
        ));
        $seotkd = Seotkd::model()->findByPk(6);//SEO优化
        $this->render('shopbuildlist',array(
            'dataProvider'=>$dataProvider,
            'options'=>$get,//生成的数组。在前台生成连接时使用
            "ifShop"=>true,
            "seotkd"=>$seotkd,
        ));
    }
    /**
     * ajax 通过传入的build id，得到build的所有信息。
     */
    public function actionGetBuildInfo(){
        $buildingid = $_GET['buildingid'];
        $dba = dba();
        $_model = $dba->select_row("select * from 35_systembuildinginfo where `sbi_buildingid`=?",$buildingid);
        $_model['sbi_openingtime'] = date("Y-m-d",$_model['sbi_openingtime']);
        echo CJSON::encode($_model);
    }
    public function getOtherOrderCondition($criteria,$get){
        if($criteria->condition==""){//如果开始的时侯condition为空，则有个默认的condition
            $criteria->condition = "1";
        }
        //添加搜索条件
        if(isset($get['district'])&&$get['district']!=""){
            $criteria->condition .= " and sbi_district=".$get['district'];
        }
        if(isset($get['section'])&&$get['section']!=""){
            $criteria->condition .= " and sbi_section=".$get['section'];
        }
        if(isset($get['loop'])&&$get['loop']!=""){
            $result = Searchcondition::model()->getConditionValue($get['loop']);
            if(!empty($result)){
                $criteria->condition .= " and sbi_loop=".$result['max'];
            }
        }
        if(isset($get['metro'])&&$get['metro']!=""){
            $result = Searchcondition::model()->getConditionValue($get['metro']);
            if(!empty($result)){
                $criteria->condition .= " and sbi_busway like '%".$result['max']."%'";
            }
        }
        if(isset($get['tag'])&&$get['tag']!=""){
            $result = Tags::model()->findByPk($get['tag']);
            if(!empty($result)){
                $criteria->condition .= " and sbi_tag like '%".$result['tag_name']."%'";
                ////标签找房，标签点击后增加点击数
                $result->tag_frequency = $result->tag_frequency+1;
                $result->save();
            }
        }
        if(isset($get['avgr'])&&$get['avgr']!=""){
            $result = Searchcondition::model()->getConditionValue($get['avgr']);
            if(!empty($result)){
                $criteria->condition .= " and sbi_avgrentprice between '".$result['min']."' and '".$result['max']."'";
            }
        }
        if(isset($get['avgs'])&&$get['avgs']!=""){
            $result = Searchcondition::model()->getConditionValue($get['avgs']);
            if(!empty($result)){
                $criteria->condition .= " and sbi_avgsellprice between '".$result['min']."' and '".$result['max']."'";
            }
        }
        if(isset($get['keyword'])&&$get['keyword']!=""){
            $keyword = $get['keyword'];
            $idArr = common::getIdsBySphinxSearch($keyword, Yii::app()->params['buildIndex'],"array");
            $criteria->addInCondition('sbi_buildingid', $idArr);
        }
        //过滤排序状态
        if(isset($get['order'])&&$get['order']=="ru"){//如果设置平均租价的排序，并且排序向上
            $criteria->order =" sbi_avgrentprice";
        }
        if(isset($get['order'])&&$get['order']=="rd"){//如果设置平均租价的排序，并且排序向下
           $criteria->order =" sbi_avgrentprice desc";
        }
        if(isset($get['order'])&&$get['order']=="su"){//如果设置平均租价的排序，并且排序向上
            $criteria->order =" sbi_avgsellprice";
        }
        if(isset($get['order'])&&$get['order']=="sd"){//如果设置平均租价的排序，并且排序向下
           $criteria->order =" sbi_avgsellprice desc";
        }


        //根据开盘时间过滤
        if(isset($get['filterdate'])&&$get['filterdate']!=""){
            $filterdate = $get['filterdate'];
            $allFilterDate = Searchcondition::model()->getAllFilterOpenDate();
            if(array_key_exists($filterdate, $allFilterDate)){//数据准确

                $condition = Searchcondition::model()->getConditionValue($filterdate);//得到查询值
                switch($condition['max']){
                    case 1://本月开盘
                        $month = date("m");//当前月
                        $criteria = Systembuildinginfo::model()->getCriteriaByMonth($month, $criteria);
                        break;
                    case 2://下月开盘
                        $month = date("m")+1;//下月
                        $criteria = Systembuildinginfo::model()->getCriteriaByMonth($month, $criteria);
                        break;
                    case 3://今年开盘
                        $year = date("Y");//今年
                        $criteria = Systembuildinginfo::model()->getCriteriaByYear($year, $criteria);
                        break;
                }
            }
        }
        return $criteria;
    }
    /**
     * 楼盘详细参数
     */
    public function ViewDetails($type){
        //$this->layout='office';
        $model = $this->loadModel();
        $this->render('details',array(
            'model'=>$model,
            'type'=>$type,
        ));
    }
    /**
     * 楼盘经纪人
     */
    public function ViewAgent(){
        $model = $this->loadModel();
        $sql='SELECT t2.* FROM `{{officebaseinfo}}` t1
            RIGHT JOIN `{{uagent}}` t2 ON t1.`ob_uid`=t2.`ua_uid` LEFT JOIN `{{user}}` t3 ON t3.user_id=t2.ua_uid
            WHERE t1.`ob_sysid`='.$model->sbi_buildingid.' AND t1.`ob_check`=4 GROUP BY t1.`ob_uid` ORDER BY t3.`user_lasttime` DESC';
        $sqlCount='SELECT COUNT(*) FROM (SELECT t2.`ua_uid` FROM `{{officebaseinfo}}` t1
            RIGHT JOIN `{{uagent}}` t2 ON t1.`ob_uid`=t2.`ua_uid`
            WHERE t1.`ob_sysid`='.$model->sbi_buildingid.' AND t1.`ob_check`=4 GROUP BY t1.`ob_uid`) tttt ';
        $count = Yii::app()->db->createCommand($sqlCount)->queryScalar();
        $page=!empty($_GET['page'])?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $pageSize = 10;
        $offect = ($page - 1)*$pageSize;
        $limit = ' LIMIT '.$offect.','.$pageSize;
        $uagents = Yii::app()->db->createCommand($sql.$limit)->queryAll();

        $this->render('agent',array(
            'model'=>$model,
            'uagents'=>$uagents,
            'count'=>$count,
            'pageSize'=>$pageSize,
            'type'=>$type,
        ));
    }
    /**
     * 楼盘经纪人
     */
    public function ViewBlog(){
        $model = $this->loadModel();
        $this->render('blog',array(
            'model'=>$model,
            'type'=>$type,
        ));
    }
    /**
     * 楼盘周边配套
     */
    public function ViewAround($type){
        $model = $this->loadModel();
        $this->render('around',array(
            'model'=>$model,
            'type'=>$type,
        ));
    }
    /**
     * 楼盘详细参数
     */
    public function ViewAlbum($type){
        $model = $this->loadModel();
        $this->render('album',array(
            'model'=>$model,
            'type'=>$type,
        ));
    }
    public function viewComment($type){
        $id=@$_GET["id"];
        $model = $this->loadModel()->findByPk($id);
        $this->render('systembuildingcomment',array(
            "model"=>$model,
            'comments'=>self::getComment(1,$id),
            'ifShop'=>false,
            'type'=>$type,
        ));
    }
    /**
     * 楼盘主页
     */
    public function actionView(){
        $this->layout='office';
        $type="build";
        if(isset($_GET["type"])&&$_GET["type"]=="shop"){
            $this->layout='shop';
            $type="shop";
        }
        $tag = @$_GET["tag"];
        switch ($tag){
            default:
                $this->ViewIndex($type);break;
            case "album":
                $this->ViewAlbum($type);break;
             case "comment":
                $this->ViewComment($type);break;
            case "around":
                $this->ViewAround($type);break;
            case "agent":
                $this->ViewAgent($type);break;
            case "details":
                $this->ViewDetails($type);break;
        } 
    }
    private function ViewIndex($type){
        $model = $this->loadModel();
        if(common::isCanAddVisit('systembuilding_visit_ids', $model->sbi_buildingid)){
            $model->sbi_visit++;
            $model->update();
        }
        //楼盘访问历史
        $viewedBuilds = $model->buildViewMemory($model->sbi_buildingid);
//        if($model->sbi_buildtype==2){
//            $this->Redirect(array("/systembuildinginfo/viewshop","id"=>$model->sbi_buildingid));
//        }
        $request = array_map('trim',array_merge($_GET,$_POST));
        $_GET = array();
        foreach(array('id','srtp','floor','order','prst','pred','arst','ared','page') as $k){
            if(!empty($request[$k]))
                $_GET[$k] = $request[$k];
        }

        $criteria=new CDbCriteria(array(
			'condition'=>'ob_sysid='.$model->sbi_buildingid,
		));
        $criteria->addCondition('ob_check=4');
        $srtp = '1';//1rent,2sell
        if( !empty($request['srtp']) && in_array($request['srtp'], array('1', '2')) ){
            $srtp = $request['srtp'];
        }
        $criteria->with[] = 'user';
        $criteria->addCondition('ob_sellorrent='.$srtp);

        /* 排序 */
        $order='';
        if(!isset($request['order'])) $request['order'] = '';
        $order = $request['order'];
        $orders=array(
            'arasc'  => 'ob_officearea',
            'ardesc' => 'ob_officearea DESC',
            'prasc'  => 'ob_rentprice',
            'prdesc' => 'ob_rentprice DESC',
            'aprasc'  => 'ob_monthrentprice',
            'aprdesc' => 'ob_monthrentprice DESC',
        );
        if($srtp=='2'){//sale
            $orders['prasc']='ob_avgprice';
            $orders['prdesc']='ob_avgprice DESC';
            $orders['prasc']='ob_sumprice';
            $orders['prdesc']='ob_sumprice DESC';
        }

        $prst = $pred = 0;//价格范围
        if(!empty($request['prst'])){
            $prst = (int)$request['prst'];
        }
        if(!empty($request['pred'])){
            $pred = (int)$request['pred'];
        }
        if($prst && $pred && $prst>$pred){
            $_temp = $prst;
            $prst = $pred;
            $pred = $_temp;
        }
        if($prst){
            if($srtp=='1'){
                $criteria->addCondition('ob_rentprice>='.$prst);
            }else{
                $criteria->addCondition('ob_avgprice>='.$prst);
            }
        }
        if($pred){
            if($srtp=='1'){
                $criteria->addCondition('ob_rentprice<='.$prst);
            }else{
                $criteria->addCondition('ob_avgprice<='.$prst);
            }
        }
        if($order=='prasc') $criteria->order = $orders['prasc'];
        if($order=='prdesc') $criteria->order = $orders['prdesc'];
        if($order=='aprasc') $criteria->order = $orders['aprasc'];
        if($order=='aprdesc') $criteria->order = $orders['aprdesc'];

        $arst = $ared = 0;//面积范围
        if(!empty($request['arst'])){
            $arst = (int)$request['arst'];
        }
        if(!empty($request['ared'])){
            $ared = (int)$request['ared'];
        }
        if($arst && $ared && $arst>$ared){
            $_temp = $arst;
            $arst = $ared;
            $ared = $_temp;
            $request['arst'] = $arst;
            $request['ared'] = $ared;
        }
        if($arst) $criteria->addCondition('ob_officearea>='.$arst);
        if($ared) $criteria->addCondition('ob_officearea<='.$ared);
        if($order=='arasc') $criteria->order = $orders['arasc'];
        if($order=='ardesc') $criteria->order = $orders['ardesc'];

        $floor='';//楼层位置
        if(isset($request['floor']) && isset(Officebaseinfo::$ob_floortype[$request['floor']-1])){
            $floor = --$request['floor'];
            $criteria->addCondition('ob_floortype='.$floor);
        }
        $criteria->select = 'ob_officeid,ob_uid,ob_sellorrent,ob_floortype,ob_officearea,ob_rentprice,ob_monthrentprice,ob_avgprice,ob_sumprice';
        //echo '<pre>';
        //print_r($criteria);exit;
        $dataProvider = new CActiveDataProvider('Officebaseinfo', array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>10,
			),
		));
        @$id=$_GET['id'];
        $this->render('view',array(
            'model'=>$model,
            'dataProvider'=>$dataProvider,
            'comments'=>self::getComment(1,$id,"3","sbc_num desc"),
            'request'=>$request,
            'srtp'=>$srtp,
            'viewedBuilds'=>array_slice($viewedBuilds, -3),//最多最近访问3个楼盘
            'type'=>$type,
        ));
    }
    public function actionCompare(){
        $this->layout='office';
        $pkids = array();
        if(!empty($_GET['pk'])){
            foreach(explode('|', $_GET['pk']) as $id){
                $id = (int)$id;
                if($id)
                    $pkids[]=$id;
            }
            $pkids = array_unique($pkids);//去重
        }
        $count = count($pkids);
        if($count<2 || $count>3){
            throw new CHttpException(302,'只能对两个或者三个楼盘进行比较');
        }
        $pkbuilds = Systembuildinginfo::model()->findAll('sbi_buildingid IN('.implode(',', $pkids).')');
        $this->render('compare',array(
            'pkbuilds'=>$pkbuilds,
        ));
    }
    /**
     * Displays a particular model.
     */
    public function actionViewShop() {
        $this->layout = "shop";
        $model = $this->loadModel();//如果是楼盘，要跳转到楼盘
        if($model->sbi_buildtype==1){
            $this->Redirect(array("/systembuildinginfo/view","id"=>$model->sbi_buildingid));
        }
        if(common::isCanAddVisit('systembuilding_visit_ids', $model->sbi_buildingid)){
            $model->sbi_visit++;
            $model->update();
        }
        $newComment=new Systembuildingcomment;
        $addImpression = $this->newImpression($model);//返回添加印象的状态
        $commentsProvider = Systembuildingcomment::model()->getCommentByBuildingId($model->sbi_buildingid,5);//最近的5条评论

        $criteria=new CDbCriteria();
        $criteria->addCondition('sbc_buildingid='.$model->sbi_buildingid);
        $commentCount=Systembuildingcomment::model()->count($criteria);

        $pictures = Picture::model()->getAllPictures($model->sbi_buildingid,Picture::$sourceType['systembuilding']);//楼盘图片
        $impressions = Impression::model()->getSeveralImpression($model->sbi_buildingid,Impression::systembuilding); //楼盘印象
        $twitterMessage = Twitter::model()->getTwitterMessageByBuildingId($model->sbi_buildingid);
        $shopinfo_rent = Shopbaseinfo::model()->getShopInfoByBuildid($model->sbi_buildingid,1,10);;//商业广场正在租的信息
        $shopinfo_sell = Shopbaseinfo::model()->getShopInfoByBuildid($model->sbi_buildingid,2,10);;//商业广场正在售的信息
        $nearBuild = Systembuildinginfo::model()->getNearBuildByBuildId($_GET['id'],8,2);//周边商业广场
        $this->render('viewShop',array(
            'model'=>$model,
            'pictures'=>$pictures,
            'commentsProvider'=>$commentsProvider,
            'newComment'=>$newComment,
            'impressions'=>$impressions,
            'addImpression'=>$addImpression,
            'twitterMessage'=>$twitterMessage,
            'newImpression'=>new Impression(),
            'shopinfo_rent'=>$shopinfo_rent,
            'shopinfo_sell'=>$shopinfo_sell,
            'nearBuild'=>$nearBuild,
            'commentCount'=>$commentCount,
        ));
    }
    protected function newImpression($buildingInfo){
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
                        $publishState = Impression::model()->checkPublished($userId,$buildingInfo->sbi_buildingid,Impression::systembuilding);
                        if($publishState){//发表过
                            $result = 4;
                        }else{
                            $result = 2;//不是成功就是失败
                            $impression = new Impression();
                            if($buildingInfo){
                                $impression->setAttribute('im_sourceid',$buildingInfo->sbi_buildingid);
                                $impression->setAttribute('im_sourcetype',Impression::systembuilding);
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
     public function actionAddCommentLog()
	{
           if(Yii::app()->user->isGuest){
                echo  "请先登录!";
            }else{
            $commentlog=new Systembuildingcommentlog;
                if(!$commentlog->findByAttributes(array("sbcl_cid"=>$_POST["sbcl_cid"],"sbcl_uid"=>Yii::app()->user->id))){
                $commentlog->attributes=$_POST;
                $commentlog->attributes=array("sbcl_uid"=>Yii::app()->user->id);
                $comment=Systembuildingcomment::model()->findByPk($_POST["sbcl_cid"]);
                $comment->sbc_num=$comment->sbc_num+1;
                    if($commentlog->save()&&$comment->update()){
                    }else{
                        echo "投票失败！";
                        //echo $commentlog->error().$comment->error();
                    }
                }else{
                     echo "这条评论你已经投过票了！";
                }
            }
	}
    public function actionAddComment(){;
        $comment=new Systembuildingcomment;
        $model = $this->loadModel();
     
        if(isset($_POST['ajax']) && $_POST['ajax']==='systembuildingcomment-form')
		{
			echo CActiveForm::validate($comment);
			Yii::app()->end();
		}

        if(isset($_POST['Systembuildingcomment']))
        {
              $post=$_POST['Systembuildingcomment'];
            if(Yii::app()->user->isGuest){
                echo  "请先登录!";
            }else{
                
                    if(isset($_POST["sbc_evaluation"])&&$_POST["sbc_evaluation"]){
                         $post["sbc_evaluation"]=$_POST["sbc_evaluation"];
                    }
                     
                    if(isset($_POST['Systembuildingcomment']['verify'])){
                            //获取验证码内容

                            $checkVerify = $this->createAction('captcha')->validate($_POST['Systembuildingcomment']['verify'],false);
                            if($checkVerify){
                                $comment->attributes=$post;
                                $result = $model->addComment($comment);
                                echo $result['speak'];
                                /*if($result['state']){//发表成功就返回一个新的表单
                                    return new Systembuildingcomment();
                                }*/
                            }else{
                                echo "验证码错误!";
                            }
                    }else{
                        echo "请输入验证码!";
                    }
            }
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        header("Location:".DOMAIN);
//        $this->layout='main';
//        $metros = Searchcondition::model()->getAllMetros();//地铁
//        $rentPriceConditions = Searchcondition::model()->getAvgRentPriceCondition();
//        $sellPriceConditions = Searchcondition::model()->getAvgSellPriceCondition();
//        $cityInfo = Region::model()->getDistrictAndSection();//得到上海市信息和上海市下的行政区
//        $recentNewBuildings = Systembuildinginfo::model()->getRecentNewBuildings();//新上市楼盘
//        $curMonthBuildings = Systembuildinginfo::model()->getCurMonthOpenBuildings();//本月开盘
//        $nextMonthBuildings = Systembuildinginfo::model()->getNextMonthOpenBuildings();//下月开盘
//        $hotBuildings = Systembuildinginfo::model()->getHotAttentionBuildings();//最热门楼盘
//        $list = Buyproduct::model()->getProductByPageAndPosition(1,1);//精品写字楼楼盘推荐
//        $recentComments = Systembuildingcomment::model()->getRecentComment(3);//最近3条点评消息
//        $welcomeBuildings = Systembuildinginfo::model()->getWelcomeBuildings(3);//得到最受欢迎的楼盘信息
//        $seotkd = Seotkd::model()->findByPk(5);//SEO优化
//
////        $buildingTags = Tags::model()->getTagsByType(Tags::systemBuildings);
//        $buildingrecommend = Buyproduct::model()->getProductByPageAndPosition(1,6);//三个楼盘切换
//
//        $this->render('index',array(
//            'metros'=>$metros,
//            'rentPriceConditions'=>$rentPriceConditions,
//            'sellPriceConditions'=>$sellPriceConditions,
//            'districts'=>$cityInfo->districts,
//            'recentNewBuildings'=>$recentNewBuildings,
//            'curMonthBuildings'=>$curMonthBuildings,
//            'nextMonthBuildings'=>$nextMonthBuildings,
//            'hotBuildings'=>$hotBuildings,
//            'list'=>$list,
//            'recentComments'=>$recentComments,
//            'welcomeBuildings'=>$welcomeBuildings,
////            'buildingTags'=>$buildingTags,
//            'buildingrecommend'=>$buildingrecommend,
//            'seotkd'=>$seotkd,
//        ));
    }
       /**
     * Lists all models.
     */

    public function actionShopIndex() {
        $this->layout='shop';//暂时保留layouts/shopIndex.php，待美工设计好商业广场的样式和布局后再删除。
        $metros = Searchcondition::model()->getAllMetros();//地铁
        $rentPriceConditions = Searchcondition::model()->getAvgRentPriceCondition();
        $sellPriceConditions = Searchcondition::model()->getAvgSellPriceCondition();
        $cityInfo = Region::model()->getDistrictAndSection();//得到上海市信息和上海市下的行政区
        $recentNewBuildings = Systembuildinginfo::model()->getRecentNewBuildings(20,2);//新上市商业广场
        $curMonthBuildings = Systembuildinginfo::model()->getCurMonthOpenBuildings(2);//本月开盘
        $nextMonthBuildings = Systembuildinginfo::model()->getNextMonthOpenBuildings(2);//下月开盘
        $hotBuildings = Systembuildinginfo::model()->getHotAttentionBuildings(6,2);//最热门商业广场
        $list = Buyproduct::model()->getProductByPageAndPosition(12,10);//精品商铺推荐
        $recentComments = Systembuildingcomment::model()->getRecentComment(3,2);//最近3条点评消息
        $welcomeBuildings = Systembuildinginfo::model()->getWelcomeBuildings(3,2);//得到最受欢迎的商业广场信息
//        $buildingTags = Tags::model()->getTagsByType(Tags::systemBuildingsShop);//标签
        $buildingrecommend = Buyproduct::model()->getProductByPageAndPosition(12,6);//三个商业广场切换

        $seotkd = Seotkd::model()->findByPk(6);//SEO优化

        $this->render('shopIndex',array(
            'metros'=>$metros,
            'rentPriceConditions'=>$rentPriceConditions,
            'sellPriceConditions'=>$sellPriceConditions,
            'districts'=>$cityInfo->districts,
            'recentNewBuildings'=>$recentNewBuildings,
            'curMonthBuildings'=>$curMonthBuildings,
            'nextMonthBuildings'=>$nextMonthBuildings,
            'hotBuildings'=>$hotBuildings,
            'list'=>$list,
            'recentComments'=>$recentComments,
            'welcomeBuildings'=>$welcomeBuildings,
//            'buildingTags'=>$buildingTags,
            'buildingrecommend'=>$buildingrecommend,
            'seotkd'=>$seotkd,
        ));
    }
    /**
     * 最新上市楼盘,该方法可能无效，修改时注意，如果确定无效，请删除。
     */
    public function actionRecentNew(){
        $pageNum = 2;//每页显示10条
        $criteria = new CDbCriteria(array(
            "condition"=>"`sbi_isnew`=1",
        ));
        $pages = new CPagination(Systembuildinginfo::model()->count($criteria));
        $pages->pageSize = $pageNum;
        $pages->applyLimit($criteria);
        $dataProvider = new CActiveDataProvider('Systembuildinginfo',array(
			'pagination'=>$pages,
            'criteria'=>$criteria,
        ));
        $this->render('recentNew',array(
            'recentNewBuildings'=>$dataProvider,
        ));
    }
    public function actionShopComment(){
        $this->layout='shop';
        $this->render('shopcomment',array(
            'comments'=>self::getComment(2),
            'ifShop'=>true,
        ));
    }
    /**
     * 最新的点评信息
     */
    public function actionComment(){
        $this->render('comment',array(
            'comments'=>self::getComment(1),
            'ifShop'=>false,
        ));
    }
    public function getComment($sbi_buildtype,$id="",$pageNum="10",$order="sbc_comdate desc"){
        //$pageNum = 10;
        $criteria=new CDbCriteria(array(
            'order'=>$order,
        ));

        //添加搜索条件
        $withcondition = "sbi_buildtype=".$sbi_buildtype;
        if($id){
        $withcondition = "sbc_buildingid =".$id;
        }
        if(isset($_GET['district'])&&$_GET['district']!=""){
            $withcondition .= " and sbi_district=".$_GET['district'];
        }
        if(isset($_GET['section'])&&$_GET['section']!=""){
            $withcondition .= " and sbi_section=".$_GET['section'];
        }
        if(isset($_GET['loop'])&&$_GET['loop']!=""){
            $result = Officebaseinfo::model()->getSearchCondition($_GET['loop']);
            if(!empty($result)){
                $withcondition .= " and sbi_loop=".$result['max'];
            }
        }
        if(isset($_GET['keyword'])&&$_GET['keyword']!=""){
            $withcondition .= " and sbi_buildingname like '%".$_GET['keyword']."%'";
        }
        
        $criteria->with=array(
            'buildingInfo'=>array(
                'condition'=>$withcondition,
            ),
            'userInfo'
        );
        $pages = new CPagination(Systembuildingcomment::model()->count($criteria));
        $pages->pageSize = $pageNum;
        $pages->applyLimit($criteria);
        $dataProvider = new CActiveDataProvider('Systembuildingcomment',array(
            'pagination'=>$pages,
            'criteria'=>$criteria,
        ));
        return $dataProvider;
    }
    /**
     * Lists all models.
     */
    public function actionManageIndex() {
        $dataProvider=new CActiveDataProvider('Systembuildinginfo');
        $this->render('manageIndex',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel() {
        if($this->_model===null) {
            if(isset($_GET['id']))
                $this->_model=Systembuildinginfo::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'很抱歉，您所访问的楼盘不存在！');
        }
        return $this->_model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if(isset($_POST['ajax']) && $_POST['ajax']==='systembuildinginfo-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    //热租房源更多
    public function actionViewRentMore(){
        if($_GET['id']){
            $id = $_GET['id'];
            $buildInfo = Systembuildinginfo::model()->findByAttributes(array("sbi_buildingid"=>$id));
            if($buildInfo){
                $keyword = $buildInfo->sbi_buildingname;
                $keyword = urlencode($keyword);
                $rentIndexStr="officebaseinfo/rentIndex";
                $url=Yii::app()->createUrl($rentIndexStr,SearchMenu::dealOptions(array(), "keyword", $keyword));
                $this->Redirect($url);
            }
        }
    }
    //热售房源更多
    public function actionViewSaleMore(){
        if($_GET['id']){
            $id = $_GET['id'];
            $buildInfo = Systembuildinginfo::model()->findByAttributes(array("sbi_buildingid"=>$id));
            if($buildInfo){
                $keyword = $buildInfo->sbi_buildingname;
                $keyword = urlencode($keyword);
                $sellIndexStr="officebaseinfo/saleIndex";
                $url=Yii::app()->createUrl($sellIndexStr,SearchMenu::dealOptions(array(), "keyword", $keyword));
                $this->Redirect($url);
            }
        }
    }
    //热租房源更多
    public function actionShopViewRentMore(){
        if($_GET['id']){
            $id = $_GET['id'];
            $buildInfo = Systembuildinginfo::model()->findByAttributes(array("sbi_buildingid"=>$id));
            if($buildInfo){
                $keyword = $buildInfo->sbi_buildingname;
                $keyword = urlencode($keyword);
                $rentIndexStr='shop/rentIndex';
                $url=Yii::app()->createUrl($rentIndexStr,SearchMenu::dealOptions(array(), "keyword", $keyword));
                $this->Redirect($url);
            }
        }
    }
    //热售房源更多
    public function actionShopViewSaleMore(){
        if($_GET['id']){
            $id = $_GET['id'];
            $buildInfo = Systembuildinginfo::model()->findByAttributes(array("sbi_buildingid"=>$id));
            if($buildInfo){
                $keyword = $buildInfo->sbi_buildingname;
                $keyword = urlencode($keyword);
                $sellIndexStr='shop/sellIndex';
                $url=Yii::app()->createUrl($sellIndexStr,SearchMenu::dealOptions(array(), "keyword", $keyword));
                $this->Redirect($url);
            }
        }
    }
        //新盘LIST START
    private function ListFunction($url,$type){
        $get = SearchMenu::explodeAllParamsToArray();
        $newbuild=Newbuild::model()->findAll();
        $dataProvider = self::getDataProvider($get,$newbuild);//默认条件:上海城市的租房信息
        $seotkd = Seotkd::model()->findByPk(5);
        $this->render('buildlist',array(
                'dataProvider'=>$dataProvider,
                'options'=>$get,//生成的数组。在前台生成连接时使用
                'seotkd'=>$seotkd,//SEO优化
                'url'=>$url,//url
                'type'=>$type,
        ));

    }
     public function actionNewBuildIndex() {
        $this->layout='shop';
        $url="newsystembuildinfo/newbuildindex";
        $type="shop";
        $this->ListFunction($url,$type);

    }
    public function actionNewBuildList() {
        $url="newsystembuildinfo/newbuildlist";
        $type="build";
        $this->ListFunction($url,$type);
    }

	private function  getDataProvider($get,$newbuild) {
		$criteria=new CDbCriteria();
		if(count($newbuild)>0){
			foreach($newbuild as $val){
				$criteria->addCondition("sbi_buildingid=".$val["nb_sid"],"OR");
			}
		}else{
            $criteria->addCondition("sbi_buildingid=''");
        }
        $criteria->with=array("new");
		//区间判断
		if(isset($get['district'])){
			$criteria->addCondition("sbi_district={$get['district']}");
		}
		//板块判断
		if(isset($get['section'])){
			$criteria->addCondition("sbi_section={$get['section']}");
		}
		//交通判断
		if(isset($get['metro'])){
			$criteria->addInCondition("sbi_busway",array(Searchcondition::model()->find("sc_id={$get['metro']}")->sc_maxvalue));
		}
		//租金判断
		if(isset($get['avgr'])){
			
			$rPrice=Searchcondition::model()->find("sc_id={$get['avgr']}");
			$criteria->compare("sbi_avgrentprice","<={$rPrice->sc_maxvalue}");
			$criteria->compare("sbi_avgrentprice",">={$rPrice->sc_minvalue}");
		}
		if(isset($get['avgra'])){		
			$criteria->compare("sbi_avgrentprice",">={$get['avgra']}");
		}
		if(isset($get['avgrb'])){		
			$criteria->compare("sbi_avgrentprice","<={$get['avgrb']}");
		}
		//售价判断
		if(isset($get['avgs'])){
			
			$sPrice=Searchcondition::model()->find("sc_id={$get['avgs']}");
			$criteria->compare("sbi_avgsellprice","<={$sPrice->sc_maxvalue}");
			$criteria->compare("sbi_avgsellprice",">={$sPrice->sc_minvalue}");
		}
		if(isset($get['avgsa'])){		
			$criteria->compare("sbi_avgsellprice",">={$get['avgsa']}");
		}
		if(isset($get['avgsb'])){		
			$criteria->compare("sbi_avgsellprice","<={$get['avgsb']}");
		}
		//楼盘名字搜索
		if(isset($get['keyword']) && $get['keyword']!="") {
            $keyword = $get['keyword'];
            $idArr = @common::getIdsBySphinxSearch($keyword, Yii::app()->params['buildIndex'],"array");
            $criteria->addInCondition('sbi_buildingid', $idArr);
        }
       
       $criteria->order = "sbi_officenum desc";
		if(isset($get["order"])){
            $get["order"]=="wa"?$criteria->order = "sbi_propertyprice":"";//物业管理费从低到高
            $get["order"]=="wd"?$criteria->order = "sbi_propertyprice desc":"";//物业管理费从高到低
            $get["order"]=="da"?$criteria->order = "sbi_defanglv":"";//得房率从低到高
            $get["order"]=="dd"?$criteria->order = "sbi_defanglv desc":"";//得房率从高到低
            $get["order"]=="zu"?$criteria->order = "sbi_avgrentprice":"";//租金从低到高
            $get["order"]=="zd"?$criteria->order = "sbi_avgrentprice desc":"";//租金从高到低
            $get["order"]=="su"?$criteria->order = "sbi_avgsellprice":"";//售价从低到高
            $get["order"]=="sd"?$criteria->order = "sbi_avgsellprice desc":"";//售价从高到低
			$get["order"]=="jd"?$criteria->order = "sbi_openingtime":"";//售价从低到高
            $get["order"]=="ju"?$criteria->order = "sbi_openingtime desc":"";//售价从高到低
        }
        $dataProvider=new CActiveDataProvider('Systembuildinginfo', array(
                        'pagination'=>array(
                                'pageSize'=>10,
                        ),
                      'criteria'=>$criteria,
        )
		);

        return $dataProvider;

    }
	//楼盘LIST END

}