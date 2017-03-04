<?php

class ResidencebaseinfoController extends Controller
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
        //如果不是已阅的，要更改阅读状态
        if(!$model->tag->rt_read){
            $tagModel = Residencetag::model()->findByAttributes(array("rt_rbiid"=>$model->rbi_id));
            $tagModel->rt_read = 1;
            $tagModel->update();
        }
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Residencebaseinfo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Residencebaseinfo']))
		{
			$model->attributes=$_POST['Residencebaseinfo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->rbi_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['Residencebaseinfo']))
		{
			$model->attributes=$_POST['Residencebaseinfo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->rbi_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
    /**
     * 审核，审核未通过要返回商务币
     */
    public function actionAudit(){
        $officeid = $_POST['rbi_id'];
        $point = $_POST['point'];
        $rbi_order = isset($_POST['rbi_order'])?(int)$_POST['rbi_order']:0;
        $model = Residencebaseinfo::model()->findByPk($officeid);
        if(!$model->tag->rt_ishigh){//只处理现在不是优质的房源
            $tagModel = Residencetag::model()->findByAttributes(array("rt_rbiid"=>$officeid));
            $tagModel->rt_ishigh = 1;//设优
            $tagModel->update();
            $model->rbi_order += $rbi_order;
            $model->update();
            //赠送积分和商务币
            $description = "住宅房源".$officeid."审核为优质房源，系统赠送{:money}商务币";
            Userproperty::model()->addMoney($model->rbi_uid, $point, $description);

            $description = "住宅房源".$officeid."审核为优质房源，系统赠送{:point}积分";
            Userproperty::model()->addPoint($model->rbi_uid, $point, $description);
        }
        $this->redirect(array("view","id"=>$officeid));
    }
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model = $this->loadModel();
            $rbi_id = $model->rbi_id;
            $model->delete();
            if($model->rbi_rentorsell==1){//出租
                Residencerentinfo::model()->findByAttributes(array("rr_rbiid"=>$rbi_id))->delete();
            }else{//出售
                Residencesellinfo::model()->findByAttributes(array("rs_rbiid"=>$rbi_id))->delete();
            }
            Residencetag::model()->findByAttributes(array("rt_rbiid"=>$rbi_id))->delete();
            //下面的需要包括文件一起删除
            $pictureModel = Picture::model()->findAllByAttributes(array("p_sourceid"=>$rbi_id,"p_sourcetype"=>Picture::$sourceType['residencebaseinfo']));//住宅图片
            if($pictureModel){
                foreach($pictureModel as $value){
                    Picture::model()->deleteFile(PIC_PATH.$value['p_img'], Officebaseinfo::$officePictureNorm);
                    $value->delete();
                }
            }

            $subpanoramaModel = Subpanorama::model()->findAllByAttributes(array("spn_sourceid"=>$rbi_id,"spn_sourcetype"=>Subpanorama::residence));//客服为用户制作的全景
            if($subpanoramaModel){
                foreach($subpanoramaModel as $value){
                    Subpanorama::model()->deleteOnePanoramaById($value['spn_id']);
                }
            }
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
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
        $criteria = new CDbCriteria;
        $criteria->order = "rbi_id desc";
		$dataProvider=new CActiveDataProvider('Residencebaseinfo',array(
            'criteria'=>$criteria,
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
            "with"=>array("tag")
        ));
        $show = array();

        if(isset($_POST["rbi_title"]) && $_POST["rbi_title"]!=""){
            $criteria->addSearchCondition("rbi_title",$_POST["rbi_title"]);
            $show['rbi_title'] = $_POST["rbi_title"];
        }
        if(isset($_POST["rt_check"])&&$_POST["rt_check"]!=""){
            $criteria->addColumnCondition(array("rt_check"=>$_POST["rt_check"]));
            $show['rt_check'] = $_POST["rt_check"];
        }

        if(isset($_POST["rbi_id"])&&$_POST["rbi_id"]!=""){
            $criteria->addColumnCondition(array("rbi_id"=>$_POST["rbi_id"]));
            $show['rbi_id'] = $_POST["rbi_id"];
        }
        if(isset($_POST["rt_read"])&&$_POST["rt_read"]!=""){
            $criteria->addColumnCondition(array("rt_read"=>$_POST["rt_read"]));
            $show['rt_read'] = $_POST["rt_read"];
        }
        $criteria->order = "rbi_id desc";
        $dataProvider=new CActiveDataProvider('Residencebaseinfo',array(
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
				$this->_model=Residencebaseinfo::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='residencebaseinfo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
