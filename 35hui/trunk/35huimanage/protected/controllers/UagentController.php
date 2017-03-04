<?php

class UagentController extends Controller
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
            $model = $this->loadModel();
            $uagentCheck=Contactrecord::model()->count("cr_userid=".$model->ua_uid);//判断是在联系人表里
            if(!$uagentCheck){
                $contactmodel=new Contactrecord;
                $contactmodel->cr_userid=$model->ua_uid;
                $contactmodel->cr_company=$model->ua_company;
                $contactmodel->cr_realname=$model->ua_realname;
                $contactmodel->cr_province=$model->ua_province;
                $contactmodel->cr_city=$model->ua_city;
                $contactmodel->cr_district=$model->ua_district;
                $contactmodel->cr_section=$model->ua_section;
                $contactmodel->cr_tel=$model->userInfo->user_tel;
                $contactmodel->cr_mobile='13511111111';
                $contactmodel->cr_email=$model->userInfo->user_email;
                $contactmodel->cr_qq='111111';
                $contactmodel->cr_mainbusiness=1;
                $contactmodel->cr_isregistered=1;
                $contactmodel->cr_salesman='admin';
                $contactmodel->cr_remark='备注';
                $contactmodel->cr_time=time();
                $contactmodel->save();
            }
            $this->render('view',array(
                    'model'=>$model,
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
        $ua_realname = "";
        $district = "";
        $section = "";
        $type = 1;
        $check = "";
        $ua_company="";
        $criteria=new CDbCriteria();
        if(isset($_GET['check'])&&$_GET['check']!=""){
            $check = $_GET['check'];
            $criteria->addColumnCondition(array("ua_check"=>$check));
        }
        if(isset($_GET['ua_realname'])){
            $ua_realname = $_GET['ua_realname'];
            $criteria->addSearchCondition("ua_realname",$ua_realname);
        }
        if(isset($_GET['district'])&&$_GET['district']!=""){
            $district = $_GET['district'];
            $criteria->addColumnCondition(array("ua_district"=>$district));
        }
        if(isset($_GET['section'])&&$_GET['section']!=""){
            $section = $_GET['section'];
            $criteria->addColumnCondition(array("ua_section"=>$section));
        }
        if(isset($_GET['ua_company'])&&$_GET['ua_company']!=""){
            $ua_company = $_GET['ua_company'];
            $criteria->addSearchCondition("ua_company",$ua_company);
        }
        if(isset($_GET['type'])&&$_GET['type']){
            $type=$_GET['type'];
            if($_GET['type']==1){
                $conditionStr="user_name not like '\_%'";
            }else if($_GET['type']==2){
                $conditionStr="user_name like '\_%'";
            }else{
                $conditionStr="";
            }
        }else{
            $conditionStr="";
        }
        if(isset($_GET['orderBy'])&&$_GET['orderBy']!=''){
            $criteria->with = array(
                'userInfo'=>array(
                    'condition'=>$conditionStr,
                    'order'=>$_GET['orderBy']." desc",
                ),
            );
        }else{
             $criteria->with = array(
                'userInfo'=>array(
                     'condition'=>$conditionStr,
                    'order'=>"ua_id desc",
                ),
            );
            //$criteria->order = "ua_id desc";
        }
        $dataProvider = new CActiveDataProvider('Uagent',array(
			'pagination'=>array(
                'pageSize'=>20,
            ),
            'criteria'=>$criteria,
        ));
		$this->render('indexFrame',array(
			'dataProvider'=>$dataProvider,
            'ua_realname'=>$ua_realname,
            "district"=>$district,
            "section"=>$section,
            "type"=>$type,
            "check"=>$check,
            "ua_company"=>$ua_company,
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

			$agentModel = $this->loadModel();
            $agentUserId = $agentModel->ua_uid;
            $userModel = User::model()->findByPk($agentUserId);

            $path = PIC_PATH."/ua/".$userModel->user_name;
            common::deldir($path);//删除文件夹
            
            $agentModel->delete();
            $userModel->delete();

            //删除推荐信息
            $criteria=new CDbCriteria;
            $criteria->addColumnCondition(array("sp_sourceid"=>$agentUserId,"p_positiontype"=>3));
            $allProduct = Buyproduct::model()->with("productgrid")->findAll($criteria);
            if($allProduct){
                foreach($allProduct as $value){
                    $value->delete();
                }
            }
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			Yii::app()->user->setFlash('deleteResult','经纪人删除成功！');
            $this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
    public function actionAudit(){
        $uaid = $_GET['id'];
        $check = $_GET['check'];
        if(in_array($check,array("1","2"))){
            $connection = Yii::app()->db;
            $sql = 'UPDATE {{uagent}} SET ua_check = "' . $check .'" WHERE ua_id = ' .$uaid;
            $command=$connection->createCommand($sql);
            $command->execute();
        }
    }
    public function actionIdentify (){
        $dataProvider=new CActiveDataProvider('Uagent',
            array(
                'criteria'=>array(
                    'condition' => 'ua_scardurl!="" and ua_scardaudit="0"',
                ),
            ));
        $this->render('identify',array(
			'dataProvider'=>$dataProvider,
		));
    }
    public function actionAuditiDentify(){
        $uaid = $_GET['id'];
        $check = $_GET['check'];
        if(in_array($check,array("1","2"))){
            $connection = Yii::app()->db;
            $sql = 'UPDATE {{uagent}} SET ua_scardaudit = "' . $check .'",ua_scardtime=UNIX_TIMESTAMP() WHERE ua_id = ' .$uaid;
            $command=$connection->createCommand($sql);
            $command->execute();
            //认证成功，加10积分和10商务币

            if($check==1){
                $uagent = Uagent::model()->findByPk($uaid);

                $config=Oprationconfig::model()->getConfigByName('ua_identify_audit','0');       
                $description = "身份认证成功，系统赠送{:money}商务币";
                Userproperty::model()->addMoney($uagent->ua_uid, $config, $description);
                
                $config=Oprationconfig::model()->getConfigByName('ua_identify_audit','1');
                $description = "身份认证成功，系统赠送{:point}积分";
                Userproperty::model()->addPoint($uagent->ua_uid, $config, $description);

                Invite::model()->inviteUserUagent($uagent->ua_uid);//推荐人奖励
            }
        }
    }
    /**
     * 名片认证
     */
    public function actionPractice(){
        $dataProvider=new CActiveDataProvider('Uagent',
            array(
                'criteria'=>array(
                    'condition' => 'ua_bcardurl!="" and ua_bcardaudit="0"',
                ),
            ));
        $this->render('practice',array(
			'dataProvider'=>$dataProvider,
		));
    }
    public function actionAuditPractice(){
        $uaid = $_GET['id'];
        $check = $_GET['check'];
        if(in_array($check,array("1","2"))){
            $connection = Yii::app()->db;
            $sql = 'UPDATE {{uagent}} SET ua_bcardaudit = "' . $check .'",ua_bcardtime=UNIX_TIMESTAMP() WHERE ua_id = ' .$uaid;
            $command=$connection->createCommand($sql);
            $command->execute();
            //认证成功，加10积分和10商务币
            if($check==1){
                $uagent = Uagent::model()->findByPk($uaid);

                $config=Oprationconfig::model()->getConfigByName('ua_practice_audit','0');
                $description = "名片认证成功，系统赠送{:money}商务币";
                Userproperty::model()->addMoney($uagent->ua_uid, $config, $description);

                $config=Oprationconfig::model()->getConfigByName('ua_practice_audit','1');
                $description = "名片认证成功，系统赠送{:point}积分";
                Userproperty::model()->addPoint($uagent->ua_uid, $config, $description);

                Invite::model()->inviteUserUagent($uagent->ua_uid);//推荐人奖励
            }
        }
    }
    /**
     * 运营认证
     */
    public function actionLicense(){
//        $dataProvider=new CActiveDataProvider('Uagent',
//            array(
//                'criteria'=>array(
//                    'condition' => 'ua_licenseurl!="" and ua_licenseaudit="0"',
//                ),
//            ));
        $this->render('license',array(
//			'dataProvider'=>$dataProvider,
		));
    }
    public function actionAuditLicense(){
        $check = $_GET['check'];
        $uaid = $_GET['id'];
        if(in_array($check,array("1","2"))){
            $connection = Yii::app()->db;
            if($check=="2"){//审核未通过
                $sql = 'UPDATE {{uagent}} SET ua_licenseaudit = "' . $check .'" WHERE ua_id = ' .$uaid;
            }else{//审核通过
                $ua_comid = $_GET['comid'];
                $sql = 'UPDATE {{uagent}} SET ua_licenseaudit = "' . $check .'" , ua_comid="'.$ua_comid.'",ua_licensetime=UNIX_TIMESTAMP() WHERE ua_id = ' .$uaid;
                //认证成功，加10积分和10商务币
                $uagent = Uagent::model()->findByPk($uaid);

                $config=Oprationconfig::model()->getConfigByName('ua_license_audit','0');
                $description = "运营认证成功，系统赠送{:money}商务币";
                Userproperty::model()->addMoney($uagent->ua_uid, $config, $description);

                $config=Oprationconfig::model()->getConfigByName('ua_license_audit','1');
                $description = "运营认证成功，系统赠送{:point}积分";
                Userproperty::model()->addPoint($uagent->ua_uid, $config, $description);
            }
            $command=$connection->createCommand($sql);
            $command->execute();
            Invite::model()->inviteUserUagent($uagent->ua_uid);//推荐人奖励
        }
    }
    /**
     * 经纪人头像审核
     */
    public function actionUagentlogo() {
        $dataProvider=new CActiveDataProvider('Uagent',
           array('criteria'=>array(
                                'condition' => 'ua_photoaudit!="1" and ua_photourl!=""',
           ),
        ));
        $this->render('uagentlogo',array(
                'dataProvider'=>$dataProvider,
        ));
    }
    public function actionAuditlogo(){
        $check = (int)$_GET['check'];
        $ucids = explode(',', trim($_GET['id']));
        if( in_array($check, array(1,2)) && $ucids ){
            foreach($ucids as $ucid){
                if( ($Uagent = Uagent::model()->findByPk($ucid) ) ){
                    if($check === 1){//通过
                        $Uagent->ua_photoaudit = 1;
                    }else{
                        $Uagent->ua_photoaudit = 2;
                        @ unlink(PIC_URL.$Uagent->ua_photourl);
                        $Uagent->ua_photourl = '';
                    }
                    $Uagent->update();
                }
            }
            echo '1';exit;
        }
        echo '0';exit;
    }

    public function actionBuycombo(){
        if(!empty($_POST)){
            $combo = $_POST['combo'];
            $combotime=$_POST['combotime'];
            $mangeuserid=$_POST['mangeuser'];
            $time = time();
            $model=$this->loadModel();
            $model->ua_combotime=strtotime(date('Ymd'))+86400+$combotime*2592000;//86400*30=2592000
            $model->ua_combo=$combo;
            $model->ua_muid=$mangeuserid;
            $model->update();
            //给套餐资料表插入详细资料
            $combolog=new Combolog;
            $content=Combo::model()->findByPk($combo)->cb_name;
            $oldcombo=Combolog::model()->find("cbl_endtime>".time()." and cbl_uid=".$model->ua_uid);
            if($oldcombo){
            $oldcombo->cbl_endtime=time();
            $oldcombo->update();
            }
            $starttime=time();
            $uid=$model->ua_uid;
            $endtime=strtotime(date('Ymd'))+86400+$combotime*2592000;//86400*30=2592000
            $combolog->attributes=array("cbl_uid"=>$uid,"cbl_content"=>$content,"cbl_starttime"=>$starttime,"cbl_endtime"=>$endtime,"cbl_muid"=>$mangeuserid);
            $combolog->save();
            Yii::app()->user->setFlash('msg','成功升级！');
            $this->redirect(array("buycombo","id"=>$_GET["id"]));
        }
        $model=$this->loadModel();
        $allCombo = Combo::model()->findAll();
        $combo = array();
        foreach($allCombo as $value){
            $combo[$value->cb_id] = $value->cb_name."  (".$value->cb_comboprice."元/月)";
        }
        $allMangeuser=Manageuser::model()->findAllByAttributes(array("mag_role"=>"2"));
        $mangeuser=array();
        foreach($allMangeuser as $value){
            $mangeuser[$value->mag_userid] = $value->mag_realname."  ("."TEL:".$value->mag_tel.")";
        }
        $this->render('buycombo',array(
            'model'=>$model,
            "combo"=>$combo,
            "mangeuser"=>$mangeuser,
        ));
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
				$this->_model=Uagent::model()->findbyPk($_GET['id']);
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