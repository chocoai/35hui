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
    public static $sb_shoptype = array(
        '1'=>"沿街商铺/商业街",
        '2'=>"购物中心/综合体/卖场",
        '3'=>"住宅/社区商铺",
        '4'=>"写字楼配套底商",
        '5'=>"酒店底商",
        '6'=>"旅游商铺",
        
        
    );
    public static $sb_profession = array(
        '1'=>"超市零售",
        '2'=>"餐饮美食",
        '3'=>"服饰鞋包",
        '4'=>"休闲娱乐",
        '5'=>"生活服务",
        '6'=>"居家建材",
        '7'=>"酒店宾馆",
        '8'=>"美容美发",
        '9'=>"电子通讯",
        '10'=>"其他",
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

    public static $paytype = array(
        "1"=>"1个月",
        "2"=>"2个月",
        "3"=>"3个月",
        "6"=>"6个月",
        "12"=>"12个月",
    );
    public static $mortgagetype = array(
        "0"=>"0个月",
        "1"=>"1个月",
        "2"=>"2个月",
        "3"=>"3个月",
        "6"=>"6个月",
        
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
    public static $rengtype = array(
        "1"=>"出租",
        "2"=>"转让",
    );
    public static $sb_businesstype = array(
        "1"=>"营业中",
        "2"=>"空铺",
        "3"=>"新铺",
    );
    /**
     *推荐业态
     */
    public static $sb_recommendtrade = array(
        "1"=>"全行业",
        "2"=>"餐饮美食(包括中餐、西餐、小吃、咖啡、茶坊、熟食、面包房、快餐、奶茶铺)",
        "3"=>"娱乐休闲(包括夜总会、酒吧、KTV歌城、足浴、桑拿、会所、健身中心、网吧、美容美发、游艺厅)",
        "4"=>"百货零售(包括服装店、鞋店、超市、大卖场、便利店、医药房、婚纱店、母婴用品店、烟酒店、眼镜店、文具店)",
        "5"=>"公司工厂",
        "6"=>"其他服务业(包括宾馆酒店、文化教育、洗衣清洁、维修配件、宠物、房产中介、电脑复印、旅行社、人才中介、法律服务、养老院、摄影店、会计服务)",
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
			array('sb_uid, sb_shoptype, sb_province, sb_city,sb_district, sb_section, sb_shopaddress, sb_sellorrent, sb_releasedate, sb_expiredate, sb_check', 'required'),
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
            //'buildingInfo'=>array(self::BELONGS_TO,'Systembuildinginfo','sb_sysid'),
           // 'shopTag'=>array(self::HAS_ONE,'Shoptag','st_shopid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sb_shopid' => 'Sb Shopid',
			'sb_uid' => 'Sb Uid',
			'sb_shoptype' => 'Sb Shoptype',
			'sb_province' => 'Sb Province',
			'sb_city' => 'Sb City',
			'sb_district' => 'Sb District',
			'sb_section' => 'Sb Section',
			'sb_busway' => 'Sb Busway',
			'sb_shopaddress' => 'Sb Shopaddress',
			'sb_shopfronttype' => 'Sb Shopfronttype',
			'sb_propertycomname' => 'Sb Propertycomname',
			'sb_propertycost' => 'Sb Propertycost',
			'sb_shoparea' => 'Sb Shoparea',
			'sb_shopusablearea' => 'Sb Shopusablearea',
			'sb_loop' => 'Sb Loop',
			'sb_floor' => 'Sb Floor',
            'sb_towards'=>"朝向",
			'sb_cancut' => 'Sb Cancut',
			'sb_adrondegree' => 'Sb Adrondegree',
			'sb_recommendtrade' => 'Sb Recommendtrade',
			'sb_buildingage' => 'Sb Buildingage',
			'sb_sellorrent' => 'Sb Sellorrent',
			'sb_releasedate' => 'Sb Releasedate',
			'sb_updatedate' => 'Sb Updatedate',
			'sb_expiredate' => 'Sb Expiredate',
            'sb_order' => 'Sb Order',
            'sb_visit' => 'Sb Visit',
			'sb_tag' => 'Sb Tag',
			'sb_check' => 'Sb Check',
			'sb_panorama' => 'Sb Panorama',
			'sb_profession' => 'Sb Profession',
			'sb_businesstype' => 'Sb Businesstype',
		);
	}

     /**
     * 估计条件，查询本楼盘下的房源。此方法只查找房源中的面积、租金、售价
     * @param <type> $buildid
     * @param <type> $condition
     * @return <type>
     */
    public function getSourceByUagnet($userId,$condition,$rentOrsale){
        $type=1;
        if($rentOrsale==3){
            $rentOrsale=1;
            $type=2;
        }
        $criteria=new CDbCriteria();
        $templete = array("area","rPrice","sPrice");
        $buildContition = array("district","section","metro");
        $conditionArr = SearchMenu::explodeAllParamsToArray($condition);//所有的条件
        $inPutSearch = SearchMenu::getAllInPutSearch();//所有的input输入
        $criteria->addColumnCondition(array("sb_uid"=>$userId,"sb_check"=>4,"sb_sellorrent"=>$rentOrsale));
        if($rentOrsale==1){
            $criteria->with=array("rentInfo"=>array(
                   'condition'=>"sr_renttype ={$type}",
                )
            );
        }
        $newGet = array();
        foreach($conditionArr as $key=>$value){
            if(array_search($key, $templete)!==false){
                $newGet[$key] = $value;
            }elseif(array_key_exists($key, $inPutSearch)&&array_search($inPutSearch[$key], $templete)!==false){//看看在不在input中
                $newGet[$key] = $value;
            }elseif(array_search($key, $buildContition)!==false){
                $newGet[$key] = $value;
               // $criteria->with[] = "parkbaseinfo";
            }
        }
        $criteria = $this->getTempleteSearchCriteria($criteria, $newGet);

        $regionParamToColumn = array(
                'district'=>'sb_district',
        );
 
 
        $regionParams = SearchMenu::getRegionParams();//得到地区搜索条件参数名称集合
        foreach($regionParams as $regionParam) {
            if(isset($newGet[$regionParam]) && $newGet[$regionParam]!="") {
                if(array_key_exists($regionParam,$regionParamToColumn)) {
                    $criteria->addColumnCondition(array($regionParamToColumn[$regionParam]=>$newGet[$regionParam]));
                }
            }
        }
       $criteria->order = "sb_updatedate desc";
        $all = self::model()->findAll($criteria);
        //排序结束
        return $all;
    }
     public function getTmpSourceByUagent($all,$start,$length){
        $return = array();
        $tmpSource = array_slice($all, $start, $length);
        foreach($tmpSource as $value){
            $tmp = array();
            $tmp["name"] = common::strCut($value->presentInfo->sp_shoptitle,30);
            $tmp["floortype"] = Region::model()->getNameById($value->sb_district)."&nbsp;".Region::model()->getNameById($value->sb_section);
            $tmp["officearea"] = $value->sb_shoparea;
            if($value->rentInfo){
                if($value->rentInfo->sr_paytype==1){
                    $tmp["price"] = $value->rentInfo->sr_rentprice?$value->rentInfo->sr_rentprice ."元/㎡•天":"暂无";
                }else{
                            $tmp1="转让费面议";
                            if($value->rentInfo->sr_transferprice>0){
                                $tmp1="{$value->rentInfo->sr_transferprice}万";
                            }else if($value->rentInfo->sr_transferprice=="0"){
                                $tmp1="无转让费";
                            }
                             $tmp["price"]=$tmp1;
                  
                }
                 $tmp["propertyprice"] = $value->rentInfo->sr_monthrentprice?$value->rentInfo->sr_monthrentprice ."元/月":"暂无";
            }else{
                $tmp["price"] = $value->sellInfo->ss_avgprice?$value->sellInfo->ss_avgprice ."元/㎡":"暂无";
                $tmp["propertyprice"] = $value->sellInfo->ss_sumprice?$value->sellInfo->ss_sumprice ."万":"暂无";
            }
            $tmp["link"] = Yii::app()->createUrl("/shop/view",array("id"=>$value['sb_shopid']));
            $tmp["namelink"] = Yii::app()->createUrl("/shop/view",array("id"=>$value['sb_shopid']));;
            $return[] = $tmp;
        }
        return $return;
    }
    public function getTempleteSearchCriteria($criteria,$get){
        $searchParams = SearchMenu::getSearchConditionParams();//得到其他搜索条件参数名称集合
        $searchParams = array_diff($searchParams,array('type'));//过滤掉已有的type类型
        $inPutSearch = SearchMenu::getAllInPutSearch();//所有的input输入
        foreach($get as $key=>$value){
            if(in_array($key, $searchParams)){//直接搜索
                $searchCondition =$this->getSearchCondition($value);//根据搜索条件的id得到搜索信息
                if($searchCondition){
                    $pkey = array_search($key, $searchParams);
                    $criteria->addCondition($searchCondition['field'].">=".$searchCondition['min']." and ".$searchCondition['field']."<=".$searchCondition['max']);

                }
            }elseif(array_key_exists($key, $inPutSearch)){//看看是否是自动输入的
                $filed = $this->getInputSearchConditionFiled($inPutSearch[$key]);
                if($inPutSearch[$key]."a"==$key){//大于
                    $criteria->addCondition($filed.">=".$value);
                }else{//小于等于
                    $criteria->addCondition($filed."<=".$value);
                }
            }
        }
        return $criteria;
    }
    /**
     *通过楼盘id，得到当前楼盘正在租和售的楼信息
     * @param <int> $sysid 楼盘id
     * @param <int> $sellorrent 租售信息 1租 2售
     * @param <int> $limit 限制查询多少
     * @return <type>
     */
    public function getShopInfoByBuildid($sysid,$sellorrent,$limit=10){
        $criteria = new CDbCriteria;
        $criteria->limit=$limit;
        if($sellorrent==1){
            $criteria->with=array('rentInfo');
        }else{
            $criteria->with=array('sellInfo');
        }
        $criteria->with=array('shopTag');
        $criteria->addColumnCondition(array('sb_check'=>'4'));
        $criteria->order= "sb_updatedate desc";
        return Shopbaseinfo::model()->findAllByAttributes(array('sb_sysid'=>$sysid,'sb_sellorrent'=>$sellorrent),$criteria);
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

		$criteria->compare('sb_uid',$this->sb_uid);

		$criteria->compare('sb_shoptype',$this->sb_shoptype);

		$criteria->compare('sb_province',$this->sb_province);

		$criteria->compare('sb_city',$this->sb_city);

		$criteria->compare('sb_district',$this->sb_district);

		$criteria->compare('sb_section',$this->sb_section);

		$criteria->compare('sb_busway',$this->sb_busway,true);

		$criteria->compare('sb_shopaddress',$this->sb_shopaddress,true);

		$criteria->compare('sb_shopfronttype',$this->sb_shopfronttype);

		$criteria->compare('sb_propertycomname',$this->sb_propertycomname,true);

		$criteria->compare('sb_propertycost',$this->sb_propertycost);

		$criteria->compare('sb_shoparea',$this->sb_shoparea);

		$criteria->compare('sb_shopusablearea',$this->sb_shopusablearea);

		$criteria->compare('sb_loop',$this->sb_loop);

		$criteria->compare('sb_floor',$this->sb_floor,true);

        $criteria->compare('sb_towards',$this->sb_towards);

		$criteria->compare('sb_cancut',$this->sb_cancut);

		$criteria->compare('sb_adrondegree',$this->sb_adrondegree);

		$criteria->compare('sb_recommendtrade',$this->sb_recommendtrade);

		$criteria->compare('sb_buildingage',$this->sb_buildingage,true);

		$criteria->compare('sb_sellorrent',$this->sb_sellorrent);

		$criteria->compare('sb_releasedate',$this->sb_releasedate);

		$criteria->compare('sb_updatedate',$this->sb_updatedate);

		$criteria->compare('sb_expiredate',$this->sb_expiredate);

		$criteria->compare('sb_order',$this->sb_order);

		$criteria->compare('sb_visit',$this->sb_visit);

		$criteria->compare('sb_tag',$this->sb_tag,true);

		$criteria->compare('sb_check',$this->sb_check);

		$criteria->compare('sb_panorama',$this->sb_panorama);

		$criteria->compare('sb_profession',$this->sb_profession);
		
		$criteria->compare('sb_businesstype',$this->sb_businesstype);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     *保存出租商铺信息
     * @param <type> $shopBaseInfoModel
     * @param <type> $shopFacilityInfoModel
     * @param <type> $shopPresentInfoModel
     * @param <type> $shopTagModel
     * @param <type> $shopRentInfoModel
     * @param <type> $picture
     * @return <type>
     */
    public function saveRentShop($shopBaseInfoModel,$shopFacilityInfoModel,$shopPresentInfoModel,$shopRentInfoModel,$picture){
        if($shopBaseInfoModel->save()){
            $shopId = $shopBaseInfoModel->sb_shopid;

            $shopFacilityInfoModel->sf_shopid = $shopId;
            $shopFacilityInfoModel->save();

            $shopPresentInfoModel->sp_shopid = $shopId;
            $shopPresentInfoModel->save();


            $shopRentInfoModel->sr_shopid = $shopId;
            $shopRentInfoModel->save();
            //保存图片
            Picture::model()->insertImg($picture,$shopId,Picture::$sourceType['shopbaseinfo']);//默认使用最后上传的图片做为标题图
            return $shopId;
        }else{
            echo "<pre>";
            print_r($shopBaseInfoModel);
            return false;
        }
    }
    /**
     *通过传入的shopid得到商业广场在租和在售的数目
     * @param <type> $sysid
     * @return <array> 租售数组。array(租，售);
     */
    public function getRentAndSellNum($sysid){
        $list = $this->findAll("sb_sysid=:sb_sysid",array("sb_sysid"=>$sysid));
        $rentNum = 0;
        $sellNum = 0;
        if($list!=""){
            foreach($list as $value){
                if($value->sb_sellorrent==1){
                    $rentNum += 1;
                }elseif($value->sb_sellorrent==2){
                    $sellNum += 1;
                }
            }
        }
        return array('rent'=>$rentNum,'sell'=>$sellNum);
    }
    /**
     *保存出售商铺信息
     * @param <type> $shopBaseInfoModel
     * @param <type> $shopFacilityInfoModel
     * @param <type> $shopPresentInfoModel
     * @param <type> $shopTagModel
     * @param <type> $shopSellInfoModel
     * @param <type> $picture
     * @return <type> 
     */
    public function saveSellShop($shopBaseInfoModel,$shopFacilityInfoModel,$shopPresentInfoModel,$shopSellInfoModel,$picture){
        if($shopBaseInfoModel->save()){
            $shopId = $shopBaseInfoModel->sb_shopid;

            $shopFacilityInfoModel->sf_shopid = $shopId;
            $shopFacilityInfoModel->save();

            $shopPresentInfoModel->sp_shopid = $shopId;
            $shopPresentInfoModel->save();


            $shopSellInfoModel->ss_shopid = $shopId;
            $shopSellInfoModel->save();

            //保存图片
            Picture::model()->insertImg($picture,$shopId,Picture::$sourceType['shopbaseinfo']);//默认使用最后上传的图片做为标题图
            return $shopId;
        }else{
            return false;
        }
    }
    /**
     *检查传入id是否属于当前用户
     * @param <array> $shopIdArr
     * @return <boolean>
     */
    public function checkShopIdIsCurrentUser($shopIdArr){
        $return = true;
        $nowId = Yii::app()->user->id;
        if($shopIdArr){
            foreach($shopIdArr as $value){
                $shopBaseInfo = $this->findByPk($value);
                if(!$shopBaseInfo||$nowId != $shopBaseInfo->sb_uid){
                    $return = false;
                }
            }
        }
        return $return;
    }
    /**
     * 通过页面，位置，类型，得到精选
     */
    public function getBusinessBidd($p_page,$p_position,$positiontype){
        $criteria = new CDbCriteria;
        $criteria->condition = "sp_state = 1";
        $criteria->with = array(
            'productgrid'=>array(
                'condition'=>'p_page='.$p_page.' and p_position='.$p_position.' and p_positiontype='.$positiontype,
                'order'=>'p_index',
            ),
        );
        $list = Buyproduct::model()->findAll($criteria);
        return $list;
    }
    /**
     * 查询符合条件的数据
     * @param <string> 是出租还是出售,值为:rent sale
     * @param <type> $condition 固定的搜索条件,格式为sql
     * @param <type> $params 参数
     * @return <type>
     */
    public function getDataProvider($get, $rentOrSale,$condition,$params=array()) {
        $regionParamToColumn = array(
            'province'=>'sb_province',
            'city'=>'sb_city',
            'district'=>'sb_district',
            'section'=>'sb_section',
        );
        $criteria=new CDbCriteria(array(
                'condition'=>$condition,
                'params'=>$params,
                'with'=>array(
                    'rentInfo'=>array(
                    ),
                 ),//留着给租金和售价条件使用
        ));
        if($rentOrSale=="rent"){
            $criteria->with=array(
                    'rentInfo'=>array(
                            'condition'=>"sr_renttype=1"
                    )
            );
        }
        if($rentOrSale=="transfer"){
            $criteria->with=array(
                    'rentInfo'=>array(
                            'condition'=>"sr_renttype=2"
                    )
            );
        }
        if($rentOrSale=="sale"){
            $criteria->with=array(
                    'sellInfo'=>array(
                           
                    )
            );
        }
       
        if(isset($get['keyword']) && $get['keyword']!="") {
            $keyword = urldecode($get['keyword']);
            $criteria->with=array(
                    'presentInfo'=>array(
                            'condition'=>"sp_shoptitle  LIKE '%{$keyword}%' "
                    )
            );
        }
        
        $searchParams = SearchMenu::getSearchConditionParams();//得到其他搜索条件参数名称集合
        $searchParams = array_diff($searchParams,array('type'));//过滤掉已有的type类型
        $regionParams = SearchMenu::getRegionParams();//得到地区搜索条件参数名称集合
        foreach($searchParams as $pkey=>$searchParam) {
            if(isset($get[$searchParam]) && $get[$searchParam]!="") {

                
                $searchCondition = $this->getSearchCondition($get[$searchParam]);//根据搜索条件的id得到搜索信息
                if($searchCondition) { 
                    if($pkey==20 || $pkey==30 ) {//查询租金和售价
                        if($rentOrSale=='sale' && $pkey==20) {
                            $withName = "sellInfo";
                            $criteria->with[$withName]=array('condition'=>$searchCondition['field'].">=".$searchCondition['min']." and ".$searchCondition['field']."<=".$searchCondition['max']);
                            if(isset($get['order'])){
                                if($get['order']=='smu'){//按总价升序
                                    $criteria->order =" ss_sumprice asc,sb_panorama desc,";
                                }elseif($get['order']=='smd'){//按总价降序
                                    $criteria->order =" ss_sumprice desc,sb_panorama desc,";
                                }elseif($get['order']=='vgu'){//按单价升序
                                    $criteria->order =" ss_avgprice asc,sb_panorama desc,";
                                }elseif($get['order']=='vgd'){//按单价降序
                                    $criteria->order =" ss_avgprice desc,sb_panorama desc,";
                                }

                            }
                        }elseif($rentOrSale=='rent'||$rentOrSale=='transfer' && $pkey==30) {
                            $withName = "rentInfo";
                            $criteria->with[$withName]=array('condition'=>$searchCondition['field'].">=".$searchCondition['min']." and ".$searchCondition['field']."<=".$searchCondition['max']);
                            if(isset($get['order'])){
                                if($get['order']=='ru'){//按租金升序
                                    $criteria->order =" sr_rentprice asc,sb_panorama desc,";
                                }elseif($get['order']=='rd'){//按租金降序
                                    $criteria->order =" sr_rentprice desc,sb_panorama desc,";
                                }
                            }
                        }
                    }elseif($pkey==40) {//查询附近交通
                        $criteria->addSearchCondition($searchCondition['field'],$searchCondition['min']);
                    }elseif($pkey==56) {//查询房源
                        if($searchCondition['min']==2){//代表是个人房源
                            $criteria->with['user']=array('condition'=>$searchCondition['field']."=".User::personal);
                        }else{//代表的则是中介房源了,中介房源寻找门店和经纪人两种
                            $criteria->with['user']=array('condition'=>$searchCondition['field']." in (".User::agent.",".User::company.")");
                        }
                    }else {
                        $criteria->addCondition($searchCondition['field'].">=".$searchCondition['min']." and ".$searchCondition['field']."<=".$searchCondition['max']);
                    }
                }
            }
        }
        /*标签找房*/
        if(isset($get['tag'])&&$get['tag']!=""){
            $result = Tags::model()->findByPk($get['tag']);
            if(!empty($result)){
                if($criteria->condition==""){
                    $criteria->condition = "1";
                }
                $criteria->condition .= " and sb_tag like '%".$result['tag_name']."%'";
                //标签找房，标签点击后增加点击数
                $result->tag_frequency = $result->tag_frequency+1;
                $result->save();
            }
        }
        /*区域找房*/
        foreach($regionParams as $regionParam) {
            if(isset($get[$regionParam]) && $get[$regionParam]!="") {
                if(array_key_exists($regionParam,$regionParamToColumn)) {
                    $criteria->addColumnCondition(array($regionParamToColumn[$regionParam]=>$get[$regionParam]));
                }
            }
        }

        //得到其他的过滤条件
        $criteria = $this->getOtherOrderCondition($criteria,$get);
        //其他排序
        if(!isset($get['order'])||$get['order']==""){
            //$criteria->order ="sb_panorama desc,,sb_updatedate desc";old order
            $criteria->order ="sb_order desc,sb_updatedate desc";
            //$criteria->order ="sb_updatedate desc";
        }else{
            if($get['order']=='au'){//按面积升序
                $criteria->order =" sb_shoparea asc";
            }elseif($get['order']=='ad'){//按面积降序
                $criteria->order =" sb_shoparea desc";
            }
        }
        $dataProvider=new CActiveDataProvider('Shopbaseinfo', array(
                'pagination'=>array(
                    'pageSize'=>10,
                ),
                'criteria'=>$criteria,
        ));
        return $dataProvider;
    }
    /**
     * 根据条件的主键返回对应的条件
     * @param <type> $id 条件的主键id
     * @return <array> field:对应的条件字段 max:最大值 min:最小值
     */
    public function getSearchCondition($id) {
        $officeCondition=array(//用来对应officebaseinfo表中的条件字段(键对应的是searchcondition表中的大类sc_id,值对应的是officebaseinfo表中的字段名称)
            1=>'sb_sellorrent',
            6=>'sb_shoparea',
            15=>'sb_loop',
            20=>'ss_sumprice',//售价,这里对应的是officesellinfo表的字段
            30=>'sr_rentprice',//租价,这里对应的是officerentinfo表的字段
            40=>'sb_busway',//附近交通
            51=>'sb_adrondegree',//装修
            56=>'user_role',//房源,这里对应的user表中的字段,还需要特殊处理
            132=>'sb_profession',//商铺行业类别
            143=>'sr_monthrentprice',
            150=>'ss_sumprice',
        );
        if(!$id) {
            return array();
        }else {
            $result=array();
            $condition = Searchcondition::model()->findByPk($id);//得到数据库的对应搜索信息
            if($condition!=null && array_key_exists($condition->sc_parentid,$officeCondition)) {
                $result['field']=$officeCondition[$condition->sc_parentid];
                $result['max']=$condition->sc_maxvalue;
                $result['min']=$condition->sc_minvalue;
            }
            return $result;
        }
    }
    /**
     *得到其他的查询条件和排序条件
     * f排序 vgu单价升序 vgd单价降序 smu总价升序 smd总价降序 au面积升序 ad面积降序
     * type房源类型 1推荐房源 2多媒体房源 3全景房源 4急房源
     * @param <type> $criteria
     * @return <type>
     */
    public function getOtherOrderCondition($criteria,$get){
        //过滤排序状态
        if(isset($get['order'])&&$get['order']=="vgu"){//如果设置的单价的排序，并且排序向上
            if(!isset($criteria->with['sellInfo'])){
                $criteria->with['sellInfo']=array('order'=>'ss_avgprice');
            }else{
                $criteria->with['sellInfo']['order'] ='ss_avgprice';
            }
        }
        if(isset($get['order'])&&$get['order']=="vgd"){//如果设置的单价的排序，并且排序向下
            if(!isset($criteria->with['sellInfo'])){
                $criteria->with['sellInfo']=array('order'=>'ss_avgprice desc');
            }else{
                $criteria->with['sellInfo']['order'] ='ss_avgprice desc';
            }
        }
       
        if(isset($get['order'])&&$get['order']=="ru"){//如果设置的单价的排序，并且排序向上
            if(!isset($criteria->with['rentInfo'])){
                $criteria->with['rentInfo']=array('order'=>'sr_rentprice');
            }else{
                $criteria->with['rentInfo']['order'] ='sr_rentprice';
            }
        }
        if(isset($get['order'])&&$get['order']=="rd"){//如果设置的单价的排序，并且排序向下
            if(!isset($criteria->with['rentInfo'])){
                $criteria->with['rentInfo']=array('order'=>'sr_rentprice desc');
            }else{
                $criteria->with['rentInfo']['order'] ='sr_rentprice desc';
            }
        }
        if(isset($get['order'])&&$get['order']=="smu"){//如果设置的总价的排序，并且排序向下
            if(!isset($criteria->with['sellInfo'])){
                $criteria->with['sellInfo']=array('order'=>'ss_sumprice');
            }else{
                $criteria->with['sellInfo']['order'] ='ss_sumprice';
            }
        }
        if(isset($get['order'])&&$get['order']=="smd"){//如果设置的总价的排序，并且排序向下
            if(!isset($criteria->with['sellInfo'])){
                $criteria->with['sellInfo']=array('order'=>'ss_sumprice desc');
            }else{
                $criteria->with['sellInfo']['order'] ='ss_sumprice desc';
            }
        }
        if(isset($get['order'])&&$get['order']=="au"){//如果设置的面积的排序，并且排序向上
           $criteria->order = "sb_shoparea";
        }
        if(isset($get['order'])&&$get['order']=="ad"){//如果设置的面积的排序，并且排序向下
           $criteria->order = "sb_shoparea desc";
        }
        if(isset($get['order'])&&$get['order']=="rtime"){
           $criteria->order = "sb_releasedate desc";
        }
        //开始过滤显示房源类型
        /*if(isset($get['sourcetag'])&&$get['sourcetag']!=""){//如果只推荐房源
            if($criteria->with['shopTag']['condition']==""){
                $criteria->with['shopTag']['condition'] = "1";
            }
            switch ($get['sourcetag']){
                case 1: //推荐房源
                    $criteria->with['shopTag']['condition'] .= " and st_isrecommend=1";
                    break;
                case 2: //多媒体房源
                    $criteria->with['shopTag']['condition'] .= " and st_isvideo=1";
                    break;
                case 3: //全景房源
                    $criteria->with['shopTag']['condition'] .= " and sb_panorama=1";
                    break;
                case 4: //急房源
                    $criteria->with['shopTag']['condition'] .= " and st_ishurry=1";
                    break;
            }
        }
		*/
        //根据时间过滤
        if(isset($get['filterdate'])&&$get['filterdate']!=""){
            $filterdate = $get['filterdate'];
            $allFilterDate = Searchcondition::model()->getAllFilterDate();
            if(array_key_exists($filterdate, $allFilterDate)){//数据准确
                $condition = Searchcondition::model()->getConditionValue($filterdate);//得到查询值
                $time = time();
                $begin = $time-$condition['max'];//从当前时间减去数据库中保存的时间
                if($condition['max']!=0){//0是不限
                    $criteria->addBetweenCondition("sb_updatedate",$begin,$time);
                }
            }
        }
        return $criteria;
    }
     /**
     * 得到当前商铺价格相近楼盘
     * @param int $limit
     */
    public function getLikeBuild($limit=5){
        $gt = floor($limit/2)+1;
        $lt= $limit-$gt;
        $criteria=new CDbCriteria();
        if($this->sb_sellorrent==1){
            $criteria->with=array(
                    'rentInfo'=>array(
                    )
            );
            $criterie->select="sr_rentprice,sp_shoptitle,sb_shopaddress";
            $criteria->condition="sb_check=4 AND sr_rentprice >= ".$this->rentInfo->sr_rentprice." AND sb_district = ".$this->sb_district." AND sr_renttype = ".$this->rentInfo->sr_renttype." AND sb_sellorrent = ".$this->sb_sellorrent;
            $criteria->limit =  $gt;
            $gtrs=$this->findAll($criteria);

            $criteria->condition="sb_check=4 AND sr_rentprice < ".$this->rentInfo->sr_rentprice." AND sb_district = ".$this->sb_district." AND sr_renttype = ".$this->rentInfo->sr_renttype." AND sb_sellorrent = ".$this->sb_sellorrent;
            $criteria->limit = $lt;
            $ltrs=$this->findAll($criteria);
            
        }else if($this->sb_sellorrent==2){
            $criteria->with=array(
                    'sellInfo'=>array(
                    )
            );
           $criterie->select="ss_avgprice,sp_shoptitle,sb_shopaddress";
           $criteria->condition="sb_check=4 AND ss_avgprice >= ".$this->sellInfo->ss_avgprice." AND sb_district = ".$this->sb_district." AND sb_sellorrent = ".$this->sb_sellorrent;
           $criteria->limit =  $gt;
           $gtrs=$this->findAll($criteria);

           $criteria->condition="sb_check=4 AND ss_avgprice < ".$this->sellInfo->ss_avgprice." AND sb_district = ".$this->sb_district." AND sb_sellorrent = ".$this->sb_sellorrent;
           $criteria->limit =  $lt;
           $ltrs=$this->findAll($criteria);
            
        }
        
        
        //$lt = $limit-count($gtrs);
        //return $gtrs;
        return array_merge($gtrs,$ltrs);
     }
    /**
     *得到最新发布的全景房源
     * @param <type> $limit
     * @return <type>
     */
    public function getNewPanoramaSource($limit){
        $criteria=new CDbCriteria();
        $criteria->addColumnCondition(array("spn_sourcetype"=>2,"spn_state"=>2));
        $criteria->select = "spn_sourceid";
        $criteria->order = "spn_completetime desc";
        $criteria->group = "spn_sourceid";
        $criteria->limit = $limit;
        $panorama = Subpanorama::model()->findAll($criteria);
        $sourceIdArr = array();
        foreach($panorama as $value){
            $sourceIdArr[] = $value["spn_sourceid"];
        }

        $criteria=new CDbCriteria();
        $criteria->addInCondition("sb_shopid",$sourceIdArr);
        $criteria->addColumnCondition(array("sb_check"=>4));
        $criteria->with = array("shopTag");
        $model = $this->findAll($criteria);
        return $model;
    }
    /**
     *根据房源id，得到房源的第一个全景id
     * @param <type> $shopId
     */
    public function getPanoIdBySourceId($shopId){
        $url = Subpanorama::model()->getOnePanoramaBySourceIdAndSourceType($shopId, Subpanorama::shop);
        if($url==""){//如果房源没有全景，则用楼盘全景
            $shopInfo = Shopbaseinfo::model()->findByPk($shopId);
            $url = Panorama::model()->getTitlePanoramaByBuildId($shopInfo->sb_sysid);
        }
        if($url==""){//如果楼盘也没全景，则用房源标题图。
            $imgId = $shopInfo->presentInfo->sp_titlepicurl;
            $url = Picture::model()->getPicByTitleInt($imgId,"_large");
        }else{//如果找到全景。要从url中提取出全景id
            $url = substr($url, strrpos($url, "/")+1);
        }
        return $url;
    }

    /**
     *得到最近发布的商铺
     * @param <int> $sellOrRent 出租还是出售 1出租2出售
     * @param <int> $limit 搜索条数
     */
    public function getRecentShop($sellOrRent,$limit){
        $sellOrRentType=$sellOrRent==2?2:1;
        $criteria=new CDbCriteria();
        $criteria->with = array("rentInfo","sellInfo","presentInfo");
        $criteria->addColumnCondition(array(
            "sb_sellorrent"=>$sellOrRentType,
            "sb_check"=>4,
        ));
        if($sellOrRent==3){
            $criteria->addCondition("sr_renttype=2");
            $renttype=2;
        }
        if($sellOrRent==1){
            $criteria->addCondition("sr_renttype=1");
        }
        $criteria->limit = $limit;
        $criteria->order = "sb_releasedate desc";
        $all= Shopbaseinfo::model()->findAll($criteria);
        return $all;
    }
    /**
     * 让已经过期的房源下线
     */
    public function updateOutTimeSource(){
        //先查找所有发布的已过期房源
        $time = time();
        $criteria=new CDbCriteria();
        $criteria->addCondition("sb_releasedate+sb_expiredate<".$time);
        $criteria->addColumnCondition(array("sb_check"=>4));
        $criteria->with = array("shopTag");
        $criteria->select = "sb_shopid";
        $all = Shopbaseinfo::model()->findAll($criteria);
        $ids = array();
        if($all){
            foreach($all as $value){
                $ids[] = $value["sb_shopid"];
            }
            $criteria=new CDbCriteria();
            //$criteria->addInCondition("st_shopid",$ids);
            Shoptag::model()->updateAll(array("sb_check"=>6),$criteria);
        }
        return $ids;
    }
    /**
     * 计算当前用户房源的排序分数
     */
    public function calculateOrder($id){
        $order=common::getOrderConfig('new');
        /*$tmodel=Shoptag::model()->find('st_shopid='.$id);
        if($tmodel){
            if($tmodel->st_isrecommend) $order+=common::getOrderConfig('recommend');
            if($tmodel->st_ishurry) $order+=common::getOrderConfig('hurry');
            if($tmodel->sb_panorama) $order+=common::getOrderConfig('subpanorama');
            if($tmodel->st_ishigh) $order+=common::getOrderConfig('high');
        }*/
        return $order;
    }
}