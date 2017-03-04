<?php

/**
 * This is the model class for table "{{officecomment}}".
 *
 * The followings are the available columns in table '{{officecomment}}':
 * @property integer $oc_id
 * @property integer $oc_cid
 * @property integer $oc_officeid
 * @property integer $oc_traffice
 * @property integer $oc_facility
 * @property integer $oc_adorn
 * @property string $oc_comment
 * @property integer $oc_comdate
 */
class Officecomment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Officecomment the static model class
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
		return '{{officecomment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('oc_cid, oc_officeid, oc_traffice, oc_facility, oc_adorn, oc_comdate', 'required'),
			array('oc_cid, oc_officeid, oc_traffice, oc_facility, oc_adorn, oc_comdate', 'numerical', 'integerOnly'=>true),
			array('oc_comment', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('oc_id, oc_cid, oc_officeid, oc_traffice, oc_facility, oc_adorn, oc_comment, oc_comdate', 'safe', 'on'=>'search'),
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
			'oc_id' => '自增ID',
			'oc_cid' => '用户ID',
			'oc_officeid' => '商务中心ID',
			'oc_traffice' => 'Oc Traffice',
			'oc_facility' => 'Oc Facility',
			'oc_adorn' => 'Oc Adorn',
			'oc_comment' => '评论内容',
			'oc_comdate' => '发表时间',
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

		$criteria->compare('oc_id',$this->oc_id);

		$criteria->compare('oc_cid',$this->oc_cid);

		$criteria->compare('oc_officeid',$this->oc_officeid);

		$criteria->compare('oc_traffice',$this->oc_traffice);

		$criteria->compare('oc_facility',$this->oc_facility);

		$criteria->compare('oc_adorn',$this->oc_adorn);

		$criteria->compare('oc_comment',$this->oc_comment,true);

		$criteria->compare('oc_comdate',$this->oc_comdate);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}