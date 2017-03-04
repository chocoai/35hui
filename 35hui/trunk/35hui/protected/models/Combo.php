<?php

/**
 * This is the model class for table "{{combo}}".
 *
 * The followings are the available columns in table '{{combo}}':
 * @property integer $cb_id
 * @property integer $cb_issuednum
 * @property integer $cb_inputnum
 * @property integer $cb_refreshnum
 * @property integer $cb_comboprice
 */
class Combo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Combo the static model class
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
		return '{{combo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cb_id, cb_issuednum, cb_inputnum, cb_refreshnum,cb_comboprice', 'required'),
			array('cb_id, cb_issuednum, cb_inputnum, cb_refreshnum, cb_comboprice', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cb_id, cb_issuednum, cb_inputnum, cb_refreshnum, cb_comboprice', 'safe', 'on'=>'search'),
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
			'cb_id' => '主键',
			'cb_issuednum' => '发布房源总数',
			'cb_inputnum' => '录入房源总数',
			'cb_refreshnum' => '每日刷新房源总数',
			'cb_comboprice' => '价格',
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

		$criteria->compare('cb_id',$this->cb_id);

		$criteria->compare('cb_issuednum',$this->cb_issuednum);

		$criteria->compare('cb_inputnum',$this->cb_inputnum);

		$criteria->compare('cb_refreshnum',$this->cb_refreshnum);

		$criteria->compare('cb_comboprice',$this->cb_comboprice);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 套餐标签的完整地址
     * @param <type> $model
     * @return <type>
     */
    public function getComboIconUrl($model){
        if($model){
            return DOMAIN.$model->cb_iconurl;
        }
    }
}