<?php

/**
 * This is the model class for table "{{buyrecord}}".
 *
 * The followings are the available columns in table '{{buyrecord}}':
 * @property integer $br_id
 * @property integer $br_mrid
 * @property integer $br_fcid
 * @property string $br_other
 * @property double $br_amount
 * @property string $br_contractno
 * @property string $br_time
 */
class Buyrecord extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Buyrecord the static model class
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
		return '{{buyrecord}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('br_mrid, br_crid, br_amount, br_contractno, br_time', 'required'),
			array('br_mrid, br_crid, br_fcid, br_time', 'numerical', 'integerOnly'=>true),
			array('br_amount', 'numerical'),
			array('br_other', 'length', 'max'=>500),
			array('br_contractno', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('br_id, br_mrid, br_fcid, br_crid, br_other, br_amount, br_contractno, br_time', 'safe', 'on'=>'search'),
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
                    'meet'=>array(self::BELONGS_TO,'Meetrecord','br_mrid'),
                    'config'=>array(self::BELONGS_TO,'Fundsconfig','br_fcid'),
                    'contact'=>array(self::BELONGS_TO,'Contactrecord','br_crid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'br_id' => 'ID',
			'br_mrid' => '业务员',
			'br_fcid' => '套餐',
			'br_crid' => '关联ID',
			'br_other' => '其它套餐',
			'br_amount' => '成交金额',
			'br_contractno' => '合同编号',
			'br_time' => '购买时间',
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

		$criteria->compare('br_id',$this->br_id);

		$criteria->compare('br_mrid',$this->br_mrid);

		$criteria->compare('br_fcid',$this->br_fcid);

		$criteria->compare('br_crid',$this->br_crid);

		$criteria->compare('br_other',$this->br_other,true);

		$criteria->compare('br_amount',$this->br_amount);

		$criteria->compare('br_contractno',$this->br_contractno,true);

		$criteria->compare('br_time',$this->br_time);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}