<?php

/**
 * This is the model class for table "{{residencerentinfo}}".
 *
 * The followings are the available columns in table '{{residencerentinfo}}':
 * @property integer $rr_id
 * @property integer $rr_rbiid
 * @property double $rr_rentprice
 * @property integer $rr_renttype
 * @property integer $rr_rentpay
 * @property integer $rr_rentdetain
 * @property string $rr_facilities
 */
class Residencerentinfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Residencerentinfo the static model class
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
		return '{{residencerentinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rr_rbiid, rr_rentprice, rr_renttype, rr_rentpay, rr_rentdetain', 'required'),
			array('rr_rbiid, rr_renttype, rr_rentpay, rr_rentdetain', 'numerical', 'integerOnly'=>true),
			array('rr_rentprice', 'numerical'),
			array('rr_facilities', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rr_id, rr_rbiid, rr_rentprice, rr_renttype, rr_rentpay, rr_rentdetain, rr_facilities', 'safe', 'on'=>'search'),
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
			'rr_id' => 'Rr',
			'rr_rbiid' => 'Rr Rbiid',
			'rr_rentprice' => 'Rr Rentprice',
			'rr_renttype' => 'Rr Renttype',
			'rr_rentpay' => 'Rr Rentpay',
			'rr_rentdetain' => 'Rr Rentdetain',
			'rr_facilities' => 'Rr Facilities',
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

		$criteria->compare('rr_id',$this->rr_id);

		$criteria->compare('rr_rbiid',$this->rr_rbiid);

		$criteria->compare('rr_rentprice',$this->rr_rentprice);

		$criteria->compare('rr_renttype',$this->rr_renttype);

		$criteria->compare('rr_rentpay',$this->rr_rentpay);

		$criteria->compare('rr_rentdetain',$this->rr_rentdetain);

		$criteria->compare('rr_facilities',$this->rr_facilities,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}