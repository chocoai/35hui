<?php

/**
 * This is the model class for table "{{officebaseinfo}}".
 *
 * The followings are the available columns in table '{{officebaseinfo}}':
 * @property integer $ob_officeid
 * @property integer $ob_sysid
 * @property integer $ob_uid
 * @property integer $ob_province
 * @property integer $ob_city
 * @property integer $ob_buildingtype
 * @property string $ob_officename
 * @property integer $ob_officetype
 * @property integer $ob_district
 * @property integer $ob_section
 * @property integer $ob_loop
 * @property integer $ob_tradecircle
 * @property string $ob_busway
 * @property string $ob_officeaddress
 * @property string $ob_propertycomname
 * @property double $ob_propertycost
 * @property integer $ob_foreign
 * @property double $ob_officearea
 * @property integer $ob_floornature
 * @property string $ob_property
 * @property integer $ob_industry
 * @property integer $ob_towards
 * @property integer $ob_buildingera
 * @property integer $ob_cancut
 * @property integer $ob_adrondegree
 * @property integer $ob_officedegree
 * @property integer $ob_sellorrent
 * @property integer $ob_releasedate
 * @property integer $ob_updatedate
 * @property integer $ob_expiredate
 * @property string $ob_tag
 */
class Officebaseinfo extends CActiveRecord
{
    /**
     * 楼层等级
     */
    public static $ob_floortype= array(
        "0"=>"低区",
        "1"=>"中区",
        "2"=>"高区",
    );
    //楼盘类型
    public static $buildingType = array(
        1 => '商务中心',
        2 => '创意工厂',
        3 => '写字楼',
    );
    //写字楼性质
    public static $officeType = array(
        1 => '商住楼',
        2 => '纯写字楼',
        3 => '商业综合体楼',
        4 => '酒店写字楼',
    );
    public static $toward = array(
        1 => "东",
        2 => "南",
        3 => "西",
        4 => "北",
    );
    //租售方式
    public static $rentorsell = array(
        1 => '出租',
        2 => '出售',
    );
    const rent = 1;
    const sell = 2;
    //装修程度
    public static $adrondegree = array(
        1 => '毛坯',
        2 => '简单装修',
        3 => '精装修',
        4 => '豪华装修',
    );
    public static $floorNature = array(
        1 => "单层",
        2 => "多层",
        3 => "整栋",
    );

    //写字楼级别
    public static $officedegree = array(
        1 => '甲级',
        2 => '乙级',
        3 => '丙级',
        4 => '丁级',
    );
    public static $officePicNorm = array(
        1 => array(
            'suffix'=>"_large",
            'width'=>'240',
            'height'=>'180',
        ),
        2 => array(
            'suffix'=>"_normal",
            'width'=>'120',
            'height'=>'160',
        ),
    );
    /**
     *朝向
     */
    public static $towards = array(
        1 => '东',
        2 => '南',
        3 => '西',
        4 => '北',
        5 => '东南',
        6 => '西南',
        7 => '西北',
        8 => '东北',
        9 => '南北',
        10 => '东西',
    );
    public static $checktype=array(
        "1"=>"删除",
        "2"=>"回收站",
        "3"=>"下线",
        "4"=>"已发布",
        "5"=>"未审核",
        "6"=>"已过期",
        "7"=>"已提交",
        "8"=>"草稿",
        "9"=>"违规"
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Officebaseinfo the static model class
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
		return '{{officebaseinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ob_uid,  ob_city, ob_buildingtype, ob_officename, ob_officetype, ob_district, ob_section, ob_officeaddress, ob_propertycost, ob_officearea, ob_towards, ob_officedegree, ob_sellorrent, ob_releasedate, ob_updatedate, ob_expiredate', 'required'),
			array('ob_sysid, ob_uid,  ob_city, ob_buildingtype, ob_officetype, ob_district, ob_section, ob_loop, ob_tradecircle, ob_foreign,ob_floornature, ob_industry, ob_towards, ob_buildingera, ob_cancut, ob_adrondegree, ob_officedegree, ob_sellorrent, ob_releasedate, ob_updatedate, ob_expiredate', 'numerical', 'integerOnly'=>true),
			array('ob_propertycost, ob_officearea', 'numerical'),
			array('ob_officename, ob_propertycomname', 'length', 'max'=>50),
			array('ob_busway, ob_officeaddress, ob_property, ob_tag', 'length', 'max'=>200),
            //下列规则是为了规范选项值的范围
            array('ob_officetype','in','range'=>array_keys(self::$officeType)),
            array('ob_adrondegree','in','range'=>array_keys(self::$adrondegree)),
            array('ob_officedegree','in','range'=>array_keys(self::$officedegree)),
            array('ob_buildingtype','in','range'=>array_keys(self::$buildingType)),
            array('ob_sellorrent','in','range'=>array_keys(self::$rentorsell)),
            array('ob_towards','in','range'=>array(0,1,2,3,4)),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('op_officetitle,ob_officeid, ob_sysid, ob_uid,  ob_city, ob_buildingtype, ob_officename, ob_officetype, ob_district, ob_section, ob_loop, ob_tradecircle, ob_busway, ob_officeaddress, ob_propertycomname, ob_propertycost, ob_foreign, ob_officearea, ob_floortype, ob_floornature, ob_property, ob_industry, ob_towards, ob_buildingera, ob_cancut, ob_adrondegree, ob_officedegree, ob_sellorrent, ob_releasedate, ob_updatedate, ob_expiredate, ob_tag', 'safe', 'on'=>'search'),
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
            //'rentInfo'=>array(self::HAS_ONE,'Officerentinfo','or_officeid'),
            //'sellInfo'=>array(self::HAS_ONE,'Officesellinfo','os_officeid'),
            //'presentInfo'=>array(self::HAS_ONE,'Officepresentinfo','op_officeid'),
            'user'=>array(self::BELONGS_TO,'User','ob_uid'),
            'buildingInfo'=>array(self::BELONGS_TO,'Systembuildinginfo','ob_sysid'),
            //'offictag'=>array(self::HAS_ONE,'Officetag','ot_officeid'),
            //'facility'=>array(self::HAS_ONE,'Officefacilityinfo','of_officeid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ob_officeid' => '房源主键Id',
			'ob_sysid' => '所属楼盘',
			'ob_uid' => '用户Id',
			'ob_city' => '所属城市',
			'ob_buildingtype' => '楼盘类型',
			'ob_officename' => '写字楼名称',
			'ob_officetype' => '写字楼性质',
			'ob_district' => '所属行政区',
			'ob_section' => '附近热门板块',
			'ob_loop' => '所属几环',
			'ob_tradecircle' => '附近商圈',
			'ob_busway' => '附近轨交',
			'ob_officeaddress' => '写字楼地址',
			'ob_propertycomname' => '物业公司',
			'ob_propertycost' => '物业费',
			'ob_foreign' => '是否涉外',
			'ob_officearea' => '面积',
			'ob_floornature' => '楼层性质',
			'ob_property' => '产权情况',
			'ob_industry' => '适用行业',
			'ob_towards' => '朝向',
			'ob_buildingera' => '建筑年份',
			'ob_cancut' => '是否可以分割',
			'ob_adrondegree' => '装修程度',
			'ob_officedegree' => '写字楼级别',
			'ob_sellorrent' => '售或租',
			'ob_releasedate' => '发布时间',
			'ob_updatedate' => '最近更新时间',
            'ob_order' =>'排序字段',
            'ob_visit' => '访问数',
			'ob_expiredate' => '截止时间',
			'ob_tag' => '标签',
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

        $criteria=new CDbCriteria();

		$criteria->compare('ob_officeid',$this->ob_officeid);

		$criteria->compare('ob_sysid',$this->ob_sysid);

		$criteria->compare('ob_uid',$this->ob_uid);


		$criteria->compare('ob_officearea',$this->ob_officearea);

		$criteria->compare('ob_floortype',$this->ob_floortype);





		$criteria->compare('ob_sellorrent',$this->ob_sellorrent);

		$criteria->compare('ob_releasedate',$this->ob_releasedate);

		$criteria->compare('ob_updatedate',$this->ob_updatedate);

		$criteria->compare('ob_expiredate',$this->ob_expiredate);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    public function getUnAuditSource(){
        $dataProvider=new CActiveDataProvider('Officebaseinfo',array(
            'criteria'=>array(
                'with' => array(
                    'offictag'=>array(
                        'condition'=>'ot_check=5',
                    ),
                ),
            ),
        ));
        return $dataProvider;
    }
    public function getOfficeName($officeId){
        $dba = dba();
        $officeName =  $dba->select_one("select `ob_officename` from 35_officebaseinfo where `ob_officeid`=?",$officeId);
        return $officeName;
    }
}