<?php

class Viewuagent extends CActiveRecord
{
	/**
	 * The followings are the available columns in table '{{viewuagent}}':
	 * @var integer $ua_id
	 * @var string $ua_city
	 * @var string $ua_province
	 * @var string $ua_district
	 * @var string $ua_section
	 * @var string $ua_realname
	 * @var string $ua_msn
	 * @var integer $ua_comid
	 * @var string $ua_photourl
	 * @var string $ua_scardurl
	 * @var string $ua_bcardurl
	 * @var string $ua_scardid
	 * @var string $ua_check
	 * @var string $ua_level
	 * @var string $ua_post
	 * @var string $user_name
	 * @var string $user_pwd
	 * @var string $user_role
	 * @var string $user_regtime
	 * @var string $user_loginnum
	 * @var string $user_lasttime
	 * @var string $user_lastip
	 * @var double $user_value
	 * @var integer $user_id
	 * @var string $user_salt
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
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
		return '{{viewuagent}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ua_city, ua_province, ua_district, ua_section, user_name, user_pwd', 'required'),
			array('ua_comid', 'numerical', 'integerOnly'=>true),
			array('ua_msn','email'),
			array(' ua_realname, ua_scardid', 'length', 'max'=>20),
			array('ua_city, ua_province, ua_district, ua_section','numerical'),
			array('ua_photourl, ua_scardurl, ua_bcardurl', 'length', 'max'=>200),
			array('user_name', 'match', 'pattern'=>'/^\w{6,12}$/','message'=>'用户名6-12位'),
			array('user_pwd','length','min'=>6,'max'=>50,'message'=>'密码最少6位'),
			array('ua_check, user_regtime, user_lasttime,ua_level,ua_post', 'safe'),
			array('user_name','existname')
		);
	}

	public function existname()
	{
		if(!$this->hasErrors())  // we only want to authenticate when no input errors
		{
			$identity=new UserIdentity($this->user_name,$this->user_pwd);
			$identity->existname();
			switch ($identity->errorCode)
			{
				case UserIdentity::ERROR_USERNAME_INVALID:
					$this->addError('user_name','该用户名已经存在');
					break;
				case UserIdentity::ERROR_NONE:
					break;
			}
			
					
		}
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
			'ua_id' => 'ID',
			'ua_city' => '城市',
			'ua_province' => '省份',
			'ua_district' => '行政区域',
			'ua_section' => '板块',
			'ua_realname' => '真实姓名',
			'ua_msn' => 'msn',
			'ua_comid' => '公司名',
			'ua_photourl' => '真实头像',
			'ua_scardurl' => '身份证照片',
			'ua_bcardurl' => '名片照片',
			'ua_scardid' => '身份证号码',
			'ua_check' => '是否通过审核',
			'user_name' => '用户名',
			'user_pwd' => '密码',
			'user_role' => '用户角色',
			'user_regtime' => '注册时间',
			'user_loginnum' => '登录次数',
			'user_lasttime' => '上次登录时间',
			'user_lastip' => '上次登录ip',
			'user_value' => '等级',
			'ua_level'=>'等级',
			'ua_post'=>'公告'
			
		);
	}
	
	/**
	 * 根据用户id获取对应经纪人信息表的主键id
	 * @param $userid
	 * @return integer
	 */
	public function getIdbyuserid($userid)
	{
		$connection = Yii::app()->db;
		$sql = 'SELECT ua_id FROM {{uagent}} WHERE ua_uid = ' . $userid;
		$command=$connection->createCommand($sql);
		$uaid = $command->queryScalar();
		return $uaid;
		
	}
	
	/**
	 * Adds a new comment to this post.
	 * This method will set status and post_id of the comment accordingly.
	 * @param Comment the comment to be added
	 * @return boolean whether the comment is saved successfully
	 */
	public function addComment($comment)
	{
        //print_r($comment->attributes);exit;
		$comment->uac_agentid=$this->ua_id;
		$comment->uac_cid = Yii::app()->user->id;
		$comment->uac_comdate=time();
		//echo $comment->bc_comdate;
		return $comment->save();
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
	 * 根据uid获取经纪人信息
	 * @param $uaid
	 * @return integer
	 */
	public function getUagentinfo($uaid)
	{
		$ua_id = Viewuagent::getIdbyuid($uaid);
		$criteria = new CDbCriteria;
		return Viewuagent::model()->findByAttributes(array('ua_id'=>$ua_id),$criteria);
		
	}
	/**
	 * 通过用户id获取经纪人的真实姓名
	 * @param $userid
	 * @return integer
	 */
	public function getRealnamebyuserId($userid)
	{
		$connection = Yii::app()->db;
		$sql = 'SELECT ua_realname FROM {{uagent}} WHERE ua_uid = ' . $userid;
		$command=$connection->createCommand($sql);
		$uaname = $command->queryScalar();
		return $uaname;
		
	}
    /**
     *
     * @return <type> 合并get和post
     */
    public function mergeGetAndPost(){
        $get = $_GET;
        if(isset($_POST)){
            $get = array_merge($_GET,$_POST);
        }
        return $get;
    }
	/*
     * 经纪人管理房源处理函数
     * @param $get get方法传递的参数
     * @param $state officetag表中ot_check字段的值。
     * @param $sellorrent 租或售 ，与officebaseinfo中对应。为3表示不限
	 * @return $dataProvider
     */
    public  function sellManageTag($state,$sellorrent,$get){
        $dataProvider = array();
        if($get['sourceType']==1){//写字楼
            $dataProvider = self::getOfficeBaseDataProvider($get,$state,$sellorrent);
        }elseif($get['sourceType']==2){//商铺
            $dataProvider = self::getShopBaseDataProvider($get,$state,$sellorrent);
        }
        return $dataProvider;
    }
    /*
     * 通过传入的get，得到写字楼基本的DataProvider
     * @param $get get方法传递的参数
     * @param 租或售 ，与officebaseinfo中对应。为3表示不限
	 * @return integer
     */
    protected  function getOfficeBaseDataProvider($get,$state,$sellorrent){
        $userId = Yii::app()->user->id;
        $criteria = new CDbCriteria;
        $criteria->condition = "ob_uid=".$userId;
        if($sellorrent!=3){//租售不限
            $criteria->addCondition("ob_sellorrent=".$sellorrent);
        }
        if(isset($get['serialnum'])&&$get['serialnum']!=""){
            $criteria->addSearchCondition("op_serialnum",$get['serialnum']);
        }
        //排序
        if(isset($get['od'])&&$get['od']==1){
            $criteria->order = 'ob_updatedate';
        }else if(isset($get['od'])&&$get['od']==2){
            $criteria->order = 'ob_updatedate desc';
        }else if(isset($get['od'])&&$get['od']==3){
            $criteria->order = 'ob_releasedate';
        }else if(isset($get['od'])&&$get['od']==4){
            $criteria->order = 'ob_releasedate desc';
        }else{
            $criteria->order = 'ob_officeid desc';
        }
        $criteria->addColumnCondition(array("ob_check"=>$state));
        if (isset($get['officeState'])&&$get['officeState']==1){//显示全景房源
            $criteria->addColumnCondition(array("ob_ispanorama"=>1));
        }
        if (!empty($get['buildTypeId'])){//按楼盘
            $criteria->addColumnCondition(array("ob_sysid"=>$get['buildTypeId']));
        }
        //关联展示表
        $officePresentInfoCondition = "";
        if(isset($get['kwd'])&&$get['kwd']!=""){//搜索楼盘
            $criteria->addSearchCondition("sbi_buildingname",$get['kwd']);
        }
        $criteria->with[] = 'buildingInfo';
        $dataProvider=new CActiveDataProvider('Officebaseinfo', array(
            'pagination'=>array(
                'pageSize'=>10,
            ),
            'criteria'=>$criteria,
        ));
        return $dataProvider;
    }
    /*
     * 通过传入的get，得到商铺基本的DataProvider
     * @param $get get方法传递的参数
     * @param 租或售 ，与shopbaseinfo中对应。为3表示不限
	 * @return integer
     */
    protected  function getShopBaseDataProvider($get,$state,$sellorrent){
        $userId = Yii::app()->user->id;
        $criteria = new CDbCriteria;
        $criteria->condition = "sb_uid=".$userId." and sb_check=".$state;
        if($sellorrent!=3){//租售不限
            $criteria->addCondition("sb_sellorrent=".$sellorrent);
        }
        if(isset($get['serialnum'])&&$get['serialnum']!=""){
            $criteria->addSearchCondition("sp_serialnum",$get['serialnum']);
        }

        //排序
        if(isset($get['od'])&&$get['od']==1){
            $criteria->order = 'sb_updatedate';
        }else if(isset($get['od'])&&$get['od']==2){
            $criteria->order = 'sb_updatedate desc';
        }else if(isset($get['od'])&&$get['od']==3){
            $criteria->order = 'sb_releasedate';
        }else if(isset($get['od'])&&$get['od']==4){
            $criteria->order = 'sb_releasedate desc';
        }else{
            $criteria->order = 'sb_shopid desc';
        }
        /*//关联标签表
        $shopTagCondition = 'st_check='.$state;//已发布
        if(isset($get['officeState'])&&$get['officeState']==1){//显示急房源
            $shopTagCondition .= " and st_ishurry=1";
        }else if (isset($get['officeState'])&&$get['officeState']==2){//显示热推房源
            $shopTagCondition .= " and st_isrecommend=1";
        }else if (isset($get['officeState'])&&$get['officeState']==3){//显示优质房源
            $shopTagCondition .= " and st_ishigh=1";
        }else if (isset($get['officeState'])&&$get['officeState']==4){//显示全景房源
            $shopTagCondition .= " and st_ispanorama=1";
        }elseif(isset($get['officeState'])&&$get['officeState']==5){//显示置顶推广房源
            $criteria->addColumnCondition(array(
                "tr_sourcetype"=>2,
            ));
            $criteria->addCondition("tr_endtime>".time());//只显示还没过期的。
        }*/
        //关联展示表
        $shopPresentInfoCondition = "";
        if(isset($get['kwd'])&&$get['kwd']!=""){//搜索标题
            $shopPresentInfoCondition = "sp_shoptitle like '%".$get['kwd']."%'";
        }
        $criteria->with = array(
            /*'shopTag'=>array(
                'condition'=>$shopTagCondition,
            ),*/
            'presentInfo'=>array(
                'condition'=>$shopPresentInfoCondition,
            ),
        );
        $dataProvider=new CActiveDataProvider('Shopbaseinfo', array(
            'pagination'=>array(
                'pageSize'=>20,
            ),
            'criteria'=>$criteria,
        ));
        return $dataProvider;
    }
    /**
     *根据条件，得到所有上线的写字楼房源，供店铺精品使用
     * @param <type> $show 条件
     * @return <type>
     */
    public function getOfficeOnLineDataProvider($show){
        $userId = Yii::app()->user->id;
        $criteria = new CDbCriteria;
        $criteria->addColumnCondition(array("ob_uid"=>$userId,"ob_buildingtype"=>3));
        $criteria->addColumnCondition(array("ot_check"=>4));
        //查询房源id
        if(isset ($show['id'])&&$show['id']!=""){
            $criteria->addColumnCondition(array("ob_officeid"=>$show['id']));
        }
        //查询房源标题
        if(isset ($show['kwd'])&&$show['kwd']!=""){
            $criteria->addSearchCondition("op_officetitle",$show['kwd']);
        }
        $criteria->with = array(
            'offictag',"presentInfo"
        );
        $dataProvider=new CActiveDataProvider('Officebaseinfo', array(
            'pagination'=>array(
                'pageSize'=>10,
            ),
            'criteria'=>$criteria,
        ));
        return $dataProvider;
    }
    /**
     *根据条件，得到所有上线的商铺房源，供店铺精品使用
     * @param <type> $show 条件
     * @return <type>
     */
    public function getShopOnLineDataProvider($show){
        $userId = Yii::app()->user->id;
        $criteria = new CDbCriteria;
        $criteria->addColumnCondition(array("sb_uid"=>$userId));
        $criteria->addColumnCondition(array("st_check"=>4));
        //查询房源id
        if(isset ($show['id'])&&$show['id']!=""){
            $criteria->addColumnCondition(array("sb_shopid"=>$show['id']));
        }
        //查询房源标题
        if(isset ($show['kwd'])&&$show['kwd']!=""){
            $criteria->addSearchCondition("sp_shoptitle",$show['kwd']);
        }
        $criteria->with = array(
            'shopTag',"presentInfo"
        );
        $dataProvider=new CActiveDataProvider('Shopbaseinfo', array(
            'pagination'=>array(
                'pageSize'=>10,
            ),
            'criteria'=>$criteria,
        ));
        return $dataProvider;
    }
    /**
     *根据条件，得到所有上线的住宅房源，供店铺精品使用
     * @param <type> $show 条件
     * @return <type>
     */
    public function getResidenceOnLineDataProvider($show){
        $userId = Yii::app()->user->id;
        $criteria = new CDbCriteria;
        $criteria->addColumnCondition(array("rbi_uid"=>$userId));
        $criteria->addColumnCondition(array("rt_check"=>4));
        //查询房源id
        if(isset ($show['id'])&&$show['id']!=""){
            $criteria->addColumnCondition(array("rbi_id"=>$show['id']));
        }
        //查询房源标题
        if(isset ($show['kwd'])&&$show['kwd']!=""){
            $criteria->addSearchCondition("rbi_title",$show['kwd']);
        }
        
        $criteria->with = array('residenceTag',"community");
        $dataProvider=new CActiveDataProvider('Residencebaseinfo', array(
            'pagination'=>array(
                'pageSize'=>10,
            ),
            'criteria'=>$criteria,
        ));
        return $dataProvider;
    }
}