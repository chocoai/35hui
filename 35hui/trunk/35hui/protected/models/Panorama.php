<?php

/**
 * This is the model class for table "{{panorama}}".
 *
 * The followings are the available columns in table '{{panorama}}':
 * @property integer $p_id
 * @property string $p_title
 * @property string $p_description
 * @property string $p_remark
 * @property string $p_tag
 * @property string $p_url
 * @property integer $p_buildingid
 * @property integer $p_type
 * @property integer $p_uploadtime
 */
class Panorama extends CActiveRecord
{
    /*-- 全景类型 --*/
    /** 周边全景 */
    const around = 1;
    /** 户型全景 */
    const houselayout = 2;
    /** 导览全景 */
    const navigation = 3;
    /**
     * 全景类型
     * @var <type>
     */
    public static $p_type = array(
        1=>'周边全景',
        2=>'户型全景',
        3=>'导览全景',
    );
    /**
     * 资源类型
     * @var <type>
     */
    public static $p_ptype = array(
        1=>'楼盘',
        2=>'小区',
        3=>"创意园区",
    );
    public static $thumbnail = "/thumbnail.jpg";//代表一份全景的缩略图
	/**
	 * Returns the static model of the specified AR class.
	 * @return Panorama the static model class
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
		return '{{panorama}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('p_id', 'required'),
			array('p_id, p_buildingid, p_type, p_uploadtime,  p_ptype', 'numerical', 'integerOnly'=>true),
			array('p_title, p_tag, p_url', 'length', 'max'=>200),
			array('p_description, p_remark', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('p_id, p_title, p_description, p_remark, p_tag, p_url, p_buildingid, p_type, p_ptype,p_uploadtime', 'safe', 'on'=>'search'),
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
            'building'=>array(self::BELONGS_TO,'Systembuildinginfo','p_buildingid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'p_id' => '主键',
			'p_title' => '全景标题',
			'p_description' => '全景描述',
			'p_remark' => '全景备注',
			'p_tag' => '全景标签',
			'p_url' => '全景url',
			'p_buildingid' => '全景所属资源id',
			'p_type' => '全景类型',
			'p_ptype' => '类型1楼盘2小区',
			'p_uploadtime' => '上传时间',
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

		$criteria->compare('p_id',$this->p_id);

		$criteria->compare('p_title',$this->p_title,true);

		$criteria->compare('p_description',$this->p_description,true);

		$criteria->compare('p_remark',$this->p_remark,true);

		$criteria->compare('p_tag',$this->p_tag,true);

		$criteria->compare('p_url',$this->p_url,true);

		$criteria->compare('p_buildingid',$this->p_buildingid);

		$criteria->compare('p_type',$this->p_type);

		$criteria->compare('p_uploadtime',$this->p_uploadtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    public function getPanorama($buildingId,$pType,$p_ptype){
        $dba = dba();
        $panoramas = $dba->select("select * from `35_panorama` where `p_buildingid`=? and `p_type`=? and `p_ptype`=?",$buildingId,$pType,$p_ptype);
        return $panoramas;
    }
    /**
     *得到楼盘首页全景
     * @param <type> $buildId  楼盘id
     * @return <type> 
     */
    public function getTitlePanoramaByBuildId($buildId){
        $url = "";
        $buildInfo = Systembuildinginfo::model()->findByPk($buildId);
        if($buildInfo){
            $panoramaId = $buildInfo->sbi_titlepanorama;
            if($panoramaId){
                $panoramaInfo = $this->findByPk($panoramaId);
                if($panoramaInfo){
                    $url = $panoramaInfo->p_url;
                }
            }
        }
        return $url;
    }
    /**
     *判断全景缩略图是否存在，存在则返回缩略图，不存在则返回默认图片
     * @param <type> $panoramaUrl 数据库中的全景地址
     * @return <string> 缩略图地址
     */
    public function getThumbnailUrl($panoramaUrl){
        $return = $panoramaUrl.self::$thumbnail;
        if(!file_exists(PIC_PATH.$return)){//如果缩略图不存在
            $return = "/panorama/default".self::$thumbnail;
        }
        return PIC_URL.$return;
    }

    /**
     *得到首页的全景足迹
     */
     public function getIndexPanorama($limit=8){
        $criteria = new CDbCriteria;
        $criteria->limit=$limit;
        $criteria->order= "p_uploadtime desc";
        return self::model()->findAll($criteria);
    }
    /**
     *得到首页的全景
     * @param  $p_buildingid 楼盘地址
     * @param  $p_ptype 1楼盘，2小区
     */
    public function getPanoramaById($p_buildingid,$p_ptype,$limit=6){
        $criteria = new CDbCriteria;
        $criteria->limit=$limit;
        $criteria->order= "p_uploadtime asc";
        $criteria->addColumnCondition(array("p_buildingid"=>$p_buildingid,"p_ptype"=>$p_ptype));
        return self::model()->findAll($criteria);
    }
    /**
     * 得到资源的所有全景
     * @param  $p_buildingid 楼盘地址
     * @param  $p_ptype 1楼盘，2小区
     * @return <array> 
     */
    public function getAllPanoByIdAndType($p_buildingid, $p_ptype){
        $return = array();
        $criteria = new CDbCriteria;
        $criteria->order= "p_type desc, p_uploadtime desc";
        $criteria->addColumnCondition(array("p_buildingid"=>$p_buildingid,"p_ptype"=>$p_ptype));
        $model = $this->findAll($criteria);
        if($model){
            foreach($model as $value){
                $return[] = array(
                    "pano"=>$value->p_url,
                    "title"=>$value->p_title,
                );
            }
        }
        return $return;
    }
}