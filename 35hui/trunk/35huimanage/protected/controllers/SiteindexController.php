<?php

class SiteindexController extends Controller
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
    {
        $model=new Siteindex;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $type=0;
        $id=0;
        $title = '';
        $intro = '';
        $data=array();
        $sellPrice=$rentPrice=0;
        if(isset($_GET['type'])&&isset($_GET['id'])){
            $type=$_GET['type'];
            $id=$_GET['id'];
            if($type==1){
                $data = Systembuildinginfo::model()->findbyPk($id);
                $title =$data->sbi_buildingname;
                $sellPrice=$data->sbi_avgsellprice;
                $rentPrice=$data->sbi_avgrentprice;
                $model->si_desc =$data->sbi_buildingintroduce;
            }else{
                $data = Communitybaseinfo::model()->findbyPk($id);
                $sellPrice=$data->comy_avgsellprice;
                //$rentPrice 小区没有平均租价
                $model->si_pricetype=2;
                $title=$data->comy_name;
                $model->si_desc=$data->comy_introduce;
            }
        }

        if(isset($_POST['Siteindex']))
        {
            $model->attributes=$_POST['Siteindex'];
            $model->si_time = time();
            $imageForm=CUploadedFile::getInstance($model, 'si_img');
            if($imageForm != null){
                $picTypePath = '/siteindeximg/';//得到图片类型路径
                $model->si_img=Picture::model()->imageName($imageForm->name,$picTypePath);//得到最新生成的图片名称
                $boolUploadFile = $imageForm->saveAs(PIC_PATH.$model->si_img);//上传图片
            }
            if($model->save())
            {
                $si_typeid = $_POST['Siteindex']['si_typeid'];
                $si_type = $_POST['Siteindex']['si_type'];
                if($si_type==1){
                    $this->redirect(array('systembuildinginfo/view','id'=>$si_typeid));
                } else{
                   $this->redirect(array('communitybaseinfo/view','id'=>$si_typeid));
                }
            }
        }

        $this->render('create',array(
            'sellPrice'=>$sellPrice,
            'rentPrice'=>$rentPrice,
            'model'=>$model,
            'type'=>$type,
            'id'=>$id,
            'title'=>$title,
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
        $title = '';
        $intro = '';
        $data=array();
        $sellPrice=$rentPrice=0;
        $type=$model->si_type;
        $id=$model->si_typeid;
        if($type==1){
            $data = Systembuildinginfo::model()->findbyPk($id);
            $title =$data->sbi_buildingname;
            $sellPrice=$data->sbi_avgsellprice;
            $rentPrice=$data->sbi_avgrentprice;
            $model->si_desc =$data->sbi_buildingintroduce;
        }else{
            $data = Communitybaseinfo::model()->findbyPk($id);
            $sellPrice=$data->comy_avgsellprice;
            //$rentPrice 小区没有平均租价
            $model->si_pricetype=2;
            $title=$data->comy_name;
            $model->si_desc=$data->comy_introduce;
        }

		if(isset($_POST['Siteindex']))
		{
			$model->attributes=$_POST['Siteindex'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
            'sellPrice'=>$sellPrice,
            'rentPrice'=>$rentPrice,
            'type'=>$type,
            'id'=>$id,
            'title'=>$title,
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
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Siteindex');
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
				$this->_model=Siteindex::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='siteindex-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
