<?php

/**
 * This is the model class for table "{{followrecord}}".
 *
 * The followings are the available columns in table '{{followrecord}}':
 * @property integer $fr_id
 * @property integer $fr_crid
 * @property string $fr_content
 * @property string $fr_salesman
 * @property string $fr_followtime
 * @property string $fr_remindtime
 * @property string $fr_reservetime
 * @property string $fr_address
 * @property integer $fr_status
 */
class Followrecord extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Followrecord the static model class
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
		return '{{followrecord}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fr_crid, fr_content, fr_salesman, fr_followtime', 'required'),
			array('fr_crid, fr_status, fr_followtime', 'numerical', 'integerOnly'=>true),
			array('fr_salesman', 'length', 'max'=>20),
			array('fr_reservetime,fr_remindtime', 'length', 'max'=>50),
			array('fr_address', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fr_id, fr_crid, fr_content, fr_salesman, fr_followtime, fr_remindtime, fr_reservetime, fr_address, fr_status', 'safe', 'on'=>'search'),
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
                   'contact'=>array(self::BELONGS_TO,'Contactrecord','fr_crid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fr_id' => 'ID',
			'fr_crid' => '跟进联系人',
			'fr_content' => '跟进内容',
			'fr_salesman' => '业务员',
			'fr_followtime' => '跟进时间',
			'fr_remindtime' => '提醒日期',
			'fr_reservetime' => '预约日期',
			'fr_address' => '预约地点',
			'fr_status' => '预约状态',
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

		$criteria->compare('fr_id',$this->fr_id);

		$criteria->compare('fr_crid',$this->fr_crid);

		$criteria->compare('fr_content',$this->fr_content,true);

		$criteria->compare('fr_salesman',$this->fr_salesman,true);

		$criteria->compare('fr_followtime',$this->fr_followtime);

		$criteria->compare('fr_remindtime',$this->fr_remindtime,true);

		$criteria->compare('fr_reservetime',$this->fr_reservetime,true);

		$criteria->compare('fr_address',$this->fr_address,true);

		$criteria->compare('fr_status',$this->fr_status);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}