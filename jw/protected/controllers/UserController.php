<?php

class UserController extends Controller {
    public $layout='main';

    public function actions() {
        return array(
                // captcha action renders the CAPTCHA image displayed on the contact page
                'captcha'=>array(
                        'class'=>'CCaptchaAction',
                        'backColor'=>0xFFFFFF,
                        'maxLength'=>'6',
                        'minLength'=>'4',
                        'testLimit'=>'3',//三次之后更新验证码
                ),
        );
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionRegister() {
        if(!Yii::app()->user->isGuest)
            $this->redirect(array('/my'));
        $this->render('register');

    }
    /**
     * 观众会员注册
     */
    public function actionAudience() {
        if(!Yii::app()->user->isGuest){
            $this->redirect(array('/my'));
        }
        $model = new AudienceRegForm();
        if(!empty($_POST['nickname'])) {
            $model->attributes=array_map('trim',$_POST);
            if($model->validate()) {
                $time = time();
                $userModel = new User();
                $userModel->u_nickname = $model->nickname;
                $userModel->u_email = $model->email;
                $userModel->u_password = md5($model->password);
                $userModel->u_role = User::ROLE_AUDIENCE;
                $userModel->u_regtime = $time;
                $userModel->u_district = $model->district;
                $userModel->u_section = $model->section;
                $userModel->u_nativeprovince = $model->nativeprovince;
                
                if($userModel->save()){
                    //赠送金币
                    $gold = Config::model()->getValueByKey("register_success");
                    User::model()->addGoldNum($userModel->u_id, $gold, "注册成功！");
                    
                    Emailcheck::model()->sendEmailCheck($userModel->u_id,$userModel->u_email);
                    $this->redirect(array("emailcheck"));
                }
            }
        }
        $this->render('audience',array(
                'model'=>$model,
        ));
    }
    /**
     * 专业会员注册
     */
    public function actionMember() {
        if(!Yii::app()->user->isGuest)
            $this->redirect(array('/my'));
        $model = new MemberRegForm();
        if(!empty($_POST['nickname'])) {
            $model->attributes=array_map('trim',$_POST);
//            print_r($model->attributes);exit;
            if($model->validate()) {
                $transaction = Yii::app()->getDb()->beginTransaction();
                $time = time();
                $saveok = false;
                try {
                    $userModel = new User();
                    $userModel->u_nickname = $model->nickname;
                    $userModel->u_email = $model->email;
                    $userModel->u_password = md5($model->password);
                    $userModel->u_role = User::ROLE_MEMBER;
                    $userModel->u_regtime = $time;
                    $userModel->u_district = $model->district;
                    $userModel->u_section = $model->section;
                    $userModel->u_nativeprovince = $model->nativeprovince;
                    $saveok = $userModel->save();

                    $memberModel = new Member();
                    $memberModel->mem_userid = $userModel->u_id;
                    $memberModel->mem_sex = $model->sex;
                    $memberModel->mem_telephone = $model->telephone;
                    if($model->type==2){
                        $memberModel->mem_company = $model->company;
                        $memberModel->mem_jobnumber = $model->jobNumber;
                    }
                    if($saveok) {
                        $saveok = $memberModel->save();
                        if(!$saveok) {
                            $userModel->delete();
                            exit('注册失败');
                        }
                    }

                    $transaction->commit();
                    //赠送金币
                    $gold = Config::model()->getValueByKey("register_success");
                    User::model()->addGoldNum($userModel->u_id, $gold, "注册成功！");

                    Emailcheck::model()->sendEmailCheck($userModel->u_id,$userModel->u_email);
                    $this->redirect(array("emailcheck"));
                }catch(Exception $e) {
                    $transaction->rollback();
                }
            }
        }
        $this->render('member',array(
                'model'=>$model,
        ));
    }
    public function actionEmailcheck() {
        $this->render("emailcheck");
    }
    
    public function actionNotice() {
        $this->renderText('注册成功');
    }
    /**
     * 重新发送认证邮件
     */
    public function actionReSendCheckMail(){
        $email = $_POST["email"];
        $userModel = User::model()->findByAttributes(array ("u_email"=>$email,"u_emailcheck"=>0));
        $return = "该邮箱已经认证！";
        if($userModel){
            $return = "success";
            Emailcheck::model()->sendEmailCheck($userModel->u_id,$userModel->u_email);
        }
        echo $return;exit;
    }
    public function actionIsused() {
        if(Yii::app()->request->isAjaxRequest) {
            $valid = 'true';
            switch (true) {
                case !empty($_REQUEST['email']):
                    $model=User::model()->find('LOWER(u_email)=?',array(strtolower(trim($_REQUEST['email']))) );
                    if($model)
                        $valid = 'false';
                    break;
                case !empty($_REQUEST['nickname']):
                    $model=User::model()->find('LOWER(u_nickname)=?',array(strtolower(trim($_REQUEST['nickname']))) );
                    if($model)
                        $valid = 'false';
                    break;
                case !empty($_REQUEST['telephone']):
                    $model=Member::model()->findByAttributes(array('mem_telephone'=>trim($_REQUEST['telephone'])));
                    if($model)
                        $valid = 'false';
                    break;
            }
            echo $valid;
        }
    }

    public function actionView() {
        $userModel = User::model()->findByPk($_GET['id']);
        if(!$userModel){
            throw new CHttpException(404,'页面不存在');
        }
        $this->layout = "user";
        $this->uid = $userModel->u_id;

        /*浏览数增加*/
        $cookie = Yii::app()->request->getCookies();
        $arr = array();
        if($cookie["user_view"]&&isset($cookie["user_view"]->value)){
            $arr = explode(",",$cookie["user_view"]->value);
        }
        if(array_search($userModel->u_id,$arr)===false){//没有访问过这个详细，增加访问数
            //增加访问数
            $userModel = User::model()->addVisitNum($userModel);
            //更新cookie
            $arr[] = $userModel->u_id;
            $val = implode(",",$arr);
            $cookie = new CHttpCookie('user_view',$val);
            $cookie->expire = time()+3600;  //有限期1个小时
            Yii::app()->request->cookies['user_view']=$cookie;
        }
        
        $this->render("view",array(
                "userModel"=>$userModel,
        ));
    }
}