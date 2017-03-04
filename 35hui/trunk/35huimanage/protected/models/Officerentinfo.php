<?php

/**
 * This is the model class for table "{{officerentinfo}}".
 *
 * The followings are the available columns in table '{{officerentinfo}}':
 * @property integer $or_id
 * @property integer $or_officeid
 * @property double $or_rentprice
 * @property integer $or_monthrentprice
 * @property integer $or_iscontainprocost
 * @property integer $or_renttype
 * @property integer $or_payway
 * @property double $or_basetime
 */
class Officerentinfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Officerentinfo the static model class
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
		return '{{officerentinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('or_officeid, or_rentprice, or_iscontainprocost, or_renttype, or_payway, or_basetime', 'required'),
			array('or_officeid, or_monthrentprice, or_iscontainprocost, or_renttype, or_payway', 'numerical', 'integerOnly'=>true),
			array('or_rentprice, or_basetime', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('or_id, or_officeid, or_rentprice, or_monthrentprice, or_iscontainprocost, or_renttype, or_payway, or_basetime', 'safe', 'on'=>'search'),
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
			'or_id' => 'Or',
			'or_officeid' => 'Or Officeid',
			'or_rentprice' => 'Or Rentprice',
			'or_monthrentprice' => 'Or Monthrentprice',
			'or_iscontainprocost' => 'Or Iscontainprocost',
			'or_renttype' => 'Or Renttype',
			'or_payway' => 'Or Payway',
			'or_basetime' => 'Or Basetime',
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

		$criteria->compare('or_id',$this->or_id);

		$criteria->compare('or_officeid',$this->or_officeid);

		$criteria->compare('or_rentprice',$this->or_rentprice);

		$criteria->compare('or_monthrentprice',$this->or_monthrentprice);

		$criteria->compare('or_iscontainprocost',$this->or_iscontainprocost);

		$criteria->compare('or_renttype',$this->or_renttype);

		$criteria->compare('or_payway',$this->or_payway);

		$criteria->compare('or_basetime',$this->or_basetime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}