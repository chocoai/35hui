<?php

/**
 * This is the model class for table "{{advertisement}}".
 *
 * The followings are the available columns in table '{{advertisement}}':
 * @property integer $ad_id
 * @property integer $ad_position
 * @property string $ad_picurl
 * @property string $ad_linkurl
 * @property string $ad_alt
 * @property integer $ad_uploadtime
 */
class Advertisement extends CActiveRecord
{
    public static $advertiseConfig = array(
        1=>array(
            'description'=>'商铺首页 右侧第一个',
            'width'=>220,
            'height'=>200,
        ),
        2=>array(
            'description'=>'商铺首页 右侧第三个',
            'width'=>220,
            'height'=>200,
        ),
        3=>array(
            'description'=>'商铺首页 右侧第二个',
            'width'=>220,
            'height'=>200,
        ),
        4=>array(
            'description'=>'',
            'width'=>713,
            'height'=>118,
        ),
        5=>array(
            'description'=>'',
            'width'=>713,
            'height'=>118,
        ),
        6=>array(
            'description'=>'',
            'width'=>743,
            'height'=>102,
        ),
        7=>array(
            'description'=>'',
            'width'=>260,
            'height'=>100,
        ),
        8=>array(
            'description'=>'',
            'width'=>260,
            'height'=>100,
        ),
        9=>array(
            'description'=>'',
            'width'=>270,
            'height'=>100,
        ),
        10=>array(
            'description'=>'',
            'width'=>270,
            'height'=>100,
        ),
        11=>array(
            'description'=>'',
            'width'=>260,
            'height'=>100,
        ),
        12=>array(
            'description'=>'',
            'width'=>270,
            'height'=>100,
        ),
        13=>array(
            'description'=>'',
            'width'=>718,
            'height'=>100,
        ),
        14=>array(
            'description'=>'',
            'width'=>110,
            'height'=>50,
        ),
        15=>array(
            'description'=>'',
            'width'=>110,
            'height'=>50,
        ),
        16=>array(
            'description'=>'',
            'width'=>110,
            'height'=>50,
        ),
        17=>array(
            'description'=>'',
            'width'=>110,
            'height'=>50,
        ),
        18=>array(
            'description'=>'',
            'width'=>110,
            'height'=>50,
        ),
        19=>array(
            'description'=>'',
            'width'=>718,
            'height'=>100,
        ),
        20=>array(
            'description'=>'',
            'width'=>718,
            'height'=>100,
        ),
        21=>array(
            'description'=>'',
            'width'=>270,
            'height'=>100,
        ),
        22=>array(
            'description'=>'',
            'width'=>100,
            'height'=>100,
        ),
        23=>array(
            'description'=>'',
            'width'=>100,
            'height'=>100,
        ),
        24=>array(
            'description'=>'',
            'width'=>100,
            'height'=>100,
        ),
        25=>array(
            'description'=>'',
            'width'=>100,
            'height'=>100,
        ),
        26=>array(
            'description'=>'',
            'width'=>100,
            'height'=>100,
        ),
        27=>array(
            'description'=>'',
            'width'=>260,
            'height'=>96,
        ),
        28=>array(
            'description'=>'',
            'width'=>260,
            'height'=>268,
        ),
        29=>array(
            'description'=>'',
            'width'=>260,
            'height'=>105,
        ),
        30=>array(
            'description'=>'',
            'width'=>260,
            'height'=>105,
        ),

    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Advertisement the static model class
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
		return '{{advertisement}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ad_id, ad_position, ad_uploadtime', 'required'),
			array('ad_id, ad_position, ad_uploadtime', 'numerical', 'integerOnly'=>true),
            array('ad_picurl',
                'file',
                'types' => 'jpg,gif,jpeg',
                'maxSize' => 1024 * 1024, //1M max size
                'tooLarge' => '上传文件必须小于1M',
                'allowEmpty' => true
            ),
			array('ad_linkurl', 'length', 'max'=>100),
			array('ad_alt', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ad_id, ad_position, ad_picurl, ad_linkurl, ad_alt, ad_uploadtime', 'safe', 'on'=>'search'),
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
			'ad_id' => '主键',
			'ad_position' => '广告位置',
			'ad_picurl' => '广告图片',
			'ad_linkurl' => '广告链接地址',
			'ad_alt' => '广告提示',
			'ad_uploadtime' => '上传广告图片的时间',
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

		$criteria->compare('ad_id',$this->ad_id);

		$criteria->compare('ad_position',$this->ad_position);

		$criteria->compare('ad_picurl',$this->ad_picurl,true);

		$criteria->compare('ad_linkurl',$this->ad_linkurl,true);

		$criteria->compare('ad_alt',$this->ad_alt,true);

		$criteria->compare('ad_uploadtime',$this->ad_uploadtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}