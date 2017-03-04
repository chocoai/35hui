<?php

/**
 * This is the model class for table "{{officebaseinfo}}".
 *
 * The followings are the available columns in table '{{officebaseinfo}}':
 * @property integer $ob_officeid
 * @property integer $ob_sysid
 * @property integer $ob_uid
 * @property double $ob_officearea
 * @property integer $ob_floortype
 * @property integer $ob_adrondegree
 * @property integer $ob_sellorrent
 * @property integer $ob_releasedate
 * @property integer $ob_updatedate
 * @property integer $ob_expiredate
 * @property integer $ob_visit
 * @property double $ob_rentprice
 * @property integer $ob_monthrentprice
 * @property integer $ob_avgprice
 * @property double $ob_sumprice
 * @property integer $ob_titlepicurl
 * @property integer $ob_ispanorama
 * @property integer $ob_check
 * @property string $ob_introduce
 * @property integer $ob_pricecheck
 */
class Officebaseinfo extends CActiveRecord
{
    public static $recentOfficeViewCookieName = "rentOfficeView";//记录最近浏览的写字楼房源id.cookie名称
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
        2 => '创意办公室',
        3 => '写字楼',
    );

    //写字楼性质
    public static $officeType = array(
        1 => '商住楼',
        2 => '纯写字楼',
        3 => '商业综合体楼',
        4 => '酒店写字楼',
    );

    //写字楼级别
    public static $officedegree = array(
        1 => '甲级',
        2 => '乙级',
        3 => '丙级',
        4 => '丁级',
    );

    //装修程度
    public static $adrondegree = array(
        1 => '毛坯',
        2 => '简单装修',
        3 => '精装修',
        4 => '豪华装修',
    );

    public static $yesno = array(
        1 => '是',
        0 => '否',
    );

    //租售方式
    public static $rentorsell = array(
        1 => '出租',
        2 => '出售',
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
    const rent = 1;
    const sell = 2;
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
	//房源状态
    public static $ob_check = array(
        1=>"彻底删除",
        2=>"回收站",
        3=>"下线",
        4=>"已发布",
        5=>"未审核",
        6=>"已过期",
        7=>"已提交",
        8=>"草稿",
        9=>"违规",
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
			array('ob_sysid,ob_uid, ob_officearea, ob_sellorrent, ob_releasedate, ob_updatedate, ob_expiredate, ob_rentprice, ob_avgprice, ob_sumprice, ob_check', 'required'),
			array('ob_sysid, ob_uid, ob_floortype, ob_adrondegree, ob_sellorrent, ob_releasedate, ob_updatedate, ob_expiredate, ob_visit, ob_monthrentprice, ob_avgprice, ob_titlepicurl, ob_ispanorama, ob_check, ob_pricecheck', 'numerical', 'integerOnly'=>true),
			array('ob_officearea, ob_rentprice, ob_sumprice', 'numerical'),
			array('ob_introduce', 'length', 'max'=>1500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ob_officeid, ob_sysid, ob_introduce,ob_uid, ob_officearea, ob_floortype, ob_adrondegree, ob_sellorrent, ob_releasedate, ob_updatedate, ob_expiredate, ob_visit, ob_rentprice, ob_monthrentprice, ob_avgprice, ob_sumprice, ob_titlepicurl, ob_ispanorama, ob_check, ob_pricecheck', 'safe', 'on'=>'search'),
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
            'user'=>array(self::BELONGS_TO,'User','ob_uid'),
            'buildingInfo'=>array(self::BELONGS_TO,'Systembuildinginfo','ob_sysid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ob_officeid' => 'Ob Officeid',
			'ob_sysid' => '大楼',
			'ob_uid' => '用户',
			'ob_officearea' => '面积',
			'ob_floortype' => '楼层类型',
			'ob_adrondegree' => '装修程度',
			'ob_sellorrent' => '租售类型',
			'ob_releasedate' => '发布时间',
			'ob_updatedate' => '刷新时间',
			'ob_expiredate' => '有效期',
			'ob_visit' => '点击数',
			'ob_rentprice' => '日租金',
			'ob_monthrentprice' => '月租金',
			'ob_avgprice' => '均价',
			'ob_sumprice' => '总价',
			'ob_titlepicurl' => '标题图',
			'ob_ispanorama' => '是否有全景',
			'ob_check' => '状态',
			'ob_introduce' => '房源介绍',
			'ob_pricecheck' => 'Ob Pricecheck',
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

		$criteria->compare('ob_officeid',$this->ob_officeid);

		$criteria->compare('ob_sysid',$this->ob_sysid);

		$criteria->compare('ob_uid',$this->ob_uid);

		$criteria->compare('ob_officearea',$this->ob_officearea);

		$criteria->compare('ob_floortype',$this->ob_floortype);

		$criteria->compare('ob_adrondegree',$this->ob_adrondegree);

		$criteria->compare('ob_sellorrent',$this->ob_sellorrent);

		$criteria->compare('ob_releasedate',$this->ob_releasedate);

		$criteria->compare('ob_updatedate',$this->ob_updatedate);

		$criteria->compare('ob_expiredate',$this->ob_expiredate);

		$criteria->compare('ob_visit',$this->ob_visit);

		$criteria->compare('ob_rentprice',$this->ob_rentprice);

		$criteria->compare('ob_monthrentprice',$this->ob_monthrentprice);

		$criteria->compare('ob_avgprice',$this->ob_avgprice);

		$criteria->compare('ob_sumprice',$this->ob_sumprice);

		$criteria->compare('ob_titlepicurl',$this->ob_titlepicurl);

		$criteria->compare('ob_ispanorama',$this->ob_ispanorama);

		$criteria->compare('ob_check',$this->ob_check);
		
		$criteria->compare('ob_introduce',$this->ob_introduce,true);
		
		$criteria->compare('ob_pricecheck',$this->ob_pricecheck);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 通过省份查找写字楼信息
     * @param <type> $pro_id 省份id
     * @return <type>
     */
    public function findOfficeByProvince($pro_id=null) {
        $criteria = new CDbCriteria;
        if($pro_id!=null) {//没传id就找所有省的
            $criteria->condition = "ob_province=:pro_id";
            $criteria->params = array(":pro_id"=>$pro_id);
        }
        return $this->findAll($criteria);
    }
    /**
     * 通过城市查找写字楼信息
     * @param <type> $city_id 城市id
     * @return <type>
     */
    public function findOfficeByCity($city_id=null) {
        $criteria = new CDbCriteria;
        if($city_id!=null) {//没传id就找所有省的
            $criteria->condition = "ob_city=:city_id";
            $criteria->params = array(":city_id"=>$city_id);
        }
        return $this->findAll($criteria);
    }
    /**
     * 通过楼盘类型查找写字楼信息
     * @param <type> $buildingType 楼盘类型id
     * @return <type>
     */
    public function findOfficeByBuildingType($buildingType=null) {
        $criteria = new CDbCriteria;
        if($buildingType!=null) {//没传id就找所有省的
            $criteria->condition = "ob_buildingtype=:buildingType";
            $criteria->params = array(":buildingType"=>$buildingType);
        }
        return $this->findAll($criteria);
    }
    /**
     * 通过写字楼性质查找写字楼信息
     * @param <type> $officeType 写字楼性质id
     * @return <type>
     */
    public function findOfficeByOfficeType($officeType=null) {
        $criteria = new CDbCriteria;
        if($officeType!=null) {//没传id就找所有省的
            $criteria->condition = "ob_officetype=:officeType";
            $criteria->params = array(":officeType"=>$officeType);
        }
        return $this->findAll($criteria);
    }
    /**
     * 通过行政区查找写字楼信息
     * @param <type> $district_id 行政区id
     * @return <type>
     */
    public function findOfficeByDistrict($district_id=null) {
        $criteria = new CDbCriteria;
        if($district_id!=null) {//没传id就找所有省的
            $criteria->condition = "ob_district=:district_id";
            $criteria->params = array(":district_id"=>$district_id);
        }
        return $this->findAll($criteria);
    }
    /**
     * 通过版块查找写字楼信息
     * @param <type> $section_id 版块id
     * @return <type>
     */
    public function findOfficeBySection($section_id=null) {
        $criteria = new CDbCriteria;
        if($section_id!=null) {//没传id就找所有省的
            $criteria->condition = "ob_section=:section_id";
            $criteria->params = array(":section_id"=>$section_id);
        }
        return $this->findAll($criteria);
    }
    /**
     * 通过临近轨道路线查找写字楼信息
     * @param <type> $bus_id 轨道路线id
     * @return <type>
     */
    public function findOfficeByBusway($bus_id=null) {
        $criteria = new CDbCriteria;
        if($bus_id!=null) {//没传id就找所有省的
            $criteria->condition = "ob_busway=:bus_id";
            $criteria->params = array(":bus_id"=>$bus_id);
        }
        return $this->findAll($criteria);
    }
    public function findRentOffice() {
//        return $this->with(array(
//            'officerentinfo'=>array('condition'=>'officerentinfo.or_officeid')
//        ))->findAll();
        return $this->with('rentinfo')->findAll();
    }
    /**
     * 处理写字楼信息的附近交通信息字符串,得到公交路线集合和轨交路线集合
     * @param <string> $busway 附近交通信息字符串
     * @return <array> 二维数组,一维键为bus,train
     */
    public function dealBusWay($busway) {
        $trafficResult = array(
            'bus'=>array(),
            'train'=>array()
        );
        if($busway) {
            $traffics = explode(",",$busway);
            foreach($traffics as $traffic) {
                if(strlen($traffic)==3) {
                    array_push($trafficResult['bus'],$traffic);
                }else {
                    array_push($trafficResult['train'],$traffic);
                }
            }
        }
        return $trafficResult;
    }
    /**
     * 根据条件的主键返回对应的条件
     * @param <type> $id 条件的主键id
     * @return <array> field:对应的条件字段 max:最大值 min:最小值
     */
    public function getSearchCondition($id) {
        $officeCondition=array(//用来对应officebaseinfo表中的条件字段(键对应的是searchcondition表中的大类sc_id,值对应的是officebaseinfo表中的字段名称)
            1=>'ob_sellorrent',
            6=>'ob_officearea',
            15=>'sbi_loop',
            20=>'ob_sumprice',//售价,这里对应的是officesellinfo表的字段
            30=>'ob_rentprice',//租价,这里对应的是officerentinfo表的字段。写字楼和商铺使用
            91=>'ob_rentprice',//租价,这里对应的是officerentinfo表的字段。商务中心使用
            40=>'sbi_busway',//附近交通
            51=>'ob_adrondegree',//装修
            56=>'user_role',//房源,这里对应的user表中的字段,还需要特殊处理
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
     * 返回input搜索的栏位名称
     * @param <type> $name
     * @return <type>
     */
    public function getInputSearchConditionFiled($name){
        $officeCondition=array(
            "area"=>'ob_officearea',
            "rPrice"=>"ob_rentprice",
            "sPrice"=>"ob_sumprice",
        );
        $return = "";
        if(array_key_exists($name, $officeCondition)){
            $return = $officeCondition[$name];
        }
        return $return;
    }
    //得到写字楼级别
    public function getOfficeLevel($intLevel) {
        $level = "";
        if($intLevel>0 && $intLevel<=4) {
            switch($intLevel) {
                case 1:
                    $level = "甲级";
                    break;
                case 2:
                    $level = "乙级";
                    break;
                case 3:
                    $level = "丙级";
                    break;
                case 4:
                    $level = "丁级";
                    break;
            }
        }
        return $level;
    }
    /**
     * 得到装修程度
     * @param <int> $intFitment 装修值
     * @return <string>
     */
    public function getFitment($intFitment) {
        $fitment = "";
        if(array_key_exists($intFitment, self::$adrondegree)){
            $fitment = self::$adrondegree[$intFitment];
        }
        return $fitment;
    }
    /**
     *	根据写字楼ID获取其基本信息列表
     */
    public function getAllBusinessinfo($id) {
        $criteria = new CDbCriteria;
        return Officebaseinfo::model()->findAllByAttributes(array('ob_officeid'=>$id),$criteria);
    }

    /**
     * 根据写字楼ID获取其用户id
     * @param <int> $officeId 写字楼id
     * @return <int> 用户id
     */
    public function getUserIdByOfficeId($officeId){
        $dba = dba();
        $userId = $dba->select_one("SELECT `ob_uid` FROM `35_officebaseinfo` WHERE `ob_officeid`=?",$officeId);
        return $userId;
    }
    /**
     *	获取所有商务中心信息列表
     */
    public function getAllBusiness() {
        $criteria = new CDbCriteria;
        return Officebaseinfo::model()->findAllByAttributes(array('ob_officetype'=>1),$criteria);
    }

    /**
     *	获取同商圈商务中心信息列表
     */
    public function getTop10Business($tradecircle) {
        $criteria = new CDbCriteria;
        $criteria->limit=10;
        return Officebaseinfo::model()->findAllByAttributes(array('ob_officetype'=>1,'ob_tradecircle'=>$tradecircle),$criteria);
    }

    /**
     * 返回文本内容
     * @return string
     */
    public function getText($id) {
        $region = Region::model()->findByAttributes(array('re_id'=>$id));
        if($region) {
            return $region->re_name;
        }else {
            return "";
        }
    }

    /**
     * 返回楼盘类型的文字描述
     * @return string
     */
    public function getBuildingTypeText() {
        return self::$buildingType[$this->ob_buildingtype];
    }
    /*
     * 通过类型返回楼盘类型的文字描述
     */
    public function getBuildingTypeTextByType($buildingtype){
        return self::$buildingType[$buildingtype];
    }
    /**
     * 返回写字楼性质的文字描述
     * @return string
     */
    public function getOfficeTypeText() {
        return self::$officeType[$this->ob_officetype];
    }

    /**
     * 返回写字楼装修程度的文字描述
     * @return string
     */
    public function getAdrondegreeText() {
        return self::$adrondegree[$this->ob_adrondegree];
    }

    /**
     * 返回写字楼级别的文字描述
     * @return string
     */
    public function getOfficedegreeText() {
        return self::$officedegree[$this->ob_officedegree];
    }

    /**
     * 返回写字楼是否分割的文字描述
     * @return string
     */
    public function getCancutText() {
        return self::$yesno[$this->ob_cancut];
    }

    /**
     * 返回写字楼是否涉外的文字描述
     * @return string
     */
    public function getForeignText() {
        if($this->ob_foreign!=""){
            return self::$yesno[$this->ob_foreign];
        }else{
            return "暂无资料";
        }
    }

    /**
     * 返回写字楼租售方式的文字描述
     * @return string
     */
    public function getSellorrentText() {
        return self::$rentorsell[$this->ob_sellorrent];
    }
    /**
     * 根据楼层性质数字得到楼层性质描述信息
     * @param <int> $intFloorNature
     * @return <string>
     */
    public function getFloorNature($intFloorNature) {
        $floorNature = "单层";//默认是单层
        if($intFloorNature>0 && $intFloorNature<=3) {
            switch($intFloorNature) {
                case 1:
                    $floorNature = "单层";
                    break;
                case 2:
                    $floorNature = "多层";
                    break;
                case 3:
                    $floorNature = "整栋";
                    break;
            }
        }
        return $floorNature;
    }
    /**
     * 根据朝向数字得到朝向描述信息
     * @param <int> $intToward
     * @return <string>
     */
    public function getTowardName($intToward) {
        $towardName = "";
        switch($intToward) {
            case 1:
                $towardName = "东";
                break;
            case 2:
                $towardName = "南";
                break;
            case 3:
                $towardName = "西";
                break;
            case 4:
                $towardName = "北";
                break;
            case 5:
                $towardName = "东南";
                break;
            case 6:
                $towardName = "西南";
                break;
            case 7:
                $towardName = "西北";
                break;
            case 8:
                $towardName = "东北";
                break;
            case 9:
                $towardName = "南北";
                break;
            case 10:
                $towardName = "东西";
                break;
        }
        return $towardName;
    }
    /**
     * 根据公司得到公司的其他租房信息
     * @param <int> $comId 公司id
     * @param <int> $officeId 当前写字楼id
     * @param <int> $count 查出来的数量 默认为10
     * @return <array> 二维数组,键为:officename,rentprice
     */
    public function getOtherRentOfficeByCom($comId,$officeId,$count=10) {
        $dba = dba();
        $officeRentInfo = array();
        $userIds = $dba->select_col("select `ua_uid` from 35_uagent where `ua_comid`=?",$comId);
        if($userIds) {
            $userIds = implode(",",$userIds);
            $demosql = "SELECT
                          base.ob_officeid as officeid,
                          base.ob_officename AS officename,
                          rent.or_rentprice  AS rentprice
                        FROM 35_officebaseinfo base
                          JOIN 35_officerentinfo rent
                            ON base.ob_officeid = rent.or_officeid
                        WHERE base.ob_uid IN(".$userIds.") and base.ob_officeid not in (".$officeId.")
                        LIMIT 0,".$count.";";
            $officeRentInfo = $dba->select($demosql);
        }
        return $officeRentInfo;
    }
    /**
     * 根据公司得到公司的其他售房信息
     * @param <int> $comId 公司id
     * @param <int> $officeId 当前写字楼id
     * @param <int> $count 查出来的数量 默认为10
     * @return <array>
     */
    public function getOtherSellOfficeByCom($comId,$officeId,$count=10) {
        $dba = dba();
        $userIds = $dba->select_col("select `ua_uid` from 35_uagent where `ua_comid`=?",$comId);
        $officeSellInfo = "";
        if($userIds) {
            $userIds = implode(",",$userIds);
            $demosql = "SELECT
                          base.ob_officeid as officeid,
                          base.ob_officename AS officename,
                          sell.os_avgprice AS avgsellprice,
                          sell.os_sumprice  AS sellprice
                        FROM 35_officebaseinfo base
                          JOIN 35_officesellinfo sell
                            ON base.ob_officeid = sell.os_id
                        WHERE base.ob_uid IN(".$userIds.") and base.ob_officeid not in (".$officeId.")
                        LIMIT 0,".$count.";";
            $officeSellInfo = $dba->select($demosql);
        }
        return $officeSellInfo;
    }
    /**
     *通过楼盘id，得到当前楼盘正在租和售的楼信息
     * @param <int> $sysid 楼盘id
     * @param <int> $sellorrent 租售信息 1租 2售
     * @param <int> $limit 限制查询多少
     * @return <type>
     */
    public function getOfficeInfoByBuildid($sysid,$sellorrent,$limit=10){
        $criteria = new CDbCriteria;
        $criteria->limit=$limit;
        if($sellorrent==1){
            $criteria->with=array('rentInfo');
        }else{
            $criteria->with=array('sellInfo');
        }
        $criteria->with=array('offictag');
        $criteria->addColumnCondition(array('ot_check'=>'4'));
        $criteria->order= "ob_updatedate desc";
        return Officebaseinfo::model()->findAllByAttributes(array('ob_sysid'=>$sysid,'ob_sellorrent'=>$sellorrent),$criteria);
    }

    /**
     *通过房源类型，租售类型，得到最受欢迎房源。按点击数排序。
     * @param <int> $type 房源类型 1商务中心
     * @param <int> $sellorrent 租售类型 1租 2售
     * @param <int> $count 查询数据条数
     * @return <type>
     */
    public function getHotAttentionOffice($sellorrent,$count=5){
        $criteria=new CDbCriteria(array(
           'limit'=>$count,
        ));
        $criteria->order='ob_visit desc';
        $criteria->with=array(
            'presentInfo'=>array(
                'condition'=>'presentInfo.op_officeid=ob_officeid',
            ),
            'offictag'=>array(
                'condition'=>'ot_check=4',
            )
        );
      return $this->findAllByAttributes(array('ob_buildingtype'=>1,'ob_sellorrent'=>$sellorrent),$criteria);
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
     *通过传入的officeid得到楼盘再租和在售的数目
     * @param <type> $sysid
     * @return <array> 租售数组。array(租，售);
     */
    public function getRentAndSellNum($sysid){
        $list = $this->findAll("ob_sysid=:ob_sysid",array("ob_sysid"=>$sysid));
        $rentNum = 0;
        $sellNum = 0;
        if($list!=""){
            foreach($list as $value){
                if($value->ob_sellorrent==self::rent){
                    $rentNum += 1;
                }elseif($value->ob_sellorrent==self::sell){
                    $sellNum += 1;
                }
            }
        }
        return array('rent'=>$rentNum,'sell'=>$sellNum);
    }
   /**
    *通过房源最近更新时间和有效期，得到房源过期时间。此方法只用于显示过期时间时候使用。
    * @param <type> $updateTime 发布时间
    * @param <type> $expireDate 有效期。
    * @return <type>
    */
    public function getOutTimeByUpdateAndExpireTime($updateTime ,$expireDate){
        $update = strtotime(date("Y-m-d", $updateTime));//由于每天晚上12点跑脚本把已经过期的变成过期状态，所以需要在发布时间上加上1天的时间
        $return = $update+86400+$expireDate;
        return $return;
    }
    /**
     *检查传入id是否属于当前用户
     * @param <array> $officeIdArr
     * @return <boolean>
     */
    public function checkOfficeIdIsCurrentUser($officeIdArr){
        $return = true;
        $nowId = Yii::app()->user->id;
        if($officeIdArr){
            foreach($officeIdArr as $value){
                $officeBaseInfo = $this->findByPk($value);
                if(!$officeBaseInfo||$nowId != $officeBaseInfo->ob_uid){
                    $return = false;
                }
            }
        }
        return $return;
    }
    /**
     *得到最新发布的全景房源
     * @param <type> $limit
     * @return <type>
     */
    public function getNewPanoramaSource($limit){
        $criteria=new CDbCriteria();
        $criteria->addColumnCondition(array("spn_sourcetype"=>1,"spn_state"=>2));
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
        $criteria->addInCondition("ob_officeid",$sourceIdArr);
        $criteria->addColumnCondition(array("ot_check"=>4));
        $criteria->with = array("offictag");
        $model = Officebaseinfo::model()->findAll($criteria);
        return $model;
    }
    /**
     *根据房源id，得到房源的第一个全景id
     * @param <type> $officeId
     */
    public function getPanoIdBySourceId($officeId){
        $url = Subpanorama::model()->getOnePanoramaBySourceIdAndSourceType($officeId, Subpanorama::office);
        if($url==""){//如果房源没有全景，则用楼盘全景
            $officeInfo = Officebaseinfo::model()->findByPk($officeId);
            $url = Panorama::model()->getTitlePanoramaByBuildId($officeInfo->ob_sysid);
        }
        if($url==""){//如果楼盘也没全景，则用房源标题图。
            $imgId = $officeInfo->presentInfo->op_titlepicurl;
            $url = Picture::model()->getPicByTitleInt($imgId,"_large");
        }else{//如果找到全景。要从url中提取出全景id
            $url = substr($url, strrpos($url, "/")+1);
        }
        return $url;
    }
    /**
     *得到最近发布的写字楼
     * @param <int> $sellOrRent 出租还是出售 1出租2出售
     * @param <int> $limit 搜索条数
     */
    public function getRecentOffice($sellOrRent,$limit){
        $criteria=new CDbCriteria();
        $criteria->with = array("rentInfo","sellInfo","presentInfo","offictag");
        $criteria->addColumnCondition(array(
            "ob_sellorrent"=>$sellOrRent,
            "ot_check"=>4,
        ));
        $criteria->limit = $limit;
        $criteria->order = "ob_releasedate desc";
        $all= Officebaseinfo::model()->findAll($criteria);
        return $all;
    }
    /**
     *得到用户曾经选过的楼盘
     * @param <int> $sellOrRent 出租还是出售 1出租2出售
     */
    public function getSelectOffice($userid,$sellorrent){
        $criteria=new CDbCriteria();
        $criteria->with = array("buildingInfo");
        $criteria->addColumnCondition(array(
            "ob_uid"=>$userid,
        ));
        $criteria->addColumnCondition(array(
            "ob_sellorrent"=>$sellorrent,
        ));
        $criteria->group = "ob_sysid";
        $all= Officebaseinfo::model()->findAll($criteria);
        return $all;
    }
    /**
     * 让已经过期的房源下线
     */
    public function updateOutTimeSource(){
        //先查找所有发布的已过期房源
        $time = time();
        $criteria=new CDbCriteria();
        $criteria->addCondition("ob_releasedate+ob_expiredate<".$time);
        $criteria->addColumnCondition(array("ob_check"=>4));
        $criteria->select = "ob_officeid";
        $all = Officebaseinfo::model()->findAll($criteria);
        $ids = array();
        if($all){
            foreach($all as $value){
                $ids[] = $value["ob_officeid"];
            }
            $criteria=new CDbCriteria();
            $criteria->addInCondition("ob_officeid",$ids);
            Officebaseinfo::model()->updateAll(array("ob_check"=>6),$criteria);
        }
        return $ids;
    }
    /**
     * 计算当前用户房源的排序分数
     */
    public function calculateOrder($id){
        $order=common::getOrderConfig('new');
        $tmodel=Officetag::model()->find('ot_officeid='.$id);
        if($tmodel){
            if($tmodel->ot_isrecommend) $order+=common::getOrderConfig('recommend');
            if($tmodel->ot_ishurry) $order+=common::getOrderConfig('hurry');
            if($tmodel->ot_ispanorama) $order+=common::getOrderConfig('subpanorama');
            if($tmodel->ot_ishigh) $order+=common::getOrderConfig('high');
        }
        return $order;
    }
    /**
     * 完整的搜索。
     * @param <type> $criteria
     * @param <type> $saleOrRent
     * @param <type> $get
     * @return <type>
     */
    public function getTempleteSearchCriteria($criteria,$saleOrRent,$get){
        $searchParams = SearchMenu::getSearchConditionParams();//得到其他搜索条件参数名称集合
        $searchParams = array_diff($searchParams,array('type'));//过滤掉已有的type类型
        $inPutSearch = SearchMenu::getAllInPutSearch();//所有的input输入
        foreach($get as $key=>$value){
            if(in_array($key, $searchParams)){//直接搜索
                $searchCondition = Officebaseinfo::model()->getSearchCondition($value);//根据搜索条件的id得到搜索信息
                if($searchCondition){
                    $pkey = array_search($key, $searchParams);
                    if($pkey==40) {//查询附近交通
                        $criteria->addSearchCondition($searchCondition['field'],$searchCondition['min']);
                    }else {
                        $criteria->addCondition($searchCondition['field'].">=".$searchCondition['min']." and ".$searchCondition['field']."<=".$searchCondition['max']);
                    }
                }
            }elseif(array_key_exists($key, $inPutSearch)){//看看是否是自动输入的
                $filed = Officebaseinfo::model()->getInputSearchConditionFiled($inPutSearch[$key]);
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
     * 估计条件，查询本楼盘下的房源。此方法只查找房源中的面积、租金、售价
     * @param <type> $buildid
     * @param <type> $saleOrRent
     * @param <type> $condition
     * @return <type>
     */
    public function getSaleOrRentSourceByCondition($buildid,$saleOrRent,$condition){
        $templete = array("area","rPrice","sPrice");
        $conditionArr = SearchMenu::explodeAllParamsToArray($condition);//所有的条件
        $inPutSearch = SearchMenu::getAllInPutSearch();//所有的input输入
        $newGet = array();
        foreach($conditionArr as $key=>$value){
            if(array_search($key, $templete)!==false){
                $newGet[$key] = $value;
            }elseif(array_key_exists($key, $inPutSearch)&&array_search($inPutSearch[$key], $templete)!==false){//看看在不在input中
                $newGet[$key] = $value;
            }
        }
        $criteria=new CDbCriteria();
        $criteria->select = "ob_officeid,ob_uid,ob_floortype,ob_officearea,ob_rentprice,ob_sumprice";
        $criteria->addColumnCondition(array("ob_sysid"=>$buildid,"ob_sellorrent"=>$saleOrRent,"ob_check"=>4));
        $criteria = $this->getTempleteSearchCriteria($criteria, $saleOrRent, $newGet);
        $criteria->order = "ob_updatedate desc";
        $all = self::model()->findAll($criteria);
        //按规则排序。分付费用户和非付费用户区
        $all = $this->orderSource($all);
        //排序结束
        return $all;
    }
    /**
     * 排序搜索结果。按付费和不付费来区分
     * @param <type> $all
     * @return <type>
     */
    public function orderSource($all){
        $return = array();
        //先获得结果集中的所有用户
        $allUser = array();
        foreach($all as $val){
            $allUser[] = $val->ob_uid;
        }
        $allUser = array_unique($allUser);//所有用户
        //查找所有的vip
        $criteria=new CDbCriteria();
        $criteria->select = "ua_uid";
        $criteria->addCondition("ua_combo is not null");
        $criteria->addInCondition("ua_uid",$allUser);
        $userModel = Uagent::model()->findAll($criteria);
        $vip = array();//vip用户
        foreach($userModel as $val){
            $vip[] = $val->ua_uid;
        }
        $normalUser = array_diff($allUser, $vip);//一般用户

        $vipTmpSourceTop = $normalTmpSourceTop =array();
        $vipTmpSourceBtm = $normalTmpSourceBtm =array();
        $vipTmp = $normalTmp =array();
        //排序
        foreach($all as $value){
            if(in_array($value->ob_uid,$vip)){//如果是vip发布的房源
                if(in_array($value->ob_uid, $vipTmp)){
                    $vipTmpSourceBtm[] = $value;
                }else{
                    $vipTmp[] = $value->ob_uid;
                    $vipTmpSourceTop[] = $value;
                }
            }else{//普通用户发布的房源
                if(in_array($value->ob_uid, $normalTmp)){
                    $normalTmpSourceBtm[] = $value;
                }else{
                    $normalTmp[] = $value->ob_uid;
                    $normalTmpSourceTop[] = $value;
                }
            }
        }
        $return = array_merge($vipTmpSourceTop, $vipTmpSourceBtm);
        $return = array_merge($return, $normalTmpSourceTop);
        $return = array_merge($return, $normalTmpSourceBtm);
        return $return;
    }
    /**
     * 写字楼搜索前台点击更多时使用的数据
     * @param <type> $all
     * @param <type> $start
     * @param <type> $length
     * @param <type> $saleOrRent
     * @return <type>
     */
    public function getTmpSource($all,$start,$length,$saleOrRent){
        $return = array();
        $tmpSource = array_slice($all, $start, $length);
        foreach($tmpSource as $value){
            $userModel = User::model()->findByPk($value->ob_uid);
            $cdb=new CDbCriteria();
            $cdb->select = "ua_realname,ua_id";
            $cdb->addColumnCondition(array("ua_uid"=>$value->ob_uid));
            $uagent = Uagent::model()->find($cdb);
            $tmp = array();
            $tmp["floortype"] = @Officebaseinfo::$ob_floortype[$value->ob_floortype];
            $tmp["officearea"] = $value->ob_officearea;
            if($saleOrRent==1){
                $tmp["price"] = $value->ob_rentprice;
            }else{
                $tmp["price"] = $value->ob_sumprice;
            }
            $tmp["link"] = Yii::app()->createUrl("officebaseinfo/view",array("id"=>$value->ob_officeid));
            $tmp["name"] = $uagent?$uagent->ua_realname:"";
            $tmp["tel"] = $userModel?$userModel->user_tel:"";
            $tmp["namelink"] = Yii::app()->createUrl("uagent/index",array("id"=>$uagent?$uagent->ua_id:""));
            $return[] = $tmp;
        }
        return $return;
    }
    /**
     * 估计条件，查询本楼盘下的房源。此方法只查找房源中的面积、租金、售价
     * @param <type> $buildid
     * @param <type> $saleOrRent
     * @param <type> $condition
     * @param <type> $limit
     * @return <type>
     */
    public function getSaleOrRentSourceByUagnet($userId,$saleOrRent,$condition){
        $criteria=new CDbCriteria();
        $templete = array("area","rPrice","sPrice");
        $buildContition = array("district","section","metro");
        $conditionArr = SearchMenu::explodeAllParamsToArray($condition);//所有的条件
        $inPutSearch = SearchMenu::getAllInPutSearch();//所有的input输入
        $newGet = array();
        foreach($conditionArr as $key=>$value){
            if(array_search($key, $templete)!==false){
                $newGet[$key] = $value;
            }elseif(array_key_exists($key, $inPutSearch)&&array_search($inPutSearch[$key], $templete)!==false){//看看在不在input中
                $newGet[$key] = $value;
            }elseif(array_search($key, $buildContition)!==false){
                $newGet[$key] = $value;
                $criteria->with[] = "buildingInfo";
            }
        }
        $criteria->select = "ob_officeid,ob_floortype,ob_officearea,ob_rentprice,ob_sumprice,ob_sysid";
        $criteria->addColumnCondition(array("ob_uid"=>$userId,"ob_sellorrent"=>$saleOrRent,"ob_check"=>4));
        $criteria = $this->getTempleteSearchCriteria($criteria, $saleOrRent, $newGet);

        $regionParamToColumn = array(
                'district'=>'sbi_district',
                'section'=>'sbi_section',
        );
        $regionParams = SearchMenu::getRegionParams();//得到地区搜索条件参数名称集合
        foreach($regionParams as $regionParam) {
            if(isset($newGet[$regionParam]) && $newGet[$regionParam]!="") {
                if(array_key_exists($regionParam,$regionParamToColumn)) {
                    $criteria->addColumnCondition(array($regionParamToColumn[$regionParam]=>$newGet[$regionParam]));
                }
            }
        }
        $criteria->order = "ob_updatedate desc";
        $all = self::model()->findAll($criteria);
        //排序结束
        return $all;
    }
    /**
     * 经纪人搜索写字楼点击更多
     * @param <type> $all
     * @param <type> $start
     * @param <type> $length
     * @param <type> $saleOrRent
     * @return <type>
     */
    public function getTmpSourceByUagent($all,$start,$length,$saleOrRent){
        $return = array();
        $tmpSource = array_slice($all, $start, $length);
        foreach($tmpSource as $value){
            $tmp = array();
            $tmp["name"] = @$value->buildingInfo->sbi_buildingname?$value->buildingInfo->sbi_buildingname:"";
            $tmp["floortype"] = @Officebaseinfo::$ob_floortype[$value->ob_floortype];
            $tmp["officearea"] = $value->ob_officearea;
            if($saleOrRent==1){
                $tmp["price"] = $value->ob_rentprice."元/平米·天";
            }else{
                $tmp["price"] = $value->ob_sumprice."万元/套";
            }
            $tmp["propertyprice"] = @$value->buildingInfo->sbi_propertyprice?$value->buildingInfo->sbi_propertyprice."元/平米•月":"暂无";
            $tmp["link"] = Yii::app()->createUrl("officebaseinfo/view",array("id"=>$value->ob_officeid));
            $tmp["namelink"] = Yii::app()->createUrl("systembuildinginfo/view",array("id"=>$value->ob_sysid));
            $return[] = $tmp;
        }
        return $return;
    }
    /**
     * 得到当前楼盘价格相近楼盘
     * @param int $limit
     * @param int 出租出售
     */
    public function getLikeOffice($limit=5,$district=""){
        $db = Yii::app()->db;
        $gt = floor($limit/2)+1;
		$district=$district?' AND t2.`sbi_district` = 48 ':"";
        $sql = 'SELECT t1.*,t2.`sbi_buildingname`
            FROM {{officebaseinfo}} t1 LEFT JOIN {{systembuildinginfo}} t2 ON t1.ob_sysid=t2.`sbi_buildingid`
            WHERE t1.ob_sellorrent='.$this->ob_sellorrent.' AND '.
                ($this->ob_sellorrent=='1'?'t1.`ob_rentprice`>='.$this->ob_rentprice:'t1.`ob_avgprice`>='.$this->ob_avgprice).
				$district.' order by t1.`ob_rentprice` LIMIT '.$gt;
        $gtrs = $db->createCommand($sql)->queryAll();
        $lt = $limit-count($gtrs);
        $sql = 'SELECT t1.*,t2.`sbi_buildingname`
            FROM {{officebaseinfo}} t1 LEFT JOIN {{systembuildinginfo}} t2 ON t1.ob_sysid=t2.`sbi_buildingid`
            WHERE t1.ob_sellorrent='.$this->ob_sellorrent.' AND '.
                ($this->ob_sellorrent=='1'?'t1.`ob_rentprice`<'.$this->ob_rentprice:'t1.`ob_avgprice`<'.$this->ob_avgprice).
				$district.' order by t1.`ob_rentprice` desc LIMIT '.$lt;
        $ltrs = $db->createCommand($sql)->queryAll();
        return array_merge($ltrs,$gtrs);
     }
	 /**
     * 得到楼盘内发布最多的用户信息
     */
	 public function getSourceByBuildid($buildid){
        $criteria=new CDbCriteria();
        $criteria->select = "count(*)as num,ob_uid";
        $criteria->addColumnCondition(array("ob_sysid"=>$buildid,"ob_check"=>4));
        $criteria->order = "num desc";
		$criteria->group = "ob_uid";
        $all = self::model()->find($criteria);
        return $all;
    }
}