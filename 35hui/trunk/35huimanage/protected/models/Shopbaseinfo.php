<?php

/**
 * This is the model class for table "{{shopbaseinfo}}".
 *
 * The followings are the available columns in table '{{shopbaseinfo}}':
 * @property integer $sb_shopid
 * @property integer $sb_uid
 * @property integer $sb_shoptype
 * @property integer $sb_province
 * @property integer $sb_city
 * @property integer $sb_district
 * @property integer $sb_section
 * @property string $sb_busway
 * @property string $sb_shopaddress
 * @property integer $sb_shopfronttype
 * @property string $sb_propertycomname
 * @property double $sb_propertycost
 * @property double $sb_shoparea
 * @property double $sb_shopusablearea
 * @property integer $sb_loop
 * @property string $sb_floor
 * @property integer $sb_towards
 * @property integer $sb_cancut
 * @property integer $sb_adrondegree
 * @property integer $sb_recommendtrade
 * @property string $sb_buildingage
 * @property integer $sb_sellorrent
 * @property integer $sb_releasedate
 * @property integer $sb_updatedate
 * @property integer $sb_expiredate
 * @property integer $sb_order
 * @property integer $sb_visit
 * @property string $sb_tag
 * @property integer $sb_check
 * @property integer $sb_panorama
 * @property integer $sb_profession
 * @property integer $sb_businesstype
 */
class Shopbaseinfo extends CActiveRecord
{
    /**
     *商铺类型
     * @var <type> 
     */
    const rent = 1;
    const sell = 2;
    public static $sb_shoptype = array(
        '1'=>"沿街商铺/商业街",
        '2'=>"购物中心/综合体/卖场",
        '3'=>"住宅/社区商铺",
        '4'=>"写字楼配套底商",
        '5'=>"酒店底商",
        '6'=>"旅游商铺",
        
        
    );
    /**
     *铺面类型
     * @var <type>
     */
    public static $sb_shopfronttype = array(
        "1"=>"店铺",
        "2"=>"摊位",
        "3"=>"柜台",
    );
    /**
     * 装修程度
     */
    public static $sb_adrondegree = array(
        1 => '毛坯',
        2 => '简单装修',
        3 => '精装修',
        4 => '豪华装修',
    );
    /**
     *朝向
     */
    public static $sb_towards = array(
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
    /**
     *是否可分割
     */
    public static $sb_cancut = array(
        "0"=>"否",
        "1"=>"是"
    );
    /**
     * 租售类型
     */
    public static $sb_sellorrent = array(
        "1"=>"出租",
        "2"=>"出售",
    );
    public static $renttype = array(
        "1"=>"出租",
        "2"=>"转让",
    );
    /**
     *推荐业态
     */
    public static $sb_recommendtrade = array(
        "1"=>"餐饮美食(包括中餐、西餐、小吃、咖啡、茶坊、熟食、面包房、快餐、奶茶铺)",
        "2"=>"娱乐休闲(包括夜总会、酒吧、KTV歌城、足浴、桑拿、会所、健身中心、网吧、美容美发、游艺厅)",
        "3"=>"百货零售(包括服装店、鞋店、超市、大卖场、便利店、医药房、婚纱店、母婴用品店、烟酒店、眼镜店、文具店)",
        "4"=>"公司工厂",
        "5"=>"其他服务业(包括宾馆酒店、文化教育、洗衣清洁、维修配件、宠物、房产中介、电脑复印、旅行社、人才中介、法律服务、养老院、摄影店、会计服务)",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Shopbaseinfo the static model class
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
		return '{{shopbaseinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sb_uid, sb_shoptype, sb_province, sb_city, sb_shopaddress, sb_sellorrent, sb_releasedate, sb_expiredate, sb_check', 'required'),
			array('sb_uid, sb_shoptype, sb_province, sb_city, sb_district, sb_section, sb_shopfronttype, sb_loop, sb_towards, sb_cancut, sb_adrondegree, sb_recommendtrade, sb_sellorrent, sb_releasedate, sb_updatedate, sb_expiredate, sb_order, sb_visit, sb_check, sb_panorama, sb_profession, sb_businesstype', 'numerical', 'integerOnly'=>true),
			array('sb_propertycost, sb_shoparea, sb_shopusablearea', 'numerical'),
			array('sb_busway', 'length', 'max'=>50),
			array('sb_shopaddress, sb_propertycomname', 'length', 'max'=>200),
			array('sb_floor, sb_buildingage', 'length', 'max'=>20),
			array('sb_tag', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sb_shopid, sb_uid, sb_shoptype, sb_province, sb_city, sb_district, sb_section, sb_busway, sb_shopaddress, sb_shopfronttype, sb_propertycomname, sb_propertycost, sb_shoparea, sb_shopusablearea, sb_loop, sb_floor, sb_towards, sb_cancut, sb_adrondegree, sb_recommendtrade, sb_buildingage, sb_sellorrent, sb_releasedate, sb_updatedate, sb_expiredate, sb_order, sb_visit, sb_tag, sb_check, sb_panorama, sb_profession, sb_businesstype', 'safe', 'on'=>'search'),
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
            'rentInfo'=>array(self::HAS_ONE,'Shoprentinfo','sr_shopid'),
            'sellInfo'=>array(self::HAS_ONE,'Shopsellinfo','ss_shopid'),
            'presentInfo'=>array(self::HAS_ONE,'Shoppresentinfo','sp_shopid'),
            'user'=>array(self::BELONGS_TO,'User','sb_uid'),
            'buildingInfo'=>array(self::BELONGS_TO,'systembuildinginfo','sb_sysid'),
            'shopTag'=>array(self::HAS_ONE,'Shoptag','st_shopid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sb_shopid' => '商铺ID',
			'sb_sysid' => '楼盘ID',
			'sb_uid' => '用户ID',
			'sb_shoptype' => '商铺类型',
			'sb_province' => '省',
			'sb_city' => '城市',
			'sb_district' => '行政区',
			'sb_section' => '板块',
			'sb_tradecircle' => '商圈',
			'sb_busway' => '临近轨道',
			'sb_shopaddress' => '地址',
			'sb_shopfronttype' => '铺面类型',
			'sb_propertycomname' => '物业公司',
			'sb_propertycost' => '物业费',
			'sb_shoparea' => '建筑面积',
			'sb_shopusablearea' => '使用面积',
			'sb_loop' => '环线',
			'sb_floor' => '楼层',
			'sb_allfloor' => '总楼层',
            'sb_towards'=>"朝向",
			'sb_cancut' => '是否可分',
			'sb_adrondegree' => '装修程度',
			'sb_recommendtrade' => '推荐业态',
			'sb_buildingage' => '建筑年代',
			'sb_sellorrent' => '租售类型',
			'sb_releasedate' => '发布时间',
			'sb_updatedate' => '最近更新时间',
			'sb_expiredate' => '有效期',
            'sb_order' =>'排序字段',
            'sb_visit' => '访问数',
			'sb_tag' => '标签',
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

		$criteria->compare('sb_shopid',$this->sb_shopid);

		$criteria->compare('sb_sysid',$this->sb_sysid);

		$criteria->compare('sb_uid',$this->sb_uid);

		$criteria->compare('sb_shoptype',$this->sb_shoptype);

		$criteria->compare('sb_province',$this->sb_province);

		$criteria->compare('sb_city',$this->sb_city);

		$criteria->compare('sb_district',$this->sb_district);

		$criteria->compare('sb_section',$this->sb_section);

		$criteria->compare('sb_tradecircle',$this->sb_tradecircle);

		$criteria->compare('sb_busway',$this->sb_busway,true);

		$criteria->compare('sb_shopaddress',$this->sb_shopaddress,true);

		$criteria->compare('sb_shopfronttype',$this->sb_shopfronttype);

		$criteria->compare('sb_propertycomname',$this->sb_propertycomname,true);

		$criteria->compare('sb_propertycost',$this->sb_propertycost);

		$criteria->compare('sb_shoparea',$this->sb_shoparea);

		$criteria->compare('sb_shopusablearea',$this->sb_shopusablearea);

		$criteria->compare('sb_loop',$this->sb_loop);

		$criteria->compare('sb_floor',$this->sb_floor);

        $criteria->compare('sb_towards',$this->sb_towards);

		$criteria->compare('sb_allfloor',$this->sb_allfloor);

		$criteria->compare('sb_cancut',$this->sb_cancut);

		$criteria->compare('sb_adrondegree',$this->sb_adrondegree);

		$criteria->compare('sb_recommendtrade',$this->sb_recommendtrade);

		$criteria->compare('sb_buildingage',$this->sb_buildingage,true);

		$criteria->compare('sb_sellorrent',$this->sb_sellorrent);

		$criteria->compare('sb_releasedate',$this->sb_releasedate);

		$criteria->compare('sb_updatedate',$this->sb_updatedate);

		$criteria->compare('sb_expiredate',$this->sb_expiredate);

		$criteria->compare('sb_tag',$this->sb_tag,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}