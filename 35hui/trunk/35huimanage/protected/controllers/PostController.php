<?php

class PostController extends Controller
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
		$model=new Post;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Post']))
		{
            $dba = dba();
			$model->attributes=$_POST['Post'];
            $model->post_id = $dba->id('35_post');
            $model->post_time = time();
			if($model->save()){
                Yii::app()->user->setFlash('sendState','公告发送成功');
				$this->redirect(array('view','id'=>$model->post_id));
            }
		}

		$this->render('create',array(
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
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('Index'));
		}
		else
			throw new CHttpException(400,'非法的请求. 请不要再访问这个链接.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $criteria=new CDbCriteria;
        $role = 0;
        if(isset($_GET["role"])&&$_GET["role"]!=0){
            $role = $_GET["role"];
            $criteria->addColumnCondition(array("post_role"=>$role));
        }
        $criteria->order = "post_time desc";
		$dataProvider=new CActiveDataProvider('Post',array(
                'criteria'=>$criteria,
                'pagination'=>array(
                    'pageSize'=>10,
                ),
        ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            "role"=>$role,
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
				$this->_model=Post::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'这个请求页面不存在.');
		}
		return $this->_model;
	}
    public function actionUpdate(){
        $model = $this->loadModel();
        if(isset($_POST["Post"])){
            $model->attributes = $_POST["Post"];
            if($model->save()){
                $this->redirect(array('view','id'=>$model->post_id));
            }
        }
        $this->render("update",array(
            "model"=>$model,
        ));
    }

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
