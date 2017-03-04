<?php

class Creativeparkbaseinfo extends CActiveRecord
{
    public static $pictureNorm = array(
        1 => array(
            'suffix'=>"_large",
            'width'=>'240',
            'height'=>'180',
        ),
    );
    /**
     * 物业服务
     * @var <type> 
     */
    public static $cp_propertyserver = array(
        "1"=>"收发邮件",
        "2"=>"订阅报刊",
        "3"=>"订阅机票酒店",
    );
    /**
     * 园内配套
     * @var <type> 
     */
    public static $cp_roommating = array(
        "1"=>"会议室",
        "2"=>"商务中心",
        "3"=>"简餐",
        "4"=>"娱乐",
        "5"=>"ATM",
        "6"=>"便利店",
        "7"=>"零售",
        "8"=>"食堂",
        "9"=>"会展中心",
        "10"=>"银行",
        "11"=>"干洗店",
    );

	/**
	 * Returns the static model of the specified AR class.
	 * @return Creativeparkbaseinfo the static model class
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
		return '{{creativeparkbaseinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cp_name', 'required'),
			array('cp_avgrentprice, cp_propertyprice, cp_defanglv, cp_area', 'numerical'),
			array('cp_name, cp_pinyinlongname, cp_address, cp_developer, cp_propertyname', 'length', 'max'=>200),
			array('cp_englishname, cp_x, cp_y', 'length', 'max'=>100),
			array('cp_pinyinshortname, cp_form', 'length', 'max'=>50),
			array('cp_fengearea, cp_floorheight', 'length', 'max'=>20),
			array('cp_introduce, cp_traffic, cp_carport, cp_propertyserver, cp_roommating, cp_peripheral, cp_district', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cp_id, cp_name, cp_englishname, cp_pinyinshortname, cp_pinyinlongname, cp_district, cp_address, cp_avgrentprice, cp_developer, cp_propertyprice, cp_propertyname, cp_openingtime, cp_defanglv, cp_area, cp_fengearea, cp_floorheight, cp_form, cp_introduce, cp_traffic, cp_carport, cp_propertyserver, cp_roommating, cp_peripheral, cp_x, cp_y', 'safe', 'on'=>'search'),
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
			'cp_id' => 'Cp',
			'cp_name' => 'Cp Name',
			'cp_englishname' => 'English Name',
			'cp_pinyinshortname' => 'Cp Pinyinshortname',
			'cp_pinyinlongname' => 'Cp Pinyinlongname',
			'cp_district' => '行政区',
			'cp_address' => '地址',
            'cp_avgrentprice' => '平均租金',
			'cp_developer' => '开发商',
			'cp_propertyprice' => '物业费',
			'cp_propertyname' => '物业名称',
			'cp_openingtime' => '竣工时间',
			'cp_defanglv' => '得房率',
			'cp_area' => '总面积',
			'cp_fengearea' => '分割面积',
			'cp_floorheight' => '层高',
			'cp_form' => '园区形态',
			'cp_introduce' => '园区介绍',
			'cp_traffic' => '交通情况',
			'cp_carport' => '车位配置',
			'cp_propertyserver' => '物业服务',
			'cp_roommating' => '园内配套',
            'cp_peripheral' => '周边配套',
            'cp_x'=> 'x坐标',
            'cp_y' => 'y坐标',
            'cp_titlepic' => '',
            'cp_releasedate'=>''
		);
	}
    /**
     * 记录并返回楼盘访问历史。
     * @param int $id 当前访问楼盘id
     * @return array
     */
    public function buildViewMemory($id){
        $index = '_CPVM';
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
        $sql='SELECT COUNT(*) as c,t1.`cr_userid`,t2.`ua_source` FROM `{{creativesource}}` t1
            LEFT JOIN `{{uagent}}` t2 ON t1.`cr_userid`=t2.`ua_uid`
            WHERE t1.`cr_cpid`='.$this->cp_id.' AND t1.`cr_check`=4 GROUP BY t1.`cr_cpid`';
        $agentIds=array();
        foreach($db->createCommand($sql)->queryAll($sql) as $r){
            if($r['ua_source']===NULL) continue;
            $canReleaseNum=Uagent::model()->getAllOperateNum($r['cr_userid'],2);//可发布数
            $agentIds[$r['cr_userid']] = floor($r['c']/$canReleaseNum*100*0.4) + floor($r['ua_source']*0.6);//40=100*0.4
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
            $sql='FROM `{{uagent}}` WHERE '.$_sql.'`ua_district`='.$this->cp_district;
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
        $sql = 'SELECT `cp_id`, `cp_name`, `cp_address`, `cp_avgrentprice` ,`cp_titlepic`
            FROM {{creativeparkbaseinfo}} WHERE `cp_avgrentprice`>'.$this->cp_avgrentprice.'
                 LIMIT '.$gt;
        $gtrs = $db->createCommand($sql)->queryAll();
        $lt = $limit-count($gtrs);
        $sql = 'SELECT `cp_id`, `cp_name`, `cp_address`, `cp_avgrentprice` ,`cp_titlepic`
            FROM {{creativeparkbaseinfo}} WHERE `cp_avgrentprice`<'.$this->cp_avgrentprice.'
                 LIMIT '.$lt;
        $ltrs = $db->createCommand($sql)->queryAll();
        return array_merge($gtrs,$ltrs);
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
	
}