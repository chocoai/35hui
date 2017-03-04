<?php

/**
 * This is the model class for table "{{manageuser}}".
 *
 * The followings are the available columns in table '{{manageuser}}':
 * @property integer $mag_userid
 * @property string $mag_username
 * @property string $mag_password
 * @property string $mag_realname
 * @property integer $mag_role
 * @property integer $mag_state
 * @property integer $mag_releasetime
 * @property string $mag_tel
 */
class Manageuser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Manageuser the static model class
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
		return '{{manageuser}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mag_username, mag_password, mag_realname, mag_releasetime', 'required'),
			array('mag_role, mag_state, mag_releasetime', 'numerical', 'integerOnly'=>true),
			array('mag_username, mag_realname', 'length', 'max'=>50),
			array('mag_password', 'length', 'max'=>200),
			array('mag_tel', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('mag_userid, mag_username, mag_password, mag_realname, mag_role, mag_state, mag_releasetime, mag_tel', 'safe', 'on'=>'search'),
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
			'mag_userid' => 'Mag Userid',
			'mag_username' => 'Mag Username',
			'mag_password' => 'Mag Password',
			'mag_realname' => 'Mag Realname',
			'mag_role' => 'Mag Role',
			'mag_state' => 'Mag State',
			'mag_releasetime' => 'Mag Releasetime',
			'mag_tel' => 'Mag Tel',
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

		$criteria->compare('mag_userid',$this->mag_userid);

		$criteria->compare('mag_username',$this->mag_username,true);

		$criteria->compare('mag_password',$this->mag_password,true);

		$criteria->compare('mag_realname',$this->mag_realname,true);

		$criteria->compare('mag_role',$this->mag_role);

		$criteria->compare('mag_state',$this->mag_state);

		$criteria->compare('mag_releasetime',$this->mag_releasetime);

		$criteria->compare('mag_tel',$this->mag_tel,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}