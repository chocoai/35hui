<?php

/**
 * This is the model class for table "{{friendlink}}".
 *
 * The followings are the available columns in table '{{friendlink}}':
 * @property integer $fl_id
 * @property integer $fl_type
 * @property string $fl_value
 * @property string $fl_picurl
 * @property string $fl_url
 * @property integer $fl_order
 * @property integer $fl_createtime
 */
class Friendlink extends CActiveRecord
{
     /**
     * 图片类型
     */
    const PIC_TYPE = 6;
    /**
     * 类型
     * @var <type>
     */
    public static $fl_type = array(
        "1"=>"房地产",
        "2"=>"家居装潢",
        "3"=>"生活娱乐",
        "4"=>"电子商务",
        "5"=>"综合门户",
        "6"=>"图片链接",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Friendlink the static model class
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
		return '{{friendlink}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fl_value, fl_url, fl_createtime', 'required'),
			array('fl_type, fl_order, fl_createtime', 'numerical', 'integerOnly'=>true),
			array('fl_value, fl_picurl', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fl_id, fl_type, fl_value, fl_picurl, fl_url, fl_order, fl_createtime', 'safe', 'on'=>'search'),
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
            'fl_id' => 'Fl',
			'fl_type' => '类型',
			'fl_value' => '公司名称',
            'fl_picurl' => '公司logo 90px*30px',
			'fl_url' => '链接地址',
			'fl_order' => '排序',
			'fl_createtime' => '创建时间',
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

		$criteria->compare('fl_id',$this->fl_id);

		$criteria->compare('fl_type',$this->fl_type);

		$criteria->compare('fl_value',$this->fl_value,true);

		$criteria->compare('fl_picurl',$this->fl_picurl,true);

		$criteria->compare('fl_url',$this->fl_url,true);

		$criteria->compare('fl_order',$this->fl_order);

		$criteria->compare('fl_createtime',$this->fl_createtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 返回所有的友情链接
     * @param <type> $type 类型
     * @return <type>
     */
    public function getAllFriendLink($type=0){
        $criteria=new CDbCriteria;
        $criteria->order = "fl_order";
        $criteria->limit = "60";
        $criteria->addColumnCondition(array("fl_type"=>$type));
        $model = Friendlink::model()->findAll($criteria);
        return $model;
    }
}
    