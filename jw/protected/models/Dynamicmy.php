<?php

/**
 * This is the model class for table "{{dynamicmy}}".
 *
 * The followings are the available columns in table '{{dynamicmy}}':
 * @property integer $dm_id
 * @property integer $dm_userid
 * @property integer $dm_type
 * @property integer $dm_objectid
 * @property integer $dm_replyid
 * @property integer $dm_fromid
 * @property integer $dm_createtime
 */
class Dynamicmy extends CActiveRecord {
    /**
     * 类型
     * @var <type>
     */
    public static $dm_type = array(
            "1"=>"说说",//dm_objectid对应jw_userspeak表。dm_replyid对应jw_userspeakcomment表
            "2"=>"相册",//dm_objectid对应jw_album表。dm_replyid对应jw_albumcomment表
            "3"=>"专业会员打牌",//dm_objectid对应jw_userboard表。dm_replyid对应打牌的类型 Userboard::$ub_boardtype
            "4"=>"收到道具",//dm_objectid对应jw_propcenter表。dm_replyid对应jw_propbuylog表
            "5"=>"收到礼物",//dm_objectid对应jw_giftcenter表。dm_replyid对应jw_giftbuylog表
    );
    /**
     * Returns the static model of the specified AR class.
     * @return Dynamicmy the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{dynamicmy}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                array('dm_userid, dm_type, dm_objectid, dm_fromid, dm_createtime', 'required'),
                array('dm_userid, dm_type, dm_objectid, dm_replyid, dm_fromid, dm_createtime', 'numerical', 'integerOnly'=>true),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('dm_id, dm_userid, dm_type, dm_objectid, dm_replyid, dm_fromid, dm_createtime', 'safe', 'on'=>'search'),
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
                'dm_id' => 'Dm',
                'dm_userid' => '接收者id',
                'dm_type' => '类型',
                'dm_objectid' => '类型所对应的表id',
                'dm_replyid' => '回复id',
                'dm_fromid' => '所属用户id',
                'dm_createtime' => '创建时间',
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

        $criteria->compare('dm_id',$this->dm_id);

        $criteria->compare('dm_userid',$this->dm_userid);

        $criteria->compare('dm_type',$this->dm_type);

        $criteria->compare('dm_objectid',$this->dm_objectid);

        $criteria->compare('dm_replyid',$this->dm_replyid);

        $criteria->compare('dm_fromid',$this->dm_fromid);

        $criteria->compare('dm_createtime',$this->dm_createtime);

        return new CActiveDataProvider(get_class($this), array(
                        'criteria'=>$criteria,
        ));
    }
    /**
     * 由于dm_userid、dm_type与dm_objectid、dm_replyid 唯一 通过本方法获取model (必须唯一)
     * @param <type> $type 类型 参考 Dynamicmy::$dm_type注释
     * @param <type> $objectid 参考 Dynamicmy::$dm_type注释
     * @return <type>
     */
    private function GetSaveModel($receiverId, $type,$objectid, $replyid) {
        $model = $this->findByAttributes(array(
                "dm_userid"=>$receiverId,
                "dm_type"=>$type,
                "dm_objectid"=>$objectid,
                "dm_replyid"=>$replyid,
        ));
        if(!$model) {
            $model = new Dynamicmy();
            $model->dm_userid = $receiverId;
            $model->dm_type = $type;
            $model->dm_objectid = $objectid;
            $model->dm_replyid = $replyid;
        }
        return $model;
    }
    /**
     * 增加我空间的动态
     * @param <array> $receiverIdArr 接收者
     * @param <type> $type 类型 参考 Dynamicmy::$dm_type注释
     * @param <type> $objectid 参考 Dynamicmy::$dm_type注释
     * @param <type> $replyid 参考 Dynamicmy::$dm_type注释
     * @return <type>
     */
    public function addDynamicmy($receiverIdArr, $type, $objectid, $replyId) {
        $userId = User::model()->getId();
        foreach($receiverIdArr as $receiverId) {
            $model = $this->GetSaveModel($receiverId, $type, $objectid, $replyId);
            $model->dm_fromid = $userId;
            $model->dm_createtime = time();
            $model->save();
        }
        return true;
    }
}