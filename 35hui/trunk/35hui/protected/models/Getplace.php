<?php

/**
 * This is the model class for table "{{getplace}}".
 *
 * The followings are the available columns in table '{{getplace}}':
 * @property integer $gp_id
 * @property integer $gp_type
 * @property integer $gp_rentsell
 * @property integer $gp_regionid
 * @property integer $gp_buildings
 * @property integer $gp_area
 * @property integer $gp_budget
 * @property integer $gp_userid
 * @property string $gp_contact
 * @property integer $gp_timestamp
 */
class Getplace extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Getplace the static model class
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
		return '{{getplace}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gp_type, gp_rentsell, gp_regionid, gp_userid, gp_contact, gp_timestamp', 'required'),
			array('gp_type, gp_rentsell, gp_regionid, gp_userid, gp_timestamp', 'numerical', 'integerOnly'=>true),
			array('gp_contact', 'length', 'max'=>20),
            array('gp_buildings', 'length', 'max'=>40,'encoding'=>'UTF-8'),
            array('gp_area, gp_budget', 'length', 'max'=>21),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('gp_id, gp_type, gp_rentsell, gp_regionid, gp_buildings, gp_area, gp_budget, gp_userid, gp_contact, gp_timestamp', 'safe', 'on'=>'search'),
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
			'gp_id' => 'Gp',
			'gp_type' => 'Gp Type',
			'gp_rentsell' => 'Gp Rentsell',
			'gp_regionid' => 'Gp Regionid',
			'gp_buildings' => 'Gp Buildidings',
			'gp_area' => 'Gp Area',
			'gp_budget' => 'Gp Budget',
			'gp_userid' => 'Gp Userid',
			'gp_contact' => 'Gp Contact',
			'gp_timestamp' => 'Gp Timestamp',
		);
	}

}