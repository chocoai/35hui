<?php

class Projectcomment extends CActiveRecord
{
	/**
	 * The followings are the available columns in table '{{projectcomment}}':
	 * @var integer $pc_id
	 * @var integer $pc_cid
	 * @var integer $pc_projectid
	 * @var string $pc_traffice
	 * @var string $pc_facility
	 * @var string $pc_adorn
	 * @var string $pc_comment
	 * @var string $pc_comdate
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
		return '{{projectcomment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pc_cid, pc_projectid, pc_traffice, pc_facility, pc_adorn, pc_comment, pc_comdate', 'required'),
			
			array('pc_comment', 'length', 'max'=>200),
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
			'pc_project' => array(self::BELONGS_TO, 'Projectbaseinfo', 'pc_projectid'),
			'pc_c' => array(self::BELONGS_TO, 'User', 'pc_cid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pc_id' => 'Pc',
			'pc_cid' => 'Pc Cid',
			'pc_projectid' => 'Pc Projectid',
			'pc_traffice' => '交通情况',
			'pc_facility' => '设施情况',
			'pc_adorn' => '装修情况',
			'pc_comment' => '评论',
			'pc_comdate' => '发布日期',
		);
	}
	
	public function getCommentcount($id)
	{
		return $this->count('pc_projectid='.$id);
	}
	
	public function getAllcomments($id)
	{
		$criteria=new CDbCriteria(array(
			'order'=>'pc_comdate DESC',
		));
		return $this->findAllByAttributes(array('pc_projectid'=>$id),$criteria);
	}
}