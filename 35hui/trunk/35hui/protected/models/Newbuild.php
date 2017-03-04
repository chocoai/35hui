<?php

/**
 * This is the model class for table "{{newbuild}}".
 *
 * The followings are the available columns in table '{{newbuild}}':
 * @property integer $nb_id
 * @property integer $nb_sid
 * @property string $nb_yingxiao
 * @property string $nb_youshi
 * @property string $nb_characteristic
 */
class Newbuild extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Newbuild the static model class
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
		return '{{newbuild}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nb_sid', 'required'),
			array('nb_sid', 'numerical', 'integerOnly'=>true),
			array('nb_yingxiao, nb_youshi, nb_characteristic', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('nb_id, nb_sid, nb_yingxiao, nb_youshi, nb_characteristic', 'safe', 'on'=>'search'),
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
			'nb_id' => 'Nb',
			'nb_sid' => 'Nb Sid',
			'nb_yingxiao' => 'Nb Yingxiao',
			'nb_youshi' => 'Nb Youshi',
			'nb_characteristic' => 'Nb Characteristic',
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

		$criteria->compare('nb_id',$this->nb_id);

		$criteria->compare('nb_sid',$this->nb_sid);

		$criteria->compare('nb_yingxiao',$this->nb_yingxiao,true);

		$criteria->compare('nb_youshi',$this->nb_youshi,true);

		$criteria->compare('nb_characteristic',$this->nb_characteristic,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}