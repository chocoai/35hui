<?php

/**
 * This is the model class for table "{{userspeakcomment}}".
 *
 * The followings are the available columns in table '{{userspeakcomment}}':
 * @property integer $usc_id
 * @property integer $usc_userid
 * @property integer $usc_usid
 * @property string $usc_content
 * @property integer $usc_createtime
 * @property integer $usc_replyuscid
 */
class Userspeakcomment extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     * @return Userspeakcomment the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{userspeakcomment}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                array('usc_userid, usc_usid, usc_content, usc_createtime', 'required'),
                array('usc_userid, usc_usid, usc_createtime, usc_replyuscid', 'numerical', 'integerOnly'=>true),
                array('usc_content', 'length', 'max'=>900),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('usc_id, usc_userid, usc_usid, usc_content, usc_createtime, usc_replyuscid', 'safe', 'on'=>'search'),
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
                'usc_id' => 'Usc',
                'usc_userid' => 'Usc Userid',
                'usc_usid' => 'Usc Usid',
                'usc_content' => 'Usc Content',
                'usc_createtime' => 'Usc Createtime',
                'usc_replyuscid' => 'Usc Replyuscid',
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

        $criteria->compare('usc_id',$this->usc_id);

        $criteria->compare('usc_userid',$this->usc_userid);

        $criteria->compare('usc_usid',$this->usc_usid);

        $criteria->compare('usc_content',$this->usc_content,true);

        $criteria->compare('usc_createtime',$this->usc_createtime);

        $criteria->compare('usc_replyuscid',$this->usc_replyuscid);

        return new CActiveDataProvider(get_class($this), array(
                        'criteria'=>$criteria,
        ));
    }
    /**
     * 通过说说id，获取所有的评论（不是回复别人评论的）
     * @param <int> $usId 说说id
     * @return <type>
     */
    public function getAllCommentByUsid($usId) {
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("usc_usid"=>$usId));
        $criteria->addCondition("usc_replyuscid='0'");
        $criteria->order = "usc_createtime";
        return $this->findAll($criteria);
    }
    /**
     * 获取一条评论，如果是回复，则会返回第一条评论
     * @param <type> $uscId 评论id
     * @return <type>
     */
    public function getOneComment($uscId) {
        $model = $this->findByPk($uscId);
        if($model&&$model->usc_replyuscid!=0) {
            $parentModel = $this->findByPk($model->usc_replyuscid);
            $model = $parentModel;
        }
        return $model;
    }
    /**
     * 获取说说的回复
     * @param <type> $uscId 评论id
     * @return <type>
     */
    public function getHuifu($uscId) {
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("usc_replyuscid"=>$uscId));
        $criteria->order = "usc_createtime";
        return $this->findAll($criteria);
    }
    /**
     * 增加评论(回复) 包含个人动态的添加
     * @param <type> $usId 说说ID
     * @param <type> $replyID 回复者ID 0表示没有回复 其他为jw_userspeakcomment表ID。其中对应的usc_replyuscid必须为0
     * @param <type> $content 评论内容
     */
    public function addComment($usId, $replyID, $content) {
        $model = new Userspeakcomment();
        $model->usc_userid = User::model()->getId();
        $model->usc_usid = $usId;
        $model->usc_replyuscid = $replyID;
        $model->usc_createtime = time();
        $model->usc_content = $content;
        if($model->save()) {
            $usModel = Userspeak::model()->findByPk($model->usc_usid);
            if($model->usc_replyuscid==0) {//等与0，则要增加说说本身的评论数目
                $usModel->us_replynum = $usModel->us_replynum+1;
                $usModel->update();
            }
            //获取说说回复者ids
            $receiverIdArr = $this->getDynamicmySaveUserid($usModel, $model);
            //只能回复第一次评论的那条
            $replyID = $replyID==0?$model->usc_id:$replyID;
            //增加回复动态
            Dynamicmy::model()->addDynamicmy($receiverIdArr, 1, $usModel->us_id, $replyID);
            return true;
        }
        return false;
    }
    /**
     * 返回哪些人接收本条动态
     * @param <type> $usModel 说说model
     * @param <type> $model 当前保存的评论model
     * @return <array>
     */
    private function getDynamicmySaveUserid($usModel, $model) {
        if($model->usc_replyuscid!=0){
            $model = $this->findByPk($model->usc_replyuscid);
        }
        $userId = User::model()->getId();
        $return = array();
        if($userId==$model->usc_userid||$userId==$usModel->us_userid){
            $return[] = $userId==$model->usc_userid?$usModel->us_userid:$model->usc_userid;
        }else{
            $return[] = $model->usc_userid;
            $return[] = $usModel->us_userid;
        }
        return $return;
    }
}