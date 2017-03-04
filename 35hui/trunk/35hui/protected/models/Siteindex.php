<?php
/**
 * This is the model class for table "{{siteindex}}".
 *
 * The followings are the available columns in table '{{siteindex}}':
 * @property integer $si_id
 * @property integer $si_typeid
 * @property string $si_desc
 * @property string $si_advantages
 * @property string $si_inferior
 * @property string $si_link
 * @property integer $si_type
 * @property integer $si_time
 */
class Siteindex extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return Siteindex the static model class
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
        return '{{siteindex}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('si_typeid, si_desc, si_advantages, si_inferior, si_type, si_time', 'required'),
            array('si_typeid, si_type, si_time, si_num', 'numerical', 'integerOnly'=>true),
            array('si_link, si_img', 'length', 'max'=>200),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('si_id, si_typeid, si_desc, si_advantages, si_inferior, si_link, si_type, si_time, si_img, si_num', 'safe', 'on'=>'search'),
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
            'si_id' => 'Si',
            'si_typeid' => 'Si Typeid',
            'si_desc' => 'Si Desc',
            'si_advantages' => 'Si Advantages',
            'si_inferior' => 'Si Inferior',
            'si_link' => 'Si Link',
            'si_type' => 'Si Type',
            'si_time' => 'Si Time',
            'si_img' => 'Si Img',
            'si_num' => 'Si Num',
            'si_pricetype' => '价格类型',
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

        $criteria->compare('si_id',$this->si_id);

        $criteria->compare('si_typeid',$this->si_typeid);

        $criteria->compare('si_desc',$this->si_desc,true);

        $criteria->compare('si_advantages',$this->si_advantages,true);

        $criteria->compare('si_inferior',$this->si_inferior,true);

        $criteria->compare('si_link',$this->si_link,true);

        $criteria->compare('si_type',$this->si_type);

        $criteria->compare('si_time',$this->si_time);

        $criteria->compare('si_img',$this->si_img,true);

        $criteria->compare('si_num',$this->si_num);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }

    public function getTypeInfo($limit=10){
        $criteria = new CDbCriteria;
        $criteria->limit=$limit;
        $criteria->order= "si_type asc";
        return self::model()->findAll($criteria);
    }
}

?>
