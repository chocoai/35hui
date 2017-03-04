<?php

class OfficeController extends Controller {
    /**
     * Declares class-based actions.
     */
    public $layout='office';
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
                'class'=>'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        header("Location:".DOMAIN);
        //得到所有行政区。
//        if(($data=Yii::app()->cache->get('officeindex_data'))===false){
//            $data = array();
//        $alldistrict = Region::model()->getArea();
//        $data['alldistrict'] = & $alldistrict;
//        $firstSection = array();
//        if(!empty ($alldistrict)){
//            $firstSection = Region::model()->getChildrenById($alldistrict[0]['re_id']);
//        }
//        $data['firstSection'] = & $firstSection;
//        //得到首页滚动栏
//        $scrolllist = Buyproduct::model()->getProductByPageAndPosition(7,6);
//        $data['scrolllist'] = & $scrolllist;
//        //首页自动切换图片资讯
//		//$pic=Newspic::model()->getLimitPicNews(1);
//
//        //新推楼盘
//        $newBuild = Systembuildinginfo::model()->getRecentNewBuildings(8);
//        $data['newBuild'] = & $newBuild;
//        //楼盘动态
//        $twitter = Twitter::model()->getTwitterInfo(50);
//        $data['twitter'] = & $twitter;
//        //最新出租
//        $rentOffice = Officebaseinfo::model()->getRecentOffice(1, 16);
//        $data['rentOffice'] = & $rentOffice;
//        //最新出售
//        $sellOffice = Officebaseinfo::model()->getRecentOffice(2, 16);
//        $data['sellOffice'] = & $sellOffice;
//        //房产资讯
//        //$newsall = News::model()->getAllNews(7);
//        //上海写字楼政策
//        $newszc = News::model()->getNewsByType(0,6);
//        $data['newszc'] = & $newszc;
//        //上海写字楼成交数据
//        $newscj = News::model()->getNewsByType(1,6);
//        $data['newscj'] = & $newscj;
//        //上海写字楼调查报告
//        $newsdc = News::model()->getNewsByType(2,6);
//        $data['newsdc'] = & $newsdc;
//        //上海写字楼研究报告
//        $newsyj = News::model()->getNewsByType(3,6);
//        $data['newsyj'] = & $newsyj;
//        //标签找房租
////        $buildingTagsrent = Tags::model()->getTagsByTypeAndMarke(Tags::office,Tags::rent);
//        //标签找房售
////        $buildingTagssell = Tags::model()->getTagsByTypeAndMarke(Tags::office,Tags::sell);
//        //最受欢迎楼盘
//        $welcomeBuildings = Systembuildinginfo::model()->getWelcomeBuildings(7);
//        $data['welcomeBuildings'] = & $welcomeBuildings;
//        //金牌经纪人
//        $golduagent = Buyproduct::model()->getProductByPageAndPosition(7,9);
//        $data['golduagent'] = & $golduagent;
//        //品牌中介图片
//        $recommendcompanyimg = Buyproduct::model()->getProductByPageAndPosition(7,7);
//        $data['recommendcompanyimg'] = & $recommendcompanyimg;
//
//        //品牌中介文字栏
//        $recommendcompanyword = Buyproduct::model()->getProductByPageAndPosition(7,8);
//        $data['recommendcompanyword'] = & $recommendcompanyword;
//
//        //商务中心精选
//        $officerecommend = Buyproduct::model()->getProductByPageAndPosition(7,5);
//        $data['officerecommend'] = & $officerecommend;
//
//        //全景楼盘推荐
//        $buildingrecommend = Buyproduct::model()->getProductByPageAndPosition(7,4);
//        $data['buildingrecommend'] = & $buildingrecommend;
//
//        //楼盘精选
//        $districtbuilddata = Systembuildinginfo::model()->getBuildByDistrictName("浦东", 4);
//        $data['districtbuilddata'] = & $districtbuilddata;
//
//        $seotkd = Seotkd::model()->findByPk(2);
//        $data['seotkd'] = & $seotkd;
//
//        Yii::app()->cache->set('officeindex_data',$data,Yii::app()->params['dataDurationIndex']);
//        }else{
//            extract($data);
//        }
//        $this->render('index',array(
//            'alldistrict'=>$alldistrict,//所有行政区
//            'firstSection'=>$firstSection,//板块
//            'scrolllist'=>$scrolllist,//首页滚动栏
//            'newBuild'=>$newBuild,//新推楼盘
//            'twitter'=>$twitter,//楼盘动态
//            'rentOffice'=>$rentOffice,//最新出租
//            'sellOffice'=>$sellOffice,//最新出售
//            'newszc'=>$newszc,//写字楼政策
//            'newscj'=>$newscj,//成交数据
//            'newsdc'=>$newsdc,//调查报告
//            'newsyj'=>$newsyj,//研究报告
//            'welcomeBuildings'=>$welcomeBuildings,//最受欢迎楼盘
//            'golduagent'=>$golduagent,//金牌经纪人
//            'recommendcompanyimg'=>$recommendcompanyimg,//品牌中介图片
//            'recommendcompanyword'=>$recommendcompanyword,//品牌中介文字栏
//            'officerecommend'=>$officerecommend,//商务中心精选
//            'buildingrecommend'=>$buildingrecommend,//全景楼盘推荐
//            'districtbuilddata'=>$districtbuilddata,//楼盘精选
//            "seotkd"=>$seotkd,
//        ));
    }
    public function actionView(){
        $id = $_GET['id'];
        $model = Officebaseinfo::model()->findByPk($id);
        if($model){
            $url = $model->ob_sellorrent == 1?"officebaseinfo/rentView":"officebaseinfo/saleView";
            $this->Redirect(array($url,"id"=>$id));
        }else{
            $this->Redirect(array("/site/error"));
        }
    }
}