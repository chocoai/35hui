<?php

/**
 * This is the model class for table "{{systembuildingcommentlog}}".
 *
 * The followings are the available columns in table '{{systembuildingcommentlog}}':
 * @property integer $sbcl_id
 * @property integer $sbcl_uid
 * @property integer $sbcl_cid
 */
class Systembuildingcommentlog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Systembuildingcommentlog the static model class
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
		return '{{systembuildingcommentlog}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sbcl_uid, sbcl_cid', 'required'),
			array('sbcl_uid, sbcl_cid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sbcl_id, sbcl_uid, sbcl_cid', 'safe', 'on'=>'search'),
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
			'sbcl_id' => 'Sbcl',
			'sbcl_uid' => 'Sbcl Uid',
			'sbcl_cid' => 'Sbcl Cid',
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

		$criteria->compare('sbcl_id',$this->sbcl_id);

		$criteria->compare('sbcl_uid',$this->sbcl_uid);

		$criteria->compare('sbcl_cid',$this->sbcl_cid);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}