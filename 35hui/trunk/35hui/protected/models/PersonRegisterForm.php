<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class PersonRegisterForm extends CFormModel
{
    public $username;
    public $password;
    public $repassword;
    public $telephone;
    public $email;
    public $verifyCode;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
                // username and password are required
                array('username, password, repassword, email,telephone', 'required'),
                array('username', 'match', 'pattern'=>'/^[a-zA-Z0-9_]{5,16}$/','message'=>'必须由字母,数字,和"_"组成,长度为5到16位'),//
                //array('password', 'compare', 'compareAttribute'=>'repassword','message'=>'确认密码必须和密码一致'),
                array('repassword', 'compare', 'compareAttribute'=>'password','message'=>'确认密码必须和密码一致'),
                array('email','email'),
                array('password,repassword','length','min'=>6,'max'=>20,'message'=>'密码最少6位,做多20位'),
                array('telephone', 'match', 'pattern'=>'/^1[0-9]{10}$/', 'message'=>'请输入正确的手机号码'),

                array('username','existName'),
                array('email','existEmail'),
                array('telephone','existTelephone'),

                array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
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
                'email'=>'电子邮箱',
                'verifyCode'=>'验证码',
        );
    }

    public function existName()
    {
        $identity = new UserIdentity($this->username, $this->password,1);
        $identity->existname();
        switch ($identity->errorCode) {
            case UserIdentity::ERROR_USERNAME_INVALID:
                $this->addError('username', '该用户名已经存在');
                break;
            case UserIdentity::ERROR_NONE:
                break;
        }
    }
    public function existEmail(){
        $model=User::model()->findByAttributes(array('user_email'=>$this->email));
        if($model){
            $this->addError('email', '该邮箱已经被注册！');
        }
    }
    public function existTelephone(){
        $model=User::model()->findByAttributes(array('user_tel'=>$this->telephone));
        if($model){
            $this->addError('telephone', '该电话号码已经被注册！');
        }
    }
}
