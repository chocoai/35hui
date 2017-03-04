<?php
/**
 * This is the model class for table "{{msgsurvey}}".
 *
 * The followings are the available columns in table '{{msgsurvey}}':
 * @property integer $ms_id
 * @property string $ms_name
 * @property string $ms_email
 * @property integer $ms_status
 * @property integer $ms_time
 */
class Msgsurvey extends CActiveRecord
{
    public static $ms_status = array(
        0=>'未处理',
        1=>'已处理',
    );
    /**
     * Returns the static model of the specified AR class.
     * @return Msgsurvey the static model class
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
        return '{{msgsurvey}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ms_name, ms_email, ms_time', 'required'),
            array('ms_status, ms_time', 'numerical', 'integerOnly'=>true),
            array('ms_email', 'length', 'max'=>200),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ms_id, ms_name, ms_email, ms_status, ms_time', 'safe', 'on'=>'search'),
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
            'ms_id' => 'ID',
            'ms_name' => '全景名称',
            'ms_email' => '用户邮箱',
            'ms_status' => '状态',
            'ms_time' => '发布时间',
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

        $criteria->compare('ms_id',$this->ms_id);

        $criteria->compare('ms_name',$this->ms_name,true);

        $criteria->compare('ms_email',$this->ms_email,true);

        $criteria->compare('ms_status',$this->ms_status);

        $criteria->compare('ms_time',$this->ms_time);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }

    public function getStatus($intStatus) {
        $statusName = "";
        if(array_key_exists($intStatus, self::$ms_status)){
            $statusName = self::$ms_status[$intStatus];
        }
        return $statusName;
    }
} 
?>
