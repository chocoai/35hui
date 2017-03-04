<?php

class AlbumrecommendController extends Controller {
    public $layout='main';
    public function actionIndex() {
        $type = isset ($_GET["type"])?$_GET["type"]:"1";
        $templete = array("1","2","3");
        if(!array_search($type,$templete)){//参数错误
            $type = 1;
        }
        $criteria=new CDbCriteria;
        $criteria->group = "ar_recommendtime";
        $criteria->order = "ar_recommendtime desc";
        $criteria->limit = 3;
        $dateInfo = Albumrecommend::model()->findAll($criteria);
        //获取要查询的推荐时间
        $recommendTime = isset($dateInfo[$type-1])?$dateInfo[$type-1]["ar_recommendtime"]:"";
        //获取传入时间所推荐的相册
        $recommendInfo = array();
        if($recommendTime){
            $criteria=new CDbCriteria;
            $criteria->addColumnCondition(array("ar_recommendtime"=>$recommendTime));
            $criteria->order = "ar_createtime desc";
            $recommendInfo = Albumrecommend::model()->findAll($criteria);
        }
        $this->render("index",array(
            "recommendInfo"=>$recommendInfo
        ));
    }
}