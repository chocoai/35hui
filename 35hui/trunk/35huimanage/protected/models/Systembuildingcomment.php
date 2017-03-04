<?php

/**
 * This is the model class for table "{{systembuildingcomment}}".
 *
 * The followings are the available columns in table '{{systembuildingcomment}}':
 * @property integer $sbc_id
 * @property integer $sbc_cid
 * @property integer $sbc_buildingid
 * @property integer $sbc_evaluation
 * @property integer $sbc_num
 * @property string $sbc_comment
 * @property integer $sbc_comdate
 */
class Systembuildingcomment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Systembuildingcomment the static model class
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
		return '{{systembuildingcomment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' sbc_buildingid, sbc_evaluation, sbc_comment, sbc_comdate', 'required'),
			array('sbc_cid, sbc_buildingid, sbc_evaluation, sbc_num, sbc_comdate', 'numerical', 'integerOnly'=>true),
			array('sbc_comment', 'length', 'max'=>1500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sbc_id, sbc_cid, sbc_buildingid, sbc_evaluation, sbc_num, sbc_comment, sbc_comdate', 'safe', 'on'=>'search'),
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
			'sbc_id' => '自增ID',
			'sbc_cid' => '评论用户ID',
			'sbc_buildingid' => '楼盘ID或商业广场ID',
			'sbc_evaluation' => '评价星',
			'sbc_num' => '点评数',
			'sbc_comment' => '评论内容',
			'sbc_comdate' => '发表时间',
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

		$criteria->compare('sbc_id',$this->sbc_id);

		$criteria->compare('sbc_cid',$this->sbc_cid);

		$criteria->compare('sbc_buildingid',$this->sbc_buildingid);

		$criteria->compare('sbc_evaluation',$this->sbc_evaluation);

		$criteria->compare('sbc_num',$this->sbc_num);

		$criteria->compare('sbc_comment',$this->sbc_comment,true);

		$criteria->compare('sbc_comdate',$this->sbc_comdate);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}