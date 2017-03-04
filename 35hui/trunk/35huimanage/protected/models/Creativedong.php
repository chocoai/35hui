<?php

class Creativedong extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Creativedong the static model class
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
		return '{{creativedong}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cd_cpid, cd_lounum', 'required'),
			array('cd_cpid, cd_floornum, cd_liftnum', 'numerical', 'integerOnly'=>true),
			array('cd_area, cd_floorarea, cd_floorheight', 'numerical'),
			array('cd_lounum', 'length', 'max'=>30),
			array('cd_fengearea, cd_form', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cd_id, cd_cpid, cd_lounum, cd_area, cd_floorarea, cd_fengearea, cd_floornum, cd_form, cd_floorheight, cd_liftnum', 'safe', 'on'=>'search'),
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
			'cd_id' => 'Cd',
			'cd_cpid' => '所属园区',
			'cd_lounum' => '楼号',
			'cd_area' => '建筑面积',
			'cd_floorarea' => '单层面积',
			'cd_fengearea' => '分割面积',
			'cd_floornum' => '楼层总数',
			'cd_form' => '大楼形态',
			'cd_floorheight' => '层高',
			'cd_liftnum' => '电梯数量',
		);
	}

}