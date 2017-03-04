<?php

/**
 * This is the model class for table "{{meetrecord}}".
 *
 * The followings are the available columns in table '{{meetrecord}}':
 * @property integer $mr_id
 * @property integer $mr_frid
 * @property string $mr_remark
 * @property string $mr_salesman
 * @property string $mr_time
 */
class Meetrecord extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Meetrecord the static model class
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
		return '{{meetrecord}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mr_frid, mr_crid, mr_remark, mr_salesman, mr_time', 'required'),
			array('mr_frid, mr_crid, mr_time', 'numerical', 'integerOnly'=>true),
			array('mr_salesman', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('mr_id, mr_frid, mr_crid, mr_remark, mr_salesman, mr_time', 'safe', 'on'=>'search'),
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
                     'follow'=>array(self::BELONGS_TO,'Followrecord','mr_frid'),
                     'contact'=>array(self::BELONGS_TO,'Contactrecord','mr_crid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'mr_id' => 'ID',
			'mr_frid' => '跟进业务员',
			'mr_crid' => '联系人',
			'mr_remark' => '备注',
			'mr_salesman' => '面谈业务员',
			'mr_time' => '面谈时间',
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

		$criteria->compare('mr_id',$this->mr_id);

		$criteria->compare('mr_frid',$this->mr_frid);
                
		$criteria->compare('mr_crid',$this->mr_crid);

		$criteria->compare('mr_remark',$this->mr_remark,true);

		$criteria->compare('mr_salesman',$this->mr_salesman,true);

		$criteria->compare('mr_time',$this->mr_time);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}