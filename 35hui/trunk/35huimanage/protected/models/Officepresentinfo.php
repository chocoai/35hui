<?php

/**
 * This is the model class for table "{{officepresentinfo}}".
 *
 * The followings are the available columns in table '{{officepresentinfo}}':
 * @property integer $op_id
 * @property integer $op_officeid
 * @property string $op_officetitle
 * @property string $op_serialnum
 * @property string $op_officedesc
 * @property string $op_traffice
 * @property string $op_carparking
 * @property string $op_facilityaround
 * @property integer $op_titlepicurl
 */
class Officepresentinfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Officepresentinfo the static model class
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
		return '{{officepresentinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('op_officeid, op_officetitle, op_officedesc', 'required'),
			array('op_officeid, op_titlepicurl', 'numerical', 'integerOnly'=>true),
			array('op_serialnum, op_traffice, op_carparking, op_facilityaround', 'length', 'max'=>50),
            array('op_officetitle','length','max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('op_id, op_officeid, op_officetitle, op_serialnum, op_officedesc, op_traffice, op_carparking, op_facilityaround, op_titlepicurl', 'safe', 'on'=>'search'),
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
            'picture'=>array(self::BELONGS_TO,'Picture','op_titlepicurl')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'op_id' => '主键Id',
			'op_officeid' => '关联房源表Id',
			'op_officetitle' => '名称',
			'op_serialnum' => '经纪公司内容序列号',
			'op_officedesc' => '描述',
			'op_traffice' => '交通',
			'op_carparking' => '停车位',
			'op_facilityaround' => '周围设施',
			'op_titlepicurl' => '标题图片外键Id',
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

		$criteria->compare('op_id',$this->op_id);

		$criteria->compare('op_officeid',$this->op_officeid);

		$criteria->compare('op_officetitle',$this->op_officetitle,true);

		$criteria->compare('op_serialnum',$this->op_serialnum,true);

		$criteria->compare('op_officedesc',$this->op_officedesc,true);

		$criteria->compare('op_traffice',$this->op_traffice,true);

		$criteria->compare('op_carparking',$this->op_carparking,true);

		$criteria->compare('op_facilityaround',$this->op_facilityaround,true);

		$criteria->compare('op_titlepicurl',$this->op_titlepicurl);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    public function getOfficeTitle($officeId){
        $dba = dba();
        $officeTitle =  $dba->select_one("select `op_officetitle` from 35_officepresentinfo where `op_officeid`=?",$officeId);
        return $officeTitle;
    }
}