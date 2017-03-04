<?php

class Upersoncomment extends CActiveRecord
{
	/**
	 * The followings are the available columns in table '{{upersoncomment}}':
	 * @var integer $upc_id
	 * @var integer $upc_cid
	 * @var integer $upc_personid
	 * @var string $upc_quality
	 * @var string $upc_service
	 * @var string $upc_comment
	 * @var string $upc_comdate
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
		return '{{upersoncomment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' upc_quality, upc_service, upc_comment', 'required'),
			
			array('upc_comment', 'length', 'max'=>200),
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
			'upc_person' => array(self::BELONGS_TO, 'Unormal', 'upc_personid'),
			'upc_c' => array(self::BELONGS_TO, 'User', 'upc_cid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'upc_id' => '',
			'upc_cid' => '',
			'upc_personid' => '',
			'upc_quality' => '房源质量',
			'upc_service' => '服务质量',
			'upc_comment' => '评论',
			'upc_comdate' => '评论时间',
		);
	}
	
	public function getCommentcount($id)
	{
		return $this->count('upc_personid='.$id);
	}
	
	public function getAllcomments($id)
	{
		$criteria=new CDbCriteria(array(
			'order'=>'upc_comdate DESC',
		));
		return $this->findAllByAttributes(array('upc_personid'=>$id),$criteria);
	}
	
	public function getMark() {
        return (int)(($this->upc_quality + $this->upc_service) / 2);
    }
}