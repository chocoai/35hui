<?php

/**
 * This is the model class for table "{{userboard}}".
 *
 * The followings are the available columns in table '{{userboard}}':
 * @property integer $ub_id
 * @property integer $ub_userid
 * @property integer $ub_fromid
 * @property integer $ub_albumid
 * @property integer $ub_boardtype
 * @property integer $ub_createtime
 */
class Userboard extends CActiveRecord
{

    /**
     * 牌面类型
     * @var <type>
     */
    public static $ub_boardtype = array(
        "1"=>"红牌",
        "2"=>"黑牌",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Userboard the static model class
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
		return '{{userboard}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ub_userid, ub_fromid, ub_createtime', 'required'),
			array('ub_userid, ub_fromid, ub_albumid, ub_boardtype, ub_createtime', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ub_id, ub_userid, ub_fromid, ub_albumid, ub_boardtype, ub_createtime', 'safe', 'on'=>'search'),
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
			'ub_id' => 'Ub',
			'ub_userid' => 'Ub Userid',
			'ub_fromid' => 'Ub Fromid',
			'ub_albumid' => 'Ub Albumid',
			'ub_boardtype' => 'Ub Boardtype',
			'ub_createtime' => 'Ub Createtime',
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

		$criteria->compare('ub_id',$this->ub_id);

		$criteria->compare('ub_userid',$this->ub_userid);

		$criteria->compare('ub_fromid',$this->ub_fromid);

		$criteria->compare('ub_albumid',$this->ub_albumid);

		$criteria->compare('ub_boardtype',$this->ub_boardtype);

		$criteria->compare('ub_createtime',$this->ub_createtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 增加个人本身的打牌记录
     * @param <type> $userId 用户id
     * @param <type> $boardType 牌类型
     * @return <type>
     */
    public function addUserBoard($userId, $boardType){
        $loginUserId = User::model()->getId();
        $model = new Userboard();
        $model->ub_userid = $userId;
        $model->ub_fromid = $loginUserId;
        $model->ub_boardtype = $boardType;
        $model->ub_albumid = 0;
        $model->ub_createtime = time();
        if($model->save()){
            //增加个人所拥有的牌数
            $userMemberModel = Member::model()->findByAttributes(array("mem_userid"=>$userId));
            $boardType==1?$userMemberModel->mem_redboard += 1:$userMemberModel->mem_blackboard +=1;
            if($boardType==1){//统计
                $userMemberModel->mem_todayredboard = $userMemberModel->mem_todayredboardtime==date("Ymd")?$userMemberModel->mem_todayredboard+1:1;
                $userMemberModel->mem_weekredboard = $userMemberModel->mem_weekredboardtime==date("YW")?$userMemberModel->mem_weekredboard+1:1;
                $userMemberModel->mem_monthredboard = $userMemberModel->mem_monthredboardtime==date("Ym")?$userMemberModel->mem_monthredboard+1:1;
                $userMemberModel->mem_todayredboardtime = date("Ymd");
                $userMemberModel->mem_weekredboardtime = date("YW");
                $userMemberModel->mem_monthredboardtime = date("Ym");
            }
            $userMemberModel->update();
            //增加打牌的动态
            $receiverIdArr = array($userId);
            Dynamicmy::model()->addDynamicmy($receiverIdArr, 3, $model->ub_id, $boardType);
            return true;
        }
        return false;
    }
    /**
     *
     * @param <type> $albumId 相册id 
     * @param <type> $boardType 牌类型
     * @return <type> 
     */
    public function addAlbumBoard($albumId,$boardType){
        $loginUserId = User::model()->getId();
        $albumModel = Album::model()->findByPk($albumId);
        if(!$albumModel){//相册不存在
            return false;
        }
        $model = new Userboard();
        $model->ub_userid = $albumModel->am_userid;
        $model->ub_fromid = $loginUserId;
        $model->ub_boardtype = $boardType;
        $model->ub_albumid = $albumId;
        $model->ub_createtime = time();
        if($model->save()){
            $userId = $albumModel->am_userid;
            //增加个人所拥有的牌数
            $userMemberModel = Member::model()->findByAttributes(array("mem_userid"=>$userId));
            $boardType==1?$userMemberModel->mem_redboard += 1:$userMemberModel->mem_blackboard +=1;
            if($boardType==1){//统计
                $userMemberModel->mem_todayredboard = $userMemberModel->mem_todayredboardtime==date("Ymd")?$userMemberModel->mem_todayredboard+1:1;
                $userMemberModel->mem_weekredboard = $userMemberModel->mem_weekredboardtime==date("YW")?$userMemberModel->mem_weekredboard+1:1;
                $userMemberModel->mem_monthredboard = $userMemberModel->mem_monthredboardtime==date("Ym")?$userMemberModel->mem_monthredboard+1:1;
                $userMemberModel->mem_todayredboardtime = date("Ymd");
                $userMemberModel->mem_weekredboardtime = date("YW");
                $userMemberModel->mem_monthredboardtime = date("Ym");
            }
            $userMemberModel->update();
            //增加相册的牌数
            $boardType==1?$albumModel->am_redboard += 1:$albumModel->am_blackboard +=1;
            $albumModel->update();
            //增加打牌的动态
            $receiverIdArr = array($userId);
            Dynamicmy::model()->addDynamicmy($receiverIdArr, 3, $model->ub_id, $boardType);
            return true;
        }
        return false;
    }
    /**
     * 获取打牌图片
     * @param <type> $boardtype 类型
     * @return <string>
     */
    public function getBoardImgSrc($boardtype,$width="30px"){
        $return = "";
        if(array_key_exists($boardtype, Userboard::$ub_boardtype)){
            $src = "/images/".($boardtype==1?"good.jpg":"hate.jpg");
            $return = CHtml::image($src,"",array("width"=>$width,"title"=>self::$ub_boardtype[$boardtype]));
        }
        return $return;
    }
    /**
     * 获取打牌总数
     * @param <int> $userId 给谁打牌
     * @param <int> $fromUserId 打牌者
     * @return <array>
     */
    public function getNumByUserId($userId, $fromUserId){
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("ub_userid"=>$userId,"ub_fromid"=>$fromUserId));
        $criteria->addColumnCondition(array("ub_boardtype"=>1));//
        $red = self::model()->count($criteria);
        
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("ub_userid"=>$userId,"ub_fromid"=>$fromUserId));
        $criteria->addColumnCondition(array("ub_boardtype"=>2));//
        $black = self::model()->count($criteria);
        return array("red"=>$red,"black"=>$black);
    }
}