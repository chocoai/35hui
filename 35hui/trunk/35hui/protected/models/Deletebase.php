<?php

/**
 * This is the model class for table "{{deletebase}}".
 *
 * The followings are the available columns in table '{{deletebase}}':
 * @property integer $id
 * @property integer $type
 * @property integer $buildid
 * @property integer $province
 * @property integer $city
 * @property integer $district
 * @property integer $section
 * @property integer $releasetime
 * @property integer $sellorrent
 * @property double $price
 * @property integer $year
 * @property integer $month
 * @property integer $ymd
 * @property integer $timestamp
 */
class Deletebase extends CActiveRecord
{
    /**
     * 类型 1写字楼 2
     * @var <type>
     */
    public static $type = array(
        1=>"写字楼",
        2=>"商铺",
        3=>"住宅",
        4=>"创意园区"
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Deletebase the static model class
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
		return '{{deletebase}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('type, buildid, province, city, district, section, releasetime, sellorrent, price, year, month, ymd, timestamp', 'required'),
			array('type, buildid, province, city, district, section, releasetime, sellorrent, year, month, ymd, timestamp', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
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
			'id' => 'ID',
			'type' => 'Type',
			'buildid' => 'Buildid',
			'province' => 'Province',
			'city' => 'City',
			'district' => 'District',
			'section' => 'Section',
			'releasetime' => 'Releasetime',
			'sellorrent' => 'Sellorrent',
			'price' => 'Price',
			'year' => 'Year',
			'month' => 'Month',
			'ymd' => 'Ymd',
			'timestamp' => 'Timestamp',
		);
	}

}