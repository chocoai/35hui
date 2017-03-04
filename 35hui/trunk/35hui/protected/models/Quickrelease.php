<?php

/**
 * This is the model class for table "{{quickrelease}}".
 *
 */
class Quickrelease extends CActiveRecord
{
    public $verifyCode;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Quickrelease the static model class
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
		return '{{quickrelease}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('qrl_srtp, qrl_floor, qrl_area, qrl_zhuang, qrl_contact, qrl_tel', 'required'),
            array('qrl_sysid', 'required','message'=>'请从提供的楼盘列表选择楼盘'),
			array('qrl_srtp, qrl_sysid, qrl_floor, qrl_area, qrl_zhuang', 'numerical', 'integerOnly'=>true),
			array('qrl_tel', 'match', 'pattern'=>'/^(13[0-9]|15[0|3|6|7|8|9]|18[8|9])\d{8}$/', 'message'=>'请输入正确的手机号码'),
            array('qrl_contact', 'length', 'max'=>10,'encoding'=>'UTF-8'),
            array('qrl_remark', 'length', 'max'=>255,'encoding'=>'UTF-8'),
            array('verifyCode', 'captcha', 'message'=>'验证码错误'),
            //array('qrl_remark', 'length', 'max'=>140,'encoding'=>'UTF-8'),
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
            'buildname' => array(self::BELONGS_TO, 'Systembuildinginfo', 'qrl_sysid','select'=>'sbi_buildingname'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'qrl_id' => 'ID',
			'qrl_srtp' => '出租或出售',
			'qrl_sysid' => '楼盘',
			'qrl_floor' => '楼层',
			'qrl_area' => '面积',
			'qrl_zhuang' => '装修情况',
			'qrl_toward' => '朝向',
			'qrl_contact' => '联系人',
			'qrl_tel' => '电话',
			'qrl_remark' => '备注',
			'qrl_user' => 'Qrl User',
            'qrl_check' => '',
			'qrl_timestamp' => '提交时间',
		);
	}

}