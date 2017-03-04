<?php

class SiteController extends Controller {
    public function actionIndex() {
        $this->render('index');
    }
	/**
     * 自动完成
     */
    public function actionAjaxAutoComplete() {
        if( isset($_GET['q'])&&isset($_GET['type'])) {
            $cacheTime = 86400;
            //先得到所有数据 $allDate 的格式为array(id, name, egshort, eglong)
            switch($_GET['type']) {
                default:
                    $allDate = array();
                    break;
                case 1://楼盘
                    $allDate = Yii::app()->cache->get("autocomplete_system_build");
                    if($allDate==false) {
                        $allDate = Systembuildinginfo::model()->getAutoCompleteData(1);
                        Yii::app()->cache->set("autocomplete_system_build",$allDate,$cacheTime);
                    }
                    break;
                case 2://商业广场
                    $allDate = Yii::app()->cache->get("autocomplete_system_shop");
                    if($allDate==false) {
                        $allDate = Systembuildinginfo::model()->getAutoCompleteData(2);
                        Yii::app()->cache->set("autocomplete_system_shop",$allDate,$cacheTime);
                    }
                    break;
                case 3://小区
                    $allDate = Yii::app()->cache->get("autocomplete_system_community");
                    if($allDate==false) {
                        $allDate = Communitybaseinfo::model()->getAutoCompleteData();
                        Yii::app()->cache->set("autocomplete_system_community",$allDate,$cacheTime);
                    }
                    break;
                case 4://商务中心
                    $allDate = Yii::app()->cache->get("autocomplete_system_businesscenter");
                    if($allDate==false) {
                        $allDate = Yii::app()->db->createCommand('SELECT `bc_id` id,`bc_name` name,`bc_pinyinshortname` egshort,`bc_pinyinlongname` eglong FROM `{{businesscenter}}`')->queryAll();
                        Yii::app()->cache->set("autocomplete_system_businesscenter",$allDate,$cacheTime);
                    }
                    break;
                case 5://创意园区
                    $allDate = Yii::app()->cache->get("autocomplete_system_creativeparkbaseinfo");
                    if($allDate==false) {
                        $allDate = Yii::app()->db->createCommand('SELECT `cp_id` id,`cp_name` name,`cp_pinyinshortname` egshort,`cp_pinyinlongname` eglong FROM `{{creativeparkbaseinfo}}`')->queryAll();
                        Yii::app()->cache->set("autocomplete_system_creativeparkbaseinfo",$allDate,$cacheTime);
                    }
                    break;
            }

            $name = $_GET['q'];
            // $limit = $_GET['limit'];
            $returnVal = '';
            if($allDate) {
                $num = 0;
                foreach($allDate as $key=>$value) {
                    // if($num>$limit) {
                        // break;
                    // }
                    $check = false;
                    if(preg_match ("/".$name."/i", $value['name'])) {
                        $check = true;
                    }elseif(preg_match ("/".$name."/i", $value['egshort'])) {
                        $check = true;
                    }elseif(preg_match ("/".$name."/i", $value['eglong'])) {
                        $check = true;
                    }
                    //如果符合条件
                    if($check) {
                        $num += 1;
                        $returnVal .= trim($value['name'])."\n";
                    }
                }
            }
//            return  array("1"=>"asdf");
            echo $returnVal;
        }
    }
}