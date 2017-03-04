<?php

/**
 * This is the model class for table "{{album}}".
 *
 * The followings are the available columns in table '{{album}}':
 * @property integer $am_id
 * @property integer $am_userid
 * @property string $am_albumtitle
 * @property string $am_albumdescribe
 * @property integer $am_albumtype
 * @property integer $am_albumcoverid
 * @property integer $am_createtime
 * @property integer $am_updatetime
 */
class Album extends CActiveRecord
{
    /**
     * 相册类型
     * @var <array>
     */
    public static $am_albumtype = array(
        "1"=>"最爱",
        "2"=>"人物",
        "3"=>"风景",
        "4"=>"动物",
        "5"=>"游记",
        "6"=>"卡通",
        "7"=>"生活",
        "8"=>"其他",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Album the static model class
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
		return '{{album}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('am_userid', 'required'),
			array('am_userid, am_albumtype, am_albumcoverid, am_createtime, am_updatetime', 'numerical', 'integerOnly'=>true),
			array('am_albumtitle', 'length', 'max'=>45),
            array('am_albumdescribe', 'length', 'max'=>450),
			array('am_albumdescribe', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('am_id, am_userid, am_albumtitle, am_albumdescribe, am_albumtype, am_albumcoverid, am_createtime, am_updatetime', 'safe', 'on'=>'search'),
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
			'am_id' => 'Am',
			'am_userid' => 'Am Mbuserid',
			'am_albumtitle' => 'Am Albumtitet',
			'am_albumdescribe' => 'Am Albumdescribe',
			'am_albumtype' => 'Am Albumtype',
			'am_albumcoverid' => 'Am Albumcoverid',
			'am_createtime' => 'Am Createtime',
			'am_updatetime' => 'Am Updatetime',
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

		$criteria->compare('am_id',$this->am_id);

		$criteria->compare('am_userid',$this->am_userid);

		$criteria->compare('am_albumtitle',$this->am_albumtitle,true);

		$criteria->compare('am_albumdescribe',$this->am_albumdescribe,true);

		$criteria->compare('am_albumtype',$this->am_albumtype);

		$criteria->compare('am_albumcoverid',$this->am_albumcoverid);

		$criteria->compare('am_createtime',$this->am_createtime);

		$criteria->compare('am_updatetime',$this->am_updatetime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 判断相册是否属于当前用户。属于才能操作
     * @param <type> $albumModel
     * @return <type>
     */
    public function checkAlbumBelongCurrentUser($albumModel){
        $loginUid = User::model()->getId();;
        $albumUserid = $albumModel->am_userid;
        if($loginUid==$albumUserid){
            return true;
        }
        return false;
    }
    /**
     * 获取相册封面
     * @param <object> $albumModel 相册model
     * @param <string> $suffix 后缀
     * @return <string> 相册url
     */
    public function getAlbumcoverUrl($albumModel,$suffix=""){
        $url = "/images/default/no_cover.png";
        //判断相册内是否有图片，没有就显示默认图像
        if($albumModel&&$albumModel->am_photonum){
            //如果相册内有图片，判断是否设置封面，如果没有，就选择里面的第一张作为封面
            if($albumModel->am_albumcoverid){
                $coverid = $albumModel->am_albumcoverid;
                $photoModel = Albumphoto::model()->findByPk($coverid);
                if($photoModel){//图片存在，使用图片。
                    $url = $photoModel->ap_url;
                }else{//图片不存在，可能被删除了，则使用第一张做封面
                    $url = $this->getFirstPhotoInAlbum($albumModel->am_id);
                }
            }else{//选择第一张图片做封面
                $url = $this->getFirstPhotoInAlbum($albumModel->am_id);
            }
            if($suffix){
                $url = Albumphoto::model()->getStaticPhotoUrl($url, $suffix);
            }
        }
        return $url;
    }
    /**
     * 获取相册内的第一张图片url
     * @param <int> $albumId 相册id
     * @return <string>
     */
    private function getFirstPhotoInAlbum($albumId){
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("ap_amid"=>$albumId));
        $criteria->order = "ap_order";
        $photo = Albumphoto::model()->find($criteria);
        return $photo->ap_url;
    }
    /**
     * 增加相册访问数目
     * @param <type> $albumModel
     * @return <type>
     */
    public function addVisitNum($albumModel){
        $albumModel->am_visitnum +=1;
        $albumModel->update();
        return $albumModel;
    }
    /**
     * 返回相册
     * @param <type> $userId
     * @param <type> $order
     * @param <type> $limit
     * @return <type>
     */
    public function getAlbums($userId,$order,$limit){
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("am_userid"=>$userId));
        $criteria->order = $order;
        $criteria->limit = $limit;
        return $this->findAll($criteria);
    }
}