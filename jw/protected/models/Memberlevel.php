<?php

/**
 * This is the model class for table "{{memberlevel}}".
 *
 * The followings are the available columns in table '{{memberlevel}}':
 * @property integer $ml_id
 * @property string $ml_name
 * @property integer $ml_redboards
 */
class Memberlevel extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     * @return memberlevel the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{memberlevel}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                array('ml_name, ml_redboards,ml_albumnum,ml_dayboardnum', 'required'),
                array('ml_id, ml_redboards', 'numerical', 'integerOnly'=>true),
                array('ml_name', 'length', 'max'=>15),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('ml_id, ml_name, ml_redboards', 'safe', 'on'=>'search'),
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
                'ml_id' => 'Ml',
                'ml_name' => '级别名称',
                'ml_redboards' => '需要红牌数',
                'ml_albumnum' => '创建相册数',
                'ml_dayboardnum' => '每日可打牌数',
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

        $criteria->compare('ml_id',$this->ml_id);

        $criteria->compare('ml_name',$this->ml_name,true);

        $criteria->compare('ml_redboards',$this->ml_redboards);

        return new CActiveDataProvider(get_class($this), array(
                        'criteria'=>$criteria,
        ));
    }
    /**
     * 获取级别
     * @param <type> $userId 用户ID
     * @return <type>
     */
    public function getUserLevelName($userId) {
        $return = "";
        $member = Member::model()->findByAttributes(array("mem_userid"=>$userId));
        if(!$member) {
            return $return;
        }
        $allLevel = $this->getAllLevle();
        foreach($allLevel as $value) {
            if($value->ml_redboards<=$member->mem_redboard) {
                $return = $value->ml_name;
            }
        }
        return $return;
    }
    /**
     * 获取用户级别的model
     */
    public function getUserLevelModel($memberModel){
        $return  = array();
        $allLevel = $this->getAllLevle();
        foreach($allLevel as $value) {
            if($value->ml_redboards<=$memberModel->mem_redboard) {
                $return = $value;
            }
        }
        return $return;
    }
    /**
     * 返回所有级别
     */
    public function getAllLevle($fomart = false) {
        $criteria=new CDbCriteria;
        $criteria->order = "ml_redboards";
        $allLevel = $this->findAll($criteria);
        if($fomart){
            $allLevel = $this->fomartToArray($allLevel);
        }
        return $allLevel;
    }
    private function fomartToArray($all){
        $return = array();
        foreach($all as $value){
            $return[$value->ml_id] = $value->ml_name;
        }
        return $return;
    }
}