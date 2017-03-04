<?php

/**
 * This is the model class for table "{{dynamicuser}}".
 *
 * The followings are the available columns in table '{{dynamicuser}}':
 * @property integer $du_id
 * @property integer $du_fromid
 * @property integer $du_type
 * @property string $du_content
 * @property integer $du_createtime
 */
class Dynamicuser extends CActiveRecord
{
    /**
     * 动态类型
     * @var <type>
     */
    public static $du_type = array(
        "1"=>"发布说说",//string
        "2"=>"上传照片",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Dynamicuser the static model class
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
		return '{{dynamicuser}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('du_fromid, du_type, du_content', 'required'),
			array('du_fromid, du_type, du_createtime', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('du_id, du_fromid, du_type, du_content, du_createtime', 'safe', 'on'=>'search'),
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
			'du_id' => 'Du',
			'du_fromid' => 'Du Fromid',
			'du_type' => 'Du Type',
			'du_content' => 'Du Content',
			'du_createtime' => 'Du Createtime',
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

		$criteria->compare('du_id',$this->du_id);

		$criteria->compare('du_fromid',$this->du_fromid);

		$criteria->compare('du_type',$this->du_type);

		$criteria->compare('du_content',$this->du_content,true);

		$criteria->compare('du_createtime',$this->du_createtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 添加用户动态
     * @param <type> $type
     * @param <type> $content
     */
    public function addDynamic($type,$content){
        if(array_key_exists($type, Dynamicuser::$du_type)){
            $model = new Dynamicuser();
            $model->du_fromid = User::model()->getId();
            $model->du_type = $type;
            $model->du_content = $content;
            $model->du_createtime = time();
            $model->save();
        }
    }
    public function getFormartShowContent($model){
        return call_user_func(array(get_class($this),"getFormartShowContentType_".$model->du_type),$model);
    }
    
    /**
     * 得到展示的标准信息
     */
    private function getFormartShowContentType_base($model){
        $return = array();
        $return["type"] = $model->du_type;
        $return["time"] = date("m-d H:i",$model->du_createtime);
        $return["username"] = @User::model()->findByPk($model->du_fromid)->u_nickname;
        return $return;
    }
    private function getFormartShowContentType_1($model){
        $return = $this->getFormartShowContentType_base($model);
        $content = unserialize($model->du_content);
        $return = array_merge($return, $content);
        //获得评论数目
        $speakModel = Userspeak::model()->findByPk($content['usid']);
        $return["replynum"] = $speakModel?$speakModel->us_replynum:"0";
        return $return;
    }
    private function getFormartShowContentType_2($model){
        $return = $this->getFormartShowContentType_base($model);
        $content = unserialize($model->du_content);
        $return = array_merge($return, $content);
        //取出相册名称
        $album = Album::model()->findByPk($return["albumid"]);
        $return["albumname"] = @$album->am_albumtitle;
        //获取评论数
        $return["replynum"] = @$album->am_replynum;
        //取出每一个图片
        
        return $return;
    }
    public function getImagesByContent($idStr){
        $return = array();
        $photoIdArr = explode(",", $idStr);
        $criteria=new CDbCriteria;
        $criteria->addInCondition("ap_id", $photoIdArr);
        $criteria->limit = 5;
        $allPhoto = Albumphoto::model()->findAll($criteria);
        $return["num"] = count($photoIdArr);
        $photoUrlArr = array();
        foreach($allPhoto as $value){
            $photoUrlArr[] = Albumphoto::model()->getStaticPhotoUrl($value->ap_url, "_230x250");
        }
        $return['photos'] = $photoUrlArr;
        return $return;
    }

    /**
     * 格式化说说
     * @param <string> $content 说说内容
     * @param <int> $speakId 说说id
     * @return <serialize>
     */
    public function formartContentType_1($content,$speakId){
        $return = array();
        $return["usid"] = $speakId;
        return serialize($return);
    }
    /**
     * 格式化上传图片
     * @param <int> $albumId 相册id
     * @param <array> $photoIdArr 照片id
     * @return <serialize>
     */
    public function formartContentType_2($albumId, $photoIdArr){
        $return = array();
        $return["albumid"] = $albumId;
        $return["photoid"] = implode(",", $photoIdArr);
        return serialize($return);
    }
    
}