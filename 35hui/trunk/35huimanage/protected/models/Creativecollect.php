<?php

/**
 * This is the model class for table "{{creativecollect}}".
 *
 * The followings are the available columns in table '{{creativecollect}}':
 * @property integer $cc_id
 * @property integer $cc_userid
 * @property integer $cc_cpid
 * @property string $cc_name
 * @property string $cc_address
 * @property integer $cc_district
 * @property integer $cc_state
 * @property integer $cc_audituser
 * @property integer $cc_releasetime
 */
class Creativecollect extends CActiveRecord
{
    /**
     * 状态
     * @var <type>
     */
    public static $cc_state = array(
        "0"=>"未审核",
        "1"=>"已审核",
        "2"=>"审核未通过",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Creativecollect the static model class
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
		return '{{creativecollect}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cc_userid, cc_cpid, cc_address, cc_district, cc_releasetime', 'required'),
			array('cc_userid, cc_cpid, cc_district, cc_state, cc_audituser, cc_releasetime', 'numerical', 'integerOnly'=>true),
			array('cc_name', 'length', 'max'=>50),
			array('cc_address', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cc_id, cc_userid, cc_cpid, cc_name, cc_address, cc_district, cc_state, cc_audituser, cc_releasetime', 'safe', 'on'=>'search'),
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
			'cc_id' => 'ID',
			'cc_userid' => '录入者',
			'cc_cpid' => '园区id',
			'cc_name' => '创意园区',
			'cc_address' => '地址',
			'cc_district' => '行政区',
			'cc_state' => '状态',
			'cc_audituser' => '审核者',
			'cc_releasetime' => '发布时间',
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

		$criteria->compare('cc_id',$this->cc_id);

		$criteria->compare('cc_userid',$this->cc_userid);

		$criteria->compare('cc_cpid',$this->cc_cpid);

		$criteria->compare('cc_name',$this->cc_name,true);

		$criteria->compare('cc_address',$this->cc_address,true);

		$criteria->compare('cc_district',$this->cc_district);

		$criteria->compare('cc_state',$this->cc_state);

		$criteria->compare('cc_audituser',$this->cc_audituser);

		$criteria->compare('cc_releasetime',$this->cc_releasetime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}