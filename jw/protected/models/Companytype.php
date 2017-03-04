<?php

/**
 * This is the model class for table "{{companytype}}".
 *
 * The followings are the available columns in table '{{companytype}}':
 * @property integer $ct_id
 * @property string $ct_name
 */
class Companytype extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Companytype the static model class
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
		return '{{companytype}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ct_name', 'required'),
			array('ct_name', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ct_id, ct_name', 'safe', 'on'=>'search'),
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
			'ct_id' => 'Ct',
			'ct_name' => '类型名称',
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

		$criteria->compare('ct_id',$this->ct_id);

		$criteria->compare('ct_name',$this->ct_name,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 获取所有类型
     * @return <array>
     */
    public function getAllType(){
        $criteria=new CDbCriteria;
        $all = $this->findAll($criteria);
        return $this->fomartToArray($all);
    }
    private function fomartToArray($all){
        $return = array();
        foreach($all as $value){
            $return[$value->ct_id] = $value->ct_name;
        }
        return $return;
    }
    /**
     * 获取类型名称
     * @param <type> $id
     * @return <type>
     */
    public function getNameById($id){
        $return = "";
        $model = $this->findByPk($id);
        if($model){
            $return = $model->ct_name;
        }
        return $return;
    }
}