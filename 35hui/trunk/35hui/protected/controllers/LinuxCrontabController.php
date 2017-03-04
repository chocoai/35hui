<?php
/**
 * linux后台定时处理执行
 */
class LinuxCrontabController extends Controller {
    public $layout='frame';
    public function beforeAction(){
        header("Content-type:text/html;charset=utf-8");
        return true;
    }
    /**
     * 预约刷新房源。每十分钟执行一次
     */
    public function actionFlushSource(){
        $logFile = $_SERVER['DOCUMENT_ROOT']."/protected/messages/orderrefresh.log";//日志文件
        $nowTimePoint = date("G").date("i");//当前要刷新的时间点
        //先删除已过期的预约刷新
        $time = time();
        $toDay=strtotime(date('Y-m-d',$time));
        $flushOrder=common::getOrderConfig('daycut');
        $criteria=new CDbCriteria;
        $criteria->addCondition("sor_deadline<".$time);
        Sourceorderrefresh::model()->deleteAll($criteria);

        //查找在此时间点要刷新的房源
        $allId = array();
        $flushId = array();
        $list = Sourceorderrefresh::model()->findAllByAttributes(array("sor_ordertime"=>$nowTimePoint));
        foreach($list as $key=>$value){
            $allId[$value["sor_sourcetype"]][] = $value['sor_sourceid'];//所有预约在这个时间点的id
            $userid = "";
            if($value["sor_sourcetype"]==1){//写字楼
                $sourceType = 1;
                $model = Officebaseinfo::model()->findByPk($value['sor_sourceid']);
                $userid = @$model['ob_uid'];
                $model->ob_updatedate = $time;//先赋值，如果可以刷新，则直接刷新

            }elseif($value["sor_sourcetype"]==2){//商铺
                $sourceType = 2;
                $model = Shopbaseinfo::model()->findByPk($value['sor_sourceid']);
                $userid = @$model['sb_uid'];
                $model->sb_updatedate = $time;//先赋值，如果可以刷新，则直接刷新
            }elseif($value["sor_sourcetype"]==3){//住宅
                $sourceType = 3;
                $model = Residencebaseinfo::model()->findByPk($value['sor_sourceid']);
                $userid = @$model['rbi_uid'];
                $model->rbi_updatedate = $time;//先赋值，如果可以刷新，则直接刷新
            }
            if($userid){//id是正确的
                $check = Sourceorderrefresh::model()->checkCanRefreshByUserAndType($userid, $sourceType);
                if($check){//可以刷新
                    $model->update();
                    Dayoperation::model()->updatePerationNum($userid, $sourceType);
                    $flushId[$value["sor_sourcetype"]][] = $value['sor_sourceid'];//实际刷新
                }
            }
        }
        //写日志文件
        if (!$handle = fopen($logFile, 'a')) {
            exit;
        }
        $logContent = date("Y-m-d H:i:s",$time)." 刷新时间点：".$nowTimePoint."\n";
        $str = "";
        foreach($allId as $k=>$v){
            $str .= "类型：".$k."：".implode(",", $allId[$k]);
        }
        $logContent .= "所有要刷新的ID：".$str."\n";
        $str = "";
        foreach($flushId as $k=>$v){
            $str .= "类型：".$k."：".implode(",", $flushId[$k]);
        }
        $logContent .="本次刷新了：".$str."\n";
        $logContent .= "##################################\n\n";
        if (fwrite($handle, $logContent) === FALSE) {
            exit;
        }
        fclose($handle);
        //写日志结束
    }
    /** 0 0 * * * /usr/bin/links -source "http://www.360dibiao.com/linuxCrontab/delkwdrecommend" > /dev/null 2>&1
     * 删除已经过期的关键词推广。由于存在历史记录表35_kwdrecommendhistory。因此可以删除主表中内容，提高效率
     * 外网每天晚上12点定时执行.。测试由于晚上要关机，因此改为早上9点
     */
//    public function actionDelKwdRecommend(){
//        $logFile = $_SERVER['DOCUMENT_ROOT']."/protected/messages/delkwdrecommend.log";//日志文件
//        $time = time();
//        $criteria=new CDbCriteria;
////        $criteria->select = "kwr_id";
//        $criteria->addCondition("kwr_expiredtime<".$time);
//        $model = Kwdrecommend::model()->findAll($criteria);
//        //记录日志。在删除！
//        if (!$handle = fopen($logFile, 'a')) {
//            exit;
//        }
//        $logContent = date("Y-m-d H:i:s",$time)." 删除推广关键词表id：\n";
//        $str = "";
//        foreach($model as $value){
//            $str .= $value->kwr_id."，";
//        }
//        $logContent .= $str;
//        $logContent .= "\n##################################\n\n";
//        if (fwrite($handle, $logContent) === FALSE) {
//            exit;
//        }
//        fclose($handle);
//        if($model){
//            Kwdrecommend::model()->deleteAll($criteria);
//        }
//    }
    /**
     * 每天晚上12点更新点击数。更新幅度为 0 - 2 之间的随机数字。
     */
    public function actionUpdateSourceVisit(){
        $add = "floor(rand()*3)";
        $connection = Yii::app()->db;
        $sql = "update 35_shopbaseinfo set `sb_visit`=`sb_visit`+(".$add.");";
        $sql .= "update 35_officebaseinfo set `ob_visit`=`ob_visit`+(".$add.");";
        $sql .= "update 35_residencebaseinfo set `rbi_visit`=`rbi_visit`+(".$add.");";
        $command = $connection->createCommand($sql);
        $command->execute();
        $connection->active=false;
    }


    /** 0 1 * * * /usr/bin/links -source "http://www.360dibiao.com/linuxCrontab/OfficeOrderDaycut" > /dev/null 2>&1
     * 写字楼order按天减
     */
//    public function actionOfficeOrderDaycut(){
//        $time = time();
//        $logFile = $_SERVER['DOCUMENT_ROOT']."/protected/messages/order_daycut_office.log";
//        file_put_contents($logFile, "# DateTime:".date('Y/m/d H:i:s', $time)." Start\n", FILE_APPEND);
//        //$criteria=array('select'=>'ob_officeid,','condition'=>'ob_releasedate+ob_expiredate>'.$time);
//        $sql='UPDATE {{officebaseinfo}} SET ob_order=ob_order-'.common::getOrderConfig('daycut').' WHERE ob_releasedate+ob_expiredate>'.$time;
//        $connection=Yii::app()->db;
//        $connection->setActive(TRUE);
//        $fetchNum = $connection->createCommand($sql)->execute();
//        file_put_contents($logFile, "Fetch Num:$fetchNum \nSuccess\n", FILE_APPEND);
//    }
//    /**
//     * 商铺order按天减
//     */
//    public function actionShopOrderDaycut(){
//        $time = time();
//        $logFile = $_SERVER['DOCUMENT_ROOT']."/protected/messages/order_daycut_shop.log";
//        file_put_contents($logFile, "# DateTime:".date('Y/m/d H:i:s', $time)." Start\n", FILE_APPEND);
//        //$criteria=array('select'=>'ob_officeid,','condition'=>'ob_releasedate+ob_expiredate>'.$time);
//        $sql='UPDATE {{shopbaseinfo}} SET sb_order=sb_order-'.common::getOrderConfig('daycut').' WHERE sb_releasedate+sb_expiredate>'.$time;
//        $connection=Yii::app()->db;
//        $connection->setActive(TRUE);
//        $fetchNum = $connection->createCommand($sql)->execute();
//        file_put_contents($logFile, "Fetch Num:$fetchNum \nSuccess\n", FILE_APPEND);
//    }
//    /**
//     * 住宅order按天减
//     */
//    public function actionZhuzhaiOrderDaycut(){
//        $time = time();
//        $logFile = $_SERVER['DOCUMENT_ROOT']."/protected/messages/order_daycut_zhuzhai.log";
//        file_put_contents($logFile, "# DateTime:".date('Y/m/d H:i:s', $time)." Start\n", FILE_APPEND);
//        //$criteria=array('select'=>'ob_officeid,','condition'=>'ob_releasedate+ob_expiredate>'.$time);
//        $sql='UPDATE {{residencebaseinfo}} SET rbi_order=rbi_order-'.common::getOrderConfig('daycut').' WHERE rbi_releasedate+rr_validdate>'.$time;
//        $connection=Yii::app()->db;
//        $connection->setActive(TRUE);
//        $fetchNum = $connection->createCommand($sql)->execute();
//        file_put_contents($logFile, "Fetch Num:$fetchNum \nSuccess\n", FILE_APPEND);
//    }
    /**
     * 每天晚上过滤所有已发布房源，如果过期则把状态变成过期状态
     */
    public function actionChangeOutTimeSourceState(){
        $time = time();
        $logFile = $_SERVER['DOCUMENT_ROOT']."/protected/messages/ChangeOutTimeSourceState.log";//日志文件
        $officeId = Officebaseinfo::model()->updateOutTimeSource();
        $shopId = Shopbaseinfo::model()->updateOutTimeSource();
        $zhuzhaiId = Residencebaseinfo::model()->updateOutTimeSource();
        //记录日志
        if (!$handle = fopen($logFile, 'a')) {
            exit;
        }
        $logContent = date("Y-m-d H:i:s",$time)." 设置过期房源：\n";
        $logContent = "写字楼：".implode(",", $officeId)."\n";
        $logContent .= "商铺：".implode(",", $shopId)."\n";
        $logContent .= "住宅：".implode(",", $zhuzhaiId)."\n";
        $logContent .= "##################################\n";
        if (fwrite($handle, $logContent) === FALSE) {
            exit;
        }
        fclose($handle);
    }
    /** 0 8-23/1 * * * /usr/bin/links -source "http://www.360dibiao.com/linuxCrontab/DropProductGridPrice" > /dev/null 2>&1
     * 每隔1个小时，判断过期位置是否有人购买，如果没有则要降价。此脚本只对写字楼、商铺、住宅、经纪人和中介公司进行操作
     */
//    public function actionDropProductGridPrice(){
//        $logFile = $_SERVER['DOCUMENT_ROOT']."/protected/messages/DropProductGridPrice.log";//日志文件
//        $time = time();
//        $criteria=new CDbCriteria;
//        $criteria->addInCondition("p_positiontype",array(1,2,3,4,9));
//        $criteria->addCondition("`p_lastbuytime` + `p_lastbuydatys` *86400+3600<".$time);
//        $criteria->addCondition("p_nowprice!=p_baseprice");//只搜还没降价到基本值得情况
//        $all = Productgrid::model()->findAll($criteria);
//        $array = array();
//        foreach($all as $value){
//            $id = $value['p_id'];
//            $array[] = $id;
//            $oldPrice = $value['p_nowprice'];
//            $basePrice = $value['p_baseprice'];
//
//            $dropPrice = $value['p_baseprice']*$value['p_droppercent'];
//            $newPrice = $oldPrice-$dropPrice;
//            $newPrice = $newPrice<$basePrice?$basePrice:$newPrice;//当要设置值小于基本值时，使用基本值。
//            Productgrid::model()->updateByPk($id,array("p_nowprice"=>$newPrice));
//        }
//        //记录日志
//        if (!$handle = fopen($logFile, 'a')) {
//            exit;
//        }
//        $logContent = date("Y-m-d H:i:s",$time)." 精品位置降价：\n";
//        $logContent = "降价id：".implode(",", $array)."\n";
//        $logContent .= "##################################\n";
//        if (fwrite($handle, $logContent) === FALSE) {
//            exit;
//        }
//        fclose($handle);
//    }
    /**
     * 将过期的用户购买设为不可用状态
     */
    public function actionChangeBuyproductState(){
        $models=Buyproduct::model()->findAll('`sp_buydays`>0 and `sp_state`=0');
        if($models){
            $time=time();
            foreach($models as $model){
                if($time>$model->sp_buytime+86400*$model->sp_buydays){
                    $model->sp_state=1;//设为不可用
                    $model->update();
                }
            }
        }
    }
    /**
     * 每天晚上执行，如果vip过期了，就把时间变成0.如果不变成0，则经纪人搜索的时候排序会出错
     */
    public function actionChangeVipToZero(){
        $time = time();
        $criteria=new CDbCriteria;
        $criteria->addCondition("ua_combotime<".$time);
        Uagent::model()->updateAll(array("ua_combo"=>"","ua_combotime"=>""),$criteria);
    }
    /**
     * 每天晚上执行。统计经纪人用户的主营楼盘
     */
    public function actionMainBuilds(){
        $criteria=new CDbCriteria;
        $criteria->select = "ua_uid";
        $models=Uagent::model()->findAll($criteria);
        $connection = Yii::app()->db;
        foreach($models as $value){
            $criteria=new CDbCriteria;
            $criteria->select="count(*) num ,ob_sysid";
            $criteria->addColumnCondition(array("ob_uid"=>$value->ua_uid));
            $criteria->group = "ob_sysid";
            $criteria->order = "num desc";
            $criteria->limit = 5;//只取5条
            $all = Officebaseinfo::model()->findAll($criteria);
            $array = array();
            if($all){
                foreach($all as $v){
                    $id = $v->ob_sysid;
                    $name = "";
                    $buildInfo = Systembuildinginfo::model()->findBySql("select sbi_buildingname from 35_systembuildinginfo where sbi_buildingid=".$v->ob_sysid);
                    if($buildInfo){
                        $name = $buildInfo->sbi_buildingname;
                    }
                    $array[] = array("id"=>$id,"name"=>$name);
                }
            }
            $str = "";
            if($array){
                $str = serialize($array);
            }

            $sql = "update 35_uagent set `ua_mainbuilds`='".$str."' where ua_uid=".$value->ua_uid;
            $command = $connection->createCommand($sql);
            $command->execute();
        }
        $connection->active=false;
    }
    /**
     * 用户得分排序
     */
    public function actionUpdateAgentOrder(){
        $criteria=new CDbCriteria;
        $criteria->select="*";
        $criteria->order = "ua_source desc";
        $criteria->addCondition("ua_source!=0");
        $all = Uagent::model()->findAll($criteria);

        $allSourceArray = array();//评分的集合
        $allUserArray = array();//用户集合
        foreach($all as $key=>$value){
            $allUserArray[] = array(
                    "id"=>$value->ua_id,
                    "source"=>$value->ua_source
            );
            $allSourceArray[] = $value->ua_source;
        }
        //先初始化数据。更新昨日排名
        $connection = Yii::app()->db;
        $sql = "update 35_uagent set ua_orderold=ua_ordernew;";
        $command = $connection->createCommand($sql);
        $command->execute();
        $sql = "update 35_uagent set ua_ordernew=0;";
        $command = $connection->createCommand($sql);
        $command->execute();
        
        foreach($allUserArray as $v){
            $index = array_search($v["source"], $allSourceArray)+1;
            $sql = "update 35_uagent set `ua_ordernew`='".$index."' where ua_id=".$v['id'];
            $command = $connection->createCommand($sql);
            $command->execute();
        }
        $connection->active=false;
    }
    /**
     * 更新楼盘数据
     *
     */
    public function actionUpdateBuildOfficeNum(){
        $logFile = $_SERVER['DOCUMENT_ROOT']."/protected/messages/updatebuildofficenum.log";//日志文件
        $criteria=new CDbCriteria;
        $criteria->select="sbi_buildingid";
        $model=Systembuildinginfo::model()->findAll($criteria);
        $SuccessNum=0;
        $failureNum=0;
        $failureID="";
        foreach($model as $val){
            $buildid=$val->sbi_buildingid;
            $officeNum=Officebaseinfo::model()->count("ob_sysid=".$buildid);
            $val->sbi_officenum=$officeNum;
            if($val->update()){
                $SuccessNum++;
            }else{
                $failureNum++;
                $failureID.="[".$buildid."] ,";
            }
        }
        //写日志文件
        if (!$handle = fopen($logFile, 'a')) {
            exit;
        }
        $time = time();
        $logContent = date("Y-m-d H:i:s",$time)."\n";
        $str = "";
        
        $logContent .="本次更新成功：".$SuccessNum."条；更新失败：".$failureNum."条\n";
        $logContent .= "失败ID".$failureID."\n\n";
        $logContent .= "##################################\n\n";
        if (fwrite($handle, $logContent) === FALSE) {
            exit;
        }else{
           echo "日志文件写入成功";
        }
         fclose($handle);
        //写日志结束
    }
}