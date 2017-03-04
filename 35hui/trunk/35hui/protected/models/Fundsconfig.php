<?php

/**
 * This is the model class for table "{{fundsconfig}}".
 *
 * The followings are the available columns in table '{{fundsconfig}}':
 * @property integer $fc_id
 * @property integer $fc_rmbprice
 * @property integer $fc_giveprice
 * @property integer $fc_givepoint
 * @property integer $fc_givepanoramadevice
 */
class Fundsconfig extends CActiveRecord
{
     public static $fc_type = array(
        "1"=>"普通用户",
        "2"=>"中介公司",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Fundsconfig the static model class
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
		return '{{fundsconfig}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fc_rmbprice, fc_giveprice, fc_givepoint, fc_type', 'required'),
			array('fc_rmbprice, fc_giveprice, fc_givepoint, fc_givepanoramadevice,fc_vipexp', 'numerical', 'integerOnly'=>true),
            array('fc_rmbprice, fc_giveprice, fc_givepoint, fc_type, fc_givepanoramadevice', 'numerical', 'integerOnly'=>true),
            array('fc_desc', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fc_id, fc_rmbprice, fc_giveprice, fc_givepoint, fc_givepanoramadevice', 'safe', 'on'=>'search'),
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
			'fc_id' => 'ID',
			'fc_rmbprice' => '价格',
			'fc_giveprice' => '赠送新币数目',
			'fc_givepoint' => '赠送积分数目',
			'fc_givepanoramadevice' => '赠送全景镜头数目',
			'fc_type' => '赠送对象',
            'fc_vipexp'=> 'Vip',
			'fc_desc' => '描述',
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

		$criteria->compare('fc_id',$this->fc_id);

		$criteria->compare('fc_rmbprice',$this->fc_rmbprice);

		$criteria->compare('fc_giveprice',$this->fc_giveprice);

		$criteria->compare('fc_givepoint',$this->fc_givepoint);

		$criteria->compare('fc_givepanoramadevice',$this->fc_givepanoramadevice);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}