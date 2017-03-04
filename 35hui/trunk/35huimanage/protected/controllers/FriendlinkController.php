<?php

class FriendlinkController extends Controller
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
		$model=new Friendlink;
        $model->fl_url = "http://";
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Friendlink']))
		{
			$model->attributes=$_POST['Friendlink'];
            $model->fl_createtime = time();
			if($model->save())
				$this->redirect(array('view','id'=>$model->fl_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
    public function actionUploadFrame(){
        $this->layout = "frame";
        if (!empty($_FILES)){
            if($_FILES['uploadFile']['size']>2097152){//最大2M
                echo '<script type="text/javascript">parent.showMsg("您选择的文件大于2M，上传失败！")</script>';exit;
            }
            $originfilename = $_FILES['uploadFile']['name']; //文件名
            $fileext = strtolower(substr($originfilename,strrpos($originfilename,'.'))); //后缀名
            //验证文件格式是否正确
            $patn = "/jpg$|jpeg$|gif$|png$/i";
            if(preg_match($patn,$fileext)){
                $fileName = "/friendlink/".time().rand("00", "99").$fileext;
                $targetFile =  PIC_PATH.$fileName;
                $tempFile = $_FILES['uploadFile']['tmp_name'];
                move_uploaded_file($tempFile,$targetFile);
                echo '<script type="text/javascript">parent.uploadSuccess("'.PIC_URL.$fileName.'")</script>';exit;
            }else{
                echo '<script type="text/javascript">parent.showMsg("后缀错误，上传失败！")</script>';exit;
            }
        }
        $this->render('uploadFrame',array(
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

		if(isset($_POST['Friendlink']))
		{
			$model->attributes=$_POST['Friendlink'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->fl_id));
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
        $criteria=new CDbCriteria;
        $criteria->order = "fl_order";
        $dataProvider=new CActiveDataProvider('Friendlink',array(
            "criteria"=>$criteria,
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
        if(isset($_POST["submit"])){
            $idArr = isset($_POST['id'])?$_POST['id']:array();
            if($idArr){
                foreach($idArr as $key=>$value){
                    Friendlink::model()->updateByPk($value, array("fl_order"=>$key+1));
                }
                Yii::app()->user->setFlash('message','排序保存成功！');
            }
        }
		$criteria=new CDbCriteria;
        $criteria->order = "fl_type, fl_order";
        $model = Friendlink::model()->findAll($criteria);
        $allLinks = array();
        foreach($model as $value){
            $allLinks[$value->fl_type][] = $value;
        }
		$this->render('admin',array(
			'allLinks'=>$allLinks,
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
				$this->_model=Friendlink::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='friendlink-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
