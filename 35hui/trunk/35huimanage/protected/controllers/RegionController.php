<?php

class RegionController extends Controller
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
    //通过传入父id，得到子列表。
    public function actionGetListByParentId(){
        $parentid = $_GET['parentid'];
        $dba = dba();
        $list = $dba->select("select * from 35_region where `re_parent_id`=?",$parentid);
        echo json_encode($list);
    }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        Manageuser::model()->validateAdminRole();
		$model=new Region;
        /* ajax查询 开始  */
        $searchModel=new Region('search');
        // clear any default values
        $searchModel->unsetAttributes();
        if(isset($_GET['Region']))
			$searchModel->attributes=$_GET['Region'];
        /* ajax查询 结束  */

		$this->performAjaxValidation($model);//ajax验证

		if(isset($_POST['Region']))
		{
			$model->attributes=$_POST['Region'];
            $check = $this->check($model);
            if($check){//有错误
                $model->addErrors($check);
            }else{//没错误
                if($model->save())
                    $this->redirect(array('view','id'=>$model->re_id));
            }
		}

		$this->render('create',array(
			'searchModel'=>$searchModel,
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
        Manageuser::model()->validateAdminRole();
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Region']))
		{
            $dba = dba();
			$model->attributes=$_POST['Region'];
            $check = $this->check($model);
            if($check){//有错误
                $model->addErrors($check);
            }else{//没错误
                if($model->save())
                    $this->redirect(array('view','id'=>$model->re_id));
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
        Manageuser::model()->validateAdminRole();
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
		$dataProvider=new CActiveDataProvider('Region');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
        Manageuser::model()->validateAdminRole();
        
		$model=new Region('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Region']))
			$model->attributes=$_GET['Region'];

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
				$this->_model=Region::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
    /**
     * 检验上级主键是否是有效的数字
     * @param <type> $model
     * @return <type>
     */
    protected function check($model){
        $error = array();//错误
        $className = get_class($model);
        if(isset($model['re_parent_id']) && $model['re_parent_id']!=""){
            $valid = Region::model()->hasId($model['re_parent_id']);
            if(!$valid){
                $error['re_parent_id']="上级主键Id&nbsp;不是有效的数字";
            }
        }
        return $error;
    }
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='region-form')
		{
            $className = get_class($model);
            /* 判断上级主键是否为有效数据 开始 */
            $validateResult = json_decode(CActiveForm::validate($model),true);
            $errors = $this->check($_POST[$className]);
            foreach($errors as $key=>$error){
                $validateResult[$className."_".$key][]=$error;
            }
            /* 判断上级主键是否为有效数据 结合 */
			echo json_encode($validateResult);
			Yii::app()->end();
		}
	}
    /**
     * 根据省份的id异步加载下面的城市
     */
    public function actionAjaxGetChildren(){
        if(isset($_GET['province'])){
            echo json_encode(Region::model()->getFormatChildrenData($_GET['province']));
        }elseif(isset($_GET['city'])){
            echo json_encode(Region::model()->getFormatChildrenData($_GET['city']));
        }elseif(isset($_GET['district'])){
            echo json_encode(Region::model()->getFormatChildrenData($_GET['district']));
        }elseif(isset($_GET['section'])){
            echo json_encode(Region::model()->getFormatChildrenData($_GET['section']));
        }
    }
}
