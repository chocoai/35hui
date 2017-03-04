<?php

/**
 * This is the model class for table "{{ucom}}".
 *
 * The followings are the available columns in table '{{ucom}}':
 * @property integer $uc_id
 * @property integer $uc_uid
 * @property integer $uc_city
 * @property integer $uc_province
 * @property integer $uc_district
 * @property integer $uc_section
 * @property string $uc_address
 * @property string $uc_fullname
 * @property string $uc_officetel
 * @property string $uc_contact
 * @property string $uc_tel
 * @property string $uc_msn
 * @property string $uc_email
 * @property string $uc_recogniseurl
 * @property string $uc_recogniseaudit
 * @property integer $uc_recognisetime
 * @property string $uc_recognisecode
 * @property string $uc_logo
 * @property string $uc_check
 * @property string $uc_post
 */
class Ucom extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Ucom the static model class
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
		return '{{ucom}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uc_uid, uc_city, uc_province, uc_district, uc_section, uc_address, uc_fullname, uc_contact, uc_tel, uc_email', 'required'),
			array('uc_uid, uc_city, uc_province, uc_district, uc_section, uc_recognisetime', 'numerical', 'integerOnly'=>true),
			array('uc_address, uc_recogniseurl, uc_logo', 'length', 'max'=>200),
			array('uc_fullname, uc_msn, uc_email', 'length', 'max'=>50),
			array('uc_officetel, uc_contact, uc_tel, uc_recognisecode', 'length', 'max'=>20),
			array('uc_recogniseaudit, uc_check, uc_post', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('uc_id, uc_uid, uc_city, uc_province, uc_district, uc_section, uc_address, uc_fullname, uc_officetel, uc_contact, uc_tel, uc_msn, uc_email, uc_recogniseurl, uc_recogniseaudit, uc_recognisetime, uc_recognisecode, uc_logo, uc_check, uc_post', 'safe', 'on'=>'search'),
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
            'userInfo'=>array(self::BELONGS_TO,'User','uc_uid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uc_id' => 'Uc',
			'uc_uid' => '用户ID',
			'uc_city' => '城市',
			'uc_province' => '省',
			'uc_district' => '行政区',
			'uc_section' => '板块',
			'uc_address' => '地址',
			'uc_fullname' => '公司名称',
			'uc_officetel' => '固定电话',
			'uc_contact' => '联系人',
			'uc_tel' => '联系人电话',
			'uc_msn' => 'Msn',
			'uc_email' => '邮箱',
			'uc_recogniseurl' => '营业执照',
			'uc_recogniseaudit' => '运营认证',
			'uc_recognisetime' => '营运认证时间',
			'uc_recognisecode' => '营业执照',
			'uc_logo' => 'Logo',
            'uc_logoaudit' => '中介公司 Logo 审核',
			'uc_check' => '审核',
			'uc_post' => '公告',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('uc_id',$this->uc_id);

		$criteria->compare('uc_uid',$this->uc_uid);

		$criteria->compare('uc_city',$this->uc_city);

		$criteria->compare('uc_province',$this->uc_province);

		$criteria->compare('uc_district',$this->uc_district);

		$criteria->compare('uc_section',$this->uc_section);

		$criteria->compare('uc_address',$this->uc_address,true);

		$criteria->compare('uc_fullname',$this->uc_fullname,true);

		$criteria->compare('uc_officetel',$this->uc_officetel,true);

		$criteria->compare('uc_contact',$this->uc_contact,true);

		$criteria->compare('uc_tel',$this->uc_tel,true);

		$criteria->compare('uc_msn',$this->uc_msn,true);

		$criteria->compare('uc_email',$this->uc_email,true);

		$criteria->compare('uc_recogniseurl',$this->uc_recogniseurl,true);

		$criteria->compare('uc_recogniseaudit',$this->uc_recogniseaudit,true);

		$criteria->compare('uc_recognisetime',$this->uc_recognisetime);

		$criteria->compare('uc_recognisecode',$this->uc_recognisecode,true);

		$criteria->compare('uc_logo',$this->uc_logo,true);

		$criteria->compare('uc_check',$this->uc_check,true);

		$criteria->compare('uc_post',$this->uc_post,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     *通过传入的状态，得到文字。
     * @param <type> $state 0,1,2
     * @return <type>
     */
    function getTextByState($state){
        $text = "";
        $state==1?$text="已审核":1;
        $state==2?$text="<font color='red'>审核未通过</font>":1;
        $state==0?$text="未审核":1;
        return $text;
    }

}