<?php

class ErrorController extends Controller
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
    public function actionHistory(){
        $dataProvider=new CActiveDataProvider('Error',array(
            'criteria'=>array(
//                'condition'=>'e_state=0',
            )
        ));
		$this->render('history',array(
			'dataProvider'=>$dataProvider,
		));
    }
    public function actionDealError(){
        $va = va();
        $va->check(array(
            'state'=>array('not_blank',array('eq','1','2'))
        ));
        if($va->success){
            $model = $this->loadModel();
            $model->e_state = $va->valid['state'];
            if($va->valid['state']==Error::accept){//表示受理
                if($model->save()){
                    $moneyReward=Oprationconfig::model()->getConfigByName('dealError','0');
                   
                    $pointReward=Oprationconfig::model()->getConfigByName('dealError','1');
                 
                    $userModel = User::model()->findByPk($model->e_userid);
                    if($userModel){//有这个人
                        $systembuildingName = Systembuildinginfo::model()->getBuildingName($model->e_buildid);

                        $description = "您对楼盘 ".$systembuildingName."进行了纠错,经核查属实,奖励{:money}商务币";

                        Userproperty::model()->addMoney($model->e_userid, $moneyReward, $description);
                       
                        $description = "您对楼盘 ".$systembuildingName."进行了纠错,经核查属实,奖励{:point}积分";
                        Userproperty::model()->addPoint($model->e_userid, $pointReward, $description);
                    }
                    Yii::app()->user->setFlash('dealError','已成功受理该纠错信息.');
                }else{
                    Yii::app()->user->setFlash('dealError','受理该纠错信息失败.');
                }
            }else{//不受理
              //  if($model->save())
                if($model->delete())
                    Yii::app()->user->setFlash('dealError','已成功不受理该纠错信息.');
            }
        }
        $this->redirect(array('error/index'));
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
		$dataProvider=new CActiveDataProvider('Error',array(
            'criteria'=>array(
                'condition'=>'e_state=0',
            )
        ));
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
				$this->_model=Error::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='error-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
