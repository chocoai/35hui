<?php

/**
 * This is the model class for table "{{twitter}}".
 *
 * The followings are the available columns in table '{{twitter}}':
 * @property integer $t_id
 * @property integer $t_sourceid
 * @property integer $t_sourcetype
 * @property integer $t_userid
 * @property string $t_message
 * @property integer $t_recordtime
 */
class Twitter extends CActiveRecord
{
    const building = 1;
    const community = 2;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Twitter the static model class
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
		return '{{twitter}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('t_id', 'required'),
			array('t_id, t_sourceid, t_sourcetype, t_userid, t_recordtime', 'numerical', 'integerOnly'=>true),
			array('t_message', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('t_id, t_sourceid, t_sourcetype, t_userid, t_message, t_recordtime', 'safe', 'on'=>'search'),
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
			't_id' => '主键',
			't_sourceid' => '楼盘Id',
			't_sourcetype' => '房子类型',
			't_userid' => '用户',
			't_message' => '微博信息',
			't_recordtime' => '发表时间',
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

		$criteria->compare('t_id',$this->t_id);

		$criteria->compare('t_sourceid',$this->t_sourceid);

		$criteria->compare('t_sourcetype',$this->t_sourcetype);

		$criteria->compare('t_userid',$this->t_userid);

		$criteria->compare('t_message',$this->t_message,true);

		$criteria->compare('t_recordtime',$this->t_recordtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    public function getTwitterByBuildingId($buildingId,$type){
        $twitter = $this->find('t_sourceid=:buildingId and t_sourcetype=:sourceType and t_type=:type order by `t_recordtime` desc',array(
            ':buildingId'=>$buildingId,
            ':sourceType'=>Twitter::building,
            ':type'=>$type
        ));
        return $twitter;
    }
    public function getTwitterMessageByBuildingId($buildingId,$type){
        $twitter = $this->getTwitterByBuildingId($buildingId,$type);
        if($twitter){
            return $twitter->t_message;
        }else{
            return "";
        }
    }
}