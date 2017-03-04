<?php

/**
 * This is the model class for table "{{buyproduct}}".
 *
 * The followings are the available columns in table '{{buyproduct}}':
 * @property integer $sp_id
 * @property integer $sp_positionid
 * @property integer $sp_sourceid
 * @property integer $sp_userid
 * @property integer $sp_buyprice
 * @property integer $sp_buydays
 * @property integer $sp_buytime
 * @property integer $sp_state
 * @property integer $sp_cannotusetime
 * @property integer $sp_returnprice
 */
class Buyproduct extends CActiveRecord
{
    public static $sp_state = array(
        "0"=>"可用",
        "1"=>"不可用",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Buyproduct the static model class
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
		return '{{buyproduct}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sp_positionid, sp_userid, sp_buyprice, sp_buydays, sp_buytime', 'required'),
			array('sp_id, sp_positionid, sp_sourceid, sp_userid, sp_buyprice, sp_buydays, sp_buytime, sp_state, sp_cannotusetime, sp_returnprice', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sp_id, sp_positionid, sp_sourceid, sp_userid, sp_buyprice, sp_buydays, sp_buytime, sp_state, sp_cannotusetime, sp_returnprice', 'safe', 'on'=>'search'),
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
            'productgrid'=>array(self::BELONGS_TO,'Productgrid','sp_positionid'),
            'baseoffice'=>array(self::BELONGS_TO,'Officebaseinfo','sp_sourceid'),
            'user'=>array(self::BELONGS_TO,'User','sp_sourceid'),
            'buildingInfo'=>array(self::BELONGS_TO,'Systembuildinginfo','sp_sourceid'),
            'shopInfo'=>array(self::BELONGS_TO,'Shopbaseinfo','sp_sourceid'),
            'residenceInfo'=>array(self::BELONGS_TO,'Residencebaseinfo','sp_sourceid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sp_id' => 'Sp',
			'sp_positionid' => '位置id',
			'sp_sourceid' => '资源id',
			'sp_userid' => '操作者',
			'sp_buyprice' => '购买价',
			'sp_buydays' => '购买天数',
			'sp_buytime' => '购买时间',
			'sp_state' => '状态',
			'sp_cannotusetime' => '不能使用时间',
			'sp_returnprice' => '退还新币数目',
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

		$criteria->compare('sp_id',$this->sp_id);

		$criteria->compare('sp_positionid',$this->sp_positionid);

		$criteria->compare('sp_sourceid',$this->sp_sourceid);

		$criteria->compare('sp_userid',$this->sp_userid);

		$criteria->compare('sp_buyprice',$this->sp_buyprice);

		$criteria->compare('sp_buydays',$this->sp_buydays);

		$criteria->compare('sp_buytime',$this->sp_buytime);

		$criteria->compare('sp_state',$this->sp_state);

		$criteria->compare('sp_cannotusetime',$this->sp_cannotusetime);

		$criteria->compare('sp_returnprice',$this->sp_returnprice);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     *通过页面和位置号，得到前台要显示的数据。排序按照格子号。
     * @param <type> $p_page页面
     * @param <type> $p_position位置
     */
    public function getProductByPageAndPosition($p_page, $p_position){
        $criteria = new CDbCriteria;
        $criteria->with = array("productgrid");
        $criteria->order = 'p_index';
        $criteria->addColumnCondition(array(
            "sp_state"=>0,
            "p_page"=>$p_page,
            "p_position"=>$p_position,
        ));
        $list = $this->findAll($criteria);
        return $list;
    }
    /**
     *把所有已经过期的用户购买精品变成过期状态
     * @param <type> $p_page
     * @param <type> $p_position 
     */
    public function changeTypeToUnUsedByPageAndPosition($p_page, $p_position) {
        $userId = Yii::app()->user->id;
        //先得到此模块下所有位置的id
        $product = Productgrid::model()->findAllByAttributes(array("p_page"=>$p_page,"p_position"=>$p_position));
        $positionid = array();
        foreach($product as $value){
            $positionid[] = $value->p_id;
        }
        //修改操作
        $criteria = new CDbCriteria;
        $criteria->addInCondition("sp_positionid",$positionid);
        $criteria->addColumnCondition(array(
            "sp_userid"=>$userId,
            "sp_state"=>0,
        ));
        $this->updateAll(array("sp_state"=>1,"sp_cannotusetime"=>time()),$criteria);
    }

     /**
     *不是发布的房源，则使精品下线。位置所有者不变
     * @param <str> $sourceid 多个id以逗号分隔
     * @param <array> $sourceType 1写字楼 2商铺 9住宅 与productgrid中的$p_positiontype对应
     */
    public function delProduct($sourceid,$sourceType){
        if(is_array($sourceType)&&!empty($sourceType)){
            $criteria = new CDbCriteria;
            $sourceTypeStr = implode(",", $sourceType);
            $criteria->condition = "sp_sourceid in(".$sourceid.")";
            $criteria->with = array(
                "productgrid"=>array(
                    "condition"=>"p_positiontype in(".$sourceTypeStr.")",
                ),
            );
            $this->updateAll(array("sp_sourceid"=>""), $criteria);
        }
    }
}