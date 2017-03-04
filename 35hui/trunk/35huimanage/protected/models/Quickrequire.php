<?php

/**
 * This is the model class for table "{{quickrequire}}".
 *
 * The followings are the available columns in table '{{quickrequire}}':
 * @property integer $qrq_id
 * @property string $qrq_require
 * @property string $qrq_tel
 * @property string $qrq_name
 * @property string $qrq_email
 * @property integer $qrq_check
 * @property integer $qrq_releasedate
 * @property integer $qrq_settledate
 */
class Quickrequire extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Quickrequire the static model class
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
		return '{{quickrequire}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('qrq_require, qrq_tel, qrq_name, qrq_releasedate, qrq_settledate', 'required'),
			array('qrq_check, qrq_releasedate, qrq_settledate', 'numerical', 'integerOnly'=>true),
			array('qrq_require', 'length', 'max'=>3000),
			array('qrq_tel', 'length', 'max'=>20),
			array('qrq_name', 'length', 'max'=>100),
			array('qrq_email', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('qrq_id, qrq_require, qrq_tel, qrq_name, qrq_email, qrq_check, qrq_releasedate, qrq_settledate', 'safe', 'on'=>'search'),
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
			'qrq_id' => 'ID',
			'qrq_require' => '用户需求',
			'qrq_tel' => '用户联系方式',
			'qrq_name' => '用户名称',
			'qrq_email' => '用户邮箱',
			'qrq_check' => '审核状态',
			'qrq_releasedate' => '登记日期',
			'qrq_settledate' => '解决日期',
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

		$criteria->compare('qrq_id',$this->qrq_id);

		$criteria->compare('qrq_require',$this->qrq_require,true);

		$criteria->compare('qrq_tel',$this->qrq_tel,true);

		$criteria->compare('qrq_name',$this->qrq_name,true);

		$criteria->compare('qrq_email',$this->qrq_email,true);

		$criteria->compare('qrq_check',$this->qrq_check);

		$criteria->compare('qrq_releasedate',$this->qrq_releasedate);

		$criteria->compare('qrq_settledate',$this->qrq_settledate);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}