<?php

class ManageController extends Controller {

    const PAGE_SIZE=10;

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

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
                array('allow',
                        'actions'=>array("showMessage",'flushUpdateDate','changeTag','sell','rent','download','buiddata','delmsgfang','Twittersuggest','Tagit'),
                        'users'=>array('@'),//注册用户都可以使用
                ),
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                        'actions'=>array('view','updateinfo','viewIntegral','viewMoney','buyproduct','recommendindex','unrecommend','recommend','officetagopt','post','shoptagopt','shopflushupdatedate','showMsgrec','upattachment'),
                        'roles'=>array(
                                Yii::app()->params['agent'],
                                Yii::app()->params['personal'],
                        ),
                ),
                array('deny',  // deny all users
                        'users'=>array('*'),
                ),
        );
    }
    public function actionDelmsgfang(){
        $connection = Yii::app()->db;
        $old=$connection->createCommand("SELECT `mf_id`,`mf_uid` FROM {{msgfang}} WHERE `mf_ttg`=0 AND `mf_id`=".(int)$_GET['id'])->queryRow();
        if($old && $old['mf_uid']==Yii::app()->user->id){
            $connection->createCommand("UPDATE {{msgfang}} SET `mf_ttg`=1 WHERE `mf_id`=".$old['mf_id'])->execute();
        }
        echo 'ok';
    }
    /*
     * 经纪人管理出售房源
    */
    public function actionSell() {
        $tagData = array(
                'draft'=>8,//草稿
                'outtime'=>6,//过期
                'report'=>9,//违规
        );
        $show = array_merge($_GET,$_POST);
        $tag = 4;//已发布
        $view = "sellmanage";
        if(!empty($show['tag'])) {
            if(array_key_exists($show['tag'],$tagData)) {
                $tag = $tagData[$show['tag']];
                $view .= $show['tag'];
            }
        }
        if(!isset($show['sourceType']) || !in_array($show['sourceType'], array('1','2','3'))) {
            $show['sourceType'] = Yii::app()->user->getState('mainbusiness','1');//主营物业
        }
        $param = array();
        !empty($_GET['tag']) && $param['tag'] = $_GET['tag'];
        !empty($show['menu']) && $param['menu'] = $show['menu'];
        $url = $this->createUrl($this->getAction()->getId(),$param);
        $buildTypeInfo = '';

        $userId = Yii::app()->user->id;
        if($show['sourceType'] != 3) {
            $dataProvider =  Viewuagent::model()->sellManageTag($tag,2,$show);//写字楼，商铺
            if($show['sourceType'] == 1) {
                $buildTypeInfo = Systembuildinginfo::getAllBuilds($userId,2);
            }
        }else {
            $dataProvider =  Residencebaseinfo::model()->getManageDataProvider($tag,2,$show);
            $buildTypeInfo = Communitybaseinfo::getAllCommunitys($userId);
        }
        $this->render($view,array(
                'sr'=>"sell",
                'show'=>$show,
                'dataProvider'=>$dataProvider,
                'url' => $url,
                'orderRefresh'=>Yii::app()->user->getState('role')==2,
                'layout'=>$this->layout,
                'buildTypeInfo'=>$buildTypeInfo,
                'menu'=>!empty($show['menu'])?$show['menu']:'',
        ));
    }
    /*
     * 经纪人管理出租房源
    */
    public function actionRent() {
        $tagData = array(
                'draft'=>8,//草稿
                'outtime'=>6,//过期
                'report'=>9,//违规
        );
        $show = array_merge($_GET,$_POST);
        $tag = 4;//已发布
        $view = "sellmanage";
        if(!empty($show['tag'])) {
            if(array_key_exists($show['tag'],$tagData)) {
                $tag = $tagData[$show['tag']];
                $view .= $show['tag'];
            }
        }

        if(!isset($show['sourceType']) || !in_array($show['sourceType'], array('1','2','3',"4"))) {
            $show['sourceType'] = Yii::app()->user->getState('mainbusiness','1');//主营物业
        }
        $param = array();
        //$param['sourceType'] = $show['sourceType'];
        !empty($_GET['tag']) && $param['tag'] = $_GET['tag'];
        !empty($show['menu']) && $param['menu'] = $show['menu'];
        $url = $this->createUrl($this->getAction()->getId(),$param);

        $userId = Yii::app()->user->id;
        $buildTypeInfo = '';
        if($show['sourceType'] == 1||$show['sourceType'] == 2) {
            $dataProvider =  Viewuagent::model()->sellManageTag($tag,1,$show);//写字楼，商铺
            if($show['sourceType'] == 1) {
                $buildTypeInfo = Systembuildinginfo::getAllBuilds($userId,1);
            }
        }elseif($show['sourceType'] == 3) {
            $dataProvider =  Residencebaseinfo::model()->getManageDataProvider($tag,1,$show);
            $buildTypeInfo = Communitybaseinfo::getAllCommunitys($userId);
        }
        elseif($show['sourceType'] == 4) {//创意园区
            $dataProvider =  Creativesource::model()->getManageDataProvider($tag,$show);
//            $buildTypeInfo = Communitybaseinfo::getAllCommunitys($userId);
        }
        $this->render($view,array(
                'sr'=>"rent",
                'show'=>$show,
                'dataProvider'=>$dataProvider,
                'url' => $url,
                'orderRefresh'=>Yii::app()->user->getState('role')==2,
                'layout'=>$this->layout,
                'buildTypeInfo'=>$buildTypeInfo,
                'menu'=>!empty($show['menu'])?$show['menu']:'',
        ));
    }
//    private function getUpdateOrderSql($ids,$type){
//        $table=$column=$where='';
//        $temp=array();
//        $toDay=strtotime(date('Y-m-d'));
//        switch ($type) {
//            case 1:
//                $models=Officebaseinfo::model()->findAll(array('select'=>'ob_officeid,ob_updatedate','condition'=>'ob_officeid IN('.$ids.')'));
//                foreach($models as $model) {
//                    if($model->ob_updatedate < $toDay)
//                        $temp[]=$model->ob_officeid;
//                }
//                $where = ' WHERE ob_officeid';
//                $column='ob_order';
//                $table='{{officebaseinfo}}';
//                break;
//            case 2:
//                $models=Shopbaseinfo::model()->findAll(array('select'=>'sb_shopid,sb_updatedate','condition'=>'sb_shopid IN('.$ids.')'));
//                foreach($models as $model) {
//                    if($model->sb_updatedate < $toDay)
//                        $temp[]=$model->sb_shopid;
//                }
//                $where = ' WHERE sb_shopid';
//                $column='sb_order';
//                $table='{{shopbaseinfo}}';
//                break;
//            case 3:
//                $models=Residencebaseinfo::model()->findAll(array('select'=>'rbi_id,rbi_updatedate','condition'=>'rbi_id IN('.$ids.')'));
//                foreach($models as $model) {
//                    if($model->rbi_updatedate < $toDay)
//                        $temp[]=$model->rbi_id;
//                }
//                $where = ' WHERE rbi_id';
//                $column='rbi_order';
//                $table='{{residencebaseinfo}}';
//                break;
//            default:
//                return false;
//        }
//
//        $sql='';
//        if($temp)
//            $sql="UPDATE ".$table." SET  ".$column."=".$column."+".common::getOrderConfig('flush').$where." IN( ".implode(',',$temp).") LIMIT ".count($temp);
//        return $sql;
//    }
    /*
     * 更新时间
    */
    public function actionFlushUpdateDate() {
        $userid = Yii::app()->user->id;
        if(empty($_POST['sourceType']) || !in_array($_POST['sourceType'], array(1,2,3,4))) {//1写字楼，2商铺，3住宅 4创意园区
            exit('error');
        }
        $sourceType = $_POST['sourceType'];
        $officeid = explode(',', $_POST['officeid']);

        $flushNum = count($officeid);
        //检查id是否有效
        switch ($sourceType) {
            case 1:
                $isCurrent = Officebaseinfo::model()->checkOfficeIdIsCurrentUser($officeid);
                $sql="UPDATE `35_officebaseinfo` SET  `ob_updatedate`=".time()." where `ob_officeid` in( ".implode(',',$officeid).")";
                break;
            case 2:
                $isCurrent = Shopbaseinfo::model()->checkShopIdIsCurrentUser($officeid);
                $sql="UPDATE `35_shopbaseinfo` SET  `sb_updatedate`=".time()." where `sb_shopid` in( ".implode(',',$officeid).")";
                break;
            case 3:
                $isCurrent = Residencebaseinfo::model()->checkResidenceIdIsCurrentUser($officeid);
                $sql="UPDATE `35_residencebaseinfo` SET  `rbi_updatedate`=".time()." where `rbi_id` in( ".implode(',',$officeid).")";
                break;
            case 4:
                $isCurrent = Creativesource::model()->checkIdIsCurrentUser($officeid);
                $sql="UPDATE `35_creativesource` SET  `cr_updatedate`=".time()." where `cr_id` in( ".implode(',',$officeid).")";
                break;
            default:
                $isCurrent = false;
        }
        if(!$isCurrent) {
            echo "error";
            exit;
        }
        //判断用户今天是否还能够刷新
        switch(User::model()->getCurrentRole()) {
            case User::agent :
                $allNum = Uagent::model()->getAllOperateNum($userid,3);
                $nowNum = Uagent::model()->getNowOperateNum($userid,3,$sourceType);
                break;
            default:
                $allNum = 0;//每日可刷新数
                $nowNum = 0;//今日已刷新数
                break;
        }

        if($allNum>=$nowNum+$flushNum) {
            //判断新币是否足够，不够则刷新失败。刷新每一则房源扣2分
//            $usermoney = Userproperty::model()->getUserMoney($userid);
//            $cutmoney = $flushNum*(Oprationconfig::model()->getConfigByName('flushUpdateDate', '0'));//刷新每一则房源扣2分
//            if($usermoney<$cutmoney) {
//                echo "1";//新币不够，刷新失败。
//                exit;
//            }
//            $logDescription = "刷新房源(".implode(',',$officeid).")成功，扣除{:money}新币";
//            Userproperty::model()->deductMoney($userid, $cutmoney ,$logDescription);//扣除新币

//            $orderSql=$this->getUpdateOrderSql(implode(',',$officeid), $sourceType);
            $connection = Yii::app()->db;
//            //$sql="UPDATE `35_officebaseinfo` SET  `ob_updatedate`=".time()." where `ob_officeid` in( ".$officeid.")";//移动到——>检查id是否有效处
            $connection->createCommand($sql)->execute();
//            if($orderSql){
//                $connection->createCommand($orderSql)->execute();
//            }
            //更改刷新表
            Dayoperation::model()->updatePerationNum($userid,$sourceType ,$flushNum);//Dayoperation::buildFlush
            $nowNum = $nowNum+$flushNum;
            echo $allNum."_".$nowNum;
        }else {
            echo "0";//刷新失败
        }
        exit;
    }
    /**
     * 删除房源的资源
     * @param int $id 房源id
     * @param int $sourceType  房源类型
     */
    private function deleteResource($id,$sourceType){
        //下面是房源可能存在的数据
        //删除推荐
//        $criteria=new CDbCriteria;
//        $criteria->addColumnCondition(array("sp_sourceid"=>$id));
//        $criteria->addInCondition("p_positiontype",array(1,2,6));
//        $allProduct = Buyproduct::model()->with("productgrid")->findAll($criteria);
//        if($allProduct){
//            foreach($allProduct as $value){
//                $value->delete();
//            }
//        }
        $t=$t2='';
        switch ($sourceType){
            case 1:
                $t='officebaseinfo';
                $t2=Subpanorama::office;
                $t3 = Officebaseinfo::$officePicNorm;
                break;
            case 2:
                $t='shopbaseinfo';
                $t2=Subpanorama::shop;
                $t3 = Officebaseinfo::$officePicNorm;
                break;
            case 3:
                $t='residencebaseinfo';
                $t2=Subpanorama::residence;
                $t3 = Officebaseinfo::$officePicNorm;
                break;
            case 4:
                $t='cyparksource';
                $t2=Subpanorama::cypark;
                $t3 = Creativesource::$cyParkPicNorm;
                break;
        }
        $pictureModel = Picture::model()->findAllByAttributes(array("p_sourceid"=>$id,"p_sourcetype"=>Picture::$sourceType[$t]));//写字楼图片
        if($pictureModel){
            foreach($pictureModel as $value){
                Picture::model()->deleteFile(PIC_PATH.$value['p_img'], Officebaseinfo::$officePicNorm);
                $value->delete();
            }
        }

        $subpanoramaModel = Subpanorama::model()->findAllByAttributes(array("spn_sourceid"=>$id,"spn_sourcetype"=>$t2));//客服为用户制作的全景
        if($subpanoramaModel){
            foreach($subpanoramaModel as $value){
                Subpanorama::model()->deleteOnePanoramaById($value['spn_id']);
            }
        }
    }
    private function deleteCyPark($idArr){
        $models=Creativesource::model()->findAll('cr_id IN('.implode(',', $idArr).')');
        if($models){
            $userid=Yii::app()->user->id;
            foreach($models as $model){
                if($model->cr_userid==$userid){
                    $deleteArr=array();
                    $deleteArr['type']='4';
                    $deleteArr['buildid']=$model->cr_cpid;
                    $deleteArr['province']=9;
                    $deleteArr['city']=35;
                    $deleteArr['district']=@$model->parkbaseinfo->cp_district;
                    $deleteArr['section']=0;
                    $deleteArr['releasetime']=$model->cr_releasedate;
                    $deleteArr['sellorrent']=1;
                    $deleteArr['year']=date('Y', $deleteArr['releasetime']);
                    $deleteArr['month']=date('m', $deleteArr['releasetime']);
                    $deleteArr['ymd']=date('Ymd', $deleteArr['releasetime']);
                    $deleteArr['timestamp']=time();
                    $cyParkId=$model->cr_id;
                    $model->delete();

                    $deleteArr['price']=$model->cr_dayrentprice;
                    $dmodel=new Deletebase();
                    $dmodel->attributes=$deleteArr;
                    $dmodel->save();
                    $this->deleteResource($cyParkId, 4);
                }
            }
        }
    }
    private function deleteOffice($idArr){
        $models=Officebaseinfo::model()->findAll('ob_officeid IN('.implode(',', $idArr).')');
        if($models){
            $userid=Yii::app()->user->id;
            foreach($models as $model){
                if($model->ob_uid==$userid){
                    $deleteArr=array();
                    $deleteArr['type']='1';
                    $deleteArr['buildid']=$model->ob_sysid;
                    $deleteArr['province']=@$model->buildingInfo->sbi_province;
                    $deleteArr['city']=@$model->buildingInfo->sbi_city;
                    $deleteArr['district']=@$model->buildingInfo->sbi_district;
                    $deleteArr['section']=@$model->buildingInfo->sbi_section;
                    $deleteArr['releasetime']=$model->ob_releasedate;
                    $deleteArr['sellorrent']=$model->ob_sellorrent;
                    $deleteArr['year']=date('Y', $deleteArr['releasetime']);
                    $deleteArr['month']=date('m', $deleteArr['releasetime']);
                    $deleteArr['ymd']=date('Ymd', $deleteArr['releasetime']);
                    $deleteArr['timestamp']=time();
                    $officeId=$model->ob_officeid;
                    $model->delete();
                    
                    if($model->ob_sellorrent==1){//出租
                            $deleteArr['price']=$model->ob_rentprice;
                    }else{//出售
                        $deleteArr['price']=$model->ob_avgprice;
                    }
                    $dmodel=new Deletebase();
                    $dmodel->attributes=$deleteArr;
                    $dmodel->save();
                    $this->deleteResource($officeId, 1);
                }
            }
        }
    }
    private function deleteShop($idArr){
        $models=Shopbaseinfo::model()->findAll('sb_shopid IN('.implode(',', $idArr).')');
        if($models){
            $userid=Yii::app()->user->id;
            foreach($models as $model){
                if($model->sb_uid==$userid){
                    $shopId=$model->sb_shopid;
                    $deleteArr=array();
                    $deleteArr['type']='1';
                    $deleteArr['buildid']=$model->sb_sysid;
                    $deleteArr['province']=$model->sb_province;
                    $deleteArr['city']=$model->sb_city;
                    $deleteArr['district']=$model->sb_district;
                    $deleteArr['section']=$model->sb_section;
                    $deleteArr['releasetime']=$model->sb_releasedate;
                    $deleteArr['sellorrent']=$model->sb_sellorrent;
                    $deleteArr['year']=date('Y', $deleteArr['releasetime']);
                    $deleteArr['month']=date('m', $deleteArr['releasetime']);
                    $deleteArr['ymd']=date('Ymd', $deleteArr['releasetime']);
                    $deleteArr['timestamp']=time();
                    $model->delete();
                    if( ($_model=Shoppresentinfo::model()->findByAttributes(array('sp_shopid'=>$shopId)) ))
                            $_model->delete();
                    if( ($_model=Shopfacilityinfo::model()->findByAttributes(array('sf_shopid'=>$shopId)) ))
                            $_model->delete();
                    if( ($_model=Shoptag::model()->findByAttributes(array('st_shopid'=>$shopId))))
                            $_model->delete();

                     if($model->sb_sellorrent==1){
                         if( ($_model=Shoprentinfo::model()->findByAttributes(array('sr_shopid'=>$shopId)) )){
                             $deleteArr['price']=$_model->sr_rentprice;
                             $_model->delete();
                         }
                     } else {
                         if( ($_model=Shopsellinfo::model()->findByAttributes(array('ss_shopid'=>$shopId)) )){
                             $deleteArr['price']=$_model->sr_avgprice;
                             $_model->delete();
                         }
                     }
                     $dmodel=new Deletebase();
                     $dmodel->attributes=$deleteArr;
                     $dmodel->save();
                     $this->deleteResource($shopId, 2);
                }
            }
        }
    }
    private function deleteZhuzhai($idArr){
        $models=Residencebaseinfo::model()->findAll('rbi_id IN('.implode(',', $idArr).')');
        if($models){
            $userid=Yii::app()->user->id;
            foreach($models as $model){
                if($model->rbi_uid==$userid){
                    $rbi_id = $model->rbi_id;
                    $deleteArr=array();
                    $deleteArr['type']='1';
                    $deleteArr['buildid']=$model->rbi_communityid;
                    $_model=Communitybaseinfo::model()->findByPk($model->rbi_communityid);
                    if($_model){
                        $deleteArr['province']=$_model->comy_province;
                        $deleteArr['city']=$_model->comy_city;
                        $deleteArr['district']=$_model->comy_district;
                        $deleteArr['section']=$_model->comy_section;
                    }
                    $deleteArr['releasetime']=$model->rbi_releasedate;
                    $deleteArr['sellorrent']=$model->rbi_rentorsell;
                    $deleteArr['year']=date('Y', $deleteArr['releasetime']);
                    $deleteArr['month']=date('m', $deleteArr['releasetime']);
                    $deleteArr['ymd']=date('Ymd', $deleteArr['releasetime']);
                    $deleteArr['timestamp']=time();
                    $model->delete();
                    if($model->rbi_rentorsell==1){//出租
                        if( ($_model=Residencerentinfo::model()->findByAttributes(array("rr_rbiid"=>$rbi_id)) )){
                            $deleteArr['price']=$_model->rr_rentprice;
                            $_model->delete();
                        }
                    }else{//出售
                        if( ($_model=Residencesellinfo::model()->findByAttributes(array("rs_rbiid"=>$rbi_id)) )){
                            $deleteArr['price']=$_model->rs_unitprice;
                                $_model->delete();
                        }
                    }
                    if( ($_model=Residencetag::model()->findByAttributes(array("rt_rbiid"=>$rbi_id)) ))
                            $_model->delete();
                    $dmodel=new Deletebase();
                    $dmodel->attributes=$deleteArr;
                    $dmodel->save();
                    $this->deleteResource($rbi_id, 2);
                }
            }
        }
    }
    protected function fullDelete($sourceType,$idArr){
        switch ($sourceType){
            case 1:
                $tmp = Officebaseinfo::model()->findByPk($idArr[0]);
                $type = "";
                if($tmp->ob_check==4){//取出第一个发现原来是发布状态，则要删除修改总发布数目
                    $type = "-";
                }
                $this->changeUserHouseNum(count($idArr),$sourceType,$type);
                $this->deleteOffice($idArr);
                break;
            case 2:
                $tmp = Shoptag::model()->findbyAttributes(array('st_shopid'=>$idArr[0]));
                $type = "";
                if($tmp->st_check==4){//取出第一个发现原来是发布状态，则要删除修改总发布数目
                    $type = "-";
                }
                $this->changeUserHouseNum(count($idArr),$sourceType,$type);
                $this->deleteShop($idArr);
                break;
            case 3:
                $tmp = Residencetag::model()->findbyAttributes(array('rt_rbiid'=>$idArr[0]));
                $type = "";
                if($tmp->rt_check==4){//取出第一个发现原来是发布状态，则要删除修改总发布数目
                    $type = "-";
                }
                $this->changeUserHouseNum(count($idArr),$sourceType,$type);
                $this->deleteZhuzhai($idArr);
                break;
            case 4://创意园区
                $tmp = Creativesource::model()->findByPk($idArr[0]);
                $type = "";
                if($tmp->cr_check==4){//取出第一个发现原来是发布状态，则要删除修改总发布数目
                    $type = "-";
                }
                $this->changeUserHouseNum(count($idArr),$sourceType,$type);
                $this->deleteCyPark($idArr);
                break;
        }
    }
    /**
     * 设置tag标签（急，推）
     */
    public function actionTagit(){
        $id=isset($_GET['id'])?(int)$_GET['id']:0;
        $sourceType=isset($_GET['type'])?trim($_GET['type']):'';
        $tag=isset($_GET['tag'])?trim($_GET['tag']):'';
        if(!in_array($sourceType,array('1','2','3')) || !in_array($tag,array('hurry','recom')) ){
            echo '参数错误';exit();
        }
        switch(User::model()->getCurrentRole()) {
            case User::personal :
                $className = "Unormal";
                break;
            case User::agent :
                $className = "Uagent";
                break;
            case User::company :
                $className = "Ucom";
                break;
            default:
                exit('参数错误');
                break;
        }

        $userId=Yii::app()->user->id;
        $allMoney=Userproperty::model()->getUserMoney($userId);
        $release=Oprationconfig::model()->getConfigByName('release');
        $hurryMoney=$release['1'];//急标签花费money
        $recomMoney=$release['2'];//推标签花费money

        if($tag=='hurry'){//如果设置了急房源
            $allHurryNum = call_user_func(array($className,"model"))->getAllOperateNum($userId,4);//可设急房源总数
            $nowHurryNum = call_user_func(array($className,"model"))->getNowOperateNum($userId,4,$sourceType);//当前急房源数
            if($nowHurryNum>=$allHurryNum){
                echo '超过了可设置急房源总数',$allHurryNum;exit;
            }
            if($allMoney<$hurryMoney){
                echo '新币不够请充值或购买套餐再执行此操作';exit;
            }
        } else{
            $allRecommendNum = call_user_func(array($className,"model"))->getAllOperateNum($userId,5);//可设推荐房源总数
            $nowRecommendNum = call_user_func(array($className,"model"))->getNowOperateNum($userId,5,$sourceType);//当前推荐房源数
            if($nowRecommendNum>=$allRecommendNum){
                echo '超过了可设置推荐房源总数',$allRecommendNum;exit;
            }
            if($allMoney<$recomMoney){
                echo '新币不够请充值或购买套餐再执行此操作';exit;
            }
        }

        if($sourceType=='1'){
            $model=Officetag::model()->find('ot_officeid='.$id);
            if($model){
                if($tag=='hurry'){
                    $money=$model->ot_ishurry?'':$hurryMoney;
                    $model->ot_ishurry=1;
                    $description = "写字楼房源".$id."添加急标签，扣除{:money}新币";
                }else{
                    $money=$model->ot_isrecommend?'':$recomMoney;
                    $model->ot_isrecommend=1;
                    $description = "写字楼房源".$id."添加推标签，扣除{:money}新币";
                }
                $model->update();
            }
        }elseif($sourceType=='3'){
            $model=Residencetag::model()->find('rt_rbiid='.$id);
            if($model){
                if($tag=='hurry'){
                    $money=$model->rt_ishurry?'':$hurryMoney;
                    $model->rt_ishurry=1;
                    $description = "住宅房源".$id."添加急标签，扣除{:money}新币";
                }else{
                    $money=$model->rt_isrecommend?'':$recomMoney;
                    $model->rt_isrecommend=1;
                    $description = "住宅楼房源".$id."添加推标签，扣除{:money}新币";
                }
                $model->update();
            }
        }else{
            $model=Shoptag::model()->find('st_shopid='.$id);
            if($model){
                if($tag=='hurry'){
                    $money=$model->st_ishurry?'':$hurryMoney;
                    $model->st_ishurry=1;
                    $description = "商铺房源".$id."添加急标签，扣除{:money}新币";
                }else{
                    $money=$model->st_isrecommend?'':$recomMoney;
                    $model->st_isrecommend=1;
                    $description = "商铺房源".$id."添加推标签，扣除{:money}新币";
                }
                $model->update();
            }
        }
        if($money)
            Userproperty::model()->deductMoney(Yii::app()->user->id, $money ,$description);
        echo '0';
    }
    /*
     * 操作35_officetag表，支持删除房源、发布房源
    */
    public function actionChangeTag() {//{"id":id,"state":state,"sourceType":sourceType}
        $userid = Yii::app()->user->id;
        if(empty($_GET['id']) || !in_array($_GET['sourceType'], array(1,2,3,4)) || !in_array($_GET['state'], array(1,4,8)) ) {
            exit('error');
        }
        $idArr = explode(',', $_GET['id']);
        $sourceType = $_GET['sourceType'];
        $state = $_GET['state'];
        //根据不同的操作状态，去不同的方法。
        if($state==4) {
            $return = $this->changeTagRelest($idArr, $sourceType, $userid);
            echo $return;
        }elseif($state==1){//删除
            $this->fullDelete($sourceType, $idArr);
            echo "1_"."操作成功！";
        }elseif($state==8){//草稿箱
            $this->OnlyChangeStage($sourceType, $idArr);
            echo "1_"."操作成功！";
        }
        exit;
    }
    private function changeUserHouseNum($num, $sourceType, $type){
        if(!in_array($type, array("+","-"))){
            return ;
        }
        $userid = Yii::app()->user->id;
        $modelUser=User::model()->findByPk($userid);
        switch ($sourceType){
            case 1:
                $lan = "user_officenum";break;
            case 2:
                $lan = "user_shopnum";break;
            case 3:
                $lan = "user_residencenum";break;
            case 4:
                $lan = "user_cyparknum";break;
        }
        if($type=="+"){
            $modelUser->user_housenum=$modelUser->user_housenum+$num;
            $modelUser->$lan=$modelUser->$lan+$num;
        }elseif($type=="-"){
            $modelUser->user_housenum=$modelUser->user_housenum-$num;
            $modelUser->$lan=$modelUser->$lan-$num;
        }
        $modelUser->update();
    }
    private function OnlyChangeStage($sourceType, $idArr){
        $userid = Yii::app()->user->id;
        switch ($sourceType) {
            case 1://写字楼
                $tmp = Officebaseinfo::model()->findByPk($idArr[0]);
                $type = "";
                if($tmp->ob_check==4){//取出第一个发现原来是发布状态，则要删除修改总发布数目
                    $type = "-";
                }
                $criteria=new CDbCriteria();
                $criteria->addInCondition("ob_officeid",$idArr);
                $criteria->addColumnCondition(array("ob_uid"=>$userid));
                $num = Officebaseinfo::model()->updateAll(array("ob_check"=>8),$criteria);
                $this->changeUserHouseNum($num,$sourceType,$type);
                break;
            case 2:
                $tmp = Shoptag::model()->findbyAttributes(array('st_shopid'=>$idArr[0]));
                $type = "";
                if($tmp->st_check==4){//取出第一个发现原来是发布状态，则要删除修改总发布数目
                    $type = "-";
                }
                $criteria=new CDbCriteria();
                $criteria->addInCondition("st_shopid",$idArr);
                $num = Shoptag::model()->updateAll(array("st_check"=>8),$criteria);
                $this->changeUserHouseNum($num,$sourceType,$type);
                break;
            case 3:
                $tmp = Residencetag::model()->findbyAttributes(array('rt_rbiid'=>$idArr[0]));
                $type = "";
                if($tmp->rt_check==4){//取出第一个发现原来是发布状态，则要删除修改总发布数目
                    $type = "-";
                }
                $criteria=new CDbCriteria();
                $criteria->addInCondition("rt_rbiid",$idArr);
                $num = Residencetag::model()->updateAll(array("rt_check"=>8),$criteria);
                $this->changeUserHouseNum($num,$sourceType,$type);
                break;
            case 4:
                $tmp = Creativesource::model()->findByPk($idArr[0]);
                $type = "";
                if($tmp->cr_check==4){//取出第一个发现原来是发布状态，则要删除修改总发布数目
                    $type = "-";
                }
                $criteria=new CDbCriteria();
                $criteria->addInCondition("cr_id",$idArr);
                $criteria->addColumnCondition(array("cr_userid"=>$userid));
                $num = Creativesource::model()->updateAll(array("cr_check"=>8),$criteria);
                $this->changeUserHouseNum($num,$sourceType,$type);
                break;
        }
    }
    /**
     * 房源状态改成发布
     */
    private function changeTagRelest($idArr,$sourceType,$userid) {
        list($allNum,$nowNum) = User::model()->getOprateState($userid,1,$sourceType);
        $optNum = count($idArr);
        if($allNum<$nowNum+$optNum) {//不能发布这么多
            return "0_"."您已经达到您能够发布房源条数的最大值，发布失败！";
        }else{
            $integral=Oprationconfig::model()->getConfigByName('release',3);//奖励积分
            $integralall = $optNum*$integral;
            $userid=Yii::app()->user->id;
            
            if($sourceType == 1) {//写字楼
                $criteria=new CDbCriteria();
                $criteria->addInCondition("ob_officeid",$idArr);
                $criteria->addColumnCondition(array("ob_uid"=>$userid));
                $num = Officebaseinfo::model()->updateAll(array("ob_check"=>4,"ob_releasedate"=>time()),$criteria);
                $description = "写字楼房源".implode(",", $idArr)."发布成功，奖励{:point}积分";
                Userproperty::model()->addPoint($userid, $integralall, $description);
            }elseif($sourceType == 2) {
                $criteria=new CDbCriteria();
                $criteria->addInCondition("st_shopid",$idArr);
                $num = Shoptag::model()->updateAll(array("st_check"=>4),$criteria);
                $description = "商铺房源".implode(",", $idArr)."发布成功，奖励{:point}积分";
                Userproperty::model()->addPoint($userid, $integralall, $description);
            }
            elseif($sourceType == 3) {
                $criteria=new CDbCriteria();
                $criteria->addInCondition("rt_rbiid",$idArr);
                $num = Residencetag::model()->updateAll(array("rt_check"=>4),$criteria);
                $description = "住宅房源".implode(",", $idArr)."发布成功，奖励{:point}积分";
                Userproperty::model()->addPoint($userid, $integralall, $description);
            }elseif($sourceType == 4){
                $criteria=new CDbCriteria();
                $criteria->addInCondition("cr_id",$idArr);
                $criteria->addColumnCondition(array("cr_userid"=>$userid));
                $num = Creativesource::model()->updateAll(array("cr_check"=>4,"cr_releasedate"=>time()),$criteria);
                $description = "创意园区房源".implode(",", $idArr)."发布成功，奖励{:point}积分";
                Userproperty::model()->addPoint($userid, $integralall, $description);
            }
            $this->changeUserHouseNum($num,$sourceType,"+");
            $nowNum = $nowNum+$optNum;
            return "1_"."您总共可发布房源".$allNum."条，已发布".$nowNum."条，本次获得积分：".$integralall."！";
        }
    }

    protected function performAjaxValidation($model) {
        if(isset($_POST['ajax']) && $_POST['ajax']==='AgentRegister-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel() {
        if($this->_model===null) {
            $userId = Yii::app()->user->id;
            if(isset($userId)) {
                $this->_model = Viewuagent::model()->findByAttributes(array('user_id'=>$userId));
            }
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }

    /**
     *
     *
     */
    protected function generateSalt() {
        return md5(microtime());
    }

    /**
     *
     * @param $salt
     * @param $pwd
     * @return pwdstring
     */
    protected function generatePwd($salt,$pwd) {
        return md5($salt.$pwd);
    }
    /**
     *  查看积分
     */
    public function actionViewIntegral() {
        $userId = Yii::app()->user->id;
        $userProperty = Userproperty::model()->findByAttributes(array('m_userid'=>$userId));
        $dataProvider=new CActiveDataProvider('log', array(
                        'criteria'=>array(
                                'condition'=>'lg_userid=:userId and lg_type=:type',
                                'params'=>array(
                                        ':userId'=>$userId,
                                        ':type'=>Log::integral,
                                ),
                                'order'=>'lg_recodetime desc'
                        ),
                        'pagination'=>array(
                                'pageSize'=>30,
                        ),
        ));
        $this->render('viewIntegral',array(
                'userProperty'=>$userProperty,
                'dataProvider'=>$dataProvider,
        ));
    }
    /**
     *  查看新币
     */
    public function actionViewMoney() {
        $userId = Yii::app()->user->id;
        $userMoney = Userproperty::model()->getUserMoney($userId);
        $dataProvider=new CActiveDataProvider('log', array(
                        'criteria'=>array(
                                'condition'=>'lg_userid=:userId and lg_type=:type',
                                'params'=>array(
                                        ':userId'=>$userId,
                                        ':type'=>Log::money,
                                ),
                                'order'=>'lg_recodetime desc'
                        ),
                        'pagination'=>array(
                                'pageSize'=>30,
                        ),
        ));
        $this->render('viewMoney',array(
                'userMoney'=>$userMoney,
                'dataProvider'=>$dataProvider,
        ));
    }

    //查看站点建议/意见
    public function actionShowMsgrec() {
        $model = new Msgrec;
        $userId=Yii::app()->user->id;
        //建议/意见
        $criteria=new CDbCriteria(array(
                        'condition'=>'mr_sendid=:userId',
                        'params'=>array(":userId"=>$userId),
                        'order'=>'mr_time DESC',
        ));
        $list=new CActiveDataProvider('Msgrec',array(
                        'pagination'=>array(
                                'pageSize'=>10,
                        ),
                        'criteria'=>$criteria,
        ));
        if(isset($_POST['Msgrec'])) {
            $model->attributes=$_POST['Msgrec'];
            $model->mr_sendid=$userId;
            $model->mr_time=time();
            $model->save();
        }
        $this->render('showMsgrec',array(
                'sendProvider'=>$list,
                'model'=>$model,
        ));
    }

    /**
     * 提供楼盘
     */
    public function actionUpattachment() {
        $maxSize = 10;//单位MB
        while( ! empty($_FILES)) {
            $attext = strtolower(substr($_FILES['attachment']['name'],strrpos($_FILES['attachment']['name'], '.')+1));
            if( ! in_array($attext, array('rar','zip'))) {
                Yii::app()->user->setFlash('showMessage','文件格式只能是rar、zip');
                break;
            }
            if( ! $_FILES['attachment']['size'] > $maxSize*1048576){
                Yii::app()->user->setFlash('showMessage','文件大小不能超过'.$maxSize.'MB');
                break;
            }
            $buid_type = $_POST['buidtype'];
            $buid_id = $_POST['buidid'];
            $att_type = $_POST['atttype'];
            if(Attachment::model()->count('buid_type=? and buid_id=? and att_type=? and isuse = 1',array($buid_type,$buid_id,$att_type))){
                Yii::app()->user->setFlash('showMessage','该楼盘已经有该类型附件了，请不要重复上传');
                break;
            }
            $path = PIC_PATH.'/attachment/'.date('Y');
            !is_dir($path) && mkdir($path);
            $path.='/'.date('m');
            !is_dir($path) && mkdir($path);
            $attext = md5(microtime()).'.'.$attext;
            $targetFile =  rtrim($path, "/\\").'/'.$attext;
            //echo strlen(date('Y/m/').$attext),'<br />',date('Y/m/').$attext;
            $tempFile = $_FILES['attachment']['tmp_name'];

            if(move_uploaded_file($tempFile,$targetFile)) {
                $model = new Attachment();
                $model->buid_type = $buid_type;
                $model->buid_id = $buid_id;
                $model->att_type = $att_type;
                $model->up_uid = Yii::app()->user->id;
                $model->path = date('Y/m/').$attext;
                $model->time = time();
                $model->save();

                Yii::app()->user->setFlash('showMessage','附件上传成功');
                break;
            }else
                $this->redirect(array('main/error'));

            break;
        }
        $buid_type = isset($_GET['type'])?(int)$_GET['type']:0;
        $buid_id = isset($_GET['id'])?(int)$_GET['id']:0;
        $att_type = isset($_GET['atttype'])?(int)$_GET['atttype']:0;
        $name = '';
        if( $buid_id ) {
            if($buid_type === 1) {
                $mode=Systembuildinginfo::model()->findbyPk($buid_id);
                if($mode) $name = $mode->sbi_buildingname;
            }elseif($buid_type === 2) {
                $mode=Communitybaseinfo::model()->findbyPk($buid_id);
                if($mode) $name = $mode->comy_name;
            }
        }
        $this->render('upattachment',array(
                'buidtype'=>$buid_type,
                'atttype'=>$att_type,
                'buidid'=>$buid_id,
                'name'=>$name,
                'maxSize'=>$maxSize,
        ));

    }
    public function actionBuiddata() {
        $keyw=trim($_GET['keyw']);
        $type=(int)$_GET['type'];
        $dba = dba();
        $sql = "SELECT `comy_id` AS 'id',`comy_name` AS 'name'
            FROM `35_communitybaseinfo`
                WHERE `comy_name` LIKE '%".$keyw."%'
            ORDER BY `comy_id` DESC LIMIT 10" ;
        if($type === 1)
            $sql = "SELECT `sbi_buildingid` AS 'id',`sbi_buildingname` AS 'name'
            FROM `35_systembuildinginfo`
                WHERE `sbi_buildingname` LIKE '%".$keyw."%'
            ORDER BY `sbi_buildingid` DESC LIMIT 10" ;
        $list = $dba->select($sql);
        echo json_encode($list);
        exit;
    }
    public function actionDownload() {
        if( empty($_GET['id']) || empty ($_GET['type']) || ! in_array(trim($_GET['type']),array('1','2'))) {
            $this->redirect(array('main/error'));
        }
        $id = (int)$_GET['id'];
        $type = (int)$_GET['type'];
        $atttype = (int)$_GET['atttype'];
        $attachment = Attachment::model()->findByPk($id);
        if(!$attachment ||
                $attachment->isuse == 0 ||
                $attachment->buid_type != $type ||
                $attachment->att_type != $atttype) {
            throw new CHttpException(404,'没有找到您需要下载的文件。');
        }
        $attachment->downloads++;
        $attachment->save();
        $bname = Attachment::$buidTypeName[$attachment->buid_type].$attachment->buid_id . Attachment::$attTypeName[$attachment->att_type];
        $file_name   =   $bname.'附件'.substr($attachment->path,strrpos($attachment->path, '.'));
        $file_path   =   PIC_PATH.'/attachment/'.$attachment->path;
        if (!file_exists($file_path)) {   //检查文件是否存在
            throw new CHttpException(404,'没有找到您需要下载的文件。');
        }   else {
            if($attachment->up_uid != Yii::app()->user->id)
                Downloadlog::model()->haveDownload($attachment->buid_id, $type, $atttype,$attachment->money);
            $file   =   fopen($file_path, "r ");   //   打开文件
            
            //   输入文件标签
            Header( "Content-type:   application/octet-stream ");
            Header( "Accept-Ranges:   bytes ");
            Header( "Accept-Length:   ".filesize($file_path));
            Header( "Content-Disposition:   attachment;   filename= " . $file_name);
            //   输出文件内容
            echo fread($file,filesize($file_path));
            fclose($file);
            
        }
    }
}
