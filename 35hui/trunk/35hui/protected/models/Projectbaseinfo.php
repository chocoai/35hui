<?php

class Projectbaseinfo extends CActiveRecord
{
	/**
	 * The followings are the available columns in table '{{projectbaseinfo}}':
	 * @var integer $pb_projectid
	 * @var integer $pb_uid
	 * @var integer $pb_province
	 * @var integer $pb_city
	 * @var string $pb_projcetaddress
	 * @var integer $pb_transactionway
	 * @var double $pb_price
	 * @var integer $pb_releasedate
	 * @var integer $pb_expiredate
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
		return '{{projectbaseinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pb_uid, pb_province, pb_city, pb_transactionway, pb_price, pb_releasedate', 'required'),
			array('pb_uid, pb_province, pb_city, pb_transactionway, pb_releasedate, pb_expiredate', 'numerical', 'integerOnly'=>true),
			array('pb_price', 'numerical'),
			array('pb_projcetaddress', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pb_projectid, pb_uid, pb_province, pb_city, pb_projcetaddress, pb_transactionway, pb_price, pb_releasedate, pb_expiredate', 'safe', 'on'=>'search'),
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
			'pb_projectid' => 'Pb Projectid',
			'pb_uid' => 'Pb Uid',
			'pb_province' => 'Pb Province',
			'pb_city' => 'Pb City',
			'pb_projcetaddress' => 'Pb Projcetaddress',
			'pb_transactionway' => 'Pb Transactionway',
			'pb_price' => 'Pb Price',
			'pb_releasedate' => 'Pb Releasedate',
			'pb_expiredate' => 'Pb Expiredate',
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

		$criteria->compare('pb_projectid',$this->pb_projectid);

		$criteria->compare('pb_uid',$this->pb_uid);

		$criteria->compare('pb_province',$this->pb_province);

		$criteria->compare('pb_city',$this->pb_city);

		$criteria->compare('pb_projcetaddress',$this->pb_projcetaddress,true);

		$criteria->compare('pb_transactionway',$this->pb_transactionway);

		$criteria->compare('pb_price',$this->pb_price);

		$criteria->compare('pb_releasedate',$this->pb_releasedate);

		$criteria->compare('pb_expiredate',$this->pb_expiredate);

		return new CActiveDataProvider('Projectbaseinfo', array(
			'criteria'=>$criteria,
		));
	}
}