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
class Communitycomment extends CActiveRecord
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
		return '{{communitycomment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comyc_uid, comyc_comyid, comyc_comment, comyc_comdate', 'required'),
			array('comyc_uid, comyc_comyid, comyc_comdate', 'numerical', 'integerOnly'=>true),
			array('comyc_comment', 'length', 'max'=>3000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('comyc_id, comyc_uid, comyc_comyid, comyc_comment, comyc_comdate', 'safe', 'on'=>'search'),
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
			'comyc_id' => '自增ID',
			'comyc_uid' => '用户ID',
			'comyc_comyid' => '小区ID',
			'comyc_comment' => '评论内容',
			'comyc_comdate' => '发表时间',
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

		$criteria->compare('comyc_id',$this->comyc_id);

		$criteria->compare('comyc_uid',$this->comyc_uid);

		$criteria->compare('comyc_comyid',$this->comyc_comyid);

		$criteria->compare('comyc_comment',$this->comyc_comment,true);

		$criteria->compare('comyc_comdate',$this->comyc_comdate);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}