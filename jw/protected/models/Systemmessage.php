<?php

/**
 * This is the model class for table "{{systemmessage}}".
 *
 * The followings are the available columns in table '{{systemmessage}}':
 * @property integer $sm_id
 * @property integer $sm_userid
 * @property string $sm_content
 * @property integer $sm_createtime
 */
class Systemmessage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Systemmessage the static model class
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
		return '{{systemmessage}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sm_userid, sm_content, sm_createtime', 'required'),
			array('sm_userid, sm_createtime', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sm_id, sm_userid, sm_content, sm_createtime', 'safe', 'on'=>'search'),
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
			'sm_id' => 'Sm',
			'sm_userid' => 'Sm Userid',
			'sm_content' => 'Sm Content',
			'sm_createtime' => 'Sm Createtime',
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

		$criteria->compare('sm_id',$this->sm_id);

		$criteria->compare('sm_userid',$this->sm_userid);

		$criteria->compare('sm_content',$this->sm_content,true);

		$criteria->compare('sm_createtime',$this->sm_createtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 发送消息
     * @param <type> $content 内容
     * @param <type> $userId  用户ID
     */
    public function sendMessage($content, $userId=""){
        if($userId){
            $this->addInfo($content, $userId);
        }else{
            $criteria=new CDbCriteria;
            $criteria->select= "u_id";
            $all = User::model()->findAll($criteria);
            foreach($all as $value){
                $this->addInfo($content, $value->u_id);
            }
        }
    }
    /**
     * 添加记录
     * @param <type> $content 内容
     * @param <type> $userId 用户id
     */
    private function addInfo($content, $userId){
        $model = new Systemmessage();
        $model->sm_userid = $userId;
        $model->sm_content = $content;
        $model->sm_createtime = time();
        $model->save();
    }
}