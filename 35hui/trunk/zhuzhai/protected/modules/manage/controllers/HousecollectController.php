<?php

class HousecollectController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('myCollect','delete'),
				'roles'=>array(
                    Yii::app()->params['personal'],
                ),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actionMyCollect(){
        $userId = Yii::app()->user->id;
        $pageNum = 10;//每页显示数量
        $va = va();
        $va->check(array(
            'sr'=>array('not_blank',array('eq',Housecollect::rent,Housecollect::sell)),
            'officeType'=>array(array('eq',Housecollect::office,Housecollect::business,Housecollect::shop,Housecollect::residence)),
            'menu'=>array('not_blank')
        ));
        $officeType = $va->valid['officeType']!=0?$va->valid['officeType']:0;//房源类型
        $criteria=new CDbCriteria(array(
            'condition'=>'hc_rentorsell=:rentorsell',
            'params'=>array(":rentorsell"=>$va->valid['sr']),
            'order'=>'hc_recordtime desc'
        ));
        $criteria->addColumnCondition(array('hc_puserid'=>$userId));//添加当前用户条件
        if($officeType){
            $criteria->addColumnCondition(array('hc_officetype'=>$officeType));
        }
        $pages = new CPagination(Housecollect::model()->count($criteria));
        $pages->pageSize = $pageNum;
        $pages->applyLimit($criteria);
        $dataProvider = new CActiveDataProvider('Housecollect',array(
            'pagination'=>$pages,
            'criteria'=>$criteria,
        ));
        $this->render('myCollect',array(
            'sr'=>$va->valid['sr'],
            'officeType'=>$officeType,
            'preTitle'=>$va->valid['sr']==Housecollect::sell?"买房管理":"租房管理",
            'dataProvider'=>$dataProvider,
            'menu'=>$va->valid['menu']
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
				header('Location:'.$_SERVER['HTTP_REFERER']);
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
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
				$this->_model=Housecollect::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='housecollect-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
