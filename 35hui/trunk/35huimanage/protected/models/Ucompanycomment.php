<?php

/**
 * This is the model class for table "{{ucompanycomment}}".
 *
 * The followings are the available columns in table '{{ucompanycomment}}':
 * @property integer $ucc_id
 * @property integer $ucc_cid
 * @property integer $ucc_comid
 * @property integer $ucc_quality
 * @property integer $ucc_service
 * @property string $ucc_comment
 * @property integer $ucc_comdate
 */
class Ucompanycomment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Ucompanycomment the static model class
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
		return '{{ucompanycomment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ucc_cid, ucc_comid, ucc_quality, ucc_service, ucc_comdate', 'required'),
			array('ucc_cid, ucc_comid, ucc_quality, ucc_service, ucc_comdate', 'numerical', 'integerOnly'=>true),
			array('ucc_comment', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ucc_id, ucc_cid, ucc_comid, ucc_quality, ucc_service, ucc_comment, ucc_comdate', 'safe', 'on'=>'search'),
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
			'ucc_id' => '自增ID',
			'ucc_cid' => '评论用户ID',
			'ucc_comid' => 'Ucc Comid',
			'ucc_quality' => 'Ucc Quality',
			'ucc_service' => 'Ucc Service',
			'ucc_comment' => '评论内容',
			'ucc_comdate' => '发表时间',
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

		$criteria->compare('ucc_id',$this->ucc_id);

		$criteria->compare('ucc_cid',$this->ucc_cid);

		$criteria->compare('ucc_comid',$this->ucc_comid);

		$criteria->compare('ucc_quality',$this->ucc_quality);

		$criteria->compare('ucc_service',$this->ucc_service);

		$criteria->compare('ucc_comment',$this->ucc_comment,true);

		$criteria->compare('ucc_comdate',$this->ucc_comdate);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}