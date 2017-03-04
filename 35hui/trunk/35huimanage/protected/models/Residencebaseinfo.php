<?php

/**
 * This is the model class for table "{{residencebaseinfo}}".
 *
 * The followings are the available columns in table '{{residencebaseinfo}}':
 * @property integer $rbi_id
 * @property integer $rbi_communityid
 * @property integer $rbi_uid
 * @property integer $rbi_rentorsell
 * @property double $rbi_area
 * @property integer $rbi_room
 * @property integer $rbi_office
 * @property integer $rbi_bathroom
 * @property integer $rbi_floor
 * @property integer $rbi_allfloor
 * @property integer $rbi_buildingera
 * @property integer $rbi_toward
 * @property string $rbi_decoration
 * @property string $rbi_number
 * @property string $rbi_title
 * @property string $rbi_residencedesc
 * @property integer $rbi_releasedate
 * @property integer $rbi_updatedate
 * @property integer $rbi_titlepicurl
 * @property integer $rr_validdate
 */
class Residencebaseinfo extends CActiveRecord
{
        public static $rbi_adrondegree = array(
        1 => '毛坯',
        2 => '简单装修',
        3 => '精装修',
        4 => '豪华装修',
    );
    /**
     *朝向
     */
    public static $rbi_towards = array(
        1 => '东',
        2 => '南',
        3 => '西',
        4 => '北',
        5 => '东南',
        6 => '西南',
        7 => '西北',
        8 => '东北',
        9 => '南北',
        10 => '东西',
    );
    /**
     * 租售类型
     */
    public static $rbi_sellorrent = array(
        "1"=>"出租",
        "2"=>"出售",
    );
     /**
     * 图片类型
     */
     public static $pictureNorm = array(
        1 => array(
            'suffix'=>'_large',
            'width'=>'546',
            'height'=>'364',
        ),
        2 => array(
            'suffix'=>'_normal',
            'width'=>'300',
            'height'=>'200',
        ),
        3 => array(
            'suffix'=>'_small',
            'width'=>'150',
            'height'=>'100',
        ),
        4 => array(
            'suffix'=>'_thumb',
            'width'=>'100',
            'height'=>'75',
        ),
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Residencebaseinfo the static model class
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
		return '{{residencebaseinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rbi_communityid, rbi_uid, rbi_rentorsell, rbi_area, rbi_room, rbi_office, rbi_bathroom, rbi_floor, rbi_allfloor, rbi_toward, rbi_decoration, rbi_title, rbi_releasedate, rbi_updatedate, rr_validdate', 'required'),
			array('rbi_communityid, rbi_uid, rbi_rentorsell, rbi_room, rbi_office, rbi_bathroom, rbi_floor, rbi_allfloor, rbi_buildingera, rbi_toward, rbi_releasedate, rbi_updatedate, rbi_titlepicurl, rr_validdate', 'numerical', 'integerOnly'=>true),
			array('rbi_area', 'numerical'),
			array('rbi_decoration', 'length', 'max'=>10),
			array('rbi_number, rbi_title', 'length', 'max'=>200,'encoding'=>'UTF-8'),
			array('rbi_residencedesc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rbi_id, rbi_communityid, rbi_uid, rbi_rentorsell, rbi_area, rbi_room, rbi_office, rbi_bathroom, rbi_floor, rbi_allfloor, rbi_buildingera, rbi_toward, rbi_decoration, rbi_number, rbi_title, rbi_residencedesc, rbi_releasedate, rbi_updatedate, rbi_titlepicurl, rr_validdate', 'safe', 'on'=>'search'),
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
            'rentInfo'=>array(self::HAS_ONE,'Shoprentinfo','sr_shopid'),
            'sellInfo'=>array(self::HAS_ONE,'Shopsellinfo','ss_shopid'),
            'user'=>array(self::BELONGS_TO,'User','rbi_uid'),
            'xiaoqu'=>array(self::BELONGS_TO,'Communitybaseinfo','rbi_communityid'),
            'tag'=>array(self::HAS_ONE,'Residencetag','rt_rbiid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rbi_id' => 'Rbi',
			'rbi_communityid' => '小区id',
			'rbi_uid' => '用户id',
			'rbi_rentorsell' => '租或售',
			'rbi_area' => '面积',
			'rbi_room' => '卧室数',
			'rbi_office' => '厅数',
			'rbi_bathroom' => '卫生间数',
			'rbi_floor' => '所在楼层',
			'rbi_allfloor' => '总楼层',
			'rbi_buildingera' => '建筑年代',
			'rbi_toward' => '朝向',
			'rbi_decoration' => '装修情况',
			'rbi_number' => '内部编号',
			'rbi_title' => '标题',
			'rbi_residencedesc' => '描述',
			'rbi_releasedate' => '发布时间',
			'rbi_updatedate' => '更新时间',
            'rbi_order' =>'排序字段',
            'rbi_visit' => '访问数',
			'rbi_titlepicurl' => '标题图',
			'rr_validdate' => '有效期',
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

		$criteria->compare('rbi_id',$this->rbi_id);

		$criteria->compare('rbi_communityid',$this->rbi_communityid);

		$criteria->compare('rbi_uid',$this->rbi_uid);

		$criteria->compare('rbi_rentorsell',$this->rbi_rentorsell);

		$criteria->compare('rbi_area',$this->rbi_area);

		$criteria->compare('rbi_room',$this->rbi_room);

		$criteria->compare('rbi_office',$this->rbi_office);

		$criteria->compare('rbi_bathroom',$this->rbi_bathroom);

		$criteria->compare('rbi_floor',$this->rbi_floor);

		$criteria->compare('rbi_allfloor',$this->rbi_allfloor);

		$criteria->compare('rbi_buildingera',$this->rbi_buildingera);

		$criteria->compare('rbi_toward',$this->rbi_toward);

		$criteria->compare('rbi_decoration',$this->rbi_decoration,true);

		$criteria->compare('rbi_number',$this->rbi_number,true);

		$criteria->compare('rbi_title',$this->rbi_title,true);

		$criteria->compare('rbi_residencedesc',$this->rbi_residencedesc,true);

		$criteria->compare('rbi_releasedate',$this->rbi_releasedate);

		$criteria->compare('rbi_updatedate',$this->rbi_updatedate);

		$criteria->compare('rbi_titlepicurl',$this->rbi_titlepicurl);

		$criteria->compare('rr_validdate',$this->rr_validdate);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}