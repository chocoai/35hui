<?php

/**
 * ReleaseBusinessForm class.
 * ReleaseBusinessForm is the data structure for keeping
 */
class ReleaseBusinessForm extends CFormModel
{
	public $ob_officeid;
	public $ob_uid;
	public $ob_province;
	public $ob_city;
	public $ob_buildingtype;
	public $ob_officename;
	public $ob_officetype;
	public $ob_tradecircle;
	public $ob_busway;
	public $ob_officeaddress;
	public $ob_propertycomname;
	public $ob_propertycost;
	public $ob_foreign;
	public $ob_officearea;
	public $ob_floortype;
	public $ob_buildingera;
	public $ob_cancut;
	public $ob_adrondegree;
	public $ob_officedegree;
	public $ob_sellorrent;
	public $ob_releasedate;
    public $ob_district;
    public $ob_section;
    public $ob_loop;
    public $ob_sysid;
    public $ob_towards;
    public $ob_industry;
    public $ob_property;
    public $ob_floornature;
    public $ob_updatedate;
    public $ob_expiredate;
    public $ob_tag;
    
	public $user_name;
    public $user_role;
    public $user_value;
    
    public $op_id;
    public $op_officetitle;
    public $op_serialnum;
    public $op_officedesc;
    public $op_traffice;
    public $op_carparking;
    public $op_facilityaround;
    public $op_titlepicurl;
    public $op_panoramaid;

    public $or_id;
    public $or_rentprice;
    public $or_iscontainprocost;
    public $or_renttype;
    public $or_payway;
    public $or_basetime;
    
    public $ot_id;
    public $ot_ishigh;
    public $ot_isrecommend;
    public $ot_ishomepage;
    public $ot_isvideo;
    public $ot_is3d;
    public $ot_isconsign;
    public $ot_consignid;
    public $ot_isnew;
    public $ot_ishurry;
    public $ot_check;

    public $of_id;
    public $of_carparking;
    public $of_warming;
    public $of_network;
    public $of_elecwater;
    public $of_elevator;
    public $of_lift;
    public $of_gas;
    public $of_aircondition;
    public $of_tv;
    public $of_door;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
        return array(
			array('ob_province, ob_city, ob_buildingtype, ob_officename, ob_officetype,  ob_officearea, ob_officedegree,  op_officetitle, op_officedesc, ob_expiredate, ob_district, ob_section, or_rentprice', 'required'),
			array('ob_officeid, ob_uid, ob_province, ob_city, ob_buildingtype, ob_officetype, ob_tradecircle, ob_foreign, ob_floortype, ob_buildingera, ob_cancut, ob_adrondegree, ob_officedegree, ob_sellorrent, ob_releasedate, user_role, op_id, or_id, or_iscontainprocost, or_renttype, or_payway, ot_id, ot_ishigh, ot_isrecommend, ot_ishomepage, ot_isvideo, ot_is3d, ot_isconsign, ot_consignid, ot_isnew, ot_ishurry, ot_check, ob_expiredate, of_id, of_carparking, of_warming, of_network, of_elecwater, of_elevator, of_lift, of_gas, of_aircondition, of_tv, of_door, ob_district, ob_section, ob_loop, op_titlepicurl, ob_sysid, ob_towards, ob_industry, ob_floornature, ob_updatedate,op_panoramaid', 'numerical', 'integerOnly'=>true),
			array('ob_propertycost, ob_officearea, user_value, or_rentprice, or_basetime', 'numerical'),
			array('ob_officename, ob_propertycomname, op_officetitle, op_serialnum, op_traffice, op_carparking, op_facilityaround', 'length', 'max'=>50),
			array('ob_busway, ob_officeaddress, ob_tag, ob_property', 'length', 'max'=>200),
			array('user_name', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ob_officeid, ob_uid, ob_province, ob_city, ob_buildingtype, ob_officename, ob_officetype, ob_tradecircle, ob_busway, ob_officeaddress, ob_propertycomname, ob_propertycost, ob_foreign, ob_officearea, ob_floortype, ob_buildingera, ob_cancut, ob_adrondegree, ob_officedegree, ob_sellorrent, ob_releasedate, user_name, user_role, user_value, op_id, op_officetitle, op_serialnum, op_officedesc, op_traffice, op_carparking, op_facilityaround, or_id, or_rentprice, or_iscontainprocost, or_renttype, or_payway, or_basetime, ot_id, ot_ishigh, ot_isrecommend, ot_ishomepage, ot_isvideo, ot_is3d, ot_isconsign, ot_consignid, ot_isnew, ot_ishurry, ot_check, ob_expiredate, ob_tag, of_id, of_carparking, of_warming, of_network, of_elecwater, of_elevator, of_lift, of_gas, of_aircondition, of_tv, of_door, ob_district, ob_section, ob_loop, op_titlepicurl, ob_sysid, ob_towards, ob_industry, ob_property, ob_floornature, ob_updatedate', 'safe', 'on'=>'search'),
		);
		
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'ob_officeid' => 'Ob Officeid',
			'ob_uid' => 'Ob Uid',
			'ob_province' =>'省份',
			'ob_city' => '城市',
			'ob_buildingtype' => '楼盘性质',
			'ob_officename' => '写字楼名字',
			'ob_officetype' => '写字楼性质',
			'ob_tradecircle' => '商圈',
			'ob_busway' => '临近轨道',
			'ob_officeaddress' => '写字楼地址',
			'ob_propertycomname' => '物业公司',
			'ob_propertycost' => '物业费',
			'ob_foreign' => '是否涉外',
			'ob_officearea' => '写字楼面积',
			'ob_floortype' => '所属楼层',
			'ob_buildingera' => '建筑年代',
			'ob_cancut' => '是否可分',
			'ob_adrondegree' => '装修程度',
			'ob_officedegree' => '写字楼级别',
			'ob_sellorrent' => '',
			'ob_releasedate' => '发布日期',
			'user_name' => '发布者用户名',
			'user_role' => '发布者角色',
			'user_value' => '发布者积分',
			'op_id' => 'Op',
			'op_officetitle' => '标题',
			'op_serialnum' => '内部序列号',
			'op_officedesc' => '描述',
			'op_traffice' => '交通情况',
			'op_carparking' => '停车情况',
			'op_facilityaround' => '周围设施',
			'or_id' => 'Or',
			'or_rentprice' => '租金价格',
			'or_iscontainprocost' => '是否包含物业费',
			'or_renttype' => '租金价格',
			'or_payway' => '支付方法',
			'or_basetime' => '起租年限',
			'ot_id' => 'Ot',
			'ot_ishigh' => '是否优质',
			'ot_isrecommend' => '是否推荐',
			'ot_ishomepage' => '是否在首页显示',
			'ot_isvideo' => '配有视频',
			'ot_is3d' => '配有3D交互图',
			'ot_isconsign' => '是否委托',
			'ot_consignid' => '委托经纪人ID',
			'ot_isnew' => '是否新房源',
			'ot_ishurry' => '是否急房源',
			'ot_check' => '状态',
			'ob_expiredate' => '信息有效期',
			'ob_tag' => '标签',
			'of_id' => 'Of',
			'of_carparking' => '停车场',
			'of_warming' => '有暖气',
			'of_network' => '网络',
			'of_elecwater' => '水电',
			'of_elevator' => '货梯',
			'of_lift' => '电梯',
			'of_gas' => '天然气',
			'of_aircondition' => '空调',
			'of_tv' => '电视',
			'of_door' => '防盗门',
			'ob_district' => '行政区',
			'ob_section' => '板块',
			'ob_loop'=>'地段',
			'op_titlepicurl' => 'Op Titlepicurl',
			'ob_sysid' => 'Ob Sysid',
			'ob_towards' => 'Ob Towards',
			'ob_industry' => 'Ob Industry',
			'ob_property' => 'Ob Property',
			'ob_floornature' => 'Ob Floornature',
			'ob_updatedate' => 'Ob Updatedate',
		);
	}
    
}
