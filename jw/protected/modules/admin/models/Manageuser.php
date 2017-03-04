<?php

/**
 * This is the model class for table "m_manageuser".
 *
 * The followings are the available columns in table 'm_manageuser':
 */
class Manageuser extends CActiveRecord
{
    /**
     * 登录用户名称
     */
    const DEFAULT_ROOT_NAME = "root";
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
		return 'm_manageuser';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('m_name,m_password', 'required'),
            array('m_name', 'length', 'max'=>50),
            array('m_password', 'length', 'max'=>32),
			array('m_password, m_name', 'safe', 'on'=>'search'),
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
			'm_id' => 'ID',
			'm_name' => '登录名',
            'm_password' => '密码',
		);
	}

}