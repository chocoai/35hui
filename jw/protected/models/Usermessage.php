<?php

/**
 * This is the model class for table "{{usermessage}}".
 *
 * The followings are the available columns in table '{{usermessage}}':
 * @property integer $um_id
 * @property integer $um_userid
 * @property integer $um_fromid
 * @property integer $um_replyidumid
 * @property string $um_content
 * @property integer $um_createtime
 * @property integer $um_delstate
 */
class Usermessage extends CActiveRecord
{
    /**
     * 查看状态
     * @var <type>
     */
    public $um_readstate = array(
        "0"=>"未读",
        "1"=>"已读",
    );
    /**
     * 删除状态
     * @var <type> 
     */
    public $um_delstate = array(
        "0"=>"未删除",
        "1"=>"收件者删除",
        "2"=>"发件者删除",
        "3"=>"全部删除",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Usermessage the static model class
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
		return '{{usermessage}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('um_userid, um_fromid, um_content, um_createtime', 'required'),
			array('um_userid, um_fromid, um_replyidumid, um_createtime, um_delstate', 'numerical', 'integerOnly'=>true),
			array('um_content', 'length', 'max'=>900),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('um_id, um_userid, um_fromid, um_replyidumid, um_content, um_createtime, um_delstate', 'safe', 'on'=>'search'),
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
			'um_id' => 'Um',
			'um_userid' => 'Um Userid',
			'um_fromid' => 'Um Fromid',
			'um_replyidumid' => 'Um Replyidumid',
			'um_content' => 'Um Content',
			'um_createtime' => 'Um Createtime',
			'um_delstate' => 'Um Delstate',
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

		$criteria->compare('um_id',$this->um_id);

		$criteria->compare('um_userid',$this->um_userid);

		$criteria->compare('um_fromid',$this->um_fromid);

		$criteria->compare('um_replyidumid',$this->um_replyidumid);

		$criteria->compare('um_content',$this->um_content,true);

		$criteria->compare('um_createtime',$this->um_createtime);

		$criteria->compare('um_delstate',$this->um_delstate);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}