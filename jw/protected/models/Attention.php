<?php

/**
 * This is the model class for table "{{attention}}".
 *
 * The followings are the available columns in table '{{attention}}':
 * @property integer $at_id
 * @property integer $at_userid
 * @property integer $at_attentionuserid
 * @property integer $at_createtime
 */
class Attention extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Attention the static model class
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
		return '{{attention}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('at_userid, at_attentionuserid, at_createtime', 'required'),
			array('at_userid, at_attentionuserid, at_createtime', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('at_id, at_userid, at_attentionuserid, at_createtime', 'safe', 'on'=>'search'),
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
			'at_id' => 'At',
			'at_userid' => 'At Userid',
			'at_attentionuserid' => 'At Attentionuserid',
			'at_createtime' => 'At Createtime',
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

		$criteria->compare('at_id',$this->at_id);

		$criteria->compare('at_userid',$this->at_userid);

		$criteria->compare('at_attentionuserid',$this->at_attentionuserid);

		$criteria->compare('at_createtime',$this->at_createtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 检查是否已经关注过
     * @param <type> $attentionUserid 要关注的用户id
     * @return <type>
     */
    public function checkIfAlreadyAttention($attentionUserid){
        $loginUserId = User::model()->getId();
        $checkNum = $this->count("at_userid=".$loginUserId." and at_attentionuserid=".$attentionUserid);
        if($checkNum==0){
            return true;
        }
        return false;
    }
    /**
     * 获取用户总共被别人关注的数目
     * @param <int> $userId
     * @return <int>
     */
    public function countAttentionNum($userId){
        return $this->count("at_attentionuserid=".$userId);
    }
}