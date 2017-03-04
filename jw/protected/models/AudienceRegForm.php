<?php
class AudienceRegForm extends FormModel
{
    public $nickname;
    public $password;
    public $repassword;
    public $email;
    public $district;
    public $nativeprovince;
    public $section;
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
                array('nickname, password, email,district,section,nativeprovince', 'required'),
                //array('nickname', 'match', 'pattern'=>'/^[a-zA-Z0-9_]{5,16}$/','message'=>'必须由字母,数字,和"_"组成,长度为5到16位'),//
                array('nickname', 'length','min'=>2,'max'=>20,'message'=>'昵称最少2位,做多20字','encoding'=>'UTF-8'),
                array('repassword', 'compare', 'compareAttribute'=>'password','message'=>'确认密码必须和密码一致'),
                array('email','email'),
                array('password,repassword','length','min'=>6,'max'=>20,'message'=>'密码最少6位,做多20位'),
                array('nickname','safe'),

                array('nickname','existNickname'),
                array('email','existEmail'),
                array('verifyCode', 'captcha'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
                'nickname' => '昵称',
                'password' => '密码',
                'repassword'=>'确认密码',
                'email'=>'电子邮箱',
                'verifyCode'=>'验证码',
        );
    }
}
