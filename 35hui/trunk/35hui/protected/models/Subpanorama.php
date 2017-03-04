<?php

/**
 * This is the model class for table "{{subpanorama}}".
 *
 * The followings are the available columns in table '{{subpanorama}}':
 * @property integer $spn_id
 * @property integer $spn_sourceid
 * @property integer $spn_sourcetype
 * @property string $spn_fisheyephoto
 * @property integer $spn_handler
 * @property string $spn_panoramaurl
 * @property string $spn_panoramaname
 * @property integer $spn_state
 * @property integer $spn_releasetime
 * @property integer $spn_completetime
 */
class Subpanorama extends CActiveRecord
{
    /**
     * 写字楼
     */
    const office = 1;
    /**
     * 商铺
     */
    const shop = 2;
    /**
     * 商务中心
     */
    const business = 3;
    /**
     * 住宅
     */
    const residence = 4;
    /**
     * 创意园区
     */
    const cypark = 5;

    /**
     *资源类型
     * @var <type>
     */
    public static $sourcetype = array(
      "1"=>"写字楼",
      "2"=>"商铺",
      "3"=>"商务中心",
      "4"=>"住宅",
      "5"=>"创意园区",
    );
    /**
     *鱼眼图片缩略图标准
     * @var <type>
     */
    public static $standard = array(
        "1"=> array(
            'suffix'=>'_thumbnail',
            'width'=>'100',
            'height'=>'75',
        ),
    );
    /**
     *状态
     * @var <type>
     */
    public static $spn_state = array(
        "0"=>"未审核",
        "1"=>"处理中",
        "2"=>"已完成",
        "3"=>"处理失败"
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Subpanorama the static model class
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
		return '{{subpanorama}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('spn_sourceid, spn_sourcetype, spn_fisheyephoto, spn_releasetime', 'required'),
			array('spn_sourceid, spn_sourcetype, spn_handler, spn_state, spn_releasetime, spn_completetime', 'numerical', 'integerOnly'=>true),
			array('spn_panoramaname', 'length', 'max'=>50),
			array('spn_panoramaurl', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('spn_id, spn_sourceid, spn_sourcetype, spn_fisheyephoto, spn_handler, spn_panoramaurl, spn_panoramaname, spn_state, spn_releasetime, spn_completetime', 'safe', 'on'=>'search'),
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
			'spn_id' => 'Spn',
			'spn_sourceid' => 'Spn Sourceid',
			'spn_sourcetype' => 'Spn Sourcetype',
			'spn_fisheyephoto' => 'Spn Fisheyephoto',
			'spn_handler' => 'Spn Handler',
			'spn_panoramaurl' => 'Spn Panoramaurl',
			'spn_panoramaname' => '全景名称',
			'spn_state' => 'Spn State',
			'spn_releasetime' => 'Spn Releasetime',
			'spn_completetime' => 'Spn Completetime',
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

		$criteria->compare('spn_id',$this->spn_id);

		$criteria->compare('spn_sourceid',$this->spn_sourceid);

		$criteria->compare('spn_sourcetype',$this->spn_sourcetype);

		$criteria->compare('spn_fisheyephoto',$this->spn_fisheyephoto,true);

		$criteria->compare('spn_handler',$this->spn_handler);

		$criteria->compare('spn_panoramaurl',$this->spn_panoramaurl,true);

		$criteria->compare('spn_panoramaname',$this->spn_panoramaname,true);

		$criteria->compare('spn_state',$this->spn_state);

		$criteria->compare('spn_releasetime',$this->spn_releasetime);

		$criteria->compare('spn_completetime',$this->spn_completetime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     *通过全景id，得到此全景所属用户id
     * @param <type> $spn_id
     * @return <type>
     */
    public function getSourceUserId($spn_id) {
        $model = $this->findByPk($spn_id);
        $userId = "";
        if($model&&array_key_exists($model->spn_sourcetype, Subpanorama::$sourcetype)){
            switch ($model->spn_sourcetype){
                case 1 :
                    $userId = Officebaseinfo::model()->findByPk($model->spn_sourceid)->ob_uid;
                    break;
                case 2 :
                    $userId = Shopbaseinfo::model()->findByPk($model->spn_sourceid)->sb_uid;
                    break;
                case 4:
                    $userId = Residencebaseinfo::model()->findByPk($model->spn_sourceid)->rbi_uid;
                    break;
            }
        }
        return $userId;
    }
    /**
     *如果删除了房源全景，则要看是否还有其他全景，如果没有其他全景了，则要把房源全景状态变成不是全景的房源
     * @param <type> $sourceId 房源id
     * @param <type> $sourceType 房源类型
     * @return <boolean>//在case错误的时候才返回false
     */
    public function updateSourceTag($sourceId, $sourceType){
        $model = $this->findByAttributes(array("spn_sourceid"=>$sourceId,"spn_sourcetype"=>$sourceType));//如果找不到全景了。则要把状态变成不是全景的状态
        $update = true;
        if(!$model){
            switch ($sourceType){
                default:
                    $update = false;
                    break;
                case 1 :
                    $sourceModel = Officebaseinfo::model()->findByPk($sourceId);
                    if($sourceModel){
                        $sourceModel->ob_ispanorama = 0;
                        $sourceModel->update();
                    }
                    break;
                case 2 :
                    $sourceModel = Shoptag::model()->findByAttributes(array("st_shopid"=>$sourceId));
                    if($sourceModel){
                        $sourceModel->st_ispanorama = 0;
                        $sourceModel->update();
                    }
                    break;
                case Subpanorama::residence://住宅
                    $sourceModel = Residencetag::model()->findByAttributes(array("rt_rbiid"=>$sourceId));
                    if($sourceModel){
                        $sourceModel->rt_ispanorama = 0;
                        $sourceModel->update();
                    }
                    break;
            }
        }
        return $update;
    }
    /**
     *得到房源全部全景,只显示处理完成的
     * @param <type> $sourceId
     * @param <type> $sourceType
     * @return <array>
     */
    public function getAllPanoramaBySourceIdAndSourceType($sourceId,$sourceType){
        $modle = $this->findAllByAttributes(array("spn_sourcetype"=>$sourceType,"spn_sourceid"=>$sourceId,"spn_state"=>2));
        return $modle;
    }
    /**
     *得到房源的一张全景,只显示处理完成的
     * @param <type> $sourceId
     * @param <type> $sourceType
     * @return <string>
     */
    public function getOnePanoramaBySourceIdAndSourceType($sourceId,$sourceType){
        $url = "";
        $modle = $this->findByAttributes(array("spn_sourcetype"=>$sourceType,"spn_sourceid"=>$sourceId,"spn_state"=>2));
        if($modle){
            $url = $modle->spn_panoramaurl;
        }
        return $url;
    }
    /**
     * 得到资源的所有全景
     * @param  $sourceId 楼盘地址
     * @param  $sourceType 1写字楼，2商铺， 3商务中心 4住宅 5创意园区
     * @return <array>
     */
    public function getAllPanoByIdAndType($sourceId, $sourceType){
        $return = array();
        $model = $this->findAllByAttributes(array("spn_sourcetype"=>$sourceType,"spn_sourceid"=>$sourceId,"spn_state"=>2));
        if($model){
            foreach($model as $value){
                $return[] = array(
                    "pano"=>$value->spn_panoramaurl,
                    "title"=>$value->spn_panoramaname,
                );
            }
        }
        //追加楼盘或小区的全景
        $pano = array();
        if($sourceType==1){//使用楼盘全景
            $build = Officebaseinfo::model()->findByPk($sourceId);
            if($build){
                $buildingid = $build->ob_sysid;
                $pano = Panorama::model()->getAllPanoByIdAndType($buildingid, 1);
            }
        }elseif($sourceType==2){//商铺
            $shop = Shopbaseinfo::model()->findByPk($sourceId);
            if($shop){
                $pano=array();
               // $buildingid = $shop->sb_shopid;
                //$pano = Panorama::model()->getAllPanoByIdAndType($buildingid, 1);
            }
        }elseif($sourceType==3){//商务中心
            $business = Businesscenter::model()->findByPk($sourceId);
            if($business){
                $buildingid = $business->bc_sysid;
                $pano = Panorama::model()->getAllPanoByIdAndType($buildingid, 1);
            }
        }elseif($sourceType==4){//使用小区全景
            $xiaoqu = Residencebaseinfo::model()->findByPk($sourceId);
            if($xiaoqu){
                $xiaoquId = $xiaoqu->rbi_communityid;
                $pano = Panorama::model()->getAllPanoByIdAndType($xiaoquId, 2);
            }
        }elseif($sourceType==5){//使用创意园区全景
            $creative = Creativesource::model()->findByPk($sourceId);
            if($creative){
                $creativeParkId = $creative->cr_cpid;
                $pano = Panorama::model()->getAllPanoByIdAndType($creativeParkId, 3);
            }
        }
        $return = array_merge($return, $pano);//用户散拍的要在前面，楼盘或者小区的放后面
        return $return;
    }
    /**
     *删除一条完整的散拍全景数据
     * @param <type> $id 散拍全景id
     */
    public function deleteOnePanoramaById($id){
        $model=$this->findByPk($id);
        if(!$model){
            return ;
        }
        //删除上传的鱼眼图片和缩略图
        $fisheyephoto = $model->spn_fisheyephoto;
        $fisheyephotoArr = unserialize($fisheyephoto);
        if($fisheyephotoArr){
            foreach($fisheyephotoArr as $value){
                Picture::model()->deleteFile(PIC_PATH.$value, Subpanorama::$standard);//删除文件
            }
        }
        //删除上传的全景图片
        if($model->spn_panoramaurl){
            common::deldir(PIC_PATH.$model->spn_panoramaurl);
        }
        $model->delete();
        return true;
    }
}