<?php
Yii::import('application.common.*');
require_once('image.php');
class CorrectionController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                        'users'=>array('@'),
                ),
                array('deny',  // deny all users
                        'users'=>array('*'),
                ),
        );
	}
    public function actionIndex(){
        $userId = Yii::app()->user->id;
        $districtlist = Region::model()->findAllByAttributes(array('re_parent_id'=>35));
        
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("ct_userid"=>$userId));
        $criteria->order = "ct_releasetime desc";
        $dataProvider = new CActiveDataProvider("Correction", array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>20,
            ),
		));
        //接收可能存在的url参数
        $type=1;
        if(isset($_GET["type"])&&in_array($_GET['type'],array(1,3,5))){
            $type=$_GET['type'];
        }
        $name = "";
        if(isset($_GET["id"])){
            $name = Correction::model()->getName($_GET["id"], $type);
        }
        $this->render("index",array(
            "districtlist"=>$districtlist,
            "dataProvider"=>$dataProvider,
            "name"=>$name,
            "type"=>$type,
        ));
    }
    public function actionValidateBuildName(){
        $sourcetype = $_POST["sourcetype"];
        $kwords = trim($_POST["kwords"]);
        if($kwords==""){
            echo "error_@_请输入名称！";exit;
        }
        if($sourcetype!=1&&$sourcetype!=3&&$sourcetype!=5){
            echo "error_@_输入错误！";exit;
        }
        $criteria=new CDbCriteria;
        switch($sourcetype){
            case 1://楼盘
                $criteria->select = "sbi_peripheral,sbi_traffic,sbi_floorarea,sbi_floor,sbi_buildingintroduce,sbi_floorinfo,sbi_buildingid,sbi_district,sbi_section,sbi_busway,sbi_address,sbi_avgrentprice,sbi_avgsellprice,sbi_developer,sbi_propertyprice,sbi_propertytel,sbi_propertyname,sbi_openingtime";
                $criteria->addColumnCondition(array("sbi_buildingname"=>$kwords));
                $model = Systembuildinginfo::model()->find($criteria);
                if($model){
                    $model->sbi_openingtime = date("Y-m-d",$model->sbi_openingtime);
                    $model->sbi_floorinfo =unserialize($model->sbi_floorinfo);
                    $model->sbi_traffic  =unserialize($model->sbi_traffic);
                    $model->sbi_peripheral  =unserialize($model->sbi_peripheral);
                    $return = json_encode($model->getAttributes());
                    echo "success_@_".$return;exit;
                }
                break;
            case 3://小区
                $criteria->select = "comy_id,comy_address,comy_district,comy_section,comy_propertytype,comy_developer,comy_propertyprice,comy_buildingarea,comy_cubagerate,comy_afforestation,comy_buildingera";
                $criteria->addColumnCondition(array("comy_name"=>$kwords));
                $model = Communitybaseinfo::model()->find($criteria);
                if($model){
                    $model->comy_buildingera = date("Y-m-d",$model->comy_buildingera);
                    $return = json_encode($model->getAttributes());
                    echo "success_@_".$return;exit;
                }
                break;
            case 5://创意园
                $criteria->select = "cp_id,cp_address,cp_district,cp_developer,cp_propertyname,cp_propertyprice,cp_avgrentprice,cp_traffic,cp_peripheral,cp_area,cp_floorheight,cp_introduce,cp_openingtime";
                $criteria->addColumnCondition(array("cp_name"=>$kwords));
                $model = Creativeparkbaseinfo::model()->find($criteria);
                if($model){
                    $model->cp_openingtime = date("Y-m-d",$model->cp_openingtime);
                    $model->cp_peripheral =unserialize($model->cp_peripheral);
                    $model->cp_traffic =unserialize($model->cp_traffic);
                    $return = json_encode($model->getAttributes());
                    echo "success_@_".$return;exit;
                }
                break;
        }
        echo "error_@_输入楼盘不存在！";
        exit;
    }
    /**
     * 新建纠错记录
     */
    public function actionCreate(){
        
        $content = array();
        if($_POST["sourcetype"]==1){//楼盘
            $model = Systembuildinginfo::model()->findByPk($_POST["buildingid"]);
            $sourceId = $_POST["buildingid"];
            if($model){//楼盘存在
                $_POST['sbi_openingtime'] = strtotime(@$_POST['sbi_openingtime']);
                if(isset($_POST['sbi_busway'])){
                    $_POST['sbi_busway'] = implode(",", $_POST['sbi_busway']);
                }
                if(isset($_POST['sbi_floorinfo'])){
                    $_POST['sbi_floorinfo'] = serialize($_POST['sbi_floorinfo']);
                }
                if(isset($_POST['sbi_traffic'])){
                    $_POST['sbi_traffic'] = serialize($_POST['sbi_traffic']);
                }
                if(isset($_POST['sbi_peripheral'])){
                    $_POST['sbi_peripheral'] = serialize( $_POST['sbi_peripheral']);
                }
                foreach($_POST as $key=>$value){
                    if(isset($model[$key])&&$model[$key]!=$_POST[$key]){
                        $content[$key] = $value;
                    }
                }
            }
        }elseif($_POST["sourcetype"]==2){//小区
            $model = Communitybaseinfo::model()->findByPk($_POST["xiaoquid"]);
            $sourceId = $_POST["xiaoquid"];
            if($model){//小区存在
                $_POST['comy_buildingera'] = strtotime(trim($_POST['comy_buildingera']));
                foreach($_POST as $key=>$value){
                    if(isset($model[$key])&&$model[$key]!=$_POST[$key]){
                        $content[$key] = trim($value);
                    }
                }
            }
        }elseif($_POST["sourcetype"]==3){//创意园
            $model = Creativeparkbaseinfo::model()->findByPk($_POST["creativeparkid"]);
            $sourceId = $_POST["creativeparkid"];
            if($model){//创意园存在
                $_POST['cp_openingtime'] = strtotime(@$_POST['cp_openingtime']);
                if(isset($_POST['cp_traffic'])){
                    $_POST['cp_traffic'] = serialize($_POST['cp_traffic']);
                }
                if(isset($_POST['cp_peripheral'])){
                    $_POST['cp_peripheral'] = serialize( $_POST['cp_peripheral']);
                }
                foreach($_POST as $key=>$value){
                    if(isset($model[$key])&&$model[$key]!=$_POST[$key]){
                        $content[$key] = trim($value);
                    }
                }
            }
        }
        if($_POST["picture"]!=""){
            $content["picture"] = $_POST["picture"];
        }
        //判断并保存数据
        if($content){
            $correction = new Correction();
            $correction->ct_content = serialize($content);
            $correction->ct_sourceId = $sourceId;
            $correction->ct_sourcetype = $_POST["sourcetype"];
            $correction->ct_status = 0;
            $correction->ct_userid = Yii::app()->user->id;
            $correction->ct_releasetime = time();
            $correction->save();
            Yii::app()->user->setFlash('showMessage','感谢您的大力支持，我们会尽快处理！');
        }else{
            Yii::app()->user->setFlash('showMessage','您没有对原房源做过任何的修改！');
        }
        
        $this->redirect(array("index"));
    }
    public function actionUploadPic(){
        $path = "/correction/";
        if (!empty($_FILES)&&$_FILES['Filedata']['size']<2097152){//最大2M
            $originfilename = $_FILES['Filedata']['name']; //文件名
            $fileext = strtolower(substr($originfilename,strrpos($originfilename,'.'))); //后缀名
            //验证文件格式是否正确
            $patn = "/jpg$|jpeg$|gif$|png$/i";
            if(preg_match($patn,$fileext)){
                $fileName = Picture::model()->imageName($originfilename,$path);//包含了路径的新的文件名称
                $targetFile =  PIC_PATH.$fileName;
                $tempFile = $_FILES['Filedata']['tmp_name'];
                move_uploaded_file($tempFile,$targetFile);

                //处理缩略图
                $imageDeal = new Image();
                $stand = array(
                    "1"=>array(
                        'suffix'=>'_small',
                        'width'=>'150',
                        'height'=>'100',
                    )
                );
                $imageDeal->formatWithPicture($targetFile,$stand);//处理缩略图
                echo '<script type="text/javascript">parent.uploadOnePicSuccess("'.$fileName.'")</script>';exit;
            }
        }
        echo '<script type="text/javascript">parent.uploadOnePicFalse()</script>';exit;
    }
}