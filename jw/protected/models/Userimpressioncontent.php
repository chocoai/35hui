<?php

/**
 * This is the model class for table "{{userimpressioncontent}}".
 *
 * The followings are the available columns in table '{{userimpressioncontent}}':
 * @property integer $uic_id
 * @property string $uic_content
 * @property integer $uic_supportnum
 */
class Userimpressioncontent extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Userimpressioncontent the static model class
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
		return '{{userimpressioncontent}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uic_content', 'required'),
			array('uic_supportnum', 'numerical', 'integerOnly'=>true),
			array('uic_content', 'length', 'max'=>60),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('uic_id, uic_content, uic_supportnum', 'safe', 'on'=>'search'),
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
			'uic_id' => 'Uic',
			'uic_content' => 'Uic Content',
			'uic_supportnum' => 'Uic Supportnum',
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

		$criteria->compare('uic_id',$this->uic_id);

		$criteria->compare('uic_content',$this->uic_content,true);

		$criteria->compare('uic_supportnum',$this->uic_supportnum);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}