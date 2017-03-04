<?php

/**
 * This is the model class for table "{{audience}}".
 *
 * The followings are the available columns in table '{{audience}}':
 * @property integer $aud_id
 * @property integer $aud_userid
 */
class Audience extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Audience the static model class
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
		return '{{audience}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('aud_userid', 'required'),
			array('aud_userid aud_location', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('aud_id, aud_userid', 'safe', 'on'=>'search'),
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
			'aud_id' => 'Aud',
			'aud_userid' => 'Aud Userid',
            'aud_location' => '所在地ID',
		);
	}

}