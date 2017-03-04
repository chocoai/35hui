<?php
class DdmapController extends CController
{
    public function actionIndex(){
        $this->render("index");
    }
    public function actionGetInfo(){
        $id = isset($_GET["id"])?$_GET["id"]:"";
        $max = isset($_GET["max"])?$_GET["max"]:3;//每页显示数目
        $page = isset($_GET["page"])?$_GET["page"]:1;

//        $max>20?$max=20:"";
        
        $return = array();//要返回的数据
        $key="";
        if(isset($_GET["key"])){
            $key = $_GET["key"];
        }
        if(!Domainkey::model()->validateKey($key)){
            $this->callBack("您的域名还未注册，不能使用本功能。请联系新地标客服！");
            exit;
        }

        $criteria = new CDbCriteria;
        
        $criteria->select = "sbi_buildingid,sbi_address,sbi_buildingname";
        $criteria->addColumnCondition(array("sbi_buildingid"=>$id));
        $model = Systembuildinginfo::model()->find($criteria);
        if(!$model){
            $this->callBack($return);
            exit;
        }
        $return["id"] = $model->sbi_buildingid;
        $return["address"] = $model->sbi_address;
        $return["name"] = $model->sbi_buildingname;
        $return["rentNum"]=Officebaseinfo::model()->count("ob_sysid=".$model->sbi_buildingid." and ob_check=4 and ob_sellorrent=1");
        $return["sellNum"]=Officebaseinfo::model()->count("ob_sysid=".$model->sbi_buildingid." and ob_check=4 and ob_sellorrent=2");
        
         //分页
        $return["totalPageCount"] = ceil($return["rentNum"]/$max);
        $return["totalPageCount"]==0?$return["totalPageCount"]=1:"";

        $page<1?$page=1:"";
        $page>$return["totalPageCount"]?$page=$return["totalPageCount"]:"";

        $return["page"] = $page;
        $return["max"] = $max;
        
        //查找房源
        $criteria = new CDbCriteria;
        $criteria->addColumnCondition(array("ob_sysid"=>$model->sbi_buildingid,"ob_check"=>4));
        $criteria->addColumnCondition(array("ob_sellorrent"=>1));//只搜出租的
        $criteria->order = "ob_updatedate desc";
        $criteria->limit = $max;
        $criteria->offset =($page-1)*$max;
        $officeModel = Officebaseinfo::model()->findAll($criteria);
        foreach($officeModel as $key=>$value){
            $office = array();
            $office["floor"] = @Officebaseinfo::$ob_floortype[$value["ob_floortype"]];
            $office["pirce"] = @$value->ob_rentprice;
            $office["area"] = @$value->ob_officearea;
            $office["connectuser"] = User::model()->getNamebyid($value["ob_uid"]);
            $office["type"] = $value->ob_sellorrent==1?"出租":"出售";
            $office["time"] = $value->ob_updatedate;
            $office["url"] = DOMAIN.Yii::app()->createUrl("officebaseinfo/view",array("id"=>$value->ob_officeid));
            $return["office"][] = $office;
        }
       

        $this->callBack($return);exit;
    }
    private function callBack($value){
        $return = json_encode($value);
        $dal=@$_GET['callback'];
        echo $dal.'('.$return,')';
    }
    public function actionPanoPlayer(){
        if(!isset ($_GET["play"])){
            exit;
        }
        //根据传入参数，得到完整全景参数
        $play = $_GET["play"];
        $idArr = explode(".", $play);
        if(count($idArr)!=2||$idArr[1]!="swf"){
            exit;
        }
        $pid = $idArr[0];//格式 楼盘id_类型
        $xml = Panoxml::model()->getPanoXml($pid, 1);
        $param = "mainXml=".$xml;
        header("Location: ".PIC_URL."/pano/panoPlayer_1.4.swf?".$param);
    }
    public function actionDemo(){
        $this->render('demo');
    }
    public function actionGetBuildInfo(){
        header("Content-type:text/html;charset=utf-8");
        //房源信息
        $criteria = new CDbCriteria;
        $criteria->select = "ob_sysid";
        $criteria->group = "ob_sysid";
        $officeAll = Officebaseinfo::model()->findAll($criteria);
        $officeId = array();
        foreach($officeAll as $v){
            $officeId[] = $v->ob_sysid;
        }
        
        //全景信息.查看楼盘是否有全景
        $criteria = new CDbCriteria;
        $criteria->select = "p_buildingid";
        $criteria->addColumnCondition(array("p_ptype"=>1));
        $criteria->group = "p_buildingid";
        $panoAll = Panorama::model()->findAll($criteria);
        $panoId = array();
        foreach($panoAll as $v){
            $panoId[] = $v->p_buildingid;
        }
        
        //返回信息
        $all = Systembuildinginfo::model()->findAll();
        $return = array();
        foreach($all as $value){
            $tmp["id"] = $value->sbi_buildingid;
            $tmp["name"] = $value->sbi_buildingname;
            $tmp["address"] = $value->sbi_address;
            $tmp["office"] = array_search($value->sbi_buildingid, $officeId)!==false?1:0;
            $tmp["panorama"] = array_search($value->sbi_buildingid, $panoId)!==false?1:0;
            $return[] = $tmp;
        }
        $logFile = $_SERVER['DOCUMENT_ROOT']."/protected/messages/api_getbuildinfo.log";//日志文件
        //写日志文件
        if (!$handle = fopen($logFile, 'a')) {
            exit;
        }
        $logContent = date("Y-m-d H:i:s",time())." # ".$_SERVER["SERVER_ADDR"]."\n";
        if (fwrite($handle, $logContent) === FALSE) {
            exit;
        }
        fclose($handle);
        echo serialize($return);
        exit;
    }
}
