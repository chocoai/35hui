<?php

/**
 * This is the model class for table "{{uagentcomment}}".
 *
 * The followings are the available columns in table '{{uagentcomment}}':
 * @property integer $uac_id
 * @property integer $uac_cid
 * @property integer $uac_agentid
 * @property integer $uac_quality
 * @property integer $uac_service
 * @property string $uac_comment
 * @property integer $uac_comdate
 */
class Uagentcomment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Uagentcomment the static model class
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
		return '{{uagentcomment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uac_cid, uac_agentid, uac_quality, uac_service, uac_comdate', 'numerical', 'integerOnly'=>true),
			array('uac_comment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('uac_id, uac_cid, uac_agentid, uac_quality, uac_service, uac_comment, uac_comdate', 'safe', 'on'=>'search'),
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
			'uac_id' => '自增IE',
			'uac_cid' => '评论用户ID',
			'uac_agentid' => '经纪人ID',
			'uac_quality' => 'Uac Quality',
			'uac_service' => 'Uac Service',
			'uac_comment' => '评论内容',
			'uac_comdate' => '发表时间',
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

		$criteria->compare('uac_id',$this->uac_id);

		$criteria->compare('uac_cid',$this->uac_cid);

		$criteria->compare('uac_agentid',$this->uac_agentid);

		$criteria->compare('uac_quality',$this->uac_quality);

		$criteria->compare('uac_service',$this->uac_service);

		$criteria->compare('uac_comment',$this->uac_comment,true);

		$criteria->compare('uac_comdate',$this->uac_comdate);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}