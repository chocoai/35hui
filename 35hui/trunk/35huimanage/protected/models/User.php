<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $user_id
 * @property string $user_name
 * @property string $user_salt
 * @property string $user_pwd
 * @property integer $user_role
 * @property integer $user_regtime
 * @property integer $user_loginnum
 * @property integer $user_lasttime
 * @property string $user_lastip
 * @property double $user_value
 * @property double $user_point
 */
class User extends CActiveRecord
{
    const personal=1;
    const agent=2;
    const company=3;

     /**
      * 会员等级描述
      * @var array
      */
    public static $titleArr = array(0=>'置业助理',1=>'高级经纪',2=>'资深经纪',3=>'星级主任');
    public static $pointArr = array(
            "0"=>"0",
            "1"=>"8000",
            "2"=>"30000",
            "3"=>"80000"
        );
     public static $userGradeName=array('普通会员','初级会员','中级会员','高级会员');
    public static $roleDescription = array(
        1=>'普通会员',
        2=>'经纪人',
        3=>'门店',
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_name, user_salt, user_pwd, user_role', 'required'),
			array('user_role, user_regtime, user_loginnum, user_lasttime, user_online, user_housenum, user_subpnum, user_officenum, user_shopnum, user_residencenum, user_grade', 'numerical', 'integerOnly'=>true),
			array('user_name', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, user_name, user_salt, user_pwd, user_role, user_regtime, user_loginnum, user_lasttime, user_lastip, user_value, user_online, user_housenum, user_subpnum, user_officenum, user_shopnum, user_residencenum', 'safe', 'on'=>'search'),
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
            'agentinfo'=>array(self::HAS_ONE,"Uagent","ua_uid"),
            'companyinfo'=>array(self::HAS_ONE,"Ucom","uc_uid"),
            'personalinfo'=>array(self::HAS_ONE,"Unormal","ua_uid"),
            'property'=>array(self::HAS_ONE,"Userproperty","m_userid")
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'Id',
			'user_name' => '用户姓名',
			'user_salt' => 'User Salt',
			'user_pwd' => '用户密码',
			'user_role' => '用户角色',
            'user_vip' => 'User Vip 到期时间',
            'user_grade'=>'用户等级',
			'user_regtime' => '注册时间',
			'user_loginnum' => '登录次数',
			'user_lasttime' => '最后登录时间',
			'user_lastip' => '最后一次登录Ip',
			'user_value' => '最后登录IP',
            'user_online' => '在线时间',
			'user_housenum' => '发布房源数目',
			'user_subpnum' => '上传全景图数量',
			'user_officenum' => '发布写字楼数目',
			'user_shopnum' => '发布商铺数目',
			'user_residencenum' => '发布住宅数目',
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

		$criteria->compare('user_id',$this->user_id);

		$criteria->compare('user_name',$this->user_name,true);

		$criteria->compare('user_salt',$this->user_salt,true);

		$criteria->compare('user_pwd',$this->user_pwd,true);

		$criteria->compare('user_role',$this->user_role);

		$criteria->compare('user_regtime',$this->user_regtime);

		$criteria->compare('user_loginnum',$this->user_loginnum);

		$criteria->compare('user_lasttime',$this->user_lasttime);

		$criteria->compare('user_lastip',$this->user_lastip,true);

		$criteria->compare('user_value',$this->user_value);

		$criteria->compare('user_point',$this->user_point);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 根据用户id返回用户的头像
     * @return <type>
     */
    public function getUserHeadPic($userId,$suffix=null){
        $role = $this->getRolebyid($userId);
        switch($role) {
            case User::personal :
                $headPic = DEFAULT_AGENT;
                $unormalInfo = Unormal::model()->findByAttributes(array('puser_uid'=>$userId));
                if($unormalInfo && $unormalInfo->puser_logopath!="" && $unormalInfo->puser_logoaudit!=2){
                    $headPic = PIC_URL.$unormalInfo->puser_logopath;
                }
                break;
            case User::company :
                $headPic = DEFAULT_COM;
                $companyInfo = Ucom::model()->findByAttributes(array('uc_uid'=>$userId));
                if($companyInfo && $companyInfo->uc_logo!="" && $companyInfo->uc_logoaudit!=2){
                    $headPic = PIC_URL.$companyInfo->uc_logo;
                }
                break;
            case User::agent :
                $headPic = DEFAULT_USER;
                $agentInfo = Uagent::model()->findByAttributes(array('ua_uid'=>$userId));
                if($agentInfo && $agentInfo->ua_photourl!="" && $agentInfo->ua_photoaudit != 2 ){
                    $headPic = PIC_URL.$agentInfo->ua_photourl;
                }
                break;
        }
        return $headPic;
    }
    public function getUserName($userId){
        $user = $this->findByPk($userId);
        if($user){
            return $user->user_name;
        }else{
            return "";
        }
    }
	/**
	*通过用户ID得到名称
	*/
    public function getRealNamebyid($id)
	{
        $userName = "未知";
		$userRole = $this->getRolebyid($id);//得到角色
        if($userRole==User::personal){
            $userNormal = User::model()->findByAttributes(array('user_id'=>$id));
            if($userNormal)
                $userName = $userNormal->user_name;
        }elseif($userRole==User::agent){
            $agentInfo = Uagent::model()->findByAttributes(array('ua_uid'=>$id));
            if($agentInfo)
                $userName = $agentInfo->ua_realname;
        }elseif($userRole==User::company){
            $companyInfo = Ucom::model()->findByAttributes(array('uc_uid'=>$id));
            if($companyInfo)
                $userName = $companyInfo->uc_fullname;
        }
		return $userName;
	}
    public function getRolebyid($id)
	{
		$user = $this->findbyAttributes(array('user_id'=>$id));
        if($user)
            return $user->user_role;
        else
            return null;
	}
    public function getUserShowLink($id,$link=true) {
        $user = $this->findbyAttributes(array('user_id'=>$id));
        $userName=$userLink='';
        if($user) {
            $userRole=$user->user_role;
            if($userRole==User::personal) {
                $userName = $user->user_name;
            }elseif($userRole==User::agent) {
                $agentInfo = Uagent::model()->findByAttributes(array('ua_uid'=>$id));
                if($agentInfo){
                    $userLink=MAINHOST.Yii::app()->createUrl('uagent/index',array('id'=>$agentInfo->ua_id));
                    $userName = $agentInfo->ua_realname;
                }
            }
        }else
            return '';
        $userName=$userName?$userName:$user->user_name;
        if(!$link)
            return $userName;
        if($userLink)
            return '<a target="_blank" href="'.$userLink.'">'.CHtml::encode($userName).'</a>';
        return '';
    }
    /**
     * 获取用户的Vip时间
     * @param integer $user
     * @return integer 到期时间
     */
    public function getUserVip($user=0){
        if(!$user)
            $user=Yii::app()->user->id;
        $_m=$this->findByPk($user);
        if($_m)
           return $_m->user_vip;
        else
            return 0;

    }
    /**
     * 根据套餐id给设置指定用户的Vip时间
     * @param integer $user 用户id
     * @param integer $fcid 套餐id
     */
    public function setUserVip($user,$fcid){
        $_m=$this->findByPk($user);
        if($_m){
            $_fm=Fundsconfig::model()->findByPk($fcid);
            if($_fm && $_fm->fc_vipexp){
                if(!$_m->user_vip)
                    $_m->user_vip=strtotime(date('Ymd'))+86400+$_fm->fc_vipexp*2592000;//86400*30=2592000
                else
                    $_m->user_vip+=$_fm->fc_vipexp*2592000;
                $_m->update();
            }
        }
    }
    /**
     *通过传入的等级级别，得到等级图片
     * @param <type> $level
     * @return <type>
     */
    public function getLevelImgByLevelIndex($level){
        $str = "";
        $allLeave = self::$level;
        if(array_key_exists($level, $allLeave)){
            $str = "<img src='".MAINHOST."/images/level/".$allLeave[$level][2]."' alt='".$allLeave[$level][0]."点积分' title='".$allLeave[$level][0]."点积分'/>";
        }
        return $str;
    }
    /**
     * 得到用户等级Grade
     * @param int $user Id
     * @return numeric
     */
    public function getUserGrade($user=0){
        static $userGrade=array();
        if(!$user)
            $user=Yii::app()->user->id;
        if(!isset($userGrade[$user])){
            $mode=$this->findByPk($user);
            if($mode)
                $userGrade[$user] = $mode->user_grade;
            else
                $userGrade[$user] = '0';
        }
        return $userGrade[$user];
    }
    /**
     *检查用户是否可以购买此套餐。首先判断认证是否通过了，之后判断等级，在判断是否购买过别的套餐。一个用户只能购买一个套餐，而且只能在购买了低级套餐之后才能购买高级套餐。
     * @param <type> $userId 用户id
     * @return <string> 返回1等级不够 2要购买的套餐不正确 3已经购买 success可以购买 4个人用户不能购买 5公司认证还不全 6经纪人认证还不全
     */
    public function checkUserCanUpGrade($userId=0){
        if(!$userId)
            $userId=Yii::app()->user->id;
        $grade=$this->getUserGrade($userId);
        $nextGrade=$grade+1;
        if($nextGrade<1 || $nextGrade>3){
            return "2";
        }
        $point = Userproperty::model()->getUserPoint($userId);//用户积分
        $comboModel = Combo::model()->findByAttributes(array('cb_userlevel'=>$nextGrade));
        if(empty($comboModel)) return '2';

        if($point<$comboModel->cb_minlevel){
            return "1";//积分不够
        }
        return $this->checkRenzhen($userId);
    }
    public function checkRenzhen($userId){
        $role = User::model()->getRolebyid($userId);
        switch($role) {
            case User::personal :
                return 4;
                break;
            case User::company :
                if(!Ucom::model()->getComCheck($userId)){
                    return 5;
                }
                break;
            case User::agent :
                if(!Uagent::model()->getIdentityCertification($userId)||!Uagent::model()->getSeniorityCertification($userId)){
                    return 6;
                }
                break;
        }
        return "success";
    }
}