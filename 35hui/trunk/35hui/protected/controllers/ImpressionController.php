<?php

class ImpressionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to 'column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column2';

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('ajaxAddPro','ajaxMoreImpression'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
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
				$this->_model=Impression::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='impression-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    /**
     * 给选中的印象的支持次数+1
     * @param <type> $id 选中的印象的id
     */
    public function actionAjaxAddPro(){
        $result = 0;//0代表失败,1代表成功,2代表已经投票过,不能再投票了,3代表没有登录
        if (Yii::app()->user->isGuest) {//没有登录
            $result = 3;
        }else{//已经登录
            $userId = Yii::app()->user->id;
            $sourceId = $_GET['sourceId'];
//            $sourceType = $_GET['sourceType'];
            $sourceType = Impression::systembuilding;//现在只有楼盘有印象,就在这里固定死
            $publishState = Impression::model()->checkPublished($userId,$sourceId,$sourceType);
            if($publishState){
                $result = 2;
            }else{
                $addLog = Userimpression::model()->addPublishLog($userId,$_GET['id']);//添加发表记录
                if($addLog) {
                    $result = 1;
                    $model = $this->loadModel();
                    if($model) {
                        $model->setAttribute("im_pro",$model->im_pro+1);
                        $model->save();
                    }
                }
            }
        }
        echo $result;
    }
    public function actionAjaxMoreImpression(){
        $sourceId = $_GET['sourceId'];
        $sourceType = $_GET['sourceType'];
        $allImpressions = Impression::model()->getAllImpression($sourceId,$sourceType);
        if($allImpressions){
            foreach($allImpressions as $impression){
                echo "<a href='#_self' onclick='addPro(".$impression->im_id.")'>".$impression->im_description."</a>";
            }
        }
    }
}
