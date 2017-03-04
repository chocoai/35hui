<?php

class Factorypresentinfo extends CActiveRecord
{
	/**
	 * The followings are the available columns in table '{{factorypresentinfo}}':
	 * @var integer $fp_id
	 * @var integer $fp_factoryid
	 * @var string $fp_factorytitle
	 * @var string $fp_serialnum
	 * @var string $fp_factorydesc
	 * @var string $fp_traffice
	 * @var string $fp_carparking
	 * @var string $fp_facilityaround
	 * @var integer $fp_titlepicurl
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
		return '{{factorypresentinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fp_factoryid, fp_factorytitle', 'required'),
			array('fp_factoryid, fp_titlepicurl', 'numerical', 'integerOnly'=>true),
			array('fp_factorytitle, fp_serialnum, fp_traffice, fp_carparking', 'length', 'max'=>50),
			array('fp_facilityaround', 'length', 'max'=>200),
			array('fp_factorydesc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fp_id, fp_factoryid, fp_factorytitle, fp_serialnum, fp_factorydesc, fp_traffice, fp_carparking, fp_facilityaround, fp_titlepicurl', 'safe', 'on'=>'search'),
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
			'fp_id' => 'Fp',
			'fp_factoryid' => 'Fp Factoryid',
			'fp_factorytitle' => 'Fp Factorytitle',
			'fp_serialnum' => 'Fp Serialnum',
			'fp_factorydesc' => 'Fp Factorydesc',
			'fp_traffice' => 'Fp Traffice',
			'fp_carparking' => 'Fp Carparking',
			'fp_facilityaround' => 'Fp Facilityaround',
			'fp_titlepicurl' => 'Fp Titlepicurl',
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

		$criteria->compare('fp_id',$this->fp_id);

		$criteria->compare('fp_factoryid',$this->fp_factoryid);

		$criteria->compare('fp_factorytitle',$this->fp_factorytitle,true);

		$criteria->compare('fp_serialnum',$this->fp_serialnum,true);

		$criteria->compare('fp_factorydesc',$this->fp_factorydesc,true);

		$criteria->compare('fp_traffice',$this->fp_traffice,true);

		$criteria->compare('fp_carparking',$this->fp_carparking,true);

		$criteria->compare('fp_facilityaround',$this->fp_facilityaround,true);

		$criteria->compare('fp_titlepicurl',$this->fp_titlepicurl);

		return new CActiveDataProvider('Factorypresentinfo', array(
			'criteria'=>$criteria,
		));
	}
}