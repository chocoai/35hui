<?php

class ResidencebaseinfoController extends Controller
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
			array('allow', 
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * 出售住宅
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionSellRelease()
	{
		$baseModel=new Residencebaseinfo();//住宅主表
        $sellModel=new Residencesellinfo();//出租
        $tagModel=new Residencetag();//其它信息
        $userId = Yii::app()->user->id;
        //默认显示上海的行政区
		$districtlist = Region::model()->findAllByAttributes(array('re_parent_id'=>35));
        $loopRecord = Searchcondition::model()->findAllByAttributes(array('sc_parentid'=>Searchcondition::loopTypeId));
        foreach($loopRecord as $record){
            $allLoop[$record->sc_minvalue]=$record->sc_title;
        }
        $releaseNeedMoney=Oprationconfig::model()->getConfigByName('release');
		if(isset($_POST['rbi_communityid']) )
		{
            foreach($_POST as $key=>$value){
                !is_array($value)?$_POST[$key] = trim($value):"";
            }
            $time = time();

            $baseModel->attributes = $_POST;
            $sellModel->attributes = $_POST;
            $tagModel->attributes = $_POST;

            $baseModel->rbi_uid = $userId;
            $baseModel->rbi_rentorsell = 2;//出售
            $baseModel->rbi_releasedate = $time;
            $baseModel->rbi_updatedate = $time;
            $baseModel->rr_validdate = 86400*$baseModel->rr_validdate;
            $tagModel->rt_check = 4;

            //排序积分
            $baseModel->rbi_order = common::getOrderConfig('new');
            if($tagModel->rt_isrecommend) $baseModel->rbi_order += common::getOrderConfig('recommend');
            if($tagModel->rt_ishurry) $baseModel->rbi_order += common::getOrderConfig('hurry');

            if($baseModel->validate()&&$sellModel->validate()){
            //if($baseModel->validate()){
                $picture = $_POST['picture'];
                if(isset($_POST['submit'])&&$_POST['submit']!==null){//提交
                    //计算要扣的新币。
                    $config_0=$releaseNeedMoney['0'];
                    $config_1=$releaseNeedMoney['1'];
                    $config_2=$releaseNeedMoney['2'];
                    $integral=$releaseNeedMoney['3'];
                    $money = $config_0;
                    if($tagModel->rt_isrecommend==1){
                        $money += $config_1;
                    }
                    if($tagModel->rt_ishurry==1){
                        $money += $config_2;
                    }
                    if(User::model()->validateRelease($userId, 1, 3, $money, $tagModel->rt_ishurry, $tagModel->rt_isrecommend)=="success"){//如果验证了可以发布
                        $id = Residencebaseinfo::model()->saveReleseHouse($baseModel, $sellModel, $tagModel, $picture);
                        if($id){
                            //扣除新币。
                            $description = "住宅出售房源".$id."发布成功，扣除{:money}新币";
                            Userproperty::model()->deductMoney($userId, $money ,$description);
                            $description = "住宅出售房源".$id."发布成功，奖励{:point}积分";
                            Userproperty::model()->addPoint($userId, $integral, $description);
                            Medal::model()->piwikMedal($userId, 9, 1);//连续发房源任务
                            Yii::app()->user->setFlash('message','发布住宅出售信息成功！'.CHtml::link("为该房源添加一份全景",array("/manage/subpanorama/index","type"=>4,"id"=>$id),array("style"=>"color:blue")) );

                            $modelUser = User::model()->findByPk($userId);//增加统计数
                            $modelUser->user_housenum=$modelUser->user_housenum+1;
                            $modelUser->user_residencenum=$modelUser->user_residencenum+1;
                            $modelUser->update();
                            $this->redirect(array('manage/sell','sourceType'=>'3'));
                        }
                    }
                }elseif(isset($_POST['sketch'])&&$_POST['sketch']!==null){//保存为草稿
                    $tagModel->rt_check = 8;
                    if(User::model()->validateRelease($userId, 2, 3)=="success"){//如果验证了可以发布
                        if(Residencebaseinfo::model()->saveReleseHouse($baseModel, $sellModel, $tagModel, $picture)){
                            Yii::app()->user->setFlash('message','保存草稿成功！');
                            $this->redirect(array('manage/sell','tag'=>'draft','sourceType'=>'3'));
                        }
                    }
                }
                $this->redirect(array('main/error'));
            }
		}

        $modelSelect = residencebaseinfo::model()->getSelectResidence($userId,2);//曾经选过的小区；
        $this->render('sell',array(
            'model'=>$baseModel,
            'sellModel'=>$sellModel,
            'tagModel'=>$tagModel,
            'districtlist'=>$districtlist,
            "releaseNeedMoney"=>$releaseNeedMoney,
            "modelSelect"=>$modelSelect,
            'allLoop'=>$allLoop,
            'menu'=>'',
		));
	}

    /**
	 * 出售住宅
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionRentRelease()
	{
		$baseModel=new Residencebaseinfo();//住宅主表
        $rentModel=new Residencerentinfo();//出租
        $tagModel=new Residencetag();//其它信息
        //$peitaoModel=new Residencefacilityinfo();
        $userId = Yii::app()->user->id;
        //默认显示上海的行政区
		$districtlist = Region::model()->findAllByAttributes(array('re_parent_id'=>35));
        $loopRecord = Searchcondition::model()->findAllByAttributes(array('sc_parentid'=>Searchcondition::loopTypeId));
        foreach($loopRecord as $record){
            $allLoop[$record->sc_minvalue]=$record->sc_title;
        }
        $releaseNeedMoney=Oprationconfig::model()->getConfigByName('release');
		if(isset($_POST['rbi_communityid']) )
		{
            foreach($_POST as $key=>$value){
                !is_array($value)?$_POST[$key] = trim($value):"";
            }
            $time = time();

            $baseModel->attributes = $_POST;
            $rentModel->attributes = $_POST;
            $tagModel->attributes = $_POST;

            $baseModel->rbi_uid = $userId;
            $baseModel->rbi_rentorsell = 1;//出租
            $baseModel->rbi_releasedate = $time;
            $baseModel->rbi_updatedate = $time;
            $baseModel->rr_validdate = 86400*$baseModel->rr_validdate;
            if(is_array($rentModel->rr_facilities)){
                $rentModel->rr_facilities = implode(',', $rentModel->rr_facilities);
            }
            $tagModel->rt_check = 4;//已发布

            //排序积分
            $baseModel->rbi_order = common::getOrderConfig('new');
            if($tagModel->rt_isrecommend) $baseModel->rbi_order += common::getOrderConfig('recommend');
            if($tagModel->rt_ishurry) $baseModel->rbi_order += common::getOrderConfig('hurry');

            if($baseModel->validate()&&$rentModel->validate()){
                $picture = $_POST['picture'];
                if(isset($_POST['submit'])&&$_POST['submit']!==null){//提交
                    //计算要扣的新币。
                    
                    $config_0=$releaseNeedMoney['0'];
                    $config_1=$releaseNeedMoney['1'];
                    $config_2=$releaseNeedMoney['2'];
                    $integral=$releaseNeedMoney['3'];
                    $money = $config_0;
                    if($tagModel->rt_isrecommend==1){
                        $money += $config_1;
                    }
                    if($tagModel->rt_ishurry==1){
                        $money += $config_2;
                    }
                    if(User::model()->validateRelease($userId, 1, 3, $money, $tagModel->rt_ishurry, $tagModel->rt_isrecommend)=="success"){//如果验证了可以发布
                        $id = Residencebaseinfo::model()->saveReleseHouse($baseModel, $rentModel, $tagModel, $picture ,0);
                        if($id){
                            //扣除新币。
                            $description = "住宅出租房源".$id."发布成功，扣除{:money}新币";
                            Userproperty::model()->deductMoney($userId, $money ,$description);
                            $description = "住宅出租房源".$id."发布成功，奖励{:point}积分";
                            Userproperty::model()->addPoint($userId, $integral, $description);
                            Medal::model()->piwikMedal($userId, 9, 1);//连续发房源任务
                            Yii::app()->user->setFlash('message','发布住宅出租信息成功！'.CHtml::link("为该房源添加一份全景",array("/manage/subpanorama/index","type"=>4,"id"=>$id,),array("style"=>"color:blue")));

                            $modelUser = User::model()->findByPk($userId);//增加统计数
                            $modelUser->user_housenum=$modelUser->user_housenum+1;
                            $modelUser->user_residencenum=$modelUser->user_residencenum+1;
                            $modelUser->update();
                            $this->redirect(array('manage/rent','sourceType'=>'3'));
                        }
                    }
                }elseif(isset($_POST['sketch'])&&$_POST['sketch']!==null){//保存为草稿
                    $tagModel->rt_check = 8;
                    if(User::model()->validateRelease($userId, 2, 3)=="success"){//如果验证了可以发布
                        if(Residencebaseinfo::model()->saveReleseHouse($baseModel, $rentModel, $tagModel, $picture ,0)){
                            Yii::app()->user->setFlash('message','保存草稿成功！');
                            $this->Redirect(array('manage/rent','tag'=>'draft','sourceType'=>'3'));
                        }
                    }
                }
                $this->redirect(array('main/error'));
            }
		}

        $modelSelect = residencebaseinfo::model()->getSelectResidence($userId,1);//曾经选过的小区；
        $this->render('rent',array(
            'model'=>$baseModel,
            'rentModel'=>$rentModel,
            'tagModel'=>$tagModel,
            "releaseNeedMoney"=>$releaseNeedMoney,
            'districtlist'=>$districtlist,
            'allLoop'=>$allLoop,
            'modelSelect'=>$modelSelect,
            'menu'=>isset($_GET['menu'])? $_GET['menu'] : '',
        ));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionSellUpdate()
	{
        $session = Yii::app()->session;
        if(!Yii::app()->request->isPostRequest){
            $session['remanageurl']=!empty($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'';
        }
		if(!empty($_GET['id'])){
            $id = (int)$_GET['id'];
        }else{
            $this->redirect(array('main/error'));
        }
        $baseModel = Residencebaseinfo::model()->findByPk($id);//住宅主表
        $sellModel = Residencesellinfo::model()->findByAttributes(array("rs_rbiid"=>$id));//出租
        $tagModel  = Residencetag::model()->findByAttributes(array("rt_rbiid"=>$id));
        $userId = Yii::app()->user->id;
        //默认显示上海的行政区
		$districtlist = Region::model()->findAllByAttributes(array('re_parent_id'=>35));
        $loopRecord = Searchcondition::model()->findAllByAttributes(array('sc_parentid'=>Searchcondition::loopTypeId));
        foreach($loopRecord as $record){
            $allLoop[$record->sc_minvalue]=$record->sc_title;
        }
        //修改需要的最少新币
        $updateNeedMoney=Oprationconfig::model()->getConfigByName('updateLoss', '0');
        $releaseNeedMoney=Oprationconfig::model()->getConfigByName('release');

        $hurryNum = User::model()->getOprateState($userId, 4, 3);//急房源数
        $recommendNum = User::model()->getOprateState($userId, 5, 3);//推荐房源数
        if(isset($_POST['rbi_communityid']) )
		{
            foreach($_POST as $key=>$value){
                !is_array($value)?$_POST[$key] = trim($value):"";
            }
            $oldHurry = $tagModel->rt_ishurry;
            $oldRecommend = $tagModel->rt_isrecommend;
            $time = time();
            $baseModel->attributes = $_POST;
            $sellModel->attributes = $_POST;
            $tagModel->attributes = $_POST;
            //计算急房源和推荐房源
            if($oldRecommend!=$tagModel->rt_isrecommend&&$tagModel->rt_isrecommend==1){
                $updateNeedMoney += $releaseNeedMoney[1];
                if($recommendNum[0]-$recommendNum[1]<=0){
                    $this->redirect(array('main/error'));
                }
            }
            if($oldHurry!=$tagModel->rt_ishurry&&$tagModel->rt_ishurry==1){
                $updateNeedMoney += $releaseNeedMoney[2];
                if($hurryNum[0]-$hurryNum[1]<=0){
                    $this->redirect(array('main/error'));
                }
            }
            //其他参数
            $baseModel->rbi_updatedate = $time;
            $baseModel->rr_validdate = 86400*$baseModel->rr_validdate;
            $tagModel->rt_isbuyregion = 0;//修改房源会清除原来的设置版块.
            if($baseModel->validate() && $sellModel->validate()&&$tagModel->validate()){
                if(Userproperty::model()->deductMoney($userId,$updateNeedMoney, Log::$moneyTemplate['4'])){
                    $baseModel->update();
                    $sellModel->update();
                    $tagModel->update();
                    Yii::app()->user->setFlash('message','更新住宅出售信息成功！！');
                }else{
                    Yii::app()->user->setFlash('message','很遗憾！您的新币不足，修改失败！');
                }
                if(!empty($session['remanageurl']))
                    $this->redirect($session['remanageurl']);
                $this->Redirect(array('manage/sell','sourceType'=>'3'));
            }

		}

		$this->render('sellupdate',array(
			'model'=>$baseModel,
            'sellModel'=>$sellModel,
            'tagModel'=>$tagModel,
            'districtlist'=>$districtlist,
            'allLoop'=>$allLoop,
            "updateNeedMoney"=>$updateNeedMoney,
            "releaseNeedMoney"=>$releaseNeedMoney,
            'menu'=>'',
            "hurryNum"=>$hurryNum,
            "recommendNum"=>$recommendNum,
		));
	}
    /**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionRentUpdate()
	{
        $session = Yii::app()->session;
        if(!Yii::app()->request->isPostRequest){
            $session['remanageurl']=!empty($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'';
        }
		if(!empty($_GET['id'])){
            $id = (int)$_GET['id'];
        }else{
            $this->redirect(array('main/error'));
        }
        $baseModel = Residencebaseinfo::model()->findByPk($id);//住宅主表
        $rentModel = Residencerentinfo::model()->findByAttributes(array("rr_rbiid"=>$id));//出租
        $tagModel  = Residencetag::model()->findByAttributes(array("rt_rbiid"=>$id));
        $userId = Yii::app()->user->id;
        //默认显示上海的行政区
		$districtlist = Region::model()->findAllByAttributes(array('re_parent_id'=>35));
        $loopRecord = Searchcondition::model()->findAllByAttributes(array('sc_parentid'=>Searchcondition::loopTypeId));
        foreach($loopRecord as $record){
            $allLoop[$record->sc_minvalue]=$record->sc_title;
        }
        //修改需要的最少新币
        $updateNeedMoney=Oprationconfig::model()->getConfigByName('updateLoss', '0');
        $releaseNeedMoney=Oprationconfig::model()->getConfigByName('release');

        $hurryNum = User::model()->getOprateState($userId, 4, 3);//急房源数
        $recommendNum = User::model()->getOprateState($userId, 5, 3);//推荐房源数
        if(isset($_POST['rbi_communityid']) )
		{
            foreach($_POST as $key=>$value){
                !is_array($value)?$_POST[$key] = trim($value):"";
            }
            $oldHurry = $tagModel->rt_ishurry;
            $oldRecommend = $tagModel->rt_isrecommend;
            $time = time();

            $baseModel->attributes = $_POST;
            $rentModel->attributes = $_POST;
            $tagModel->attributes = $_POST;
            //计算急房源和推荐房源
            if($oldRecommend!=$tagModel->rt_isrecommend&&$tagModel->rt_isrecommend==1){
                $updateNeedMoney += $releaseNeedMoney[1];
                if($recommendNum[0]-$recommendNum[1]<=0){
                    $this->redirect(array('main/error'));
                }
            }
            if($oldHurry!=$tagModel->rt_ishurry&&$tagModel->rt_ishurry==1){
                $updateNeedMoney += $releaseNeedMoney[2];
                if($hurryNum[0]-$hurryNum[1]<=0){
                    $this->redirect(array('main/error'));
                }
            }
            //其他参数
            $baseModel->rbi_updatedate = $time;
            $baseModel->rr_validdate = 86400*$baseModel->rr_validdate;
            $tagModel->rt_isbuyregion = 0;//修改房源会清除原来的设置版块.
            if(is_array($rentModel->rr_facilities)){
                $rentModel->rr_facilities = implode(',', $rentModel->rr_facilities);
            }
            if($baseModel->validate() && $rentModel->validate()&&$tagModel->validate()){
                if(Userproperty::model()->deductMoney($userId,$updateNeedMoney, Log::$moneyTemplate['4'])){
                    $baseModel->update();
                    $rentModel->update();
                    $tagModel->update();
                    Yii::app()->user->setFlash('message','更新住宅出租信息成功！！');
                }else{
                    Yii::app()->user->setFlash('message','很遗憾！您的新币不足，修改失败！');
                }
                if(!empty($session['remanageurl']))
                    $this->redirect($session['remanageurl']);
                $this->Redirect(array('manage/rent','sourceType'=>'3'));
            }

		}

		$this->render('rentupdate',array(
			'model'=>$baseModel,
            'rentModel'=>$rentModel,
            'tagModel'=>$tagModel,
            'districtlist'=>$districtlist,
            'allLoop'=>$allLoop,
            "updateNeedMoney"=>$updateNeedMoney,
            "releaseNeedMoney"=>$releaseNeedMoney,
            'menu'=>isset($_GET['menu'])? $_GET['menu'] : '',
            "hurryNum"=>$hurryNum,
            "recommendNum"=>$recommendNum,
		));
	}

    /**
     * 验证商铺是否可以发布或者保存
     */
    public function actionValidateNum(){
        $userid = Yii::app()->user->id;
        $money = $_GET['money'];
        $hurry = $_GET["hurry"];
        $recommend = $_GET["recommend"];
        $type = 2;
        if($_GET['name']=="submit"){//发布
            $type = 1;
        }
        $return = User::model()->validateRelease($userid, $type, 3, $money, $hurry, $recommend);
        echo $return;
        exit;
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
				$this->_model=Residencebaseinfo::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='residencebaseinfo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
