<?php

class Businesstag extends CActiveRecord
{
	/**
	 * The followings are the available columns in table '{{businesstag}}':
	 * @var integer $bt_id
	 * @var integer $bt_businessid
	 * @var integer $bt_ishigh
	 * @var integer $bt_isrecommend
	 * @var integer $bt_ishomepage
	 * @var integer $bt_isvideo
	 * @var integer $bt_is3d
	 * @var integer $bt_isconsign
	 * @var integer $bt_consignid
	 * @var integer $bt_isnew
	 * @var integer $bt_ishurry
	 * @var integer $bt_check
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
		return '{{businesstag}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bt_businessid, bt_check', 'required'),
			array('bt_businessid, bt_ishigh, bt_isrecommend, bt_ishomepage, bt_isvideo, bt_is3d, bt_isconsign, bt_consignid, bt_isnew, bt_ishurry, bt_check', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('bt_id, bt_businessid, bt_ishigh, bt_isrecommend, bt_ishomepage, bt_isvideo, bt_is3d, bt_isconsign, bt_consignid, bt_isnew, bt_ishurry, bt_check', 'safe', 'on'=>'search'),
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
			'bt_id' => 'Bt',
			'bt_businessid' => 'Bt Businessid',
			'bt_ishigh' => 'Bt Ishigh',
			'bt_isrecommend' => 'Bt Isrecommend',
			'bt_ishomepage' => 'Bt Ishomepage',
			'bt_isvideo' => 'Bt Isvideo',
			'bt_is3d' => 'Bt Is3d',
			'bt_isconsign' => 'Bt Isconsign',
			'bt_consignid' => 'Bt Consignid',
			'bt_isnew' => 'Bt Isnew',
			'bt_ishurry' => 'Bt Ishurry',
			'bt_check' => 'Bt Check',
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

		$criteria->compare('bt_id',$this->bt_id);

		$criteria->compare('bt_businessid',$this->bt_businessid);

		$criteria->compare('bt_ishigh',$this->bt_ishigh);

		$criteria->compare('bt_isrecommend',$this->bt_isrecommend);

		$criteria->compare('bt_ishomepage',$this->bt_ishomepage);

		$criteria->compare('bt_isvideo',$this->bt_isvideo);

		$criteria->compare('bt_is3d',$this->bt_is3d);

		$criteria->compare('bt_isconsign',$this->bt_isconsign);

		$criteria->compare('bt_consignid',$this->bt_consignid);

		$criteria->compare('bt_isnew',$this->bt_isnew);

		$criteria->compare('bt_ishurry',$this->bt_ishurry);

		$criteria->compare('bt_check',$this->bt_check);

		return new CActiveDataProvider('Businesstag', array(
			'criteria'=>$criteria,
		));
	}
}