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
class Communityrating extends CActiveRecord
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
		return '{{communityrating}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cr_uid, cr_comyid, cr_score, cr_ratdate', 'required'),
			array('cr_uid, cr_comyid, cr_score, cr_ratdate', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cr_id, cr_uid, cr_comyid, cr_score, cr_ratdate', 'safe', 'on'=>'search'),
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
			'cr_id' => '自增ID',
			'cr_uid' => '用户ID',
			'cr_comyid' => '小区ID',
			'cr_score' => '分数',
			'cr_ratdate' => '评分时间',
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

		$criteria->compare('cr_id',$this->cr_id);

		$criteria->compare('cr_uid',$this->cr_uid);

		$criteria->compare('cr_comyid',$this->cr_comyid);

		$criteria->compare('cr_score',$this->cr_score,true);

		$criteria->compare('cr_ratdate',$this->cr_ratdate);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}