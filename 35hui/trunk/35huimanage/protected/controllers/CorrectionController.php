<?php

class CorrectionController extends Controller
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
        $correction = unserialize($model->ct_content);
        if($model->ct_sourcetype==1){//楼盘
            $oldSource = Systembuildinginfo::model()->findByPk($model->ct_sourceId);
            if($oldSource){
				foreach($correction as $k=>$v){
					if($k == "sbi_district"||$k == "sbi_section"){
						$correction[$k] = Region::model()->getNameById($v);
					}
					if($k == "sbi_openingtime"){
						$correction[$k] = @date("Y-m-d H:i",$v);
					}
				}
				foreach($oldSource as $k=>$v){
					if($k == "sbi_district"||$k == "sbi_section"){
						$oldSource[$k] = Region::model()->getNameById($v);
					}
					if($k == "sbi_openingtime"){
						$oldSource[$k] = date("Y-m-d H:i",$v);
					}
				}
			}
        }else if($model->ct_sourcetype==2){//小区
            $oldSource = Communitybaseinfo::model()->findByPk($model->ct_sourceId);
			if($oldSource){
				foreach($correction as $k=>$v){
					if($k == "comy_district"||$k == "comy_section"){
						$correction[$k] = Region::model()->getNameById($v);
					}
					if($k=="comy_propertytype"){
						$correction[$k] = @Communitybaseinfo::$propertyType[$v];
					}
					if($k == "comy_buildingera"){
						$correction[$k] = @date("Y-m-d H:i",$v);
					}
				}
				foreach($oldSource as $k=>$v){
					if($k == "comy_district"||$k == "comy_section"){
						$oldSource[$k] = Region::model()->getNameById($v);
					}
					if($k=="comy_propertytype"){
						$oldSource[$k] = @Communitybaseinfo::$propertyType[$v];
					}
					if($k == "comy_buildingera"){
						$oldSource[$k] = date("Y-m-d H:i",$v);
					}
				}
			}
        }else if($model->ct_sourcetype==3){//创意园
            $oldSource = Creativeparkbaseinfo::model()->findByPk($model->ct_sourceId);
			if($oldSource){
				foreach($correction as $k=>$v){
					if($k == "cp_district"){
						$correction[$k] = Region::model()->getNameById($v);
					}
					if($k == "cp_openingtime"){
						$correction[$k] = @date("Y-m-d H:i",$v);
					}
				}
				foreach($oldSource as $k=>$v){
					if($k == "cp_district"){
						$oldSource[$k] = Region::model()->getNameById($v);
					}
					if($k == "cp_openingtime"){
						$oldSource[$k] = date("Y-m-d H:i",$v);
					}
				}
			}
        }
		$this->render('view',array(
			'model'=>$model,
            "oldSource"=>$oldSource,
            "correction"=>$correction,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAudit()
	{
		$model=$this->loadModel();
        if($model->ct_status!=0){
            throw new CHttpException(404,'The requested page does not exist.');
        }
        //开始审核操作
        $correction = unserialize($model->ct_content);
        $saveArray = array();//保存了最终要保存采用的值
        foreach($_POST as $key=>$value){
            if($key!="picture"&&$value==1){//选择了采用
                $saveArray[$key] = $correction[$key];
            }
        }
        $pictures = array();//保存了要采用的图片
        if(isset($_POST["picture"])&&!empty ($_POST["picture"])){//采用了图片
            foreach($_POST["picture"] as $key=>$value){
                if($value){//选择了采用
                    $tmp = explode("_", $value);
                    $pictures[] = $tmp;
                }
            }
        }
        //如果有图片，先保存图片
        $picNum = 0;
        if($pictures){
            $sourceType=1;
            if($model->ct_sourcetype==2){
                $sourceType=7;
            }else if($model->ct_sourcetype==3){
                $sourceType=9;
            }
            $picNum = Correction::model()->insertPic($pictures, $sourceType, $model->ct_sourceId);
        }
        $otherNum = 0;//其他的那些信息采用的条数
        if(count($saveArray)>0){//有被采用的
            if($model->ct_sourcetype==1){//楼盘
                $oldSource = Systembuildinginfo::model()->findByPk($model->ct_sourceId);
            }elseif($model->ct_sourcetype==2){//小区
                $oldSource = Communitybaseinfo::model()->findByPk($model->ct_sourceId);
            }elseif($model->ct_sourcetype==3){//创意园
                $oldSource = Creativeparkbaseinfo::model()->findByPk($model->ct_sourceId);
            }

            $oldSource->setAttributes($saveArray,false);
            if($oldSource->update()){
                $otherNum = count($saveArray);
            }else{
                print_r($oldSource->errors);exit;
            }
        }
        //数据保存成功，接下来呀修改纠错表中的值
        $allChangeNum = $picNum+$otherNum;//所有改变的条数
        if($allChangeNum>0){//有采用的
            //奖励商务币和积分
            $baseInfo = Oprationconfig::model()->getConfigByName("correction_give");
            $point = $allChangeNum*$baseInfo[0];
            Userproperty::model()->addPoint($model->ct_userid, $point, "纠错信息被采用，奖励{:point}积分！");
            //改变本表数据
            $model->ct_status = 1;
            $model->ct_message = "您本次提交的纠错信息采用了".$allChangeNum."条。奖励".$point."积分！";
            Yii::app()->user->setFlash('message','成功采用'.$allChangeNum."条！奖励了".$point."积分！");
        }else{//没有采用的
            $model->ct_status = 2;
            $model->ct_message = "由于您输入的纠错信息有误，您本次提交的纠错信息未被采用。感谢您的支持！";
            Yii::app()->user->setFlash('message','没有采用任何信息！');
        }
        $model->update();
        $this->redirect(array("view","id"=>$_GET["id"]));
	}


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("ct_status"=>0));
        $criteria->order = "ct_releasetime desc";
		$dataProvider=new CActiveDataProvider('Correction',array(
            'criteria'=>$criteria,
        ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
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
				$this->_model=Correction::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}


}