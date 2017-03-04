<?php

/**
 * This is the model class for table "{{albumphoto}}".
 *
 * The followings are the available columns in table '{{albumphoto}}':
 * @property integer $ap_id
 * @property integer $ap_amid
 * @property string $ap_url
 * @property integer $ap_audit
 * @property integer $ap_order
 * @property integer $ap_createtime
 */
class Albumphoto extends CActiveRecord
{
    /**
     *图片尺寸
     * @var <type>
     */
    public static $photoSize = array(
        1 => array(
            'suffix'=>"_230x250",
            'width'=>'230',
            'height'=>'250',
        ),
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Albumphoto the static model class
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
		return '{{albumphoto}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ap_amid', 'required'),
			array('ap_amid, ap_audit, ap_order, ap_createtime', 'numerical', 'integerOnly'=>true),
			array('ap_url', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ap_id, ap_amid, ap_url, ap_audit, ap_order, ap_createtime', 'safe', 'on'=>'search'),
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
			'ap_id' => 'Ap',
			'ap_amid' => 'Ap Amid',
			'ap_url' => 'Ap Url',
			'ap_audit' => 'Ap Audit',
			'ap_order' => 'Ap Order',
			'ap_createtime' => 'Ap Createtime',
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

		$criteria->compare('ap_id',$this->ap_id);

		$criteria->compare('ap_amid',$this->ap_amid);

		$criteria->compare('ap_url',$this->ap_url,true);

		$criteria->compare('ap_audit',$this->ap_audit);

		$criteria->compare('ap_order',$this->ap_order);

		$criteria->compare('ap_createtime',$this->ap_createtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 为数据库中保存的图片地址加上缩略图后缀
     * @param <type> $url
     * @param <type> $suffix
     * @return <type>
     */
    public function getStaticPhotoUrl($url,$suffix){
        return str_replace(".", $suffix.".", $url);
    }
    /**
     * 删除图片，包括生成的缩略图等
     * @param <type> $url
     */
    public function delImg($url){
        foreach (self::$photoSize as $value){
            $tmpurl = self::model()->getStaticPhotoUrl($url, $value["suffix"]);
            @unlink(DOCUMENTROOT.$tmpurl);
        }
        @unlink(DOCUMENTROOT.$url);
    }
    /**
     * 判断相册是否还能上传图片
     * @param <type> $amId
     * @param <type> $picNum
     * @return <type>
     */
    public function checkCanSavePhoto($amId,$picNum){
        $albumModel = Album::model()->findByPk($amId);
        if(!$albumModel){
            return array("error","相册不存在！");
        }
        $oneAlbumPhotoNum = Config::model()->getValueByKey("one_album_photo_num");
        $count = Albumphoto::model()->count("ap_amid=".$amId);
        $shengyu = $oneAlbumPhotoNum-$count;
        if($shengyu<$picNum){
            return array("error","单个相册最多上传".$oneAlbumPhotoNum."张图片，本相册只能再上传".$shengyu."张图片！");
        }
        return array("success","可以上传！");
    }
}