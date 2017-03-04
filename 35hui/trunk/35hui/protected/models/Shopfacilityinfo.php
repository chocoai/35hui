<?php

/**
 * This is the model class for table "{{shopfacilityinfo}}".
 *
 * The followings are the available columns in table '{{shopfacilityinfo}}':
 * @property integer $sf_id
 * @property integer $sf_shopid
 * @property integer $sf_carparking
 * @property integer $sf_warming
 * @property integer $sf_network
 * @property integer $sf_elecwater
 * @property integer $sf_elevator
 * @property integer $sf_lift
 * @property integer $sf_gas
 * @property integer $sf_aircondition
 * @property integer $sf_tv
 * @property integer $sf_door
 */
class Shopfacilityinfo extends CActiveRecord
{
     public static $facilitiy = array(
            'sf_carparking'=>'停车位',
            'sf_warming'=>'暖气',
            'sf_network'=>'网络',
            'sf_elecwater'=>'水电',
            'sf_elevator'=>'货梯',
            'sf_lift'=>'电梯',
            'sf_gas'=>'天然气',
            'sf_aircondition'=>'空调',
            'sf_tv'=>'电视',
            'sf_door'=>'防盗门',
        );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Shopfacilityinfo the static model class
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
		return '{{shopfacilityinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sf_shopid, sf_carparking, sf_warming, sf_network, sf_elecwater, sf_elevator, sf_lift, sf_gas, sf_aircondition, sf_tv, sf_door', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sf_id, sf_shopid, sf_carparking, sf_warming, sf_network, sf_elecwater, sf_elevator, sf_lift, sf_gas, sf_aircondition, sf_tv, sf_door', 'safe', 'on'=>'search'),
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
			'sf_id' => 'Sf',
			'sf_shopid' => 'Sf Shopid',
			'sf_carparking' => 'Sf Carparking',
			'sf_warming' => 'Sf Warming',
			'sf_network' => 'Sf Network',
			'sf_elecwater' => 'Sf Elecwater',
			'sf_elevator' => 'Sf Elevator',
			'sf_lift' => 'Sf Lift',
			'sf_gas' => 'Sf Gas',
			'sf_aircondition' => 'Sf Aircondition',
			'sf_tv' => 'Sf Tv',
			'sf_door' => 'Sf Door',
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

		$criteria->compare('sf_id',$this->sf_id);

		$criteria->compare('sf_shopid',$this->sf_shopid);

		$criteria->compare('sf_carparking',$this->sf_carparking);

		$criteria->compare('sf_warming',$this->sf_warming);

		$criteria->compare('sf_network',$this->sf_network);

		$criteria->compare('sf_elecwater',$this->sf_elecwater);

		$criteria->compare('sf_elevator',$this->sf_elevator);

		$criteria->compare('sf_lift',$this->sf_lift);

		$criteria->compare('sf_gas',$this->sf_gas);

		$criteria->compare('sf_aircondition',$this->sf_aircondition);

		$criteria->compare('sf_tv',$this->sf_tv);

		$criteria->compare('sf_door',$this->sf_door);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 根据房源id得到所有的设备展示信息
     * @param <int> $officeId 房源id
     * @return <array>
     */
    public function getAllFacilityShow($shopId){
        $allFacility = array();
        $model = $this->findByAttributes(array('sf_shopid'=>$shopId));
        if($model){
            foreach(self::$facilitiy as $key=>$fa){
                if($model[$key]==1){
                    array_push($allFacility,self::$facilitiy[$key]);
                }
            }
        }
        return $allFacility;
    }
}