<?php

/**
 * This is the model class for table "{{officefacilityinfo}}".
 *
 * The followings are the available columns in table '{{officefacilityinfo}}':
 * @property integer $of_id
 * @property integer $of_officeid
 * @property integer $of_carparking
 * @property integer $of_warming
 * @property integer $of_network
 * @property integer $of_elecwater
 * @property integer $of_elevator
 * @property integer $of_lift
 * @property integer $of_gas
 * @property integer $of_aircondition
 * @property integer $of_tv
 * @property integer $of_door
 */
class Officefacilityinfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Officefacilityinfo the static model class
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
		return '{{officefacilityinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('of_officeid', 'required'),
			array('of_officeid, of_carparking, of_warming, of_network, of_elecwater, of_elevator, of_lift, of_gas, of_aircondition, of_tv, of_door', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('of_id, of_officeid, of_carparking, of_warming, of_network, of_elecwater, of_elevator, of_lift, of_gas, of_aircondition, of_tv, of_door', 'safe', 'on'=>'search'),
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
			'of_id' => 'Of',
			'of_officeid' => 'Of Officeid',
			'of_carparking' => 'Of Carparking',
			'of_warming' => 'Of Warming',
			'of_network' => 'Of Network',
			'of_elecwater' => 'Of Elecwater',
			'of_elevator' => 'Of Elevator',
			'of_lift' => 'Of Lift',
			'of_gas' => 'Of Gas',
			'of_aircondition' => 'Of Aircondition',
			'of_tv' => 'Of Tv',
			'of_door' => 'Of Door',
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

		$criteria->compare('of_id',$this->of_id);

		$criteria->compare('of_officeid',$this->of_officeid);

		$criteria->compare('of_carparking',$this->of_carparking);

		$criteria->compare('of_warming',$this->of_warming);

		$criteria->compare('of_network',$this->of_network);

		$criteria->compare('of_elecwater',$this->of_elecwater);

		$criteria->compare('of_elevator',$this->of_elevator);

		$criteria->compare('of_lift',$this->of_lift);

		$criteria->compare('of_gas',$this->of_gas);

		$criteria->compare('of_aircondition',$this->of_aircondition);

		$criteria->compare('of_tv',$this->of_tv);

		$criteria->compare('of_door',$this->of_door);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}