<?php

/**
 * This is the model class for table "{{memberrecommend}}".
 *
 * The followings are the available columns in table '{{memberrecommend}}':
 * @property integer $mr_id
 * @property integer $mr_userid
 * @property integer $mr_recommendtime
 * @property integer $mr_createtime
 */
class Memberrecommend extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Memberrecommend the static model class
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
		return '{{memberrecommend}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mr_userid, mr_recommendtime, mr_createtime', 'required'),
			array('mr_userid, mr_recommendtime, mr_createtime', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('mr_id, mr_userid, mr_recommendtime, mr_createtime', 'safe', 'on'=>'search'),
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
			'mr_id' => 'Mr',
			'mr_userid' => 'Mr Userid',
			'mr_recommendtime' => 'Mr Recommendtime',
			'mr_createtime' => 'Mr Createtime',
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

		$criteria->compare('mr_id',$this->mr_id);

		$criteria->compare('mr_userid',$this->mr_userid);

		$criteria->compare('mr_recommendtime',$this->mr_recommendtime);

		$criteria->compare('mr_createtime',$this->mr_createtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 判断此相册今日是否能推荐
     * @param <type> $amId
     * @return <boolean>
     */
    public function checkCanRecommend($userId){
       $today = strtotime(date("Y-m-d"));
       $count = $this->count("mr_userid=".$userId." and mr_recommendtime=".$today);
       if($count==0){
           return true;
       }
       return false;
    }
    /**
     * 获取首页推荐
     * @param <type> $limit 返回数目
     * @return <array>
     */
    public function getAllRecommend($limit){
        //先找出推荐的
        $criteria=new CDbCriteria;
        $criteria->group = "mr_userid";
        $criteria->order = "mr_createtime desc";
        $criteria->limit = $limit;
        $recommend = $this->findAll($criteria);
        $return = array();
        $userIdArr = array();
        foreach($recommend as $value){
            $userIdArr[] = $value->mr_userid;
            $return[] = Member::model()->findByAttributes(array("mem_userid"=>$value->mr_userid));
        }
        $len = $limit-count($return);
        if($len){
            $criteria=new CDbCriteria;
            $criteria->addNotInCondition("mem_userid",$userIdArr);
            $criteria->limit = $len;
            $criteria->order = "mem_id desc";
            $memberAll = Member::model()->findAll($criteria);
            foreach($memberAll as $value){
                $return[] = $value;
            }
        }
        return $return;
    }
}