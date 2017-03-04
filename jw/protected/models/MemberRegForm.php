<?php
class MemberRegForm extends FormModel
{
    public $nickname;
    public $sex;
    public $password;
    public $repassword;
    public $telephone;
    public $email;
    
    public $type;
    public $district;
    public $section;

    public $district_com;
    public $company;

    public $nativeprovince;

    public $jobNumber;
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
                array('nickname, password, email,telephone,nativeprovince', 'required'),
                //array('nickname', 'match', 'pattern'=>'/^[a-zA-Z0-9_]{5,16}$/','message'=>'必须由字母,数字,和"_"组成,长度为5到16位'),//
                array('nickname', 'length','min'=>2,'max'=>20,'message'=>'昵称最少2位,做多20字','encoding'=>'UTF-8'),
                array('repassword', 'compare', 'compareAttribute'=>'password','message'=>'确认密码必须和密码一致'),
                array('email','email'),
                array('password,repassword','length','min'=>6,'max'=>20,'message'=>'密码最少6位,做多20位'),
                array('telephone', 'match', 'pattern'=>'/^1[0-9]{10}$/', 'message'=>'请输入正确的手机号码'),
                array('type,sex,district,section,company,jobNumber','safe'),

                array('nickname','existNickname'),
                array('email','existEmail'),
                array('telephone','existTelephone'),

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
                'sex' => '性别',
                'location' => '所在地',
                'password' => '密码',
                'repassword'=>'确认密码',
                'telephone'=>'联系电话',
                'email'=>'电子邮箱',
                'company' => '所在公司',
                'jobNumber' => '工号',
                'verifyCode'=>'验证码',
        );
    }
    public function init(){
        $this->type = 1;
    }
}
