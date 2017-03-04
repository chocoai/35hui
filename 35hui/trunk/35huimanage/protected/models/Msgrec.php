<?php

/**
 * This is the model class for table "{{msgrec}}".
 *
 * The followings are the available columns in table '{{msgrec}}':
 * @property integer $mr_id
 * @property integer $mr_sendid
 * @property string $mr_content
 * @property string $mr_replay
 * @property integer $mr_time
 * @property integer $mr_rtime
 * @property integer $mr_isread
 */
class Msgrec extends CActiveRecord
{
     public static $readstatu = array(
		'unread'=>0,
		'read'=>1,
	);
    /**
     * Returns the static model of the specified AR class.
     * @return Msgrec the static model class
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
        return '{{msgrec}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('mr_sendid, mr_content, mr_time', 'required'),
            array('mr_sendid, mr_time, mr_rtime, mr_isread', 'numerical', 'integerOnly'=>true),
            array('mr_replay,mr_content', 'length', 'max'=>4096),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('mr_id, mr_sendid, mr_content, mr_replay, mr_time, mr_rtime, mr_isread', 'safe', 'on'=>'search'),
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
            'mr_id' => '主键',
            'mr_sendid' => '发送者',
            'mr_content' => '建议（意见）',
            'mr_replay' => '答复内容',
            'mr_time' => '发表时间',
            'mr_rtime' => '答复时间',
            'mr_isread' => '是否读',
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

        $criteria->compare('mr_id',$this->mr_id);

        $criteria->compare('mr_sendid',$this->mr_sendid);

        $criteria->compare('mr_content',$this->mr_content,true);

        $criteria->compare('mr_replay',$this->mr_replay,true);

        $criteria->compare('mr_time',$this->mr_time);

        $criteria->compare('mr_rtime',$this->mr_rtime);

        $criteria->compare('mr_isread',$this->mr_isread);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }

} 