<?php

class Dayoperation extends CActiveRecord
{
	/**
	 * The followings are the available columns in table '{{dayoperation}}':
	 * @var integer $day_id
	 * @var integer $day_uid
	 * @var integer $day_type
	 * @var integer $day_operationnum
	 * @var integer $day_operationlasttime
	 */
    /* day_type 类型 */
    /** 写字楼刷新 */
    const buildFlush  = 1;
    /** 商铺刷新 */
    const shopFlush  = 2;
    /** 住宅刷新 */
    const residenceFlush  = 3;
    /** 创意园区刷新 */
    const creativesourceFlush  = 4;
    /* day_type 类型 */
	/**
	 * Returns the static model of the specified AR class.
	 * @return dayoperation the static model class
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
		return '{{dayoperation}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('day_uid, day_type, day_operationnum, day_operationlasttime', 'required'),
			array('day_id, day_uid, day_type, day_operationnum, day_operationlasttime', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('day_id, day_uid, day_type, day_operationnum, day_operationlasttime', 'safe', 'on'=>'search'),
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
			'day_id' => 'Day',
			'day_uid' => '用户id',
			'day_type' => '类型',
			'day_operationnum' => '当天已经操作的数目',
			'day_operationlasttime' => '最后一次操作时间',
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

		$criteria->compare('day_id',$this->day_id);

		$criteria->compare('day_uid',$this->day_uid);

		$criteria->compare('day_type',$this->day_type);

		$criteria->compare('day_operationnum',$this->day_operationnum);

		$criteria->compare('day_operationlasttime',$this->day_operationlasttime);

		return new CActiveDataProvider('Dayoperation', array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 通过用户id和类型，得到今天用户对此类型操作已经执行的次数
     * @param <int> $userid 用户id
     * @param <int> $day_type 类型 const buildFlush
     */
    public function getPerationNumByUidAndType($userid,$day_type){
        $begtime = strtotime(date("Y-m-d", time()));//当天的起始时间
        $row = $this->find("day_uid=:day_uid and day_type=:day_type and day_operationlasttime>:begtime",array(
            "day_uid"=>$userid,
            'day_type'=>$day_type,
            'begtime'=>$begtime,
        ));
        if($row==""){
            return "0";
        }else{
            return $row->day_operationnum;
        }
    }
    /**
     * 通过用户id和类型，更新操作次数
     * @param <int> $userid 用户id
     * @param <int> $day_type 类型 const buildFlush
     * @param <int> $flushNum 刷新的次数，默认1
     */
    public function updatePerationNum($userid,$day_type,$flushNum=1){
        $row = $this->find("day_uid=:day_uid and day_type=:day_type",array(
            "day_uid"=>$userid,
            'day_type'=>$day_type,
        ));
        //如果没有数据，则添加数据。表中对应day_uid和day_type只有一条数据
        if($row==""){//添加数据
            $model = new dayoperation();
            $model->day_uid = $userid;
            $model->day_type = $day_type;
            $model->day_operationnum = $flushNum;
            $model->day_operationlasttime = time();
            $model->save();
        }else{ //如果有数据，则查看最后一次操作时间，如果是今天则操作数加1,如果不是则更新操作数为1。
            $begtime = strtotime(date("Y-m-d", time()));//当天的起始时间
            if($row->day_operationlasttime>$begtime){//如果是天则操作数加1
                $row->day_operationnum = $row->day_operationnum+$flushNum;
                $row->day_operationlasttime = time();
                $row->save();
            }else{
                $row->day_operationnum = $flushNum;
                $row->day_operationlasttime = time();
                $row->save();
            }
        }
       
    }
}