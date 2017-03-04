<?php

/**
 * This is the model class for table "{{applyhighsource}}".
 *
 * The followings are the available columns in table '{{applyhighsource}}':
 * @property integer $ahs_id
 * @property integer $ahs_userid
 * @property integer $ahs_type
 * @property integer $ahs_sourceid
 * @property integer $ahs_status
 * @property string $ahs_message
 * @property integer $ahs_releasetime
 */
class Applyhighsource extends CActiveRecord
{
    /**
     * 类型
     * @var <type>
     */
    public static $ahs_type =  array(
        "1"=>"写字楼",
        "2"=>"商铺",
        "3"=>"住宅",
    );
    /**
     * 状态
     * @var <type>
     */
    public static $ahs_status = array(
        "0"=>"未审核",
        "1"=>"审核通过",
        "2"=>"审核不通过",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Applyhighsource the static model class
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
		return '{{applyhighsource}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ahs_userid, ahs_type, ahs_sourceid, ahs_releasetime', 'required'),
			array('ahs_userid, ahs_type, ahs_sourceid, ahs_status, ahs_releasetime', 'numerical', 'integerOnly'=>true),
			array('ahs_message', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ahs_id, ahs_userid, ahs_type, ahs_sourceid, ahs_status, ahs_message, ahs_releasetime', 'safe', 'on'=>'search'),
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
			'ahs_id' => 'Ahs',
			'ahs_userid' => '用户id',
			'ahs_type' => '资源类型',
			'ahs_sourceid' => '资源id',
			'ahs_status' => '审核状态',
			'ahs_message' => '消息',
			'ahs_releasetime' => '录入时间',
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

		$criteria->compare('ahs_id',$this->ahs_id);

		$criteria->compare('ahs_userid',$this->ahs_userid);

		$criteria->compare('ahs_type',$this->ahs_type);

		$criteria->compare('ahs_sourceid',$this->ahs_sourceid);

		$criteria->compare('ahs_status',$this->ahs_status);

		$criteria->compare('ahs_message',$this->ahs_message,true);

		$criteria->compare('ahs_releasetime',$this->ahs_releasetime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}