<?php

class SiteController extends Controller {
    /**
     * Declares class-based actions.
     */
    public $layout='main';
    public function actions() {
        return array(
                // captcha action renders the CAPTCHA image displayed on the contact page
                'captcha'=>array(
                        'class'=>'CCaptchaAction',
                        'backColor'=>0xFFFFFF,
                        'maxLength'=>'4',
                        'minLength'=>'4',
                        'testLimit'=>'30',//三次之后更新验证码
                        "width"=>"50px"
                ),
                // page action renders "static" pages stored under 'protected/views/site/pages'
                // They can be accessed via: index.php?r=site/page&view=FileName
                'page'=>array(
                        'class'=>'CViewAction',
                ),
        );
    }
    public function actionYou(){
        $this->layout = "index";
        $this->render('you');
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $this->layout = "office";
        //友情链接
        if( ($data=Yii::app()->cache->get('siteindex_data'))===false ){
            $data=array();
            $friendLink = Friendlink::model()->getAllFriendLink();
            $data['friendLink']=&$friendLink;
            $seotkd = Seotkd::model()->findByPk(1);
            $data['seotkd']=&$seotkd;
            $uagentNum = Uagent::model()->count();
            $data['uagentNum']=&$uagentNum;

            $criteria=new CDbCriteria;
            $criteria->order = "sp_order";
            $scrollPicture = Scrollpicture::model()->findAll($criteria);
            $data['scrollPicture']=&$uagentNum;

            Yii::app()->cache->set('siteindex_data',$data,Yii::app()->params['dataDurationIndex']);
        }else{
            extract($data);
        }
        //首页公告
//        $newestpost = Post::model()->getIndexPost();
        $this->render('index',array(
                "friendLink"=>$friendLink,
                "seotkd"=>$seotkd,
                "uagentNum"=>$uagentNum,
                "scrollPicture"=>$scrollPicture,
        ));
    }
    /**
     * 改变首页滚动房源
     */
    public function actionChangeIndexScroll(){
        $officeId = $_GET['officeId'];
        $panoId = Officebaseinfo::model()->getPanoIdBySourceId($officeId);
        echo $panoId;
    }
    /**
     * 首页楼盘精选。精选楼盘按照点击数排序
     */
    public function actionBuildExquisite(){
        $sbi_buildtype=isset($_POST['tab']) && $_POST['tab']=='shop'?2:1;
        if(isset($_POST['name'])&&$_POST['name']!=""){
            $data = Systembuildinginfo::model()->getBuildByDistrictName($_POST['name'],4,$sbi_buildtype);
            echo json_encode($data);
        }
        exit;
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        $this->layout="office";
        if(isset($_SERVER["REQUEST_URI"])){//看看是不是后台的错误。如果是就要使用其他的layout
            $find = stripos($_SERVER["REQUEST_URI"], "/manage/");
            if($find!== false){
                $this->layout="frame";
            }
        }
        if($error=Yii::app()->errorHandler->error) {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }else{
            $this->render('error');
        }
    }

    public function actionAjaxRegisterUserName(){
        $name =  strtolower(trim($_GET["name"]));
        $return = 0;//不能使用
        if($name){
            $model = User::model()->findByAttributes(array("user_name"=>$name));
            if(!$model){
                $return = 1;//没有找到，则可以注册
            }
        }
        echo $return;exit;
    }
    public function actionAjaxRegisterEmail(){
        $email = strtolower($_GET["email"]);
        $return = 0;//不能使用。邮件已经被注册
        $model = User::model()->findByAttributes(array("user_email"=>$email));
        if(!$model){
            $return = 1;//没有找到，则可以注册
        }
        echo $return;exit;
    }
    public function actionAjaxRegisterPhone(){
        $tel = $_GET["tel"];
        $return = 0;//不能使用。 电话已经被注册
        $model = User::model()->findByAttributes(array("user_tel"=>$tel));
        if(!$model){
            $return = 1;//没有找到，则可以注册
        }
        echo $return;exit;
    }
    /**
     * Displays the contact page
     */
    public function actionContact() {
        //$veri = $this->createAction('captcha')->getVerifyCode();
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
        $this->layout = "office";
        if(!Yii::app()->user->isGuest){
            $this->redirect(array('site/userindex'));
        }
        $model=new LoginForm;
        if(isset($_POST['LoginForm'])) {
            $model->attributes=$_POST['LoginForm'];
            $model->role = 1;
            $model->rememberMe=false;
            if($model->validate()) {
                $this->mainLogin(1);
                //登录完成之后跳转
            }
        }
        $this->render('login',array('loginSuccess'=>false,'model'=>$model));
    }
    public function actionAgentLogin(){
        $this->layout = "office";
        if(!Yii::app()->user->isGuest){
            $this->redirect(array('site/userindex'));
        }
        $model=new LoginForm;
        if(isset($_POST['LoginForm'])) {
            $model->attributes=$_POST['LoginForm'];
            $model->role = 2;
            $model->rememberMe=false;
            if($model->validate()) {
                $this->mainLogin(1);
                //登录完成之后跳转
            }
        }
        $this->render('agentlogin',array('model'=>$model));
    }
    public function actionloginSuccess(){
        $backUrl=isset($_GET['backUrl']) && $_GET['backUrl']?urldecode($_GET['backUrl']):'/site/userIndex';
        //如果返回的上一页是注册页面，不设置返回链接
        if(stristr($backUrl,$_SERVER['SERVER_NAME'].'/site/register') || stristr($backUrl,$_SERVER['SERVER_NAME'].'/site/registerSuccess')){
            $backUrl='';
        }
        $this->render('loginSuccess',array(
                'backUrl'=>$backUrl
        ));
    }
    public function actionAjaxLogin(){
        $model=new LoginForm;
        $model->rememberMe=false;
        $model->username = $_POST['username'];
        $model->password = $_POST['password'];
        if($model->validate()) {
            $this->mainLogin();
        }else{
            echo "login_fail";//登陆失败
        }
        exit;
    }
    /**
     * 新地标和bbs的登录都在此
     * @param <type> $gotoUserCenter 是否直接去用户管理中心
     */
    public function mainLogin($gotoUserCenter=0){
        User::model()->userLogin($this->get_client_ip());
        //登录bbs
        $cookies = Yii::app()->request->getCookies();
        $bbsid = $cookies["dibiaobbs_auth"]->value;
        echo uc_user_synlogin($bbsid);
        if($gotoUserCenter){
            echo '<script type="text/javascript">window.location.href="/site/userindex"</script>';
        }
    }
    /**
     * Get the client ip
     * @return client ip string
     */
    protected function get_client_ip() {
        if(getenv('HTTP_CLIENT_IP')){
            $client_ip = getenv('HTTP_CLIENT_IP');
        }elseif(getenv('HTTP_X_FORWARDED_FOR')){
            $client_ip = getenv('HTTP_X_FORWARDED_FOR');
        }elseif(getenv('REMOTE_ADDR')){
            $client_ip = getenv('REMOTE_ADDR');
        }else{
            $client_ip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
        }
        return $client_ip;
    }
    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        echo uc_user_synlogout();
        Yii::app()->user->logout();
        echo '<script type="text/javascript">window.location.href="'.$_SERVER['HTTP_REFERER'].'"</script>';
    }

    /**
     * Register a new user ,three roles to chooice
     */
    public function actionRegister() {
        if(isset($_GET['recuid'])){
            $cookie = new CHttpCookie('recuid',(int)$_GET['recuid']);
            $cookie->expire = time()+600;  //推荐有效时间
            Yii::app()->request->cookies['recuid']=$cookie;
        }
        header("Location:/site/personregister");
//        $this->render('register');
    }
    public function actionFindPwd(){
        $this->layout="office";
        $va = va();
        $errors = array();//错误
        $result = false;//失败
        $va->check(array(
                'username'=>array('not_blank'),
                'email'=>array('not_blank','email'),
                'virifyCode'=>array('not_blank'),
                's'=>array()//用来判断是第一次进入还是重复提交
        ));
        if($va->success){
            //获取验证码内容
            $checkVerify = $this->createAction('captcha')->validate($va->valid['virifyCode'],false);
            if($checkVerify){
                //修改用户的密码
                $userModel = User::model()->findByAttributes(array('user_name'=>$va->valid['username']));
                if($userModel){
                    $toEmail = $userModel->user_email;
                    if($toEmail==$va->valid['email']){//证明资料正确
                        $newPassword = rand(111111, 999999);//随机生成一个密码
                        $password = $this->generatePwd($userModel->user_salt,$newPassword);

                        $dba = dba();
                        $dba->execute('UPDATE 35_user SET `user_pwd`=? WHERE `user_id`=?',$password,$userModel->user_id);

                        //发送邮件
                        if($toEmail){;
                            $subject = '新地标用户管理 - 密码找回';
                            $message = "您好!<br/>
                                这是新地标发送给您的密码找回邮件,您的用户名及密码如下: <br/>
                                用户名:".$userModel->user_name." <br/>
                                密码:".$newPassword." <br/>
                                【注意】本邮件为系统自动发送的邮件，请不要回复本邮件。 <br/>
                                谢谢!";
                            $result = common::sendMail($toEmail, $subject, $message);//发邮件
                        }

                    }else{
                        $errors['email'] = "资料不正确";
                    }
                }else{
                    $errors['username'] = "用户名不存在";
                }
            }else{
                $errors['virifyCode']='验证码错误';
            }
        }else{
            if($va->valid['s']==1){
                $errors = $va->error;
            }
        }
        $this->render("findPwd",array(
                'errors'=>$errors,
                'result'=>$result,
        ));
    }
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionPersonregister()
    {
        $this->layout = "office";
        $model=new PersonRegisterForm;
        $this->performAjaxValidationForPersonRegister($model);
        if(isset($_POST['PersonRegisterForm']))
        {
            $regBackUrl=isset($_POST['regBackUrl']) && $_POST['regBackUrl']?$_POST['regBackUrl']:'';
            $model->attributes=$_POST['PersonRegisterForm'];
            $model->email = strtolower($model->email);
            $model->username = strtolower($model->username);
            if($model->validate())
            {
                $connection = Yii::app()->db;

                $salt = $this->generateSalt();//generate  salt
                $pwd = $this->generatePwd($salt,$model->password);
                $time = time();
                $transaction = $connection->beginTransaction();
                try
                {
                    $sql = 'INSERT INTO {{user}} (user_name,user_email,user_tel,user_salt,user_pwd,user_role,user_regtime,user_lasttime) VALUES (:user_name,:user_email,:user_tel,:user_salt,:user_pwd,:user_role,:user_regtime,:user_lasttime)';
                    $command=$connection->createCommand($sql);
                    $command->bindValue(":user_name",$model->username);
                    $command->bindValue(":user_email",$model->email);
                    $command->bindValue(":user_tel",$model->telephone);
                    $command->bindValue(":user_salt",$salt);
                    $command->bindValue(":user_pwd",$pwd);
                    $command->bindValue(":user_role",Yii::app()->params['personal']);
                    $command->bindValue(":user_regtime",$time);
                    $command->bindValue(":user_lasttime",$time);
                    $command->execute();

                    $sql = 'Select LAST_INSERT_ID()';
                    $command=$connection->createCommand($sql);
                    $usrid = $command->queryScalar();

                    $sql = 'INSERT INTO {{unormal}} (puser_uid) VALUES (:puser_uid)';
                    $command=$connection->createCommand($sql);
                    $command->bindValue(":puser_uid",$usrid);
                    $command->execute();

                    //个人用户注册 +15积分与15币
                    $money = 15;
                    $integral = 15;
                    Userproperty::model()->addUserProperty($usrid,$integral,$money);

                    $sql = 'Select LAST_INSERT_ID()';
                    $command=$connection->createCommand($sql);
                    $puserid = $command->queryScalar();

                    $transaction->commit();
                    //注册成功
                    //self::saveInvite($puserid); 个人注册不参与邀请注册
                    Yii::app()->user->setFlash('message','1');
                    $this->redirect(array("site/personregister"));
                }catch(Exception $e){
                    $transaction->rollback();
                }
            }
        }
        $this->render('personregister',array(
                'model'=>$model,
        ));
    }

    protected function performAjaxValidationForPersonRegister($model) {
        if(isset($_POST['ajax']) && $_POST['ajax']==='PersonRegister-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
//
//    public function actionCompanyregister()
//    {
//        header("Location:".DOMAIN);
//        exit;
//        //$this->layout='register';
//        $model=new CompanyRegisterForm;
//
//        $this->performAjaxValidationForCompany($model);
//        if(isset($_POST['CompanyRegisterForm']))
//        {
//            $model->attributes=$_POST['CompanyRegisterForm'];
//            $model->mainbusiness=$_POST['mainbusiness'];
//            $model->pos = $_POST['pos'];//额外添加pos
//            $regBackUrl=isset($_POST['regBackUrl']) && $_POST['regBackUrl']?$_POST['regBackUrl']:'';
//            if($model->validate())
//            {
//                $connection = Yii::app()->db;
//
//                $salt = $this->generateSalt();//generate  salt
//                $pwd = $this->generatePwd($salt,$model->password);
//                $time = time();
//                $transaction = $connection->beginTransaction();
//                try
//                {
//                    $sql = 'INSERT INTO {{user}} (user_name,user_salt,user_pwd,user_role,user_regtime,user_lasttime,user_mainbusiness) VALUES (:user_name,:user_salt,:user_pwd,:user_role,:user_regtime,:user_lasttime,:user_mainbusiness)';
//                    $command=$connection->createCommand($sql);
//                    $command->bindValue(":user_name",$model->username);
//                    $command->bindValue(":user_salt",$salt);
//                    $command->bindValue(":user_pwd",$pwd);
//                    $command->bindValue(":user_role",Yii::app()->params['company']);
//                    $command->bindValue(":user_regtime",$time);
//                    $command->bindValue(":user_lasttime",$time);
//                    $command->bindValue(":user_mainbusiness",$model->mainbusiness);
//                    $command->execute();
//
//                    $sql = 'Select LAST_INSERT_ID()';
//                    $command=$connection->createCommand($sql);
//                    $usrid = $command->queryScalar();
//                    //注册成功
//                    self::saveInvite($usrid);
//                    $sql = 'INSERT INTO {{ucom}} (uc_uid,uc_city,uc_province,uc_district,uc_section,uc_address,uc_fullname,uc_officetel,uc_contact,uc_tel,uc_msn,uc_email,uc_check) VALUES (:uc_uid,:uc_city,:uc_province,:uc_district,:uc_section,:uc_address,:uc_fullname,:uc_officetel,:uc_contact,:uc_tel,:uc_msn,:uc_email,:uc_check)';
//                    $command=$connection->createCommand($sql);
//                    $command->bindValue(":uc_uid",$usrid);
//                    $command->bindValue(":uc_city",$model->city);
//                    $command->bindValue(":uc_province",$model->province);
//                    $command->bindValue(":uc_district",$model->district);
//                    $command->bindValue(":uc_section",$model->section);
//                    $command->bindValue(":uc_address",$model->address);
//                    $command->bindValue(":uc_fullname",$model->fullname);
//                    $command->bindValue(":uc_officetel",$model->officetel);
//                    $command->bindValue(":uc_contact",$model->contact);
//                    $command->bindValue(":uc_tel",$model->tel);
//                    $command->bindValue(":uc_msn",$model->msn);
//                    $command->bindValue(":uc_email",$model->email);
//                    $command->bindValue(":uc_check",0);
//                    $command->execute();
//
//                    $money = 30;
//                    $integral = 30;
//                    //中介公司注册加30积分和新币
//                    Userproperty::model()->addUserProperty($usrid,$integral,$money);
//
//                    $sql = 'Select LAST_INSERT_ID()';
//                    $command=$connection->createCommand($sql);
//                    $ucid = $command->queryScalar();
//
//                    $transaction->commit();
//
//                    $this->redirect(array("site/login"));
//                }
//                catch(Exception $e)
//                {
//                    $transaction->rollback();
//                }
//            }
//        }
//
//        $this->render('companyregister',array(
//                'model'=>$model,
//        ));
//    }
    
    protected function performAjaxValidationForCompany($model) {
        if(isset($_POST['ajax']) && $_POST['ajax']==='CompanyRegister-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAgentregister()
    {
        $this->layout = "office";
        $model=new AgentRegisterForm;
        if(isset($_POST['AgentRegisterForm']))
        {
            $regBackUrl=isset($_POST['regBackUrl']) && $_POST['regBackUrl']?$_POST['regBackUrl']:'';
            $model->attributes=$_POST['AgentRegisterForm'];
            $model->city = 35;
            $model->province = 9;
            $model->email = strtolower($model->email);
            $model->username = strtolower($model->username);
            if($model->validate())
            {
                $connection = Yii::app()->db;
                $salt = $this->generateSalt();//generate  salt
                $pwd = $this->generatePwd($salt,$model->password);
                $time = time();
                $transaction = $connection->beginTransaction();
                try
                {
                    $sql = 'INSERT INTO {{user}} (user_name,user_email,user_tel,user_salt,user_pwd,user_role,user_regtime,user_lasttime,user_mainbusiness) VALUES (:user_name,:user_email,:user_tel,:user_salt,:user_pwd,:user_role,:user_regtime,:user_lasttime,:user_mainbusiness)';
                    $command=$connection->createCommand($sql);
                    $command->bindValue(":user_name",$model->username);
                    $command->bindValue(":user_email",$model->email);
                    $command->bindValue(":user_tel",$model->tel);
                    $command->bindValue(":user_salt",$salt);
                    $command->bindValue(":user_pwd",$pwd);
                    $command->bindValue(":user_role",Yii::app()->params['agent']);
                    $command->bindValue(":user_regtime",$time);
                    $command->bindValue(":user_lasttime",$time);
                    $command->bindValue(":user_mainbusiness",$model->mainbusiness);
                    $command->execute();

                    $sql = 'Select LAST_INSERT_ID()';
                    $command=$connection->createCommand($sql);
                    $usrid = $command->queryScalar();
                    //注册成功
                    self::saveInvite($usrid);
                    $sql = 'INSERT INTO {{uagent}} (ua_uid,ua_city,ua_province,ua_district,ua_section,ua_realname,ua_msn,ua_company,ua_scardid,ua_congyeyear,ua_introduce,ua_check) VALUES (:ua_uid,:ua_city,:ua_province,:ua_district,:ua_section,:ua_realname,:ua_msn,:ua_company,:ua_scardid,:ua_congyeyear,:ua_introduce,:ua_check)';
                    $command=$connection->createCommand($sql);
                    $command->bindValue(":ua_uid",$usrid);
                    $command->bindValue(":ua_city",$model->city);
                    $command->bindValue(":ua_province",$model->province);
                    $command->bindValue(":ua_district",$model->district);
                    $command->bindValue(":ua_section",$model->section);
                    $command->bindValue(":ua_realname",$model->realname);
                    $command->bindValue(":ua_msn",$model->msn);
                    $command->bindValue(":ua_company",$model->company);
                    $command->bindValue(":ua_scardid",$model->scardid);
                    $command->bindValue(":ua_congyeyear",$model->congyeyear);
                    $command->bindValue(":ua_introduce",$model->introduce);
                    $command->bindValue(":ua_check",0);
                    $command->execute();
                    $money = 20;
                    $integral = 20;
                    Userproperty::model()->addUserProperty($usrid,$integral,$money);//添加用户资产记录.注册经纪人添加20积分和20新币

                    $sql = 'Select LAST_INSERT_ID()';
                    $command=$connection->createCommand($sql);
                    $uaid = $command->queryScalar();

                    $transaction->commit();

                    Yii::app()->user->setFlash('message','2');
                    $this->redirect(array("site/agentregister"));
                }catch(Exception $e){
                    $transaction->rollback();
                }
            }
        }

        $sectionlist = array();
        $districtlist = Region::model()->findAllByAttributes(array('re_parent_id'=>35));
        if($model->district!=0){
            $sectionlist = Region::model()->findAllByAttributes(array('re_parent_id'=>$model->district));
        }

        $this->render('agentregister',array(
                'model'=>$model,
                "districtlist"=>$districtlist,
                "sectionlist"=>$sectionlist
        ));
    }
    protected function performAjaxValidationForAgent($model) {
        if(isset($_POST['ajax']) && $_POST['ajax']==='AgentRegister-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function generateSalt()
    {
        return md5(microtime());
    }

    /**
     * ��salt�ֶθ�password����
     * @param $salt
     * @param $pwd
     * @return pwdstring
     */
    protected function generatePwd($salt,$pwd)
    {
        return md5($salt.$pwd);
    }
    /**
     * direct to user's information homepage
     *
     */
    public function actionUserindex() {
        $userRole = User::model()->getCurrentRole();
        switch($userRole) {
            case User::personal:
            case User::company:
            case User::agent:
                $this->redirect(array('/manage'));
                break;
            default:
                $this->redirect(array('/site/error'));
        }
    }

    /**
     *	商务中心首页
     */

    public function actionBusinessindex() {
        $this->redirect(array('officebaseinfo/businessView'));
    }
    /**
     * 写字楼顶部搜索
     */
    public function actionOfficeHeadsearch(){
        if(isset($_POST)){//只接受post传值
            $keyword = urlencode(trim($_POST['kwords']));
            $type = @$_POST['type'];//类型1写字楼2商务中心3楼盘
            $sellorrent = @$_POST['sellorrent'];
            if($type==1){//写字楼
                $action = $sellorrent==1?"rentIndex":"saleIndex";
                $this->redirect(array('officebaseinfo/'.$action,"search"=>'keyword'.$keyword));
            }elseif($type==2){//商务中心
                $this->redirect(array('businesscenter/index',"search"=>'keyword'.$keyword));
            }elseif($type==3){//经纪人搜索房源
                $action = $sellorrent==1?"officerent":"officesale";
                $this->redirect(array('uagent/'.$action,"search"=>'keyword'.$keyword));
            }else{
                $this->redirect(array('systembuildinginfo/buildlist',"search"=>'keyword'.$keyword));
            }
        }else{
            $this->redirect(array('site/index'));
        }
    }
    /**
     * 创意园区顶部搜索
     */
    public function actionCreativeHeadsearch(){
        if(isset($_POST)){//只接受post传值
            $keyword = urlencode(trim($_POST['kwords']));
          if(isset($_POST['creativepark'])&&$_POST['creativepark']=="list"){
            $this->redirect(array('creativeparkbaseinfo/creativelist',"search"=>'keyword'.$keyword));
          }else{
            $this->redirect(array('creativesource/index',"search"=>'keyword'.$keyword));
          }
        }else{
            $this->redirect(array('site/index'));
        }
    }
    /**
     * 商铺顶部搜索
     */
    public function actionShopHeadsearch(){
        if(isset($_POST)){//只接受post传值
            $keyword = urlencode(trim($_POST['kwords']));
            $type = $_POST['type'];//类型1商铺2商业广场
            $sellorrent = $_POST['sellorrent'];
            if($type==1){//商铺
                $action = $sellorrent==1?"rentIndex":"sellIndex";
                $this->redirect(array('shop/'.$action,"search"=>'keyword'.$keyword));
            }else{//商业广场
                $this->redirect(array('systembuildinginfo/shopbuildlist',"search"=>'keyword'.$keyword));
            }
        }else{
            $this->redirect(array('site/index'));
        }
    }
    /**
     * 小区顶部搜索
     */
    public function actionCommunityHeadsearch(){
        if(isset($_POST)){//只接受post传值
            $keyword = urlencode(trim($_POST['kwords']));
            $type = $_POST['type'];//类型1住宅2小区
            $sellorrent = $_POST['sellorrent'];
            if($type==1){//住宅
                $action = $sellorrent==1?"rentIndex":"sellIndex";
                $this->redirect(array('communitybaseinfo/'.$action,"search"=>'keyword'.$keyword));
            }else{//小区
                $this->redirect(array('communitybaseinfo/searchIndex',"search"=>'keyword'.$keyword));
            }
        }else{
            $this->redirect(array('site/index'));
        }
    }
    /*
     * 首页搜索
    */
    public function actionIndexSearch(){
        $param = "";
        if(isset($_GET["search"])){
            $param = urlencode($_GET["search"]);
        }
        if($_GET['type']==1){//写字楼出租
            $this->redirect(array('officebaseinfo/rentIndex',"search"=>$param));
        }elseif($_GET['type']==2){//商铺出租
            $this->redirect(array('shop/rentIndex',"search"=>$param));
        }elseif($_GET['type']==3){//住宅出租
            $this->redirect(array('communitybaseinfo/rentIndex',"search"=>$param));
        }elseif($_GET['type']==4){//写字楼出售
            $this->redirect(array('officebaseinfo/saleIndex',"search"=>$param));
        }elseif($_GET['type']==5){//商铺出售
            $this->redirect(array('shop/sellIndex',"search"=>$param));
        }elseif($_GET['type']==6){//住宅出售
            $this->redirect(array('communitybaseinfo/sellIndex',"search"=>$param));
        }else{//小区
            $this->redirect(array('site/index'));
        }
        $this->redirect(array('site/index'));
    }
    public function actionSearchMenu(){
        $url = isset($_POST['action'])?array($_POST['action']):array("/site/error");
        if(isset($_POST['option'])&&$_POST['option']){//如果传递了option，则表明是后来修改的。多个条件之间已“-”符隔开的类型
            $url["search"] = $_POST['option'].urlencode(trim($_POST[$_POST['option']]));
        }else{
            if($_GET){
                $url = array_merge($url,$_GET);
            }
            foreach($_POST as $key=>$value){
                if($key!="action"){
                    $url[$key] = urlencode(trim($value));
                }
            }
        }
        $this->redirect($url);
    }
    public function actionAboutMore(){
        $this->render("aboutMore");
    }
    /**
     * 保存推荐信息
     */
    public function saveInvite($rc_uid=0){
        $cookie = Yii::app()->request->getCookies();
        if(isset($cookie['recuid']->value)){
            $Invite = new Invite();
            $Invite->rc_recuid=$cookie['recuid']->value;
            $Invite->rc_uid=$rc_uid;
            $Invite->save();
        }
    }
    /**
     * 自动完成
     */
    public function actionAjaxAutoComplete(){
        if(Yii::app()->request->isAjaxRequest && isset($_GET['q'])&&isset($_GET['type'])){
            $cacheTime = 86400;
            //先得到所有数据 $allDate 的格式为array(id, name, egshort, eglong)
            switch($_GET['type']){
                default:
                    $allDate = array();
                    break;
                case 1://楼盘
                    $allDate = Yii::app()->cache->get("autocomplete_system_build");
                    if($allDate==false){
                        $allDate = Systembuildinginfo::model()->getAutoCompleteData(1);
                        Yii::app()->cache->set("autocomplete_system_build",$allDate,$cacheTime);
                    }
                    break;
                case 2://商业广场
                    $allDate = Yii::app()->cache->get("autocomplete_system_shop");
                    if($allDate==false){
                        $allDate = Systembuildinginfo::model()->getAutoCompleteData(2);
                        Yii::app()->cache->set("autocomplete_system_shop",$allDate,$cacheTime);
                    }
                    break;
                case 3://小区
                    $allDate = Yii::app()->cache->get("autocomplete_system_community");
                    if($allDate==false){
                        $allDate = Communitybaseinfo::model()->getAutoCompleteData();
                        Yii::app()->cache->set("autocomplete_system_community",$allDate,$cacheTime);
                    }
                    break;
                case 4://商务中心
                    $allDate = Yii::app()->cache->get("autocomplete_system_businesscenter");
                    if($allDate==false){
                        $allDate = Yii::app()->db->createCommand('SELECT `bc_id` id,`bc_name` name,`bc_pinyinshortname` egshort,`bc_pinyinlongname` eglong FROM `{{businesscenter}}`')->queryAll();
                        Yii::app()->cache->set("autocomplete_system_businesscenter",$allDate,$cacheTime);
                    }
                    break;
                case 5://创意园区
                    $allDate = Yii::app()->cache->get("autocomplete_system_creativeparkbaseinfo");
                    if($allDate==false){
                        $allDate = Yii::app()->db->createCommand('SELECT `cp_id` id,`cp_name` name,`cp_pinyinshortname` egshort,`cp_pinyinlongname` eglong FROM `{{creativeparkbaseinfo}}`')->queryAll();
                        Yii::app()->cache->set("autocomplete_system_creativeparkbaseinfo",$allDate,$cacheTime);
                    }
                    break;
            }

            $name = $_GET['q'];
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

    public function actionSurveyFrame(){
        $this->layout='frame';
        $model = new Msgsurvey;
        $this->performAjaxValidationForSurvey($model);
        if(isset($_POST['Msgsurvey']))
        {
            $model->attributes=$_POST['Msgsurvey'];
            $model->ms_time=time();
            if($model->save()){
                echo "<script>window.parent.closetip()</script>";
                exit;
            }else{
                $model->errors;
            }
        }
        $this->render('surveyFrame',array(
                'model'=>$model,
        ));
    }
    protected function performAjaxValidationForSurvey($model) {
        if(isset($_POST['ajax']) && $_POST['ajax']==='Msgsurvey-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    public function actionSubscribeFrame(){
        $this->layout='frame';
        $type= '';
        $typeId='';
        $model = new Msgsubscribe;
        $this->performAjaxValidationForSubscribe($model);

        if(isset($_POST['Msgsubscribe'])){
            $model->attributes = $_POST['Msgsubscribe'];
            if($model->save()){
                echo "<script>window.parent.closetip()</script>";
                exit;
            }else{
                $model->errors;
            }
        }
        if(isset($_GET['type'])&&isset($_GET['typeId'])){
            $type=$_GET['type'];
            $typeId=$_GET['typeId'];
        }

        $this->render('subscribeFrame',array(
                'model'=>$model,
                'type'=>$type,
                'typeId'=>$typeId,
        ));
    }

    /**
     * 注册提示
     */
    public function actionZhuanti() {
        $this->layout = "index";
        $url=Yii::app()->createUrl("/site/register");
        $this->render('zhuanti',array(
                'url'=>$url,
        ));
    }

    protected function performAjaxValidationForSubscribe($model) {
        if(isset($_POST['ajax']) && $_POST['ajax']==='Msgsubscribe-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    /**
     * 站点调查
     */
    public function actionVote(){
        if(Yii::app()->request->isAjaxRequest ){
            if(!empty($_GET['votes'])){
                $sql="UPDATE {{vote}} SET `vt_num`=`vt_num`+1 WHERE `vt_id` IN(".$_GET['votes']."); ";
                Yii::app()->db->createCommand($sql)->execute();
                $cookie = new CHttpCookie('voted','1');
                $cookie->expire = time()+86400*7;
                Yii::app()->request->cookies['voted']=$cookie;
                exit('ok');
            }
        }
    }

}