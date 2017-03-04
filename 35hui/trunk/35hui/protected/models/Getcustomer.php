<?php

/**
 * This is the model class for table "{{getcustomer}}".
 *
 * The followings are the available columns in table '{{getcustomer}}':
 * @property integer $gc_id
 * @property integer $gc_type
 * @property integer $gc_rentsell
 * @property integer $gc_regionid
 * @property string $gc_buildname
 * @property integer $gc_floor
 * @property integer $gc_area
 * @property integer $gc_toward
 * @property double $gc_price
 * @property integer $gc_userid
 * @property string $gc_contact
 * @property integer $gc_timestamp
 */
class Getcustomer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Getcustomer the static model class
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
		return '{{getcustomer}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gc_type, gc_rentsell, gc_regionid, gc_buildname, gc_floor, gc_area, gc_toward, gc_price, gc_userid, gc_contact, gc_timestamp', 'required'),
			array('gc_type, gc_rentsell, gc_regionid, gc_floor, gc_area, gc_toward, gc_userid, gc_timestamp', 'numerical', 'integerOnly'=>true),
			array('gc_price', 'numerical'),
			array('gc_buildname', 'length', 'max'=>30,'encoding'=>'UTF-8'),
			array('gc_contact', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('gc_id, gc_type, gc_rentsell, gc_regionid, gc_buildname, gc_floor, gc_area, gc_toward, gc_price, gc_userid, gc_contact, gc_timestamp', 'safe', 'on'=>'search'),
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
			'gc_id' => 'Gc',
			'gc_type' => 'Gc Type',
			'gc_rentsell' => 'Gc Rentsell',
			'gc_regionid' => 'Gc Regionid',
			'gc_buildname' => 'Gc Buildname',
			'gc_floor' => 'Gc Floor',
			'gc_area' => 'Gc Area',
			'gc_toward' => 'Gc Toward',
			'gc_price' => 'Gc Price',
			'gc_userid' => 'Gc Userid',
			'gc_contact' => 'Gc Contact',
			'gc_timestamp' => 'Gc Timestamp',
		);
	}
}