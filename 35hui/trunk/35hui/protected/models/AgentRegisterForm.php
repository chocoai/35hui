<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class AgentRegisterForm extends CFormModel
{
    public $username;
    public $password;
    public $repassword;
    public $province;
    public $city;
    public $district;
    public $section;
    public $realname;
    public $tel;
    public $msn;
    public $email;
    public $company;
    public $scardid;//身份证
    public $verifyCode;
    public $mainbusiness;
    public $congyeyear;
    public $introduce;//个人介绍
    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
                // username and password are required
                array('username, password, repassword, realname, tel, email, company,district,section,mainbusiness,introduce', 'required'),
                array('username', 'match', 'pattern'=>'/^[a-zA-Z][a-zA-Z0-9_]{4,15}$/','message'=>'必须以字母开头,由字母,数字,和"_"组成,长度为5到16位'),
                array('repassword', 'compare', 'compareAttribute'=>'password','message'=>'确认密码必须和密码一致'),
                array('email,msn','email'),
                array('password,repassword','length','min'=>6,'max'=>20,'message'=>'密码最少6位,做多20位'),
                array('tel', 'match', 'pattern'=>'/^1[0-9]{10}$/', 'message'=>'请输入正确的手机号码'),
                array('scardid','length','min'=>18,'max'=>18,'message'=>'身份证号为18位'),

                array('username','existName'),
                array('email','existEmail'),
                array('tel','existTelephone'),

                array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
                array('mainbusiness', 'numerical', 'integerOnly'=>true),
                array('introduce', 'length', 'max'=>1000),
                array('congyeyear', 'safe'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
                'username' => '用户名',
                'password' => '密码',
                'repassword'=>'确认密码',
                'telephone'=>'联系电话',
                'email'=>'Email',
                'district' => '行政区域',
                'section' => '板块',
                'realname' => '真实姓名',
                'tel' => '联系电话',
                'msn' => 'msn',
                'company' => '公司名',
                'scardid' => '身份证号码',
                'verifyCode'=>'验证码',
                'mainbusiness'=>'主营业务',
                'congyeyear'=>'从业日期',
                'introduce'=>'申请理由',
        );
    }

    public function existName()
    {
        $identity=new UserIdentity($this->username,$this->password,2);
        $identity->existname();
        switch ($identity->errorCode)
        {
            case UserIdentity::ERROR_USERNAME_INVALID:
                $this->addError('username','该用户名已经存在');
                break;
            case UserIdentity::ERROR_NONE:
                break;
        }
    }
    public function  existEmail(){
        $userModel=User::model()->findByAttributes(array('user_email'=>$this->email));
        if($userModel){
            $this->addError('email', '该邮箱已经被注册！');
        }
    }
    public function existTelephone(){
        $userModel=User::model()->findByAttributes(array('user_tel'=>$this->tel));
        if($userModel){
            $this->addError('tel', '电话号码已经被注册！');
        }
    }
}
