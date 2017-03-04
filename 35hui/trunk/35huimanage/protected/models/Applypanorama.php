<?php

/**
 * This is the model class for table "{{applypanorama}}".
 *
 * The followings are the available columns in table '{{applypanorama}}':
 * @property integer $ap_id
 * @property integer $ap_uid
 * @property integer $ap_sourceid
 * @property integer $ap_sourcetype
 * @property integer $ap_applytime
 * @property integer $ap_acceptuserid
 * @property integer $ap_accepttime
 * @property string $ap_describute
 * @property integer $ap_state
 */
class Applypanorama extends CActiveRecord
{
    /**
     * 写字楼类型
     */
    const officebaseinfo = 1;
    /**
     * 商铺类型
     */
    const shopbaseinfo = 2;
    /**
     * 写字楼类型
     */
    public static $ap_sourcetype = array(
        "1"=>"写字楼",
        "2"=>"商铺",
    );
    /**
     *请求状态
     * @var <array>
     */
    public static $ap_state = array(
        "1"=>"请求绑定",
        "2"=>"请求拍摄",
        "3"=>"取景失败",
        "4"=>"绑定完毕"
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Applypanorama the static model class
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
		return '{{applypanorama}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ap_id, ap_uid, ap_sourceid, ap_sourcetype, ap_applytime', 'required'),
			array('ap_id, ap_uid, ap_sourceid, ap_sourcetype, ap_applytime, ap_acceptuserid, ap_accepttime, ap_state', 'numerical', 'integerOnly'=>true),
			array('ap_describute', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ap_id, ap_uid, ap_sourceid, ap_sourcetype, ap_applytime, ap_acceptuserid, ap_accepttime, ap_describute, ap_state', 'safe', 'on'=>'search'),
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
			'ap_id' => 'Ap',
			'ap_uid' => '申请人id',
			'ap_sourceid' => '资源id',
			'ap_sourcetype' => '资源类型',
			'ap_applytime' => '申请时间',
			'ap_acceptuserid' => '后台客服处理id',
			'ap_accepttime' => '处理时间',
			'ap_describute' => '备注',
			'ap_state' => '状态',
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

		$criteria->compare('ap_id',$this->ap_id);

		$criteria->compare('ap_uid',$this->ap_uid);

		$criteria->compare('ap_sourceid',$this->ap_sourceid);

		$criteria->compare('ap_sourcetype',$this->ap_sourcetype);

		$criteria->compare('ap_applytime',$this->ap_applytime);

		$criteria->compare('ap_acceptuserid',$this->ap_acceptuserid);

		$criteria->compare('ap_accepttime',$this->ap_accepttime);

		$criteria->compare('ap_describute',$this->ap_describute,true);

		$criteria->compare('ap_state',$this->ap_state);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}