<?php

/**
 * This is the model class for table "{{msg}}".
 *
 * The followings are the available columns in table '{{msg}}':
 * @property integer $msg_id
 * @property integer $msg_sendid
 * @property integer $msg_revid
 * @property string $msg_title
 * @property string $msg_content
 * @property integer $msg_type
 * @property integer $msg_time
 * @property integer $msg_senddel
 * @property integer $msg_revdel
 * @property integer $msg_isread
 */
class Msg extends CActiveRecord
{
    public static $readstatu = array(
		'unread'=>0,
		'read'=>1,
	);
	public static $msgtype = array(
		'normal'=>0,
	);
	public static $del = array(
		'undel'=>0,
		'del'=>1,
	);
	/**
	 * Returns the static model of the specified AR class.
	 * @return Msg the static model class
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
		return '{{msg}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('msg_sendid,msg_revid,msg_title,msg_content', 'required'),
			array('msg_sendid, msg_revid, msg_type, msg_time, msg_senddel, msg_revdel, msg_isread', 'numerical', 'integerOnly'=>true),
			array('msg_title', 'length', 'max'=>50),
			array('msg_content', 'length', 'max'=>1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('msg_id, msg_sendid, msg_revid, msg_title, msg_content, msg_type, msg_time, msg_senddel, msg_revdel, msg_isread', 'safe', 'on'=>'search'),
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
			'msg_id' => 'Msg',
			'msg_sendid' => '发信人',
			'msg_revid' => '收信人',
			'msg_title' => '标题',
			'msg_content' => '正文',
			'msg_type' => '类型',
			'msg_time' => '发送时间',
			'msg_senddel' => '发送者是否删除',
			'msg_revdel' => '接收者是否删除',
			'msg_isread' => '是否阅读',
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

		$criteria->compare('msg_id',$this->msg_id);

		$criteria->compare('msg_sendid',$this->msg_sendid);

		$criteria->compare('msg_revid',$this->msg_revid);

		$criteria->compare('msg_title',$this->msg_title,true);

		$criteria->compare('msg_content',$this->msg_content,true);

		$criteria->compare('msg_type',$this->msg_type);

		$criteria->compare('msg_time',$this->msg_time);

		$criteria->compare('msg_senddel',$this->msg_senddel);

		$criteria->compare('msg_revdel',$this->msg_revdel);

		$criteria->compare('msg_isread',$this->msg_isread);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    //没有阅读的站内信条数
	public function unreadcount($usrid)
	{
		$condition='msg_revid='.$usrid.' and msg_isread="'.self::$readstatu['unread'].'" and msg_revdel="'.self::$del['undel'].'"';
		return $this->count($condition);
	}
    /**
     * 发送站内信
     * @param <int> $sendUserId 发送者的userId
     * @param <int> $toUserId 接收者的userId
     * @param <type> $title 标题
     * @param <string> $content 内容
     * @param <string> $type 站内信类别
     * @return <mix> 成功则返回站内信id,失败则返回false
     */
	public function sendMessage($sendUserId,$toUserId,$title,$content,$type=0){
        $message = new Msg;
        $dba = dba();
        $message->msg_id = $dba->id('35_msg');
        $message->msg_sendid = $sendUserId;
        $message->msg_revid = $toUserId;
        $message->msg_title = $title;
        $message->msg_content = $content;
        $message->msg_type = $type;
        $message->msg_time = time();
        $message->msg_senddel = self::$del['undel'];
        $message->msg_revdel = self::$del['undel'];
        $message->msg_isread = self::$readstatu['unread'];
        if($message->save())
            return $message->msg_id;
        else
            return false;
    }
    public function getAllUnReadReceiveMsg($userid){
		$criteria=new CDbCriteria(array(
			'condition'=>'msg_revid=:userId and msg_revdel=:revdel and msg_isread=0',
            'params'=>array(":userId"=>$userid,":revdel"=>Msg::$del['undel']),
			'order'=>'msg_time DESC',
		));
        $list = $this->findAll($criteria);
        return $list;
    }
}