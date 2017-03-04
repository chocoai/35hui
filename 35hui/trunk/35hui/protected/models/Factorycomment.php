<?php

class Factorycomment extends CActiveRecord
{
	/**
	 * The followings are the available columns in table '{{factorycomment}}':
	 * @var integer $fc_id
	 * @var integer $fc_cid
	 * @var integer $fc_factoryid
	 * @var string $fc_traffice
	 * @var string $fc_facility
	 * @var string $fc_adorn
	 * @var string $fc_comment
	 * @var string $fc_comdate
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
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
		return '{{factorycomment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fc_cid, fc_factoryid, fc_traffice, fc_facility, fc_adorn, fc_comment', 'required'),
			
			array('fc_comment', 'length', 'max'=>200),
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
			'fc_c' => array(self::BELONGS_TO, 'User', 'fc_cid'),
			'fc_factory' => array(self::BELONGS_TO, 'Factorybaseinfo', 'fc_factoryid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fc_id' => 'Fc',
			'fc_cid' => 'Fc Cid',
			'fc_factoryid' => 'Fc Factoryid',
			'fc_traffice' => '交通情况',
			'fc_facility' => '设施情况',
			'fc_adorn' => '装修情况',
			'fc_comment' => '评论',
			'fc_comdate' => '发布日期',
		);
	}
	
	public function getCommentcount($id)
	{
		return $this->count('fc_factoryid='.$id);
	}
	
	public function getAllcomments($id)
	{
		$criteria=new CDbCriteria(array(
			'order'=>'fc_comdate DESC',
		));
		return $this->findAllByAttributes(array('fc_factoryid'=>$id),$criteria);
	}
}