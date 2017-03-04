<?php

/**
 * This is the model class for table "{{combolog}}".
 *
 * The followings are the available columns in table '{{combolog}}':
 * @property integer $cbl_id
 * @property integer $cbl_uid
 * @property string $cbl_content
 * @property integer $cbl_starttime
 * @property integer $cbl_endtime
 * @property integer $cbl_muid
 */
class Combolog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Combolog the static model class
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
		return '{{combolog}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cbl_uid, cbl_content, cbl_starttime, cbl_endtime', 'required'),
			array('cbl_uid, cbl_starttime, cbl_endtime, cbl_muid', 'numerical', 'integerOnly'=>true),
			array('cbl_content', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cbl_id, cbl_uid, cbl_content, cbl_starttime, cbl_endtime, cbl_muid', 'safe', 'on'=>'search'),
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
			'cbl_id' => 'ID',
			'cbl_uid' => '用户ID',
			'cbl_content' => '套餐信息',
			'cbl_starttime' => '订购日期',
			'cbl_endtime' => '到期日期',
			'cbl_muid' => '专属客服ID',
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

		$criteria->compare('cbl_id',$this->cbl_id);

		$criteria->compare('cbl_uid',$this->cbl_uid);

		$criteria->compare('cbl_content',$this->cbl_content,true);

		$criteria->compare('cbl_starttime',$this->cbl_starttime);

		$criteria->compare('cbl_endtime',$this->cbl_endtime);

		$criteria->compare('cbl_muid',$this->cbl_muid);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    //通过ID创建详细套餐信息链接
	public function getUserShowLink($id,$link=true) {
        $user = User::model()->findbyAttributes(array('user_id'=>$id));
        $userName=$userLink='';
        if($user) {
            $userRole=$user->user_role;
            if($userRole==User::personal) {
                $userName = $user->user_name;
            }elseif($userRole==User::agent) {
                $agentInfo = Uagent::model()->findByAttributes(array('ua_uid'=>$id));
                if($agentInfo){
                    $userLink=Yii::app()->createUrl('combolog/showuser',array('id'=>$id));
                    $userName = $agentInfo->ua_realname;
                }
            }
        }else
            return '';
        $userName=$userName?$userName:$user->user_name;
        if(!$link)
            return $userName;
        if($userLink)
            return '<a  href="'.$userLink.'">'.CHtml::encode($userName).'</a>';
        return '';
    }
}