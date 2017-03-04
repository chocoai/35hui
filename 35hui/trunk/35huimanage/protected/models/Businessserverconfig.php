<?php

/**
 * This is the model class for table "{{businessserverconfig}}".
 *
 * The followings are the available columns in table '{{businessserverconfig}}':
 * @property integer $bs_id
 * @property string $bs_name
 */
class Businessserverconfig extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Businessserverconfig the static model class
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
		return '{{businessserverconfig}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bs_name', 'required'),
			array('bs_id', 'numerical', 'integerOnly'=>true),
			array('bs_name', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('bs_id, bs_name', 'safe', 'on'=>'search'),
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
			'bs_id' => 'Bs',
			'bs_name' => 'Bs Name',
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

		$criteria->compare('bs_id',$this->bs_id);

		$criteria->compare('bs_name',$this->bs_name,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    public function getId($name){
        $name = trim($name);
        $model = $this->findByAttributes(array("bs_name"=>$name));
        if(!$model){//插入新数据
            $model = new Businessserverconfig();
            $model->bs_name = $name;
            $model->save();
        }
        return $model->bs_id;
    }
}