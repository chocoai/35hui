<?php

/**
 * This is the model class for table "{{userspeak}}".
 *
 * The followings are the available columns in table '{{userspeak}}':
 * @property integer $us_id
 * @property integer $us_userid
 * @property string $us_content
 * @property integer $us_replynum
 * @property integer $us_creattime
 */
class Userspeak extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Userspeak the static model class
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
		return '{{userspeak}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('us_userid, us_content', 'required'),
			array('us_userid, us_replynum, us_creattime', 'numerical', 'integerOnly'=>true),
			array('us_content', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('us_id, us_userid, us_content, us_replynum, us_creattime', 'safe', 'on'=>'search'),
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
			'us_id' => 'Us',
			'us_userid' => 'Us Userid',
			'us_content' => 'Us Content',
			'us_replynum' => 'Us Replynum',
			'us_creattime' => 'Us Creattime',
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

		$criteria->compare('us_id',$this->us_id);

		$criteria->compare('us_userid',$this->us_userid);

		$criteria->compare('us_content',$this->us_content,true);

		$criteria->compare('us_replynum',$this->us_replynum);

		$criteria->compare('us_creattime',$this->us_creattime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 获取用户最后一条说说
     * @param <type> $userId
     * @return <type>
     */
    public function getLastSpeak($userId){
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("us_userid"=>$userId));
        $criteria->order = "us_creattime desc";
        return $this->find($criteria);
    }
}