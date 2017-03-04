<?php

/**
 * This is the model class for table "{{uagent}}".
 *
 * The followings are the available columns in table '{{uagent}}':
 * @property integer $ua_id
 * @property integer $ua_uid
 * @property integer $ua_province
 * @property integer $ua_city
 * @property integer $ua_district
 * @property integer $ua_section
 * @property string $ua_realname
 * @property string $ua_msn
 * @property string $ua_comid
 * @property string $ua_company
 * @property string $ua_photourl
 * @property string $ua_scardurl
 * @property string $ua_scardaudit
 * @property integer $ua_scardtime
 * @property string $ua_bcardurl
 * @property string $ua_bcardaudit
 * @property integer $ua_bcardtime
 * @property string $ua_licenseurl
 * @property string $ua_licenseaudit
 * @property integer $ua_licensetime
 * @property string $ua_scardid
 * @property string $ua_check
 * @property integer $ua_level
 * @property string $ua_post
 */
class Uagent extends CActiveRecord
{
     public static $headPicNorm = array(
        1 => array(
            'suffix'=>'_large',
            'width'=>'116',
            'height'=>'145',
        ),
        2 => array(
            'suffix'=>'_normal',
            'width'=>'80',
            'height'=>'100',
        ),
        3 => array(
            'suffix'=>'_small',
            'width'=>'50',
            'height'=>'50',
        ),
    );
     //身份证规格
    public static $idCardPicNorm = array(
        1=>array(
            'suffix'=>'_large',
            'width'=>'297',
            'height'=>'210',
        )
    );
    //名片认证规格
    public static $businessPicNorm = array(
        1=>array(
            'suffix'=>'_large',
            'width'=>'297',
            'height'=>'210',
        )
    );
    //运营认证规格
    public static $operationPicNorm = array(
        1=>array(
            'suffix'=>'_large',
            'width'=>'297',
            'height'=>'210',
        )
    );
    /**
     * 审核状态
     * @var <type>
     */
    public static $ua_check = array(
        "0"=>"未审核",
        "1"=>"审核通过",
        "2"=>"审核未通过"
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Uagent the static model class
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
		return '{{uagent}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ua_uid, ua_province, ua_city, ua_district, ua_section, ua_company', 'required'),
			array('ua_uid, ua_province, ua_city, ua_district, ua_section, ua_scardtime, ua_bcardtime, ua_licensetime, ua_level', 'numerical', 'integerOnly'=>true),
			array('ua_realname, ua_scardid, ua_comid', 'length', 'max'=>20),
			array('ua_msn, ua_company', 'length', 'max'=>50),
			array('ua_photourl, ua_scardurl, ua_bcardurl, ua_licenseurl', 'length', 'max'=>200),
			array('ua_scardaudit, ua_bcardaudit, ua_licenseaudit, ua_check, ua_post', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ua_id, ua_uid, ua_province, ua_city, ua_district, ua_section, ua_realname, ua_msn, ua_comid, ua_company, ua_photourl, ua_scardurl, ua_scardaudit, ua_scardtime, ua_bcardurl, ua_bcardaudit, ua_bcardtime, ua_licenseurl, ua_licenseaudit, ua_licensetime, ua_scardid, ua_check, ua_level, ua_post', 'safe', 'on'=>'search'),
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
            'userInfo'=>array(self::BELONGS_TO,'User','ua_uid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ua_id' => 'UaID',
			'ua_uid' => '用户ID',
			'ua_province' => '省',
			'ua_city' => '城市',
			'ua_district' => '行政区',
			'ua_section' => '板块',
			'ua_realname' => '真实姓名',
			'ua_msn' => 'Msn',
			'ua_comid' => '营业执照',
			'ua_company' => '公司',
			'ua_photourl' => '头像',
            'ua_photoaudit' => '头像证审核',
			'ua_scardurl' => '身份证',
			'ua_scardaudit' => '身份认证',
			'ua_scardtime' => '身份证认证时间',
			'ua_bcardurl' => '名片',
			'ua_bcardaudit' => '名片认证',
			'ua_bcardtime' => '名片认证时间',
			'ua_licenseurl' => '营业执照',
			'ua_licenseaudit' => '运营认证',
			'ua_licensetime' => '运营认证时间',
			'ua_scardid' => '身份证号码',
			'ua_check' => '审核',
			'ua_level' => '等级',
			'ua_post' => '公告',
            'ua_introduce'=>"申请理由"
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

		$criteria->compare('ua_id',$this->ua_id);

		$criteria->compare('ua_uid',$this->ua_uid);

		$criteria->compare('ua_province',$this->ua_province);

		$criteria->compare('ua_city',$this->ua_city);

		$criteria->compare('ua_district',$this->ua_district);

		$criteria->compare('ua_section',$this->ua_section);

		$criteria->compare('ua_realname',$this->ua_realname,true);

		$criteria->compare('ua_msn',$this->ua_msn,true);

		$criteria->compare('ua_comid',$this->ua_comid,true);

		$criteria->compare('ua_company',$this->ua_company,true);

		$criteria->compare('ua_photourl',$this->ua_photourl,true);

		$criteria->compare('ua_scardurl',$this->ua_scardurl,true);

		$criteria->compare('ua_scardaudit',$this->ua_scardaudit,true);

		$criteria->compare('ua_scardtime',$this->ua_scardtime);

		$criteria->compare('ua_bcardurl',$this->ua_bcardurl,true);

		$criteria->compare('ua_bcardaudit',$this->ua_bcardaudit,true);

		$criteria->compare('ua_bcardtime',$this->ua_bcardtime);

		$criteria->compare('ua_licenseurl',$this->ua_licenseurl,true);

		$criteria->compare('ua_licenseaudit',$this->ua_licenseaudit,true);

		$criteria->compare('ua_licensetime',$this->ua_licensetime);

		$criteria->compare('ua_scardid',$this->ua_scardid,true);

		$criteria->compare('ua_check',$this->ua_check,true);

		$criteria->compare('ua_level',$this->ua_level);

		$criteria->compare('ua_post',$this->ua_post,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
        /**
     *通过传入用户id，得到此经纪人用户是否绑定了中介公司，运营认证
     * @param <int> $userid
     * @return <boolean>
     */
    public function getBindingBusiness($userid){
        $uagent = Uagent::model()->findByAttributes(array("ua_uid"=>$userid));
        if($uagent->ua_licenseurl!=""&&$uagent->ua_licenseaudit==1){
            return true;
        }else {
            return false;
        }
    }
    /**
     *通过传入用户id，得到此用户身份是否已经认证。认证规则为要有身份证照片，并且审核通过。身份认证
     * @param <int> $userid
     * @return <boolean>
     */
    public function getIdentityCertification($userid){
        $uagent = Uagent::model()->findByAttributes(array("ua_uid"=>$userid));
        if($uagent->ua_scardurl!=""&&$uagent->ua_scardaudit==1){
            return true;
        }else {
            return false;
        }
    }
    /**
     *通过传入用户id，得到此用户执业资格是否已经认证。认证规则为有名片，并且审核通过。名片认证
     * @param <int> $userid
     * @return string
     */
    public function getSeniorityCertification($userid){
        $uagent = Uagent::model()->findByAttributes(array("ua_uid"=>$userid));
        if($uagent->ua_bcardurl!=""&&$uagent->ua_bcardaudit==1){
            return true;
        }else {
            return false;
        }
    }
    /**
     *通过传入的状态，得到文字。
     * @param <type> $state 0,1,2
     * @return <type>
     */
    function getTextByState($state){
        $text = "";
        $state==1?$text="已审核":1;
        $state==2?$text="<font color='red'>审核未通过</font>":1;
        $state==0?$text="未审核":1;
        return $text;
    }

    /**
     *得到用户每一类房源已发布房源数、已录入房源数、今日已刷新数
     * @param <int> $userid 用户id
     * @param <int> $type 1已发布房源数、2已录入房源数、3今日已刷新数。
     * @param <int> $sourceType 房源类型 1写字楼 2商铺 3住宅
     * @return <int> 返回此用户已操作数目
     */
    public function getNowOperateNum($userid,$type,$sourceType=1){
        $num = 0;
        if($type==3){
            $sourceType==1?$operationType=Dayoperation::buildFlush:"";
            $sourceType==2?$operationType=Dayoperation::shopFlush:"";
            $sourceType==3?$operationType=Dayoperation::residenceFlush:"";
            $num = Dayoperation::model()->getPerationNumByUidAndType($userid, $operationType);
        }else if($type==2){//已录入房源数。只要不是已经删除的，都统计。
            if($sourceType==1){//写字楼
                $criteria = new CDbCriteria;
                $criteria->condition = "ob_uid=".$userid." and ob_buildingtype=3";
                $criteria->with = array(
                    'offictag'=>array(
                        'condition'=>"ot_check!=1",
                    ),
                );
                $num = Officebaseinfo::model()->count($criteria);
            }elseif($sourceType==2){//商铺
                $criteria = new CDbCriteria;
                $criteria->condition = "sb_uid=".$userid;
                $criteria->with = array(
                    'shopTag'=>array(
                        'condition'=>"st_check!=1",
                    ),
                );

                $num = Shopbaseinfo::model()->count($criteria);
            }elseif($sourceType==3){//住宅
                $criteria = new CDbCriteria;
                $criteria->condition = "rbi_uid=".$userid;
                $criteria->with = array(
                    'tag'=>array(
                        'condition'=>"rt_check!=1",
                    ),
                );

                $num = Residencebaseinfo::model()->count($criteria);
            }
        }else if($type==1){//已发布房源数。只统计状态为发布的房源
             if($sourceType==1){//写字楼
                $criteria = new CDbCriteria;
                $criteria->condition = "ob_uid=".$userid." and ob_buildingtype=3";
                $criteria->with = array(
                    'offictag'=>array(
                        'condition'=>"ot_check=4",
                    ),
                );
                $num = Officebaseinfo::model()->count($criteria);
            }elseif($sourceType==2){//商铺
                $criteria = new CDbCriteria;
                $criteria->condition = "sb_uid=".$userid;
                $criteria->with = array(
                    'shopTag'=>array(
                        'condition'=>"st_check=4",
                    ),
                );
                $num = Shopbaseinfo::model()->count($criteria);
            }elseif($sourceType==3){//住宅
                $criteria = new CDbCriteria;
                $criteria->condition = "rbi_uid=".$userid;
                $criteria->with = array(
                    'tag'=>array(
                        'condition'=>"rt_check=4",
                    ),
                );

                $num = Residencebaseinfo::model()->count($criteria);
            }
        }
        return $num;
    }

}