<?php

/**
 * This is the model class for table "{{userproperty}}".
 *
 * The followings are the available columns in table '{{userproperty}}':
 * @property integer $m_id
 * @property integer $m_userid
 * @property integer $m_point
 * @property integer $m_money
 */
class Userproperty extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Userproperty the static model class
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
		return '{{userproperty}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('m_id', 'required'),
			array('m_id, m_userid, m_point, m_money', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('m_id, m_userid, m_point, m_money', 'safe', 'on'=>'search'),
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
			'm_id' => 'M',
			'm_userid' => 'M Userid',
			'm_point' => 'M Point',
			'm_money' => 'M Money',
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

		$criteria->compare('m_id',$this->m_id);

		$criteria->compare('m_userid',$this->m_userid);

		$criteria->compare('m_point',$this->m_point);

		$criteria->compare('m_money',$this->m_money);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 获得用户的积分
     * @param <type> $userId
     * @return <type>
     */
    public function getUserPoint($userId){
        $userProperty = $this->findByAttributes(array('m_userid'=>$userId));
        if($userProperty){
            return $userProperty->m_point;
        }
        return 0;
    }
    /**
     * 获得用户的货币
     * @param <type> $userId
     * @return <type>
     */
    public function getUserMoney($userId){
        return 10000;//返回一个很大的值。那样前台如果有要比较的地方，就不会出错了
//        $userProperty = $this->getUserProperty($userId);
//        if($userProperty){
//            return $userProperty->m_money;
//        }
//        return 0;
    }
    /**
     * 添加货币
     * @param <int> $userId 用户userid
     * @param <int> $goldNum 货币数量
     * @param <int> $logDescription 写入日志内容 参考Log::$moneyTemplate
     * @return <boolean>
     */
    public function addMoney($userId,$goldNum,$logDescription){
        return true;
//        $model = $this->findByAttributes(array('m_userid'=>$userId));
//        if($model){
//            $model->m_money = intval($model->m_money)+$goldNum;
//            if($model->save()){
//                $description = str_replace("{:money}", $goldNum, $logDescription);
//                Log::model()->writeLog($userId, Log::money, Log::gain, $goldNum, $description);
//                return true;
//            }
//        }
//        return false;
    }
    /**
     * 扣除货币
     * @param <int> $userId 用户userid
     * @param <int> $goldNum 货币数量
     * @param <string> $logDescription 写入日志内容 参考Log::$moneyTemplate
     * @param <boolean> $isForcibly 是否强制扣除,这样即使积分数量不够,也会扣成0
     * @return <boolean>
     */
    public function deductMoney($userId,$goldNum,$logDescription,$isForcibly = false ){
        return true;
//        $model = $this->findByAttributes(array('m_userid'=>$userId));
//        if($model){
//            if($model->m_money>=$goldNum){
//                $model->m_money = intval($model->m_money)-$goldNum;
//                if($model->save()){
//                    $description = str_replace("{:money}", $goldNum, $logDescription);
//                    Log::model()->writeLog($userId, Log::money, Log::lose, $goldNum, $description);
//                    return true;
//                }
//            }else{//如果钱不够了
//                if($isForcibly){
//                    $nowMoney = $model->m_money;
//                    $model->save();
//                    $description = str_replace("{:money}", $nowMoney, $logDescription);
//                    Log::model()->writeLog($userId, Log::money, Log::lose, $nowMoney, $description);
//                    return true;
//                }
//            }
//        }
//        return false;
    }
   /**
     * 添加积分。用户每日可获取的积分有最大限制
     * @param <int> $user 用户userid
     * @param <int> $point 货币数量
     * @param <int> $logDescription 写入日志内容 参考Log::$pointTemplate
     * @return <boolean>
     */
    public function addPoint($userId,$point,$logDescription){
        $max = Oprationconfig::model()->getConfigByName("oneday_get_max_point",0);
        $model = $this->findByAttributes(array('m_userid'=>$userId));

        $oldTodayPoint = $model->m_todaypoint;
        if(date("ymd",$model->m_lastmodifytime)==date("ymd")){//不是今日第一次
            $model->m_todaypoint = $model->m_todaypoint+$point;
        }else{
            $model->m_todaypoint = $point;
        }
        $model->m_lastmodifytime = time();

        if($model->m_todaypoint>$max){
            $point = $max-$oldTodayPoint;
            $logDescription .="(今日积分获取已达最大值:".$max.")";
            $model->m_todaypoint = $max;
        }

        $model->m_point = intval($model->m_point)+$point;
        if($model->save()){
            $description = str_replace("{:point}", $point, $logDescription);
            Log::model()->writeLog($userId, Log::integral, Log::gain, $point, $description);
            return true;
        }
        return false;
    }
    /**
     * 扣除积分
     * @param <int> $user 用户userid
     * @param <int> $point 货币数量
     * @param <int> $logDescription 写入日志内容 参考Log::$pointTemplate
     * @param <boolean> $isForcibly 是否强制扣除,这样即使积分数量不够,也会扣成0
     * @return <boolean>
     */
    public function deductPoint($userId,$point,$logDescription, $isForcibly = false){
        $model = $this->findByAttributes(array('m_userid'=>$userId));
        if($model){
            if($model->m_point >= $point){
                $model->m_point = intval($model->m_point)-$point;
                if($model->save()){
                    $description = str_replace("{:point}", $point, $logDescription);
                    Log::model()->writeLog($userId, Log::integral, Log::lose, $point, $description);
                    return true;
                }
            }else{//如果积分不够了
                if($isForcibly){
                    $nowPoint = $model->m_point;
                    $model->save();
                    $description = str_replace("{:point}", $point, $logDescription);
                    Log::model()->writeLog($userId, Log::integral, Log::lose, $point, $description);
                    return true;
                }
            }
        }
        return false;
    }
    /**
     * 添加条用户资产记录
     * @param int $userId
     * @param int $point注册成功赠送的积分数
     * @param int $money注册成功赠送的新币数
     * @return boolean 返回是否成功添加记录
     */
    public function addUserProperty($userId,$point=0,$money=0){
        $dba = dba();
        $model = new Userproperty();
        $model->m_userid = $userId;
        $model->m_point = 0;
//        $model->m_money = $money;
        $model->m_id = $dba->id("35_userproperty");
        if($model->save()){
            $this->addPoint($userId, $point, "注册成功，系统赠送".$point."积分");
//            $description = "";
//            Log::model()->writeLog($userId, Log::integral, Log::gain, $point, $description);
            
//            $description = "注册成功，系统赠送".$money."新币";
//            Log::model()->writeLog($userId, Log::money, Log::gain, $money, $description);
            return true;
        }else{
            return false;
        }
    }
}