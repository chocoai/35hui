<?php

/**
 * This is the model class for table "{{examchoice}}".
 *
 * The followings are the available columns in table '{{examchoice}}':
 * @property integer $ec_id
 * @property string $ec_question
 * @property string $ec_a
 * @property string $ec_b
 * @property string $ec_c
 * @property string $ec_d
 * @property integer $ec_answer
 * @property integer $ec_type
 * @property integer $ec_time
 */
class Examchoice extends CActiveRecord
{
    /**
     * 题目类型
     * @var <type>
     */
    public static $ec_type = array(
            '1'=>'房产知识',
            '2'=>'政策行情',
            '3'=>'熟悉楼盘',
            '4'=>'销售技巧',
            '5'=>'服务质量',
    );
    /**
     * Returns the static model of the specified AR class.
     * @return Examchoice the static model class
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
        return '{{examchoice}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                array('ec_question, ec_a, ec_b, ec_c, ec_d, ec_answer, ec_type, ec_time', 'required'),
                array('ec_answer, ec_type, ec_time', 'numerical', 'integerOnly'=>true),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('ec_id, ec_question, ec_a, ec_b, ec_c, ec_d, ec_answer, ec_type, ec_time', 'safe', 'on'=>'search'),
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
                'ec_id' => 'Ec',
                'ec_question' => 'Ec Question',
                'ec_a' => 'Ec A',
                'ec_b' => 'Ec B',
                'ec_c' => 'Ec C',
                'ec_d' => 'Ec D',
                'ec_answer' => 'Ec Answer',
                'ec_type' => 'Ec Type',
                'ec_time' => 'Ec Time',
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

        $criteria->compare('ec_id',$this->ec_id);

        $criteria->compare('ec_question',$this->ec_question,true);

        $criteria->compare('ec_a',$this->ec_a,true);

        $criteria->compare('ec_b',$this->ec_b,true);

        $criteria->compare('ec_c',$this->ec_c,true);

        $criteria->compare('ec_d',$this->ec_d,true);

        $criteria->compare('ec_answer',$this->ec_answer);

        $criteria->compare('ec_type',$this->ec_type);

        $criteria->compare('ec_time',$this->ec_time);

        return new CActiveDataProvider(get_class($this), array(
                        'criteria'=>$criteria,
        ));
    }
    /**
     * 随机排序选项
     * @param <type> $model
     * @return <type> array
     */
    public function RandomChoice($model){
        $arr = array(
                array("k"=>1,"v"=>$model->ec_a),
                array("k"=>2,"v"=>$model->ec_b),
                array("k"=>3,"v"=>$model->ec_c),
                array("k"=>4,"v"=>$model->ec_d)
        );
        $rearr = array();
        $index = "";
        while (count($arr)>0){
            $rand = rand(0, count($arr)-1);//随机数
            $rearr[] = $arr[$rand]["v"];
            $index .= $arr[$rand]["k"];
            array_splice($arr, $rand, 1);
        }
        return array($rearr,$index);
    }
}