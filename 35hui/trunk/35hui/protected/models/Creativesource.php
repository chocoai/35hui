<?php

/**
 * This is the model class for table "{{creativesource}}".
 *
 * The followings are the available columns in table '{{creativesource}}':
 * @property integer $cr_id
 * @property integer $cr_cpid
 * @property integer $cr_userid
 * @property string $cr_dongname
 * @property integer $cr_floortype
 * @property double $cr_area
 * @property double $cr_dayrentprice
 * @property integer $cr_monthrentprice
 * @property integer $cr_ispanorama
 * @property integer $cr_titlepicurl
 * @property integer $cr_visit
 * @property integer $cr_releasedate
 * @property integer $cr_updatedate
 * @property integer $cr_expiredate
 * @property integer $cr_check
 * @property string $cr_introduce
 * @property integer $cr_pricecheck
 */
class Creativesource extends CActiveRecord
{
    public static $cyParkPicNorm = array(
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
	 * Returns the static model of the specified AR class.
	 * @return Creativesource the static model class
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
		return '{{creativesource}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cr_cpid, cr_userid, cr_dongname,cr_monthrentprice,cr_dayrentprice,cr_area', 'required'),
			array('cr_cpid, cr_userid, cr_floortype, cr_monthrentprice, cr_ispanorama, cr_titlepicurl, cr_visit, cr_releasedate, cr_updatedate, cr_expiredate, cr_check, cr_pricecheck', 'numerical', 'integerOnly'=>true),
			array('cr_area, cr_dayrentprice', 'numerical'),
			array('cr_dongname', 'length', 'max'=>20),
			array('cr_introduce', 'length', 'max'=>1500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cr_id, cr_cpid, cr_userid, cr_dongname, cr_floortype, cr_area, cr_dayrentprice, cr_monthrentprice, cr_ispanorama, cr_titlepicurl, cr_visit, cr_releasedate, cr_updatedate, cr_expiredate, cr_check, cr_introduce, cr_pricecheck',  'safe', 'on'=>'search'),
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
            'parkbaseinfo'=>array(self::BELONGS_TO,'Creativeparkbaseinfo','cr_cpid'),
            'user'=>array(self::BELONGS_TO,'User','cr_userid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cr_id' => 'Cr',
			'cr_cpid' => 'Cr Cpid',
			'cr_userid' => 'Cr Userid',
			'cr_dongname' => 'Cr Dongname',
			'cr_floortype' => 'Cr Floortype',
			'cr_area' => 'Cr Area',
			'cr_dayrentprice' => 'Cr Dayrentprice',
			'cr_monthrentprice' => 'Cr Monthrentprice',
			'cr_ispanorama' => 'Cr Ispanorama',
			'cr_titlepicurl' => 'Cr Titlepicurl',
			'cr_visit' => 'Cr Visit',
			'cr_releasedate' => 'Cr Releasedate',
			'cr_updatedate' => 'Cr Updatedate',
			'cr_expiredate' => 'Cr Expiredate',
			'cr_check' => 'Cr Check',
			'cr_introduce' => 'Cr Introduce',
			'cr_pricecheck' => 'Cr Pricecheck',
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

		$criteria->compare('cr_id',$this->cr_id);

		$criteria->compare('cr_cpid',$this->cr_cpid);

		$criteria->compare('cr_userid',$this->cr_userid);

		$criteria->compare('cr_dongname',$this->cr_dongname,true);

		$criteria->compare('cr_floortype',$this->cr_floortype);

		$criteria->compare('cr_area',$this->cr_area);

		$criteria->compare('cr_dayrentprice',$this->cr_dayrentprice);

		$criteria->compare('cr_monthrentprice',$this->cr_monthrentprice);

		$criteria->compare('cr_ispanorama',$this->cr_ispanorama);

		$criteria->compare('cr_titlepicurl',$this->cr_titlepicurl);

		$criteria->compare('cr_visit',$this->cr_visit);

		$criteria->compare('cr_releasedate',$this->cr_releasedate);

		$criteria->compare('cr_updatedate',$this->cr_updatedate);

		$criteria->compare('cr_expiredate',$this->cr_expiredate);

		$criteria->compare('cr_check',$this->cr_check);

		$criteria->compare('cr_introduce',$this->cr_introduce,true);
		
		$criteria->compare('cr_pricecheck',$this->cr_pricecheck);
		
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     *得到用户曾经选过的创意园
     */
    public function getSelectOffice($userid){
        $criteria=new CDbCriteria();
        $criteria->with = array("parkbaseinfo");
        $criteria->addColumnCondition(array(
            "cr_userid"=>$userid,
        ));
        $criteria->group = "cr_cpid";
        $all= $this->findAll($criteria);
        return $all;
    }
    /*
     * 通过传入的get，得到写字楼基本的DataProvider
     * @param $get get方法传递的参数
	 * @return integer
     */
    public function getManageDataProvider($state,$request){
        $userId = Yii::app()->user->id;
        $criteria = new CDbCriteria;
        $criteria->condition = "cr_userid=".$userId;
        if(!empty($request['kwd'])){//搜索标题
            $criteria->with = array("parkbaseinfo");
            $criteria->addSearchCondition('cp_name',$request['kwd']);
        }
        //排序
        if(empty($request['od'])) $request['od'] = 5;
        if($request['od']==1){
            $criteria->order = 'cr_updatedate';
        }else if($request['od']==2){
            $criteria->order = 'cr_updatedate desc';
        }else if($request['od']==3){
            $criteria->order = 'cr_releasedate';
        }else if($request['od']==4){
            $criteria->order = 'cr_releasedate desc';
        }else{
            $criteria->order = 'cr_id desc';
        }
        $criteria->addColumnCondition(array("cr_check"=>$state));
        
        if( isset($request['officeState'])&& $request['officeState']==1){//显示全景房源
            $criteria->addColumnCondition(array("cr_ispanorama"=>"1"));
        }
        $dataProvider=new CActiveDataProvider('Creativesource', array(
            'pagination'=>array(
                'pageSize'=>10,
            ),
            'criteria'=>$criteria,
        ));
        return $dataProvider;
    }
    /**
     *检查传入住宅id是否属于当前用户
     * @param <array> $idArr
     * @return <boolean>
     */
    public function checkIdIsCurrentUser($idArr){
        $return = true;
        $nowId = Yii::app()->user->id;
        if($idArr){
            foreach($idArr as $value){
                $model = $this->findByPk($value);
                if(!$model||$nowId != $model->cr_userid){
                    $return = false;
                    break;
                }
            }
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
     * 估计条件，查询本创意园区下的房源。此方法只查找房源中的面积、租金、售价
     * @param <type> $buildid
     * @param <type> $condition
     * @return <type>
     */
    public function getRentSourceByCondition($buildid,$condition){
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
//        $criteria->select = "ob_officeid,ob_uid,ob_floortype,ob_officearea,ob_rentprice,ob_sumprice";
        $criteria->addColumnCondition(array("cr_cpid"=>$buildid,"cr_check"=>4));
        $criteria = $this->getTempleteSearchCriteria($criteria, $newGet);
        $criteria->order = "cr_updatedate desc";
//        echo "<pre>";print_r($criteria);exit;
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
            $allUser[] = $val->cr_userid;
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
            if(in_array($value->cr_userid,$vip)){//如果是vip发布的房源
                if(in_array($value->cr_userid, $vipTmp)){
                    $vipTmpSourceBtm[] = $value;
                }else{
                    $vipTmp[] = $value->cr_userid;
                    $vipTmpSourceTop[] = $value;
                }
            }else{//普通用户发布的房源
                if(in_array($value->cr_userid, $normalTmp)){
                    $normalTmpSourceBtm[] = $value;
                }else{
                    $normalTmp[] = $value->cr_userid;
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
     * @return <type>
     */
    public function getTmpSource($all,$start,$length){
        $return = array();
        $tmpSource = array_slice($all, $start, $length);
        foreach($tmpSource as $value){
            $userModel = User::model()->findByPk($value->cr_userid);
            $cdb=new CDbCriteria();
            $cdb->select = "ua_realname,ua_id";
            $cdb->addColumnCondition(array("ua_uid"=>$value->cr_userid));
            $uagent = Uagent::model()->find($cdb);
            $tmp = array();
            $tmp["dongname"] = common::strCut($value->cr_dongname,15);
            $tmp["floortype"] = @Officebaseinfo::$ob_floortype[$value->cr_floortype];
            $tmp["area"] = $value->cr_area;
            $tmp["price"] = $value->cr_dayrentprice;
            
            $tmp["link"] = Yii::app()->createUrl("creativesource/view",array("id"=>$value->cr_id));
            $tmp["name"] = $uagent?$uagent->ua_realname:"";
            $tmp["tel"] = $userModel?$userModel->user_tel:"";
            $tmp["namelink"] = Yii::app()->createUrl("uagent/index",array("id"=>$uagent?$uagent->ua_id:""));
            $return[] = $tmp;
        }
        return $return;
    }
    /**
     * 返回input搜索的栏位名称
     * @param <type> $name
     * @return <type>
     */
    public function getInputSearchConditionFiled($name){
        $officeCondition=array(
            "area"=>'cr_area',
            "rPrice"=>"cr_dayrentprice",
        );
        $return = "";
        if(array_key_exists($name, $officeCondition)){
            $return = $officeCondition[$name];
        }
        return $return;
    }
    /**
     * 根据条件的主键返回对应的条件
     * @param <type> $id 条件的主键id
     * @return <array> field:对应的条件字段 max:最大值 min:最小值
     */
    public function getSearchCondition($id) {
        $officeCondition=array(
            6=>'cr_area',
            30=>'cr_dayrentprice',//租价,
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
     * 得到当前房源价格相近楼盘
     * @param int $limit
     */
    public function getLikes($limit=5){
        $db = Yii::app()->db;
        $gt = floor($limit/2)+1;
        $sql = 'SELECT t1.*,t2.`cp_name`
            FROM '.$this->tableName().' t1 LEFT JOIN {{creativeparkbaseinfo}} t2 ON t1.cr_cpid=t2.`cp_id`
            WHERE t1.`cr_dayrentprice`>='.$this->cr_dayrentprice.'
                 AND t2.`cp_id` LIMIT '.$gt;
        $gtrs = $db->createCommand($sql)->queryAll();
        $lt = $limit-count($gtrs);
        $sql = 'SELECT t1.*,t2.`cp_name`
            FROM '.$this->tableName().' t1 LEFT JOIN {{creativeparkbaseinfo}} t2 ON t1.cr_cpid=t2.`cp_id`
            WHERE t1.`cr_dayrentprice`<'.$this->cr_dayrentprice.'
                 AND t2.`cp_id` LIMIT '.$lt;
        $ltrs = $db->createCommand($sql)->queryAll();
        return array_merge($gtrs,$ltrs);
     }
	 //根据创意园区好获得发布最多的用户ID
	public function getSourceByBuildid($buildid){
        $criteria=new CDbCriteria();
        $criteria->select = "count(*)as num,cr_userid";
        $criteria->addColumnCondition(array("cr_cpid"=>$buildid,"cr_check"=>4));
        $criteria->order = "num desc";
		$criteria->group = "cr_userid";
        $all = self::model()->find($criteria);
        return $all;
    }
    /**
     * 估计条件，查询本楼盘下的房源。此方法只查找房源中的面积、租金、售价
     * @param <type> $buildid
     * @param <type> $condition
     * @return <type>
     */
    public function getSourceByUagnet($userId,$condition){
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
                $criteria->with[] = "parkbaseinfo";
            }
        }
        $criteria->addColumnCondition(array("cr_userid"=>$userId,"cr_check"=>4));
        $criteria = $this->getTempleteSearchCriteria($criteria, $newGet);

        $regionParamToColumn = array(
                'district'=>'cp_district',
        );
        $regionParams = SearchMenu::getRegionParams();//得到地区搜索条件参数名称集合
        foreach($regionParams as $regionParam) {
            if(isset($newGet[$regionParam]) && $newGet[$regionParam]!="") {
                if(array_key_exists($regionParam,$regionParamToColumn)) {
                    $criteria->addColumnCondition(array($regionParamToColumn[$regionParam]=>$newGet[$regionParam]));
                }
            }
        }
        $criteria->order = "cr_updatedate desc";
//        echo "<pre>";print_r($criteria);exit;
        $all = self::model()->findAll($criteria);
        //排序结束
        return $all;
    }
    public function getTmpSourceByUagent($all,$start,$length){
        $return = array();
        $tmpSource = array_slice($all, $start, $length);
        foreach($tmpSource as $value){
            $tmp = array();
            $tmp["name"] = @$value->parkbaseinfo->cp_name?$value->parkbaseinfo->cp_name:"";
            $tmp["floortype"] = @Officebaseinfo::$ob_floortype[$value->cr_floortype];
            $tmp["officearea"] = $value->cr_area;
            $tmp["price"] = $value->cr_dayrentprice."元/平米·天";
            
            $tmp["propertyprice"] = @$value->parkbaseinfo->cp_propertyprice?$value->parkbaseinfo->cp_propertyprice."元/平米•月":"暂无";
            $tmp["link"] = Yii::app()->createUrl("creativesource/view",array("id"=>$value->cr_id));
            $tmp["namelink"] = Yii::app()->createUrl("creativeparkbaseinfo/view",array("id"=>$value->cr_cpid));
            $return[] = $tmp;
        }
        return $return;
    }
}