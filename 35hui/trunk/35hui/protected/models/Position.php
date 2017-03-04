<?php

/**
 * This is the model class for table "{{position}}".
 *
 * The followings are the available columns in table '{{position}}':
 * @property integer $p_id
 * @property integer $p_pageid
 * @property integer $p_typeid
 * @property integer $p_pagepositionid
 * @property integer $p_pay
 */
class Position extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return position the static model class
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
		return '{{position}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('p_id, p_pageid, p_typeid, p_pagepositionid, p_pay', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('p_id, p_pageid, p_typeid, p_pagepositionid, p_pay', 'safe', 'on'=>'search'),
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
			'p_id' => 'P',
			'p_pageid' => 'P Pageid',
			'p_typeid' => 'P Typeid',
			'p_pagepositionid' => 'P Pagepositionid',
			'p_pay' => 'P Pay',
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

		$criteria->compare('p_id',$this->p_id);

		$criteria->compare('p_pageid',$this->p_pageid);

		$criteria->compare('p_typeid',$this->p_typeid);

		$criteria->compare('p_pagepositionid',$this->p_pagepositionid);

		$criteria->compare('p_pay',$this->p_pay);

		return new CActiveDataProvider('Position', array(
			'criteria'=>$criteria,
		));
	}
}