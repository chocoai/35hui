<?php

/**
 * This is the model class for table "{{vote}}".
 *
 * The followings are the available columns in table '{{vote}}':
 * @property integer $vt_id
 * @property string $vt_vote
 * @property integer $vt_parent
 * @property integer $vt_num
 */
class Vote extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Vote the static model class
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
		return '{{vote}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vt_vote', 'required'),
			array('vt_parent, vt_num', 'numerical', 'integerOnly'=>true),
			array('vt_vote', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('vt_id, vt_vote, vt_parent, vt_num', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'vt_id' => 'Vt',
			'vt_vote' => '描述',
			'vt_parent' => '上级',
			'vt_num' => '点击数',
		);
	}
}