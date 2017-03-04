<?php

/**
 * This is the model class for table "{{shoprentinfo}}".
 *
 * The followings are the available columns in table '{{shoprentinfo}}':
 * @property integer $sr_id
 * @property integer $sr_shopid
 * @property double $sr_rentprice
 * @property integer $sr_monthrentprice
 * @property integer $sr_iscontainprocost
 * @property integer $sr_renttype
 * @property integer $sr_payway
 * @property double $sr_basetime
 * @property string $sr_paytype
 * @property string $sr_transferprice
 */
class Shoprentinfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Shoprentinfo the static model class
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
		return '{{shoprentinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sr_shopid, sr_rentprice, sr_paytype', 'required'),
			array('sr_shopid, sr_monthrentprice, sr_iscontainprocost, sr_renttype, sr_payway', 'numerical', 'integerOnly'=>true),
			array('sr_rentprice, sr_basetime', 'numerical'),
			array('sr_paytype', 'length', 'max'=>10),
			array('sr_transferprice', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sr_id, sr_shopid, sr_rentprice, sr_monthrentprice, sr_iscontainprocost, sr_renttype, sr_payway, sr_basetime, sr_paytype, sr_transferprice', 'safe', 'on'=>'search'),
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
			'sr_id' => 'Sr',
			'sr_shopid' => 'Sr Shopid',
			'sr_rentprice' => 'Sr Rentprice',
			'sr_monthrentprice' => 'Sr Monthrentprice',
			'sr_iscontainprocost' => 'Sr Iscontainprocost',
			'sr_renttype' => 'Sr Renttype',
			'sr_payway' => 'Sr Payway',
			'sr_basetime' => 'Sr Basetime',
			'sr_paytype' => 'Sr Paytype',
			'sr_transferprice' => 'Sr Transferprice',
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

		$criteria->compare('sr_id',$this->sr_id);

		$criteria->compare('sr_shopid',$this->sr_shopid);

		$criteria->compare('sr_rentprice',$this->sr_rentprice);

		$criteria->compare('sr_monthrentprice',$this->sr_monthrentprice);

		$criteria->compare('sr_iscontainprocost',$this->sr_iscontainprocost);

		$criteria->compare('sr_renttype',$this->sr_renttype);

		$criteria->compare('sr_payway',$this->sr_payway);

		$criteria->compare('sr_basetime',$this->sr_basetime);

		$criteria->compare('sr_paytype',$this->sr_paytype,true);

		$criteria->compare('sr_transferprice',$this->sr_transferprice,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}