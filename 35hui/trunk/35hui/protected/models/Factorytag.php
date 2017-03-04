<?php

class Factorytag extends CActiveRecord
{
	/**
	 * The followings are the available columns in table '{{factorytag}}':
	 * @var integer $ft_id
	 * @var integer $ft_factoryid
	 * @var integer $ft_ishigh
	 * @var integer $ft_isrecommend
	 * @var integer $ft_ishomepage
	 * @var integer $ft_isvideo
	 * @var integer $ft_is3d
	 * @var integer $ft_isconsign
	 * @var integer $ft_consignid
	 * @var integer $ft_isnew
	 * @var integer $ft_ishurry
	 * @var integer $ft_check
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
		return '{{factorytag}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ft_factoryid, ft_check', 'required'),
			array('ft_factoryid, ft_ishigh, ft_isrecommend, ft_ishomepage, ft_isvideo, ft_is3d, ft_isconsign, ft_consignid, ft_isnew, ft_ishurry, ft_check', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ft_id, ft_factoryid, ft_ishigh, ft_isrecommend, ft_ishomepage, ft_isvideo, ft_is3d, ft_isconsign, ft_consignid, ft_isnew, ft_ishurry, ft_check', 'safe', 'on'=>'search'),
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
			'ft_id' => 'Ft',
			'ft_factoryid' => 'Ft Factoryid',
			'ft_ishigh' => 'Ft Ishigh',
			'ft_isrecommend' => 'Ft Isrecommend',
			'ft_ishomepage' => 'Ft Ishomepage',
			'ft_isvideo' => 'Ft Isvideo',
			'ft_is3d' => 'Ft Is3d',
			'ft_isconsign' => 'Ft Isconsign',
			'ft_consignid' => 'Ft Consignid',
			'ft_isnew' => 'Ft Isnew',
			'ft_ishurry' => 'Ft Ishurry',
			'ft_check' => 'Ft Check',
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

		$criteria->compare('ft_id',$this->ft_id);

		$criteria->compare('ft_factoryid',$this->ft_factoryid);

		$criteria->compare('ft_ishigh',$this->ft_ishigh);

		$criteria->compare('ft_isrecommend',$this->ft_isrecommend);

		$criteria->compare('ft_ishomepage',$this->ft_ishomepage);

		$criteria->compare('ft_isvideo',$this->ft_isvideo);

		$criteria->compare('ft_is3d',$this->ft_is3d);

		$criteria->compare('ft_isconsign',$this->ft_isconsign);

		$criteria->compare('ft_consignid',$this->ft_consignid);

		$criteria->compare('ft_isnew',$this->ft_isnew);

		$criteria->compare('ft_ishurry',$this->ft_ishurry);

		$criteria->compare('ft_check',$this->ft_check);

		return new CActiveDataProvider('Factorytag', array(
			'criteria'=>$criteria,
		));
	}
}