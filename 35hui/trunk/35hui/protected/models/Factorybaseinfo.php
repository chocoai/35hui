<?php

class Factorybaseinfo extends CActiveRecord
{
	/**
	 * The followings are the available columns in table '{{factorybaseinfo}}':
	 * @var integer $fb_factoryid
	 * @var integer $fb_uid
	 * @var integer $fb_province
	 * @var integer $fb_city
	 * @var string $fb_factoryname
	 * @var integer $fb_district
	 * @var integer $fb_section
	 * @var integer $fb_loop
	 * @var integer $fb_tradecircle
	 * @var string $fb_busway
	 * @var integer $fb_propertyinfo
	 * @var double $fb_buildingarea
	 * @var double $fb_coverarea
	 * @var double $fb_sparearea
	 * @var string $fb_buildingage
	 * @var double $fb_plotratio
	 * @var double $fb_greenratio
	 * @var integer $fb_suittrade
	 * @var integer $fb_factorytype
	 * @var integer $fb_floor
	 * @var integer $fb_structure
	 * @var double $fb_crane
	 * @var double $fb_loadbearing
	 * @var double $fb_elecpower
	 * @var double $fb_water
	 * @var integer $fb_adrondegree
	 * @var string $fb_communication
	 * @var string $fb_facilityaround
	 * @var string $fb_facilityindoor
	 * @var integer $fb_sellorrent
	 * @var integer $fb_releasedate
	 * @var integer $fb_expiredate
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
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
		return '{{factorybaseinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fb_uid, fb_province, fb_city, fb_factoryname, fb_district, fb_section, fb_propertyinfo, fb_buildingarea, fb_suittrade, fb_factorytype, fb_sellorrent, fb_releasedate', 'required'),
			array('fb_uid, fb_province, fb_city, fb_district, fb_section, fb_loop, fb_tradecircle, fb_propertyinfo, fb_suittrade, fb_factorytype, fb_floor, fb_structure, fb_adrondegree, fb_sellorrent, fb_releasedate, fb_expiredate', 'numerical', 'integerOnly'=>true),
			array('fb_buildingarea, fb_coverarea, fb_sparearea, fb_plotratio, fb_greenratio, fb_crane, fb_loadbearing, fb_elecpower, fb_water', 'numerical'),
			array('fb_factoryname, fb_communication', 'length', 'max'=>50),
			array('fb_busway, fb_facilityaround, fb_facilityindoor', 'length', 'max'=>200),
			array('fb_buildingage', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fb_factoryid, fb_uid, fb_province, fb_city, fb_factoryname, fb_district, fb_section, fb_loop, fb_tradecircle, fb_busway, fb_propertyinfo, fb_buildingarea, fb_coverarea, fb_sparearea, fb_buildingage, fb_plotratio, fb_greenratio, fb_suittrade, fb_factorytype, fb_floor, fb_structure, fb_crane, fb_loadbearing, fb_elecpower, fb_water, fb_adrondegree, fb_communication, fb_facilityaround, fb_facilityindoor, fb_sellorrent, fb_releasedate, fb_expiredate', 'safe', 'on'=>'search'),
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
			'fb_factoryid' => 'Fb Factoryid',
			'fb_uid' => 'Fb Uid',
			'fb_province' => 'Fb Province',
			'fb_city' => 'Fb City',
			'fb_factoryname' => 'Fb Factoryname',
			'fb_district' => 'Fb District',
			'fb_section' => 'Fb Section',
			'fb_loop' => 'Fb Loop',
			'fb_tradecircle' => 'Fb Tradecircle',
			'fb_busway' => 'Fb Busway',
			'fb_propertyinfo' => 'Fb Propertyinfo',
			'fb_buildingarea' => 'Fb Buildingarea',
			'fb_coverarea' => 'Fb Coverarea',
			'fb_sparearea' => 'Fb Sparearea',
			'fb_buildingage' => 'Fb Buildingage',
			'fb_plotratio' => 'Fb Plotratio',
			'fb_greenratio' => 'Fb Greenratio',
			'fb_suittrade' => 'Fb Suittrade',
			'fb_factorytype' => 'Fb Factorytype',
			'fb_floor' => 'Fb Floor',
			'fb_structure' => 'Fb Structure',
			'fb_crane' => 'Fb Crane',
			'fb_loadbearing' => 'Fb Loadbearing',
			'fb_elecpower' => 'Fb Elecpower',
			'fb_water' => 'Fb Water',
			'fb_adrondegree' => 'Fb Adrondegree',
			'fb_communication' => 'Fb Communication',
			'fb_facilityaround' => 'Fb Facilityaround',
			'fb_facilityindoor' => 'Fb Facilityindoor',
			'fb_sellorrent' => 'Fb Sellorrent',
			'fb_releasedate' => 'Fb Releasedate',
			'fb_expiredate' => 'Fb Expiredate',
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

		$criteria->compare('fb_factoryid',$this->fb_factoryid);

		$criteria->compare('fb_uid',$this->fb_uid);

		$criteria->compare('fb_province',$this->fb_province);

		$criteria->compare('fb_city',$this->fb_city);

		$criteria->compare('fb_factoryname',$this->fb_factoryname,true);

		$criteria->compare('fb_district',$this->fb_district);

		$criteria->compare('fb_section',$this->fb_section);

		$criteria->compare('fb_loop',$this->fb_loop);

		$criteria->compare('fb_tradecircle',$this->fb_tradecircle);

		$criteria->compare('fb_busway',$this->fb_busway,true);

		$criteria->compare('fb_propertyinfo',$this->fb_propertyinfo);

		$criteria->compare('fb_buildingarea',$this->fb_buildingarea);

		$criteria->compare('fb_coverarea',$this->fb_coverarea);

		$criteria->compare('fb_sparearea',$this->fb_sparearea);

		$criteria->compare('fb_buildingage',$this->fb_buildingage,true);

		$criteria->compare('fb_plotratio',$this->fb_plotratio);

		$criteria->compare('fb_greenratio',$this->fb_greenratio);

		$criteria->compare('fb_suittrade',$this->fb_suittrade);

		$criteria->compare('fb_factorytype',$this->fb_factorytype);

		$criteria->compare('fb_floor',$this->fb_floor);

		$criteria->compare('fb_structure',$this->fb_structure);

		$criteria->compare('fb_crane',$this->fb_crane);

		$criteria->compare('fb_loadbearing',$this->fb_loadbearing);

		$criteria->compare('fb_elecpower',$this->fb_elecpower);

		$criteria->compare('fb_water',$this->fb_water);

		$criteria->compare('fb_adrondegree',$this->fb_adrondegree);

		$criteria->compare('fb_communication',$this->fb_communication,true);

		$criteria->compare('fb_facilityaround',$this->fb_facilityaround,true);

		$criteria->compare('fb_facilityindoor',$this->fb_facilityindoor,true);

		$criteria->compare('fb_sellorrent',$this->fb_sellorrent);

		$criteria->compare('fb_releasedate',$this->fb_releasedate);

		$criteria->compare('fb_expiredate',$this->fb_expiredate);

		return new CActiveDataProvider('Factorybaseinfo', array(
			'criteria'=>$criteria,
		));
	}
}