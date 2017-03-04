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
			'ed_type' => 'Ed Type',
			'ed_grade' => 'Ed Grade',
			'ed_describe' => 'Ed Describe',
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
		));
	}
    /**
     * 通过类型和分数，获取相应的等级描述
     * @param <int> $type 类型 1-5
     * @param <int> $point 分数 0-20
     * @return <string>
     */
    public function getDescribtionByPointAndType($type, $point){
        $grade = $point==0?1:ceil($point/4);
        $model = self::model()->findByAttributes(array("ed_type"=>$type,"ed_grade"=>$grade));
        $return = "";
        if($model){
            $return = $model->ed_describe;
        }
        return $return;
    }

}