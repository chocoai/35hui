<?php

class User extends CActiveRecord
{
    private $_identity;
    /**
     * The followings are the available columns in table '{{user}}':
     * @var integer $user_id
     * @var string $user_name
     * @var string $user_salt
     * @var string $user_pwd
     * @var integer $user_role
     * @var integer $user_regtime
     * @var integer $user_loginnum
     * @var integer $user_lasttime
     * @var string $user_lastip
     * @var double $user_value
     */
    const personal=1;
    const agent=2;
    const company=3;


    /**
     * 主营业务
     */
    public static $mainBusiness = array(
            1 => '写字楼',
            2 => '商铺',
            3 => '住宅',
    );
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
                array('user_name, user_salt, user_pwd, user_role,user_email,user_tel', 'required'),
                array('user_role, user_regtime, user_loginnum, user_lasttime, user_online, user_housenum, user_subpnum, user_officenum, user_shopnum, user_residencenum', 'numerical', 'integerOnly'=>true),
                array('user_name', 'length', 'max'=>30),
                array('user_salt, user_pwd, user_lastip', 'length', 'max'=>20,'min'=>6),

                array('user_email','email'),
                array('user_tel', 'match', 'pattern'=>'/^1[0-9]{10}$/', 'message'=>'请输入正确的手机号码'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('user_id, user_name, user_salt, user_pwd, user_role, user_regtime, user_loginnum, user_lasttime, user_lastip, user_value, user_onLine, user_houseNum, user_subpNum, user_officenum, user_shopnum, user_residencenum', 'safe', 'on'=>'search'),
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
                'user_id' => 'User',
                'user_name' => 'User Name',
                'user_email'=>"邮箱",
                'user_tel'=>"电话号码",
                'user_salt' => 'User Salt',
                'user_pwd' => 'User Pwd',
                'user_role' => 'User Role',
                'user_regtime' => 'User Regtime',
                'user_loginnum' => 'User Loginnum',
                'user_lasttime' => 'User Lasttime',
                'user_lastip' => 'User Lastip',
                'user_value' => 'User Value',
                'user_online' => 'user OnLine',
                'user_housenum' => 'User HouseNum',
                'user_subpnum' => 'User SubpNum',
                'user_officenum' => 'User Officenum',
                'user_shopnum' => 'User Shopnum',
                'user_residencenum' => 'User Residencenum',
                'user_mainbusiness' => 'User Mainbusiness',
        );
    }
    public function login($username,$password)
    {
        if($this->_identity===null)
        {
            $this->_identity=new UserIdentity($username,$password);
            $this->_identity->authenticate();
        }
        if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
        {
            Yii::app()->user->login($this->_identity);
            return true;
        }
        else
            return false;
    }

    /**
     * Checks if the given password is correct.
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password)
    {
        return $this->hashPassword($password,$this->user_salt)===$this->user_pwd;
    }

    /**
     * Generates the password hash.
     * @param string password
     * @param string salt
     * @return string hash
     */
    public function hashPassword($password,$salt)
    {
        return md5($salt.$password);
    }

    /**
     * generate salt by time
     */
    public function generateSalt()
    {
        return md5(microtime());
    }

    public function getNamebyid($id)
    {
        $userName = "";
        $userRole = $this->getRolebyid($id);//得到角色
        if($userRole==User::personal){
            $userNormal = User::model()->findByAttributes(array('user_id'=>$id));
            if($userNormal)
                $userName = $userNormal->user_name;
        }elseif($userRole==User::agent){
            $agentInfo = Uagent::model()->findByAttributes(array('ua_uid'=>$id));
            if($agentInfo)
                $userName = $agentInfo->ua_realname;
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
    /*
     * 得到当前登录者的role
    */
    public function getCurrentRole(){
        $loginUserId = Yii::app()->user->id;
        if($loginUserId){
            $user = $this->findbyAttributes(array('user_id'=>$loginUserId));
            if($user){
                return $user->user_role;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }
    public function getCurrentName(){
        $loginUserId = Yii::app()->user->id;
        return $this->getNamebyid($loginUserId);
    }
    /**
     * 得到当前登录者的user信息
     */
    public function getCurrentUserInfo(){
        $loginUserId = Yii::app()->user->id;
        if($loginUserId){
            $userInfo = $this->findbyAttributes(array('user_id'=>$loginUserId));
            return $userInfo;
        }else{
            return null;
        }
    }
    /**
     *通过传入用户id，得到用户所有信息
     * @param <int> $userid
     * @return <type>
     */
    public function getUserInfoByPk($userid){
        $list = User::model()->findByPk($userid);
        return $list;
    }

    /**
     *通过传入中介id，得到中介公司相关信息
     * @param <int> $id
     * @return <type>
     */
    public function getComInfoByPk($id){
        $list = User::model()->findByPk($id);
        return $list;
    }

    /*
     * 判断登录用户的角色，得到跳转首页面
    */
    public function getUrl() {
        $url = Yii::app()->createUrl('/manage');
        return $url;
    }
    /**
     * 根据用户id返回展示首页的url
     * @return <type>
     */
    public function getUserShowIndexUrl($userId){
        $role = $this->getRolebyid($userId);
        $url = "#_self";
        switch($role) {
            case User::agent :
                $agentInfo = Uagent::model()->findByAttributes(array('ua_uid'=>$userId));
                if($agentInfo)
                    $url = Yii::app()->createUrl('viewuagent/index',array('uaid'=>$agentInfo->ua_id));
                break;
        }
        return $url;
    }
    /**
     * 根据用户id返回用户的头像
     * @return <type>
     */
    public function getUserHeadPic($userId,$suffix=null){
        $role = $this->getRolebyid($userId);
        $headPic = "";
        switch($role) {
            case User::personal :
                $headPic = DEFAULT_AGENT;
                $unormalInfo = Unormal::model()->findByAttributes(array('puser_uid'=>$userId));
                if($unormalInfo && $unormalInfo->puser_logopath!="" && $unormalInfo->puser_logoaudit!=2){
                    $headPic = PIC_URL.$unormalInfo->puser_logopath;
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
    /**
     *通过传入用户id，得到用户的等级
     * @param <type> $userid
     * @param <array> $allOnLineUser 所有在线用户。传入方法：User::model()->getAllOnLineUserId();
     * @return string
     */
    public function getUserLevelByUserId($userid,$allOnLineUser = false){
        $point = Userproperty::model()->getUserPoint($userid);
        $titleArr = array('置业助理(离线)','高级经纪(离线)','资深经纪(离线)','星级主任(离线)');
        $pointArr = array(
            "0"=>"lv1_gray.gif",
            "8000"=>"lv2_gray.gif",
            "30000"=>"lv3_gray.gif",
            "80000"=>"lv4_gray.gif"
        );
        $img = "lv1.png";
        $i = "-1";
        foreach($pointArr as $key=>$value){
            $i +=1;
            if($point>=$key){
                $img = $value;
                $title = $titleArr[$i];
            }
        }
        if($allOnLineUser===false){
            $allOnLineUser = User::model()->getAllOnLineUserId();
        }
        if($allOnLineUser){
            if(in_array($userid, $allOnLineUser)){//在线
                $img = str_replace("_gray.", ".", $img);
                $title = str_replace("离线", "在线", $title);
            }
        }
        
        return CHtml::image(IMAGE_URL.'/level/'.$img,"",array("title"=>$title));
    }
    /**
     *
     * @param <type> $src 数据库中保存的完整图片地址 如：/puser/daqing/129436905448.jpg
     * @param <type> $formatArray 图片规格 如：unormal::$pictureNorm
     */
    public function delUserPicture($src,$formatArray){
        $index = strripos($src, ".");
        $path = PIC_PATH.substr($src, 0, $index);
        $postfix = substr($src, $index);
        foreach($formatArray as $value){
            $image = $path.$value['suffix'].$postfix;
            @unlink($image);
        }
        @unlink(PIC_PATH.$src);
        return TRUE;
    }
    /**
     * 获取高资格用户
     * @param int $limit
     * @return array
     */
    public function getHighUser($limit=4){
        if($limit<=0) return array();
        $criteria=new CDbCriteria();
        $criteria->limit = $limit;
        $criteria->addColumnCondition(array("user_role"=>User::agent));
        $criteria->order = "user_lasttime desc";
        $model = $this->model()->findAll($criteria);
        return $model;
    }
    /**
     *得到用户每一类房源已发布房源数、已录入房源数、今日已刷新数
     * @param <int> $userid 用户id
     * @param <int> $type 1已发布房源数、2已录入房源数、3今日已刷新数、4急房源、5推荐房源
     * @param <int> $sourceType 房源类型 1写字楼 2商铺 3住宅
     * @return <array> 返回此用户 可操作数,已操作数
     */
    public function getOprateState($userid,$type,$sourceType=1){
        switch($this->getCurrentRole()) {
            case User::agent :
                $allNum = Uagent::model()->getAllOperateNum($userid,$type);
                $nowNum = Uagent::model()->getNowOperateNum($userid,$type,$sourceType);
                break;
            default:
                $allNum = 0;//可操作数
                $nowNum = 0;//已操作数
                break;
        }
        return array($allNum,$nowNum);
    }
    /**
     *计算此房源已经花费的新币
     * @param <array> $id
     * @param <int> $sourceType 房源类型 1写字楼 2商铺 3住宅
     * @return <type>
     */
    public function countReleaseMoney($id,$sourceType){//$releaseMoney = Oprationconfig::model()->getConfigByName('release');
        $releaseMoney = Oprationconfig::model()->getConfigByName('release');
        $money = 0;
        if($sourceType == 1){
            foreach($id as $value){
                $model = Officetag::model()->findByAttributes(array("ot_officeid"=>$value));
                //计算要扣的新币。
                $money += $releaseMoney[0];
                if($model->ot_isrecommend==1){
                    $money += $releaseMoney[1];
                }
                if($model->ot_ishurry==1){
                    $money += $releaseMoney[2];
                }
            }
        }elseif($sourceType == 2){
            foreach($id as $value){
                $model = Shoptag::model()->findByAttributes(array("st_shopid"=>$value));
                //计算要扣的新币。
                $money += $releaseMoney[0];
                if($model->st_isrecommend==1){
                    $money += $releaseMoney[1];
                }
                if($model->st_ishurry==1){
                    $money += $releaseMoney[2];
                }
            }
        }
        elseif($sourceType == 3){
            foreach($id as $value){
                $model = Residencetag::model()->findByAttributes(array("rt_rbiid"=>$value));
                //计算要扣的新币。
                $money += $releaseMoney[0];
                if($model->rt_isrecommend==1){
                    $money += $releaseMoney[1];
                }
                if($model->rt_ishurry==1){
                    $money += $releaseMoney[2];
                }
            }
        }
        return $money;
    }
    /**
     *用户发布房源时，验证是否可以发布，验证分为是否达到最大发布数，是否达到最大录入数，要扣除的新币是否足够。
     * @param <type> $userid用户id
     * @param <type> $type 发布房源还是保存为草稿。1是发布，2是保存为草稿。
     * @param <int> $sourceType 房源类型 1写字楼 2商铺 3住宅 4创意园区
     * @param <type> $money 要扣除的新币
     * @param <type> $hurry 是否是急房源 0不是 1是
     * @param <type> $recommend 是否是推荐房源 0不是 1是
     */
    public function validateRelease($userid,$type,$sourceType,$money=0,$hurry=0, $recommend=0){
        $role = User::model()->getCurrentRole();
        switch($role) {
            default:
                $allReleaseNum = $nowReleaseNum = $allOnlineNum = $nowOnlineNum =0;
                break;
            case User::agent :
                $allReleaseNum = Uagent::model()->getAllOperateNum($userid,2);//可录入总数
                $nowReleaseNum = Uagent::model()->getNowOperateNum($userid,2,$sourceType);//已经录入总数
                $allOnlineNum = Uagent::model()->getAllOperateNum($userid,1);//可发布的总数
                $nowOnlineNum = Uagent::model()->getNowOperateNum($userid,1,$sourceType);//已发布的数目
                $className = "Uagent";
                break;
        }
        //验证是否达到录入的上限
        if($allReleaseNum>$nowReleaseNum){
            //验证成功，用户还能进行录入操作。如果是发布房源。则要判断是否达到发布的上限，还有积分是否足够
            if($type==1){//发布
                if($allOnlineNum<=$nowOnlineNum){
                    return "1";//验证失败。信息提示为超过发布次数，可以选择保存为草稿。
                }
            }
        }else{
            return "0";//验证失败。信息提示为超过可总共可录入数目。
        }
        return "success";
    }
    /**
     *通过用户id、房源类型得到此种类型下所有的全景房源数目
     * @param <int> $userId 用户id
     * @param <int> $type 房源类型 1写字楼 2商铺 3住宅 4创意园区
     * @return <int>
     */
    public function countAllPanoramas($userId, $type){
        $criteria=new CDbCriteria();
        $num = "null";
        if($type==1){//写字楼
            $criteria->addColumnCondition(array(
                    "ob_ispanorama"=>1,
                    "ob_check"=>4,
                    "ob_uid"=>$userId,
            ));
            $num = Officebaseinfo::model()->count($criteria);
        }elseif($type==2){//商铺
            $criteria->with = array("shopTag");
            $criteria->addColumnCondition(array(
                    "st_ispanorama"=>1,
                    "st_check"=>4,
                    "sb_uid"=>$userId,
            ));
            $num = Shopbaseinfo::model()->count($criteria);
        }elseif($type==3){
            $criteria->with = array("residenceTag");
            $criteria->addColumnCondition(array(
                    "rt_ispanorama"=>1,
                    "rt_check"=>4,
                    "rbi_uid"=>$userId,
            ));
            $num = Residencebaseinfo::model()->count($criteria);
        }elseif($type==4){//创意园区
            $criteria->addColumnCondition(array(
                    "cr_ispanorama"=>1,
                    "cr_check"=>4,
                    "cr_userid"=>$userId,
            ));
            $num = Creativesource::model()->count($criteria);
        }
        return $num;
    }
    public function checkRenzhen($userId){
        $role = User::model()->getRolebyid($userId);
        switch($role) {
            case User::personal :
                return 4;
                break;
            case User::agent :
                if(!Uagent::model()->getIdentityCertification($userId)||!Uagent::model()->getSeniorityCertification($userId)){
                    return 6;
                }
                break;
        }
        return "success";
    }
    public function userLogin($ip){
        $userId = Yii::app()->user->id;
        $usermodel = User::model()->findByPk($userId);
        //判断是否当天第一次登录，是就加积分和新币。
        $time = time();
        $logsql="INSERT INTO {{userloginlog}} (`ul_role`, `ul_userid`, `ul_date`, `ul_timestamp`)
            VALUES ('".$usermodel->user_role."', '".$userId."', '".date('Ymd',$time)."', '".$time."');";
        Yii::app()->db->createCommand($logsql)->execute();
        if(date('Ymd',$usermodel->user_lasttime)!==date('Ymd',$time)){
            //通过用户角色给用户添加积分。
            if($usermodel->user_role==User::company){
                //中介公司添加2分积分和2分新币
                $money = Oprationconfig::model()->getConfigByName('day_login_ucom','0');
                $integral = Oprationconfig::model()->getConfigByName('day_login_ucom','1');
            }else{
                $money = Oprationconfig::model()->getConfigByName('day_login_first','0');
                $integral = Oprationconfig::model()->getConfigByName('day_login_first','1');
            }
            Userproperty::model()->addMoney($userId, $money, Log::$moneyTemplate[1]);
            Userproperty::model()->addPoint($userId, $integral, Log::$pointTemplate[1]);
            //Medal::model()->piwikMedal($userId, 1, 1);//登陆任务
        }
        $usermodel->user_loginnum = $usermodel->user_loginnum + 1;
        $usermodel->user_lastip = $ip;
        $usermodel->user_lasttime = time();
        $usermodel->user_lastoptime = time();
        $usermodel->update();
    }
    /**
     *
     * @param <type> $userId
     * @return <type> 返回邮箱地址
     */
    public function getUserEmail($userId){
        $email="test@360dibiao.com";//设置默认邮件地址
        $model = self::model()->findByPk($userId);
        if($model){
            $email = $model->user_email;
        }
        return $email;
    }
    /**
     * 获取用户的真实名称
     */
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
                    $userLink=Yii::app()->createUrl('uagent/index',array('id'=>$agentInfo->ua_id));
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
     * 返回主营物业
     * @param <type> $userId
     * @return <type>
     */
    public function getMainBusiness($userId){
        $return = "1";
        $model = $this->findByPk($userId);
        if($model){
            $return = $model->user_mainbusiness;
        }
        return $return;
    }
    /**
     * 得到所有在线用户的用户id
     * @return <array>
     */
    public function getAllOnLineUserId(){
        $return = array();
        $offset = 600; //偏移量。多长时间不点击页面算下线
        $time = time();
        $connection = Yii::app()->db;
		$sql = 'SELECT user_id FROM {{user}} WHERE user_lastoptime > ' . ($time-$offset);
		$command=$connection->createCommand($sql);
		$userArr = $command->queryAll();
        if($userArr){
            foreach($userArr as $value){
                $return[] = $value["user_id"];
            }
        }
        return $return;
    }
    public function checkTelAndEmail($model){
        $model->validate(array("user_tel","user_email"));//先判断格式
        //下面判断是否重复。由于只有在修改资料的时候才需要判断，而且现在有好多的重复项。所以不能写在role中，以免导致其他问题
        if(!$model->hasErrors()){
            $userId = $model->user_id;
            $tel = $model->user_tel;
            $email = $model->user_email;

            $telCount = $this->count("user_id !=".$userId." and user_tel=?",array($tel));
            if($telCount!=0){
                $model->addError('user_tel', '电话号码已经被注册！');
            }
            $emailCount = $this->count("user_id !=".$userId." and user_email=?",array($email));
            if($emailCount!=0){
                $model->addError('user_email', '此邮箱已经被注册！');
            }
        }
        return $model;
    }
}