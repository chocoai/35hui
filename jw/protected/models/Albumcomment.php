<?php

/**
 * This is the model class for table "{{albumcomment}}".
 *
 * The followings are the available columns in table '{{albumcomment}}':
 * @property integer $ac_id
 * @property integer $ac_userid
 * @property integer $ac_albumid
 * @property string $ac_content
 * @property integer $ac_createtime
 * @property integer $ac_replyuscid
 */
class Albumcomment extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     * @return Albumcomment the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{albumcomment}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                array('ac_userid, ac_albumid, ac_content, ac_createtime', 'required'),
                array('ac_userid, ac_albumid, ac_createtime, ac_replyuscid', 'numerical', 'integerOnly'=>true),
                array('ac_content', 'length', 'max'=>900),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('ac_id, ac_userid, ac_albumid, ac_content, ac_createtime, ac_replyuscid', 'safe', 'on'=>'search'),
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
                'ac_id' => 'Ac',
                'ac_userid' => 'Ac Userid',
                'ac_albumid' => 'Ac Albumid',
                'ac_content' => 'Ac Content',
                'ac_createtime' => 'Ac Createtime',
                'ac_replyuscid' => 'Ac Replyuscid',
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

        $criteria->compare('ac_id',$this->ac_id);

        $criteria->compare('ac_userid',$this->ac_userid);

        $criteria->compare('ac_albumid',$this->ac_albumid);

        $criteria->compare('ac_content',$this->ac_content,true);

        $criteria->compare('ac_createtime',$this->ac_createtime);

        $criteria->compare('ac_replyuscid',$this->ac_replyuscid);

        return new CActiveDataProvider(get_class($this), array(
                        'criteria'=>$criteria,
        ));
    }
    /**
     * 通过相册id，获取所有的评论（不是回复别人评论的）
     * @param <int> $albumId 相册id
     * @return <type>
     */
    public function getAllCommentByUsid($albumId) {
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("ac_albumid"=>$albumId));
        $criteria->addCondition("ac_replyuscid='0'");
        $criteria->order = "ac_createtime";
        return $this->findAll($criteria);
    }
    /**
     * 获取一条评论，如果是回复，则会返回第一条评论
     * @param <type> $acId 评论id
     * @return <type>
     */
    public function getOneComment($acId) {
        $model = $this->findByPk($acId);
        if($model&&$model->ac_replyuscid!=0) {
            $parentModel = $this->findByPk($model->ac_replyuscid);
            $model = $parentModel;
        }
        return $model;
    }
    /**
     * 获取相册的回复
     * @param <type> $albumId 评论id
     * @return <type>
     */
    public function getHuifu($acId) {
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("ac_replyuscid"=>$acId));
        $criteria->order = "ac_createtime";
        return $this->findAll($criteria);
    }
    /**
     * 增加评论(回复) 包含个人动态的添加
     * @param <type> $amId 相册ID
     * @param <type> $replyID 回复者ID 0表示没有回复 其他为jw_albumcomment表ID。其中对应的ac_replyuscid必须为0
     * @param <type> $content 评论内容
     */
    public function addComment($amId, $replyID, $content) {
        $model = new Albumcomment();
        $model->ac_userid = User::model()->getId();
        $model->ac_albumid = $amId;
        $model->ac_replyuscid = $replyID;
        $model->ac_createtime = time();
        $model->ac_content = $content;
        if($model->save()) {
            $albumModel = Album::model()->findByPk($model->ac_albumid);
            if($model->ac_replyuscid==0) {//等与0，则要增加相册本身的评论数目
                $albumModel->am_replynum = $albumModel->am_replynum+1;
                $albumModel->update();
            }
            //获取说说回复者ids
            $receiverIdArr = $this->getDynamicmySaveUserid($albumModel, $model);
            //只能回复第一次评论的那条
            $replyID = $replyID==0?$model->ac_id:$replyID;
            //增加回复动态
            Dynamicmy::model()->addDynamicmy($receiverIdArr, 2, $albumModel->am_id, $replyID);
            return true;
        }
        return false;
    }
    /**
     * 返回哪些人接收本条动态
     * @param <type> $albumModel 相册model
     * @param <type> $model 当前保存的评论model
     * @return <array>
     */
    private function getDynamicmySaveUserid($albumModel, $model) {
        if($model->ac_replyuscid!=0){
            $model = $this->findByPk($model->ac_replyuscid);
        }
        $userId = User::model()->getId();
        $return = array();
        if($userId==$model->ac_userid||$userId==$albumModel->am_userid){
            $return[] = $userId==$model->ac_userid?$albumModel->am_userid:$model->ac_userid;
        }else{
            $return[] = $model->ac_userid;
            $return[] = $albumModel->am_userid;
        }
        return $return;
    }
}