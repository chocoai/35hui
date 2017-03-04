<?php

class Businesscenter extends CActiveRecord
{
    public static $pictureNorm = array(
        1 => array(
            'suffix'=>"_large",
            'width'=>'240',
            'height'=>'180',
        ),
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Businesscenter the static model class
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
		return '{{businesscenter}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bc_name, bc_rentprice', 'required'),
			array('bc_sysid, bc_district, bc_rentprice', 'numerical', 'integerOnly'=>true),
			array('bc_name, bc_pinyinlongname, bc_englishname, bc_address, bc_serverbrand, bc_serverlanguage, bc_decoratestyle', 'length', 'max'=>200),
			array('bc_pinyinshortname, bc_floor', 'length', 'max'=>50),
			array('bc_connecttel', 'length', 'max'=>20),
			array('bc_introduce, bc_freeserver, bc_payserver, bc_traffic, bc_peripheral', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('bc_id, bc_name, bc_pinyinshortname, bc_pinyinlongname, bc_englishname, bc_sysid, bc_address, bc_district, bc_floor, bc_completetime, bc_rentprice, bc_serverbrand, bc_serverlanguage, bc_decoratestyle, bc_introduce, bc_freeserver, bc_payserver, bc_traffic, bc_peripheral, bc_connecttel, bc_releasetime, bc_visit, bc_titlepic', 'safe', 'on'=>'search'),
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
            'sysbuild'=>array(self::BELONGS_TO,'Systembuildinginfo','bc_sysid','select'=>'`sbi_buildingid`,`sbi_buildingname`'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'bc_id' => 'Bc',
			'bc_name' => '名称',
			'bc_pinyinshortname' => 'Bc Pinyinshortname',
			'bc_pinyinlongname' => 'Bc Pinyinlongname',
			'bc_englishname' => '英文名称',
			'bc_sysid' => '所在写字楼',
			'bc_address' => '地址',
			'bc_district' => '区域',
			'bc_floor' => '所在楼层',
			'bc_completetime' => '竣工日期',
			'bc_rentprice' => '租金',
			'bc_serverbrand' => '服务品牌',
			'bc_serverlanguage' => '服务语言',
			'bc_decoratestyle' => '装修风格',
			'bc_introduce' => '项目介绍',
			'bc_freeserver' => '免费服务',
			'bc_payserver' => '收费服务',
			'bc_traffic' => '交通',
			'bc_peripheral' => '商业配套',
			'bc_connecttel' => '联系电话',
			'bc_releasetime' => 'Bc Releasetime',
			'bc_visit' => 'Bc Visit',
			'bc_titlepic' => 'Bc Titlepic',
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

		$criteria->compare('bc_name',$this->bc_name,true);

		$criteria->compare('bc_pinyinshortname',$this->bc_pinyinshortname,true);

		$criteria->compare('bc_pinyinlongname',$this->bc_pinyinlongname,true);

		$criteria->compare('bc_englishname',$this->bc_englishname,true);

		$criteria->compare('bc_sysid',$this->bc_sysid);

		$criteria->compare('bc_address',$this->bc_address,true);

		$criteria->compare('bc_district',$this->bc_district);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}