<?php

/**
 * This is the model class for table "{{advpop}}".
 *
 * The followings are the available columns in table '{{advpop}}':
 * @property integer $adp_id
 * @property integer $adp_position
 * @property string $adp_picurl
 * @property string $adp_linkurl
 * @property string $adp_title
 * @property integer $adp_uploadtime
 */
class Advpop extends CActiveRecord
{
    public static $advConfig = array(
        'normal'=>array(210,330),
        'more'=>array(200,150),
    );
    public static $positionConfig = array(//板块主页弹窗
        '1'=>'今日关注',
        '2'=>'写字楼',
        '3'=>'商铺',
        '4'=>'住宅',
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Advpop the static model class
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
		return '{{advpop}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('adp_position, adp_uploadtime', 'numerical', 'integerOnly'=>true),
			array('adp_linkurl', 'length', 'max'=>125),
            array('adp_picurl',
                'file',
                'types' => 'jpg,gif,jpeg',
                'maxSize' => 1048576*2, //2M max size
                'tooLarge' => '上传文件必须小于2M',
                'allowEmpty' => true
            ),
			array('adp_title', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('adp_id, adp_position, adp_ismore, adp_linkurl, adp_title, adp_uploadtime', 'safe', 'on'=>'search'),
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
			'adp_id' => 'Adp',
			'adp_position' => 'Adp Position',
			'adp_picurl' => 'Adp Picurl',
			'adp_linkurl' => 'Adp Linkurl',
			'adp_title' => 'Adp Title',
			'adp_uploadtime' => 'Adp Uploadtime',
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

		$criteria->compare('adp_id',$this->adp_id);

		$criteria->compare('adp_position',$this->adp_position);

		$criteria->compare('adp_picurl',$this->adp_picurl,true);

		$criteria->compare('adp_linkurl',$this->adp_linkurl,true);

		$criteria->compare('adp_title',$this->adp_title,true);

		$criteria->compare('adp_uploadtime',$this->adp_uploadtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}