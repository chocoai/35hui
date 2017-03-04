<?php

/**
 * This is the model class for table "{{medal}}".
 *
 * The followings are the available columns in table '{{medal}}':
 * @property integer $md_id
 * @property integer $md_uid
 * @property integer $md_type
 * @property integer $md_pinned
 * @property integer $md_size
 * @property integer $md_time
 */
class Medal extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Medal the static model class
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
		return '{{medal}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('md_uid', 'required'),
			array('md_uid, md_type, md_pinned, md_size, md_time, md_gettime, md_rank', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('md_id, md_uid, md_type, md_time', 'safe', 'on'=>'search'),
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
			'md_id' => 'Md',
			'md_uid' => 'Md Uid',
			'md_type' => 'Md Type',
			'md_pinned' => 'Md Pinned',
			'md_rank' => 'Md Rank',
            'md_size' => 'Md Size',
            'md_gettime'=>'md_gettime',
			'md_time' => 'Md Time',
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

		$criteria->compare('md_id',$this->md_id);

		$criteria->compare('md_uid',$this->md_uid);

		$criteria->compare('md_type',$this->md_type);

		$criteria->compare('md_time',$this->md_time);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    private $rank=array(
            0=>array(),
            1=>array(5,20,50,100,200,500),//登陆
            2=>array(5,20,50,100,200,500),//
            3=>array(5,20,50,100,200,500),//
            4=>array(3,10,20,50,100),     //邀请
            5=>array(5,20,50,100,200,500),//
            6=>array(5,20,50,100,200,500),//
            7=>array(5,20,50,100,200,500),//
            8=>array(5,20,50,100,200,500),//
            9=>array(5,20,50,100,200,500),//新房源房源
        );//5、 20、 50、100、200、500
    /**
     * 获取奖章的数字标识
	 * @param $rank array()
	 * @param $size int
	 */
    public function getRank($rank,$size){
        for($i=0,$j=count($rank);$i<$j;$i++){
            if($size < $rank[$i]) break;
        }
        return array($i,$i?$rank[--$i]:0);
    }
    public function getNextMedal($md_type,$size){
        $rank = $this->rank[$md_type];
        return $rank[0];
        for($i=0,$j=count($rank);$i<$j;$i++){
            if($size < $rank[$i]) break;
        }
        
        return $rank[$i];
    }
    /**
	 * 统计登陆任务.
     * @param $userId int
     * @param $md_type int 任务类别
     * @param $md_rank int 奖章数字标示
	 */
    public function medalReward($userId,$md_type,$rankId){
        $missionName = array(
            0=>array(),
            1=>'一路有你',//登陆
            2=>array(5,20,50,100,200,500),//
            3=>array(5,20,50,100,200,500),//
            4=>'呼风唤雨',     //邀请
            5=>array(5,20,50,100,200,500),//
            6=>array(5,20,50,100,200,500),//
            7=>array(5,20,50,100,200,500),//
            8=>array(5,20,50,100,200,500),//
            9=>'房源控',//连续发房源
        );
       $reward = array(
            4=>array(//邀请
                array(30,100,200,1000,5000),//新币
                array(30,100,200,2000,5000),//积分
            ),
            9=>array(//房源
                array(50,300,500,2000,5000,15000),//新币
                array(50,300,500,2000,5000,15000),//积分
            )
        );
        $point = $reward[$md_type][1][$rankId];
        $description = "恭喜您获得".$missionName[$md_type]."奖章，系统赠送{:point}积分";
        Userproperty::model()->addPoint($userId, $point, $description);

    }
    /**
	 * 统计登陆任务.
     * @param $userId int
     * @param $md_type int 任务类别
     * @param $series floor 是否连续
	 */
	public function piwikMedal($userId,$md_type,$series=0)
	{
        if( !in_array($md_type, array(4,9) ) ){return;}
        if(User::model()->getRolebyid($userId)==User::personal){return;}//不针对个人用户
        $rank=array(
            0=>array(),
            1=>array(5,20,50,100,200,500),//登陆
            2=>array(5,20,50,100,200,500),//
            3=>array(5,20,50,100,200,500),//
            4=>array(3,10,20,50,100),     //邀请
            5=>array(5,20,50,100,200,500),//
            6=>array(5,20,50,100,200,500),//
            7=>array(5,20,50,100,200,500),//
            8=>array(5,20,50,100,200,500),//
            9=>array(5,20,50,100,200,500),//新房源房源
        );//5、 20、 50、100、200、500
        $time = time();
        $Medal = Medal::model()->find('md_uid=? AND md_type=? ',array($userId,$md_type));
        if($Medal){
            if($series && date('Ymd',$time) == date('Ymd',$Medal->md_time)){
                return;
            }
            $Medal->md_size+=$series?floor($Medal->md_time/86400)-floor($time/86400)+2:1;
            if($Medal->md_size < 0) $Medal->md_size=1;
            $Medal->md_time=$time;
            $md_rank = $this->getRank($this->rank[$md_type], $Medal->md_size);
            if($Medal->md_rank < $md_rank[1]){//得到奖章
                $Medal->md_rank = $md_rank[1];
                $Medal->md_gettime = $time;
                $this->medalReward($userId, $md_type, $md_rank[0]-1);
            }
            $Medal->update();
        }else{
            $Medal=new Medal();
            $Medal->md_uid=$userId;
            $Medal->md_type=$md_type;
            $Medal->md_size=1;
            $Medal->md_time=$time;
            $Medal->save();
        }
	}
    public function getUserMedal($userId,$md_type){
        $model = $this->model()->find('md_uid=? AND md_type=? ',array($userId,$md_type));
        if(!$model){
            return $this->model();
        }
        return $model;
    }
    
}