<?php
Yii::import('application.common.*');
require_once('common.php');

class OfficebaseinfoController extends Controller {

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
     * 查询是否已经举报
     * @param <int> $buildingId
     * @param <int> $buildingType
     * @param <string> $ip
     * @return <boolean>
     */
    public function hasShowReport($buildingId,$buildingType,$ip){
        $num=Report::model()->count("r_sinfulbuildid=:buildingId and r_buildtype=:buildingType and r_informantip=:ip",array(':buildingId'=>$buildingId,':buildingType'=>$buildingType,':ip'=>$ip));
        if($num>0)
            return true;
        else
            return false;
    }

    /**
     * Displays a particular model.
     */
//    public function actionRentView() {
//        //只显示发布状态的房源
//        $tagInfo = Officetag::model()->findByAttributes(array('ot_officeid'=>$_GET['id']));
//        if(!$tagInfo||$tagInfo->ot_check!=4){
//            throw new CHttpException(404,'您请求的房源不存在或者已经下线！');
//        }
//        self::RentViewInfo();
//    }
    /**
     * Displays a particular model.
     */
//    public function actionSaleView() {
//        //只显示发布状态的房源
//        $tagInfo = Officetag::model()->findByAttributes(array('ot_officeid'=>$_GET['id']));
//        if(!$tagInfo||$tagInfo->ot_check!=4){
//            throw new CHttpException(404,'您请求的房源不存在或者已经下线！');
//        }
//        self::SaleViewInfo();
//    }
//    public function actionViewinfo(){
//        if( $view=Officebaseinfo::model()->findByPk($_GET['id']) ){
//            if($view->ob_sellorrent=='1')
//                self::RentViewInfo();
//            else
//                self::SaleViewInfo();
//        }else{
//            throw new CHttpException(404,'您请求的房源不存在或者已经下线！');
//        }
//    }
    /**
     * 写字楼房源详细查看
     */
    public function actionView(){
        $model = $this->loadModel();
        $sysModel = Systembuildinginfo::model()->findByPk($model->ob_sysid);
        $agentModel = Uagent::model()->find('ua_uid='.$model->ob_uid);
        $this->layout='office';
        if(common::isCanAddVisit('office_visit_ids', $model->ob_officeid)){
            $model->ob_visit++;
            $model->update();
        }
        $ownerInfo = User::model()->findByPk($model->ob_uid);//得到发布者的user信息
        if(!$ownerInfo || !$sysModel){
            throw new CHttpException(404,'此房源已过期，访问失败！');
        }
        $pictures = Picture::model()->findAll('`p_sourceid`=? AND `p_sourcetype`=?',array($model->ob_officeid,Picture::$sourceType['officebaseinfo']));
        $this->render('view',array(
            'model'=>$model,
            'sysModel'=>$sysModel,
            'agentModel'=>$agentModel,
            'pictures'=>$pictures,
        ));
    }
//    private function RentViewInfo(){
//        $prentInfo = Officepresentinfo::model()->findByAttributes(array('op_officeid'=>$_GET['id']));
//        $model = Officebaseinfo::model()->findByPk($prentInfo->op_officeid);
//        if(common::isCanAddVisit('office_visit_ids', $model->ob_officeid)){
//            $model->ob_visit++;
//            $model->ob_order+=common::getOrderConfigVisit($model->ob_visit);
//            $model->update();
//        }
//        RecentView::addViewTrace($model['ob_officeid'], RecentView::officebaseinfo, RecentView::rent);
//        $rentInfo = Officerentinfo::model()->findByAttributes(array('or_officeid'=>$model->ob_officeid));
//        $ownerInfo = User::model()->findByPk($model->ob_uid);//得到发布者的user信息
//        if(!$ownerInfo){
//            throw new CHttpException(404,'此房源所属的经纪人已经被删除，访问失败！');
//        }
//
//        $buildingInfo = Systembuildinginfo::model()->findByPk($model->ob_sysid);//楼盘信息
//
//        $pictures = Picture::model()->getAllPictures($model->ob_officeid,Picture::$sourceType['officebaseinfo']);//写字楼图片
////        $officeRentTags = Tags::model()->getTagsByTypeAndMarke(Tags::office,Tags::rent,10);
//        $recentComment = Systembuildingcomment::model()->getRecentCommentByBuildId($model->ob_sysid);//最新的评论
//        $impressions = Impression::model()->getLimitImpression($model->ob_sysid,Impression::systembuilding,10); //楼盘印象
//
//
//        $this->render('rentView',array(
//                'model'=>$model,
//                'prentInfo'=>$prentInfo,
//                'rentInfo'=>$rentInfo,
//                'ownerInfo'=>$ownerInfo,
//                'buildingInfo'=>$buildingInfo,
//                'pictures'=>$pictures,
////            'officeRentTags'=>$officeRentTags,
//                'recentComment'=>$recentComment,
//                'impressions'=>$impressions,
//        ));
//    }
////    private function SaleViewInfo(){
////        $prentInfo = Officepresentinfo::model()->findByAttributes(array('op_officeid'=>$_GET['id']));
////        $model = Officebaseinfo::model()->findByPk($prentInfo->op_officeid);
////        if(common::isCanAddVisit('office_visit_ids', $model->ob_officeid)){
////            $model->ob_visit++;
////            $model->ob_order+=common::getOrderConfigVisit($model->ob_visit);
////            $model->update();
////        }
////        RecentView::addViewTrace($model['ob_officeid'], RecentView::officebaseinfo, RecentView::sell);
////        $sellInfo = Officesellinfo::model()->findByAttributes(array('os_officeid'=>$model->ob_officeid));
////        $ownerInfo = User::model()->findByPk($model->ob_uid);//得到发布者的user信息
////        if(!$ownerInfo){
////            throw new CHttpException(404,'此房源所属的经纪人已经被删除，访问失败！');
////        }
////        $buildingInfo = Systembuildinginfo::model()->findByPk($model->ob_sysid);
////        $pictures = Picture::model()->getAllPictures($model->ob_officeid,Picture::$sourceType['officebaseinfo']);//写字楼图片
//////        $officeSellTags = Tags::model()->getTagsByTypeAndMarke(Tags::office,Tags::sell,10);
////        $recentComment = Systembuildingcomment::model()->getRecentCommentByBuildId($model->ob_sysid);//最新的评论
////        $impressions = Impression::model()->getLimitImpression($model->ob_sysid,Impression::systembuilding,10); //楼盘印象
////
////        $this->render('saleView',array(
////                'model'=>$model,
////                'prentInfo'=>$prentInfo,
////                'sellInfo'=>$sellInfo,
////                'ownerInfo'=>$ownerInfo,
////                'buildingInfo'=>$buildingInfo,
////                'pictures'=>$pictures,
//////            'officeSellTags'=>$officeSellTags,
////                'recentComment'=>$recentComment,
////                'impressions'=>$impressions,
////        ));
////    }

    /**
     * 房租搜索首页
     */
    public function actionRentIndex() {
        $this->getRentIndexInfo();
    }
    private function getRentIndexInfo(){
        $get = SearchMenu::explodeAllParamsToArray();
        $dataProvider = self::getDataProvider($get, 1);//默认条件:上海城市的租房信息

        $seotkd = Seotkd::model()->findByPk(2);
        $this->render('searchIndex',array(
                'dataProvider'=>$dataProvider,
                'options'=>$get,//生成的数组。在前台生成连接时使用
                'seotkd'=>$seotkd,//SEO优化
                'saleOrRent'=>1,
                'url'=>"officebaseinfo/rentIndex",//url
        ));
    }

    public function actionAjaxGetSource(){
        $start = $_GET["start"];
        $saleOrRent = $_GET["saleOrRent"];;
        $buildid = $_GET["buildid"];
        $condition = $_GET["condition"];
        
        $all = Officebaseinfo::model()->getSaleOrRentSourceByCondition($buildid, $saleOrRent, $condition);
        $all = Officebaseinfo::model()->getTmpSource($all,$start,5,$saleOrRent);
        echo json_encode($all);
        exit;
    }


    /**
     * 写字楼出售页面
     */
    public function actionSaleIndex() {
        $get = SearchMenu::explodeAllParamsToArray();
        $dataProvider = self::getDataProvider($get, 2);//默认条件:上海城市的卖房信息

        $seotkd = Seotkd::model()->findByPk(3);
        $this->render('searchIndex',array(
                'dataProvider'=>$dataProvider,
                'options'=>$get,//生成的数组。在前台生成连接时使用
                'seotkd'=>$seotkd,//SEO优化
                'saleOrRent'=>2,
                'url'=>"officebaseinfo/saleIndex",//url
        ));
    }

    /**
     * 查询符合条件的数据
     * @param <array> get参数集合
     * @param <string> 是出租还是出售,值为:1 2
     * @return <type>
     */
    private function  getDataProvider($get, $rentOrSale) {
        $regionParamToColumn = array(
                'district'=>'sbi_district',
                'section'=>'sbi_section',
        );
        $criteria=new CDbCriteria();
        
        $criteria->addColumnCondition(array("ob_check"=>4,"ob_sellorrent"=>$rentOrSale));
        $criteria->addCondition("sbi_buildingid!=''");
//        $criteria->select = "count(ob_sysid) as num,ob_sysid";
        $criteria->select = "max(ob_updatedate) as ob_updatedate,ob_sysid";
        if(isset($get['keyword']) && $get['keyword']!="") {
            $keyword = $get['keyword'];
            $idArr = @common::getIdsBySphinxSearch($keyword, Yii::app()->params['buildIndex'],"array");
            $criteria->addInCondition('ob_sysid', $idArr);
        }

        $regionParams = SearchMenu::getRegionParams();//得到地区搜索条件参数名称集合
        foreach($regionParams as $regionParam) {
            if(isset($get[$regionParam]) && $get[$regionParam]!="") {
                if(array_key_exists($regionParam,$regionParamToColumn)) {
                    $criteria->addColumnCondition(array($regionParamToColumn[$regionParam]=>$get[$regionParam]));
                }
            }
        }
        $criteria = Officebaseinfo::model()->getTempleteSearchCriteria($criteria, $rentOrSale, $get);
        $criteria->group = "ob_sysid";

        $criteria->with["buildingInfo"] = array("select" => "sbi_buildingid");
        
        //排序
        $criteria->order = "ob_updatedate desc";
        if(isset($get["order"])){
            $get["order"]=="wa"?$criteria->order = "sbi_propertyprice":"";//物业管理费从低到高
            $get["order"]=="wd"?$criteria->order = "sbi_propertyprice desc":"";//物业管理费从高到低
            $get["order"]=="da"?$criteria->order = "sbi_defanglv":"";//得房率从低到高
            $get["order"]=="dd"?$criteria->order = "sbi_defanglv desc":"";//得房率从高到低
            $get["order"]=="zu"?$criteria->order = "sbi_avgrentprice":"";//租金从低到高
            $get["order"]=="zd"?$criteria->order = "sbi_avgrentprice desc":"";//租金从高到低
            $get["order"]=="su"?$criteria->order = "sbi_avgsellprice":"";//售价从低到高
            $get["order"]=="sd"?$criteria->order = "sbi_avgsellprice desc":"";//售价从高到低
            $get["order"]=="ju"?$criteria->order = "sbi_openingtime":"";//竣工年月从低到高
            $get["order"]=="jd"?$criteria->order = "sbi_openingtime desc":"";//竣工年月从高到低
        }
//        echo "<pre>";print_r($criteria);exit;
        $dataProvider=new CActiveDataProvider('Officebaseinfo', array(
                        'pagination'=>array(
                                'pageSize'=>10,
                        ),
                        'criteria'=>$criteria,
            'totalItemCount'=>count(Officebaseinfo::model()->findAll($criteria)),//因为有group。CActiveDataProvider统计总条数有问题
        ));
        return $dataProvider;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel() {
        if($this->_model===null) {
            if(isset($_GET['id']))
                $this->_model=Officebaseinfo::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if(isset($_POST['ajax']) && $_POST['ajax']==='officebaseinfo-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * 商务中心首页展示
     */
    public function actionBusinessIndex() {
        $this->layout="main";
        //商务中心精选
        $officerecommend = Buyproduct::model()->getProductByPageAndPosition(4,5);
        //获取所有有效的房源标签ID
//        $rentTags = Tags::model()->getTagsByTypeAndMarke(Tags::business,Tags::rent,10);
        //按标志物找房
        $alldistrict = Region::model()->getArea();
        //渲染视图
        $seotkd = Seotkd::model()->findByPk(4); //SEO优化
        $this->render('businessIndex',array(
                'officerecommend'=>$officerecommend,
//            'rentTags'=>$rentTags,
                'alldistrict'=>$alldistrict,
                'seotkd'=>$seotkd
        ));
    }

    public function actionBusinessBidd(){
        //商务中心精选
        $filtertype = $_POST['filtertype'];
        $list = Officebaseinfo::model()->getBusinessBidd(4,5,$filtertype);
        $this->renderPartial('businessBidd', array('list'=>$list));
        exit;
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
    //商务中心概述
    public function actionBusinessSummarize(){
        $this->layout="main";
        $va = va();
        $va->check(array(
                'opid'=>array('not_blank','uint'),
                'tab'=>array(),
        ));
        if($va->success){
            $officebaseInfo = Officebaseinfo::model()->findbyPk($va->valid['opid']);//获取商务中心基本信息
            if($officebaseInfo){//表明有这样的数据
                $officePresentInfo = Officepresentinfo::model()->findByAttributes(array('op_officeid'=>$va->valid['opid']));//商务中心展示信息
                if(common::isCanAddVisit('office_visit_ids', $officebaseInfo->ob_officeid)){
                    $officebaseInfo->ob_visit++;
                    $officebaseInfo->ob_order+=common::getOrderConfigVisit($officebaseInfo->ob_visit);
                    $officebaseInfo->update();
                }
                $rentorsell = $officebaseInfo->ob_sellorrent==Officebaseinfo::rent?RecentView::rent:RecentView::sell;
                RecentView::addViewTrace($va->valid['opid'], RecentView::business, $rentorsell);//增加最近浏览

                //周边商务中心
                $aroundBusiness = Officebaseinfo::model()->with(array('rentInfo','offictag'=>array('condition'=>'ot_check=4')))->findAllByAttributes(array('ob_district'=>$officebaseInfo->ob_district,'ob_buildingtype'=>1),array(
                        'limit'=>10,
                ));

                //获取地图显示信息。显示地图包括坐标、名称。
                $sysbuildinfo = Systembuildinginfo::model()->findbyPk($officebaseInfo->ob_sysid);

                $ownerInfo = User::model()->findByPk($officebaseInfo->ob_uid);//得到发布者的user信息

                $this->render('businessSummarize',array(
                        'tab'=>$va->valid['tab'],
                        'officePresentInfo'=>$officePresentInfo,
                        'officeBaseinfo'=>$officebaseInfo,//商务中心基本信息
                        'aroundBusiness'=>$aroundBusiness,//周边商铺
                        'sysbuildinfo'=>$sysbuildinfo,//商铺所属的楼盘
                        'ownerInfo'=>$ownerInfo,
                        'contents'=>"businessSummarize",
                ));
            }else{
                throw new CHttpException(404,'错误的链接页面.');
            }
        }else{
            $this->redirect(array("site/index"));
        }
    }
    //商务中心平面图
    public function actionBusinessIchnography(){
        $this->layout="main";
        $va = va();
        $va->check(array(
                'opid'=>array('not_blank','uint'),
                'tab'=>array(),
        ));
        if($va->success){
            $officebaseInfo = Officebaseinfo::model()->findbyPk($va->valid['opid']);//获取商务中心基本信息
            if($officebaseInfo){//表明有这样的数据
                $officePresentInfo = Officepresentinfo::model()->findByAttributes(array('op_officeid'=>$va->valid['opid']));//商务中心展示信息
                $rentorsell = $officebaseInfo->ob_sellorrent==Officebaseinfo::rent?RecentView::rent:RecentView::sell;
                RecentView::addViewTrace($va->valid['opid'], RecentView::business, $rentorsell);//增加最近浏览

                //周边商务中心
                $aroundBusiness = Officebaseinfo::model()->with(array('rentInfo','offictag'=>array('condition'=>'ot_check=4')))->findAllByAttributes(array('ob_district'=>$officebaseInfo->ob_district,'ob_buildingtype'=>1),array(
                        'limit'=>10,
                ));

                //获取该商务中心对应的经纪人信息
                $userId = Officebaseinfo::model()->getUserIdByOfficeId($va->valid['opid']);
                $uagent = Viewuagent::model()->getUagentinfo($userId);
                //获取地图显示信息。显示地图包括坐标、名称。
                $sysbuildinfo = Systembuildinginfo::model()->findbyPk($officebaseInfo->ob_sysid);

                //获取房源图片
                $dba = dba();
                $newPictures = array();//新结构的图片
                $pictures = $dba->select("select * from `35_picture` where `p_sourceid`=? and `p_sourcetype`=? and `p_type`=?",$va->valid['opid'],Picture::$sourceType['businesscenter'],Picture::$picType['ichnograph']);
                foreach($pictures as $p){
                    $pic['thumb'] = Picture::showStandPic($p['p_img'], "_thumb");
                    $pic['large'] = Picture::showStandPic($p['p_img'], "_large");
                    array_push($newPictures, $pic);
                }
                $seotkd = Seotkd::model()->findByPk(4);//SEO优化
                $this->render('businessSummarize',array(
                        'tab'=>$va->valid['tab'],
                        'officePresentInfo'=>$officePresentInfo,
                        'officeBaseinfo'=>$officebaseInfo,//商务中心基本信息
                        'uagent'=>$uagent,
                        'aroundBusiness'=>$aroundBusiness,//周边商铺
                        'sysbuildinfo'=>$sysbuildinfo,//商铺所属的楼盘
                        'houseTypePictures'=>$newPictures,//户型图片
                        'contents'=>"businessIchnography",
                        'seotkd'=>$seotkd
                ));
            }else{
                throw new CHttpException(404,'错误的链接页面.');
            }
        }else{
            $this->redirect(array("site/index"));
        }
    }
    //商务中心房源照片
    public function actionBusinessOtherPicture(){
        $this->layout="main";
        $va = va();
        $va->check(array(
                'opid'=>array('not_blank','uint'),
                'tab'=>array(),
        ));
        if($va->success){
            $officebaseInfo = Officebaseinfo::model()->findbyPk($va->valid['opid']);//获取商务中心基本信息
            if($officebaseInfo){//表明有这样的数据
                $officePresentInfo = Officepresentinfo::model()->findByAttributes(array('op_officeid'=>$va->valid['opid']));//商务中心展示信息
                $rentorsell = $officebaseInfo->ob_sellorrent==Officebaseinfo::rent?RecentView::rent:RecentView::sell;
                RecentView::addViewTrace($va->valid['opid'], RecentView::business, $rentorsell);//增加最近浏览

                //周边商务中心
                $aroundBusiness = Officebaseinfo::model()->with(array('rentInfo','offictag'=>array('condition'=>'ot_check=4')))->findAllByAttributes(array('ob_district'=>$officebaseInfo->ob_district,'ob_buildingtype'=>1),array(
                        'limit'=>10,
                ));

                //获取该商务中心对应的经纪人信息
                $userId = Officebaseinfo::model()->getUserIdByOfficeId($va->valid['opid']);
                $uagent = Viewuagent::model()->getUagentinfo($userId);
                //获取地图显示信息。显示地图包括坐标、名称。
                $sysbuildinfo = Systembuildinginfo::model()->findbyPk($officebaseInfo->ob_sysid);

                //获取房源图片
                $dba = dba();
                $newPictures = array();//新结构的图片
                $otherPictures = $dba->select("select * from `35_picture` where `p_sourceid`=? and `p_sourcetype`=? and `p_type`!=?",$va->valid['opid'],Picture::$sourceType['businesscenter'],Picture::$picType['ichnograph']);
                foreach($otherPictures as $p){
                    $pic['thumb'] = Picture::showStandPic($p['p_img'], "_thumb");
                    $pic['large'] = Picture::showStandPic($p['p_img'], "_large");
                    array_push($newPictures, $pic);
                }
                $seotkd = Seotkd::model()->findByPk(4);//SEO优化
                $this->render('businessSummarize',array(
                        'tab'=>$va->valid['tab'],
                        'officePresentInfo'=>$officePresentInfo,
                        'officeBaseinfo'=>$officebaseInfo,//商务中心基本信息
                        'uagent'=>$uagent,
                        'aroundBusiness'=>$aroundBusiness,//周边商铺
                        'sysbuildinfo'=>$sysbuildinfo,//商铺所属的楼盘
                        'otherPictures'=>$newPictures,//户型图片
                        'contents'=>"businessOtherPicture",
                        'seotkd'=>$seotkd
                ));
            }else{
                throw new CHttpException(404,'错误的链接页面.');
            }
        }else{
            $this->redirect(array("site/index"));
        }
    }
    //商务中心点评
    public function actionBusinessComments(){
        $this->layout="main";
        $va = va();
        $va->check(array(
                'opid'=>array('not_blank','uint'),
                'tab'=>array(),
        ));
        if($va->success){
            $officebaseInfo = Officebaseinfo::model()->findbyPk($va->valid['opid']);//获取商务中心基本信息
            if($officebaseInfo){//表明有这样的数据
                /** 新评论表单模块 开始 **/
                $newCommentModel = new Officecomment;
                if(isset($_POST['Officecomment']))
                {
                    $dba = dba();
                    $newCommentModel->attributes=$_POST['Officecomment'];
                    $newCommentModel->oc_id = $dba->id('35_officecomment');
                    $newCommentModel->oc_cid = Yii::app()->user->id;
                    $newCommentModel->oc_comdate = time();
                    if($newCommentModel->save()){
                        $_SESSION['publishOfficeComment'] = "点评发表成功";
                        $this->redirect(array('officebaseinfo/businessComments','opid'=>$va->valid['opid'],'tab'=>$va->valid['tab']));
                    }else{
                        $_SESSION['publishOfficeComment'] = "点评发表失败";
                    }
                }

                $officePresentInfo = Officepresentinfo::model()->findByAttributes(array('op_officeid'=>$va->valid['opid']));//商务中心展示信息
                $rentorsell = $officebaseInfo->ob_sellorrent==Officebaseinfo::rent?RecentView::rent:RecentView::sell;
                RecentView::addViewTrace($va->valid['opid'], RecentView::business, $rentorsell);//增加最近浏览

                //周边商务中心
                $aroundBusiness = Officebaseinfo::model()->with(array('rentInfo','offictag'=>array('condition'=>'ot_check=4')))->findAllByAttributes(array('ob_district'=>$officebaseInfo->ob_district,'ob_buildingtype'=>1),array(
                        'limit'=>10,
                ));
                //获取该商务中心对应的经纪人信息
                $userId = Officebaseinfo::model()->getUserIdByOfficeId($va->valid['opid']);
                $uagent = Viewuagent::model()->getUagentinfo($userId);
                //获取地图显示信息。显示地图包括坐标、名称。
                $sysbuildinfo = Systembuildinginfo::model()->findbyPk($officebaseInfo->ob_sysid);
                //获取部分评论信息
                $criteria = new CDbCriteria(array(
                                'condition'=>'oc_officeid=:officeId',
                                'params'=>array(':officeId'=>$va->valid['opid']),
                                'order'=>'oc_comdate DESC',
                                'limit'=>3
                ));
                $recentComments = Officecomment::model()->findAll($criteria);

                $seotkd = Seotkd::model()->findByPk(4);//SEO优化
                $this->render('businessSummarize',array(
                        'tab'=>$va->valid['tab'],
                        'officePresentInfo'=>$officePresentInfo,
                        'officeBaseinfo'=>$officebaseInfo,//商务中心基本信息
                        'uagent'=>$uagent,
                        'aroundBusiness'=>$aroundBusiness,//周边商铺
                        'sysbuildinfo'=>$sysbuildinfo,//商铺所属的楼盘
                        'recentComments'=>$recentComments,
                        'newCommentModel'=>$newCommentModel,
                        'contents'=>"businessComments",
                        'seotkd'=>$seotkd
                ));
            }else{
                throw new CHttpException(404,'错误的链接页面.');
            }
        }else{
            $this->redirect(array("site/index"));
        }
    }
    /**
     *	根据选中的写字楼ID查询出该商务中心的详情
     */
    public function actionBusinessDetail() {
        $this->layout="main";
        $va = va();
        $va->check(array(
                'opid'=>array('not_blank','uint'),
                'tab'=>array(),
        ));
        if($va->success){
            $officebaseInfo = Officebaseinfo::model()->findbyPk($va->valid['opid']);//获取商务中心基本信息
            if($officebaseInfo){//表明有这样的数据
                $officePresentInfo = Officepresentinfo::model()->findByAttributes(array('op_officeid'=>$va->valid['opid']));//商务中心展示信息
                $rentorsell = $officebaseInfo->ob_sellorrent==Officebaseinfo::rent?RecentView::rent:RecentView::sell;
                RecentView::addViewTrace($va->valid['opid'], RecentView::business, $rentorsell);//增加最近浏览

                //周边商务中心
                $aroundBusiness = Officebaseinfo::model()->with(array('rentInfo','offictag'=>array('condition'=>'ot_check=4')))->findAllByAttributes(array('ob_district'=>$officebaseInfo->ob_district,'ob_buildingtype'=>1),array(
                        'limit'=>10,
                ));

                //获取该商务中心对应的经纪人信息
                $userId = Officebaseinfo::model()->getUserIdByOfficeId($va->valid['opid']);
                $uagent = Viewuagent::model()->getUagentinfo($userId);
                //获取地图显示信息。显示地图包括坐标、名称。
                $sysbuildinfo = Systembuildinginfo::model()->findbyPk($officebaseInfo->ob_sysid);
                //获取商务中心基础设施信息
                $officefacility = Officefacilityinfo::model()->getAllOfficefacilityinfo($va->valid['opid']);
                $viewoffirent = Viewoffirent::model()->findAllByAttributes(array('ob_officeid'=>$va->valid['opid']));
                $seotkd = Seotkd::model()->findByPk(4);//SEO优化
                $this->render('businessSummarize',array(
                        'tab'=>$va->valid['tab'],
                        'officePresentInfo'=>$officePresentInfo,
                        'officeBaseinfo'=>$officebaseInfo,//商务中心基本信息
                        'uagent'=>$uagent,
                        'aroundBusiness'=>$aroundBusiness,//周边商铺
                        'sysbuildinfo'=>$sysbuildinfo,//商铺所属的楼盘
                        'officefacility'=>$officefacility,
                        'viewoffirent'=>$viewoffirent,
                        'contents'=>"businessDetail",
                        'seotkd'=>$seotkd
                ));
            }else{
                throw new CHttpException(404,'错误的链接页面.');
            }
        }else{
            $this->redirect(array("site/index"));
        }
    }
    public function actionAllBusinessComments(){
        $this->layout="main";
        $va = va();
        $va->check(array(
                'opid'=>array('not_blank','uint')
        ));
        if($va->success){
            $officeId = $va->valid['opid'];
            //获取商务中心展示信息
            $officebaseInfo = Officebaseinfo::model()->with('presentInfo')->findbyPk($officeId);

            //周边商务中心
            $aroundBusiness = Officebaseinfo::model()->with(array('rentInfo','offictag'=>array('condition'=>'ot_check=4')))->findAllByAttributes(array('ob_district'=>$officebaseInfo->ob_district,'ob_buildingtype'=>1),array(
                    'limit'=>10,
            ));

            //获取评论信息
            $dataProvider = new CActiveDataProvider('Officecomment', array(
                            'criteria' => array(
                                    'condition' => 'oc_officeid=:officeId',
                                    'params' => array(':officeId' => $officeId),
                                    'order' => 'oc_comdate DESC',
                            ),
                            'pagination' => array(
                                    'pageSize' => 10,
                            ),
            ));
            $this->render('allBusinessComments',array(
                    'model'=>$officebaseInfo,//写字楼id
                    'aroundBusiness'=>$aroundBusiness,//周边商务中心
                    'dataProvider'=>$dataProvider,//评论详细
            ));
        }else{
            //错误的链接就跳转到首页
            $this->redirect(array('site/index'));
        }
    }

    /**
     * 显示更多商务中心房源信息
     */
    public function actionBusinessCenter() {
        $this->layout="main";
        //商务中心精选
        $criteria = new CDbCriteria;
        //分页
        $pages=new CPagination(Officebaseinfo::model()->count($criteria));
        $pages->pageSize=2;//这里设置每页显示几个
        $pages->applyLimit($criteria);

        $officeStr = Officebaseinfo::model()->findAllByAttributes(array('ob_buildingtype'=>1),$criteria);
        foreach($officeStr as $base) {
            $tradecir = $base['ob_tradecircle'];
        }

        //同商圈楼盘
        $criteria = new CDbCriteria;
        $criteria->limit=10;
        $tradecircle = Officebaseinfo::model()->findAllByAttributes(array('ob_tradecircle'=>$tradecir),$criteria);

        $this->render('businessCenter',array(
                'officeStr'=>$officeStr,
                'pages'=>$pages,
                'tradecircle'=>$tradecircle,
        ));
    }

    /**
     * 商务中心信息列表页搜索，根据搜索条件分页展示相应信息（显示出租列表）
     *
     */
    public function actionRentBusinessList() {
        $this->layout="main";
        $get = SearchMenu::explodeAllParamsToArray();
        $regionParamToColumn = array(
                'province'=>'ob_province',
                'city'=>'ob_city',
                'district'=>'ob_district',
                'section'=>'ob_section',
        );
        $criteria=new CDbCriteria(array(
                        'condition'=>'ob_city='.Yii::app()->params['defaultCity'].' AND ob_sellorrent=1 and ob_buildingtype=1',
                        'with'=>array(
                                'offictag'=>array(
                                        'condition'=>"ot_check=4",//只显示发布状态的。
                                ),
                                "buildingInfo"
                        ),//留着给租金和售价条件使用
        ));
        $criteria->select = "ob_officename,ob_officeid,ob_uid,ob_district,ob_section,ob_loop,ob_officeaddress,ob_adrondegree,ob_officedegree,ob_floortype,ob_releasedate,ob_updatedate,ob_officearea";
        if(isset($get['keyword']) && $get['keyword']!="") {
            $keyword = $get['keyword'];
            $idArr = @common::getIdsBySphinxSearch($keyword, Yii::app()->params['officeIndex'],"array");
            $criteria->addInCondition('ob_officeid', $idArr);
        }

        $regionParams = SearchMenu::getRegionParams();//得到地区搜索条件参数名称集合
        foreach($regionParams as $regionParam) {
            if(isset($get[$regionParam]) && $get[$regionParam]!="") {
                if(array_key_exists($regionParam,$regionParamToColumn)) {
                    $criteria->addColumnCondition(array($regionParamToColumn[$regionParam]=>$get[$regionParam]));
                }
            }
        }
        $criteria = Officebaseinfo::model()->getTempleteSearchCriteria($criteria, 1, $get);

        if(isset($get["order"])){
            if($get['order']=='ru'){//按租金升序
                $criteria->order =" or_rentprice asc,ot_ispanorama desc,ot_isrecommend desc";
            }elseif($get['order']=='rd'){//按租金降序
                $criteria->order =" or_rentprice desc,ot_ispanorama desc,ot_isrecommend desc";
            }
        }
        $dataProvider=new CActiveDataProvider('Officebaseinfo', array(
                        'pagination'=>array(
                                'pageSize'=>10,
                        ),
                        'criteria'=>$criteria,
        ));

//得到最受欢迎的商务中心出租房源
        $hits = Officebaseinfo::model()->getHotAttentionOffice(Officebaseinfo::rent);

        //商务中心推荐
        $officerecommend = Buyproduct::model()->getProductByPageAndPosition(5,3);
        $seotkd = Seotkd::model()->findByPk(4);//SEO优化
        $this->render('rentbusinessList',array(
                'dataProvider'=>$dataProvider,
                'url'=>"officebaseinfo/rentBusinessList",//连接地址
                'options'=>$get,//生成的数组。在前台生成连接时使用
                'type'=>"rent",//页面类型。是租还是售，供前台区别连接的时候使用
                'hits'=>$hits,
                'officerecommend'=>$officerecommend,
                'seotkd'=>$seotkd,
        ));
    }
    /**
     * 商务中心首页之标签找房
     *
     */
    public function actionTags() {
        $this->layout="main";
        if(isset($_REQUEST['tag_id'])&&isset($_REQUEST['tag_belong'])) {
            $tagid = $_REQUEST['tag_id'];
            $tagbelong = $_REQUEST['tag_belong'];
            $markettype = $_REQUEST['markettype'];
            $arr = Tagrelation::model()->getSourceidByTagidandType($tagid,$tagbelong);

            $array = implode(',', $arr);

            //如果租售类型为租房，则转向租房房源列表显示；否则转向收房房源列表显示
            if($markettype==0) {
                $dataProvider=new CActiveDataProvider('Officebaseinfo',array(
                                'criteria'=>array(
                                        'condition'=>'ob_officetype = 1 and ob_officeid in ('.$array.')',
                                        'with'=>array("presentInfo","user","rentInfo","buildingInfo"),
                                ),
                                'pagination'=>array(
                                        'pageSize'=>Yii::app()->params['postsPerPage'],
                                ),
                ));

                $this->render('rentbusinessList',array(
                        'dataProvider'=>$dataProvider,
                ));

            }else {
                $dataProvider=new CActiveDataProvider('Officebaseinfo',array(
                                'criteria'=>array(
                                        'condition'=>'ob_officetype = 1 and ob_officeid in ('.$array.')',
                                        'with'=>array("presentInfo","user","sellInfo","buildingInfo"),
                                ),
                                'pagination'=>array(
                                        'pageSize'=>Yii::app()->params['postsPerPage'],
                                ),
                ));

                $this->render('salebusinessList',array(
                        'dataProvider'=>$dataProvider,
                ));
            }
        }
    }
    public function actionBusinessSearchInput(){
        $url = $_GET;
        if(isset($_POST['keyword'])){
            $url = array_merge($url,array("keyword"=>urlencode($_POST['keyword'])));
        }
        $href = Yii::app()->createUrl("officebaseinfo/rentBusinessList",SearchMenu::dealOptions($url));
        $this->redirect($href);
    }
}
