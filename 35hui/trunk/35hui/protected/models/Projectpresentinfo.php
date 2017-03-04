<?php

class Projectpresentinfo extends CActiveRecord
{
	/**
	 * The followings are the available columns in table '{{projectpresentinfo}}':
	 * @var integer $pp_id
	 * @var integer $pp_projectid
	 * @var string $pp_projecttitle
	 * @var string $pp_serialnum
	 * @var string $pp_projectdesc
	 * @var string $pp_traffice
	 * @var string $pp_carparking
	 * @var string $pp_facilityaround
	 * @var integer $pp_titlepicurl
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
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
		return '{{projectpresentinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pp_projectid, pp_projecttitle', 'required'),
			array('pp_projectid, pp_titlepicurl', 'numerical', 'integerOnly'=>true),
			array('pp_projecttitle, pp_serialnum, pp_traffice, pp_carparking, pp_facilityaround', 'length', 'max'=>50),
			array('pp_projectdesc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pp_id, pp_projectid, pp_projecttitle, pp_serialnum, pp_projectdesc, pp_traffice, pp_carparking, pp_facilityaround, pp_titlepicurl', 'safe', 'on'=>'search'),
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
			'pp_id' => 'Pp',
			'pp_projectid' => 'Pp Projectid',
			'pp_projecttitle' => 'Pp Projecttitle',
			'pp_serialnum' => 'Pp Serialnum',
			'pp_projectdesc' => 'Pp Projectdesc',
			'pp_traffice' => 'Pp Traffice',
			'pp_carparking' => 'Pp Carparking',
			'pp_facilityaround' => 'Pp Facilityaround',
			'pp_titlepicurl' => 'Pp Titlepicurl',
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

		$criteria->compare('pp_id',$this->pp_id);

		$criteria->compare('pp_projectid',$this->pp_projectid);

		$criteria->compare('pp_projecttitle',$this->pp_projecttitle,true);

		$criteria->compare('pp_serialnum',$this->pp_serialnum,true);

		$criteria->compare('pp_projectdesc',$this->pp_projectdesc,true);

		$criteria->compare('pp_traffice',$this->pp_traffice,true);

		$criteria->compare('pp_carparking',$this->pp_carparking,true);

		$criteria->compare('pp_facilityaround',$this->pp_facilityaround,true);

		$criteria->compare('pp_titlepicurl',$this->pp_titlepicurl);

		return new CActiveDataProvider('Projectpresentinfo', array(
			'criteria'=>$criteria,
		));
	}
}