<?php

/**
 * This is the model class for table "{{membercomment}}".
 *
 * The followings are the available columns in table '{{membercomment}}':
 * @property integer $mc_id
 * @property integer $mc_userid
 * @property integer $mc_fromuserid
 * @property string $mc_content
 * @property integer $mc_createtime
 */
class Membercomment extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     * @return Membercomment the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{membercomment}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                array('mc_userid, mc_fromuserid, mc_content, mc_createtime', 'required'),
                array('mc_userid, mc_fromuserid, mc_createtime', 'numerical', 'integerOnly'=>true),
                array('mc_content', 'length', 'max'=>900),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('mc_id, mc_userid, mc_fromuserid, mc_content, mc_createtime', 'safe', 'on'=>'search'),
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
                'mc_id' => 'Mc',
                'mc_userid' => 'Mc Userid',
                'mc_fromuserid' => 'Mc Fromuserid',
                'mc_content' => 'Mc Content',
                'mc_createtime' => 'Mc Createtime',
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

        $criteria->compare('mc_id',$this->mc_id);

        $criteria->compare('mc_userid',$this->mc_userid);

        $criteria->compare('mc_fromuserid',$this->mc_fromuserid);

        $criteria->compare('mc_content',$this->mc_content,true);

        $criteria->compare('mc_createtime',$this->mc_createtime);

        return new CActiveDataProvider(get_class($this), array(
                        'criteria'=>$criteria,
        ));
    }
    public function getMemberCommentDataProvider($userId) {
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array ("mc_userid"=>$userId));
        $criteria->order = "mc_supportnum desc,mc_createtime";
        return new CActiveDataProvider(get_class($this), array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>20,
                        ),
                
        ));
    }
}