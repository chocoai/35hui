<?php

class Officecomment extends CActiveRecord {
    /**
     * The followings are the available columns in table '{{officecomment}}':
     * @var integer $oc_id
     * @var integer $oc_cid
     * @var integer $oc_officeid
     * @var string $oc_traffice
     * @var string $oc_facility
     * @var string $oc_adorn
     * @var string $oc_comment
     * @var string $oc_comdate
     */

    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{officecomment}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('oc_cid, oc_officeid, oc_traffice, oc_facility, oc_adorn, oc_comment, oc_comdate', 'required'),
            array('oc_comment', 'length', 'max'=>200),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'oc_office' => array(self::BELONGS_TO, 'Officebaseinfo', 'oc_officeid'),
            'oc_c' => array(self::BELONGS_TO, 'User', 'oc_cid'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'oc_id' => 'Oc',
            'oc_cid' => 'Oc Cid',
            'oc_officeid' => 'Oc Officeid',
            'oc_traffice' => '交通情况',
            'oc_facility' => '设施情况',
            'oc_adorn' => '装修情况',
            'oc_comment' => '评论',
            'oc_comdate' => '发布日期',
        );
    }
    /**
     * 获取评论总数
     * @param <int> $id
     * @return <type>
     */
    public function getCommentcount($id) {
        return Officecomment::model()->count('oc_officeid='.$id);
    }

    /**
     * 获取所有的评论内容
     * @param <int> $id
     * @return <type>
     */
    public function getAllcomments($id) {
        $criteria=new CDbCriteria(array(
                'order'=>'oc_comdate DESC',
        ));
        return $this->findAllByAttributes(array('oc_officeid'=>$id),$criteria);
    }

    //得到商务中心房源的综合评价分值
    public function getMark() {
        return (int)(($this->oc_traffice + $this->oc_facility + $this->oc_adorn) / 3);
    }

}