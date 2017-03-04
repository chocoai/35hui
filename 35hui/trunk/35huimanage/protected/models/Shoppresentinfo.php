<?php

/**
 * This is the model class for table "{{shoppresentinfo}}".
 *
 * The followings are the available columns in table '{{shoppresentinfo}}':
 * @property integer $sp_id
 * @property integer $sp_shopid
 * @property string $sp_shoptitle
 * @property string $sp_serialnum
 * @property string $sp_shopdesc
 * @property integer $sp_titlepicurl
 * @property integer $sp_panoramaid
 */
class Shoppresentinfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Shoppresentinfo the static model class
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
		return '{{shoppresentinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sp_shoptitle, sp_shopdesc', 'required'),
			array('sp_shopid, sp_titlepicurl, sp_panoramaid', 'numerical', 'integerOnly'=>true),
			array('sp_shoptitle', 'length', 'max'=>200),
			array('sp_serialnum', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sp_id, sp_shopid, sp_shoptitle, sp_serialnum, sp_shopdesc, sp_titlepicurl, sp_panoramaid', 'safe', 'on'=>'search'),
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
			'sp_id' => 'Sp',
			'sp_shopid' => 'Sp Shopid',
			'sp_shoptitle' => '标题',
			'sp_serialnum' => '内部序列号',
			'sp_shopdesc' => '描述',
			'sp_titlepicurl' => '标题图',
			'sp_panoramaid' => '全景',
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

		$criteria->compare('sp_id',$this->sp_id);

		$criteria->compare('sp_shopid',$this->sp_shopid);

		$criteria->compare('sp_shoptitle',$this->sp_shoptitle,true);

		$criteria->compare('sp_serialnum',$this->sp_serialnum,true);

		$criteria->compare('sp_shopdesc',$this->sp_shopdesc,true);

		$criteria->compare('sp_titlepicurl',$this->sp_titlepicurl);

		$criteria->compare('sp_panoramaid',$this->sp_panoramaid);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}