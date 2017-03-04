<?php

class Region extends CActiveRecord {
    /**
     * The followings are the available columns in table '{{region}}':
     * @var integer $re_id
     * @var string $re_name
     * @var integer $re_parent_id
     * @var integer $re_recommendprice
     */

	private static $_items=array();
    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{region}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('re_name, re_parent_id', 'required'),
            array('re_parent_id, re_recommendprice', 'numerical', 'integerOnly'=>true),
            array('re_name', 'length', 'max'=>100),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('re_id, re_name, re_parent_id', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'districts'=>array(self::HAS_MANY,'Region','re_parent_id','order'=>'districts.re_order,districts.re_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            're_id' => 'Re',
            're_name' => 'Re Name',
            're_parent_id' => 'Re Parent',
            're_order' => 'Re Order',
            "re_recommendprice"=>"房源置顶推广价格"
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('re_id',$this->re_id);

        $criteria->compare('re_name',$this->re_name,true);

        $criteria->compare('re_parent_id',$this->re_parent_id);

        $criteria->compare('re_recommendprice',$this->re_recommendprice);

        return new CActiveDataProvider('region', array(
                'criteria'=>$criteria,
        ));
    }
    /**
     * 获取上海的所有商圈和板块
     * @param <int> $city_id
     * @return <type>
     */
    public function getDistrictAndSection($city_id='35') {
        $resultInfo = array();//将要返回的结果信息结合
        return $this->with('districts')->findByPk($city_id);
    }

    /**
     * 根据id获取区域名
     * @param <int> $id
     * @return <type>
     */
    public function getNameById($id) {
        $condition = $this->findByAttributes(array('re_id'=>$id));
        if($condition) {
            return $condition->re_name;
        }else {
            return "";
        }
    }

    /**
     * 获取上海的所有区域名
     * 
     */
    public function getArea() {
        $criteria = new CDbCriteria;
        $criteria->order = 're_id ASC'; // 设置排序条件
        return Region::model()->findAllByAttributes(array('re_parent_id'=>35),$criteria);
    }

    /**
     *	根据区域ID获取其所属直辖的所有标志性建筑物名
     *	
     */
    public function getBuildnameByAreaid($areaid) {
        $criteria = new CDbCriteria;
        return Region::model()->findAllByAttributes(array('re_parent_id'=>$areaid),$criteria);
    }
    /**
     * 根据id找到父类的信息
     * @param <int> $id
     * @return <object>
     */
    public function getParentInfoById($id){
        $thisInfo = $this->findByAttributes(array('re_id'=>$id));
        if($thisInfo->re_parent_id){
            return $this->findByAttributes(array('re_id'=>$thisInfo->re_parent_id));
        }
        return null;
    }
    /**
     * 根据类型id返回子id的最大值和最小值
     * @param <type> $typeId
     * @return <type>
     */
    public function getChildrenIdRangeById($id){
        $dba = dba();
        $rangeInfo = $dba->select_row("SELECT MAX(`re_id`) AS MAX,MIN(`re_id`) AS MIN FROM 35_region WHERE `re_parent_id` =?",$id);
        return $rangeInfo;
    }

	public static function item($code)
	{
		return	self::loadItems($code);
	}
	private static function loadItems($code)
	{
		
		if(-1==$code)
		{
			self::$_items=array();
		}
		else
		{
			$models=self::model()->findAll(array(
				'condition'=>'re_parent_id=:code',
				'params'=>array(':code'=>$code),
				'order'=>'re_id',
			));
			if($models == null)
			{
				self::$_items[0]='---请选择选择---';
			}
			else
			{
				self::$_items[0]='---请选择选择---';
				foreach($models as $model)
				{
					self::$_items[$model->re_id]=$model->re_name;
				}
			}
		}
		return self::$_items;
	}
	
	public static function itemparse($code)
	{
		$models=self::model()->findAll(array(
			'condition'=>'re_parent_id=:code',
			'params'=>array(':code'=>$code),
			'order'=>'re_id',
		));
	
		self::$_items[0]["id"]=0;
		self::$_items[0]["name"]='---请选择选择---';
		$count=1;
		foreach($models as $model)
		{
			self::$_items[$count]['id']=$model->re_id;
			self::$_items[$count]['name']=$model->re_name;
			$count++;
		}
		return self::$_items;
	}
    /**
     * 返回同级的规范格式的信息
     * @param <type> $id
     * @return <type>
     */
    public function getTarafUnits($id){
        if($id!=null){
            $dba = dba();
            $parent_id = $dba->select_one('SELECT `re_parent_id` FROM `35_region` WHERE `re_id`=?',$id);
            if($parent_id!=null){
                $datas = $dba->select("SELECT * FROM `35_region` WHERE `re_parent_id`=?",$parent_id);
                return $this->formatRegionData($datas);
            }
        }
        return array();
    }
    //处理格式
    protected function formatRegionData($originalData){
        $result = array();
        foreach($originalData as $data){
            $result[$data['re_id']] = $data['re_name'];
        }
        return $result;
    }
    /*
     * 得到中国的所有省份信息
     */
    public function getAllProvince(){
        return $this->getFormatChildrenData(0);
    }
    /**
     * 返回规范格式的子类信息
     * @param <type> $parentId 父类id
     * @return <type>
     */
    public function getFormatChildrenData($parentId){
        $provinces = $this->getChildrenById($parentId);
        $result = $this->formatRegionData($provinces);
        return $result;
    }
    /**
     * 得到子类集合
     * @param <type> $id
     * @return <type>
     */
    public function getChildrenById($id){
        $dba = dba();
        $children = $dba->select("select * from `35_region` where `re_parent_id`=? ORDER BY re_order,re_id",$id);
        return $children;
    }
    /**
     *得到房源置顶推广每一天需要花费的新币数目
     * @param <type> $id 版块
     * @return <integer>
     */
    public function getTopRecommendPrice($id){
        $return = 10;
        if($id){
            $model = $this->findByPk($id);
            if($model){
                $return = $model->re_recommendprice;
            }
        }
        return $return;
    }
}