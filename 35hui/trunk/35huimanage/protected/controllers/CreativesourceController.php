<?php

class CreativesourceController extends Controller
{
    public $layout='//layouts/column2';

	private $_model;
    
	public function actionIndex()
	{
        $criteria = new CDbCriteria();
        $type=4;
        if(isset($_GET["type"])&&$_GET["type"]&&in_array($_GET["type"],array("4","8")))
        $type=$_GET["type"];
        $criteria->addCondition("cr_check=".$type);
        $criteria->order = "cr_updatedate desc";
		
		if(isset($_GET["type"])&&$_GET["type"]==11){
            $criteria->addCondition("cr_pricecheck=1"); 
        }
		$dataProvider=new CActiveDataProvider('Creativesource',array(
            'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>10,
			),
        ));

        if(isset($_GET["type"])&&$_GET["type"]==10){
            $criteria1 = new CDbCriteria();
            $criteria1->select="cp_id";
            $cp=Creativeparkbaseinfo::model()->findAll($criteria1);
            foreach($cp as $val){
                $arr2[]=$val->cp_id;
            }
            $criteria->addNotInCondition("cr_cpid",$arr2);
        }
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionChangeTag() {//{"id":id,"state":state,"sourceType":sourceType,uid:uid}
        if(empty($_GET['id'])||!in_array($_GET['sourceType'], array(4)) || !in_array($_POST['state'], array(1,8)) ) {
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
    private function deleteCyPark($id){
        $model=Creativesource::model()->find('cr_id ='.$id);
        if($model){
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
                    if($model->delete()){
                        echo $id."号创意园房源已删除。";
                    }else{
                        echo $id."号创意园房源删除失败。";
                    }
                    $deleteArr['price']=$model->cr_dayrentprice;
                    $dmodel=new Deletebase();
                    $dmodel->attributes=$deleteArr;
                    $dmodel->save();
                    $this->deleteResource($cyParkId, 4);
        }
    }
    protected function fullDelete($sourceType,$id,$msg){
        switch ($sourceType){
            case 4://创意园区
                $tmp = Creativesource::model()->findByPk($id);
                $type = "";
                if($tmp->cr_check==4){//取出第一个发现原来是发布状态，则要删除修改总发布数目
                    $type = "-";
                }
                $this->deleteCyPark($id);
                if(isset($tmp ->cr_userid)&&$tmp ->cr_userid){
                    $this->changeUserHouseNum(1,$sourceType,$type,$tmp->cr_userid);
                    $this->addMessage($tmp->cr_userid,$msg);
                }else{
                    echo "该房源无用户\n";
                }
               
                break;
        }
    }
    private function OnlyChangeStage($sourceType, $id,$msg){
        switch ($sourceType) {
            case 4://创意园
                $tmp = Creativesource::model()->findByPk($id);
                $type = "";
                if($tmp->cr_check==4){//取出第一个发现原来是发布状态，则要删除修改总发布数目
                    $type = "-";
                }
                $criteria=new CDbCriteria();
                $criteria->addCondition("cr_id=".$id);
                $num = Creativesource::model()->updateAll(array("cr_check"=>8),$criteria);
                if($num){
                    echo $id."号房源已下线。";
                }else{
                    echo $id."号房源下线失败。";
                }
                if(isset($tmp ->cr_userid)&&$tmp ->cr_userid){
                $this->changeUserHouseNum($num,$sourceType,$type,$tmp->cr_userid);
                $this->addMessage($tmp->cr_userid,$msg);
                }else{
                    echo "该房源无用户\n";
                }
                break;
        }
    }
    public function actionAdmin(){
        $model=new Creativesource('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Creativesource']))
			$model->attributes=$_GET['Creativesource'];
            $this->render('admin',array(
			'model'=>$model,
		));
	}
    public function actionView()
	{
        $model = $this->loadModel();
		$this->render('view',array(
			'model'=>$model
		));
	}
    public function loadModel(){
        if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Creativesource::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
}