<?php

/**
 * This is the model class for table "{{searchfor}}".
 *
 * The followings are the available columns in table '{{searchfor}}':
 * @property integer $sf_id
 * @property string $sf_name
 * @property integer $sf_value
 * @property integer $sf_type
 */
class Searchfor extends CActiveRecord
{
    const industry = 1;//适用行业
	/**
	 * Returns the static model of the specified AR class.
	 * @return Searchfor the static model class
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
		return '{{searchfor}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sf_id', 'required'),
			array('sf_id, sf_value, sf_type', 'numerical', 'integerOnly'=>true),
			array('sf_name', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sf_id, sf_name, sf_value, sf_type', 'safe', 'on'=>'search'),
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
			'sf_name' => 'Sf Name',
			'sf_value' => 'Sf Value',
			'sf_type' => 'Sf Type',
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

		$criteria->compare('sf_name',$this->sf_name,true);

		$criteria->compare('sf_value',$this->sf_value);

		$criteria->compare('sf_type',$this->sf_type);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    public function loadItemsByType($type){
        $dba = dba();
        return $dba->select("select * from `35_searchfor` where `sf_type`=?",$type);
    }
    public function loadFormatItems($type){
        $result = array();
        $itemsData = $this->loadItemsByType($type);
        foreach($itemsData as $data){
            $result[$data['sf_value']] = $data['sf_name'];
        }
        return $result;
    }
    public function getNameByIdType($id,$type){
        $data = $this->findByAttributes(array('sf_id'=>$id,'sf_type'=>$type));
        if($data){
            return $data->sf_name;
        }else{
            return "";
        }
    }
}