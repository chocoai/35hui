<?php

/**
 * This is the model class for table "{{goldhome}}".
 *
 * The followings are the available columns in table '{{goldhome}}':
 * @property integer $gh_id
 * @property integer $gh_userid
 * @property integer $gh_golehomeuserid
 * @property integer $gh_createtime
 */
class Goldhome extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Goldhome the static model class
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
		return '{{goldhome}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gh_userid, gh_golehomeuserid, gh_createtime', 'required'),
			array('gh_userid, gh_golehomeuserid, gh_createtime', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('gh_id, gh_userid, gh_golehomeuserid, gh_createtime', 'safe', 'on'=>'search'),
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
			'gh_id' => 'Gh',
			'gh_userid' => 'Gh Userid',
			'gh_golehomeuserid' => 'Gh Golehomeuserid',
			'gh_createtime' => 'Gh Createtime',
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

		$criteria->compare('gh_id',$this->gh_id);

		$criteria->compare('gh_userid',$this->gh_userid);

		$criteria->compare('gh_golehomeuserid',$this->gh_golehomeuserid);

		$criteria->compare('gh_createtime',$this->gh_createtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 检查是否已经收藏过
     * @param <type> $golehomeUserId 要收藏的用户id
     * @return <type>
     */
    public function checkIfAlreadyAdd($golehomeUserId){
        $loginUserId = User::model()->getId();
        $checkNum = $this->count("gh_userid=".$loginUserId." and gh_golehomeuserid=".$golehomeUserId);
        if($checkNum==0){
            return true;
        }
        return false;
    }
    /**
     * 获取用户总共被别人收藏的数目
     * @param <int> $userId
     * @return <int>
     */
    public function countGoldHomedNum($userId){
        return $this->count("gh_golehomeuserid=".$userId);
    }
}