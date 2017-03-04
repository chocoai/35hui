<?php
/**
 * This is the model class for table "{{msgsubscribe}}".
 *
 * The followings are the available columns in table '{{msgsubscribe}}':
 * @property integer $ms_id
 * @property integer $ms_typeid
 * @property string $ms_email
 * @property integer $ms_num
 * @property integer $ms_type
 */
class Msgsubscribe extends CActiveRecord {
    public $verifyCode;
    /**
     * Returns the static model of the specified AR class.
     * @return Msgsubscribe the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{msgsubscribe}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                array('ms_typeid, ms_email, ms_type', 'required'),
                array('ms_typeid, ms_type', 'numerical', 'integerOnly'=>true),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('ms_email','length', 'max'=>200),
                array('ms_email','email'),
                array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
                array('ms_id, ms_typeid, ms_email, ms_type', 'safe', 'on'=>'search'),
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
                'ms_id' => 'Ms',
                'ms_typeid' => 'Ms Typeid',
                'ms_email' => '邮箱',
                'ms_type' => 'Ms Type',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('ms_id',$this->ms_id);

        $criteria->compare('ms_typeid',$this->ms_typeid);

        $criteria->compare('ms_email',$this->ms_email,true);

        $criteria->compare('ms_num',$this->ms_num);

        $criteria->compare('ms_type',$this->ms_type);

        return new CActiveDataProvider(get_class($this), array(
                        'criteria'=>$criteria,
        ));
    }

    public function getNum($Id,$type) {
        $dba = dba();
        $num = $dba->select_one("select count(*) from 35_msgsubscribe where ms_typeid=? and ms_type=?",$Id,$type);
        return $num;
    }

     public function  validateEmail(){
        $userModel=User::model()->findByAttributes(array('user_email'=>$this->email));
        if($userModel){
           $this->addError('email', '该邮箱已经被注册！');
        }
    }
} 

?>
