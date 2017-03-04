<?php

class BuyregionController extends Controller
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
		$model=new Buyregion;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Buyregion']))
		{
			$model->attributes=$_POST['Buyregion'];
			if($model->validate()){
                if(Buyregion::model()->checkRegionCanBuy($model['br_regionid'], $model['br_sourcetype'], $model['br_sellorrent'])){//还能继续购买
                    //格式数据
                    $model->br_buytime = time();
                    $model->br_expiredate = $model->br_expiredate*86400;
                    $model->save();
                    $this->redirect(array('view','id'=>$model->br_id));
                }else{
                    $model=new Buyregion;
                    Yii::app()->user->setFlash('message','此位置已经有人购买，且还没过期，不能购买！');
                }
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
    public function actionUpdate(){
        $model = $this->loadModel();
        if($model->br_buytime+$model->br_expiredate<time()){//已经过期
            $model->br_status = 2;
            $model->update();
            //现在要去把所有房源的地方把此设置清除.
            Buyregion::model()->updateAllSourceToZero($model);
        }
        $this->redirect(array("index"));
    }

    public function actionCheckCompanyName(){
        $name = $_GET["name"];
        $userId="";
        $model = Ucom::model()->findByAttributes(array("uc_fullname"=>$name));
        if($model){
            $userId = $model->uc_uid;
        }
        echo $userId;exit;
    }
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
        $model = $this->loadModel();
        if($model->br_status==2){
            $model->delete();
             $this->redirect(array('index'));
        }else{
            Yii::app()->user->setFlash('message','只有过期的数据设置下线后，才能删除！');
            $this->redirect(array('view','id'=>$model->br_id));
        }
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $criteria = new CDbCriteria;
        if(isset($_POST["status"])&&$_POST["status"]!="0"){
            $time = time();
            switch($_POST["status"]){
                case 1://未过期
                    $criteria->addCondition("br_buytime+br_expiredate>".$time);
                    break;
                case 2://过期未下线
                    $criteria->addCondition("br_buytime+br_expiredate<".$time);
                    $criteria->addColumnCondition(array("br_status"=>1));
                    break;
                case 3://已下线
                    $criteria->addColumnCondition(array("br_status"=>2));
                    break;
            }
        }

		$dataProvider=new CActiveDataProvider('Buyregion',array(
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
		$model=new Buyregion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Buyregion']))
			$model->attributes=$_GET['Buyregion'];

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
				$this->_model=Buyregion::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='buyregion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
