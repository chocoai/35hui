<?php

class ApplyhighsourceController extends Controller
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
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("ahs_status"=>0));
		$dataProvider=new CActiveDataProvider('Applyhighsource',array(
            'criteria'=>$criteria,
        ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

    public function actionAudit(){
        $model = $this->loadModel();
        if(isset($_GET["state"])&&$_GET["state"]=="pass"){//审核通过
            Yii::app()->user->setFlash('message','房源设优成功！');
            $model->ahs_status=1;
            $model->update();
            //把房源变成优质
            switch ($model->ahs_type){
                default:
                    break;
                case 1: //写字楼
                    if($base=Officebaseinfo::model()->findByPk($model->ahs_sourceid) ){
                        $base->ob_order+=common::getOrderConfig('high');
                        $base->update();
                    }
                    $sourceModel = Officetag::model()->findByAttributes(array("ot_officeid"=>$model->ahs_sourceid));
                    $sourceModel->ot_ishigh = 1;
                    $sourceModel->update();
                    break;
                case 2: //商铺
                    if($base=Shopbaseinfo::model()->findByPk($model->ahs_sourceid) ){
                        $base->sb_order+=common::getOrderConfig('high');
                        $base->update();
                    }
                    $sourceModel = Shoptag::model()->findByAttributes(array("st_shopid"=>$model->ahs_sourceid));
                    $sourceModel->st_ishigh = 1;
                    $sourceModel->update();
                    break;
                case 3: //住宅
                    if($base=Residencebaseinfo::model()->findByPk($model->ahs_sourceid) ){
                        $base->rbi_order+=common::getOrderConfig('high');
                        $base->update();
                    }
                    $sourceModel = Residencetag::model()->findByAttributes(array("rt_rbiid"=>$model->ahs_sourceid));
                    $sourceModel->rt_ishigh = 1;
                    $sourceModel->update();
                    break;
                }
        }else{//审核不通过
            Yii::app()->user->setFlash('message','房源设优失败！');
            $message = trim($_GET["message"]);
            if($message!=""){
                $model->ahs_status=2;
                $model->ahs_message = $message;
                $model->update();
            }
        }
        $this->redirect(array("index"));
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
				$this->_model=Applyhighsource::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

}
