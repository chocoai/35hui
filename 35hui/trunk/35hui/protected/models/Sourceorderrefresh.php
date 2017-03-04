<?php

/**
 * This is the model class for table "{{sourceorderrefresh}}".
 *
 * The followings are the available columns in table '{{sourceorderrefresh}}':
 * @property integer $sor_id
 * @property integer $sor_ordertime
 * @property integer $sor_sourceid
 * @property integer $sor_sourcetype
 * @property integer $sor_releasetime
 * @property integer $sor_deadline
 */
class Sourceorderrefresh extends CActiveRecord
{
    /**
     *预约刷新可选项 小时
     * @var <type> 
     */
    public static $hourSelect = array(
        "-1"=>"--",
        "8"=>"08",
        "9"=>"09",
        "10"=>"10",
        "11"=>"11",
        "12"=>"12",
        "13"=>"13",
        "14"=>"14",
        "15"=>"15",
        "16"=>"16",
        "17"=>"17",
        "18"=>"18",
        "19"=>"19",
        "20"=>"20",
        "21"=>"21",
        "22"=>"22",
        "23"=>"23",
    );
    /**
     *预约刷新可选项 分钟
     * @var <type>
     */
    public static $minuteSelect = array(
        "-1"=>"--",
        "00"=>"00",
        "10"=>"10",
        "20"=>"20",
        "30"=>"30",
        "40"=>"40",
        "50"=>"50",
    );
    /**
     *预约刷新使用的时间
     * @var <type>
     */
    public static $orderDays = array(
        "1"=>"今天",
        "2"=>"2天",
        "3"=>"3天",
        "4"=>"4天",
        "5"=>"5天",
        "6"=>"6天",
        "7"=>"7天",
    );
    /**
     *房源类型
     * @var <type>
     */
    public static $sor_sourcetype = array(
        "1"=>"写字楼",
        "2"=>"商铺",
        "3"=>"住宅",
        "4"=>"创意园区",
    );

	/**
	 * Returns the static model of the specified AR class.
	 * @return Sourceorderrefresh the static model class
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
		return '{{sourceorderrefresh}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sor_ordertime, sor_sourceid, sor_sourcetype, sor_releasetime, sor_deadline', 'required'),
			array('sor_ordertime, sor_sourceid, sor_sourcetype, sor_releasetime, sor_deadline', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sor_id, sor_ordertime, sor_sourceid, sor_sourcetype, sor_releasetime, sor_deadline', 'safe', 'on'=>'search'),
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
			'sor_id' => 'Sor',
			'sor_ordertime' => '刷新时间',
			'sor_sourceid' => '房源id',
			'sor_sourcetype' => '房源类型',
			'sor_releasetime' => '录入时间',
			'sor_deadline' => '截止日期',
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

		$criteria->compare('sor_id',$this->sor_id);

		$criteria->compare('sor_ordertime',$this->sor_ordertime);

		$criteria->compare('sor_sourceid',$this->sor_sourceid);

		$criteria->compare('sor_sourcetype',$this->sor_sourcetype);

		$criteria->compare('sor_releasetime',$this->sor_releasetime);

		$criteria->compare('sor_deadline',$this->sor_deadline);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    
    /**
     *通过传入的天数，得到保存的截止日期。截止日期计算到当天晚上11点59分59秒+天数。
     * @param <type> $days 天数
     * @return <string>
     */
    public function getDeadLine($days){
        $today = strtotime(date("Y-m-d"));
        $useTime = 86400*$days+$today-1;
        return $useTime;
    }
    /**
     *通过传入的资源id和资源类型，得到此资源是否已经存在预约。
     * @param <int> $sourceId 资源id
     * @param <string> $type 资源类型。可选项office/shop
     * @return <int> 返回1标明已经存在预约
     */
    public function checkOrderRefresh($sourceId,$type){
        $sourceType="";
        $type=="office"?$sourceType="1":"";
        $type=="shop"?$sourceType="2":"";
        $type=="residence"?$sourceType="3":"";
        $type=="cypark"?$sourceType="4":"";
        if($sourceType!=""){
            $model = $this->findByAttributes(array("sor_sourceid"=>$sourceId,"sor_sourcetype"=>$sourceType));
            if(!$model){
                return "0";
            }
        }
        return "1";
    }
    public function formatOrderTime($orderTime){
        $minute = $this->getMinute($orderTime);
        $hour = $this->getHour($orderTime);
        $return = $hour.":".$minute;
        return $return;
    }
    /**
     *格式化数据库中保存的预约时间，得到小时
     * @param <type> $orderTime
     * @return <type> 
     */
    public function getHour($orderTime){
        $orderTime = "0000".$orderTime;//默认前面补四个0
        $hour = substr($orderTime, -4, 2);
        return $hour;
    }
    /**
     *格式化数据库中保存的预约时间，得到分钟
     * @param <type> $orderTime
     * @return <type>
     */
    public function getMinute($orderTime){
        $orderTime = "0000".$orderTime;//默认前面补四个0
        $minute = substr($orderTime, -2);
        return $minute;
    }
    /**
     *通过用户和类型，判断用户是否还能刷新房源
     * @param <type> $userId
     * @param <type> $type 1写字楼 2商铺
     * @return <boolean>
     */
    public function checkCanRefreshByUserAndType($userId, $type){
        $role = User::model()->getRolebyid($userId);
        $return = false;
        switch($role) {
            default:
                break;
            case User::personal :
                $return = false;
                break;
            case User::agent :
                $all = Uagent::model()->getAllOperateNum($userId, 3);
                $now = Uagent::model()->getNowOperateNum($userId, 3, $type);
                if($all>$now){
                    $return = true;
                }
                break;
        }
        return $return;
    }
}