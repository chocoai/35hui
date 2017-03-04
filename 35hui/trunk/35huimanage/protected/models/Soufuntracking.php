<?php

/**
 * This is the model class for table "{{soufuntracking}}".
 *
 * The followings are the available columns in table '{{soufuntracking}}':
 * @property integer $id
 * @property integer $sw_type
 * @property integer $sw_id
 * @property string $url
 * @property string $md5url
 * @property integer $infotype
 * @property string $codate
 * @property integer $timestamp
 */
class Soufuntracking extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Soufuntracking the static model class
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
		return '{{soufuntracking}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sw_type, sw_id, url, md5url, codate, timestamp', 'required'),
			array('sw_type, sw_id, infotype, timestamp', 'numerical', 'integerOnly'=>true),
			array('url', 'length', 'max'=>125),
			array('md5url', 'length', 'max'=>32),
			array('codate', 'length', 'max'=>8),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sw_type, sw_id, md5url, infotype', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'sw_type' => 'Sw Type',// 1,写字楼 2,商铺 3,住宅
			'sw_id' => 'Sw',
			'url' => 'Url',
			'md5url' => 'Md5url',
			'infotype' => 'Infotype',
			'codate' => 'Codate',
			'timestamp' => 'Timestamp',
            'errors' => 'Errors',
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

		$criteria->compare('id',$this->id);

		$criteria->compare('sw_type',$this->sw_type);

		$criteria->compare('sw_id',$this->sw_id);

		$criteria->compare('url',$this->url,true);

		$criteria->compare('md5url',$this->md5url,true);

		$criteria->compare('infotype',$this->infotype);

		$criteria->compare('codate',$this->codate,true);

		$criteria->compare('timestamp',$this->timestamp);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}