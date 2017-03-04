<?php

/**
 * This is the model class for table "{{examdescribe}}".
 *
 * The followings are the available columns in table '{{examdescribe}}':
 * @property integer $ed_id
 * @property integer $ed_type
 * @property integer $ed_grade
 * @property string $ed_describe
 */
class Examdescribe extends CActiveRecord
{
    public static $ed_type = array(
            '1'=>'房产知识',
            '2'=>'政策行情',
            '3'=>'熟悉楼盘',
            '4'=>'销售技巧',
            '5'=>'服务质量',
    );
    /**
     * Returns the static model of the specified AR class.
     * @return Examdescribe the static model class
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
        return '{{examdescribe}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                array('ed_type, ed_grade', 'required'),
                array('ed_type, ed_grade', 'numerical', 'integerOnly'=>true),
                array('ed_describe', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('ed_id, ed_type, ed_grade, ed_describe', 'safe', 'on'=>'search'),
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
                'ed_id' => 'Ed',
                'ed_type' => '类型',
                'ed_grade' => '等级',
                'ed_describe' => '描述',
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

        $criteria->compare('ed_id',$this->ed_id);

        $criteria->compare('ed_type',$this->ed_type);

        $criteria->compare('ed_grade',$this->ed_grade);

        $criteria->compare('ed_describe',$this->ed_describe,true);

        return new CActiveDataProvider(get_class($this), array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>25,
                        ),
        ));
    }
    public function getPoint($grade){
        $min = $max = 0;
        $max = $grade*4;
        $min = $grade==1?0:($grade-1)*4+1;

        return "(".$min."-".$max."分)";
    }
}