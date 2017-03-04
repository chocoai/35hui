<?php

/**
 * This is the model class for table "{{shopsellinfo}}".
 *
 * The followings are the available columns in table '{{shopsellinfo}}':
 * @property integer $ss_id
 * @property integer $ss_shopid
 * @property integer $ss_avgprice
 * @property integer $ss_sumprice
 */
class Shopsellinfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Shopsellinfo the static model class
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
		return '{{shopsellinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ss_avgprice, ss_sumprice', 'required'),
			array('ss_shopid, ss_avgprice', 'numerical', 'integerOnly'=>true),
            array('ss_sumprice', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ss_id, ss_shopid, ss_avgprice, ss_sumprice', 'safe', 'on'=>'search'),
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
			'ss_id' => 'Ss',
			'ss_shopid' => 'Ss Shopid',
			'ss_avgprice' => 'Ss Avgprice',
			'ss_sumprice' => 'Ss Sumprice',
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

		$criteria->compare('ss_id',$this->ss_id);

		$criteria->compare('ss_shopid',$this->ss_shopid);

		$criteria->compare('ss_avgprice',$this->ss_avgprice);

		$criteria->compare('ss_sumprice',$this->ss_sumprice);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}