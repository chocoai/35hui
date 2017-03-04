<?php

/**
 * This is the model class for table "{{officesellinfo}}".
 *
 * The followings are the available columns in table '{{officesellinfo}}':
 * @property integer $os_id
 * @property integer $os_officeid
 * @property integer $os_avgprice
 * @property integer $os_sumprice
 */
class Officesellinfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Officesellinfo the static model class
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
		return '{{officesellinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('os_officeid, os_avgprice, os_sumprice', 'required'),
			array('os_officeid, os_avgprice, os_sumprice', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('os_id, os_officeid, os_avgprice, os_sumprice', 'safe', 'on'=>'search'),
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
			'os_id' => 'Os',
			'os_officeid' => 'Os Officeid',
			'os_avgprice' => 'Os Avgprice',
			'os_sumprice' => 'Os Sumprice',
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

		$criteria->compare('os_id',$this->os_id);

		$criteria->compare('os_officeid',$this->os_officeid);

		$criteria->compare('os_avgprice',$this->os_avgprice);

		$criteria->compare('os_sumprice',$this->os_sumprice);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}