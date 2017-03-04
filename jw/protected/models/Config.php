<?php

/**
 * This is the model class for table "{{config}}".
 *
 * The followings are the available columns in table '{{config}}':
 * @property integer $conf_id
 * @property string $conf_key
 * @property integer $conf_value
 * @property string $conf_description
 */
class Config extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Config the static model class
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
		return '{{config}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('conf_key, conf_value, conf_description', 'required'),
			array('conf_value', 'numerical', 'integerOnly'=>true),
			array('conf_key', 'length', 'max'=>30),
			array('conf_description', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('conf_id, conf_key, conf_value, conf_description', 'safe', 'on'=>'search'),
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
			'conf_id' => 'Conf',
			'conf_key' => 'Conf Key',
			'conf_value' => 'Conf Value',
			'conf_description' => 'Conf Description',
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

		$criteria->compare('conf_id',$this->conf_id);

		$criteria->compare('conf_key',$this->conf_key,true);

		$criteria->compare('conf_value',$this->conf_value);

		$criteria->compare('conf_description',$this->conf_description,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 获取配置的值
     * @param <type> $key
     * @return <type>
     */
    public function getValueByKey($key){
        $model = $this->findByAttributes(array("conf_key"=>$key));
        return $model->conf_value;
    }
}