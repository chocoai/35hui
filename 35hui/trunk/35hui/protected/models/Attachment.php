<?php

/**
 * This is the model class for table "{{attachment}}".
 *
 * The followings are the available columns in table '{{attachment}}':
 * @property integer $id
 * @property integer $buid_type
 * @property integer $buid_id
 * @property integer $att_type
 * @property integer $up_uid
 * @property string $path
 * @property integer $isuse
 * @property integer $downloads
 * @property integer $time
 */
class Attachment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Attachment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public static $buidTypeName = array(
        '1'=>'写字楼楼盘',
        '2'=>'小区楼盘',
    );
    public static $attTypeName = array(
        '1'=>'楼书',
        '2'=>'合同',
    );
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{attachment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('buid_type, buid_id, att_type, up_uid, path, time', 'required'),
			array('buid_type, buid_id, att_type, up_uid, isuse, downloads, money, time', 'numerical', 'integerOnly'=>true),
			array('path', 'length', 'max'=>125),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, buid_type, buid_id, att_type, up_uid, path, isuse, downloads, time', 'safe', 'on'=>'search'),
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
			'buid_type' => 'Buid Type',
			'buid_id' => 'Buid',
			'att_type' => 'Att Type',
			'up_uid' => 'Up Uid',
			'path' => 'Path',
			'isuse' => 'Isuse',
			'downloads' => 'Downloads',
            'money' =>'Money',
			'time' => 'Time',
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

		$criteria->compare('buid_type',$this->buid_type);

		$criteria->compare('buid_id',$this->buid_id);

		$criteria->compare('att_type',$this->att_type);

		$criteria->compare('up_uid',$this->up_uid);

		$criteria->compare('path',$this->path,true);

		$criteria->compare('isuse',$this->isuse);

		$criteria->compare('downloads',$this->downloads);

		$criteria->compare('time',$this->time);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}