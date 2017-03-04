<?php

/**
 * This is the model class for table "{{error}}".
 *
 * The followings are the available columns in table '{{error}}':
 * @property integer $e_id
 * @property string $e_content
 * @property integer $e_buildid
 * @property integer $e_userid
 * @property string $e_nickname
 * @property string $e_telphone
 * @property string $e_email
 * @property integer $e_state
 * @property integer $e_date
 */
class Error extends CActiveRecord
{
    public static $stateDes = array(
        0=>'未受理',
        1=>'已受理',
        2=>'不受理',
    );
    const accept = 1;
    const refuse = 2;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Error the static model class
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
		return '{{error}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('e_content, e_buildid', 'required'),
			array('e_buildid, e_userid, e_state, e_date', 'numerical', 'integerOnly'=>true),
			array('e_content, e_nickname, e_telphone, e_email', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('e_id, e_content, e_buildid, e_userid, e_nickname, e_telphone, e_email, e_state, e_date', 'safe', 'on'=>'search'),
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
			'e_id' => 'ID',
			'e_content' => '纠错内容',
			'e_buildid' => '楼盘',
			'e_userid' => '纠错会员',
			'e_nickname' => '纠错人姓名',
			'e_telphone' => '纠错人电话',
			'e_email' => '纠错人Email',
			'e_state' => '受理状态',
			'e_date' => '纠错日期',
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

		$criteria->compare('e_content',$this->e_content,true);

		$criteria->compare('e_buildid',$this->e_buildid);

		$criteria->compare('e_userid',$this->e_userid);

		$criteria->compare('e_nickname',$this->e_nickname,true);

		$criteria->compare('e_telphone',$this->e_telphone,true);

		$criteria->compare('e_email',$this->e_email,true);

		$criteria->compare('e_state',$this->e_state);

		$criteria->compare('e_date',$this->e_date);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}