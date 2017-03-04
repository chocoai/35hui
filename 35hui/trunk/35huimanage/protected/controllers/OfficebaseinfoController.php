<?php

class OfficebaseinfoController extends Controller
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
        $model = $this->loadModel();
		$this->render('view',array(
			'model'=>$model
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Officebaseinfo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Officebaseinfo']))
		{
			$model->attributes=$_POST['Officebaseinfo'];
            //计算标签
            if(isset($_POST['tag'])){
                $model->ob_tag = implode(",", $_POST['tag']);
            }
            $dba = dba();
            $model->ob_officeid = $dba->id('35_officebaseinfo');
            $model->ob_releasedate = strtotime($model->ob_releasedate);
            $model->ob_updatedate = strtotime($model->ob_updatedate);
            $model->ob_expiredate = strtotime($model->ob_expiredate);
			if($model->save())
				$this->redirect(array('view','id'=>$model->ob_officeid));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
    /**
     * 商务中心推荐
     */
    public function actionRecommend(){
        $dataProvider=new CActiveDataProvider('Productgrid', array(
            'criteria'=>array(
		        'condition'=>'p_index=1 and p_positiontype=6',
		    ),
			'pagination'=>array(
				'pageSize'=>10,
			),
		));
        $this->render('recommend',array(
            'dataProvider'=>$dataProvider,
		));
    }
     /**
     * 弹出层中的iframe。根据userid，得到当前user的房源
     */
    public function actionSourceFrame(){
        $pgid = $_GET['pgid'];//选择的是哪个格子
        //先查看是否有房源已经设置过，有就要过滤。同一个页面位置，只能有一个房源。
        $row = Productgrid::model()->findByPk($pgid);
        $list = Productgrid::model()->findAll("p_page=:p_page and p_position=:p_position",array(
            'p_page'=>$row->p_page,
            "p_position"=>$row->p_position,
        ));
        $productarr = array();
        foreach($list as $value){
            $productarr[] = $value->p_id;
        }
        $productstr = implode(",", $productarr);//得到所有的位置字符串。
        //通过位置，查询已经设置推荐的房源。
        $criteria = new CDbCriteria;
        $criteria->condition = "sp_positionid in(".$productstr.")";
        $officelist = Buyproduct::model()->findAll($criteria);
        $officearr = array();
        if($officelist!=""){
            foreach($officelist as $value){
                $officearr[] = $value->sp_sourceid;
            }
        }
        $officestr = "";
        if(!empty($officearr)){
            $officestr = implode(",", $officearr);
        }
        $criteria=new CDbCriteria();
        if($officestr==""){
            $criteria->condition = "ob_buildingtype=1 and ob_sellorrent=1";
        }else{
            $criteria->condition = "ob_buildingtype=1 and ob_sellorrent=1 and ob_officeid not in(".$officestr.")";
        }
        $criteria->with=array('offictag');
        $criteria->addColumnCondition(array('ot_check'=>'4'));
        $keyword = "";
        if(isset($_POST['keyword'])&&$_POST['keyword']!=""){
            $keyword = $_POST['keyword'];
            $criteria->addSearchCondition("ob_officename",$keyword);
        }
        $dataProvider=new CActiveDataProvider('Officebaseinfo', array(
            'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>15,
			),
		));
        $this->layout='frame';
        $this->render('sourceframe',array(
            'dataProvider'=>$dataProvider,
            'pgid'=>$pgid,
            'keyword'=>$keyword,
        ));
    }
    public function actionDoProduct(){
         //把房源设置为预定状态
        $sourceid = $_GET['sourceid'];
        $productGridId = $_GET['pgid'];
        $time = time();

        //更改最后购买时间
        $productModel = Productgrid::model()->findByPk($productGridId);
        $productModel->p_lastbuytime = $time;
        $productModel->update();

        $model=new Buyproduct;
        $dba = dba();
        $m = array(
            'sp_positionid'=>$productGridId,
            'sp_sourceid'=>$sourceid,
            'sp_state'=>0,
            'sp_buytime'=>$time,
        );
        $model->attributes=$m;
        if(!$model->save()){
            print_r($model->errors);
        }
    }
    public function actionUnDoProduct(){
        //删除房源推荐
        $productGridId = $_GET['pgid'];
        $model = Buyproduct::model()->find("sp_positionid=:sp_positionid",array(
            "sp_positionid"=>$productGridId,
        ));
        $model->delete();
    }
    /**
     * 房源审核列表
     */
    public function actionAuditList(){
        $model=new Officebaseinfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Officebaseinfo'])){
			$model->attributes=$_GET['Officebaseinfo'];
        }
        $this->render('auditlist',array(
            'model'=>$model,
		));
    }
    /**
     * 审核，审核未通过要返回商务币
     */
    public function actionAudit(){
        $officeid = $_POST['officeid'];
        $point = $_POST['point'];
        $ob_order = isset($_POST['ob_order'])?(int)$_POST['ob_order']:0;
        $officeInfo = Officebaseinfo::model()->findByPk($officeid);
        if(!$officeInfo->offictag->ot_ishigh){//只处理现在不是优质的房源
            $tagModel = Officetag::model()->findByAttributes(array("ot_officeid"=>$officeid));
            $tagModel->ot_ishigh = 1;//设优
            $tagModel->update();
            $officeInfo->ob_order += $ob_order;
            $officeInfo->update();

            //赠送积分和商务币
            $description = "写字楼房源".$officeid."审核为优质房源，系统赠送{:money}商务币";
            Userproperty::model()->addMoney($officeInfo->ob_uid, $point, $description);

            $description = "写字楼房源".$officeid."审核为优质房源，系统赠送{:point}积分";
            Userproperty::model()->addPoint($officeInfo->ob_uid, $point, $description);
        }
        $this->redirect(array("view","id"=>$officeid));
    }
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Officebaseinfo']))
		{
			$model->attributes=$_POST['Officebaseinfo'];
            //计算标签
            if(isset($_POST['tag'])){
                $model->ob_tag = implode(",", $_POST['tag']);
            }
			if($model->save())
				$this->redirect(array('view','id'=>$model->ob_officeid));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * 
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$model = $this->loadModel();
            $officeId = $model->ob_officeid;
            $model->delete();
            Officefacilityinfo::model()->findByAttributes(array("of_officeid"=>$officeId))->delete();//配套设施
            Officepresentinfo::model()->findByAttributes(array("op_officeid"=>$officeId))->delete();//展示信息
            Officetag::model()->findByAttributes(array("ot_officeid"=>$officeId))->delete();//标签
            if($model->ob_sellorrent==1){//出租
                Officerentinfo::model()->findByAttributes(array("or_officeid"=>$officeId))->delete();
            }else{//出售
                Officesellinfo::model()->findByAttributes(array("os_officeid"=>$officeId))->delete();
            }
            //下面是房源可能存在的数据
            //删除推荐
            $criteria=new CDbCriteria;
            $criteria->addColumnCondition(array("sp_sourceid"=>$officeId));
            $criteria->addInCondition("p_positiontype",array(1,2,6));
            $allProduct = Buyproduct::model()->with("productgrid")->findAll($criteria);
            if($allProduct){
                foreach($allProduct as $value){
                    $value->delete();
                }
            }
            //下面的需要包括文件一起删除
            $pictureModel = Picture::model()->findAllByAttributes(array("p_sourceid"=>$officeId,"p_sourcetype"=>Picture::$sourceType['officebaseinfo']));//写字楼图片
            if($pictureModel){
                foreach($pictureModel as $value){
                    Picture::model()->deleteFile(PIC_PATH.$value['p_img'], Officebaseinfo::$officePictureNorm);
                    $value->delete();
                }
            }
            
            $subpanoramaModel = Subpanorama::model()->findAllByAttributes(array("spn_sourceid"=>$officeId,"spn_sourcetype"=>Subpanorama::office));//客服为用户制作的全景
            if($subpanoramaModel){
                foreach($subpanoramaModel as $value){
                    Subpanorama::model()->deleteOnePanoramaById($value['spn_id']);
                }
            }
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $criteria = new CDbCriteria();
        //$criteria->addColumnCondition(array("ob_buildingtype"=>3));//只显示写字楼
        $type=4;
        if(isset($_GET["type"])&&$_GET["type"]&&in_array($_GET["type"],array("4","8")))
        $type=$_GET["type"];
        $criteria->addCondition("ob_check=".$type);
        $criteria->order = "ob_updatedate desc";
        
		if(isset($_GET["type"])&&$_GET["type"]==11){
            $criteria->addCondition("ob_pricecheck=1"); 
        }
        if(isset($_GET["type"])&&$_GET["type"]==10){
            $criteria1 = new CDbCriteria();
            $criteria1->select="sbi_buildingid";
            $build=Systembuildinginfo::model()->findAll($criteria1);
            foreach($build as $val){
                $arr2[]=$val->sbi_buildingid;
            }
            $criteria->addNotInCondition("ob_sysid",$arr2);
        }
        
		$dataProvider=new CActiveDataProvider('Officebaseinfo',array(
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
        $model=new Officebaseinfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Officebaseinfo']))
			$model->attributes=$_GET['Officebaseinfo'];
		$this->render('admin',array(
			'model'=>$model,
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
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='officebaseinfo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
   
    /**
     *更改写字楼状态
     */
     public function actionChangeTag() {//{"id":id,"state":state,"sourceType":sourceType,uid:uid}
        if(empty($_GET['id'])|| !in_array($_GET['sourceType'], array(1)) || !in_array($_POST['state'], array(1,8)) ) {
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
     private function changeUserHouseNum($num, $sourceType, $type,$userid){
        if(!in_array($type, array("+","-"))){
            return ;
        }
        $modelUser=User::model()->findByPk($userid);
        switch ($sourceType){
            case 1:
                $lan = "user_officenum";break;
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
     /**
     * 删除房源的资源
     * @param int $id 房源id
     * @param int $sourceType  房源类型
     */
    private function deleteResource($id,$sourceType){
        //下面是房源可能存在的数据
        $t=$t2='';
        switch ($sourceType){
            case 1:
                $t='officebaseinfo';
                $t2=Subpanorama::office;
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
    private function deleteOffice($id){
        $model=Officebaseinfo::model()->find('ob_officeid ='. $id);
        if($model){
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
                    if($model->delete()){
                        echo $id."号写字楼房源已删除。";
                    }else{
                        echo $id."号写字楼房源删除失败。";
                    }
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
   
    protected function fullDelete($sourceType,$id,$msg){
        switch ($sourceType){
            case 1://写字楼
                $tmp = Officebaseinfo::model()->findByPk($id);
                $type = "";
                if($tmp->ob_check==4){//取出第一个发现原来是发布状态，则要删除修改总发布数目
                    $type = "-";
                }
                $this->deleteOffice($id);
                if(isset($tmp ->ob_uid)&&$tmp ->ob_uid){
                    $this->changeUserHouseNum(1,$sourceType,$type,$tmp ->ob_uid);
                    $this->addMessage($tmp->ob_uid,$msg);
                }else{
                    echo "该房源无用户\n";
                }
                break;
        }
    }
    private function OnlyChangeStage($sourceType, $id,$msg){
        switch ($sourceType) {
            case 1://写字楼
                $tmp = Officebaseinfo::model()->findByPk($id);
                $type = "";
                if($tmp->ob_check==4){//取出第一个发现原来是发布状态，则要删除修改总发布数目
                    $type = "-";
                }
                $criteria=new CDbCriteria();
                $criteria->addCondition("ob_officeid=".$id);
                $num = Officebaseinfo::model()->updateAll(array("ob_check"=>8),$criteria);
                if($num){
                    echo $id."号房源已下线。";
                }else{
                    echo $id."号房源下线失败。";
                }
                if(isset($tmp ->ob_uid)&&$tmp ->ob_uid){
                $this->changeUserHouseNum($num,$sourceType,$type,$tmp->ob_uid);
                $this->addMessage($tmp->ob_uid,$msg);
                }else{
                    echo "该房源无用户\n";
                }
                break;
        }
    }
}
