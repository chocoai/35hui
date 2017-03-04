<?php

/**
 * This is the model class for table "{{propbuylog}}".
 *
 * The followings are the available columns in table '{{propbuylog}}':
 * @property integer $pbl_id
 * @property integer $pbl_userid
 * @property integer $pbl_consumeuser
 * @property integer $pbl_propcenterid
 * @property integer $pbl_buytime
 * @property integer $pbl_usetime
 * @property integer $pbl_state
 * @property integer $pbl_sendtype
 */
class Propbuylog extends CActiveRecord
{
    /**
     * 使用状态
     * @var <type>
     */
    public static $pbl_state = array(
        "0"=>"未使用",
        "1"=>"已使用"
    );
    /**
     * 发送类型
     * @var <type>
     */
    public static $pbl_sendtype = array(
        "0"=>"正常发送",
        "1"=>"隐藏发送"
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return propbuylog the static model class
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
		return '{{propbuylog}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pbl_userid, pbl_consumeuser, pbl_propcenterid, pbl_buytime', 'required'),
			array('pbl_userid, pbl_consumeuser, pbl_propcenterid, pbl_buytime, pbl_usetime, pbl_state, pbl_sendtype', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pbl_id, pbl_userid, pbl_consumeuser, pbl_propcenterid, pbl_buytime, pbl_usetime, pbl_state, pbl_sendtype', 'safe', 'on'=>'search'),
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
			'pbl_id' => 'Gbl',
			'pbl_userid' => 'Gbl Userid',
			'pbl_consumeuser' => 'Gbl Consumeuser',
			'pbl_propcenterid' => 'Gbl propcenterid',
			'pbl_buytime' => 'Gbl Buytime',
			'pbl_usetime' => 'Gbl Usetime',
			'pbl_state' => 'Gbl State',
			'pbl_sendtype' => 'Gbl Sendtype',
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

		$criteria->compare('pbl_id',$this->pbl_id);

		$criteria->compare('pbl_userid',$this->pbl_userid);

		$criteria->compare('pbl_consumeuser',$this->pbl_consumeuser);

		$criteria->compare('pbl_propcenterid',$this->pbl_propcenterid);

		$criteria->compare('pbl_buytime',$this->pbl_buytime);

		$criteria->compare('pbl_usetime',$this->pbl_usetime);

		$criteria->compare('pbl_state',$this->pbl_state);

		$criteria->compare('pbl_sendtype',$this->pbl_sendtype);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}