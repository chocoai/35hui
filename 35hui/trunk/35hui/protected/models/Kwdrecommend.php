<?php

/**
 * This is the model class for table "{{kwdrecommend}}".
 *
 * The followings are the available columns in table '{{kwdrecommend}}':
 * @property integer $kwr_id
 * @property integer $kwr_buildtype
 * @property integer $kwr_buildid
 * @property string $kwr_name
 * @property integer $kwr_userid
 * @property integer $kwr_sourceid
 * @property integer $kwr_sellorrent
 * @property integer $kwr_buytime
 * @property integer $kwr_expiredtime
 */
class Kwdrecommend extends CActiveRecord
{
    /**
     *楼盘类型
     * @var <type>
     */
    public static $kwr_buildtype = array(
        "1"=>"写字楼",
        "2"=>"商铺",
        "3"=>"住宅",
    );
    /**
     *租售类型
     * @var <type>
     */
    public static $kwr_sellorrent = array(
        "1"=>"出租",
        "2"=>"出售",
    );
    /**
     *最大购买天数
     * @var <type>
     */
    public static $maxBuyDay = 5;
    /**
     *一个关键词最多能够被购买的数量
     * @var <type>
     */
    public static $oneKwdCanByuNum = 5;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Kwdrecommend the static model class
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
		return '{{kwdrecommend}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kwr_buildtype, kwr_buildid, kwr_name, kwr_userid, kwr_buytime, kwr_expiredtime', 'required'),
			array('kwr_buildtype, kwr_buildid, kwr_userid, kwr_sourceid, kwr_sellorrent, kwr_buytime, kwr_expiredtime', 'numerical', 'integerOnly'=>true),
			array('kwr_name', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('kwr_id, kwr_buildtype, kwr_buildid, kwr_name, kwr_userid, kwr_sourceid, kwr_sellorrent, kwr_buytime, kwr_expiredtime', 'safe', 'on'=>'search'),
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
			'kwr_id' => 'Kwr',
			'kwr_buildtype' => '关键词类型',
			'kwr_buildid' => '关键词id',
			'kwr_name' => '关键词',
			'kwr_userid' => '购买者',
			'kwr_sourceid' => '房源',
			'kwr_sellorrent' => '租售类型',
			'kwr_buytime' => '购买时间',
			'kwr_expiredtime' => '过期时间',
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

		$criteria->compare('kwr_id',$this->kwr_id);

		$criteria->compare('kwr_buildtype',$this->kwr_buildtype);

		$criteria->compare('kwr_buildid',$this->kwr_buildid);

		$criteria->compare('kwr_name',$this->kwr_name,true);

		$criteria->compare('kwr_userid',$this->kwr_userid);

		$criteria->compare('kwr_sourceid',$this->kwr_sourceid);

		$criteria->compare('kwr_sellorrent',$this->kwr_sellorrent);

		$criteria->compare('kwr_buytime',$this->kwr_buytime);

		$criteria->compare('kwr_expiredtime',$this->kwr_expiredtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     *得到此关键词已经购买的数量
     * @param <type> $kwr_buildtype
     * @param <type> $kwr_buildid
     * @param <type> $kwr_sellorrent
     * @return <type> 
     */
    public function getAlreadyBuyNum($kwr_buildtype, $kwr_buildid, $kwr_sellorrent){
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array(
            "kwr_buildtype"=>$kwr_buildtype,
            "kwr_buildid"=>$kwr_buildid,
            "kwr_sellorrent"=>$kwr_sellorrent,
        ));
        $count = $this->count($criteria);
        return $count;
    }
    /**
     *得到租售类型
     * @param <type> $sellOrRent
     * @return <type>
     */
    public function getSellOrRent($sellOrRent){
        if(array_key_exists($sellOrRent, Kwdrecommend::$kwr_sellorrent)){
            return Kwdrecommend::$kwr_sellorrent[$sellOrRent];
        }
    }
    /**
     *得到楼盘类型
     * @param <type> $buildtype
     * @return <type>
     */
    public function getBuildType($buildtype){
        if(array_key_exists($buildtype, Kwdrecommend::$kwr_buildtype)){
            return Kwdrecommend::$kwr_buildtype[$buildtype];
        }
    }
    /**
     *获取前台链接
     * @param <type> $name
     * @param <type> $buildtype
     * @param <type> $sellOrRent
     * @return <type>
     */
    public function getShowUrl($name, $buildtype, $sellOrRent){
        $url = "#";
        $name = "keyword".urlencode($name);
        switch($buildtype){
            case 1://写字楼
                if($sellOrRent==1){
                    $url = Yii::app()->createUrl("officebaseinfo/rentIndex",array("search"=>$name));
                }else{
                    $url = Yii::app()->createUrl("officebaseinfo/saleIndex",array("search"=>$name));
                }
                break;
            case 2://商铺
                if($sellOrRent==1){
                    $url = Yii::app()->createUrl("shop/rentIndex",array("search"=>$name));
                }else{
                    $url = Yii::app()->createUrl("shop/sellIndex",array("search"=>$name));
                }
                break;
            case 3://住宅
                if($sellOrRent==1){
                    $url = Yii::app()->createUrl("communitybaseinfo/rentIndex",array("search"=>$name));
                }else{
                    $url = Yii::app()->createUrl("communitybaseinfo/sellIndex",array("search"=>$name));
                }
                break;
            default:
                $url = "#";
                break;
        }
        return $url;
    }
    /**
     *获取推荐的关键词房源
     * @param <int> $kwr_buildtype 关键词类型 1写字楼2商铺3住宅
     * @param <string> $kwr_name 关键词
     * @param <int> $kwr_sellorrent 租售类型1租2售
     * @return <type>
     */
    public function getKwdRecommend($kwr_buildtype, $kwr_name, $kwr_sellorrent){
        $criteria=new CDbCriteria;
        $criteria->select = "kwr_sourceid";
        $criteria->addSearchCondition('kwr_name', $kwr_name);
        $criteria->addColumnCondition(array(
            "kwr_buildtype"=>$kwr_buildtype,
            "kwr_sellorrent"=>$kwr_sellorrent,
        ));
        $criteria->addCondition("kwr_sourceid!=''");
        $criteria->limit = 5;//最多显示5条关键词推广房源
        $recommendSource = $this->findAll($criteria);
        $sourceIdArray = array();
        foreach($recommendSource as $value){
            $sourceIdArray[] = $value->kwr_sourceid;
        }
        if(!$sourceIdArray){//如果没有设置过关键词。返回空
            return array();
        }
        $criteria=new CDbCriteria;
        switch($kwr_buildtype){
            default:
                return null;
                break;
            case 1;//写字楼
                $className = "Officebaseinfo";
                $criteria->addInCondition("ob_officeid",$sourceIdArray);
                break;
            case 2://商铺
                $className = "Shopbaseinfo";
                $criteria->addInCondition("sb_shopid",$sourceIdArray);
                break;
            case 3://住宅
                $className = "Residencebaseinfo";
                $criteria->addInCondition("rbi_id",$sourceIdArray);
                break;
        };
        $return = call_user_func(array($className,"model"))->findAll($criteria);
        return $return;
    }
}