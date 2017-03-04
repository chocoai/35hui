<?php

class Twitter extends CActiveRecord
{
    const systembuilding = 1;
	/**
	 * The followings are the available columns in table '{{twitter}}':
	 * @var integer $t_id
	 * @var integer $t_sourceid
	 * @var integer $t_sourcetype
	 * @var string $t_message
	 * @var integer $t_recordtime
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
			array('t_id, t_sourceid, t_sourcetype, t_recordtime', 'numerical', 'integerOnly'=>true),
			array('t_message', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('t_id, t_sourceid, t_sourcetype, t_message, t_recordtime', 'safe', 'on'=>'search'),
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
            'buildingInfo'=>array(self::BELONGS_TO,'Systembuildinginfo','t_sourceid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			't_id' => 'T',
			't_sourceid' => 'T Sourceid',
			't_sourcetype' => 'T Sourcetype',
			't_message' => 'T Message',
			't_recordtime' => 'T Recordtime',
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

		$criteria->compare('t_message',$this->t_message,true);

		$criteria->compare('t_recordtime',$this->t_recordtime);

		return new CActiveDataProvider('twitter', array(
			'criteria'=>$criteria,
		));
	}
    public function getTwitterMessageByBuildingId($buildingId,$type=1){
        $twitter = $this->find('t_sourceid=:buildingId and t_type=:t_type order by `t_recordtime` desc',array(
            ':buildingId'=>$buildingId,
            ':t_type'=>$type
        ));
        if($twitter){
            return $twitter->t_message;
        }else{
            return "";
        }
    }
    /*
     * 此方法只显示正在被采用的微博
     */
    public function getTwitterInfo($count=5,$sbi_buildtype=1){
        $criteria=new CDbCriteria(array(
            'limit'=>$count,
            'order'=>'t_recordtime desc',
            'condition'=>'t_sourcetype='.Twitter::systembuilding,
            'with'=>array('buildingInfo'=>array('condition'=>'sbi_buildtype='.$sbi_buildtype))
        ));
        return $this->findAll($criteria);
    }
}