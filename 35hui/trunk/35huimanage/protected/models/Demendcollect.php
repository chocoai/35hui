<?php

/**
 * This is the model class for table "{{demendcollect}}".
 *
 * The followings are the available columns in table '{{demendcollect}}':
 * @property integer $dc_id
 * @property string $dc_buildtype
 * @property integer $dc_type
 * @property string $dc_buildname
 * @property string $dc_address
 * @property double $dc_area
 * @property double $dc_price
 * @property string $dc_floor
 * @property string $dc_contactname
 * @property string $dc_register
 * @property integer $dc_time
 * @property string $dc_memo
 * @property string $dc_tel
 * @property string $dc_mobile
 * @property string $dc_email
 * @property string $dc_qq
 */
class Demendcollect extends CActiveRecord
{

    //租售类型
    public static $dc_type = array(
        1=>'出租',
        2=>'出售',
        3=>'求租',
        4=>'求购',
    );
    //房源类型
    public static $dc_buildtype = array(
        1=>'写字楼',
        2=>'商铺',
        3=>'住宅',
    );
    /**
	 * Returns the static model of the specified AR class.
	 * @return Demendcollect the static model class
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
		return '{{demendcollect}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dc_buildname, dc_district, dc_address,dc_type,dc_buildtype, dc_area, dc_floor, dc_contactname, dc_mobile, dc_register, dc_time', 'required'),
			array('dc_floor, dc_type,dc_buildtype, dc_time, dc_province, dc_city, dc_district, dc_section', 'numerical', 'integerOnly'=>true),
			array('dc_area, dc_price', 'numerical'),
			array('dc_buildname, dc_email', 'length', 'max'=>50),
			array('dc_address', 'length', 'max'=>200),
			array('dc_contactname, dc_register', 'length', 'max'=>30),
			array('dc_tel, dc_mobile, dc_qq', 'length', 'max'=>20),
			array('dc_memo', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('dc_id, dc_buildtype, dc_type, dc_buildname, dc_address, dc_area, dc_price, dc_floor, dc_contactname, dc_register, dc_time, dc_memo, dc_tel, dc_mobile, dc_email, dc_qq, dc_province, dc_city, dc_district, dc_section', 'safe', 'on'=>'search'),
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
			'dc_id' => '主键',
			'dc_buildtype' => '房源类型',
			'dc_type' => '租售类型',
			'dc_buildname' => '楼盘/小区名称',
			'dc_province' => '省份',
			'dc_city' => '城市',
			'dc_district' => '区域',
			'dc_section' => '板块',
			'dc_address' => '物业地址',
			'dc_area' => '面积',
			'dc_price' => '价格',
			'dc_floor' => '楼层',
			'dc_contactname' => '联系人姓名',
			'dc_register' => '登记人',
			'dc_time' => '登记时间',
			'dc_memo' => '备注',
			'dc_tel' => '电话号码',
			'dc_mobile' => '手机号码',
			'dc_email' => 'Email',
			'dc_qq' => 'qq号码',
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

		$criteria->compare('dc_id',$this->dc_id);

		$criteria->compare('dc_buildtype',$this->dc_buildtype);

		$criteria->compare('dc_type',$this->dc_type);

		$criteria->compare('dc_buildname',$this->dc_buildname,true);

                $criteria->compare('dc_province',$this->dc_province);

                $criteria->compare('dc_city',$this->dc_city);

                $criteria->compare('dc_district',$this->dc_district);
                
                $criteria->compare('dc_section',$this->dc_section);

		$criteria->compare('dc_address',$this->dc_address,true);

		$criteria->compare('dc_area',$this->dc_area);

		$criteria->compare('dc_price',$this->dc_price);

		$criteria->compare('dc_floor',$this->dc_floor);

		$criteria->compare('dc_contactname',$this->dc_contactname,true);

		$criteria->compare('dc_register',$this->dc_register,true);

		$criteria->compare('dc_time',$this->dc_time);

		$criteria->compare('dc_memo',$this->dc_memo,true);

		$criteria->compare('dc_tel',$this->dc_tel,true);

		$criteria->compare('dc_mobile',$this->dc_mobile,true);

		$criteria->compare('dc_email',$this->dc_email,true);

		$criteria->compare('dc_qq',$this->dc_qq,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}