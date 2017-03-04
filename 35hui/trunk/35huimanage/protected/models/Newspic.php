<?php

/**
 * This is the model class for table "{{newspic}}".
 *
 * The followings are the available columns in table '{{newspic}}':
 * @property integer $np_id
 * @property string $np_title
 * @property string $np_picurl
 * @property string $np_linkurl
 * @property integer $np_type
 * @property integer $np_order
 */
class Newspic extends CActiveRecord
{
    /**
     * 首页写字楼政策
     */
    const newszc = 2;
    /**
     * 首页成交数据
     */
    const newscj = 3;
    /**
     * 首页调查报告
     */
    const newsdc = 4;
    /**
     * 首页研究报告
     */
    const newsyj = 5;
    public static $pictype = array(
        "1"=>"首页图片",
        "2"=>"首页写字楼政策",
        "3"=>"首页成交数据",
        "4"=>"首页调查报告",
        "5"=>"首页研究报告",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Newspic the static model class
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
		return '{{newspic}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('np_title,np_order, np_linkurl, np_type', 'required'),
			array('np_type, np_order', 'numerical', 'integerOnly'=>true),
			array('np_title', 'length', 'max'=>200),
			array('np_linkurl','url'),
            array('np_order',"numerical",'min'=>1,'max'=>999),
            array('np_picurl',
                'file',
                'types' => 'jpg,gif,jpeg',
                'maxSize' => 1024 * 1024, //1M max size
                'tooLarge' => '上传文件必须小于1M',
                'allowEmpty' => true
            ),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('np_id, np_title, np_picurl, np_linkurl, np_type, np_order', 'safe', 'on'=>'search'),
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
			'np_id' => 'Np',
			'np_title' => '标题',
			'np_picurl' => '图片',
			'np_linkurl' => '链接地址',
			'np_type' => '类型',
			'np_order' => '排序',
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

		$criteria->compare('np_id',$this->np_id);

		$criteria->compare('np_title',$this->np_title,true);

		$criteria->compare('np_picurl',$this->np_picurl,true);

		$criteria->compare('np_linkurl',$this->np_linkurl,true);

		$criteria->compare('np_type',1);//这个管理页面只查询为1的数据。

		$criteria->compare('np_order',$this->np_order);
        
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    public function getOnePicByType($type){
        return $this->findByAttributes(array('np_type'=>$type));
    }
}