<?php
Yii::import('application.common.*');
require_once('image.php');
class AdvertisementController extends Controller
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
        $va = va();
        $va->check(array(
            'position'=>array('not_blank',array('uint_length', 1, count(Advertisement::$advertiseConfig)))
        ));
        if($va->success){
            $model = Advertisement::model()->findByAttributes(array('ad_position'=>$va->valid['position']));
            if($model){
                $this->render('view',array(
                    'model'=>$model,
                ));
            }else{
                Yii::app()->user->setFlash('viewAd','该广告栏尚未添加广告图片');
                $this->redirect(array('advertisement/index'));
            }
        }else{
            throw new CHttpException(400,'非法的请求. 请不要再访问这个链接.');
        }
	}
    /**
     * 删除旧的广告
     * @param <int> $position 广告栏位置
     * @return <boolean>
     */
    public function deleteOldAd($position){
        $dba = dba();
        $oldAds = $dba->select("select * from `35_advertisement` where `ad_position`=?",$position);
        if($oldAds){
            foreach ($oldAds as $oldAd){
                $oldFile = $oldAd['ad_picurl'];
                @unlink(PIC_PATH.$oldFile);
            }
            $effectRows = $dba->execute("delete from `35_advertisement` where `ad_position`=?",$position);
            if($effectRows>0){
                return true;
            }
        }else{
            return true;
        }
    }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $va = va();
        $va->check(array(
            'position'=>array('not_blank',array('uint_length', 1, count(Advertisement::$advertiseConfig)))
        ));
        if($va->success){
            $model=new Advertisement;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            if(isset($_POST['Advertisement']))
            {
                $dba = dba();
                $model->attributes=$_POST['Advertisement'];
                $imageForm=CUploadedFile::getInstance($model, 'ad_picurl');
                $model->ad_id = $dba->id('35_advertisement');
                $model->ad_position = $va->valid['position'];
                $model->ad_linkurl = urlencode($model->ad_linkurl);
                $model->ad_uploadtime = time();
                if($model->validate()){
                    if($imageForm){//代表上传的有新图片文件
                        $picTypePath = "/advertisement/";//文件夹路径
                        $model->ad_picurl = Picture::model()->imageName($imageForm->name,$picTypePath);//得到最新生成的图片名称
                        $boolUploadFile = $imageForm->saveAs(PIC_PATH.$model->ad_picurl);//上传图片
                        if($boolUploadFile){
                            $imageDeal = new Image();
                            $captureConfig = Advertisement::$advertiseConfig[$va->valid['position']];
                            $result = $imageDeal->capture(PIC_PATH.$model->ad_picurl,null,array('width'=>$captureConfig['width'],'height'=>$captureConfig['height']),true);//不生成新文件
                            //删除旧文件
                            $this->deleteOldAd($va->valid['position']);
                            if($model->save()){
                                $this->redirect(array('advertisement/view','position'=>$va->valid['position']));
                            }
                        }else{
                            $model->addError("ad_picurl", "图片上传失败");
                        }
                    }
                }
            }
            $this->render('create',array(
                'model'=>$model,
                'adConfig'=>Advertisement::$advertiseConfig[$va->valid['position']]
            ));
        }else{
            throw new CHttpException(400,'非法的请求. 请不要再访问这个链接.');
        }
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
        $va = va();
        $va->check(array(
            'position'=>array('not_blank',array('uint_length', 1, count(Advertisement::$advertiseConfig)))
        ));
        if($va->success){
            $model = Advertisement::model()->findByAttributes(array('ad_position'=>$va->valid['position']));
            $oldFile = $model->ad_picurl;//旧图片文件
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['Advertisement']))
            {
                $model->attributes=$_POST['Advertisement'];
                $model->ad_linkurl = urlencode($model->ad_linkurl);
                $imageForm=CUploadedFile::getInstance($model, 'ad_picurl');
                if($model->validate()){
                    if($imageForm){//代表上传的有新图片文件
                        $picTypePath = "/advertisement/";//文件夹路径
                        $model->ad_picurl = Picture::model()->imageName($imageForm->name,$picTypePath);//得到最新生成的图片名称
                        $model->ad_uploadtime = time();
                        $boolUploadFile = $imageForm->saveAs(PIC_PATH.$model->ad_picurl);//上传图片
                        if($boolUploadFile){
                            //删除旧文件
                            @unlink(PIC_PATH.$oldFile);
                            $imageDeal = new Image();
                            $captureConfig = Advertisement::$advertiseConfig[$va->valid['position']];
                            $result = $imageDeal->capture(PIC_PATH.$model->ad_picurl,null,array('width'=>$captureConfig['width'],'height'=>$captureConfig['height']),true);//不生成新文件
                            if($model->save()){
                                $this->redirect(array('advertisement/view','position'=>$va->valid['position']));
                            }
                        }else{
                            $model->addError("ad_picurl", "图片上传失败");
                        }
                    }else{
                        $model->ad_picurl = $oldFile;
                        if($model->save()){
                            $this->redirect(array('advertisement/view','position'=>$va->valid['position']));
                        }
                    }
                }
            }
            $this->render('update',array(
                'model'=>$model,
                'adConfig'=>Advertisement::$advertiseConfig[$va->valid['position']]
            ));
        }else{
            throw new CHttpException(400,'非法的请求. 请不要再访问这个链接.');
        }
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
            $this->deleteOldAd($model->ad_position);
			$model->delete();

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
        $dba = dba();
        $positionArray = $dba->select_col("SELECT `ad_position` FROM 35_advertisement GROUP BY `ad_position`");
		$this->render('index',array(
            'positionArray'=>$positionArray
        ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Advertisement('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Advertisement'])){
			$model->attributes=$_GET['Advertisement'];
        }
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
				$this->_model=Advertisement::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='advertisement-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
