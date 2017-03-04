<?php

class Tagrelation extends CActiveRecord {
    /**
     * The followings are the available columns in table '{{tagrelation}}':
     * @var integer $Id
     * @var integer $tr_tagid
     * @var integer $tr_subid
     * @var integer $tr_type
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
        return '{{tagrelation}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tr_tagid, tr_subid, tr_type', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('Id, tr_tagid, tr_subid, tr_type', 'safe', 'on'=>'search'),
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
            'Id' => 'Id',
            'tr_tagid' => 'Tr Tagid',
            'tr_subid' => 'Tr Subid',
            'tr_type' => 'Tr Type',
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

        $criteria->compare('Id',$this->Id);

        $criteria->compare('tr_tagid',$this->tr_tagid);

        $criteria->compare('tr_subid',$this->tr_subid);

        $criteria->compare('tr_type',$this->tr_type);

        return new CActiveDataProvider('Tagrelation', array(
                'criteria'=>$criteria,
        ));
    }

    /**
     * 根据标签类型和标签ID获取房源id
     * @param <int> $tagid
     * @param <int> $type
     * @return <array>
     */
    public function getSourceidByTagidandType($tagid,$type) {
        $criteria=new CDbCriteria;
        $tags = Tagrelation::model()->findAllByAttributes(array('tr_tagid'=>$tagid,'tr_type'=>$type),$criteria);
        $t = array();
        foreach($tags as $tag) {
            $t[] =  $tag->tr_sourceid.' ';
        }
        return $t;
    }

    /**
     * 获取所有的标签ID
     * @return <array>
     */
    public  function getAllTagId() {
        $criteria=new CDbCriteria;
        $tags = Tagrelation::model()->findAll($criteria);
        $arr = array();
        foreach($tags as $tag) {
            $arr[] =  $tag->tr_tagid.' ';
        }
        return $arr;
    }
    
}