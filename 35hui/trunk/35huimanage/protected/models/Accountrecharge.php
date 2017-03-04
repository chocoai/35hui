<?php

/**
 * This is the model class for table "{{accountrecharge}}".
 *
 * The followings are the available columns in table '{{accountrecharge}}':
 * @property integer $arc_id
 * @property string $arc_ordernum
 * @property integer $arc_fcid
 * @property integer $arc_uid
 * @property string  $arc_alipaynum
 * @property integer $arc_rechargetime
 * @property integer $arc_state
 * @property integer $arc_releasetime
 */
class Accountrecharge extends CActiveRecord
{
    /**
     *状态
     * @var <type>
     */
    public static $arc_state = array(
        "0"=>"未付款",
        "1"=>"已付款"
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Accountrecharge the static model class
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
		return '{{accountrecharge}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('arc_ordernum, arc_fcid, arc_uid, arc_releasetime', 'required'),
			array('arc_fcid, arc_uid, arc_rechargetime, arc_state, arc_releasetime', 'numerical', 'integerOnly'=>true),
			array('arc_ordernum, arc_alipaynum', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('arc_id, arc_ordernum, arc_fcid, arc_uid, arc_alipaynum, arc_rechargetime, arc_state, arc_releasetime', 'safe', 'on'=>'search'),
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
            'fundsconfig'=>array(self::BELONGS_TO,'Fundsconfig','arc_fcid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'arc_id' => 'ID',
			'arc_ordernum' => '订单号',
			'arc_fcid' => 'Arc Fcid',
			'arc_uid' => '用户',
			'arc_alipaynum' => '支付宝交易号',
			'arc_rechargetime' => '汇款时间',
			'arc_state' => '状态',
			'arc_releasetime' => '录入时间',
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

		$criteria->compare('arc_id',$this->arc_id);

		$criteria->compare('arc_ordernum',$this->arc_ordernum,true);

		$criteria->compare('arc_fcid',$this->arc_fcid);

		$criteria->compare('arc_uid',$this->arc_uid);

		$criteria->compare('arc_alipaynum',$this->arc_alipaynum);

		$criteria->compare('arc_rechargetime',$this->arc_rechargetime);

		$criteria->compare('arc_state',$this->arc_state);

		$criteria->compare('arc_releasetime',$this->arc_releasetime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}