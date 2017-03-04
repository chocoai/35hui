<?php

class Emailcheck extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Emailcheck the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{emailcheck}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
        //return array();
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ec_userid, ec_token, ec_time', 'required'),
			array('ec_token', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ec_id, ec_userid, ec_token, ec_time, ec_acttime', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ec_id' => 'Ec',
			'ec_userid' => '用户id',
			'ec_token' => 'Ec Token',
			'ec_time' => '创建时间',
			'ec_acttime' => '认证时间',
		);
	}

    /**
     * 注册邮箱验证
     * @param int $userid
     * @param email $email
     * @return bloon
     */
    public function sendEmailCheck($userid, $email){
        $model = Emailcheck::model()->findByAttributes(array("ec_userid"=>$userid));
        if(!$model){
            $token = md5(microtime());
            $model = new Emailcheck();
            $model->ec_userid = $userid;
            $model->ec_token = $token;
            $model->ec_time = time();
            $model->save();
        }else{
            $token = $model->ec_token;
        }
        $subject = '邮箱验证邮件';
        if($model){
            $body = '<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
            $body .="<title>金屋网邮箱认证</title></head><body>";
            $body .= "亲爱的金屋网用户：<br />您在".date("Y年m月d日 H:i",$model->ec_time)."提交了邮箱认证申请。<br />请点击以下链接完成邮箱认证：";
            $body .= Yii::app()->getRequest()->getHostInfo().'/site/checkemail?id='.$model->ec_id.'&token='.$token;
            $body .="<br />（如果您无法点击这个链接，请将此链接复制到浏览器地址栏后访问）<br />";
            $body .="本邮件由系统自动发出，请勿回复。<br />金屋网<br />".date("m月d日 H:i",time());
            $body .="</body></html>";
            Yii::sendMail($email, $subject, $body, true);
            return true;
        }
        return false;
    }

}