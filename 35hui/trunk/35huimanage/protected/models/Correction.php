<?php
Yii::import('application.common.*');
require_once('image.php');
/**
 * This is the model class for table "{{correction}}".
 *
 * The followings are the available columns in table '{{correction}}':
 * @property integer $ct_id
 * @property integer $ct_sourceId
 * @property integer $ct_sourcetype
 * @property integer $ct_userid
 * @property string $ct_content
 * @property integer $ct_status
 * @property string $ct_message
 * @property integer $ct_releasetime
 */
class Correction extends CActiveRecord
{
    /**
     * 资源类型
     * @var <type>
     */
    public static $ct_sourcetype = array(
        "1"=>"楼盘",
        "2"=>"小区",
        "3"=>"创意园",
    );
    /**
     * 状态
     * @var <type>
     */
    public static $ct_status = array(
        "0"=>"未审核",
        "1"=>"采用",
        "2"=>"未采用",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Correction the static model class
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
		return '{{correction}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ct_sourceId, ct_sourcetype, ct_userid, ct_content, ct_status, ct_releasetime', 'required'),
			array('ct_sourceId, ct_sourcetype, ct_userid, ct_status, ct_releasetime', 'numerical', 'integerOnly'=>true),
			array('ct_message', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ct_id, ct_sourceId, ct_sourcetype, ct_userid, ct_content, ct_status, ct_message, ct_releasetime', 'safe', 'on'=>'search'),
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
			'ct_id' => 'Ct',
			'ct_sourceId' => '资源id',
			'ct_sourcetype' => '资源类型',
			'ct_userid' => '纠错者',
			'ct_content' => '纠错内容',
			'ct_status' => '状态',
			'ct_message' => '消息',
			'ct_releasetime' => '录入时间',
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

		$criteria->compare('ct_id',$this->ct_id);

		$criteria->compare('ct_sourceId',$this->ct_sourceId);

		$criteria->compare('ct_sourcetype',$this->ct_sourcetype);

		$criteria->compare('ct_userid',$this->ct_userid);

		$criteria->compare('ct_content',$this->ct_content,true);

		$criteria->compare('ct_status',$this->ct_status);

		$criteria->compare('ct_message',$this->ct_message,true);

		$criteria->compare('ct_releasetime',$this->ct_releasetime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 根据id和类型，得到要显示的名称
     * @param <type> $ct_sourceId
     * @param <type> $ct_sourcetype
     * @return <type>
     */
    public function getName($ct_sourceId, $ct_sourcetype){
        $title = "";
        if($ct_sourcetype==1){//楼盘
            $model = Systembuildinginfo::model()->findByPk($ct_sourceId);
            if($model){
                $title = $model->sbi_buildingname;
            }
        }elseif($ct_sourcetype==2){//住宅
            $model = Communitybaseinfo::model()->findByPk($ct_sourceId);
            if($model){
                $title = $model->comy_name;
            }
        }elseif($ct_sourcetype==3){//创意园
            $model = Creativeparkbaseinfo::model()->findByPk($ct_sourceId);
            if($model){
                $title = $model->cp_name;
            }
        }
        return $title;
    }
    /**
     * 根据数据库中的 ["ct_content"]的picture内容。得到图片
     * @param <type> $string
     * @return <array>
     */
    public function formartPic($string){
        $return  = array();
        $allPic = explode("|", $string);
        foreach($allPic as $value){
            if($value){
                $tmp = explode("_", $value);
                count($tmp)==2?$return[] = $tmp:"";
            }
        }
        return $return;
    }
    /**
     * 前台采用图片后，在此保存图片
     * @param <type> $pics 是一个多维数组 $pics[0][0]是原图地址 $pics[0][1]是图片类型
     * @param <type> $sourceType 资源类型，1楼盘。2小区
     * @param <type> $sourceId
     * @return <int> 保存了的图片数目
     */
    public function insertPic($pics,$sourceType,$sourceId){
        $picNum = 0;
        if(!$pics){
            return ;
        }
        foreach($pics as $value){
            $model = new Picture();
            $dir = Picture::model()->picTypePath($value[1]);

            $newFileName = Picture::model()->imageName($value[0]);
            $model->p_img = $dir.$newFileName;
            $newFileName = PIC_PATH.$dir.$newFileName;
            if(!copy(PIC_PATH.$value[0], $newFileName)){
                return ;
            }
            //处理缩略图
            $imageDeal = new Image();
            $stand = $sourceType==1?Systembuildinginfo::$pictureNorm:Communitybaseinfo::$pictureNorm;
            $result = $imageDeal->formatWithPicture($newFileName,$stand,true);//处理缩略图
            
            $dba = dba();
            $model->p_id = $dba->id('35_picture');
            $model->p_tinyimg = $imageDeal->newImgName($model->p_img,'_tiny');
            $model->p_uploadtime = time();
            $model->p_sourceid = $sourceId;
            $model->p_sourcetype = $sourceType;
            $model->p_type = $value[1];
            $model->p_title = Picture::$typeDescription[$value[1]];
            $model->save();
            $picNum++;
        }
        return $picNum;
    }
}