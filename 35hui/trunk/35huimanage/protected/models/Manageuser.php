<?php

/**
 * This is the model class for table "{{manageuser}}".
 *
 * The followings are the available columns in table '{{manageuser}}':
 * @property integer $mag_userid
 * @property string $mag_username
 * @property string $mag_password
 * @property string $mag_realname
 * @property integer $mag_role
 * @property integer $mag_state
 * @property integer $mag_releasetime
 * @property string $mag_tel
 */
class Manageuser extends CActiveRecord {
    /**
     *账号类型
     * @var <array>
     */
    public static $mag_role = array(
            "1"=>"管理员",
            "2"=>"普通用户",//只能创建普通用户
    );
    /**
     *账号状态
     * @var <array>
     */
    public static $mag_state = array(
            "0"=>"正常",
            "1"=>"锁定",
            "2"=>"删除",
    );
    /**
     * Returns the static model of the specified AR class.
     * @return Manageuser the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{manageuser}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                array('mag_username, mag_password, mag_realname, mag_releasetime', 'required'),
                array('mag_role, mag_state, mag_releasetime', 'numerical', 'integerOnly'=>true),
                array('mag_username, mag_realname', 'length', 'max'=>50),
                array('mag_password', 'length', 'max'=>200),
				array('mag_tel', 'length', 'max'=>11),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('mag_userid, mag_username, mag_password, mag_realname, mag_role, mag_state, mag_releasetime, mag_tel', 'safe', 'on'=>'search'),
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
                'mag_userid' => '用户ID',
                'mag_username' => '用户名',
                'mag_password' => '密码',
                'mag_realname' => '真实姓名',
                'mag_role' => '用户角色',
                'mag_state' => '账号状态',
                'mag_releasetime' => '录入时间',
				'mag_tel' => '客服号码',
        );
    }
    /**
     *  清除后台用户的可视菜单缓存
     * 如果不能删除请检查 @see COutputCache::getCacheKey();
     * @param int $uid defaut to NULL that to delete all userMenuCache
     */
    public function clearUserMenuCache($uid = NULL){
        $fix = COutputCache::CACHE_KEY_PREFIX.Yii::app()->params['authMenueCacheFix'];
        if($uid===NULL){
            $users = $this->findAll(array('select'=>'mag_userid'));
            foreach($users as $user){
                Yii::app()->cache->delete($fix.$user->mag_userid.'......');
            }
        }else
            Yii::app()->cache->delete($fix.$uid.'......');
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('mag_userid',$this->mag_userid);

        $criteria->compare('mag_username',$this->mag_username,true);

        $criteria->compare('mag_password',$this->mag_password,true);

        $criteria->compare('mag_realname',$this->mag_realname,true);
        
        $criteria->compare('mag_role',$this->mag_role);

        $criteria->compare('mag_state',$this->mag_state);

        $criteria->compare('mag_releasetime',$this->mag_releasetime);
		
		$criteria->compare('mag_tel',$this->mag_tel,true);

        return new CActiveDataProvider(get_class($this), array(
                        'criteria'=>$criteria,
        ));
    }
    public function validatePassword($pwd) {
        return md5($pwd)===$this->mag_password;
    }
    /**
     *验证是否是管理员。如果是则返回true，不是则返回错误页面
     * @return <type>
     */
    public function validateAdminRole(){
        $userId = Yii::app()->user->id;
        $userModel = Manageuser::model()->findByPk($userId);
        if($userModel&&$userModel->mag_role==1){//只有管理员才能执行
            return true;
        }
        throw new CHttpException(404,'您没有权限执行此操作！');
    }
    /**
     *通过用户id得到用户名
     * @param <type> $userId
     * @return <type>
     */
    public function getNameById($userId){
        $model = $this->findByPk($userId);
        $name = "";
        if($model){
            $name = $model->mag_realname;
        }
        return $name;
    }
}