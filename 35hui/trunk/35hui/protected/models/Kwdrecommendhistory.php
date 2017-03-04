<?php

/**
 * This is the model class for table "{{kwdrecommendhistory}}".
 *
 * The followings are the available columns in table '{{kwdrecommendhistory}}':
 * @property integer $kwrh_id
 * @property integer $kwrh_buildtype
 * @property string $kwrh_name
 * @property integer $kwrh_sellorrent
 * @property integer $kwrh_userid
 * @property integer $kwrh_buytime
 * @property integer $kwrh_expiredtime
 */
class Kwdrecommendhistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Kwdrecommendhistory the static model class
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
		return '{{kwdrecommendhistory}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kwrh_buildtype, kwrh_name, kwrh_sellorrent, kwrh_userid, kwrh_buytime, kwrh_expiredtime', 'required'),
			array('kwrh_buildtype, kwrh_sellorrent, kwrh_userid, kwrh_buytime, kwrh_expiredtime', 'numerical', 'integerOnly'=>true),
			array('kwrh_name', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('kwrh_id, kwrh_buildtype, kwrh_name, kwrh_sellorrent, kwrh_userid, kwrh_buytime, kwrh_expiredtime', 'safe', 'on'=>'search'),
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
			'kwrh_id' => 'Kwrh',
			'kwrh_buildtype' => '关键词类型',
			'kwrh_name' => '关键词',
			'kwrh_sellorrent' => '租售类型',
			'kwrh_userid' => '购买者',
			'kwrh_buytime' => '购买时间',
			'kwrh_expiredtime' => '过期时间',
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

		$criteria->compare('kwrh_id',$this->kwrh_id);

		$criteria->compare('kwrh_buildtype',$this->kwrh_buildtype);

		$criteria->compare('kwrh_name',$this->kwrh_name,true);

		$criteria->compare('kwrh_sellorrent',$this->kwrh_sellorrent);

		$criteria->compare('kwrh_userid',$this->kwrh_userid);

		$criteria->compare('kwrh_buytime',$this->kwrh_buytime);

		$criteria->compare('kwrh_expiredtime',$this->kwrh_expiredtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}