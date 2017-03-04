<?php

/**
 * This is the model class for table "{{invite}}".
 *
 * The followings are the available columns in table '{{invite}}':
 * @property integer $rc_id
 * @property integer $rc_recuid
 * @property integer $rc_uid
 */
class Invite extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Invite the static model class
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
		return '{{invite}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rc_recuid, rc_uid', 'required'),
			array('rc_recuid, rc_uid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rc_id, rc_recuid, rc_uid', 'safe', 'on'=>'search'),
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
			'rc_id' => 'Rc',
			'rc_recuid' => 'Rc Recuid',
			'rc_uid' => 'Rc Uid',
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

		$criteria->compare('rc_id',$this->rc_id);

		$criteria->compare('rc_recuid',$this->rc_recuid);

		$criteria->compare('rc_uid',$this->rc_uid);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
	 * 新注册公司通过运营认证给推荐人的奖励
	 * @return
	 */
    public function inviteUserUcom($uc_id){
        $Invite = Invite::model()->find('rc_uid=:uc_id',array(":uc_id"=>$uc_id));
        if(isset($Invite->rc_recuid)){
            $money = Oprationconfig::model()->getConfigByName('invite_ucom','0');
            $description = "您邀请的用户注册了中介公司并通过运营认证，系统赠送{:money}商务币";
            Userproperty::model()->addMoney($Invite->rc_recuid, $money, $description);
            $point = Oprationconfig::model()->getConfigByName('invite_ucom','1');
            $description = "您邀请的用户注册了中介公司并通过运营认证，系统赠送{:point}积分";
            Userproperty::model()->addPoint($Invite->rc_recuid, $point, $description);
            Medal::model()->piwikMedal($Invite->rc_recuid, 4);//邀请任务
        }
    }
    /**
	 * 新注册经纪人通过所有认证给推荐人的奖励
	 * @return
	 */
    public function inviteUserUagent($uc_id){
        $Invite = Invite::model()->find('rc_uid=:uc_id',array(":uc_id"=>$uc_id));
        if(isset($Invite->rc_recuid)){
            if( Uagent::model()->getSeniorityCertification($uc_id) 
                && Uagent::model()->getIdentityCertification($uc_id)){
                $money = Oprationconfig::model()->getConfigByName('invite_uagent','0');
                $description = "您邀请的用户注册了经纪人并通过所有认证，系统赠送{:money}商务币";
                Userproperty::model()->addMoney($Invite->rc_recuid, $money, $description);
                $point = Oprationconfig::model()->getConfigByName('invite_uagent','1');
                $description = "您邀请的用户注册了经纪人并通过所有认证，系统赠送{:point}积分";
                Userproperty::model()->addPoint($Invite->rc_recuid, $point, $description);
                Medal::model()->piwikMedal($Invite->rc_recuid, 4);//邀请任务
            }
        }
    }
}