<?php

class Systembuildinginfo extends CActiveRecord
{
    /**
     * The followings are the available columns in table '{{systembuildinginfo}}':
     * @property integer $sbi_buildingid
     * @property string $sbi_buildingname
     * @property string $sbi_pinyinshortname
     * @property string sbi_pinyinlongname
     * @property integer $sbi_province
     * @property integer $sbi_city
     * @property integer $sbi_district
     * @property integer $sbi_section
     * @property integer $sbi_loop
     * @property integer $sbi_tradecircle
     * @property string $sbi_busway
     * @property string $sbi_address
     * @property integer $sbi_foreign
     * @property integer $sbi_openingtime
     * @property string $sbi_propertyname
     * @property string $sbi_developer
     * @property integer $sbi_berthnum
     * @property double $sbi_rentberth
     * @property double $sbi_propertyprice
     * @property integer $sbi_propertydegree
     * @property integer $sbi_elevatornum
     * @property integer $sbi_fireelevatornum
     * @property double $sbi_buildingarea
     * @property double $sbi_floorarea
     * @property integer $sbi_floor
     * @property integer $sbi_floordownground
     * @property integer $sbi_floorupground
     * @property integer $sbi_roomnum
     * @property string $sbi_buildingintroduce
     * @property string $sbi_peripheral
     * @property string $sbi_traffic
     * @property string $sbi_decoration
     * @property string $sbi_floorinformation
     * @property string $sbi_parkinginformation
     * @property string $sbi_otherinformation
     * @property integer $sbi_titlepic
     * @property double $sbi_avgrentprice
     * @property integer $sbi_avgsellprice
     * @property integer $sbi_isnew
     * @property string $sbi_x
     * @property string $sbi_y
     * @property string $sbi_tag
     * @property integer $sbi_recordtime
     * @property integer $sbi_updatetime
     * @property string $sbi_tel
     */
    /**
     *楼盘类型
     * @var <array>
     */
    public static $sbi_buildtype = array(
        1=>"写字楼",
        2=>'商业广场'
    );
    public static $pictureNorm = array(
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
	 * @return systembuildinginfo the static model class
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
		return '{{systembuildinginfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                array('sbi_buildingname, sbi_buildtype, sbi_province, sbi_city,sbi_district, sbi_section,sbi_loop, sbi_propertyprice,sbi_address,sbi_x,sbi_y,sbi_avgrentprice,sbi_avgsellprice', 'required'),
                array('sbi_buildtype,sbi_province, sbi_city, sbi_district, sbi_section, sbi_loop, sbi_tradecircle, sbi_foreign, sbi_propertydegree, sbi_floor, sbi_titlepic,sbi_titlepanorama, sbi_avgsellprice, sbi_isnew, sbi_recordtime, sbi_updatetime', 'numerical', 'integerOnly'=>true),
                array('sbi_propertyprice, sbi_floorarea, sbi_avgrentprice', 'numerical'),
                array('sbi_pinyinshortname', 'length', 'max'=>50),
                array('sbi_busway, sbi_buildingname, sbi_pinyinlongname,sbi_developer, sbi_propertyname, sbi_address, sbi_x, sbi_y, sbi_tag', 'length', 'max'=>200),
                array('sbi_tel,sbi_propertytel,sbi_buildingarea', 'length', 'max'=>20),
                array('sbi_buildingintroduce, sbi_peripheral, sbi_traffic, sbi_decoration, sbi_floorinformation, sbi_parkinginformation, sbi_otherinformation,sbi_openingtime,sbi_danyuanfenge,sbi_wailimian,sbi_buildingenglishname,sbi_defanglv', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('sbi_buildingid, sbi_buildingname, sbi_pinyinshortname, sbi_province, sbi_city, sbi_district, sbi_section, sbi_loop, sbi_tradecircle, sbi_busway, sbi_address, sbi_foreign, sbi_openingtime, sbi_propertyname, sbi_developer, sbi_propertyprice, sbi_propertydegree, sbi_buildingarea, sbi_floorarea, sbi_floor, sbi_buildingintroduce, sbi_peripheral, sbi_traffic, sbi_decoration, sbi_floorinformation, sbi_parkinginformation, sbi_otherinformation, sbi_titlepic,sbi_titlepanorama, sbi_avgrentprice, sbi_avgsellprice, sbi_isnew, sbi_x, sbi_y, sbi_tag, sbi_recordtime, sbi_updatetime, sbi_tel', 'safe', 'on'=>'search'),
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
            'comment'=>array(self::HAS_MANY,'Systembuildingcomment','sbc_buildingid'),
            'twitter'=>array(self::HAS_ONE,'Twitter','t_sourceid'),
            'new'=>array(self::HAS_ONE,'Newbuild','nb_sid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sbi_buildingid' => '楼盘Id',
                'sbi_buildingname' => '楼盘名称',
                'sbi_pinyinshortname' => '楼盘名称缩写',
                "sbi_pinyinlongname"=> '楼盘名称完整拼音',
                'sbi_buildtype'=>'楼盘类型',
                'sbi_province' => '所属省份',
                'sbi_city' => '所属城市',
                'sbi_district' => '所属行政区',
                'sbi_section' => '所属板块',
                'sbi_loop' => '几环',
                'sbi_tradecircle' => '附近商圈',
                'sbi_busway' => '临近轨道',
                'sbi_address' => '楼盘地址',
                'sbi_foreign' => '是否涉外',
                'sbi_visit'=>"访问数",
                'sbi_loushu'=>"楼书",
                'sbi_hetong'=>"合同",
                'sbi_openingtime' => '开盘时间',
                'sbi_propertyname' => '物业管理公司',
                'sbi_propertytel' => '物业公司电话',
                'sbi_developer' => '开发商',
                'sbi_propertyprice' => '物业管理费',
                'sbi_propertydegree' => '物业级别',
                'sbi_buildingarea' => '建筑总面积',
                'sbi_floorarea' => '标准层面积',
                'sbi_floor' => '总层数',
                'sbi_buildingintroduce' => '楼盘介绍',
                'sbi_peripheral' => '周边配套',
                'sbi_traffic' => '交通配套',
                'sbi_titlepic' => '标题图片Id',
                'sbi_titlepanorama' => '标题全景Id',
                'sbi_avgrentprice' => '平均租价',
                'sbi_avgsellprice' => '平均售价',
                'sbi_isnew' => '是否是新楼盘',
                'sbi_x' => 'x坐标',
                'sbi_y' => 'y坐标',
                'sbi_tag' => '标签',
                'sbi_recordtime' => '入库时间',
                'sbi_updatetime' => '最近更新时间',
                'sbi_tel'=>"售楼中心联系电话",
                'sbi_dongnum'=>"楼宇总楼数",
                'sbi_wailimian'=>"外立面",

                'sbi_datang'=>"大堂",
                'sbi_zoulang'=>"公共走廊",
                'sbi_floorinfo'=>'楼层信息',
                'sbi_danyuanfenge'=>'单元分割面积',
                'sbi_biaozhun'=>'交屋标准',
                'sbi_toiletwater'=>'卫生间供水',
                'sbi_liftinfo'=>'电梯配置',
                'sbi_communication'=>'通讯系统',
                'sbi_aircon'=>'空调系统',
                'sbi_security'=>'安防系统',
                'sbi_carport'=>'车位配置',
                'sbi_roommating'=>'楼内配套',
                'sbi_propertyserver'=>'物业服务',
                'sbi_buildingenglishname'=>'英文名字',
                'sbi_defanglv'=>'得房率',
		);
	}
    /**
     * 记录并返回楼盘访问历史。
     * @param int $id 当前访问楼盘id
     * @return array
     */
    public function buildViewMemory($id){
        $index = '_BVM';
        $cookies=Yii::app()->request->cookies;
        if(!isset($cookies[$index])){
            $val = new CHttpCookie($index,$id);
            $val->expire = time()+86400;
            $cookies[$index]=$val;
            return array($id);
        }else{
            $_arr=explode('|', $cookies[$index]->value);
            if( ($key = array_search($id, $_arr))!==false ){
                unset($_arr[$key]);
            }
            $_arr[]=$id;
            $val=new CHttpCookie($index,implode('|', $_arr));
            $val->expire = time()+86400;
            $cookies[$index]=$val;
        }
        return $_arr;
    }
    /**
     * 找到本楼盘下面的 $findNum 个经纪人<按照一定优先级>
     * @param int $findNum
     * @return array
     */
    public function getAgentTop($findNum=4){
        $agentTop=array();
        $db=Yii::app()->db;
        $sql='SELECT COUNT(*) as c,t1.`ob_uid`,t2.`ua_source` FROM `{{officebaseinfo}}` t1
            LEFT JOIN `{{uagent}}` t2 ON t1.`ob_uid`=t2.`ua_uid`
            WHERE t1.`ob_sysid`='.$this->sbi_buildingid.' AND t1.`ob_check`=4 GROUP BY t1.`ob_uid`';
        $agentIds=array();
        foreach($db->createCommand($sql)->queryAll($sql) as $r){
            if($r['ua_source']===NULL) continue;
            $canReleaseNum=Uagent::model()->getAllOperateNum($r['ob_uid'],2);//可发布数
            $agentIds[$r['ob_uid']] = floor($r['c']/$canReleaseNum*100*0.4) + floor($r['ua_source']*0.6);//40=100*0.4
        }
        if($agentIds){
            $sql='SELECT ua_uid `user_id` FROM `{{uagent}}` WHERE `ua_uid` IN('.implode(',', array_keys($agentIds)).') ORDER BY `ua_combotime`';
            foreach($db->createCommand($sql)->queryAll($sql) as $k=>$r){
                $agentIds[$r['user_id']] += $k*10;
            }

            $agentNum=min($findNum,count($agentIds));//最多随机$findNum个经纪人
            $maxRand=array_sum($agentIds);
            while($agentNum--){
                $i=rand(0,$maxRand);
                $out=false;
                $j=0;
                foreach($agentIds as $k=>$v){
                    $j+=$v;
                    if($i<=$j){
                        if(!in_array($k, $agentTop)){
                            $agentTop[]=$k;
                            $out=true;
                            break;
                        }
                    }
                }
                if(!$out) $agentNum++;
            }
        }
        if( ($findMore = $findNum - count($agentTop) ) ){//尽量找满$findNum个经纪人
            if($findMore>0 && $findMore!=$findNum){
                $_sql='`ua_uid` NOT IN('.implode(',', array_keys($agentTop)).') AND ';
            }else{ $_sql=''; }
            $sql='FROM `{{uagent}}` WHERE '.$_sql.'`ua_district`='.$this->sbi_district;
            $count=$db->createCommand('SELECT COUNT(*) '.$sql)->queryScalar();
            if($count>$findMore){
                $randx=array();
                while($findMore--){
                    $p=rand(0,$count-1);
                    $randx[]=$p;
                    $id=$db->createCommand('SELECT `ua_uid` '.$sql.' LIMIT '.$p.',1')->queryScalar();
                    if(in_array($id, $agentTop)){
                        $findMore++;
                        continue;
                    }
                    $agentTop[]=$id;
                }
            }elseif($count){
                $ids=$db->createCommand('SELECT `ua_uid` '.$sql)->queryAll();
                foreach($ids as $id)
                    $agentTop[]=$id['ua_uid'];
            }
        }
        return $agentTop;
    }
    /**
     * 得到当前楼盘价格相近楼盘
     * @param int $limit
     */
    public function getLikeBuild($limit=5){
        $db = Yii::app()->db;
        $gt = floor($limit/2)+1;
        $sql = 'SELECT `sbi_buildingid`, `sbi_buildingname`, `sbi_address`, `sbi_avgrentprice` ,`sbi_titlepic`
            FROM {{systembuildinginfo}} WHERE `sbi_buildtype`=1 AND `sbi_avgrentprice`>'.$this->sbi_avgrentprice.'
                AND `sbi_district`='.$this->sbi_district.' LIMIT '.$gt;
        $gtrs = $db->createCommand($sql)->queryAll();
        $lt = $limit-count($gtrs);
        $sql = 'SELECT `sbi_buildingid`, `sbi_buildingname`, `sbi_address`, `sbi_avgrentprice`,`sbi_titlepic`
            FROM {{systembuildinginfo}} WHERE `sbi_buildtype`=1 AND `sbi_avgrentprice`<'.$this->sbi_avgrentprice.'
                AND `sbi_district`='.$this->sbi_district.' LIMIT '.$lt;
        $ltrs = $db->createCommand($sql)->queryAll();
        return array_merge($gtrs,$ltrs);
     }
    public function scopes()
    {
        return array(
            'curOpen'=>array(
                'condition'=>'MONTH(FROM_UNIXTIME(`sbi_openingtime`))='.common::getMonth(time()),
            ),
            'nextMonthOpen'=>array(
                'condition'=>'MONTH(FROM_UNIXTIME(`sbi_openingtime`))='.(common::getMonth(time())+1),
            )
        );
    }
    public function recently($limit=5)
    {
        $this->getDbCriteria()->mergeWith(array(
            'order'=>'sbi_recordtime DESC',
            'limit'=>$limit,
        ));
        return $this;
    }
    /**
     * 得到最新上市的楼盘信息
     * @param <type> $count
     * @return <type>
     */
    public function getRecentNewBuildings($count=20,$sbi_buildtype=1){
        return $this->recently($count)->findAllByAttributes(array('sbi_isnew'=>1,'sbi_buildtype'=>$sbi_buildtype));
    }
    /**
     * 返回本月开盘的楼盘信息
     * @return <type>
     */
    public function getCurMonthOpenBuildings($sbi_buildtype=1){
       $month=date('m');
        //通过传入月份得到具体年月。
        $year = date("Y");
        while($month<1){//如果不是当前年份
            $month = 12+$month;
            $year = $year-1;
        }
        while($month>12){//如果不是当前年份
            $month = $month-12;
            $year = $year+1;
        }
        $beginday = strtotime($year."-".$month."-1");//开始统计时间。
        $month = $month+1;
        if($month>12){//如果传入月份为12，加了一后就是13了，所以要变成下年的一月
            $month = $month-12;
            $year = $year+1;
        }
        $enday = strtotime($year."-".$month."-01");
        $criteria=new CDbCriteria();

        $criteria->addCondition('sbi_openingtime<'.$enday.' and sbi_openingtime>='.$beginday);
  
        return $this->curOpen()->recently(12)->findAllByAttributes(array('sbi_buildtype'=>$sbi_buildtype),$criteria);
    }
    public function getNextMonthOpenBuildings($sbi_buildtype=1){
        $month=date('m')+1;
        //通过传入月份得到具体年月。
        $year = date("Y");
        while($month<1){//如果不是当前年份
            $month = 12+$month;
            $year = $year-1;
        }
        while($month>12){//如果不是当前年份
            $month = $month-12;
            $year = $year+1;
        }
        $beginday = strtotime($year."-".$month."-1");//开始统计时间。
        $month = $month+1;
        if($month>12){//如果传入月份为12，加了一后就是13了，所以要变成下年的一月
            $month = $month-12;
            $year = $year+1;
        }
        $enday = strtotime($year."-".$month."-01");
        $criteria=new CDbCriteria();
        $criteria->addCondition('sbi_openingtime<'.$enday.' and sbi_openingtime>='.$beginday);
        return $this->nextMonthOpen()->recently(12)->findAllByAttributes(array('sbi_buildtype'=>$sbi_buildtype),$criteria);
    }
    /**
     * 返回最热门的楼盘信息
     * @return <type>
     */
    public function getHotAttentionBuildings($count=6,$sbi_buildtype=1){
        $criteria=new CDbCriteria(array(
           'limit'=>$count,
            'order'=>'sbi_visit desc'
        ));
        $criteria->addCondition('sbi_buildtype='.$sbi_buildtype);
        return $this->findAll($criteria);
    }
    /**
     * 得到最受欢迎的楼盘信息
     * @param <type> $count
     * @return <type>
     */
    public function getWelcomeBuildings($count=5,$sbi_buildtype=1){
        $criteria=new CDbCriteria(array(
           'limit'=>$count,
        ));
        $criteria->addCondition('sbi_buildtype='.$sbi_buildtype);
        $criteria->with=array(
            'comment'=>array(
                'order'=>'SUM(sbc_buildingid + sbc_traffice + sbc_facility) desc',
                'group'=>'sbc_buildingid',
            ),
        );
        return $this->findAll($criteria);
    }
    //将物业级别由数字转为描述
    public function propertyIntToDescribe($pInt){
        if($pInt==1){
            return "甲级";
        }elseif($pInt==2){
            return "乙级";
        }elseif($pInt==3){
            return "丙级";
        }
    }
    /**
     * 根据该楼盘的所有评价,得到平均星级
     * @param <int> $buildingId 楼盘id
     * @return <int> 四舍五入后的星级值
     */
    public function getAvgStar($buildingId){
        $dba = dba();
        $all = $dba->select("SELECT (`sbc_traffice`+`sbc_facility`+`sbc_adorn`) num FROM 35_systembuildingcomment WHERE `sbc_buildingid`=?",$buildingId);
        $allStarNum = 0;
        if($all){
            $num = count($all);
            foreach($all as $value){
                $allStarNum += $value['num'];
            }
            $allStarNum = $allStarNum/$num;
            $allStarNum = $allStarNum/3;
        }
        return $allStarNum;
    }
    /**
     * 得到该楼盘下出租房源的数量
     * @param <type> $buildingId 楼盘id
     * @return <type> 出租房源的数量
     */
    public function getRentNums($buildingId,$type=1){
        if($type==2){
            $sql = 'SELECT COUNT(*) FROM {{shopbaseinfo}} WHERE sb_check=4 AND sb_sellorrent=1 AND sb_sysid='.$buildingId;
        }else{
            $sql = 'SELECT COUNT(*) FROM {{officebaseinfo}} WHERE ob_check=4 AND ob_sellorrent=1 AND ob_sysid='.$buildingId;
        }
        return Yii::app()->db->createCommand($sql)->queryScalar();
    }
    /**
     * 得到该楼盘下出售房源的数量
     * @param <type> $buildingId 楼盘id
     * @return <type> 出售房源的数量
     */
    public function getSellNums($buildingId,$type=1){
        if($type==2){
            $sql = 'SELECT COUNT(*) FROM {{shopbaseinfo}} WHERE sb_check=4 AND sb_sellorrent=2 AND sb_sysid='.$buildingId;
        }else{
            $sql = 'SELECT COUNT(*) FROM {{officebaseinfo}} WHERE ob_check=4 AND ob_sellorrent=2 AND ob_sysid='.$buildingId;
        }
        return Yii::app()->db->createCommand($sql)->queryScalar();
    }
    public function addComment($comment)
	{
        $result = array('state'=>false,'speak'=>'');
        if(Yii::app()->user->isGuest){
            $result['speak']="请先登录!";
        }else{
            $dba = dba();
            $comment->sbc_cid =Yii::app()->user->id;
            $comment->sbc_id = $dba->id('35_systembuildingcomment');
            $comment->sbc_buildingid=$this->sbi_buildingid;
            $comment->sbc_comdate=time();
     
            $isok = $comment->save();
            if($isok){
                $result['state']=true;
                $result['speak']="发表评论成功!";                
            }else{
                $result['speak']="发表评论失败!";
            }
        }
        return $result;
	}
    /**
     *通过传入月份，得到传入月份开盘楼房信息。
     * @param <type> $month 月份。入1、2。如果是负数表示去年。如0表示去年12月，-1表示去年11月，-2表示去年10月，以此类推。
     * @param <type> $criteria
     */
    public function getCriteriaByMonth($month,$criteria){
        //通过传入月份得到具体年月。
        $year = date("Y");
        while($month<1){//如果不是当前年份
            $month = 12+$month;
            $year = $year-1;
        }
        while($month>12){//如果不是当前年份
            $month = $month-12;
            $year = $year+1;
        }
        $beginday = strtotime($year."-".$month."-1");//开始统计时间。
        $month = $month+1;
        if($month>12){//如果传入月份为12，加了一后就是13了，所以要变成下年的一月
            $month = $month-12;
            $year = $year+1;
        }
        $enday = strtotime($year."-".$month."-01");
        $criteria->addBetweenCondition("sbi_openingtime",$beginday,$enday);
        return $criteria;
    }
    /**
     *通过传入年，得到传入当前年开盘楼房信息。
     * @param <type> $year 年 如2011
     * @param <type> $criteria
     */
    public function getCriteriaByYear($year,$criteria){
        $beginday = strtotime($year."-01-01");//开始统计时间。
        $enday = strtotime($year."-12-31");//结束时间
        $criteria->addBetweenCondition("sbi_openingtime",$beginday,$enday);
        return $criteria;
    }
    /**
     *通过传入月份，得到传入月份开盘楼房信息。
     * @param <type> $month 月份。入1、2。如果是负数表示去年。如0表示去年12月，-1表示去年11月，-2表示去年10月，以此类推。
     * @param <type> $count 查询的数目
     */
    public function getBuildinfoByMonth($month,$count=10,$sbi_buildtype=1){
        $criteria = new CDbCriteria();
        $criteria->limit = $count;
        $criteria->addColumnCondition(array("sbi_buildtype"=>$sbi_buildtype));//楼盘类型
        $criteria = $this->getCriteriaByMonth($month,$criteria);
        $criteria->order = "sbi_openingtime desc";
        $list = $this->findAll($criteria);
        return $list;
    }
    /**
     *得到楼盘周边的写字楼。算法以中心点周围的一个正方形为准，如果要以圆为搜索范围就要做多次平方，影响速度。基坐标为0.04
     * @param <type> $bulidid 楼盘id
     * @param <type> $sbi_buildtype要查询的类型，写字楼还是其他，与officebaseinfo表ob_buildingtype对应
     * @param <type> $limit 查询的条数
     * @return <type> 
     */
    public function getNearBuildByBuildId($bulidid,$limit=8,$sbi_buildtype=1){
        $baseindex = 0.008;
        $model = $this->findByPk($bulidid);
        $begin_x = $model->sbi_x -  $baseindex;//最小X
        $end_x = $model->sbi_x + $baseindex;//最大X
        $begin_y = $model->sbi_y - $baseindex;//最小Y
        $end_y = $model->sbi_y + $baseindex;//最大Y
        $criteria=new CDbCriteria(array(
            'limit'=>$limit,
            'condition'=>"sbi_buildtype=$sbi_buildtype and sbi_buildingid!=".$bulidid." and sbi_x between ".$begin_x." and ".$end_x." and sbi_y between "."$begin_y"." and ".$end_y,
        ));
        $list = Systembuildinginfo::model()->findAll($criteria);
        return $list;
    }
    /**
     *通过区域名称，得到首页要显示的楼盘。
     * @param <type> $name 区域名称。如“浦东”
     * @param <type> $limit 查询楼盘数目
     * @return <array>
     */
    public function getBuildByDistrictName($name,$limit,$sbi_buildtype=1){
        $districtid = Region::model()->find("re_parent_id=35 and re_name ='".$name."'");
        $list = array();
        if($districtid!=""){
            $dba = dba();
            $sql = "select sbi_buildingname,sbi_buildingid,sbi_titlepic,sbi_buildtype,sbi_visit from 35_systembuildinginfo";
            $sql .= " WHERE sbi_buildtype=".$sbi_buildtype;
            $sql .= " and sbi_district=".$districtid['re_id']." order by sbi_visit desc limit ".$limit;
            $list = $dba->select($sql);
            foreach($list as $key=>$value){//格式化数据
                $url = Picture::model()->getPicByTitleInt($value['sbi_titlepic'],"_small");
                $list[$key]['img'] = $url;
                $sbi_buildingid=$value['sbi_buildingid'];
                $sbi_buildingname=$value['sbi_buildingname'];
                if($sbi_buildingid==1){//楼盘
                    $link = Yii::app()->createUrl('/systembuildinginfo/view',array("id"=>$sbi_buildingid));
                }else{//商业广场
                    $link = Yii::app()->createUrl('/systembuildinginfo/viewshop',array("id"=>$sbi_buildingid));
                }
                $list[$key]['link'] = $link;
                $list[$key]['sbi_buildingname'] = common::strCut($sbi_buildingname, 24);
                $list[$key]['allbuildname'] = $sbi_buildingname;
            }
        }
        return $list;
    }
    /**
     *通过查看url中是否带有地址外的参数。此方法仅供搜索列表第一次访问时缓存使用。
     * return 如果带有额外参数返回true 否则返回FALSE
     */
    public function checkUrlParam(){
        if($_GET){//有参数
            if(count($_GET)==1){
                $value = array_values($_GET);
                if(key_exists("source", $_GET)&&$_GET['source']==57){//这种情况这是针对写字楼管用，现在写字楼默认显示中介公司
                    return false;
                }elseif($value[0]==""){//这种情况是只设置了一个参数，但是参数没有传值，也认为没有传递参数
                    return false;
                }else{
                    return true;
                }
            }else{
                return true;
            }
        }else{//没有任何参数
            return false;
        }
    }
    /**
     *通过传入楼盘id，得到楼盘名称
     * @param <int> $buildId
     * @return <string>
     */
    public function getBuildNameById($buildId){
        $return  = "";
        if($buildId){
            $bulid = self::findByPk($buildId);
            if($bulid){
                $return = $bulid->sbi_buildingname;
            }
        }
        return $return;
    }
    /**
     *自动完成中需要用到的楼盘数据
     * @param <int> $sbi_buildtype 类型 1楼盘 2 商业广场
     * @return <array>
     */
    public function getAutoCompleteData($sbi_buildtype){
        $dba = dba();
        $sql = "select sbi_buildingid id, sbi_buildingname name, sbi_pinyinshortname egshort, sbi_pinyinlongname eglong from 35_systembuildinginfo where sbi_buildtype=".$sbi_buildtype;
        return $dba->select($sql);
    }

    public function getAllBuilds($urserId,$rentOrSale=0){
        $dba = dba();
        $sql = "SELECT b.* FROM 35_officebaseinfo a left join 35_systembuildinginfo b on a.ob_sysid=b.sbi_buildingid  where a.ob_uid=".$urserId;
        if($rentOrSale!=0){
            $sql .= " and ob_sellorrent=".$rentOrSale;
        }
        $sql .= " group by a.ob_sysid";
        $builds = $dba->select($sql);
        return $builds;
    }
}