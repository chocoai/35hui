<?php

/**
 * This is the model class for table "{{searchcondition}}".
 *
 * The followings are the available columns in table '{{searchcondition}}':
 * @property integer $sc_id
 * @property string $sc_title
 * @property integer $sc_parentid
 * @property integer $sc_maxvalue
 * @property integer $sc_minvalue
 */
class Searchcondition extends CActiveRecord
{
    const loopTypeId = 15;//内外环
    const sellPriceTypeId = 20;//售价
    const rentPriceTypeId = 30;//租价
    const metroTypeId = 40;//地铁
    const industryTypeId = 59;//适用行业
	/**
	 * Returns the static model of the specified AR class.
	 * @return Searchcondition the static model class
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
		return '{{searchcondition}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sc_id, sc_title, sc_parentid, sc_maxvalue, sc_minvalue', 'required'),
			array('sc_id, sc_parentid, sc_maxvalue, sc_minvalue', 'numerical', 'integerOnly'=>true),
			array('sc_title', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sc_id, sc_title, sc_parentid, sc_maxvalue, sc_minvalue', 'safe', 'on'=>'search'),
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
			'sc_id' => 'Sc',
			'sc_title' => 'Sc Title',
			'sc_parentid' => 'Sc Parentid',
			'sc_maxvalue' => 'Sc Maxvalue',
			'sc_minvalue' => 'Sc Minvalue',
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

		$criteria->compare('sc_id',$this->sc_id);

		$criteria->compare('sc_title',$this->sc_title,true);

		$criteria->compare('sc_parentid',$this->sc_parentid);

		$criteria->compare('sc_maxvalue',$this->sc_maxvalue);

		$criteria->compare('sc_minvalue',$this->sc_minvalue);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    public function getAllLoops(){
        $allLoop = array();
        $loopRecord = Searchcondition::model()->findAllByAttributes(array('sc_parentid'=>self::loopTypeId));
        foreach($loopRecord as $record){
            $allLoop[$record->sc_minvalue]=$record->sc_title;
        }
        return $allLoop;
    }
    public function getNameById($id) {
        $condition = $this->getSearchConditionById($id);
        return $condition->sc_title;
    }
    public function getSearchConditionById($id){
        return $this->findByAttributes(array('sc_id'=>$id));
    }
    public function getLoopName($value) {
        return $this->getNameByTypeAndValue(self::loopTypeId,$value);
    }
    /**
     * 根据类型id和最小值得到名称
     * @param <type> $typeId
     * @param <type> $value
     * @return <type>
     */
    public function getNameByTypeAndValue($typeId,$value) {
        $condition = $this->findByAttributes(array('sc_parentid'=>$typeId,'sc_minvalue'=>$value));
        if($condition) {
            return $condition->sc_title;
        }else {
            return "";
        }
    }
}