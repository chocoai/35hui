<?php

class SystembuildinginfoController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;
    /**
     * 修改楼盘信息的标题图片
     */
    public function actionUpdateTitlePic(){
        $model = $this->loadModel();
        if(isset($_POST['picId'])){
            //验证该图片是否属于该房源
            $hasPermission = Picture::model()->checkPictureByCondition($_POST['picId'],$model->sbi_buildingid,Picture::$sourceType['systembuilding']);
            if($hasPermission){
                $model->sbi_titlepic = $_POST['picId'];
                if($model->save()){
                    $this->redirect(array('view','id'=>$model->sbi_buildingid));
                }else{
                    var_dump($model->getErrors());
                }
            }
        }
        $pictures = Picture::model()->getPicturesByCondition($model->sbi_buildingid,Picture::$sourceType['systembuilding']);
        $this->render('updateTitlePic',array(
                'model'=>$model,
                'pictures'=>$pictures
        ));
    }
    /**
     * 楼盘合并
     */
    public function actionMerger(){
        if($_POST&&!empty($_POST)){
            echo "<pre>";
            print_r($_POST);
            
            $fromId = $_POST["frombuildid"];
            $toId = $_POST["tobuildid"];

            $fromModel = Systembuildinginfo::model()->findByPk($fromId);
            $toModel = Systembuildinginfo::model()->findByPk($toId);
            
            foreach($_POST as $key=>$value){
                if($value=="on"){//要使用原楼盘的数据。
                    $toModel[$key] = $fromModel[$key];
                }
            }
            
            $toModel->update();
            $fromModel->delete();
            //替换全景
            Panorama::model()->updateAll(array("p_buildingid"=>$toId),"p_buildingid=".$fromId);
            //替换图片
            Picture::model()->updateAll(array("p_sourceid"=>$toId),"p_sourceid=".$fromId." and p_sourcetype=1");
            //替换写字楼房源
            Officebaseinfo::model()->updateAll(array("ob_sysid"=>$toId),"ob_sysid=".$fromId);
            Yii::app()->user->setFlash('message','合并楼盘成功！');
            $this->redirect("merger");
        }
        $this->render("merger");
    }
    public function actionFiltersource(){
        $model = $this->loadModel();
        $sellorrent = isset($_POST["type"])&&$_POST["type"]==2?"2":"1";
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("ob_sellorrent"=>$sellorrent,"ob_sysid"=>$model->sbi_buildingid,"ob_check"=>4));
        if($sellorrent==1){
            $criteria->order = "ob_rentprice asc";
        }else{
            $criteria->order = "ob_sumprice asc";
        }
        $dataProvider = new CActiveDataProvider("Officebaseinfo", array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>20,
            ),

		));
        $this->render("filtersource",array(
            "model"=>$model,
            "dataProvider"=>$dataProvider,
            "type"=>$sellorrent,
        ));
    }
    public function actionChangeXiezilouState(){
        $id = $_POST["id"];
        if(isset($_POST["chk"])&&$_POST["chk"]){
            $criteria=new CDbCriteria;
            $criteria->addInCondition("ob_officeid",$_POST["chk"]);
            $all = Officebaseinfo::model()->findAll($criteria);

            $userInfo = array();
            foreach($all as $value){
                $userInfo[$value->ob_uid][] = $value->ob_officeid;
                //设置下线
                $value->ob_check = 8;
                $value->update();
            }
            //发布站内信
            foreach($userInfo as $key=>$value){
                $contentArr = array();
                foreach($value as $l){
                    $contentArr[] = CHtml::link($l,array("officebaseinfo/view","id"=>$l),array("target"=>"_blank"));
                }
                $content = "房源".implode("、", $contentArr)."由于房价太低，怀疑为虚假房源，系统强制下线！";
                Msg::model()->sendMessage("0", $key, "房源下线通知", $content);
            }
        }
        Yii::app()->user->setFlash('message','房源下线成功！');
        $this->redirect(array("filtersource","id"=>$id));
    }
    public function actionGetBuildInfo(){
        $id = $_GET["id"];
        $return = "error";
        $info = Systembuildinginfo::model()->findByPk($id);
        if($info){
            $arr = $info->attributes;
            $arr["sbi_buildingname"] = CHtml::link($arr["sbi_buildingname"],MAINHOST."/systembuildinginfo/view/id/".$arr["sbi_buildingid"],array("target"=>"_blank"));
			$array=array("sbi_peripheral","sbi_traffic","sbi_datang","sbi_zoulang","sbi_floorinfo","sbi_biaozhun","sbi_toiletwater","sbi_liftinfo","sbi_communication","sbi_aircon","sbi_security","sbi_carport","sbi_roommating","sbi_propertyserver");
			foreach($array as $val){
			$arr[$val]=$arr[$val]?Creativeparkbaseinfo::model()->getStrByArray(unserialize($arr[$val])," : ","<br/><br/>"):"";
			}
			$return = json_encode($arr);
        }
        echo $return;exit;
    }
    /**
     * Displays a particular model.
     */
    public function actionView()
    {
        $model = $this->loadModel();
        $titlePic = Picture::model()->findByPk($model->sbi_titlepic);
        $this->render('view',array(
                'model'=>$model,
                'titlePic'=>$titlePic
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        Yii::import('application.common.*');
        $model=new Systembuildinginfo;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['Systembuildinginfo']))
        {   
            $model->sbi_recordtime = time();
            $model->sbi_updatetime = time();
            $model = $this->formatPostAttributes($model);
			if($model->save()){
               if(isset($_POST['newbuildinfo'])){
                $newbuild=new Newbuild;
                $newbuild->nb_sid=$model->sbi_buildingid;
                $newbuild->attributes=$_POST["newbuild"];
                    if($newbuild->save()){
                    }else{
                        exit;
                    }
                }
               $this->redirect(array('view','id'=>$model->sbi_buildingid));
            }
        }
        $this->render('create',array(
                'model'=>$model,
        ));
    }
    /**
     * 楼盘推荐
     */
    public function actionRecommend(){
        $dataProvider_5=new CActiveDataProvider('Productgrid', array(  //楼盘中心
                        'criteria'=>array(
                                'condition'=>'p_index=1 and p_positiontype=5',
                        ),
                        'pagination'=>array(
                                'pageSize'=>10,
                        ),
        ));
        $dataProvider_9=new CActiveDataProvider('Productgrid', array( //商业广场
                        'criteria'=>array(
                                'condition'=>'p_index=1 and p_positiontype=7',
                        ),
                        'pagination'=>array(
                                'pageSize'=>10,
                        ),
        ));
        $this->render('recommend',array(
                'dataProvider_5'=>$dataProvider_5,
                'dataProvider_9' =>$dataProvider_9,
        ));
    }
    /**
     * 弹出层中的iframe。根据userid，得到当前user的房源
     */
    public function actionSourceFrame(){
        $sbi_buildtype=isset($_GET['tab']) && $_GET['tab']=='shop'?2:1;
        $pgid = $_GET['pgid'];//选择的是哪个格子
        //先查看是否有楼盘已经设置过，有就要过滤。同一个页面位置，只能有一个楼盘。
        $row = Productgrid::model()->findByPk($pgid);
        $list = Productgrid::model()->findAll("p_page=:p_page and p_position=:p_position and p_positiontype=:p_positiontype",array(
                'p_page'=>$row->p_page,
                "p_position"=>$row->p_position,
                'p_positiontype'=>$sbi_buildtype==2?7:5
        ));

        $productarr = array();
        foreach($list as $value){
            $productarr[] = $value->p_id;
        }

        $productstr = implode(",", $productarr);//得到所有的位置字符串。
        //通过位置，查询已经设置推荐的房源。
        $criteria = new CDbCriteria;

        if(empty($productstr)){
            exit('查询为空！');
        }
        $criteria->condition = "sp_positionid in(".$productstr.")";

        $officelist = Buyproduct::model()->findAll($criteria);
        $officearr = array();
        if($officelist!=""){
            foreach($officelist as $value){
                $officearr[] = $value->sp_sourceid;
            }
        }
        $criteria=new CDbCriteria();
        if(!empty($officearr)){
            $criteria->addNotInCondition("sbi_buildingid",$officearr);
        }
        $criteria->addColumnCondition(array("sbi_buildtype"=>$sbi_buildtype));

        $buildName = "";//查询楼盘名称
        if(isset($_POST['buildName'])&&$_POST['buildName']!=""){
            $buildName = $_POST['buildName'];
            $criteria->addSearchCondition("sbi_buildingname",$buildName);
        }
        $dataProvider=new CActiveDataProvider('Systembuildinginfo', array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>15,
                        ),
        ));
        $this->layout='frame';
        $this->render('sourceframe',array(
                'dataProvider'=>$dataProvider,
                'pgid'=>$pgid,
                'buildName'=>$buildName,
        ));
    }
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     */
    public function actionUpdate()
    {
        Yii::import('application.common.*');
        $model=$this->loadModel();
		if(isset($_POST['Systembuildinginfo']))
		{
            $model->sbi_updatetime = time();
            $model = $this->formatPostAttributes($model);
			if($model->save()){
                if(isset($_POST['newbuildinfo'])){
                $newbuild=Newbuild::model()->find("nb_sid=".$model->sbi_buildingid);
                if(!$newbuild)$newbuild=new Newbuild;
                $newbuild->nb_sid=$model->sbi_buildingid;
                $newbuild->attributes=$_POST["newbuild"];
                    if($newbuild->save()){
                    }else{
                        exit;
                    }
               }else{
                 $newbuild=Newbuild::model()->find("nb_sid=".$model->sbi_buildingid);
                    if($newbuild)$newbuild->delete();
               }
               $this->redirect(array('view','id'=>$model->sbi_buildingid));
            }
        }
        $this->render('update',array(
                'model'=>$model,
        ));
    }
    private function formatPostAttributes($model){
        $model->attributes=$_POST['Systembuildinginfo'];
        $model->sbi_province = 9;
        $model->sbi_city = 35;
        $model->sbi_openingtime = strtotime($model->sbi_openingtime);
        $model->sbi_buildingname=trim($model->sbi_buildingname);
        //计算轨道交通
        if(isset($_POST['sbi_busway'])){
            $model->sbi_busway = implode(",", $_POST['sbi_busway']);
        }
        //计算标签
        if(isset($_POST['tag'])){
            $model->sbi_tag = implode(",", $_POST['tag']);
        }
        //计算拼音缩写
        $pinyin = new Pinyin;
        $pinYinArray = $pinyin->doWord(trim($model->sbi_buildingname));
        $model->sbi_pinyinshortname = $pinYinArray['short'];
        $model->sbi_pinyinlongname = $pinYinArray['long'];
        //卫生间供水
        $model->sbi_toiletwater = Systembuildinginfo::model()->formatSerializeValue("sbi_toiletwater", array("冷水","冷热水","恒温水"), 0);
        //大堂
        $model->sbi_datang = Systembuildinginfo::model()->formatSerializeValue("sbi_datang", array("层高","地面","墙面","天花"));
        //公共走廊
        $model->sbi_zoulang = Systembuildinginfo::model()->formatSerializeValue("sbi_zoulang", array("宽度","地面","墙面","天花"));
        //楼层信息
        $model->sbi_floorinfo = Systembuildinginfo::model()->formatSerializeValue("sbi_floorinfo", array("面积","层高","净层高","有架空地板"),array("有架空地板"=>0));
        //交屋标准
        $model->sbi_biaozhun = Systembuildinginfo::model()->formatSerializeValue("sbi_biaozhun", array("地面","墙面","天花"));
        //电梯配置
        $model->sbi_liftinfo = Systembuildinginfo::model()->formatSerializeValue("sbi_liftinfo", array("速度","品牌","客梯","货梯","平均等候时间","忙时等候时间"));
        //车位配置
        $model->sbi_carport = Systembuildinginfo::model()->formatSerializeValue("sbi_carport", array("地下","地上","月租金","时租金"));
        //通讯系统
        $model->sbi_communication = Systembuildinginfo::model()->formatSerializeValue("sbi_communication", array("光纤","ADSL","无线网络","卫星系统","微波系统"),0);
//        print_r(unserialize($model->sbi_communication));
        //空调系统
        $model->sbi_aircon = Systembuildinginfo::model()->formatSerializeValue("sbi_aircon", array("集中式中央空调","半集中式中央空调","分体空调","新风系统"),0);
        //安防系统
        $model->sbi_security = Systembuildinginfo::model()->formatSerializeValue("sbi_security", array("IC一卡通控制系统","闭路电视监视系统","门传感器监视系统","24小时巡逻系统","停车控制及车牌识别系统","应急电源,照明和扩音系统","智能自动火警检测系统","自动喷水灭火系统"),0);
        //楼内配套
        $model->sbi_roommating = Systembuildinginfo::model()->formatSerializeValue("sbi_roommating", array("银行","ATM","餐饮","便利店","食堂","干洗店","商务中心","会议室","会展中心"),0);
        //物业服务
        $model->sbi_propertyserver = Systembuildinginfo::model()->formatSerializeValue("sbi_propertyserver", array("卫生","收发邮件","订阅报刊","订阅机票酒店"),array("收发邮件"=>0,"订阅报刊"=>0,"订阅机票酒店"=>0));
//        print_r(unserialize($model->sbi_propertyserver));
         //周边配套
        $model->sbi_peripheral = Systembuildinginfo::model()->formatSerializeValue("sbi_peripheral", array("临近商街","商场","酒店","银行","餐饮"));
        //交通配套
        $model->sbi_traffic = Systembuildinginfo::model()->formatSerializeValue("sbi_traffic", array("轨道交通","高架","机场","公交车","火车站"));

        return $model;
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     */
    public function actionDelete()
    {
        if(Yii::app()->request->isPostRequest)
        {
            $model = $this->loadModel();
            $sysId = $model->sbi_buildingid;
            $model->delete();

            //楼盘评论
            $SystembuildingcommentModel = Systembuildingcomment::model()->findAllByAttributes(array("sbc_buildingid"=>$sysId));
            if($SystembuildingcommentModel){
                foreach($SystembuildingcommentModel as $value){
                    $value->delete();
                }
            }
            //楼盘印象
            $ImpressionModel = Impression::model()->findAllByAttributes(array("im_sourceid"=>$sysId,"im_sourcetype"=>Impression::systembuilding));
            if($ImpressionModel){
                foreach($ImpressionModel as $value){
                    $value->delete();
                }
            }
            //微博
            $TwitterModel = Twitter::model()->findAllByAttributes(array("t_sourceid"=>$sysId,"t_sourcetype"=>Twitter::building));
            if($TwitterModel){
                foreach($TwitterModel as $value){
                    $value->delete();
                }
            }
            //微博征集
            $TwittersuggestModel = Twittersuggest::model()->findAllByAttributes(array("ts_buildingid"=>$sysId));
            if($TwittersuggestModel){
                foreach($TwittersuggestModel as $value){
                    $value->delete();
                }
            }
            //推荐
            $criteria=new CDbCriteria;
            $criteria->addColumnCondition(array("sp_sourceid"=>$sysId));
            $criteria->addInCondition("p_positiontype",array(5,9));
            $allProduct = Buyproduct::model()->with("productgrid")->findAll($criteria);
            if($allProduct){
                foreach($allProduct as $value){
                    $value->delete();
                }
            }
            //图片
            $pictureModel = Picture::model()->findAllByAttributes(array("p_sourceid"=>$sysId,"p_sourcetype"=>Picture::$sourceType['systembuilding']));//写字楼图片
            if($pictureModel){
                foreach($pictureModel as $value){
                    Picture::model()->deleteFile(PIC_PATH.$value['p_img'], Systembuildinginfo::$pictureNorm);
                    $value->delete();
                }
            }
            //全景
            $panoramaModel = Panorama::model()->findAllByAttributes(array("p_buildingid"=>$sysId));//客服上传的楼盘全景
            if($panoramaModel){
                foreach($panoramaModel as $value){
                    Subpanorama::model()->delPanorama($value['p_url']);
                    $value->delete();
                }
            }


            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     */
    public function actionDeleteImpression()
    {
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $this->loadImpressionModel()->delete();
            echo "<script type='text/javascript'>location.href=document.referrer;</script>";
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }
    public function loadImpressionModel()
    {
        if($this->_model===null)
        {
            if(isset($_GET['id']))
                $this->_model=Impression::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }
    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $criteria = new CDbCriteria;
        $name = "";
        if(isset($_GET['buildingname'])){
            $name = trim($_GET['buildingname']);
            if($name){
                $criteria->addSearchCondition("sbi_buildingname",$name);
            }

        }
        $criteria->order = 'sbi_updatetime desc';
        $dataProvider=new CActiveDataProvider('Systembuildinginfo',array(
                        'criteria'=>$criteria,
        ));
        $this->render('index',array(
                'dataProvider'=>$dataProvider,
                'name'=>$name,
        ));
    }
    /**
     * Lists all impressions.
     */
    public function actionImpression()
    {
        $dataProvider=new CActiveDataProvider('Impression',array(
                        'criteria'=>array(
                                'condition'=>'im_sourcetype<>3',
                                'order'=>'im_id desc',
                                'im_sourceid'=>$_GET['id']
                        ),
        ));
        $this->render('impression',array(
                'dataProvider'=>$dataProvider,
                'id'=>$_GET['id']
        ));
    }
    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        //$model=new Systembuildinginfo('search');
        //$model->unsetAttributes();  // clear any default values
        //if(isset($_GET['Systembuildinginfo']))
        //	$model->attributes=$_GET['Systembuildinginfo'];
        $criteria = new CDbCriteria();
        $show = array();
        if(isset($_POST["sbi_buildingid"])&&$_POST["sbi_buildingid"]!=""){
            $criteria->addColumnCondition(array("sbi_buildingid"=>$_POST["sbi_buildingid"]));
            $show['sbi_buildingid'] = $_POST["sbi_buildingid"];
        }
        if(isset($_POST["sbi_buildingname"])&&$_POST["sbi_buildingname"]!=""){
            $criteria->addSearchCondition("sbi_buildingname",$_POST["sbi_buildingname"]);
            $show['sbi_buildingname'] = $_POST["sbi_buildingname"];
        }
        if(isset($_POST["sbi_buildtype"])&&$_POST["sbi_buildtype"]!=""){
            $criteria->addColumnCondition(array("sbi_buildtype"=>$_POST["sbi_buildtype"]));
            $show['sbi_buildtype'] = $_POST["sbi_buildtype"];
        }
        if(isset($_POST["sbi_city"])&&$_POST["sbi_city"]!=""){
            $criteria->addColumnCondition(array("sbi_city"=>$_POST["sbi_city"]));
            $show['sbi_city'] = $_POST["sbi_city"];
        }
        if(isset($_POST["sbi_district"])&&$_POST["sbi_district"]!=""){
            $criteria->addColumnCondition(array("sbi_district"=>$_POST["sbi_district"]));
            $show['sbi_district'] = $_POST["sbi_district"];
        }
        if(isset($_POST["sbi_section"])&&$_POST["sbi_section"]!=""){
            $criteria->addColumnCondition(array("sbi_section"=>$_POST["sbi_section"]));
            $show['sbi_section'] = $_POST["sbi_section"];
        }
        if(isset($_POST["sbi_busway"])&&$_POST["sbi_busway"]!=""){
            $criteria->addSearchCondition("sbi_busway",$_POST["sbi_busway"]);
            $show['sbi_busway'] = $_POST["sbi_busway"];
        }
        $dataProvider=new CActiveDataProvider('Systembuildinginfo',array(
                        "criteria"=>$criteria,
                        'pagination' => array(
                                'pageSize' => 20,
                        ),
        ));

        $this->render('admin',array(
                'dataProvider'=>$dataProvider,
                'show'=>$show,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel()
    {
        if($this->_model===null)
        {
            if(isset($_GET['id']))
                $this->_model=Systembuildinginfo::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='systembuildinginfo-form')
        {
            $className = get_class($model);
            $validateResult = json_decode(CActiveForm::validate($model),true);
            if(!strtotime($model->sbi_openingtime)){//开盘时间格式错误
                $validateResult[$className."_sbi_openingtime"] = array("开盘时间格式错误");
            }else{
                unset($validateResult[$className."_sbi_openingtime"]);
            }
            echo json_encode($validateResult);
            Yii::app()->end();
        }
    }
}
