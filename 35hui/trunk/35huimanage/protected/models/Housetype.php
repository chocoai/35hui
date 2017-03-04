<?php

/**
 * This is the model class for table "{{housetype}}".
 *
 * The followings are the available columns in table '{{housetype}}':
 * @property integer $ht_id
 * @property integer $ht_sourceid
 * @property integer $ht_sourcetype
 * @property string $ht_description
 * @property integer $ht_pictureid
 * @property integer $ht_panoramaid
 */
class Housetype extends CActiveRecord
{
    /*-- 房源类型 --*/
    /** 楼盘中心 */
    const systembuilding = 1;
    /** 商务中心 */
    const business = 2;
    /*-- 房源类型 --*/
    
	/**
	 * Returns the static model of the specified AR class.
	 * @return Housetype the static model class
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
		return '{{housetype}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ht_id', 'required'),
			array('ht_id, ht_sourceid, ht_sourcetype, ht_pictureid, ht_panoramaid', 'numerical', 'integerOnly'=>true),
			array('ht_description', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ht_id, ht_sourceid, ht_sourcetype, ht_description, ht_pictureid, ht_panoramaid', 'safe', 'on'=>'search'),
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
            'picture'=>array(self::BELONGS_TO,'Picture','ht_pictureid'),
            'panorama'=>array(self::BELONGS_TO,'Panorama','ht_panoramaid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ht_id' => 'Id',
			'ht_sourceid' => '房源Id',
			'ht_sourcetype' => '房源类型',
			'ht_description' => '房型描述',
			'ht_pictureid' => '房型图Id',
			'ht_panoramaid' => '房型图全景Id',
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

		$criteria->compare('ht_id',$this->ht_id);

		$criteria->compare('ht_sourceid',$this->ht_sourceid);

		$criteria->compare('ht_sourcetype',$this->ht_sourcetype);

		$criteria->compare('ht_description',$this->ht_description,true);

		$criteria->compare('ht_pictureid',$this->ht_pictureid);

		$criteria->compare('ht_panoramaid',$this->ht_panoramaid);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}