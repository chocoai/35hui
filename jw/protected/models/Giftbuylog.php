<?php

/**
 * This is the model class for table "{{giftbuylog}}".
 *
 * The followings are the available columns in table '{{giftbuylog}}':
 * @property integer $gbl_id
 * @property integer $gbl_userid
 * @property integer $gbl_receiveuserid
 * @property integer $gbl_sendtime
 * @property integer $gbl_sendtype
 */
class Giftbuylog extends CActiveRecord
{
    /**
     * 发送类型
     * @var <type>
     */
    public static $gbl_sendtype = array(
        "0"=>"正常发送",
        "1"=>"隐藏发送"
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Giftbuylog the static model class
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
		return '{{giftbuylog}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gbl_userid, gbl_receiveuserid, gbl_sendtime', 'required'),
			array('gbl_userid, gbl_receiveuserid, gbl_sendtime, gbl_sendtype', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('gbl_id, gbl_userid, gbl_receiveuserid, gbl_sendtime, gbl_sendtype', 'safe', 'on'=>'search'),
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
			'gbl_id' => 'Gbl',
			'gbl_userid' => 'Gbl Userid',
			'gbl_receiveuserid' => 'Gbl Receiveuserid',
			'gbl_sendtime' => 'Gbl Sendtime',
			'gbl_sendtype' => 'Gbl Sendtype',
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

		$criteria->compare('gbl_id',$this->gbl_id);

		$criteria->compare('gbl_userid',$this->gbl_userid);

		$criteria->compare('gbl_receiveuserid',$this->gbl_receiveuserid);

		$criteria->compare('gbl_sendtime',$this->gbl_sendtime);

		$criteria->compare('gbl_sendtype',$this->gbl_sendtype);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}