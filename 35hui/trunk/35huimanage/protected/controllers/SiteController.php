<?php

class SiteController extends Controller {
    public $defaultAction  = "login";
    //默认用的column1的layout
    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
                // captcha action renders the CAPTCHA image displayed on the contact page
                'captcha'=>array(
                        'class'=>'CCaptchaAction',
                        'backColor'=>0xFFFFFF,
                ),
                // page action renders "static" pages stored under 'protected/views/site/pages'
                // They can be accessed via: index.php?r=site/page&view=FileName
                'page'=>array(
                        'class'=>'CViewAction',
                ),
        );
    }
    /**
     *
     * @param object $action
     * @return bool
     */
    public function beforeAction($action){
        return true;
    }
    /**
     * @return array action filters
     */
    public function filters() {
        return array(
                'accessControl', // perform access control for CRUD operations
        );
    }
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
                array('allow',  // allow all users to perform 'index' and 'view' actions
                        'actions'=>array('index','login','contact','page',"error","pinyin"),
                        'users'=>array('*'),
                ),
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                        'actions'=>array('manageIndex','logout',"changepwd",'trends','hot','AjaxAutoComplete'),
                        'users'=>array('@'),
                ),
                array('deny',  // deny all users
                        'users'=>array('*'),
                ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        if(Yii::app()->user->isGuest) {//没有登录
            $this->redirect(array('site/login'));
        }else {
            $this->redirect(array('site/manageIndex'));
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if( ($error=Yii::app()->errorHandler->error) ) {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model=new ContactForm;
        if(isset($_POST['ContactForm'])) {
            $model->attributes=$_POST['ContactForm'];
            if($model->validate()) {
                $headers="From: {$model->email}\r\nReply-To: {$model->email}";
                mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
                Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact',array('model'=>$model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        if(!Yii::app()->user->isGuest) {//没有登录
            $this->redirect(array('site/manageIndex'));
        }
        $model=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm'])) {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate())
                $this->redirect(array('site/manageIndex'));
        }
        // display the login form
        $this->render('login',array('model'=>$model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
    public function actionManageIndex() {
        $this->layout = 'column2';
        $subpanorama=Subpanorama::model()->count("spn_state=0");//待处理的散拍全景数目
        $uagentphotoaudit=Uagent::model()->count('ua_photoaudit="0" and ua_photourl!=""');//经纪人待通过的头像*
        $uc_logoaudit=Ucom::model()->count('uc_logoaudit="0" and uc_logo!=""');//待处理的中间公司审核**
        $unormallogo=Unormal::model()->count('puser_logoaudit="0" and puser_logopath!=""');//待处理的普通用户审核***
        $user=User::model()->count();//目前的会员总数
        $uagentCheck=Uagent::model()->count("ua_check=0");//待通过的注册经纪人数
        $uagentBcard=Uagent::model()->count('ua_bcardaudit=0 and ua_bcardurl!=""');//待通过的执业认证数
        $uagentScard=Uagent::model()->count("ua_scardaudit=0 and ua_scardurl!=''");//待通过的身份认证数
        $uagentLicense=Uagent::model()->count("ua_licenseaudit=0 and ua_licenseurl!=''");//待通过的运营认证数

        $ucomLicense=Ucom::model()->count("uc_recogniseaudit=0 and uc_recogniseurl!=''");//待通过的运营认证数
        $ucomCheck=Ucom::model()->count("uc_check=0");//待通过的中介公司数目
        $msgrec=Msgrec::model()->count("mr_replay=''");//待回复的意见数目
        $buildcollec=Buildcollect::model()->count("bc_state=0");//待审核的楼盘征集数目
        $creativecollect = Creativecollect::model()->count("cc_state=0");//待审核的创意园征集数目

        $msgrecTotal=Msgrec::model()->count();//意见数目
        $error=Error::model()->count('e_state=0');// 未受理的楼盘纠错
        $buildcollectTotal=Buildcollect::model()->count();// 楼盘征集数目
        $twittersuggest=Twittersuggest::model()->count('ts_type=1');// 待采纳微博信息
        $report=Report::model()->count();// 违规处理
        $applyhighsource = Applyhighsource::model()->count("ahs_status=0");//待处理的房源设优请求
        $correctione = Correction::model()->count("ct_status=0");//房源纠错
        $outdaybuyregion = Buyregion::model()->count("br_status=1 and br_buytime+br_expiredate<".time());//过期未下线的版块精选

        $quickrequire = Quickrequire::model()->count("qrq_check=0 and qrq_settledate>".time());//待审核的创意园征集数目
        $this->render('manageIndex',array(
            "subpanorama"=>$subpanorama,
            "user"=>$user,
            "unormallogo"=>$unormallogo,
            "uc_logoaudit"=>$uc_logoaudit,
            "uagentCheck"=>$uagentCheck,
            "uagentBcard"=>$uagentBcard,
            "uc_logoaudit"=>$uc_logoaudit,
            "uagentScard"=>$uagentScard,
            "uagentLicense"=>$uagentLicense,
            "uagentphotoaudit"=>$uagentphotoaudit,
            "ucomCheck"=>$ucomCheck,
            "ucomLicense"=>$ucomLicense,
            "msgrec"=>$msgrec,
            "buildcollec"=>$buildcollec,
            'creativecollect'=>$creativecollect,
            "msgrecTotal"=>$msgrecTotal,
            "error"=>$error,
            "buildcollectTotal"=>$buildcollectTotal,
            "twittersuggest"=>$twittersuggest,
            "report"=>$report,
            "applyhighsource"=>$applyhighsource,
            "correctione"=>$correctione,
            "outdaybuyregion"=>$outdaybuyregion,
            "quickrequire"=>$quickrequire
        ));
    }
    public function actionChangepwd(){
        $this->layout = 'column2';
        $userId = Yii::app()->user->id;
        $model = Manageuser::model()->findByPk($userId);
        if(isset($_POST)&&$_POST){
            $oldPwd = md5($_POST['mag_oldpassword']);
            $newPwd = md5($_POST['mag_password']);
            if($oldPwd == $model->mag_password){
                $model->mag_password = $newPwd;
                $model->update();
                Yii::app()->user->setFlash('changepwd','修改密码成功！');
                $this->Redirect(array("changepwd"));
            }else{
                $model->addError("mag_password","旧密码输入不正确！");
            }
        }
        $this->render("changepwd",array(
            "model"=>$model,
        ));
    }
    public function actionPinyin(){
        Yii::import('application.common.*');
        $pinyin = new Pinyin;
        $error = array();
        if(isset($_GET['type'])&&$_GET['type']=="2"){//住宅
            $model = Communitybaseinfo::model()->findAll();
            foreach($model as $value){
                $name = trim($value->comy_name);
                $pinYinArray = $pinyin->doWord($name);
                $value->comy_pinyinshortname = $pinYinArray['short'];
                $value->comy_pinyinlongname = $pinYinArray['long'];
                $value->update();
                if(!$value->comy_pinyinshortname){
                    $error[] = $value->comy_id;
                }
            }
        }else{
            $model = Systembuildinginfo::model()->findAll();
            foreach($model as $value){
                $name = trim($value->sbi_buildingname);
                $pinYinArray = $pinyin->doWord($name);
                $value->sbi_pinyinshortname = $pinYinArray['short'];
                $value->sbi_pinyinlongname = $pinYinArray['long'];
                $value->update();
                if(!$value->sbi_pinyinshortname){
                    $error[] = $value->sbi_buildingid;
                }
            }
        }
        
        if($error){
            echo "以下id没有转换成功！<br />";
            print_r($error);
        }else{
            echo "全部转换完成";
        }
        exit;
    }
    public function actionTrends () {
        $this->layout = 'column2';
        $maxSize = 2;//单位MB
        if( ! empty($_FILES)) {
            //print_r($_FILES['trends']);exit;
            $attext = strtolower(substr($_FILES['trends']['name'],strrpos($_FILES['trends']['name'], '.')+1));
            if( ! in_array($attext, array('gif'))) {
                throw new CHttpException(404,'The type of the upload file\'s extensions is not supported.');
            }
            if( ! $_FILES['trends']['size'] > $maxSize*1048576){
                throw new CHttpException(404,'The size of the upload file is out of '.$maxSize.'MB.');
            }
            //array('1'=>'写字楼主页','2'=>'商铺主页','3'=>'住宅主页')
            $targetFiles = array(
                '1'=>'office_trends.gif',
                '2'=>'shop_trends.gif',
                '3'=>'housing_trends.gif',
            );
            $buidtype = $_POST['buidtype'];
            $tempFile = $_FILES['trends']['tmp_name'];
            $path = PIC_PATH.'/attachment/';
            $temp = '';
            foreach($buidtype as $val){
                if(array_key_exists($val, $targetFiles)){
                    if(empty($temp)){
                        move_uploaded_file($tempFile,$path.$targetFiles[$val]);
                        $temp = $path.$targetFiles[$val];
                    }else{
                        copy($temp,$path.$targetFiles[$val]);
                    }
                }
            }
           $this->Redirect(array("/site/index"));
        }
        $this->render('trends');
    }
    /**
     * 个楼盘发布排名
     */
    public function actionHot(){
        $this->layout = 'column2';
        $page=isset($_GET['page'])?((int)$_GET['page']):1;
        $t=isset($_GET['t'])?trim($_GET['t']):'office';
        $typeNames=array('office'=>'写字楼','shop'=>'商铺','zhuzhai'=>'住宅');
        if( !array_key_exists($t, $typeNames))
            $t='office';
        $sr=isset($_GET['sr'])?trim($_GET['sr']):'';
        if(!in_array($sr,array('rent','sell')))
            $sr='';
        $greg=isset($_GET['greg'])?(int)$_GET['greg']:'';
        $connection=Yii::app()->db;
        $sql='SELECT `re_id`,`re_name` FROM `35_region` WHERE `re_parent_id`=35 ORDER BY `re_order`';
        $temp=$connection->createCommand($sql)->queryAll();
        $regions=array();
        foreach ($temp as $region) {
            $regions[$region['re_id']]=$region['re_name'];
        }
        unset($temp,$region);
        $start=($page-1)*10;
        $limit=' LIMIT '.$start.',20';
        if($t=='office'){
            $where='';
            if($sr){
                if($sr=='rent'){
                    $where=' WHERE `ob_sellorrent`=1';
                }else{
                    $where=' WHERE `ob_sellorrent`=2';
                }
            }
            if($greg){
                if($where){
                    $where.=' AND `ob_city`=35 AND `ob_district`='.$greg;
                }else{
                    $where.=' WHERE `ob_city`=35 AND `ob_district`='.$greg;
                }
            }
            $sql='SELECT COUNT(*) AS c,`ob_sysid` AS sysid,`ob_officename` AS name  FROM `{{officebaseinfo}}`'.$where.' GROUP BY `ob_sysid` ORDER BY c DESC'.$limit;
            $sqlc='SELECT COUNT(distinct(`ob_sysid`)) FROM `{{officebaseinfo}}`'.$where;
        }else{
            $where='';
            if($sr){
                if($sr=='rent'){
                    $where=' WHERE t1.`rbi_rentorsell`=1';
                }else{
                    $where=' WHERE t1.`rbi_rentorsell`=2';
                }
            }
            if($greg){
                if($where){
                    $where.=' AND t2.`comy_city`=35 AND t2.`comy_district`='.$greg;
                }else{
                    $where.=' WHERE t2.`comy_city`=35 AND t2.`comy_district`='.$greg;
                }
            }
            $sql='SELECT COUNT(*) AS c,t1.`rbi_communityid` AS sysid,t2.`comy_name` AS name  FROM `{{residencebaseinfo}}` as t1
                LEFT JOIN `{{communitybaseinfo}}` as t2 ON t1.`rbi_communityid`=t2.`comy_id`'.$where.' GROUP BY t1.`rbi_communityid` ORDER BY c DESC'.$limit;
            //$sqlc='SELECT COUNT(distinct(t1.`rbi_communityid`)) FROM `{{residencebaseinfo}}`'.$where;
            $sqlc='SELECT COUNT(distinct(t1.`rbi_communityid`)) FROM`{{residencebaseinfo}}` as t1
                LEFT JOIN `{{communitybaseinfo}}` as t2 ON t1.`rbi_communityid`=t2.`comy_id`'.$where;
        }
        $hots=$connection->createCommand($sql)->queryAll();
        //exit($connection->createCommand($sqlc)->text);
        $count=$connection->createCommand($sqlc)->queryScalar();

        $pages=array();
        $pages['pages']=new CPagination($count);
        $pages['pages']->pageSize=20;
        $this->render('hot',array(
            't'=>$t,
            'greg'=>$greg,
            'regions'=>$regions,
            'sr'=>$sr,
            'hots'=>$hots,
            'pages'=>$pages,
            'typeName'=>$typeNames[$t],
            'summary'=>array(
                'text'=>'',
                '{start}'=>$start,
            ),
        ));
    }
        /**
     * 自动完成
     */
    public function actionAjaxAutoComplete(){
        if(Yii::app()->request->isAjaxRequest && isset($_GET['q'])&&isset($_GET['type'])){
            $cacheTime = 86400;
            //先得到所有数据 $allDate 的格式为array(id, name, egshort, eglong)
            //`sbi_buildingid`，`sbi_buildingname`，`sbi_pinyinshortname`，`sbi_pinyinlongname` FROM `35_systembuildinginfo``sbi_buildtype`
            $allDate = Yii::app()->cache->get("autocomplete_system_build");
            if($allDate==false){
                $allDate = Yii::app()->db->createCommand('SELECT `sbi_buildingid` id,`sbi_buildingname` name,`sbi_pinyinshortname` egshort,`sbi_pinyinlongname` eglong FROM `{{systembuildinginfo}}` WHERE sbi_buildtype=1')->queryAll();
                Yii::app()->cache->set("autocomplete_system_build",$allDate,$cacheTime);
            }

            $name = trim($_GET['q']);
            $limit = min($_GET['limit'], 50);
            $returnVal = '';
            if($allDate){
                $num = 0;
                foreach($allDate as $key=>$value){
                    if($num>$limit){
                        break;
                    }
                    $check = false;
                    if(preg_match ("/".$name."/i", $value['name'])){
                        $check = true;
                    }elseif(preg_match ("/".$name."/i", $value['egshort'])){
                        $check = true;
                    }elseif(preg_match ("/".$name."/i", $value['eglong'])){
                        $check = true;
                    }
                    //如果符合条件
                    if($check){
                        $num += 1;
                        $returnVal .= trim($value['name']).'|'.$value['id']."\n";
                    }
                }
            }
//            return  array("1"=>"asdf");
            echo $returnVal;
        }
    }
}