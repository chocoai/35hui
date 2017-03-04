<?php

/**
 * This is the model class for table "{{exam}}".
 *
 * The followings are the available columns in table '{{exam}}':
 * @property integer $e_id
 * @property integer $e_uid
 * @property integer $e_fc
 * @property integer $e_fctime
 * @property integer $e_zc
 * @property integer $e_zctime
 * @property integer $e_lp
 * @property integer $e_lptime
 * @property integer $e_xs
 * @property integer $e_xstime
 * @property integer $e_fw
 * @property integer $e_fwtime
 */
class Exam extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Exam the static model class
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
		return '{{exam}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('e_uid', 'required'),
			array('e_uid, e_fc, e_fctime, e_zc, e_zctime, e_lp, e_lptime, e_xs, e_xstime, e_fw, e_fwtime', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('e_id, e_uid, e_fc, e_fctime, e_zc, e_zctime, e_lp, e_lptime, e_xs, e_xstime, e_fw, e_fwtime', 'safe', 'on'=>'search'),
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
			'e_id' => 'E',
			'e_uid' => 'E Uid',
			'e_fc' => 'E Fc',
			'e_fctime' => 'E Fctime',
			'e_zc' => 'E Zc',
			'e_zctime' => 'E Zctime',
			'e_lp' => 'E Lp',
			'e_lptime' => 'E Lptime',
			'e_xs' => 'E Xs',
			'e_xstime' => 'E Xstime',
			'e_fw' => 'E Fw',
			'e_fwtime' => 'E Fwtime',
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

		$criteria->compare('e_id',$this->e_id);

		$criteria->compare('e_uid',$this->e_uid);

		$criteria->compare('e_fc',$this->e_fc);

		$criteria->compare('e_fctime',$this->e_fctime);

		$criteria->compare('e_zc',$this->e_zc);

		$criteria->compare('e_zctime',$this->e_zctime);

		$criteria->compare('e_lp',$this->e_lp);

		$criteria->compare('e_lptime',$this->e_lptime);

		$criteria->compare('e_xs',$this->e_xs);

		$criteria->compare('e_xstime',$this->e_xstime);

		$criteria->compare('e_fw',$this->e_fw);

		$criteria->compare('e_fwtime',$this->e_fwtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}