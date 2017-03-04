<?php

class Projecttag extends CActiveRecord
{
	/**
	 * The followings are the available columns in table '{{projecttag}}':
	 * @var integer $pt_id
	 * @var integer $pt_projectid
	 * @var integer $pt_ishigh
	 * @var integer $pt_isrecommend
	 * @var integer $pt_ishomepage
	 * @var integer $pt_isvideo
	 * @var integer $pt_is3d
	 * @var integer $pt_isconsign
	 * @var integer $pt_consignid
	 * @var integer $pt_isnew
	 * @var integer $pt_ishurry
	 * @var integer $pt_check
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
		return '{{projecttag}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pt_projectid, pt_check', 'required'),
			array('pt_projectid, pt_ishigh, pt_isrecommend, pt_ishomepage, pt_isvideo, pt_is3d, pt_isconsign, pt_consignid, pt_isnew, pt_ishurry, pt_check', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pt_id, pt_projectid, pt_ishigh, pt_isrecommend, pt_ishomepage, pt_isvideo, pt_is3d, pt_isconsign, pt_consignid, pt_isnew, pt_ishurry, pt_check', 'safe', 'on'=>'search'),
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
			'pt_id' => 'Pt',
			'pt_projectid' => 'Pt Projectid',
			'pt_ishigh' => 'Pt Ishigh',
			'pt_isrecommend' => 'Pt Isrecommend',
			'pt_ishomepage' => 'Pt Ishomepage',
			'pt_isvideo' => 'Pt Isvideo',
			'pt_is3d' => 'Pt Is3d',
			'pt_isconsign' => 'Pt Isconsign',
			'pt_consignid' => 'Pt Consignid',
			'pt_isnew' => 'Pt Isnew',
			'pt_ishurry' => 'Pt Ishurry',
			'pt_check' => 'Pt Check',
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

		$criteria->compare('pt_id',$this->pt_id);

		$criteria->compare('pt_projectid',$this->pt_projectid);

		$criteria->compare('pt_ishigh',$this->pt_ishigh);

		$criteria->compare('pt_isrecommend',$this->pt_isrecommend);

		$criteria->compare('pt_ishomepage',$this->pt_ishomepage);

		$criteria->compare('pt_isvideo',$this->pt_isvideo);

		$criteria->compare('pt_is3d',$this->pt_is3d);

		$criteria->compare('pt_isconsign',$this->pt_isconsign);

		$criteria->compare('pt_consignid',$this->pt_consignid);

		$criteria->compare('pt_isnew',$this->pt_isnew);

		$criteria->compare('pt_ishurry',$this->pt_ishurry);

		$criteria->compare('pt_check',$this->pt_check);

		return new CActiveDataProvider('Projecttag', array(
			'criteria'=>$criteria,
		));
	}
}