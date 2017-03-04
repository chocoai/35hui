<?php

class Communitybaseinfo extends CActiveRecord
{
    public static $propertyType = array(
        1=>'公寓',
        2=>'别墅',
        3=>'新里洋房',
        4=>'老公房',
        0=>'其它',
    );

    public static $pictureNorm = array(
        1 => array(
            'suffix'=>'_large',
            'width'=>'546',
            'height'=>'364',
        ),
        2 => array(
            'suffix'=>'_normal',
            'width'=>'300',
            'height'=>'200',
        ),
        3 => array(
            'suffix'=>'_small',
            'width'=>'150',
            'height'=>'100',
        ),
        4 => array(
            'suffix'=>'_thumb',
            'width'=>'100',
            'height'=>'75',
        ),
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Systembuildinginfo the static model class
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
		return '{{communitybaseinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comy_name, comy_province, comy_city,comy_district, comy_section, comy_address', 'required'),
			array('comy_propertytype,comy_parking, comy_province, comy_city, comy_district, comy_section, comy_householdnum,comy_buildingera', 'numerical', 'integerOnly'=>true),
			array('comy_avgsellprice, comy_cubagerate, comy_afforestation, comy_houseown, comy_titlepic, comy_propertyprice, comy_buildingarea', 'numerical'),
			array('comy_name, comy_pinyinshortname, comy_propertyname, comy_propertytel, comy_saletel, comy_traffic', 'length', 'max'=>50),
			array('comy_address, comy_pinyinlongname, comy_saleaddress, comy_x, comy_y', 'length', 'max'=>200),
			array('comy_developer', 'length', 'max'=>60),
			array('comy_school,comy_shopping, comy_bank, comy_hospital, comy_dining, comy_vegetables, comy_other', 'length', 'max'=>400),
			array('comy_introduce', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('comy_id, comy_name, comy_propertytype, comy_developer, comy_propertyname, comy_avgsellprice, comy_buildingera, comy_province, comy_city, comy_district, comy_section, comy_address, comy_inserttime, comy_traffic, comy_buildingarea, comy_school, comy_shopping, comy_bank, comy_hospital, comy_dining, comy_x, comy_y', 'safe', 'on'=>'search'),
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
            'comment'=>array(self::HAS_MANY,'communitycomment','comyc_comyid'),
            'rating'=>array(self::HAS_ONE,'communityrating','cr_comyid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'comy_id' => '小区id',
			'comy_name' => '小区名称',
            'comy_pinyinshortname' => '小区名称缩写',
            "comy_pinyinlongname"=> '小区名称完整拼音',
			'comy_introduce' => '小区介绍',
			'comy_address' => '小区地址',
			'comy_propertytype' => '物业类型',
			'comy_developer' => '开发商',
			'comy_propertyname' => '物业公司名称',
			'comy_propertytel' => '物业电话',
            'comy_propertyprice' => '物业管理费',
			'comy_avgsellprice' => '平均售价',
			'comy_cubagerate' => '容积率',
			'comy_afforestation' => '绿化率',
			'comy_householdnum' => '总户数',
			'comy_parking' => '停车位',
			'comy_buildingera' => '建筑年代',
            'comy_saleaddress' => '售楼地址',
			'comy_houseown' => '得房率',
			'comy_province' => '所属省份',
			'comy_city' => '所属城市',
			'comy_district' => '所属区域',
			'comy_section' => '所属板块',
			'comy_inserttime' => '录入时间',
			'comy_titlepic' => '标题图片id',
			'comy_saletel' => '售楼中心电话',
			'comy_x' => 'X轴',
			'comy_y' => 'Y轴',
			'comy_traffic' => '交通',
			'comy_buildingarea' => '总建筑面积',
			'comy_school' => '学校',
			'comy_shopping' => '购物',
			'comy_bank' => '银行',
			'comy_hospital' => '医院',
			'comy_dining' => '饮食',
			'comy_vegetables' => '菜场',
			'comy_other' => '其他',
		);
	}
    public function getComyName($comyId){
        $name = "";
        $model = Communitybaseinfo::model()->findByPk($comyId);
        if($model){
            $name = $model->comy_name;
        }
        return $name;
    }
}