<?php

/**
 * This is the model class for table "{{panoxml}}".
 *
 * The followings are the available columns in table '{{panoxml}}':
 * @property integer $px_id
 * @property integer $px_sourceid
 * @property integer $px_sourcetype
 * @property string $px_xmlurl
 * @property integer $px_updatetime
 */
class Panoxml extends CActiveRecord
{
    /*
     * 资源类型
     */
    public static $px_sourcetype=array(
        "1"=>"楼盘",
        "2"=>"小区",
        "3"=>"写字楼",
        "4"=>"商铺",
        "5"=>"住宅",
        "6"=>"商务中心",
        "7"=>"创意园区",
        "8"=>"创意园区房源",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Panoxml the static model class
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
		return '{{panoxml}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('px_sourcetype, px_xmlurl, px_updatetime', 'required'),
			array('px_sourceid, px_sourcetype, px_updatetime', 'numerical', 'integerOnly'=>true),
			array('px_xmlurl', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('px_id, px_sourceid, px_sourcetype, px_xmlurl, px_updatetime', 'safe', 'on'=>'search'),
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
			'px_id' => 'Px',
			'px_sourceid' => 'Px Sourceid',
			'px_sourcetype' => 'Px Sourcetype',
			'px_xmlurl' => 'Px Xmlurl',
			'px_updatetime' => 'Px Updatetime',
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

		$criteria->compare('px_id',$this->px_id);

		$criteria->compare('px_sourceid',$this->px_sourceid);

		$criteria->compare('px_sourcetype',$this->px_sourcetype);

		$criteria->compare('px_xmlurl',$this->px_xmlurl,true);

		$criteria->compare('px_updatetime',$this->px_updatetime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 通过资源id和资源类型，获取包含该资源所有全景的xml文件。文件有效期为30分钟。
     * @param <type> $sourceId 资源id
     * @param <type> $sourceType 资源类型 1楼盘 2小区 3写字楼 4商铺 5住宅 6商务中心 7创意园区 8创意园区房源
     * @return <string> 返回xml文件地址 xml文件统一放在upload目录下
     */
    public function getPanoXml($sourceId, $sourceType){
        $time = time();
        $model = $this->findByAttributes(array("px_sourceid"=>$sourceId,"px_sourcetype"=>$sourceType));
        if($model){//如果有记录，要判断最后更新时间是否有效
            if($model->px_updatetime+1800>$time){//xml文件还没有过期。使用记录中的值
                $panoFileUrl = $model->px_xmlurl;
            }else{//xml文件已经过期，重新生成xml文件
                $oldFileName = $model->px_xmlurl;
                $panoFileUrl = $this->createPanoXmlFile($sourceId, $sourceType);
                $model->px_xmlurl = $panoFileUrl;
                $model->px_updatetime = $time;
                $model->update();
            }
        }else{//没有记录，则新建记录
            $panoFileUrl = $this->createPanoXmlFile($sourceId, $sourceType);
            $model = new Panoxml();
            $model->px_sourceid = $sourceId;
            $model->px_sourcetype = $sourceType;
            $model->px_xmlurl = $panoFileUrl;
            $model->px_updatetime = $time;
            $model->save();
        }
        return PIC_URL.$panoFileUrl;
    }
    /**
     *检查此id是否在此类型下有全景
     * @param <type> $sourceId 资源id
     * @param <type> $sourceType 资源类型 1楼盘 2小区 3写字楼 4商铺 5住宅 6商务中心 7创意园区 8创意园区房源
     * @return <boolean>
     */
    public function checkHavePano($sourceId, $sourceType){
        $panoArr = $this->getXmlFileContent($sourceId, $sourceType);
        if($panoArr){
            return true;
        }else{
            return false;
        }
    }
    /**
     *返回xml文件名称
     * @param <type> $sourceId
     * @param <type> $sourceType 1楼盘2小区3写字楼4商铺5住宅6商务中心7创意园区 8创意园区房源
     * @return <type>
     */
    private function createPanoXmlFile($sourceId, $sourceType){
        $panoArr = $this->getXmlFileContent($sourceId, $sourceType);
        $panoFileName = $sourceId."_".$sourceType."_".time().".xml";
        $panoFileUrl = $this->writeXmlFile($panoArr, $panoFileName);
        return $panoFileUrl;
    }
    /**
     * 获得本id所有的全景资源
     * @param <type> $sourceId
     * @param <type> $sourceType 1楼盘2小区3写字楼4商铺5住宅6商务中心 7创意园区 8创意园区房源
     * @return <type>
     */
    private function getXmlFileContent($sourceId, $sourceType){
        $panoArr = array();
        switch($sourceType){
            case 1://楼盘
                $panoArr = Panorama::model()->getAllPanoByIdAndType($sourceId, 1);
                break;
            case 2://小区
                $panoArr = Panorama::model()->getAllPanoByIdAndType($sourceId, 2);
                break;
            case 3://写字楼
                $panoArr = Subpanorama::model()->getAllPanoByIdAndType($sourceId, 1);
                break;
            case 4://商铺
                $panoArr = Subpanorama::model()->getAllPanoByIdAndType($sourceId, 2);
                break;
            case 5://住宅
                $panoArr = Subpanorama::model()->getAllPanoByIdAndType($sourceId, 4);
                break;
            case 6://商务中心
                $panoArr = Subpanorama::model()->getAllPanoByIdAndType($sourceId, 1);
                break;
            case 7: //创意园区
                $panoArr = Panorama::model()->getAllPanoByIdAndType($sourceId, 3);
                break;
            case 8: //创意园区房源
                $panoArr = Subpanorama::model()->getAllPanoByIdAndType($sourceId, 5);
                break;
            default:
                break;
        }
        return $panoArr;
    }
    /**
     *生成xml文件
     * @param <type> $panoArr
     * @param <type> $panoFileName xml文件名
     * @return <type>
     */
    private function writeXmlFile($panoArr, $panoFileName){
        $panoPath = "/panoxml/".date("ym")."/";
        $panoFileUrl = $panoPath.$panoFileName;
        if(!is_dir(PIC_PATH.$panoPath)){
            mkdir(PIC_PATH.$panoPath);
        }
        $str = '<?xml version="1.0" encoding="UTF-8" ?><dibiao>';
        if($panoArr){
            $str .="<default>";
            $defaultId = substr($panoArr[0]['pano'], strrpos($panoArr[0]['pano'], "/")+1);
            $str .="<panoId>".$defaultId."</panoId><panoDomain>".PIC_URL."/panorama</panoDomain>";
            $str .="</default><panos>";
            foreach($panoArr as $key=>$value){
                $panoId = substr($value['pano'], strrpos($value['pano'], "/")+1);
                $str .= '<pano image="'.Panorama::model()->getThumbnailUrl($value['pano']).'" panoId="'.$panoId.'" title="'.common::strCut($value['title'], 15, "").'" />';
            }
            $str .="</panos>";
        }
        $str .='</dibiao>';
        $fp = fopen(PIC_PATH.$panoFileUrl, "w+");
        fputs($fp,$str);//向文件中写入内容;
        fclose($fp);
        return $panoFileUrl;
    }
}