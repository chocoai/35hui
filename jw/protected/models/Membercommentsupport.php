<?php

/**
 * This is the model class for table "{{membercommentsupport}}".
 *
 * The followings are the available columns in table '{{membercommentsupport}}':
 * @property integer $mcs_id
 * @property integer $mcs_userid
 * @property integer $mcs_mcid
 * @property integer $mcs_createtime
 */
class Membercommentsupport extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Membercommentsupport the static model class
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
		return '{{membercommentsupport}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mcs_userid, mcs_mcid, mcs_createtime', 'required'),
			array('mcs_userid, mcs_mcid, mcs_createtime', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('mcs_id, mcs_userid, mcs_mcid, mcs_createtime', 'safe', 'on'=>'search'),
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
			'mcs_id' => 'Mcs',
			'mcs_userid' => 'Mcs Userid',
			'mcs_mcid' => 'Mcs Mcid',
			'mcs_createtime' => 'Mcs Createtime',
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

		$criteria->compare('mcs_id',$this->mcs_id);

		$criteria->compare('mcs_userid',$this->mcs_userid);

		$criteria->compare('mcs_mcid',$this->mcs_mcid);

		$criteria->compare('mcs_createtime',$this->mcs_createtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 判断是否还能够保存
     * @param <type> $mcid
     * @return <type>
     */
    public function checkCanSupport($mcid){
        $userId = User::model()->getId();
        $count = $this->count("mcs_userid=".$userId." and mcs_mcid=".$mcid);
        if($count==0){
            return true;
        }else{
            return false;
        }
    }
}