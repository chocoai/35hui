<?php

class CommunitybaseinfoController extends Controller
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
        $titlePic = Picture::model()->findByPk($model->comy_titlepic);
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
		$model=new Communitybaseinfo;
		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Communitybaseinfo']))
		{
			$model->attributes=$_POST['Communitybaseinfo'];
            //设置默认省市
            $model->comy_province = 9;
            $model->comy_city = 35;
            $model->comy_inserttime = time();
            //计算轨道交通
            if(isset($_POST['Communitybaseinfo_comy_traffic'])){
                $comy_array = array();
                $comy_line = $_POST['Communitybaseinfo_comy_line'];
                $array_num = count($comy_line);
                for($i = 0; $i < $array_num; $i++) {
                    if(!in_array($comy_line[$i],$comy_array)){
                        $comy_array[]=$comy_line[$i];
                    }
                }
                $model->comy_line = ",".implode(",", $comy_array).",";
                $model->comy_traffic = ",".implode(",", $_POST['Communitybaseinfo_comy_traffic']).",";
            }
            //计算拼音缩写
            $pinyin = new Pinyin;
            $pinYinArray = $pinyin->doWord(trim($model->comy_name));
            $model->comy_pinyinshortname = $pinYinArray['short'];
            $model->comy_pinyinlongname = $pinYinArray['long'];
            
			if($model->save()){
				$this->redirect(array('view','id'=>$model->comy_id));
            }
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
        Yii::import('application.common.*');
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Communitybaseinfo']))
		{
			$model->attributes=$_POST['Communitybaseinfo'];
            if(isset($_POST['Communitybaseinfo_comy_traffic'])){
                $comy_array = array();
                $comy_line = $_POST['Communitybaseinfo_comy_line'];
                $array_num = count($comy_line);
                for($i = 0; $i < $array_num; $i++) {
                    if(!in_array($comy_line[$i],$comy_array)){
                        $comy_array[]=$comy_line[$i];
                    }
                }
                $model->comy_line = ",".implode(",", $comy_array).",";
                $model->comy_traffic = ",".implode(",", $_POST['Communitybaseinfo_comy_traffic']).",";
            }else{
                $model->comy_traffic = "0";
            }
            //计算拼音缩写
            $pinyin = new Pinyin;
            $pinYinArray = $pinyin->doWord(trim($model->comy_name));
            $model->comy_pinyinshortname = $pinYinArray['short'];
            $model->comy_pinyinlongname = $pinYinArray['long'];
            
			if($model->save()){
                $this->redirect(array('view','id'=>$model->comy_id));
            }
		}
		$this->render('update',array(
			'model'=>$model,
		));
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
            $sysId = $model->comy_id;
            $model->delete();

              //小区评论
            $CommunitycommentModel = Communitycomment::model()->findAllByAttributes(array("comyc_comyid"=>$sysId));
            if($CommunitycommentModel){
                foreach($CommunitycommentModel as $value){
                    $value->delete();
                }
            }
            //小区印象
            $ImpressionModel = Impression::model()->findAllByAttributes(array("im_sourceid"=>$sysId,"im_sourcetype"=>Impression::communitybaseinfo));
            if($ImpressionModel){
                foreach($ImpressionModel as $value){
                    $value->delete();
                }
            }

             //小区评分
            $RatingModel = Communityrating::model()->findAllByAttributes(array("cr_comyid"=>$sysId));
            if($RatingModel){
                foreach($RatingModel as $value){
                    $value->delete();
                }
            }

            //图片
            $pictureModel = Picture::model()->findAllByAttributes(array("p_sourceid"=>$sysId,"p_sourcetype"=>Picture::$sourceType['communitybaseinfo']));//写字楼图片
            if($pictureModel){
                foreach($pictureModel as $value){
                    Picture::model()->deleteFile(PIC_PATH.$value['p_img'], Communitybaseinfo::$pictureNorm);
                    $value->delete();
                }
            }
            //全景
            $panoramaModel = Panorama::model()->findAllByAttributes(array("p_buildingid"=>$sysId, "p_ptype"=>2));//客服上传的小区全景
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
	public function actionDeleteComment()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadCommentModel()->delete();
                        echo "<script type='text/javascript'>location.href=document.referrer;</script>";
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	public function actionDeleteRating()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model = $this->loadRatingModel();
            $comyModel=Communitybaseinfo::model()->findbyPk($model->cr_comyid);
            $comyModel->comy_score = $comyModel->comy_score - $model->cr_score;
            $comyModel->comy_ratingnum = $comyModel->comy_ratingnum - 1;
            $comyModel->update();
            $model->delete();
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
	public function loadCommentModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Communitycomment::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
	public function loadRatingModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Communityrating::model()->findbyPk($_GET['id']);
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
        if(isset($_POST['comy_name'])){
            $name = trim($_POST['comy_name']);
            if($name){
                $criteria->addSearchCondition("comy_name",$name);
            }
            
        }
        $criteria->order = 'comy_id desc';
		$dataProvider=new CActiveDataProvider('Communitybaseinfo',array(
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
                'condition'=>'im_sourcetype=3',
                'order'=>'im_id desc',
                'im_sourceid'=>$_GET['id']
            ),
        ));
		$this->render('impression',array(
			'dataProvider'=>$dataProvider,
                        'id'=>$_GET['id']
		));
	}
	public function actionComment()
	{
		$dataProvider=new CActiveDataProvider('Communitycomment',array(
            'criteria'=>array(
                'order'=>'comyc_id desc',
                'comyc_comyid'=>$_GET['id']
            ),
        ));
		$this->render('comment',array(
			'dataProvider'=>$dataProvider,
                        'id'=>$_GET['id']
		));
	}
	public function actionRating()
	{
		$dataProvider=new CActiveDataProvider('Communityrating',array(
            'criteria'=>array(
                'order'=>'cr_id desc',
                'cr_comyid'=>$_GET['id']
            ),
        ));
		$this->render('rating',array(
			'dataProvider'=>$dataProvider,
                        'id'=>$_GET['id']
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
       $criteria = new CDbCriteria();
       $show = array();
        if(isset($_POST["comy_id"])&&$_POST["comy_id"]!=""){
            $criteria->addColumnCondition(array("comy_id"=>$_POST["comy_id"]));
            $show['comy_id'] = $_POST["comy_id"];
        }
        if(isset($_POST["comy_name"])&&$_POST["comy_name"]!=""){
            $criteria->addSearchCondition("comy_name",$_POST["comy_name"]);
            $show['comy_name'] = $_POST["comy_name"];
        }
       if(isset($_POST["comy_city"])&&$_POST["comy_city"]!=""){
            $criteria->addColumnCondition(array("comy_city"=>$_POST["comy_city"]));
            $show['comy_city'] = $_POST["comy_city"];
        }
        if(isset($_POST["comy_district"])&&$_POST["comy_district"]!=""){
            $criteria->addColumnCondition(array("comy_district"=>$_POST["comy_district"]));
            $show['comy_district'] = $_POST["comy_district"];
        }
        if(isset($_POST["comy_section"])&&$_POST["comy_section"]!=""){
           $criteria->addColumnCondition(array("comy_section"=>$_POST["comy_section"]));
            $show['comy_section'] = $_POST["comy_section"];
        }
        $dataProvider=new CActiveDataProvider('Communitybaseinfo',array(
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
				$this->_model=Communitybaseinfo::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='communitybaseinfo-form')
		{
            $className = get_class($model);
            $validateResult = json_decode(CActiveForm::validate($model),true);
            echo json_encode($validateResult);
			Yii::app()->end();
		}
	}
}

