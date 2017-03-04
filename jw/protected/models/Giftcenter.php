<?php

/**
 * This is the model class for table "{{giftcenter}}".
 *
 * The followings are the available columns in table '{{giftcenter}}':
 * @property integer $gc_id
 * @property string $gc_name
 * @property integer $gc_price
 * @property string $gc_url
 */
class Giftcenter extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Giftcenter the static model class
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
		return '{{giftcenter}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gc_name, gc_price', 'required'),
			array('gc_price', 'numerical', 'integerOnly'=>true),
			array('gc_name, gc_url', 'length', 'max'=>50),
            array("gc_url","file","allowEmpty"=>true,"maxSize"=>"5242880","tooLarge"=>"文件最大允许上传5M","types"=>"jpg","wrongType"=>"请上传jpg格式的图片"),
            array('gc_id, gc_name, gc_price, gc_url', 'safe', 'on'=>'search'),
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
			'gc_id' => 'Gc',
			'gc_name' => '名称',
			'gc_price' => '价格',
			'gc_url' => '地址',
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

		$criteria->compare('gc_id',$this->gc_id);

		$criteria->compare('gc_name',$this->gc_name,true);

		$criteria->compare('gc_price',$this->gc_price);

		$criteria->compare('gc_url',$this->gc_url,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}