<?php

/**
 * This is the model class for table "{{userimpression}}".
 *
 * The followings are the available columns in table '{{userimpression}}':
 * @property integer $ui_id
 * @property integer $ui_userid
 * @property integer $ui_fromuserid
 * @property integer $ui_contentid
 * @property integer $ui_createtime
 */
class Userimpression extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Userimpression the static model class
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
			array('ui_userid, ui_fromuserid, ui_contentid, ui_createtime', 'required'),
			array('ui_userid, ui_fromuserid, ui_contentid, ui_createtime', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ui_id, ui_userid, ui_fromuserid, ui_contentid, ui_createtime', 'safe', 'on'=>'search'),
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
			'ui_id' => 'Ui',
			'ui_userid' => 'Ui Userid',
			'ui_fromuserid' => 'Ui Fromuserid',
			'ui_contentid' => 'Ui Contentid',
			'ui_createtime' => 'Ui Createtime',
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

		$criteria->compare('ui_id',$this->ui_id);

		$criteria->compare('ui_userid',$this->ui_userid);

		$criteria->compare('ui_fromuserid',$this->ui_fromuserid);

		$criteria->compare('ui_contentid',$this->ui_contentid);

		$criteria->compare('ui_createtime',$this->ui_createtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 验证当前登录用户是否还能给此用户增加印象
     * @param <int> $toUserId
     * @return <boolean>
     */
    public function checkAlreadyImpression($toUserId){
        $userId = User::model()->getId();
        $count = $this->count("ui_userid=".$toUserId." and ui_fromuserid=".$userId);
        if($count==0){
            return true;
        }
        return false;
    }
    /**
     * 增加印象
     * @param <type> $toUserId
     * @param <type> $contentId
     */
    public function addImpression($toUserId, $contentId){
        $userId = User::model()->getId();
        $model = new Userimpression();
        $model->ui_userid = $toUserId;
        $model->ui_fromuserid = $userId;
        $model->ui_contentid = $contentId;
        $model->ui_createtime = time();
        $model->save();
        //增加总印象数
        $memberModel = Member::model()->findByAttributes(array("mem_userid"=>$toUserId));
        $memberModel->mem_impressionnum += 1;
        $memberModel->update();
    }
    /**
     * 获取印象
     * @param <type> $userId
     * @param <type> $limit
     * @return <type>
     */
    public function getImpression($userId,$limit){
        $connection = Yii::app()->db;
        $sql = "select c.uic_id,c.uic_supportnum, c.uic_content from {{userimpression}} as i left join {{userimpressioncontent}} as c on c.uic_id=i.ui_contentid where
        i.ui_userid=".$userId." group by i.ui_contentid order by c.uic_supportnum desc limit ".$limit;
        $command=$connection->createCommand($sql);
        $data = $command->queryAll();
        return $data;
    }
}