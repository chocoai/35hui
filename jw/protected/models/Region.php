<?php

/**
 * This is the model class for table "{{region}}".
 *
 * The followings are the available columns in table '{{region}}':
 * @property integer $re_id
 * @property string $re_name
 * @property integer $re_parent_id
 * @property integer $re_order
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
			array('re_parent_id, re_order', 'numerical', 'integerOnly'=>true),
			array('re_name', 'length', 'max'=>100),
            array('re_pinyin', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('re_id, re_name, re_parent_id, re_order,re_pinyin', 'safe', 'on'=>'search'),
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
			're_id' => 'Re',
			're_name' => 'Re Name',
			're_parent_id' => 'Re Parent',
			're_order' => 'Re Order',
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

		$criteria->compare('re_order',$this->re_order);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 获取所有属于父级的数据 默认返回行政区
     * @param <int> $parentId
     * @param <int> $toArray 是否变成数组
     * @param <int> $order
     * @return <array>
     */
    public function getAllGroupList($parentId = "35", $toArray = true, $order="re_order"){
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("re_parent_id"=>$parentId));
        $criteria->order = $order;
        $all = $this->findAll($criteria);
        if($toArray){
            $all = $this->fomartToArray($all);
        }
        return $all;
    }
    private function fomartToArray($all){
        $return = array();
        foreach($all as $value){
            $return[$value->re_id] = $value->re_name;
        }
        return $return;
    }
    /**
     *
     * @param <type> $parentId
     * @return <type> 统计统计下有多少信息
     */
    public function countAllGroup($parentId = "35"){
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("re_parent_id"=>$parentId));
        return $this->count($criteria);
    }
    /**
     * 返回名称
     * @param <type> $id
     * @return <type>
     */
    public function getNameById($id){
        $return = "";
        $model = $this->findByPk($id);
        if($model){
            $return = $model->re_name;
        }
        return $return;
    }
}