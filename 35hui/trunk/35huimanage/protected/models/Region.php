<?php

/**
 * This is the model class for table "{{region}}".
 *
 * The followings are the available columns in table '{{region}}':
 * @property integer $re_id
 * @property string $re_name
 * @property integer $re_parent_id
 * @property integer $re_recommendprice
 */
class Region extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Region the static model class
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
		return '{{region}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
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
			're_id' => '主键Id',
			're_name' => '地区名称',
			're_parent_id' => '上级主键Id',
            're_order' => '排序',
            "re_recommendprice"=>"房源置顶推广价格"
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

		$criteria->compare('re_id',$this->re_id);

		$criteria->compare('re_name',$this->re_name,true);

		$criteria->compare('re_parent_id',$this->re_parent_id);

        $criteria->compare('re_recommendprice',$this->re_recommendprice);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 根据id获取区域名
     * @param <int> $id
     * @return <type>
     */
    public function getNameById($id) {
        if(isset($id)){
            $condition = $this->findByAttributes(array('re_id'=>$id));
            if($condition) {
                return $condition->re_name;
            }
        }
        return "";
    }
    /**
     * 得到子类集合
     * @param <type> $id
     * @return <type>
     */
    public function getChildrenById($id){
        $dba = dba();
        $children = $dba->select("select * from `35_region` where `re_parent_id`=?",$id);
        return $children;
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
    public function hasId($id){
        $dba = dba();
        $data = $dba->select("select * from `35_region` where `re_id`=?",$id);
        if(count($data)){
            return true;
        }else{
            return false;
        }
    }
}