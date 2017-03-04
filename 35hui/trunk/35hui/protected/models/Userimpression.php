<?php

class Userimpression extends CActiveRecord
{
	/**
	 * The followings are the available columns in table '{{userimpression}}':
	 * @var integer $ui_userid
	 * @var integer $ui_impressionid
	 * @var integer $ui_recordtime
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
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
		return '{{userimpression}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ui_userid, ui_impressionid, ui_recordtime', 'required'),
			array('ui_userid, ui_impressionid, ui_recordtime', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ui_userid, ui_impressionid, ui_recordtime', 'safe', 'on'=>'search'),
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
			'ui_userid' => 'Ui Userid',
			'ui_impressionid' => 'Ui Impressionid',
			'ui_recordtime' => 'Ui Recordtime',
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

		$criteria->compare('ui_userid',$this->ui_userid);

		$criteria->compare('ui_impressionid',$this->ui_impressionid);

		$criteria->compare('ui_recordtime',$this->ui_recordtime);

		return new CActiveDataProvider('Userimpression', array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 增加一条记录,标记某人曾发表过
     * @param <int> $userId 用户id
     * @param <int> $impressionId 印象id
     * @return <boolean> 是否记录成功
     */
    public function addPublishLog($userId,$impressionId){
        $model = new Userimpression();
        $model->setAttribute("ui_userid",$userId);
        $model->setAttribute("ui_impressionid",$impressionId);
        $model->setAttribute("ui_recordtime",time());
        return $model->save();
    }
}