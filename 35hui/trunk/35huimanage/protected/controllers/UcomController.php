<?php

class UcomController extends Controller
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

    public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$ucomModel = $this->loadModel();
            $ucomUserId = $ucomModel->uc_uid;
            $userModel = User::model()->findByPk($ucomUserId);

            $path = PIC_PATH."/uc/".$userModel->user_name;
            common::deldir($path);//删除文件夹

            $ucomModel->delete();
            $userModel->delete();

            //删除推荐信息
            $criteria=new CDbCriteria;
            $criteria->addColumnCondition(array("sp_sourceid"=>$ucomUserId,"p_positiontype"=>4));
            $allProduct = Buyproduct::model()->with("productgrid")->findAll($criteria);
            if($allProduct){
                foreach($allProduct as $value){
                    $value->delete();
                }
            }
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			Yii::app()->user->setFlash('deleteResult','中介公司删除成功！');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

    public function actionIndex()
	{
        $this->render('index',array(
        ));
    }

	/**
	 * Lists all models.
	 */
	public function actionIndexFrame()
	{
        $this->layout = "frame";
        $uc_fullname = "";
        $district = "";
        $section = "";
        $criteria=new CDbCriteria();
        if(isset($_GET['uc_fullname'])){
            $uc_fullname = $_GET['uc_fullname'];
            $criteria->addSearchCondition("uc_fullname",$uc_fullname);
        }
        if(isset($_GET['district'])&&$_GET['district']!=""){
            $district = $_GET['district'];
            $criteria->addColumnCondition(array("uc_district"=>$district));
        }
        if(isset($_GET['section'])&&$_GET['section']!=""){
            $section = $_GET['section'];
            $criteria->addColumnCondition(array("uc_section"=>$section));
        }
        if(isset($_GET['orderBy'])&&$_GET['orderBy']!=''){
            $criteria->with = array(
                'userInfo'=>array(
                    'order'=>$_GET['orderBy']." desc",
                ),
            );
        }else{
            $criteria->order = "uc_id desc";
        }
        $dataProvider = new CActiveDataProvider('Ucom',array(
			'pagination'=>array(
                'pageSize'=>20,
            ),
            'criteria'=>$criteria,
        ));
		$this->render('indexFrame',array(
			'dataProvider'=>$dataProvider,
            'uc_fullname'=>$uc_fullname,
            "district"=>$district,
            "section"=>$section,
		));
	}
     public function actionAudit(){
        $ucid = $_GET['id'];
        $check = $_GET['check'];
        if(in_array($check,array("1","2"))){
            $connection = Yii::app()->db;
            $sql = 'UPDATE {{ucom}} SET uc_check = "' . $check .'" WHERE uc_id = ' .$ucid;
            $command=$connection->createCommand($sql);
            $command->execute();
        }
    }

    /**
     * 运营认证
     */
    public function actionLicense(){
        $dataProvider=new CActiveDataProvider('Ucom',
            array(
                'criteria'=>array(
                    'condition' => 'uc_recogniseurl!="" and uc_recogniseaudit="0"',
                ),
            ));
        $this->render('license',array(
			'dataProvider'=>$dataProvider,
		));
    }
    public function actionAuditLicense(){
        $check = $_POST['check'];
        $ucid = $_POST['id'];
        if(in_array($check,array("1","2"))){
            $connection = Yii::app()->db;
            if($check==2){
                $sql = 'UPDATE {{ucom}} SET uc_recogniseaudit = "' . $check .'" WHERE uc_id = ' .$ucid;
            }else{
                $uc_comid = $_POST['comid'];
                //验证不能重复。
                $model = Ucom::model()->findByAttributes(array("uc_recognisecode"=>$uc_comid));
                if(!empty($model)){//营业执照冲突
                    echo "fal";
                    exit;
                }
                $sql = 'UPDATE {{ucom}} SET uc_recogniseaudit = "' . $check .'" , uc_recognisecode="'.$uc_comid.'",uc_recognisetime=UNIX_TIMESTAMP() WHERE uc_id = ' .$ucid;
                //认证成功，+30积分与商务币
                $Ucom = Ucom::model()->findByPk($ucid);

                $config=Oprationconfig::model()->getConfigByName('uc_license_audit','0');
                $description = "运营认证成功，系统赠送{:money}商务币";
                Userproperty::model()->addMoney($Ucom->uc_uid, $config, $description);
                
                $config=Oprationconfig::model()->getConfigByName('uc_license_audit','1');
                $description = "运营认证成功，系统赠送{:point}积分";
                Userproperty::model()->addPoint($Ucom->uc_uid, $config, $description);

                Invite::model()->inviteUserUcom($Ucom->uc_uid);//推荐人奖励
            }
            $command=$connection->createCommand($sql);
            $command->execute();
            echo "suc";
            exit;
        }
    }

    /**
     * 头像认证
     */
    public function actionComlogo(){
        $dataProvider=new CActiveDataProvider('Ucom',
            array(
                'criteria'=>array(
                    'condition' => 'uc_logoaudit!="1" and uc_logo!=""',
                ),
            ));
        $this->render('comlogo',array(
			'dataProvider'=>$dataProvider,
		));
    }
    public function actionAuditComlogo(){
        $check = (int)$_GET['check'];
        $ucids = explode(',', trim($_GET['id']));
        if( in_array($check, array(1,2)) && $ucids){
            foreach($ucids as $ucid){
                if( ($Ucom = Ucom::model()->findByPk($ucid) ) ){
                    if($check === 1){//通过
                        $Ucom->uc_logoaudit = 1;
                    }else{
                        $Ucom->uc_logoaudit = 2;
                        @ unlink(PIC_URL.$Ucom->uc_logo);
                        $Ucom->uc_logo = '';
                    }
                    $Ucom->update();
                }
            }
            echo '1';exit;
        }
        echo '0';exit;
    }
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
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
				$this->_model=Ucom::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='officebaseinfo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}