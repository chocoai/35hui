<?php

class ShopbaseinfoController extends Controller
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
	 * Displays a particular model.
	 */
	public function actionView()
	{
        $shopId = $_GET['id'];
        $shopBaseInfoModel = $this->loadModel();
        $shopFacilityInfoModel = Shopfacilityinfo::model()->findByAttributes(array("sf_shopid"=>$shopId));//配套设施
        $shopPresentInfoModel = Shoppresentinfo::model()->findByAttributes(array("sp_shopid"=>$shopId));//展示信息
       

        if($shopBaseInfoModel->sb_sellorrent==1){//出租
            $shopSellOrRentInfoModel = Shoprentinfo::model()->findByAttributes(array("sr_shopid"=>$shopId));//出租信息
        }else{//出售
            $shopSellOrRentInfoModel = Shopsellinfo::model()->findByAttributes(array("ss_shopid"=>$shopId));//出租信息
        }

        
        
		$this->render('view',array(
			'shopBaseInfoModel'=> $shopBaseInfoModel,
            'shopFacilityInfoModel'=> $shopFacilityInfoModel,
            'shopPresentInfoModel'=> $shopPresentInfoModel,
            'shopSellOrRentInfoModel'=> $shopSellOrRentInfoModel,
		));
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{

	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
            $baseInfoModel=$this->loadModel();
            $shopId=$baseInfoModel->sb_shopid;

            $prensetInfoModel=Shoppresentinfo::model()->findByAttributes(array('sp_shopid'=>$shopId));
            $facilityInfoModel=Shopfacilityinfo::model()->findByAttributes(array('sf_shopid'=>$shopId));        
            $tagModel=Shoptag::model()->findByAttributes(array('st_shopid'=>$shopId));

            //删除
             $baseInfoModel->delete();
             $prensetInfoModel->delete();
             $facilityInfoModel && $facilityInfoModel->delete();
             if($baseInfoModel->sb_sellorrent==1){
                 $rentInfoModel=Shoprentinfo::model()->findByAttributes(array('sr_shopid'=>$shopId));
                 $rentInfoModel->delete();
             } else {
                 $sellInfoModel=Shopsellinfo::model()->findByAttributes(array('ss_shopid'=>$shopId));
                 $sellInfoModel->delete();
             }
             $tagModel && $tagModel->delete();
            //删除推荐
            $criteria=new CDbCriteria;
            $criteria->addColumnCondition(array("sp_sourceid"=>$shopId));
            $criteria->addInCondition("p_positiontype",array(7,8));
            $allProduct = Buyproduct::model()->with("productgrid")->findAll($criteria);
            if($allProduct){
                foreach($allProduct as $value){
                    $value->delete();
                }
            }
            //册除图片
            $pictureModel=Picture::model()->findAllByAttributes(array('p_sourceid'=>$shopId,'p_sourcetype'=>5));//图片

            if($pictureModel){
                foreach($pictureModel as $value){                   
                   Picture::model()->deleteFile(PIC_PATH.$value->p_img, Officebaseinfo::$officePictureNorm);
                   $value->delete();
                }
               
            }

             //删除全景
            $subPanoramaModel=Subpanorama::model()->findAllByAttributes(array('spn_sourceid'=>$shopId,'spn_sourcetype'=>2));//全景
            if($subPanoramaModel){
                 foreach($subPanoramaModel as $value){
                    Subpanorama::model()->deleteOnePanoramaById($value['spn_id']);
                 }
             }
             if(!isset($_GET['ajax']))
			 $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }else{
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
	}
    public function actionAuditlist(){
        $dataProvider=new CActiveDataProvider("Shopbaseinfo",array(
            'criteria'=>array(
                'with' => array(
                    'shopTag'=>array(
                        'condition'=>'st_check=5',
                    ),
                ),
            ),
        ));
        $this->render('auditlist',array(
            'dataProvider'=>$dataProvider,
		));
    }
    /**
     * 审核，审核未通过要返回商务币
     */
    public function actionAudit(){
        $shopid = $_POST['shopid'];
        $point = $_POST['point'];
        $sb_order = isset($_POST['sb_order'])?(int)$_POST['sb_order']:0;
        $shopTagModel = Shoptag::model()->findByAttributes(array("st_shopid"=>$shopid));
        if(!$shopTagModel->st_ishigh){//只处理现在不是优质的房源
            $shopTagModel->st_ishigh = 1;//设优
            $shopTagModel->update();

            $shopInfo = Shopbaseinfo::model()->findByPk($shopid);
            $shopInfo->sb_order += $sb_order;
            $shopInfo->update();
            //赠送积分和商务币
            $description = "商铺房源".$shopid."审核为优质房源，系统赠送{:money}商务币";
            Userproperty::model()->addMoney($shopInfo->sb_uid, $point, $description);

            $description = "商铺房源".$shopid."审核为优质房源，系统赠送{:point}积分";
            Userproperty::model()->addPoint($shopInfo->sb_uid, $point, $description);
        }
        $this->redirect(array("view","id"=>$shopid));
    }
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $criteria = new CDbCriteria;
        $criteria->order = "sb_shopid desc";
		$dataProvider=new CActiveDataProvider('Shopbaseinfo',array(
			'criteria'=>$criteria,
		));
        
		$criteria = new CDbCriteria();
        //$criteria->addColumnCondition(array("ob_buildingtype"=>3));//只显示写字楼
        $type=4;
        if(isset($_GET["type"])&&$_GET["type"]&&in_array($_GET["type"],array("4","8")))
            $type=$_GET["type"];
        $criteria->addCondition("sb_check=".$type);
        $criteria->order = "sb_updatedate desc";


		$dataProvider=new CActiveDataProvider('Shopbaseinfo',array(
            'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>10,
			),
        ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
        $criteria = new CDbCriteria(array(
            "with"=>array("presentInfo")
        ));
        $show = array();

        if(isset($_POST["sp_shoptitle"]) && $_POST["sp_shoptitle"]!=""){
            $criteria->addSearchCondition("sp_shoptitle",$_POST["sp_shoptitle"]);
            $show['sp_shoptitle'] = $_POST["sp_shoptitle"];
        }
        if(isset($_POST["check"])&&$_POST["check"]!=""){
            $criteria->addColumnCondition(array("sb_check"=>$_POST["check"]));
            $show['check'] = $_POST["check"];
        }

        if(isset($_POST["shopid"])&&$_POST["shopid"]!=""){
            $criteria->addColumnCondition(array("sb_shopid"=>$_POST["shopid"]));
            $show['shopid'] = $_POST["shopid"];
        }
        if(isset($_POST["isread"])&&$_POST["isread"]!=""){
            $criteria->addColumnCondition(array("st_isread"=>$_POST["isread"]));
            $show['isread'] = $_POST["isread"];
        }
        $criteria->order = "sb_shopid desc";
        
        $dataProvider=new CActiveDataProvider('Shopbaseinfo',array(
            "criteria"=>$criteria,
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
				$this->_model=Shopbaseinfo::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='shopbaseinfo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    /**
     *更改商铺状态
     */
     public function actionChangeTag() {//{"id":id,"state":state,"sourceType":sourceType,uid:uid}
        if(empty($_GET['id'])|| !in_array($_GET['sourceType'], array(2)) || !in_array($_POST['state'], array(1,8)) ) {
            exit('error');
        }
        $id = $_GET['id'];
        $sourceType = $_GET['sourceType'];
        $state = $_POST['state'];
        $buildname=@$_GET["buildname"];
        $msg=explode("|", $_POST["msg"]);
        if(count($msg)==1){
            $msg[1]=$msg[0];
        }
        //根据不同的操作状态，去不同的方法。
        $idArr=explode(",",$id);
        if($state==1){//删除
            $msg=array("msg_title"=>"您的房源因".$msg[0]."被强制删除",  "msg_content"=>"经纪人您好，您在".$buildname."的房源".$msg[1]."感谢您的理解，谢谢！");
            foreach($idArr as $val){
                $this->fullDelete($sourceType,$val,$msg);
            }
        }elseif($state==8){//草稿箱
            $msg=array("msg_title"=>"您的房源因".$msg[0]."被强制下线",  "msg_content"=>"经纪人您好，您在".$buildname."的房源".$msg[1]."。感谢您的理解，谢谢！");
             foreach($idArr as $val){
                $this->OnlyChangeStage($sourceType,$val,$msg);
             }
        }
    }
    //发送消息
     private function addMessage($userid,$msg){
            $model=new Msg;
            $model->msg_revid =$userid;
            $model->attributes=$msg;
            $model->msg_sendid = 0;//0代表系统管理员
            $model->msg_type = Msg::$msgtype['normal'];
            $model->msg_time = time();
            $model->msg_senddel = Msg::$del['undel'];
            $model->msg_revdel = Msg::$del['undel'];
            $model->msg_isread = Msg::$readstatu['unread'];
            if($model->msg_revid==0){
             echo '不能给自己发送站内信';
            }else{
            if($model->save()){
                //$this->redirect(array("index","m"=>10));
                echo "向用户[".$userid."]通知发送完毕\n";
                }else{
                echo  "向用户[".$userid."]站内信发送失败";
                }

            }
    }
     private function deleteShop($id){
        $model=Shopbaseinfo::model()->find('sb_shopid='.$id);
        if($model){
                    $shopId=$model->sb_shopid;
                    $deleteArr=array();
                    $deleteArr['type']='2';
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
                    if($model->delete()){
                        echo $shopId."号商铺已删除。";
                    }else{
                        echo $shopId."号商铺已删除。";
                    }
                    if( ($_model=Shoppresentinfo::model()->findByAttributes(array('sp_shopid'=>$shopId)) ))
                            $_model->delete();
                    if( ($_model=Shopfacilityinfo::model()->findByAttributes(array('sf_shopid'=>$shopId)) ))
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
        /**
     * 删除房源的资源
     * @param int $id 房源id
     * @param int $sourceType  房源类型
     */
    private function deleteResource($id,$sourceType){
        //下面是房源可能存在的数据
      
        $t=$t2='';
        switch ($sourceType){
            case 2:
                $t='shopbaseinfo';
                $t2=Subpanorama::shop;
                $t3 = Officebaseinfo::$officePicNorm;
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
     protected function fullDelete($sourceType,$id,$msg){
        switch ($sourceType){
            case 2:
                $tmp = Shopbaseinfo::model()->findbyAttributes(array('sb_shopid'=>$id));
                $type = "";
                if($tmp->sb_check==4){//取出第一个发现原来是发布状态，则要删除修改总发布数目
                    $type = "-";
                }
                
                $this->deleteShop($id);
                if(isset($tmp ->sb_uid)&&$tmp ->sb_uid){
                    $this->changeUserHouseNum(1,$sourceType,$type,$tmp ->sb_uid);
                    $this->addMessage($tmp->sb_uid,$msg);
                }else{
                    echo "该房源无用户\n";
                }
                break;
        }
    }
    private function OnlyChangeStage($sourceType,$id,$msg){
        switch ($sourceType) {
            case 2://商铺
                $tmp = Shopbaseinfo::model()->findByPk($id);
                $type = "";
                if($tmp->sb_check==4){//取出第一个发现原来是发布状态，则要删除修改总发布数目
                    $type = "-";
                }
                $criteria=new CDbCriteria();
                $criteria->addCondition("sb_shopid=".$id);
                $num = Shopbaseinfo::model()->updateAll(array("sb_check"=>8),$criteria);
                if($num){
                    echo $id."号房源已下线。";
                }else{
                    echo $id."号房源下线失败。";
                }
                if(isset($tmp ->sb_uid)&&$tmp ->sb_uid){
                $this->changeUserHouseNum($num,$sourceType,$type,$tmp->sb_uid);
                $this->addMessage($tmp->sb_uid,$msg);
                }else{
                    echo "该房源无用户\n";
                }
                break;
        }
    }
    private function changeUserHouseNum($num, $sourceType, $type,$userid){
        if(!in_array($type, array("+","-"))){
            return ;
        }
        $modelUser=User::model()->findByPk($userid);
        switch ($sourceType){
            case 2:
                $lan = "user_shopnum";break;
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
}
