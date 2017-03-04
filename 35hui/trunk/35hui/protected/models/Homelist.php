<?php

/**
 * This is the model class for table "{{homelist}}".
 *
 * The followings are the available columns in table '{{homelist}}':
 * @property integer $hl_id
 * @property string $hl_piclist
 * @property string $hl_titlelist
 */
class Homelist extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Homelist the static model class
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
		return '{{homelist}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hl_piclist, hl_titlelist', 'required'),
			array('hl_piclist, hl_titlelist', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('hl_id, hl_piclist, hl_titlelist', 'safe', 'on'=>'search'),
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
			'hl_id' => 'Hl',
			'hl_piclist' => 'Hl Piclist',
			'hl_titlelist' => 'Hl Titlelist',
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

		$criteria->compare('hl_id',$this->hl_id);

		$criteria->compare('hl_piclist',$this->hl_piclist,true);

		$criteria->compare('hl_titlelist',$this->hl_titlelist,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}