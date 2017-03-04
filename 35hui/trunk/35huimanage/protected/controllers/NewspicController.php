<?php
Yii::import('application.common.*');
require_once('image.php');
class NewspicController extends Controller
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
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}
    public function actionAdvertisement(){
		$this->render('advertisement',array(
		));
    }
    public function actionUpdateAdvertisement(){
        $va = va();
        $va->check(array(
            'type'=>array('not_blank','uint',array('uint_length', 2, 5))
        ));
        if($va->success){
            $model = Newspic::model()->getOnePicByType($va->valid['type']);
            if(empty ($model)){
                $model = new Newspic();
            }
            if(isset($_POST['Newspic'])){
                $oldPicture = $model->np_picurl;//旧图片地址
                $imageForm = CUploadedFile::getInstance($model,'np_picurl');
                $model->attributes=$_POST['Newspic'];
                $model->np_type = $va->valid['type'];
                $model->np_order = 1;//因为只有一条数据，默认排序都为1。
                if($model->validate()){
                    //上传文件符合标准，则判断是否是创建，不是就更新
                    if($model->np_id==""){//插入
                        $dba = dba();
                        $model->np_id = $dba->id("35_newspic");
                    }
                    if($imageForm){//代表上传的有新图片文件
                        //更新。先删除旧文件
                        @unlink(PIC_PATH.$oldPicture);
                        $picTypePath = "/newspic/";//文件夹路径
                        $model->np_picurl = Picture::model()->imageName($imageForm->name,$picTypePath);//得到最新生成的图片名称
                        $boolUploadFile = $imageForm->saveAs(PIC_PATH.$model->np_picurl);//上传图片
                        if($boolUploadFile){
                            $imageDeal = new Image();
                            $result = $imageDeal->capture(PIC_PATH.$model->np_picurl,null,array('width'=>126,'height'=>90),true);//不生成新文件
                            if($model->save())
                                $this->redirect(array('advertisement'));
                        }else{
                            $model->addError("np_picurl", "图片上传失败");
                        }
                    }else{//没有上传新图片文件
                        $model->np_picurl = $oldPicture;//没有上传图片,代表依然使用以前的图片
                        if($model->save())
                            $this->redirect(array('advertisement'));
                    }
                }
            }
            $this->render('updateadvertisement',array(
                'model'=>$model
            ));
        }else{
            throw new CHttpException(400,'非法链接.请不要再访问这个页面.');
        }
    }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Newspic;
        
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Newspic']))
		{
			$model->attributes=$_POST['Newspic'];
            $model->np_type = 1;//默认是首页图片
            $imageForm = CUploadedFile::getInstance($model,'np_picurl');
			if($model->validate()){
                $dba = dba();
                $model->np_id = $dba->id("35_newspic");
                $picTypePath = "/newspic/";//文件夹路径
                if($imageForm){
                    $model->np_picurl = Picture::model()->imageName($imageForm->name,$picTypePath);//得到最新生成的图片名称
                    $boolUploadFile = $imageForm->saveAs(PIC_PATH.$model->np_picurl);//上传图片
                    if($boolUploadFile){
                        $imageDeal = new Image();
                        $result = $imageDeal->capture(PIC_PATH.$model->np_picurl,null,array('width'=>345,'height'=>200),true);//不生成新文件
                        if($model->save())
                            $this->redirect(array('view','id'=>$model->np_id));
                    }else{
                        $model->addError("np_picurl", "图片上传失败");
                    }
                }else{
                    if($model->save())
                            $this->redirect(array('view','id'=>$model->np_id));
                }
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
		$model=$this->loadModel();
        $oldPicture = $model->np_picurl;//旧图片地址
		if(isset($_POST['Newspic']))
		{
			$model->attributes=$_POST['Newspic'];
			if($model->validate()){
                $imageForm = CUploadedFile::getInstance($model,'np_picurl');
                if($imageForm){//如果有上传文件，则要验证上传文件。
                    //先删除旧文件
                    @unlink(PIC_PATH.$oldPicture);
                    $picTypePath = "/newspic/";//文件夹路径
                    $model->np_picurl = Picture::model()->imageName($imageForm->name,$picTypePath);//得到最新生成的图片名称
                    $boolUploadFile = $imageForm->saveAs(PIC_PATH.$model->np_picurl);//上传图片
                    if($boolUploadFile){
                        $imageDeal = new Image();
                        $result = $imageDeal->capture(PIC_PATH.$model->np_picurl,null,array('width'=>345,'height'=>200),true);//不生成新文件
                        if($model->save())
                            $this->redirect(array('view','id'=>$model->np_id));
                    }else{
                        $model->addError("np_picurl", "图片上传失败");
                    }
                }else{//如果没有上传图片，则直接保存。
                    $model->np_picurl=$oldPicture;
                    $model->save();
                    $this->redirect(array('view','id'=>$model->np_id));
                }
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
			// we only allow deletion via POST request
			$this->loadModel()->delete();

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
        $criteria=new CDbCriteria(array(
            "condition"=>"np_type=1",
            ));
        $dataProvider=new CActiveDataProvider('Newspic',array(
            'criteria'=>$criteria
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
		$model=new Newspic('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Newspic'])){
			$model->attributes=$_GET['Newspic'];
        }
        $criteria=new CDbCriteria(array(
            "condition"=>"np_type=1",
            ));
        $dataProvider=new CActiveDataProvider('Newspic',array(
            'criteria'=>$criteria
        ));
		$this->render('admin',array(
			'model'=>$model,
            'dataProvider'=>$dataProvider
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
				$this->_model=Newspic::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='newspic-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
