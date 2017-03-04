//<?php
//
//class ViewuagentController extends Controller
//{
//
//	const PAGE_SIZE=10;
//
//	/**
//	 * @var CActiveRecord the currently loaded data model instance.
//	 */
//	private $_model;
//    public $layout = 'uagent';
//	/**
//	 * @return array action filters
//	 */
//	public function filters()
//	{
//		return array(
//			'accessControl', // perform access control for CRUD operations
//		);
//	}
//
//	/**
//	 * Specifies the access control rules.
//	 * This method is used by the 'accessControl' filter.
//	 * @return array access control rules
//	 */
//	public function accessRules()
//	{
//		return array(
//			array('allow',  // allow all users to perform 'index' and 'view' actions
//				'actions'=>array('index','uoffice','ushop','ufactory','uresidence','ubusiness','uproject','comlist','recommendframe','uagentrecommend'),
//				'users'=>array('*'),
//			),
//            array('allow',
//				'actions'=>array("showMessage"),
//				'users'=>array('@'),//注册用户都可以使用
//			),
//			array('allow', // allow authenticated user to perform 'create' and 'update' actions
//				'actions'=>array('flushupdatedate','updateinfo','viewIntegral','viewMoney','showpost','buyproduct','recommendindex','sellmanage','rentmanage','unrecommend','recommend','officetagopt','post','shoptagopt','shopflushupdatedate'),
//				'roles'=>array(
//                    Yii::app()->params['agent'],
//                    Yii::app()->params['company'],
//                ),
//			),
//            array('allow', // allow authenticated user to perform 'create' and 'update' actions
//				'actions'=>array('view'),
//				'roles'=>array(
//                    Yii::app()->params['agent'],
//                ),
//			),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			),
//		);
//	}
//    public function actionShowMessage(){
//        $usrid = Yii::app()->user->id;
//        $role = User::model()->getCurrentRole();
//        switch($role) {
//            default:
//                $this->redirect('/site/error');
//                break;
//            case User::personal :
//                $this->layout='personal';
//                break;
//            case User::company :
//                $this->layout='ucom';
//                break;
//            case User::agent :
//                $this->layout='uagent';
//                break;
//        }
//        $this->render('showMessage',array(
//            'menu'=>@$_GET['menu']
//        ));
//    }
//	/**
//	 * Displays a particular model.
//	 */
//	public function actionView(){
//        $usrid = Yii::app()->user->id;
//        // 违规-----
//        $criteria=new CDbCriteria;
//        $criteria->condition = "ob_uid=".$usrid;
//        $criteria->with = array(
//                "offictag" => array(
//                        "condition" => "ot_check=9",
//                ),
//        );
//        $officeReport= Officebaseinfo::model()->findAll($criteria);
//        $countOfficeReport=array(0,0);
//        if($officeReport) {
//            foreach($officeReport as $value) {
//                $value->ob_sellorrent==1 && $countOfficeReport[0]+=1;
//                $value->ob_sellorrent==2 && $countOfficeReport[1]+=1;
//            }
//        }
//        //===
//        $criteria=new CDbCriteria;
//        $criteria->condition = "sb_uid=".$usrid;
//        $criteria->with = array(
//                "shopTag" => array(
//                        "condition" => "st_check=9",
//                ),
//        );
//        $shopReport=Shopbaseinfo::model()->findAll($criteria);
//        $countShopReport=array(0,0);
//        if($shopReport) {
//            foreach($shopReport as $value) {
//                $value->sb_sellorrent==1 && $countShopReport[0]+=1;
//                $value->sb_sellorrent==2 && $countShopReport[1]+=1;
//            }
//        }
//        //===
//        $criteria=new CDbCriteria;
//        $criteria->condition = "rbi_rentorsell=1 and rbi_uid=".$usrid;
//        $criteria->with = array(
//                "residenceTag" => array(
//                        "condition" => "rt_check=9",
//                ),
//        );
//        $countResidenceReport=array(0,0);
//        $countShopReport[0]=Residencebaseinfo::model()->count($criteria);
//        $criteria->condition = "rbi_rentorsell=2 and rbi_uid=".$usrid;
//        $countShopReport[1]=Residencebaseinfo::model()->count($criteria);
//
//        $noRead=Msg::model()->unreadcount($usrid);//未读短消息
//        $pointLogs = Log::model()->getCurrentUserLogsByType(Log::integral);
//        $moneyLogs = Log::model()->getCurrentUserLogsByType(Log::money);
//
//        $notice = Post::model()->getNewestPost();//最新公告
//        $this->render('view',array(
//                'countOfficeReport'=>$countOfficeReport,
//                'countShopReport'=>$countShopReport,
//                'countResidenceReport'=>$countResidenceReport,
//                'noRead'=>$noRead,
//                "pointLogs"=>$pointLogs,
//                "moneyLogs"=>$moneyLogs,
//                "notice"=>$notice,
//        ));
//    }
//    /*
//     * 经纪人推荐页面
//     */
//    public function actionRecommend(){
//        $userId = Yii::app()->user->id;
//        $officeIndex = Uagent::model()->getOfficeIndexRecommend($userId);
//        $shopIndex = Uagent::model()->getShopIndexRecommend($userId);//getResidenceIndexRecommend
//        $residenceIndex = Uagent::model()->getResidenceIndexRecommend($userId);
//        $this->render('recommend',array(
//            'officeIndex'=>$officeIndex,
//            'shopIndex'=>$shopIndex,
//            'residenceIndex'=>$residenceIndex,
//            'menu'=>@$_GET['menu'],
//        ));
//    }
//
//    /*
//     * 经纪人后台推荐
//     */
//    public function actionRecommendIndex(){
//        $indexnum = 6;//设置最多能推荐多少个
//        $usrid = Yii::app()->user->id;
//        if(!empty($_GET['id']) && !empty($_GET['type']) && !in_array($_GET['type'],array('shop','office','residence'))) exit;
//        $type = $_GET['type'];
//        $gID = $_GET['id'];
//        if($type=='shop'){
//            $shop = Shopbaseinfo::model()->findByPk($gID);
//            if($shop!=""&&$shop->sb_uid==$usrid){
//                //查看现在已经推荐了多少个，如果小于给定值，才能执行推荐。
//                $criteria = new CDbCriteria;
//                $criteria->condition = "sb_uid=".$usrid;
//                $criteria->with = array(
//                    'shopTag'=>array(
//                        'condition'=>"st_check=4 and st_ishomepage=1",
//                    ),
//                );
//                $homelist = Shopbaseinfo::model()->findAll($criteria);
//
//                if (count($homelist)<$indexnum){
//                    //得到officetag模型
//                    $model = Shoptag::model()->findbyAttributes(array("st_shopid"=>$gID));
//                    //修改ot_ishomepage字段
//                    $model->st_ishomepage = 1;
//                    if($model->save()){
//                        echo 1;exit;
//                    }
//                }else{
//                    echo 0;exit;
//                }
//            }
//        }elseif($type == 'office'){
//            //先判断用户是否合法。
//            $offi = Officebaseinfo::model()->findByPk($gID);
//            if($offi!=""&&$offi->ob_uid==$usrid){
//                //查看现在已经推荐了多少个，如果小于给定值，才能执行推荐。
//                $criteria = new CDbCriteria;
//                $criteria->condition = "ob_uid=".$usrid." and ob_buildingtype=3";
//                $criteria->with = array(
//                    'offictag'=>array(
//                        'condition'=>"ot_check=4 and ot_ishomepage=1",
//                    ),
//                );
//                $homelist = Officebaseinfo::model()->findAll($criteria);
//                if (count($homelist)<$indexnum){
//                    //得到officetag模型
//                    $model = Officetag::model()->findbyAttributes(array("ot_officeid"=>$gID));
//                    //修改ot_ishomepage字段
//                    $model->ot_ishomepage = 1;
//                    if($model->save()){
//                        echo 1;exit;
//                    }
//                }else{
//                    echo 0;exit;
//                }
//            }
//        }else{
//            //先判断用户是否合法。
//            $residence = Residencebaseinfo::model()->findByPk($gID);
//            if($residence!=""&&$residence->rbi_uid==$usrid){
//                //查看现在已经推荐了多少个，如果小于给定值，才能执行推荐。
//                $criteria = new CDbCriteria;
//                $criteria->condition = "rbi_uid=".$usrid;
//                $criteria->with = array(
//                    'residenceTag'=>array(
//                        'condition'=>"rt_check=4 and rt_ishomepage=1",
//                    ),
//                );
//                $homelist = Residencebaseinfo::model()->findAll($criteria);
//                if (count($homelist)<$indexnum){
//                    //得到officetag模型
//                    $model = Residencetag::model()->findbyAttributes(array("rt_rbiid"=>$gID));
//                    //修改ot_ishomepage字段
//                    $model->rt_ishomepage = 1;
//                    if($model->save()){
//                        echo 1;exit;
//                    }
//                }else{
//                    echo 0;exit;
//                }
//            }
//        }
//    }
//
//
//	/**
//	 * the page for other user to visit
//	 */
//	public function actionIndex()
//	{
//        $this->layout='agent';
//        if(!isset($_GET['uaid'])){
//            $this->Redirect(array("/site/error"));
//        }
//        $model = Uagent::model()->findbyPk($_GET['uaid']);
//        if(!$model){
//            $this->redirect('/site/error');//如果id不对则跳出错误页面
//        }
//
//        $userId = $model->ua_uid;
//        $officeIndex = Uagent::model()->getOfficeIndexRecommend($userId);
//        $shopIndex = Uagent::model()->getShopIndexRecommend($userId);//
//        $residenceIndex = Uagent::model()->getResidenceIndexRecommend($userId);
//        //最近更新
//        $recentUpdate = Uagent::model()->getRecentUpdate($userId);
//        $this->render('index',array(
//            'uaid'=>$_GET['uaid'],
//            'model'=>$model,
//            'officeIndex'=>$officeIndex,
//            'shopIndex'=>$shopIndex,
//            'residenceIndex'=>$residenceIndex,
//            'recentUpdate'=>$recentUpdate,
//        ));
//	}
//	/**
//	 * 经纪人页面中写字楼列表
//	 */
//	public function actionUoffice()
//	{
//        $this->layout='agent';
//        $model = Viewuagent::model()->findbyAttributes(array('ua_id'=>$_GET['uaid']));
//        if($model==""){
//            throw new CHttpException(404,'该经纪人不存在或已被删除！');
////            $this->redirect('/site/error');//如果id不对则跳出错误页面
//        }
//        $userid=$model->user_id;
//
//        $sellorrent = 1;//默认显示出租
//        if(isset($_GET['type'])&&$_GET['type']==2){//显示出售
//            $sellorrent = $_GET['type'];
//        }
//        $criteria = new CDbCriteria();
//        $criteria->condition = 'ob_uid='.$userid." and ob_buildingtype=3 and ob_sellorrent=".$sellorrent;
//        $keyword = empty($_GET['keyword']) ? '' : trim($_GET['keyword']);
//        if( $keyword ){
//            $idArr = @common::getIdsBySphinxSearch($keyword, Yii::app()->params['officeIndex'],"array");
//            $criteria->addInCondition('ob_officeid', $idArr);
//        }
//        $criteria->with = array(
//            "offictag" =>array(
//                "condition"=>"ot_check=4",
//            )
//        );
//        $criteria->order = "ob_releasedate desc";
//        $offiProvider=new CActiveDataProvider('Officebaseinfo', array(
//            'pagination'=>array(
//                'pageSize'=>10,
//            ),
//            'criteria'=>$criteria,
//        ));
//
//        $this->render('uoffice',array(
//            'model'=>$model,
//            'uaid'=>$_GET['uaid'],
//            'sellorrent'=>$sellorrent,
//            'offiProvider'=>$offiProvider,
//        ));
//	}
//
//	/**
//	 * 经纪人页面中商铺列表
//	 */
//	public function actionUshop()
//	{
//         $this->layout='agent';
//        $model = Viewuagent::model()->findbyAttributes(array('ua_id'=>$_GET['uaid']));
//        if($model==""){
//           throw new CHttpException(404,'该经纪人不存在或已被删除！');
//        }
//        $userid=$model->user_id;
//
//        $sellorrent = 1;//默认显示出租
//        if(isset($_GET['type'])&&$_GET['type']==2){//显示出售
//            $sellorrent = $_GET['type'];
//        }
//        $criteria = new CDbCriteria();
//        $criteria->condition = 'sb_uid='.$userid." and sb_sellorrent=".$sellorrent;
//        $keyword = empty($_GET['keyword']) ? '' : trim($_GET['keyword']);
//        if( $keyword ){
//            $idArr = @common::getIdsBySphinxSearch($keyword, Yii::app()->params['shopIndex'],"array");
//            $criteria->addInCondition('sb_shopid', $idArr);
//        }
//        $criteria->with = array(
//            "shopTag" =>array(
//                "condition"=>"st_check=4",
//            )
//        );
//        $criteria->order = "sb_releasedate desc";
//        $shopselllist=new CActiveDataProvider('Shopbaseinfo', array(
//            'pagination'=>array(
//                'pageSize'=>10,
//            ),
//            'criteria'=>$criteria,
//        ));
//        $this->render('ushop',array(
//            'model'=>$model,
//            'uaid'=>$_GET['uaid'],
//            'sellorrent'=>$sellorrent,
//            'shopselllist'=>$shopselllist,
//            'shoprentlist'=>$shopselllist,
//        ));
//	}
//    /**
//	 * 经纪人页面中住宅列表
//	 */
//	public function actionUresidence()
//	{
//         $this->layout='agent';
//        $model = Viewuagent::model()->findbyAttributes(array('ua_id'=>$_GET['uaid']));
//        if($model==""){
//           throw new CHttpException(404,'该经纪人不存在或已被删除！');
//        }
//        $userid=$model->user_id;
//
//        $sellorrent = 1;//默认显示出租
//        if(isset($_GET['type'])&&$_GET['type']==2){//显示出售
//            $sellorrent = 2;
//        }
//        $criteria = new CDbCriteria();
//        $criteria->condition = 'rbi_uid='.$userid." and rbi_rentorsell=".$sellorrent;
//        $keyword = empty($_GET['keyword']) ? '' : trim($_GET['keyword']);
//        if( $keyword ){
//            $idArr = @common::getIdsBySphinxSearch($keyword, Yii::app()->params['residenceIndex'],"array");
//            $criteria->addInCondition('rbi_id', $idArr);
//        }
//        $criteria->with = array(
//            "residenceTag" =>array(
//                "condition"=>"rt_check=4",
//            )
//        );
//        $criteria->order = "rbi_updatedate desc";
//        $residenceData=new CActiveDataProvider('Residencebaseinfo', array(
//            'pagination'=>array(
//                'pageSize'=>10,
//            ),
//            'criteria'=>$criteria,
//        ));
//        $this->render('uresidence',array(
//            'model'=>$model,
//            'uaid'=>$_GET['uaid'],
//            'sellorrent'=>$sellorrent,
//            'residenceData'=>$residenceData,
//        ));
//	}
//
//	/**
//	 * 经纪人页面中生意转让列表
//	 */
//	public function actionUbusiness()
//	{
//		if(isset($_GET['uaid']))
//		{
//			$this->layout='agent';
//			$userid=$_GET['uaid'];
//			$pageNum = 10;
//			$leftpageCriteria = new CDbCriteria(array(
//				'condition'=>'bt_check=4 and bb_expiredate>'.time().' and bb_uid='.$userid,
//				'order'=>'bb_releasedate desc',
//			));
//			$pages = new CPagination(Viewbussell::model()->count($leftpageCriteria));
//	        $pages->pageSize = $pageNum;
//	        $pages->applyLimit($leftpageCriteria);;
//	        $bussellProvider = new CActiveDataProvider('Viewbussell',array(
//	            'pagination'=>$pages,
//	            'criteria'=>$leftpageCriteria,
//	        ));
//	        $pages = new CPagination(Viewbusrent::model()->count($leftpageCriteria));
//	        $busrentProvider = new CActiveDataProvider('Viewbusrent',array(
//	            'pagination'=>$pages,
//	            'criteria'=>$leftpageCriteria,
//	        ));
//	        $this->render('ubusiness',array(
//	        	'uaid'=>$_GET['uaid'],
//	        	'busselllist'=>$bussellProvider,
//				'busrentlist'=>$busrentProvider,
//	        ));
//		}
//	}
//
//	/**
//	 * 经纪人页面中工厂厂房列表
//	 */
//	public function actionUfactory()
//	{
//		if(isset($_GET['uaid']))
//		{
//			$this->layout='agent';
//			$userid=$_GET['uaid'];
//			$pageNum = 10;
//			$leftpageCriteria = new CDbCriteria(array(
//				'condition'=>'ft_check=4 and fb_expiredate>'.time().' and fb_uid='.$userid,
//				'order'=>'fb_releasedate desc',
//			));
//			$pages = new CPagination(Viewfactsell::model()->count($leftpageCriteria));
//	        $pages->pageSize = $pageNum;
//	        $pages->applyLimit($leftpageCriteria);;
//	        $factsellProvider = new CActiveDataProvider('Viewfactsell',array(
//	            'pagination'=>$pages,
//	            'criteria'=>$leftpageCriteria,
//	        ));
//	        $pages = new CPagination(Viewfactrent::model()->count($leftpageCriteria));
//	        $factrentProvider = new CActiveDataProvider('Viewfactrent',array(
//	            'pagination'=>$pages,
//	            'criteria'=>$leftpageCriteria,
//	        ));
//	        $this->render('ufactory',array(
//	        	'uaid'=>$_GET['uaid'],
//	        	'factselllist'=>$factsellProvider,
//				'factrentlist'=>$factrentProvider,
//	        ));
//		}
//	}
//
//	/**
//	 * 经纪人页面中大型项目列表
//	 */
//	public function actionUproject()
//	{
//		if(isset($_GET['uaid']))
//		{
//			$this->layout='agent';
//			$userid=$_GET['uaid'];
//			$pageNum = 10;
//			$leftpageCriteria = new CDbCriteria(array(
//				'condition'=>'pt_check=4 and pb_expiredate>'.time().' and pb_uid='.$userid,
//				'order'=>'pb_releasedate desc',
//			));
//			$pages = new CPagination(Viewproject::model()->count($leftpageCriteria));
//	        $pages->pageSize = $pageNum;
//	        $pages->applyLimit($leftpageCriteria);;
//	        $projectProvider = new CActiveDataProvider('Viewproject',array(
//	            'pagination'=>$pages,
//	            'criteria'=>$leftpageCriteria,
//	        ));
//	        $this->render('uproject',array(
//	        	'uaid'=>$_GET['uaid'],
//	        	'prolist'=>$projectProvider,
//	        ));
//		}
//	}
//	/**
//	 * 经纪人页面的服务评价页面，返回这个对于这个经纪人的评论列表
//	 *
//	 */
//	public function actionComlist()
//	{
//            if(isset($_GET['uaid']))
//            {
//                $this->layout='agent';
//                $model = Viewuagent::model()->findbyAttributes(array('ua_id'=>$_GET['uaid']));
//                if($model==""){
//                    throw new CHttpException(404,'该经纪人不存在或已被删除！');//如果id不对则跳出错误页面
//             }
//
//            $comment=$this->newComment($model);
//            $criteria = new CDbCriteria(array(
//                    'condition'=>'uac_agentid='.$_GET['uaid'],
//                    'order'=>'uac_comdate desc',
//            ));
//            $dataProvider=new CActiveDataProvider('Uagentcomment', array(
//                    'pagination'=>array(
//                            'pageSize'=>20,
//                    ),
//                    'criteria'=>$criteria,
//            ));
//            //是否允许评论
//            $myRole = 0;
//            $userModel = User::model()->getUserInfoByPk(Yii::app()->user->id);
//            if($userModel){
//                $myRole=$userModel->user_role;
//            }
//            $this->render('comlist',array(
//                    'model'=>$model,
//                    'uaid'=>$_GET['uaid'],
//                    'comment'=>$comment,
//                    'comlist'=>$dataProvider,
//                    'ifAllowComment'=>$myRole == 1?true:false
//            ));
//            }
//	}
//
//	protected function performAjaxValidation($model) {
//        if(isset($_POST['ajax']) && $_POST['ajax']==='AgentRegister-form') {
//            echo CActiveForm::validate($model);
//            Yii::app()->end();
//        }
//    }
//	/**
//	 * Updates a particular model.
//	 * If update is successful, the browser will be redirected to the 'view' page.
//	 */
//	public function actionUpdateinfo()
//	{
//		$userid = Yii::app()->user->id;
//		$model=Uagent::model()->findByAttributes(array("ua_uid"=>$userid));
//
//        $provincelist = Region::model()->findAllByAttributes(array('re_parent_id'=>0));//从省开始显示
//        $citylist = array();
//        $districtlist = array();
//        $sectionlist = array();
//        if($model->ua_city!=0){
//            $citylist = Region::model()->findAllByAttributes(array('re_parent_id'=>$model->ua_province));
//            if($model->ua_district!=0){
//                $districtlist = Region::model()->findAllByAttributes(array('re_parent_id'=>$model->ua_city));
//                if($model->ua_section!=0){
//                    $sectionlist = Region::model()->findAllByAttributes(array('re_parent_id'=>$model->ua_district));
//                }
//            }
//        }
//
//		if(isset($_POST['Uagent'])){
//			$model->attributes=$_POST['Uagent'];
//			if($model->validate()){
//                $model->save();
//                $model->userInfo->user_mainbusiness=$_POST['mainbusiness'];
//                $model->userInfo->update();
//                Yii::app()->user->setFlash('showMessage','修改用户信息成功！');
//                $this->Redirect(array("/viewuagent/showMessage","menu"=>@$_GET['menu']));
//			}
//		}
//
//		$this->render('update',array(
//			'model'=>$model,
//            'provincelist'=>$provincelist,
//            'citylist'=>$citylist,
//            'districtlist'=>$districtlist,
//            'sectionlist'=>$sectionlist,
//            'menu'=>@$_GET['menu'],
//		));
//	}
//
//	public function actionPost()
//	{
//		$usrid=Yii::app()->user->id;
//		$role=User::model()->getRoleByid($usrid);
//		if($role != Yii::app()->params['agent'])
//		{
//			$this->redirect(array('/site/error'));
//		}
//		$uagent=Uagent::model()->find('ua_uid='.$usrid);
//		if(isset($_POST['Uagent']))
//		{
//			$uagent->attributes = $_POST['Uagent'];
//			 if($uagent->validate()){
//			 	$uagent->save();
//                Yii::app()->user->setFlash('showMessage','修改经纪人公告成功！');
//                $this->Redirect(array("/viewuagent/showMessage","menu"=>@$_GET['menu']));
//			 }
//		}
//		$this->render('post',array(
//			'model'=>$uagent,
//            'menu'=>@$_GET['menu'],
//		));
//	}
//	/**
//	 * Deletes a particular model.
//	 * If deletion is successful, the browser will be redirected to the 'index' page.
//	 */
//	public function actionDelete()
//	{
//		if(Yii::app()->request->isPostRequest)
//		{
//			// we only allow deletion via POST request
//
//
//			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//			if(!isset($_POST['ajax']))
//				$this->redirect(array('index'));
//		}
//		else
//			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
//	}
//
//
//
//	/**
//	 * Returns the data model based on the primary key given in the GET variable.
//	 * If the data model is not found, an HTTP exception will be raised.
//	 */
//	public function loadModel()
//	{
//		if($this->_model===null)
//		{
//            $userId = Yii::app()->user->id;
//			if(isset($userId))
//			{
//                $this->_model = Viewuagent::model()->findByAttributes(array('user_id'=>$userId));
//			}
//			if($this->_model===null)
//				throw new CHttpException(404,'The requested page does not exist.');
//		}
//		return $this->_model;
//	}
//
//	/**
//	 *
//	 *
//	 */
//	protected function generateSalt()
//	{
//		return md5(microtime());
//	}
//
//	/**
//	 *
//	 * @param $salt
//	 * @param $pwd
//	 * @return pwdstring
//	 */
//	protected function generatePwd($salt,$pwd)
//	{
//		return md5($salt.$pwd);
//	}
//
//	/**
//	 * Creates a new comment.
//	 * This method attempts to create a new comment based on the user input.
//	 * If the comment is successfully created, the browser will be redirected
//	 * to show the created comment.
//	 * @param Post the post that the new comment belongs to
//	 * @return Comment the comment instance
//	 */
//	protected function newComment($m)
//	{
//		$comment=new Uagentcomment;
//		if(isset($_POST['Uagentcomment']))
//		{
//			$comment->attributes=$_POST['Uagentcomment'];
//			if($m->addComment($comment))
//			{
//				//if($comment->status==Comment::STATUS_PENDING)
//				Yii::app()->user->setFlash('commentSubmitted','Thank you for your comment. ');
//				$this->refresh();
//			}
//		}
//		return $comment;
//	}
//
//    //查看站点公告
//	public function actionShowPost(){
//        //站点公告
//        $stationPost = Post::model()->getAllPostByRole(Post::agent);
//		$this->render('showPost',array(
//            'menu'=>@$_GET['menu'],
//            'stationPost'=>$stationPost
//        ));
//	}
//}
