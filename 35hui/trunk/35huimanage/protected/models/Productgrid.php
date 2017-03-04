<?php

/**
 * This is the model class for table "{{productgrid}}".
 *
 * The followings are the available columns in table '{{productgrid}}':
 * @property integer $p_id
 * @property integer $p_page
 * @property integer $p_position
 * @property integer $p_index
 * @property integer $p_positiontype
 * @property integer $p_baseprice
 * @property integer $p_nowprice
 * @property double $p_raisespercent
 * @property double $p_droppercent
 * @property integer $p_maxbuydays
 * @property integer $p_protectpricedays
 * @property integer $p_lastbuytime
 * @property integer $p_lastbuydatys
 */
class Productgrid extends CActiveRecord
{
    //页面类型
    public static $p_page = array(
        1 => '楼盘中心首页',
        2 => '写字楼出租',
        3 => '写字楼出售',
        4 => '商务中心首页',
        5 => '商务中心出租',
        6 => '商务中心出售',
        7 => '写字楼首页',
        8 => '中介公司首页',
        9 => '商铺首页',
        10 =>'商铺出租',
        11 =>'商铺出售',
        12 =>'商业广场首页',
        13 =>'住宅首页'
    );
    //页面位置
    public static $p_position = array(
        1 => '精品写字楼推荐',
        2 => '经纪人推荐',
        3 => '商务中心推荐',
        4 => '全景楼盘推荐',
        5 => '商务中心精选',
        6 => '顶部展示格',
        7 => '品牌中介图片',
        8 => '品牌中介文字',
        9 => '金牌经纪人',
        10 => '精品商铺推荐',
        11 => '全景商业广场推荐',
        12 => '中介公司推荐',
    );
    //位置类型
    public static $p_positiontype = array(
        1 => "写字楼",
        2 => "商铺",
        3 => "经纪人",
        4 => "中介公司",
        5 => "楼盘",
        6 => "商务中心",
        7 => '商业广场',
        8 => '小区',
        9 => '住宅',
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Productgrid the static model class
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
		return '{{productgrid}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('p_id, p_page, p_position, p_index, p_positiontype, p_baseprice, p_nowprice, p_maxbuydays, p_protectpricedays, p_lastbuytime, p_lastbuydatys', 'numerical', 'integerOnly'=>true),
			array('p_raisespercent, p_droppercent', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('p_id, p_page, p_position, p_index, p_positiontype, p_baseprice, p_nowprice, p_raisespercent, p_droppercent, p_maxbuydays, p_protectpricedays, p_lastbuytime, p_lastbuydatys', 'safe', 'on'=>'search'),
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
			'p_id' => 'P',
			'p_page' => '页面',
			'p_position' => '模块',
			'p_index' => '位置',
			'p_positiontype' => '模块类型',
			'p_baseprice' => '基本价格',
			'p_nowprice' => '当前竞标价',
			'p_raisespercent' => '涨价比例',
			'p_droppercent' => '降价比例',
			'p_maxbuydays' => '最大购买天数',
			'p_protectpricedays' => '购买保护天数',
			'p_lastbuytime' => '最后一次购买时间',
			'p_lastbuydatys' => '最后一次购买天数',
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

		$criteria->compare('p_id',$this->p_id);

		$criteria->compare('p_page',$this->p_page);

		$criteria->compare('p_position',$this->p_position);

		$criteria->compare('p_index',$this->p_index);

		$criteria->compare('p_positiontype',$this->p_positiontype);

		$criteria->compare('p_baseprice',$this->p_baseprice);

		$criteria->compare('p_nowprice',$this->p_nowprice);

		$criteria->compare('p_raisespercent',$this->p_raisespercent);

		$criteria->compare('p_droppercent',$this->p_droppercent);

		$criteria->compare('p_maxbuydays',$this->p_maxbuydays);

		$criteria->compare('p_protectpricedays',$this->p_protectpricedays);

		$criteria->compare('p_lastbuytime',$this->p_lastbuytime);

		$criteria->compare('p_lastbuydatys',$this->p_lastbuydatys);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     *通过传入页面id，得到页面名称
     * @param <int> $p_page
     */
    public function getPageName($p_page){
        if(isset(self::$p_page[$p_page])){
            return self::$p_page[$p_page];
        }
    }
    /**
     *通过传入位置id，得到位置名称
     * @param <int> $p_position
     */
    public function getPositionName($p_position){
        if(isset(self::$p_position[$p_position])){
            return self::$p_position[$p_position];
        }
    }
    /**
     *通过传入的页面id和位置id，得到此位置下的所有格子
     * @param <int> $p_page
     * @param <int> $p_position
     * @return <array>
     */
    public function getIndex($p_page, $p_position){
        $criteria = new CDbCriteria;
        $criteria->addColumnCondition(array(
            "p_page"=>$p_page,
            "p_position"=>$p_position,
        ));
        $districtInfo = Productgrid::model()->findAll($criteria);
        return $districtInfo;
    }
     /**
     *判断一个位置是否可以购买。只针对房源。
     * @param <type> $p_id 位置主键
     * @return <boolean>
     */
    public function checkPositionCanBuy($p_id) {
        //判断规则：站点后台不考虑抢购过程，一旦上线，则会一直上线
        $model = Buyproduct::model()->findByAttributes(array("sp_positionid"=>$p_id,"sp_state"=>"0"));
        if($model){
            return false;
        }else{
            return true;
        }
    }
     /**
     *通过id得到此位置的类型
     * @param <int> $p_id
     * @return <int>
     */
    public function getPositionTypeByPk($p_id){
        $row = Productgrid::model()->findByPk($p_id);
        return $row->p_positiontype;
    }
    /**
     *得到例子图片
     * @param <type> $page 推荐的页面
     * @param <type> $positopn 推荐的位置
     * @return <type>
     */
    public function getRecommendImageByPageAndPosition($page,$positopn){
        $image = "#";
        if(key_exists($page, self::$p_page)&&key_exists($positopn, self::$p_position)){
            $image = IMAGE_URL."/recommend_image/".$page."_".$positopn."_recommend.jpg";
        }
        return $image;
    }
}