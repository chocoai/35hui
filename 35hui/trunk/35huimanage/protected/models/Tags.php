<?php

/**
 * This is the model class for table "{{tags}}".
 *
 * The followings are the available columns in table '{{tags}}':
 * @property integer $tag_id
 * @property string $tag_name
 * @property integer $tag_belong
 * @property integer $tag_frequency
 * @property integer $markettype
 */
class Tags extends CActiveRecord
{
   /**
     * 楼盘
     */
    const systemBuildings = 1;
    /**
     * 写字楼
     */
    const office = 2;
    const factory = 3;
    /**
     * 商铺
     */
    const shop = 4;
    const project = 5;
    /**
     * 商务中心
     */
    const business = 6;
    //商业广场
    const systemBuildingsShop=7;
    const rent = 0;//出租
    const sell = 1;//出售
    const all = 2;//不限

	
             /**
         *标签类型
         * @var <type>
         */
        public static $tag_belong = array(
            '1'=>'楼盘',
            '2'=>'写字楼' ,
            '3'=>'工业厂房',
            '4'=>'商铺' ,
            '5'=>'大型项目' ,
            '6'=>'商务中心',
            '7'=>'商业广场'
        );
        /**
         *房源类型
         * @var <type>
         */
        public static $markettype = array(
            '0'=>'租',
            '1'=>'售' ,
            '2'=>'不限',
        );
        /**
	 * Returns the static model of the specified AR class.
	 * @return Tags the static model class
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
		return '{{tags}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tag_name', 'required'),
			array('tag_belong, tag_frequency, markettype', 'numerical', 'integerOnly'=>true),
			array('tag_name', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('tag_id, tag_name, tag_belong, tag_frequency, markettype', 'safe', 'on'=>'search'),
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
			'tag_id' => 'Tag',
			'tag_name' => 'Tag Name',
			'tag_belong' => 'Tag Belong',
			'tag_frequency' => 'Tag Frequency',
			'markettype' => 'Markettype',
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

		$criteria->compare('tag_id',$this->tag_id);

		$criteria->compare('tag_name',$this->tag_name,true);

		$criteria->compare('tag_belong',$this->tag_belong);

		$criteria->compare('tag_frequency',$this->tag_frequency);

		$criteria->compare('markettype',$this->markettype);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    public function recently($limit=5)
    {
        $this->getDbCriteria()->mergeWith(array(
            'order'=>'tag_frequency DESC',
            'limit'=>$limit,
        ));
        return $this;
    }
	/**
     * 返回标签内容
     * @param <int> $type 类型
     * @return <type>
     */
	public function getTagsByType($type,$count=5)
	{
		return $this->recently($count)->findAllByAttributes(array('tag_belong'=>$type));
	}
    /**
     * 返回标签内容
     * @param <int> $type 类型
     * @param <int> $markettype租售类型 0租1售
     * @return <type>
     */
	public function getTagsByTypeAndMarke($type,$markettype,$count=5)
	{
		return $this->recently($count)->findAllByAttributes(array('tag_belong'=>$type,'markettype'=>$markettype));
	}
}