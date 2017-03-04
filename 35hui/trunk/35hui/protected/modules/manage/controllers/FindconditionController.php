<?php

class FindconditionController extends Controller
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
				'actions'=>array('myFindCondition','delete'),
				 'roles'=>array(
                    Yii::app()->params['personal'],
                ),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
        if(Yii::app()->request->isPostRequest)
		{
            $userId = Yii::app()->user->id;
            $model = $this->loadModel();
            if($userId && $model->fc_puserid==$userId){
                // we only allow deletion via POST request
                $model->delete();
                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                    header('Location:'.$_SERVER['HTTP_REFERER']);
            }
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
				$this->_model=Findcondition::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

    public function actionMyFindCondition(){
        $pageNum = 10;//每页显示数量
        $va = va();
        $va->check(array(
            'sr'=>array('not_blank',array('eq',Findcondition::sell,Findcondition::rent)),
            'officeType'=>array(array('eq',Findcondition::office,Findcondition::building,Findcondition::business,Findcondition::shop,Findcondition::residence)),
            'menu'=>array('not_blank')
        ));
        $userId = Yii::app()->user->id;
        $officeType = $va->valid['officeType']!=0?$va->valid['officeType']:0;//房源类型
        $criteria=new CDbCriteria(array(
            'condition'=>'fc_rentorsell=:rentorsell and fc_puserid=:puserId',
            'params'=>array(":rentorsell"=>$va->valid['sr'],':puserId'=>$userId),
            'order'=>'fc_recordtime desc'
        ));
        if($officeType){
            $criteria->addColumnCondition(array('fc_officetype'=>$officeType));
        }
        $pages = new CPagination(Findcondition::model()->count($criteria));
        $pages->pageSize = $pageNum;
        $pages->applyLimit($criteria);
        $dataProvider = new CActiveDataProvider('Findcondition',array(
            'pagination'=>$pages,
            'criteria'=>$criteria,
        ));
        $this->render('myFindCondition',array(
            'sr'=>$va->valid['sr'],
            'officeType'=>$officeType,
            'preTitle'=>$va->valid['sr']==Findcondition::sell?"买房管理":"租房管理",
            'dataProvider'=>$dataProvider,
            'menu'=>$va->valid['menu']
        ));
    }
}
