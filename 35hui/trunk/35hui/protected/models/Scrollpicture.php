<?php

/**
 * This is the model class for table "{{scrollpicture}}".
 *
 * The followings are the available columns in table '{{scrollpicture}}':
 * @property integer $sp_id
 * @property string $sp_title
 * @property string $sp_picture
 * @property string $sp_link
 * @property integer $sp_order
 */
class Scrollpicture extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Scrollpicture the static model class
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
		return '{{scrollpicture}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sp_title, sp_picture', 'required'),
			array('sp_order', 'numerical', 'integerOnly'=>true),
			array('sp_title, sp_picture, sp_link', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sp_id, sp_title, sp_picture, sp_link, sp_order', 'safe', 'on'=>'search'),
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
			'sp_id' => 'Sp',
			'sp_title' => 'Sp Title',
			'sp_picture' => 'Sp Picture',
			'sp_link' => 'Sp Link',
			'sp_order' => 'Sp Order',
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

		$criteria->compare('sp_id',$this->sp_id);

		$criteria->compare('sp_title',$this->sp_title,true);

		$criteria->compare('sp_picture',$this->sp_picture,true);

		$criteria->compare('sp_link',$this->sp_link,true);

		$criteria->compare('sp_order',$this->sp_order);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}