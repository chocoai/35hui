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
 * @property string $ua_combo
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
     * 执照审核状态
     */
    public static $ua_licenseaudit = array(
        "0"=>"等待审核",
        "1"=>"审核通过",
        "2"=>"审核未通过",
    );

	/**
	 * Returns the static model of the specified AR class.
	 * @return uagent the static model class
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
			array('ua_uid, ua_province, ua_city, ua_district, ua_section, ua_company','required'),
			array('ua_uid, ua_province, ua_city, ua_district, ua_section, ua_level,ua_source,ua_orderold,ua_ordernew', 'numerical', 'integerOnly'=>true),
			array('ua_realname, ua_scardid, ua_comid', 'length', 'max'=>20),
			array('ua_photourl, ua_scardurl, ua_bcardurl', 'length', 'max'=>200),
            array('ua_post', 'length', 'max'=>400),
			array('ua_check,ua_congyeyear,ua_combo', 'safe'),
			array('ua_id, ua_uid, ua_province, ua_city, ua_district, ua_section, ua_realname, ua_msn, ua_comid, ua_photourl, ua_scardurl, ua_bcardurl, ua_scardid, ua_check, ua_level', 'safe', 'on'=>'search'),
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
			'region'=>array(self::BELONGS_TO,'Region','ua_district'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ua_id' => 'ID',
			'ua_uid' => 'UserId',
			'ua_province' => '省份',
			'ua_city' => '城市',
			'ua_district' => '行政区域',
			'ua_section' => '板块',
			'ua_realname' => '真实姓名',
			'ua_msn' => 'msn',
			'ua_comid' => '营业执照编号',
			'ua_company' => '公司名称',
			'ua_photourl' => '真实头像',
            'ua_photoaudit' => '头像证审核',
			'ua_scardurl' => '身份证照片',
			'ua_scardaudit' => '身份证审核',
			'ua_scardtime' => '身份证认证时间',
			'ua_bcardurl' => '经纪人资格证',
			'ua_bcardaudit' => '资格证认证',
			'ua_bcardtime' => '资格证认证时间',
			'ua_licenseurl' => '公司执照',
			'ua_licenseaudit' => '执照审核',
			'ua_licensetime' => '执照认证时间',
			'ua_scardid' => '身份证号码',
			'ua_check' => '是否通过审核',
			'ua_level' => '等级',
			'ua_post' => '经纪人公告',
            'ua_source' => '总得分',
            'ua_orderold' => '昨日排序',
            'ua_ordernew' => '今日排序',
            'ua_combo' => '所购买的套餐',
            'ua_combotime' => '购买的套餐到期时间',
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

		return new CActiveDataProvider('Uagent', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * 根据写字楼外键用户ID获取经纪人id
	 * @param $id
	 * @return integer
	 */
	public function getIdbyuid($id)
	{
		$connection = Yii::app()->db;
		$sql = 'SELECT ua_id FROM {{uagent}} WHERE ua_uid = ' . $id;
		$command=$connection->createCommand($sql);
		$uaid = $command->queryScalar();
		return $uaid;
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
     *通过传入用户id，得到此经纪人用户是否绑定了中介公司，运营认证
     * @param <int> $userid
     * @return <boolean>
     */
    public function getBindingBusiness($userid){
        $uagent = Uagent::model()->findByAttributes(array("ua_uid"=>$userid));
        if($uagent->ua_licenseaudit==1){
            return true;
        }else {
            return false;
        }
    }
    /**
     *得到用户每一类房源可发布房源总数、可录入房源总数、每日可刷新数。判断是否购买套餐
     * @param <int> $userid 用户id
     * @param <int> $type 1可发布房源总数、2可录入房源总数、3每日可刷新数
     * @return <int> 返回此用户可操作数目
     */
    public function getAllOperateNum($userid,$type){
        $model = $this->findByAttributes(array("ua_uid"=>$userid));
        $grade = $model->ua_combo;
        $num = 0;
        if(!$grade){//表示如果此用户没购买套餐，则使用默认值
            //查看用户的认证情况。根据不同的认证情况的到值
            $r = 0;//默认认证数目
            $this->getIdentityCertification($userid)?$r += 1:$r = $r;
            $this->getSeniorityCertification($userid)?$r += 1:$r = $r;//把原来的中介公司认证变成现在的名片认证
            //通过判断$r值得到能够发布数
            $i = $type-1;

            $r==0?$oprationName = "uagentOpration_unCertificate":"";
            $r==1?$oprationName = "uagentOpration_unAllCertificate":"";
            $r==2?$oprationName = "uagentOpration_AllCertificate":"";//所有认证都通过了。
            $AllCertificate=array_values(Oprationconfig::model()->getConfigByName($oprationName));
            $num = $AllCertificate[$i];
        }else{//使用套餐中的值
            $combo = Combo::model()->findByAttributes(array('cb_id'=>$grade));
            $type==1?$num = $combo['cb_issuednum']:"";//发布数目
            $type==2?$num = $combo['cb_inputnum']:"";//录入数目
            $type==3?$num = $combo['cb_refreshnum']:"";//刷新数目
        }
        return $num;
    }
    /**
     *得到用户每一类房源已发布房源数、已录入房源数、今日已刷新数
     * @param <int> $userid 用户id
     * @param <int> $type 1已发布房源数、2已录入房源数、3今日已刷新数
     * @param <int> $sourceType 房源类型 1写字楼 2商铺 3住宅 4创意园区
     * @return <int> 返回此用户已操作数目
     */
    public function getNowOperateNum($userid,$type,$sourceType=1){
        $num = 0;
        if($type==3){
            $sourceType==1?$operationType=Dayoperation::buildFlush:"";
            $sourceType==2?$operationType=Dayoperation::shopFlush:"";
            $sourceType==3?$operationType=Dayoperation::residenceFlush:"";
            $sourceType==4?$operationType=Dayoperation::creativesourceFlush:"";
            $num = Dayoperation::model()->getPerationNumByUidAndType($userid, $operationType);
        }else if($type==2){//已录入房源数。只要不是已经删除的，都统计。
            if($sourceType==1){//写字楼
                $criteria = new CDbCriteria;
                $criteria->condition = "ob_uid=".$userid." and ob_check!=1";
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
                    'residenceTag'=>array(
                        'condition'=>"rt_check!=1",
                    ),
                );
                $num = Residencebaseinfo::model()->count($criteria);
            }elseif($sourceType==4){//创意园区
                $criteria = new CDbCriteria;
                $criteria->condition = "cr_userid=".$userid." and cr_check!=1";
                $num = Creativesource::model()->count($criteria);
            }
        }else if($type==1){//已发布房源数
             if($sourceType==1){//写字楼
                $criteria = new CDbCriteria;
                $criteria->condition = "ob_uid=".$userid." and ob_check=4";
                $num = Officebaseinfo::model()->count($criteria);
            }elseif($sourceType==2){//商铺
                $criteria = new CDbCriteria;
                $criteria->condition = "sb_uid=".$userid;
                $criteria->with = array(
                    'shopTag'=>array(
                        'condition'=>"st_check=4",
                    ),
                );
                $type==4?$criteria->addColumnCondition(array("st_ishurry"=>1)):"";
                $type==5?$criteria->addColumnCondition(array("st_isrecommend"=>1)):"";
                $num = Shopbaseinfo::model()->count($criteria);
            }elseif($sourceType==3){//住宅
                $criteria = new CDbCriteria;
                $criteria->condition = "rbi_uid=".$userid;
                $criteria->with = array(
                    'residenceTag'=>array(
                        'condition'=>"rt_check=4",
                    ),
                );
                $type==4?$criteria->addColumnCondition(array("rt_ishurry"=>1)):"";
                $type==5?$criteria->addColumnCondition(array("rt_isrecommend"=>1)):"";
                $num = Residencebaseinfo::model()->count($criteria);
            }elseif($sourceType==4){//创意园区
                $criteria = new CDbCriteria;
                $criteria->condition = "cr_userid=".$userid." and cr_check=4";
                $num = Creativesource::model()->count($criteria);
            }
        }
        return $num;
    }
    /**
     *
     * @param <int> $model
     * @param <int> $strlength输出公司名字的长度。默认是全部
     * @return <string>
     */
    public function getCompanyByUaid($model,$strlength="all"){
        $return  = "";
        if($model->ua_company){
            $return = $model->ua_company;
        }
        if($strlength!="all"&&$return){
            $return = common::strCut($return, $strlength);
        }
        return $return;
    }
    /**
     *得到经纪人真实姓名
     * @param <type> $userId
     * @return <string>
     */
    public function getUagentNameByUserId($userId){
        $name = "";
        $model = $this->findByAttributes(array("ua_uid"=>$userId));
        if($model){
            $name = $model->ua_realname;
        }
        return $name;
    }
    /**
     *得到经纪人首页写字楼推荐
     * @param <type> $userId
     * @param <type> $limit 条数
     * @return <type>
     */
    public function getOfficeIndexRecommend($userId, $limit = 6){
        $criteria = new CDbCriteria;
        $criteria->condition = "ob_uid=".$userId." and ob_buildingtype=3";
        $criteria->with = array(
            'offictag'=>array(
                'condition'=>"ot_check=4 and ot_ishomepage=1",
            ),
        );
        $criteria->limit = $limit;
        $homelist = Officebaseinfo::model()->findAll($criteria);
        return $homelist;
    }
    /**
     *得到经纪人首页商铺推荐
     * @param <type> $userId
     * @param <type> $limit
     * @return <type>
     */
    public function getShopIndexRecommend($userId, $limit = 6){
        $criteria = new CDbCriteria;
        $criteria->condition = "sb_uid=".$userId;
        $criteria->with = array(
            'shopTag'=>array(
                'condition'=>"st_check=4  and st_ishomepage=1",
            ),
        );
        $homelist = Shopbaseinfo::model()->findAll($criteria);
        return $homelist;
    }
        /**
     *得到经纪人首页住宅推荐
     * @param <type> $userId
     * @param <type> $limit
     * @return <type>
     */
    public function getResidenceIndexRecommend($userId, $limit = 6){
        $criteria = new CDbCriteria;
        $criteria->condition = "rbi_uid=".$userId;
        $criteria->with = array(
            'residenceTag'=>array(
                'condition'=>"rt_check=4  and rt_ishomepage=1",
            ),
        );
        $homelist = Residencebaseinfo::model()->findAll($criteria);
        return $homelist;
    }
    /**
     *得到最近更新的房源。写字楼和商铺都合并到一起。算法：根据查询条数。各取出相应数目，然后合并
     * @param <type> $userId 用户id
     * @return <array>
     */
    public function getRecentUpdate($userId, $limit=10){
        $criteria = new CDbCriteria;
        $criteria->addColumnCondition(array("ob_uid"=>$userId,"ot_check"=>"4"));
        $criteria->order = "ob_updatedate desc";
        $criteria->limit = $limit;
        $recentOffice = Officebaseinfo::model()->with("offictag")->findAll($criteria);
        
        $criteria = new CDbCriteria;
        $criteria->addColumnCondition(array("sb_uid"=>$userId,"st_check"=>"4"));
        $criteria->order = "sb_updatedate desc";
        $criteria->limit = $limit;
        $recentShop = Shopbaseinfo::model()->with("shopTag")->findAll($criteria);

        //合并两个数组。按照日期倒叙
        $return = array();
        if(!$recentOffice){//如果没有写字楼
            $return = $recentShop;//则返回商铺
        }elseif(!$recentShop){//如果没有商铺
            $return = $recentOffice;//返回写字楼
        }else{//如果都有，则需要合并
            $allArray = array();
            $orderArray = array();
            foreach($recentOffice as $value){
                $allArray[] = $value;
                $orderArray[] = $value->ob_updatedate;
            }
            foreach($recentShop as $value){
                $allArray[] = $value;
                $orderArray[] = $value->sb_updatedate;
            }
            array_multisort($orderArray, SORT_DESC ,$allArray);
            $allArray = array_slice($allArray, 0 ,$limit);//取出前十条数据
            $return = $allArray;
        }
        return $return;
    }
    /**
     * 通过执照认证状态。获取认证信息。
     * @param <type> $licenseState 认证状态
     * @return <type> 
     */
    public function getLicenseState($licenseState){
        $re = "未绑定";
        if(array_key_exists($licenseState, self::$ua_licenseaudit)){
            $re = self::$ua_licenseaudit[$licenseState];
            $licenseState==2?$re = "<font color='red'>".$re."</font>":"";
        }
        return $re;
    }
    /**
     * 得到经纪人排名
     * @param <type> $order
     * @return <type>
     */
    public function formatUserOrder($order){
        $max = 100;
        $return = $max."名以外";
        if($order&&$order<=$max){
            $return = "第".$order."名";
        }
        return $return;
    }
    /**
     * 判断用户是否已经通过审核了
     */
    public function checkUserAudit(){
        $return = "success";//通过
        $userId = Yii::app()->user->id;
        $model = self::findByAttributes(array("ua_uid"=>$userId));
        if($model){
            if($model->ua_check==0){
                //如果是经纪人，并且还没经过审核。
                $return = "error_0";
            }elseif($model->ua_check==2){
                //如果是经纪人，并且审核未通过。
                $return = "error_2";
            }
        }
        return $return;
    }
    /**
     * 获取经纪人购买的套餐
     * @param <ActiveRecord> $model Uagent model
     * @return <url>
     */
    public function getAgentCombo($model){
        if($model){
            $combo = $model["ua_combo"];
            if($combo){
                $comboModel = Combo::model()->findByPk($combo);
                return $comboModel;
            }
        }
    }
    /**
     * 获取经纪人的套餐标签
     * @param <type> $model
     * @return <img>
     */
    public function getAgentComboIconUrl($model,$htmlOption = array()){
        if($model){
            $combo = $model["ua_combo"];
            if($combo){
                $comboModel = Combo::model()->findByPk($combo);
                if($comboModel){
                    $htmlOption["title"] = $comboModel->cb_name;
                    return CHtml::image(Combo::model()->getComboIconUrl($comboModel),$comboModel->cb_name,$htmlOption);
                }
            }
        }
    }
}