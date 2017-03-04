<?php

class ApplyhighsourceController extends Controller
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
                        'actions'=>array("index","choosesource","setsource","unsetsource"),
                        'roles'=>array(
                                Yii::app()->params['agent'],
                                Yii::app()->params['company'],
                                Yii::app()->params['personal'],
                        ),
                ),
                array('deny',  // deny all users
                        'users'=>array('*'),
                ),
        );
	}
    /**
     * 优质房源
     */
    public function actionIndex(){
        $userId = Yii::app()->user->id;

        $type = "";
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("ahs_userid"=>$userId));
        if(isset($_GET["type"])&&$_GET["type"]!=""&&($_GET["type"]==1||$_GET["type"]==2||$_GET["type"]==3)){
            $type=$_GET["type"];
            $criteria->addColumnCondition(array("ahs_type"=>$type));
        }
        $criteria->order="ahs_releasetime desc";
        $allInfo = Applyhighsource::model()->findAll($criteria);
        $numInfo = Applyhighsource::model()->cuontNum($userId);
        $maxNum = Applyhighsource::model()->getMaxHighSourceNum($userId);
        $this->render("index",array(
            "allInfo"=>$allInfo,
            "type"=>$type,
            "numInfo"=>$numInfo,
            "maxNum"=>$maxNum,
        ));
    }
    public function actionChooseSource(){
        $this->layout = "frame";
        $userId = Yii::app()->user->id;
        $type = @$_GET["type"];

        //去除已经选择过的
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("ahs_userid"=>$userId, "ahs_type"=>$type));
        $allInfo = Applyhighsource::model()->findAll($criteria);
        $nutInArray = array();
        foreach ($allInfo as $value){
            $nutInArray[] = $value["ahs_sourceid"];
        }
        //得到用户发布的所有房源
        $show = array();
        if($type==1){//写字楼
            $typeName = "office";
            $criteria=new CDbCriteria();
            $criteria->with = array("offictag","presentInfo");
            $criteria->addColumnCondition(array(
                "ob_uid"=>$userId,
                "ot_check"=>4,
                "ot_ishigh"=>0,
            ));
            if(isset($_POST['name'])&&$_POST['name']!="") {
                $criteria->addSearchCondition("ob_officename",$_POST['name']);
                $show['name'] = $_POST['name'];
            }
            if(isset($_POST['title'])&&$_POST['title']!="") {
                $criteria->addSearchCondition("op_officetitle",$_POST['title']);
                $show['title'] = $_POST['title'];
            }
            $className = "Officebaseinfo";
            $criteria->addNotInCondition("ob_officeid",$nutInArray);
        }else if($type==2){//商铺
            $typeName = "shop";
            $criteria=new CDbCriteria();
            $criteria->with = array("shopTag","presentInfo");
            $criteria->addColumnCondition(array(
                "sb_uid"=>$userId,
                "st_check"=>4,
                "st_ishigh"=>0,
            ));
            if(isset($_POST['title'])&&$_POST['title']!="") {
                $criteria->addSearchCondition("sp_shoptitle",$_POST['title']);
                $show['title'] = $_POST['title'];
            }
            $className = "Shopbaseinfo";
            $criteria->addNotInCondition("sb_shopid",$nutInArray);
        }else if($type==3){//住宅
            $typeName = "residence";
            $criteria=new CDbCriteria();
            $criteria->with = array("residenceTag","community");
            $criteria->addColumnCondition(array(
                "rbi_uid"=>$userId,
                "rt_check"=>4,
                "rt_ishigh"=>0,
            ));
            if(isset($_POST['title'])&&$_POST['title']!="") {
                $criteria->addSearchCondition("rbi_title",$_POST['title']);
                $show['title'] = $_POST['title'];
            }
            $className = "Residencebaseinfo";
            $criteria->addNotInCondition("rbi_id",$nutInArray);
        }else{
            throw new CHttpException(404,'The requested page does not exist.');
        }
        $dataProvider=new CActiveDataProvider($className, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>15,
            ),
        ));
        $this->render('choosesource',array(
            'dataProvider'=>$dataProvider,
            'type'=>$type,
            "typeName"=>$typeName,
        ));
    }

    public function actionSetSource()
	{
        $sourceid =$_GET['sourceid'];
        $type =$_GET['type'];
        $userId = Yii::app()->user->id;
        //先验证是否达到了最大值
        if(!Applyhighsource::model()->validateApplyAuthority($userId, $type)){
            echo "您已经达到了申请优质的最大值！";
            exit;
        }
        //验证在本表中是否有数据了。没有数据才能继续添加
        if($type==1||$type==2||$type==3){
            $count = Applyhighsource::model()->count("ahs_type=".$type." and ahs_sourceid=".$sourceid);
            if($count!=0){
                echo "输入错误，设置失败！";
                exit;
            }
        }else{
            echo "输入错误，设置失败！";
            exit;
        }

        $model = new Applyhighsource();
        $model->ahs_sourceid = $sourceid;
        $model->ahs_type = $type;
        $model->ahs_status = 0;
        $model->ahs_releasetime = time();
        $model->ahs_userid = $userId;

        switch ($type){
            default:
                break;
            case 1: //写字楼
                $officeModel = Officebaseinfo::model()->findByPk($sourceid);
                if($officeModel&&$officeModel->ob_uid==$userId){//新数据也是可用的数据
                    $model->save();
                    echo "success";exit;
                }
                break;
            case 2: //商铺
                $shopModel = Shopbaseinfo::model()->findByPk($sourceid);
                if($shopModel&&$shopModel->sb_uid==$userId){//新数据也是可用的数据
                    $model->save();
                    echo "success";exit;
                }
                break;
            case 3: //住宅
                $residenceModel = Residencebaseinfo::model()->findByPk($sourceid);
                if($residenceModel&&$residenceModel->rbi_uid==$userId){//新数据也是可用的数据
                    $model->save();
                    echo "success";exit;
                }
                break;
        }
        echo "内部错误，设置失败";//修改失败
        exit;
	}
    public function actionUnSetSource(){
        $id = @$_GET["id"];
        $userId = Yii::app()->user->id;
        $model = Applyhighsource::model()->findByPk($id);
        if($model&&$model->ahs_userid==$userId){
            //先改变房源优质状态
            if($model->ahs_status==1){//只有是优质时
                switch ($model->ahs_type){
                    default:
                        break;
                    case 1://写字楼
                        if($base=Officebaseinfo::model()->findByPk($model->ahs_sourceid) ){
                            $base->ob_order-=common::getOrderConfig('high');
                            $base->update();
                        }
                        $sourceModel = Officetag::model()->findByAttributes(array("ot_officeid"=>$model->ahs_sourceid));
                        $sourceModel->ot_ishigh = 0;
                        $sourceModel->update();
                        break;
                    case 2://商铺
                        if($base=Shopbaseinfo::model()->findByPk($model->ahs_sourceid) ){
                            $base->sb_order-=common::getOrderConfig('high');
                            $base->update();
                        }
                        $sourceModel = Shoptag::model()->findByAttributes(array("st_shopid"=>$model->ahs_sourceid));
                        $sourceModel->st_ishigh = 0;
                        $sourceModel->update();
                        break;
                    case 3://住宅
                        if($base=Residencebaseinfo::model()->findByPk($model->ahs_sourceid) ){
                            $base->rbi_order+=common::getOrderConfig('high');
                            $base->update();
                        }
                        $sourceModel = Residencetag::model()->findByAttributes(array("rt_rbiid"=>$model->ahs_sourceid));
                        $sourceModel->rt_ishigh = 0;
                        $sourceModel->update();
                        break;
                }
            }
            
            //删除此表信息
            $model->delete();
            echo "success";exit;
        }
        echo "您没有权限对此房源进行操作！";exit;
    }
}
