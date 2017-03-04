<?php

class Businessbaseinfo extends CActiveRecord
{
	/**
	 * The followings are the available columns in table '{{businessbaseinfo}}':
	 * @var integer $bb_businessid
	 * @var integer $bb_sysid
	 * @var integer $bb_uid
	 * @var integer $bb_businesstype
	 * @var integer $bb_province
	 * @var integer $bb_city
	 * @var string $bb_businessaddress
	 * @var double $bb_buildingarea
	 * @var double $bb_businessprice
	 * @var integer $bb_propertytype
	 * @var integer $bb_companytype
	 * @var double $bb_registerfunds
	 * @var string $bb_mainservice
	 * @var double $bb_turnoverly
	 * @var double $bb_profitly
	 * @var double $bb_salestaxly
	 * @var double $bb_incometaxly
	 * @var double $bb_runtime
	 * @var double $bb_consumptionperson
	 * @var double $bb_staffnum
	 * @var integer $bb_vipnum
	 * @var double $bb_stocktransfer
	 * @var integer $bb_releasedate
	 * @var integer $bb_expiredate
	 * @var integer $bb_titlepicid
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
		return '{{businessbaseinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bb_uid, bb_businesstype, bb_province, bb_city, bb_businessaddress, bb_buildingarea, bb_businessprice, bb_propertytype, bb_companytype, bb_registerfunds, bb_releasedate', 'required'),
			array('bb_sysid, bb_uid, bb_businesstype, bb_province, bb_city, bb_propertytype, bb_companytype, bb_vipnum, bb_releasedate, bb_expiredate, bb_titlepicid', 'numerical', 'integerOnly'=>true),
			array('bb_buildingarea, bb_businessprice, bb_registerfunds, bb_turnoverly, bb_profitly, bb_salestaxly, bb_incometaxly, bb_runtime, bb_consumptionperson, bb_staffnum, bb_stocktransfer', 'numerical'),
			array('bb_businessaddress', 'length', 'max'=>200),
			array('bb_mainservice', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('bb_businessid, bb_sysid, bb_uid, bb_businesstype, bb_province, bb_city, bb_businessaddress, bb_buildingarea, bb_businessprice, bb_propertytype, bb_companytype, bb_registerfunds, bb_mainservice, bb_turnoverly, bb_profitly, bb_salestaxly, bb_incometaxly, bb_runtime, bb_consumptionperson, bb_staffnum, bb_vipnum, bb_stocktransfer, bb_releasedate, bb_expiredate, bb_titlepicid', 'safe', 'on'=>'search'),
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
			'bb_businessid' => 'Bb Businessid',
			'bb_sysid' => 'Bb Sysid',
			'bb_uid' => 'Bb Uid',
			'bb_businesstype' => 'Bb Businesstype',
			'bb_province' => 'Bb Province',
			'bb_city' => 'Bb City',
			'bb_businessaddress' => 'Bb Businessaddress',
			'bb_buildingarea' => 'Bb Buildingarea',
			'bb_businessprice' => 'Bb Businessprice',
			'bb_propertytype' => 'Bb Propertytype',
			'bb_companytype' => 'Bb Companytype',
			'bb_registerfunds' => 'Bb Registerfunds',
			'bb_mainservice' => 'Bb Mainservice',
			'bb_turnoverly' => 'Bb Turnoverly',
			'bb_profitly' => 'Bb Profitly',
			'bb_salestaxly' => 'Bb Salestaxly',
			'bb_incometaxly' => 'Bb Incometaxly',
			'bb_runtime' => 'Bb Runtime',
			'bb_consumptionperson' => 'Bb Consumptionperson',
			'bb_staffnum' => 'Bb Staffnum',
			'bb_vipnum' => 'Bb Vipnum',
			'bb_stocktransfer' => 'Bb Stocktransfer',
			'bb_releasedate' => 'Bb Releasedate',
			'bb_expiredate' => 'Bb Expiredate',
			'bb_titlepicid' => 'Bb Titlepicid',
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

		$criteria->compare('bb_businessid',$this->bb_businessid);

		$criteria->compare('bb_sysid',$this->bb_sysid);

		$criteria->compare('bb_uid',$this->bb_uid);

		$criteria->compare('bb_businesstype',$this->bb_businesstype);

		$criteria->compare('bb_province',$this->bb_province);

		$criteria->compare('bb_city',$this->bb_city);

		$criteria->compare('bb_businessaddress',$this->bb_businessaddress,true);

		$criteria->compare('bb_buildingarea',$this->bb_buildingarea);

		$criteria->compare('bb_businessprice',$this->bb_businessprice);

		$criteria->compare('bb_propertytype',$this->bb_propertytype);

		$criteria->compare('bb_companytype',$this->bb_companytype);

		$criteria->compare('bb_registerfunds',$this->bb_registerfunds);

		$criteria->compare('bb_mainservice',$this->bb_mainservice,true);

		$criteria->compare('bb_turnoverly',$this->bb_turnoverly);

		$criteria->compare('bb_profitly',$this->bb_profitly);

		$criteria->compare('bb_salestaxly',$this->bb_salestaxly);

		$criteria->compare('bb_incometaxly',$this->bb_incometaxly);

		$criteria->compare('bb_runtime',$this->bb_runtime);

		$criteria->compare('bb_consumptionperson',$this->bb_consumptionperson);

		$criteria->compare('bb_staffnum',$this->bb_staffnum);

		$criteria->compare('bb_vipnum',$this->bb_vipnum);

		$criteria->compare('bb_stocktransfer',$this->bb_stocktransfer);

		$criteria->compare('bb_releasedate',$this->bb_releasedate);

		$criteria->compare('bb_expiredate',$this->bb_expiredate);

		$criteria->compare('bb_titlepicid',$this->bb_titlepicid);

		return new CActiveDataProvider('Businessbaseinfo', array(
			'criteria'=>$criteria,
		));
	}
}