<?php

class Uagentcomment extends CActiveRecord
{
	/**
	 * The followings are the available columns in table '{{uagentcomment}}':
	 * @var integer $uac_id
	 * @var integer $uac_cid
	 * @var integer $uac_agentid
	 * @var string $uac_quality
	 * @var string $uac_service
	 * @var string $uac_comment
	 * @var string $uac_comdate
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
			array('uac_quality, uac_service, uac_comment', 'required'),
            array('uac_quality','match','pattern'=>'/^[1-9][0-9]+$/','message'=>'房源质量 不可为空白'),
            array('uac_service','match','pattern'=>'/^[1-9][0-9]+$/','message'=>'服务质量 不可为空白'),
			array('uac_comment', 'length', 'max'=>200),
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
			'uac_agent' => array(self::BELONGS_TO, 'Uagent', 'uac_agentid'),
			'uac_c' => array(self::BELONGS_TO, 'User', 'uac_cid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uac_id' => '',
			'uac_cid' => '',
			'uac_agentid' => '',
			'uac_quality' => '房源质量',
			'uac_service' => '服务质量',
			'uac_comment' => '评论',
			'uac_comdate' => '评论时间',
		);
	}
	
	public function getCommentcount($id)
	{
		return $this->count('uac_agentid='.$id);
	}
	
	public function getAllcomments($id)
	{
		$criteria=new CDbCriteria(array(
			'order'=>'uac_comdate DESC',
		));
		return $this->findAllByAttributes(array('uac_agentid'=>$id),$criteria);
	}
    /**
     *通过经纪人id，得到此经纪人的留言
     * @param <int> $uagentid经纪人id
     * @param <int> $limit
     * @return <type>
     */
	public function getUagentComment($uagentid,$limit=10){
        $criteria = new CDbCriteria;
        $criteria->condition = "uac_agentid=".$uagentid;
        $criteria->order = 'uac_comdate desc';
        $criteria->limit = $limit;
        return $this->findAll($criteria);
    }
	public function getMark() {
        return (int)(($this->uac_quality + $this->uac_service) / 2);
    }

}