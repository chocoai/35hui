<?php

/**
 * This is the model class for table "{{log}}".
 *
 * The followings are the available columns in table '{{log}}':
 * @property integer $lg_id
 * @property integer $lg_userid
 * @property integer $lg_type
 * @property integer $lg_gainorlose
 * @property integer $lg_score
 * @property string $lg_description
 * @property integer $lg_recodetime
 */
class Log extends CActiveRecord
{
    /* type 类型 */
    /** 积分 */
    const integral = 1;
    /** 货币 */
    const money = 2;
    /* type 类型 */
    
    /* 获得 还是 消耗 */
    /** 获得 */
    const gain = 1;
    /** 消耗 */
    const lose = 2;
    /* 获得积分 还是 消耗积分 */

    /**
     *商务币操作日志模板
     * @var <array>
     */
    public static $moneyTemplate = array(
        "1"=>"今日第一次登录，系统赠送{:money}商务币",
        "2"=>"申请拍摄全景成功，扣除{:money}商务币",
        "3"=>"购买广告栏位成功，扣除{:money}商务币"
    );
    /**
     *积分操作日志模板
     * @var <array>
     */
    public static $pointTemplate = array(
        "1"=>"今日第一次登录，系统赠送{:point}积分",
    );

	/**
	 * Returns the static model of the specified AR class.
	 * @return Log the static model class
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
		return '{{log}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lg_id, lg_userid, lg_type, lg_gainorlose, lg_score, lg_description, lg_recodetime', 'required'),
			array('lg_id, lg_userid, lg_type, lg_gainorlose, lg_score, lg_recodetime', 'numerical', 'integerOnly'=>true),
			array('lg_description', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('lg_id, lg_userid, lg_type, lg_gainorlose, lg_score, lg_description, lg_recodetime', 'safe', 'on'=>'search'),
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
			'lg_id' => 'Id',
			'lg_userid' => '用户Id',
			'lg_type' => 'Log类别',
			'lg_gainorlose' => '得到or消耗',
			'lg_score' => '数量',
			'lg_description' => '描述',
			'lg_recodetime' => '时间',
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

		$criteria->compare('lg_id',$this->lg_id);

		$criteria->compare('lg_userid',$this->lg_userid);

		$criteria->compare('lg_type',$this->lg_type);

		$criteria->compare('lg_gainorlose',$this->lg_gainorlose);

		$criteria->compare('lg_score',$this->lg_score);

		$criteria->compare('lg_description',$this->lg_description,true);

		$criteria->compare('lg_recodetime',$this->lg_recodetime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 写log记录
     * @param <int> $userId 用户userid
     * @param <int> $type log类型
     * @param <int> $gainorlose 获得还是扣除
     * @param <int> $num 数量值
     * @param <string> $description 描述
     * @return <boolean> 写log成功or失败
     */
    public function writeLog($userId,$type,$gainorlose,$num,$description){
        $model = new Log();
        $dba = dba();
        $model->lg_id = $dba->id("35_log");
        $model->lg_userid = $userId;
        $model->lg_type = $type;
        $model->lg_gainorlose = $gainorlose;
        $model->lg_score = $num;
        $model->lg_description = $description;
        $model->lg_recodetime = time();
        if($model->save()){
            return true;
        }else{
            return false;
        }
    }
}