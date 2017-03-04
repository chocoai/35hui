<?php

/**
 * This is the model class for table "{{post}}".
 *
 * The followings are the available columns in table '{{post}}':
 * @property integer $post_id
 * @property string $post_content
 * @property string $post_content
 * @property integer $post_role
 * @property integer $post_time
 */
class Post extends CActiveRecord
{
    /* 公告类型 */
    const all = 0;
    const psersonal = 1;
    const agent = 2;
    const company = 3;
    /* 公告类型 */

    public static $roleDescription = array(
        0=>'所有人',
        1=>'普通会员',
        2=>'经纪人',
        3=>'门店',
        4=>'首页',
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Post the static model class
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
		return '{{post}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('post_id', 'required'),
			array('post_id, post_role, post_time', 'numerical', 'integerOnly'=>true),
			array('post_title', 'length', 'max'=>200),
			array('post_content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('post_id, post_title, post_content, post_role, post_time', 'safe', 'on'=>'search'),
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
			'post_id' => 'Id',
            'post_title' => '公告标题',
			'post_content' => '公告内容',
			'post_role' => '发送对象',
			'post_time' => '发布时间',
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

		$criteria->compare('post_id',$this->post_id);

		$criteria->compare('post_title',$this->post_title,true);

        $criteria->compare('post_content',$this->post_content,true);

		$criteria->compare('post_role',$this->post_role);

		$criteria->compare('post_status',$this->post_status);

		$criteria->compare('post_time',$this->post_time);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     *通过角色得到所有的公告
     * @param <type> $role
     * @return <type> 
     */
    public function getAllPostByRole($role){
        $criteria=new CDbCriteria;
        $criteria->addCondition("post_role=".$role." or post_role=0");
        $criteria->order = "post_time desc";
        return new CActiveDataProvider(get_class($this), array(
            'pagination'=>array(
                'pageSize'=>20,
            ),
			'criteria'=>$criteria,
		));
    }
    /**
     *得到最新的公告
     * @return <type>
     */
    public function getNewestPost(){
        $userId = Yii::app()->user->id;
        if(!$userId){
            return;
        }
        $userRole = User::model()->getRolebyid($userId);
        $model = $model = $this->find("post_role=:role or post_role=0 order by post_time desc",array(':role'=>$userRole));
        return $model;
    }
    /**
     * 得到首页公告
     * @return <type>
     */
    public function getIndexPost(){
        $model = $model = $this->find("post_role=4 order by post_time desc");
        return $model;
    }
}