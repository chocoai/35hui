<?php
class User extends CActiveRecord {
    /**
     * 专业会员
     */
    const ROLE_MEMBER = 1;
    /**
     * 观众会员
     */
    const ROLE_AUDIENCE = 2;
    /*
     * 角色描述
    */
    public static $authRolesName = array(
            '1' =>'专业会员',
            '2' =>'观众会员',
    );
    /**
     * 头像尺寸
     * @var <type>
     */
    public static $headSize = array(
            1 => array(
                            'suffix'=>"_65x70",
                            'width'=>'65',
                            'height'=>'70',
            ),
            2 => array(
                            'suffix'=>"_130x140",
                            'width'=>'130',
                            'height'=>'140',
            ),
    );
    private $id = null;
    private $role = null;
    private $adminkey = null;
    /**
     * Returns the static model of the specified AR class.
     * @return User the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{user}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                array('u_nickname, u_email, u_password, u_regtime', 'required'),
                array('u_role, u_regtime, u_logintime', 'numerical', 'integerOnly'=>true),
                array('u_nickname', 'length', 'max'=>20),
                array('u_email', 'length', 'max'=>50),
                array('u_password', 'length', 'max'=>64),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('u_id, u_nickname, u_email, u_password, u_role, u_regtime, u_logintime', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
                'u_id' => 'U',
                'u_nickname' => '昵称',
                'u_email' => 'U Email',
                'u_emailcheck' => '邮箱是否认证',
                'u_password' => '密码',
                'u_role' => '角色',
                'u_regtime' => '注册时间',
                'u_logintime' => '最后登录时间',
                'u_photo' => '用户头像'
        );
    }
    public function getId() {
        if(!Yii::app()->user->isGuest) {
            $this->id = Yii::app()->user->id;
        }
        return $this->id;
    }
    public function getRole() {
        if(!Yii::app()->user->isGuest) {
            $this->role = Yii::app()->user->role;
        }
        return $this->role;
    }
    /**
     * 检查输入用户是否是专业会员
     * @param <type> $userId
     * @return <boolean>
     */
    public function checkUserIsMember($userId) {
        $return = false;
        $model = $this->getUserInfoById($userId);
        if($model&&$model->u_role==self::ROLE_MEMBER) {
            $return = true;
        }
        return $return;
    }
    /**
     * 通过userid获取model
     * @param <type> $uid
     * @return <type>
     */
    public function getUserInfoById($uid) {
        return $this->findByPk($uid);
    }
    /**
     * 获得用户昵称
     * @param <type> $uid
     * @return <type>
     */
    public function getUserNameById($uid) {
        $model = $this->findByPk($uid);
        return @$model->u_nickname;
    }
    /**
     * 获取用户头像
     * @param <type> $userModel user表model
     * @param <type> $suffix  后缀
     */
    public function getUserHeadPhoto($userModel,$suffix="") {
        $return = "/images/default/head.jpg";
        if($userModel) {
            $url = @$userModel->u_photo;
            if($url) {
                $return = $url;
                foreach(self::$headSize as $value) {
                    if($value["suffix"]==$suffix) {
                        $return = str_replace(".", $suffix.".", $url);
                    }
                }
            }
        }
        return $return;
    }
    /**
     * 删除用户头像
     * @param <type> $url 数据库中保存的头像地址
     */
    public function delUserPhoto($url) {
        foreach (self::$headSize as $value) {
            $tmpurl = str_replace(".", $value["suffix"].".", $url);
            @unlink(DOCUMENTROOT.$tmpurl);
        }
        @unlink(DOCUMENTROOT.$url);
    }
    /**
     * 获得金币
     * @param <type> $userId 用户id
     * @param <type> $gold 金币数目
     * @param <type> $description 备注
     * @return <type>
     */
    public function addGoldNum($userId,$gold,$description) {
        $model = $this->getUserInfoById($userId);
        $model->u_goldnum = intval($model->u_goldnum)+$gold;
        $model->update();
        Consumelog::model()->writeLog($userId, Consumelog::GAIN, $gold, $description);
        return true;
    }
    /**
     * 消耗金币
     * @param <type> $userId 用户id
     * @param <type> $gold 金币数目
     * @param <type> $description 备注
     * @return <type>
     */
    public function reduceGoldNum($userId,$gold,$description) {
        $model = $this->getUserInfoById($userId);
        $model->u_goldnum = intval($model->u_goldnum) - $gold;
        if($model->u_goldnum>=0) {
            $model->update();
            Consumelog::model()->writeLog($userId, Consumelog::LOSE, $gold, $description);
            return true;
        }else {
            return false;
        }
    }
    /**
     * 判断是否可以扣除金币
     * @param <type> $userId
     * @param <type> $gold
     * @return <type>
     */
    public function checkCanReduceGold($userId,$gold) {
        $model = $this->getUserInfoById($userId);
        $model->u_goldnum = intval($model->u_goldnum) - $gold;
        if($model->u_goldnum>=0) {
            return true;
        }else {
            return false;
        }
    }
    /**
     * 增加用户访问数目
     * @param <type> $userModel
     * @return <type>
     */
    public function addVisitNum($userModel){
        $userModel->u_visitnum +=1;
        $userModel->update();
        return $userModel;
    }
}