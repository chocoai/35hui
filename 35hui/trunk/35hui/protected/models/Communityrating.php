<?php

/**
 * This is the model class for table "{{communityrating}}".
 *
 * The followings are the available columns in table '{{communityrating}}':
 * @property integer $cr_id
 * @property integer $cr_uid
 * @property integer $cr_comyid
 * @property integer $cr_score
 * @property integer $cr_ratdate
 */
class Communityrating extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return Communityrating the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{communityrating}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cr_uid, cr_comyid', 'required'),
            array('cr_uid, cr_comyid, cr_score, cr_ratdate', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('cr_id, cr_uid, cr_comyid, cr_score, cr_ratdate', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'cr_id' => 'Cr',
            'cr_uid' => 'Cr Uid',
            'cr_comyid' => 'Cr Comyid',
            'cr_score' => 'Cr Score',
            'cr_ratdate' => 'Cr Ratdate',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('cr_id',$this->cr_id);

        $criteria->compare('cr_uid',$this->cr_uid);

        $criteria->compare('cr_comyid',$this->cr_comyid);

        $criteria->compare('cr_score',$this->cr_score);

        $criteria->compare('cr_ratdate',$this->cr_ratdate);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }

    public function checkRated($userId,$communityId)
    {
        $dba = dba();
        $countNum = $dba->select_one("select count(*) from 35_communityrating where cr_uid=? and cr_comyid =?",$userId,$communityId);
        if($countNum>0){
            return true;
        }else{
            return false;
        }
    }

    public function addRateLog($userId,$communityId,$score){
        $model = new Communityrating();
        $model->setAttribute("cr_uid",$userId);
        $model->setAttribute("cr_comyid",$communityId);
        $model->setAttribute("cr_score",$score);
        $model->setAttribute("cr_ratdate",time());
        return $model->save();
    }
}

