<?php

class ReportController extends Controller
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
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();
        $officeId = $model->r_sinfulbuildid;
		/*$model->r_state = 1;//代表已经受理
        if($model->save()){*/
            if(isset($_GET['type']) && $_GET['type']=='legal'){
                 //设置了确定违规和不违规的类型               
            }else{
                //给举报者增加货币和积分 3
                $informantUserModel = User::model()->findByPk($model->r_informantuserid);
                if($informantUserModel){
                    $integralReward = Oprationconfig::model()->getConfigByName('illegalUpdate', '1');
                    $moneyReward = Oprationconfig::model()->getConfigByName('illegalUpdate', '0');
                    $houseInfo = Report::model()->getHouseInfo($officeId, $model->r_buildtype);

                    $titleFieldName='';
                    $houseName='';
                    if( $model->r_buildtype==3){
                         $titleFieldName='rbi_title';
                         $houseName = $houseInfo->$titleFieldName;//房源名称
                    }else{
                        $titleFieldName=$model->r_buildtype==Report::shop?'sp_shoptitle':'op_officetitle';
                        $houseName = $houseInfo?$houseInfo->presentInfo[$titleFieldName]:"";//房源名称
                    }

                    $logDescription = "您举报房源 ".$houseName."违规，经查证属实,奖励{:point}商务币";
                    Userproperty::model()->addMoney($informantUserModel->user_id, $moneyReward, $logDescription);

                    $logDescription = "您举报房源 ".$houseName."违规，经查证属实,奖励{:money}积分";
                    Userproperty::model()->addPoint($informantUserModel->user_id, $integralReward, $logDescription);

                      //扣取被举报者的货币和积分 2
                    $logDescription = "房源:".$houseName." 被举报,举报原因:".Report::$reportmeg[$model->r_type].",经查证属实,扣除{:money}商务币";
                    Userproperty::model()->deductMoney($model->r_sinfuluserid, Oprationconfig::model()->getConfigByName('illegalUpdate', '3'), $logDescription,true);

                    $logDescription = "房源:".$houseName." 被举报,举报原因:".Report::$reportmeg[$model->r_type].",经查证属实,扣除{:point}积分.";
                    Userproperty::model()->deductPoint($model->r_sinfuluserid, Oprationconfig::model()->getConfigByName('illegalUpdate', '4'), $logDescription, true);
                }
  
                //添加违规原因
                if($model->r_buildtype==Report::office){
                    $tagmodle = Officetag::model()->find("ot_officeid=:ot_officeid",array("ot_officeid"=>$officeId));
                    $tagmodle->ot_check = 9;
                    $tagmodle->ot_illegalreason = $_GET['illegalreason'];
                    $tagmodle->save();
                }elseif($model->r_buildtype==Report::shop){
                    $tagmodle = Shoptag::model()->find("st_shopid=:st_shopid",array("st_shopid"=>$officeId));
                    $tagmodle->st_check = 9;
                    $tagmodle->st_illegalreason = $_GET['illegalreason'];
                    $tagmodle->save();
                }elseif($model->r_buildtype==Report::residence){
                    $tagmodle = Residencetag::model()->find("rt_rbiid=:st_shopid",array("st_shopid"=>$officeId));
                    $tagmodle->rt_check = 9;
                    $tagmodle->rt_illegalreason = $_GET['illegalreason'];
                    $tagmodle->save();
                }      
            }
            //删除report记录
            $model->delete();
      /*  }else{
            echo 0;
        }*/
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Report',array(
            'criteria'=>array('order'=>'r_id desc'),
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
		$model=new Report('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Report']))
			$model->attributes=$_GET['Report'];

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
				$this->_model=Report::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='report-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
