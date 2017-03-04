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
     *通过传入最大购买天数，得到一个可以生成select的数组。
     * @param <int> $maxDdays 最大购买天数
     * @return <array>
     */
    public function formatMaxDaysToArray($maxDdays) {
        $return = array();
        for($i=1;$i<$maxDdays+1;$i++) {
            $return[$i] = $i."天";
        }
        return $return;
    }
    /**
     *得到根据索引的中文描述
     * @param <int> $index 索引
     * @param <string> $prefix 前缀
     * @return <string>
     */
    public function getChineseIndexName($index, $prefix = "位置") {
        $base = array(
            "0"=>"十",
            "1"=>"一",
            "2"=>"二",
            "3"=>"三",
            "4"=>"四",
            "5"=>"五",
            "6"=>"六",
            "7"=>"七",
            "8"=>"八",
            "9"=>"九",
            "10"=>"十",
        );
        $return = "";
        if($index<=10){
            $return = array_key_exists($index, $base)?$base[$index]:"";
        }elseif($index<20&&$index>10){
            $gewei = substr($index, 1);
            $gewei = array_key_exists($gewei, $base)?$base[$gewei]:"";
            $return = $base[0].$gewei;
        }elseif($index==20){
            $return = "二十";
        }
        $return = $prefix.$return;
        return $return;
    }
    /**
     *判断一个位置是否可以购买。只针对房源。
     * @param <type> $p_id 位置主键
     * @return <boolean>
     */
    public function checkPositionCanBuy($p_id) {
        //判断规则：通过最后购买时间来计算，如果最后购买时间*价格保护天数*86400大于当前时间，则不可以购买。反之则可以购买
        $model = $this->findByPk($p_id);
        if(!$model){
            return false;
        }
        $nowTime = time();//当前时间
        $protectTime = $model->p_lastbuytime+$model->p_protectpricedays*86400;//价格保护时间
        if($protectTime>$nowTime){//不可以购买
            return false;
        }else{
            return true;//可以购买
        }
    }
    /**
     *判断一个位置是否可以被购买，同一个板块只能被同一个用户购买一次。如果购买的已经过期，则可以继续购买
     * @param <type> $p_id 位置主键
     * @return <string> success可以购买 fal_1已经购买了同一个模块，不能继续购买。 fal_2等待抢购时间
     */
    public function checkPositionCanBuyUserType($p_id) {
        $time = time();
        $userId = Yii::app()->user->id;
        //得到所有同级的页面板块
        $pidarr = $this->getSamePageAndPositionIdsByPk($p_id);
        
        //如果用户已经购买过同一个模块，且正在使用，则不能购买
        $criteria = new CDbCriteria;
        $criteria->addColumnCondition(array(
            "sp_userid"=>$userId,
            "sp_state"=>0,
        ));
        $criteria->addInCondition("sp_positionid",$pidarr);
        $criteria->addCondition("`sp_buydays` *86400+`sp_buytime` >".$time);
        $nowOnline = Buyproduct::model()->find($criteria);
        if($nowOnline){
            return "fal_1";
        }
        //如果用户还没购买过此模块。则只需要判断此位置的保护时间
        if($this->checkPositionCanBuy($p_id)){
            return "success";
        }else{
            return "fal_2";
        }
    }
    /**
     *得到可以购买的时间
     * @param <type> $p_id
     * @return <type>
     */
    public function getCanBuyTime($p_id) {
        $model = $this->findByPk($p_id);
        $return = "<font style='color:red'>现在可抢购</font>";
        if($model->p_lastbuytime&&$model->p_protectpricedays){
            $lastTime = $model->p_lastbuytime+$model->p_protectpricedays*86400;
            $now = time();
            if($now<$lastTime){
                $return = date("Y-m-d H:i", $lastTime);
            }
        }
        return $return;
    }
    /**
     *判断一个位置是否能够使用修改功能
     * @param <type> $p_id
     * @return <boolean>
     */
    public function checkPositionCanUpdate($p_id){
        $model = $this->findByPk($p_id);
        if(!$model){
            return false;
        }
        if(in_array($model->p_positiontype,array(3,4))){//用户类型的精品不能使用修改功能
            return false;
        }
        return true;
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
     *通过传入的主键id，返回与此id在同一个页面位置的所有id
     * @param <type> $p_id 主键
     * @return <type> id数组
     */
    public function getSamePageAndPositionIdsByPk($p_id){
        $row = Productgrid::model()->findByPk($p_id);
        $ids = array();
        if($row){
            $all = Productgrid::model()->findAllByAttributes(array("p_page"=>$row->p_page,"p_position"=>$row->p_position));
            foreach($all as $value){
                $ids[] = $value->p_id;
            }
        }
        return $ids;
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
    /**
     *获得最后一次购买总共花费的新币
     * @param <type> $p_id 位置id
     * @return <integer>
     */
    public function getLastBuyUsePrice($p_id) {
        $model = Buyproduct::model()->findByAttributes(array("sp_positionid"=>$p_id,"sp_state"=>0));
        $return = 0;
        if($model){
            $return = $model->sp_buyprice*$model->sp_buydays;
        }
        return $return;
    }
}