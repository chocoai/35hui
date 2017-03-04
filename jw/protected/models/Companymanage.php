<?php

/**
 * This is the model class for table "{{companymanage}}".
 *
 * The followings are the available columns in table '{{companymanage}}':
 * @property integer $cm_id
 * @property integer $cm_district
 * @property string $cm_companyname
 */
class Companymanage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Companymanage the static model class
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
		return '{{companymanage}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cm_district, cm_companyname, cm_address,cm_companytype,cm_avgconsume', 'required'),
			array('cm_district,cm_companytype', 'numerical', 'integerOnly'=>true),
			array('cm_companyname', 'length', 'max'=>90),
            array('cm_address', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cm_id, cm_district, cm_companyname', 'safe', 'on'=>'search'),
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
			'cm_id' => 'Cm',
			'cm_district' => '行政区',
			'cm_companyname' => '公司名称',
            'cm_address'=>'公司地址',
            'cm_companytype' => '公司类型',
            'cm_avgconsume'=>'人均消费',
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

		$criteria->compare('cm_id',$this->cm_id);

		$criteria->compare('cm_district',$this->cm_district);

		$criteria->compare('cm_companyname',$this->cm_companyname,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 获取所有属于父级的数据 默认返回行政区
     * @param <int> $parentId
     * @return <array>
     */
    public function getAllCompanyList($districtId, $type = "all", $toArray = true){
        $criteria=new CDbCriteria;
        if($type!="all"){
            $criteria->addColumnCondition(array("cm_companytype"=>$type));
        }
        $criteria->addColumnCondition(array("cm_district"=>$districtId));
        $all = $this->findAll($criteria);
        if($toArray){
            $all = $this->fomartToArray($all);
        }
        return $all;
    }
    private function fomartToArray($all){
        $return = array();
        foreach($all as $value){
            $return[$value->cm_id] = $value->cm_companyname;
        }
        return $return;
    }
    /**
     * 获取公司名称
     * @param <type> $id
     * @return <type>
     */
    public function getNameById($id){
        $return = "自由职业";
        $model = $this->findByPk($id);
        if($model){
            $return = $model->cm_companyname;
        }
        return $return;
    }
}