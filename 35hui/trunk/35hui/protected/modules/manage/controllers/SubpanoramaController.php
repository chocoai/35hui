<?php

class SubpanoramaController extends Controller
{

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

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
			array('allow',
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    public function actionView(){
        $this->layout = "frame";
        $model = $this->loadModel();
        if($model->spn_panoramaurl){
            $this->render('view',array(
                'model'=>$model,
            ));
        }
    }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $onePanoramaPic = 4;//一份全景图片数。
        if(isset($_POST['panoramapic'])&&count($_POST['panoramapic'])>0&&count($_POST['panoramapic'])%$onePanoramaPic==0){
            //先把所有图片后面的缩略图标记去除
            $panoramapic = array();
            foreach($_POST['panoramapic'] as $value){
                $tmp = str_replace(Subpanorama::$standard[1]['suffix'], "", $value);
                $panoramapic[] = str_replace(PIC_URL, "", $tmp);
            }
            //可以保存
            $subPanoramaNum = intval(count($panoramapic)/$onePanoramaPic);//要保存的全景份数
            for($i=0;$i<$subPanoramaNum;$i++){
                $spn_fisheyephoto = array_slice($panoramapic, $i*4, $onePanoramaPic);//每一份全景中的图片
                $model = new Subpanorama();
                $model->spn_fisheyephoto = serialize($spn_fisheyephoto);
                $model->spn_sourceid = $_POST['sourceid'];
                $model->spn_sourcetype = $_POST['type'];
                isset($_POST['panoramaname'][$i])?$model->spn_panoramaname = trim($_POST['panoramaname'][$i]):"";
                $model->spn_releasetime = time();
                $model->save();
                header("Location:".$_SERVER['HTTP_REFERER']);
            }
        }else{
            echo "error";
        }
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();
        $sourceUserId = Subpanorama::model()->getSourceUserId($model->spn_id);//全景所属userid
        $userId = Yii::app()->user->id;
        if($userId!=$sourceUserId){
            echo "参数错误，修改失败";
            exit;
        }
        $model->spn_panoramaname = $_GET['name'];
        $model->update();
        echo "修改成功!";
        exit;
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		$model=$this->loadModel();
        $sourceUserId = Subpanorama::model()->getSourceUserId($model->spn_id);//全景所属userid
        $userId = Yii::app()->user->id;
        if($userId!=$sourceUserId){
            echo "参数错误，删除失败";
            exit;
        }
        //删除上传的鱼眼图片和缩略图
        $fisheyephoto = $model->spn_fisheyephoto;
        $fisheyephotoArr = unserialize($fisheyephoto);
        if($fisheyephotoArr){
            foreach($fisheyephotoArr as $value){
                Picture::model()->deleteFile(PIC_PATH.$value, Subpanorama::$standard);//删除文件
            }
        }
        //删除上传的全景图片
        if($model->spn_panoramaurl){
            common::deldir(PIC_PATH.$model->spn_panoramaurl);
        }
        
        $sourceId = $model->spn_sourceid;
        $sourceType = $model->spn_sourcetype;
        $model->delete();
        //判断如果房源没有了其他全景，那就要改变全景状态
        if(!Subpanorama::model()->updateSourceTag($sourceId, $sourceType)){
            echo "参数错误，删除失败";
            exit;
        }
        echo "success";
        exit;
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$usrid = Yii::app()->user->id;

        $type = $_GET['type'];
        if($type==1){
            if(!Officebaseinfo::model()->checkOfficeIdIsCurrentUser(array($_GET['id']))){
                $this->redirect(array('main/error'));
            }
        }elseif($type==2){
            if(!Shopbaseinfo::model()->checkShopIdIsCurrentUser(array($_GET['id']))){
                $this->redirect(array('main/error'));
            }
        }elseif($type == 4){
            if(!Residencebaseinfo::model()->checkResidenceIdIsCurrentUser(array($_GET['id']))){
                $this->redirect(array('main/error'));
            }
        }elseif($type == Subpanorama::cypark){
            if(!Creativesource::model()->checkIdIsCurrentUser(array($_GET['id']))){
                $this->redirect(array('main/error'));
            }
        }else{
            $this->redirect(array('main/error'));
        }
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("spn_sourcetype"=>$type,"spn_sourceid"=>$_GET['id']));
        $subPanorama = Subpanorama::model()->findAll($criteria);

        //计算保存鱼眼图片文件夹。如果此房源已经上传过全景图片，则只后的全景图片都放在此文件夹下。
        $dir = time().rand(0000,9999);
        if($subPanorama){
            $fisheyephoto = $subPanorama[0]["spn_fisheyephoto"];
            $fisheyephotoArr = unserialize($fisheyephoto);
            if($fisheyephotoArr){
                $url = $fisheyephotoArr[0];
                $urlArr = explode("/", $url);
                isset($urlArr[2])?$dir=$urlArr[2]:"";
            }
        }
		$this->render('index',array(
			'subPanorama'=>$subPanorama,
            'menu'=>'',
            'id'=>$_GET['id'],
            'type'=>$type,
            "dir"=>$dir,
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
				$this->_model=Subpanorama::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='subpanorama-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
