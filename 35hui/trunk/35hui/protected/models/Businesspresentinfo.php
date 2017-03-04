<?php

class Businesspresentinfo extends CActiveRecord
{
	/**
	 * The followings are the available columns in table '{{businesspresentinfo}}':
	 * @var integer $bp_id
	 * @var integer $bp_businessid
	 * @var string $bp_businesstitle
	 * @var string $bp_serialnum
	 * @var string $bp_businessdesc
	 * @var string $bp_traffice
	 * @var string $bp_carparking
	 * @var string $bp_facilityaround
	 * @var integer $bp_titlepicurl
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
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
		return '{{businesspresentinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bp_businessid, bp_businesstitle, bp_businessdesc', 'required'),
			array('bp_businessid, bp_titlepicurl', 'numerical', 'integerOnly'=>true),
			array('bp_businesstitle, bp_serialnum, bp_traffice, bp_carparking, bp_facilityaround', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('bp_id, bp_businessid, bp_businesstitle, bp_serialnum, bp_businessdesc, bp_traffice, bp_carparking, bp_facilityaround, bp_titlepicurl', 'safe', 'on'=>'search'),
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
			'bp_id' => 'Bp',
			'bp_businessid' => 'Bp Businessid',
			'bp_businesstitle' => 'Bp Businesstitle',
			'bp_serialnum' => 'Bp Serialnum',
			'bp_businessdesc' => 'Bp Businessdesc',
			'bp_traffice' => 'Bp Traffice',
			'bp_carparking' => 'Bp Carparking',
			'bp_facilityaround' => 'Bp Facilityaround',
			'bp_titlepicurl' => 'Bp Titlepicurl',
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

		$criteria->compare('bp_id',$this->bp_id);

		$criteria->compare('bp_businessid',$this->bp_businessid);

		$criteria->compare('bp_businesstitle',$this->bp_businesstitle,true);

		$criteria->compare('bp_serialnum',$this->bp_serialnum,true);

		$criteria->compare('bp_businessdesc',$this->bp_businessdesc,true);

		$criteria->compare('bp_traffice',$this->bp_traffice,true);

		$criteria->compare('bp_carparking',$this->bp_carparking,true);

		$criteria->compare('bp_facilityaround',$this->bp_facilityaround,true);

		$criteria->compare('bp_titlepicurl',$this->bp_titlepicurl);

		return new CActiveDataProvider('Businesspresentinfo', array(
			'criteria'=>$criteria,
		));
	}
}