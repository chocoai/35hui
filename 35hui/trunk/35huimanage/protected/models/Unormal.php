<?php

/**
 * This is the model class for table "{{unormal}}".
 *
 * The followings are the available columns in table '{{unormal}}':
 * @property integer $puser_id
 * @property integer $puser_uid
 * @property string $puser_tel
 * @property string $puser_email
 * @property string $puser_logopath
 * @property string $puser_vip
 */
class Unormal extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Unormal the static model class
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
		return '{{unormal}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('puser_uid', 'required'),
			array('puser_uid', 'numerical', 'integerOnly'=>true),
			array('puser_logopath', 'length', 'max'=>200),
			array('puser_vip', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('puser_id, puser_uid, puser_tel, puser_email, puser_logopath, puser_vip', 'safe', 'on'=>'search'),
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
            'user'=>array(self::BELONGS_TO,'User','puser_uid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'puser_id' => '个人编号',
			'puser_uid' => '用户id',
			'puser_logopath' => '头像',
            'puser_logoaudit' => '头像审核',
			'puser_vip' => '是否Vip会员',
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

		$criteria->compare('puser_id',$this->puser_id);

		$criteria->compare('puser_uid',$this->puser_uid);

		$criteria->compare('puser_logopath',$this->puser_logopath,true);

		$criteria->compare('puser_vip',$this->puser_vip,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}