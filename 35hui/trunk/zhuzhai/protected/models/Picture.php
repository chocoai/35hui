<?php

class Picture extends CActiveRecord
{
    public static $sourceType = array(
        'systembuilding'=>1,//楼盘
        'officebaseinfo'=>2,//写字楼
    	'businesscenter'=>3,//商务中心
        'factorybaseinfo'=>4,
    	'shopbaseinfo'=>5,//商铺
    	'projectbaseinfo'=>6,
    	'communitybaseinfo'=>7,
        'residencebaseinfo'=>8,//住宅
        "cyparkbaseinfo"=>9,//创意园区
        "cyparksource"=>10,//创意园区房源
    );
    public static $picType = array(
        'ichnograph'=>1,//平面图
        'outdoor'=>2,//外景图
        'indoor'=>3,//内景图
    );

    public static $typeDescription = array(
        1=>'平面图',
        2=>'外景图',
        3=>'室内图',
    );
    //图片路径
    public static $typePath = array(
        1=>'/ichnopic/',//房型图
        2=>'/outdoorpic/',//外景图
        3=>'/indoorpic/',//内景图
    );
	/**
	 * The followings are the available columns in table '{{picture}}':
	 * @var integer $p_id
	 * @var integer $p_sourceid
	 * @var integer $p_sourcetype
	 * @var integer $p_type
	 * @var string $p_img
	 * @var string $p_tinyimg
	 * @var integer $p_uploadtime
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
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
		return '{{picture}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('p_id, p_sourceid, p_sourcetype, p_type, p_uploadtime', 'numerical', 'integerOnly'=>true),
			array('p_img, p_tinyimg', 'length', 'max'=>200),
            array('p_title','length','max'=>50,'encoding'=>'UTF-8'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('p_id, p_sourceid, p_sourcetype, p_type, p_img, p_tinyimg, p_uploadtime', 'safe', 'on'=>'search'),
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
			'p_id' => 'P',
			'p_sourceid' => 'P Sourceid',
			'p_sourcetype' => 'P Sourcetype',
			'p_type' => 'P Type',
            'p_title' => 'P Title',
			'p_img' => 'P Img',
			'p_tinyimg' => 'P Tinyimg',
			'p_uploadtime' => 'P Uploadtime',
            'p_quote' => 'P Quote',
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

		$criteria->compare('p_sourceid',$this->p_sourceid);

		$criteria->compare('p_sourcetype',$this->p_sourcetype);

		$criteria->compare('p_type',$this->p_type);

		$criteria->compare('p_img',$this->p_img,true);

		$criteria->compare('p_tinyimg',$this->p_tinyimg,true);

		$criteria->compare('p_uploadtime',$this->p_uploadtime);

		return new CActiveDataProvider('picture', array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 根据标题图的id,去得到对应的图片信息
     * @param <int> $titlePicInt 标题图片的id
     * @param <string> $suffix 后缀名
     * @return <string> 返回的图片路径
     */
    public function getPicByTitleInt($titlePicInt,$suffix=""){
        if($titlePicInt){
            $picInfo = $this->findByPk($titlePicInt);
            if($picInfo){
                if($suffix){
                    $picUrl = $this->showStandPic($picInfo->p_img, $suffix);
                    return PIC_URL.$picUrl;
                }else{
                    return PIC_URL.$picInfo->p_img;
                }
            }else{
                return IMAGE_URL."/default/build_default.jpg";
            }
        }else{
            return IMAGE_URL."/default/build_default.jpg";
        }
    }
    /**
     * 得到出来标题图之外的其他随便一张图片
     * @param <type> $soureId
     * @param <type> $souceType
     * @param <type> $titlePicInt 标题图ID
     * @param <type> $suffix 后缀
     * @return <type>
     */
    public function getOnePicExceptTitleInt($soureId,$souceType,$titlePicInt,$suffix=""){
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("p_sourceid"=>$soureId,"p_sourcetype"=>$souceType));
        if($titlePicInt){
            $criteria->addCondition("p_id!=".$titlePicInt);
        }
        $model = $this->find($criteria);
        
        if($model){
            if($suffix){
                $picUrl = $this->showStandPic($model->p_img, $suffix);
                return PIC_URL.$picUrl;
            }else{
                return PIC_URL.$model->p_img;
            }
        }else{
            return IMAGE_URL."/default/build_default.jpg";
        }
    }
    /**
     * 得到平面图
     * @param <int> $soure_id 房源id
     * @param <int> $souce_type 房源类型
     * @return <object> CActiveRecord
     */
    public function getIchnographPictures($soure_id,$souce_type){
        return $this->findAllByAttributes(array('p_sourceid'=>$souce_id,'p_sourcetype'=>$souce_type,'p_type'=>self::$picType['ichnograph']));
    }
    /**
     * 得到外景图
     * @param <int> $soure_id 房源id
     * @param <int> $souce_type 房源类型
     * @return <object> CActiveRecord
     */
    public function getOutDoorPictures($soure_id,$souce_type){
        return $this->findAllByAttributes(array('p_sourceid'=>$souce_id,'p_sourcetype'=>$souce_type,'p_type'=>self::$picType['outdoor']));
    }
    /**
     * 得到内景图
     * @param <type> $soure_id 房源id
     * @param <type> $souce_type 房源类型
     * @return <type> CActiveRecord
     */
    public function getInDoorPictures($soure_id,$souce_type){
        return $this->findAllByAttributes(array('p_sourceid'=>$souce_id,'p_sourcetype'=>$souce_type,'p_type'=>self::$picType['indoor']));
    }
    /**
     * 根据房源id,房源类型和图片类型得到图片集合
     * @param <int> $soure_id 房源id
     * @param <int> $souce_type 房源类型
     * @param <int> $pic_type 图片类型
     * @return <object>
     */
    public function getPicturesByType($source_id,$source_type,$pic_type){
        return $this->findAllByAttributes(array('p_sourceid'=>$source_id,'p_sourcetype'=>$source_type,'p_type'=>$pic_type));
    }
    /**
     * 根据房源id和类型得到所有的图片,并分好结构
     * @param <type> $soure_id 房源id
     * @param <type> $souce_type 房源类型
     * @param <type> $pictype 图片类型 。默认取全部
     * @return <array> 多维数组,一维键名是房源类型,对应的就是图片数据array了
     */
    public function getAllPictures($source_id,$source_type, $pictype="all"){
        $dba = dba();
        $sql = "SELECT * FROM `35_picture` WHERE `p_sourceid`=".$source_id." AND `p_sourcetype`=".$source_type;
        if($pictype!="all"){
            $sql .= " and p_type=".$pictype;
        }
        $pictures = $dba->select($sql);
        $pictures = $this->assort($pictures);//重置一下结构
        return $pictures;
    }
    protected function assort($pictures){
        $result=array();
        foreach(self::$picType as $p){
            $result[$p]=array();
        }
        foreach($pictures as $picture){
            if(array_key_exists($picture['p_type'],$result)){
                array_push($result[$picture['p_type']],$picture);
            }else{
                $result[$picture['p_type']][0]=$picture;
            }
        }
        return $result;
    }
    /**
     * 将ActiveRecord格式的图片数组转换成只有大小图的数组
     * @param <ActiveRecord> $pictureActiveRecord ActiveRecord格式的图片数据
     * @param <boolean> 是否是全路径,ture则返回的图片路径是全路径,false则为相对路径
     * @return <array> 二维数组,一维键为自动数字,二维键为large和tiny
     */
    public function getImgArrayByActiveRecord($pictureActiveRecord,$fullPath=true){
        $picArray = array();
        $domainString = "";
        if($fullPath){
            $domainString = PIC_URL;
        }
        foreach($pictureActiveRecord as $record){
            $picture['large']=$this->showStandPic($domainString.$record->p_img,"_large");
            $picture['tiny']=$this->showStandPic($domainString.$record->p_img,"_thumb");
            $picArray[$record->p_id]=$picture;
        }
        return $picArray;
    }
    /**
     * 此方法因为要插入标题图片，所以只能在展示信息保存完之后才能调用
     * @param <type> $sourcetype 房源类型
     */
    public function insertImg($picture,$officeId,$sourcetype){
        $titlePic = "";//标题图
        if($picture['titlepic']){
            $titlePic = $picture['titlepic'];
        }
//        if($picture['ichnograph']){//添加平面图
//            $pictureArray = explode("|",ltrim($picture['ichnograph'],"|"));
//            $type = self::$picType['ichnograph'];
//            $this->insertOneTypePicture($pictureArray,$type,$officeId,$sourcetype,$titlePic);
//        }
//        if($picture['outdoor']){//添加外景图
//            $pictureArray = explode("|",ltrim($picture['outdoor'],"|"));
//            $type = self::$picType['outdoor'];
//            $this->insertOneTypePicture($pictureArray,$type,$officeId,$sourcetype,$titlePic);
//        }
        if($picture['indoor']){//添加内景图
            $pictureArray = explode("|",ltrim($picture['indoor'],"|"));
            $type = self::$picType['indoor'];
            $this->insertOneTypePicture($pictureArray,$type,$officeId,$sourcetype,$titlePic);
        }
        if( ! empty($picture['baseimg']) ){
            $pictureArray = explode("|",ltrim($picture['baseimg'],"|"));
            $_pictureArray = array();
            foreach ($pictureArray as $pic) {
                $type = NULL;
                if(preg_match("/indoorpic/", $pic))
                    $type = self::$picType['indoor'];
                elseif(preg_match("/outdoorpic/", $pic))
                    $type = self::$picType['outdoor'];
                elseif(preg_match("/ichnopic/", $pic))
                    $type = self::$picType['ichnograph'];
                if($type)
                    $_pictureArray[$type][] = $pic;
            }
            foreach ($_pictureArray as $key => $value) {
                $this->insertOneTypePicture($value,$key,$officeId,$sourcetype,$titlePic,'1');
            }
        }
    }
    /**
     * 插入某一种类型的图片
     * @param <type> $pictureArray 图片数组
     * @param <type> $type 图片类型
     * @param <type> $officeId 房源id
     * @param <type> $sourcetype 房源类型
     * @param <type> $titlePic 标题图
     */
    private function insertOneTypePicture($pictureArray,$type,$officeId,$sourcetype,$titlePic,$p_quote='0'){
        $dba = dba();
        if($pictureArray && $type!=0){
            for($i=0;$i<count($pictureArray);$i++){
                $pictureModel = new Picture();
                $img = explode(',', $pictureArray[$i]);
                $pictureModel->p_id = $dba->id('35_picture');
                $pictureModel->p_sourceid = $officeId;
                $pictureModel->p_sourcetype = $sourcetype;
                $pictureModel->p_type = $type;
                $pictureModel->p_title = isset($img[1])?$img[1]:'';
                $pictureModel->p_img = $img[0];
                $pictureModel->p_tinyimg = $img[0];
                $pictureModel->p_uploadtime = time();
                $pictureModel->p_quote = $p_quote;
                $pictureModel->save();

                //查看是否是标题图
                if($pictureModel->p_img==$titlePic){
                    switch ($sourcetype){
                        case Picture::$sourceType['systembuilding'] :
                            break;
                        case Picture::$sourceType["officebaseinfo"] :
                            $model = Officebaseinfo::model()->findByPk($officeId);
                            $model->ob_titlepicurl = $pictureModel->p_id;
                            $model->save();
                            break;
                        case Picture::$sourceType['factorybaseinfo'] :
                            break;
                        case Picture::$sourceType['shopbaseinfo'] :
                            $model = Shoppresentinfo::model()->findByAttributes(array('sp_shopid'=>$officeId));
                            $model->sp_titlepicurl = $pictureModel->p_id;
                            $model->save();
                            break;
                        case Picture::$sourceType['projectbaseinfo'] :
                            break;
                        case Picture::$sourceType['residencebaseinfo'] :
                            $model = Residencebaseinfo::model()->findByAttributes(array('rbi_id'=>$officeId));
                            $model->rbi_titlepicurl = $pictureModel->p_id;
                            $model->save();
                            break;
                        case Picture::$sourceType['cyparksource'] :
                            $model = Creativesource::model()->findByPk($officeId);
                            $model->cr_titlepicurl = $pictureModel->p_id;
                            $model->save();
                            break;
                    }
                }
            }
        }
    }
    /**
     * 删除文件
     * @param <string> $path 完整的文件路径
     * @param <array> $picNorm 图片处理规格
     * @return <bool>
     */
    public function deleteFile($path,$picNorm=array()){
        $picArray = array();//附加的规格图
        if($path){
            $separatorIndex = strripos($path, ".");
            $fileName = substr($path, 0,$separatorIndex);//.号之前的,不包括.
            $extention = substr($path, $separatorIndex);//.号之后的,包括.
            foreach($picNorm as $norm){
                $picArray[] = $fileName.$norm['suffix'].$extention;
            }
            $result = @unlink($path);//删除原图
            if($result){//如果原图删除成功,就删除其他规格图片,并且返回true
                foreach($picArray as $file){
                    @unlink($file);
                }
                return true;
            }
        }
        return false;
    }
    /**
     * 生成新的图片文件名
     * @param <string> $filename 原文件名称
     * @return <string> 新的文件名称
     */
    public function imageName($filename,$prefixStr=""){
        $newName = "";//新的图片名称
        if($filename){
            $index = strripos($filename,".");//包含小数点的后缀名
            $suffix = substr($filename, $index);
            $randNum = mt_rand(0,100);//随机数
            $newName = strval(time()).strval($randNum).$suffix;//时间戳和随机数生成的新文件名
            if($prefixStr){//加上前缀
                $newName = $prefixStr.$newName;
            }
        }
        return strtolower($newName);
    }
    /**
     * 根据图片类型返回图片类型路径
     * @param <int> $picType
     * @return <string>
     */
    public function picTypePath($picType){
        $path = @self::$typePath[$picType];
        $path .= date("Y")."/";
        if(!is_dir(PIC_PATH.$path)){
            mkdir(PIC_PATH.$path);
        }
        $path .= date("md")."/";
        if(!is_dir(PIC_PATH.$path)){
            mkdir(PIC_PATH.$path);
        }
        return $path;
    }
    /**
     * 展示图片
     * @param <string> $path 原始图片路径
     * @param <string> $suffix 添加的后缀名
     * @return <string>
     */
    public static function showStandPic($path,$suffix){
        if($path){
            $separatorIndex = strrpos($path, ".");
            $fileName = substr($path, 0,$separatorIndex);//.号之前的,不包括.
            $extention = substr($path, $separatorIndex);//.号之后的,包括.
            return $fileName.$suffix.$extention;
        }
    }
    /**
     * 根据条件来检验图片是否在指定的条件中
     * @param <int> $picId 图片id
     * @param <int> $sourceId 房源id
     * @param <int> $sourceType 房源类型
     * @param <int> $picType 图片类型
     * @return <boolean>
     */
    public function checkPictureByCondition($picId,$sourceId,$sourceType,$picType=0){
        $criteria=new CDbCriteria(array(
            'condition'=>'p_id=:picId AND p_sourceid=:sourceId AND p_sourcetype=:sourceType',
            'params'=>array(
                ':picId'=>$picId,
                ':sourceId'=>$sourceId,
                ':sourceType'=>$sourceType,
            )
        ));
        if($picType!=0){
            $criteria->addSearchCondition('p_type',$picType);
        }
        $cou = $this->count($criteria);
        if($cou>0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 根据条件来得到图片结果集
     * @param <type> $sourceId 房源id
     * @param <type> $sourceType 房源类型
     * @param <type> $picType 图片类型
     * @return <ActiveRecord>
     */
    public function getPicturesByCondition($sourceId,$sourceType,$picType=0){
        $conditionArray = array(
            'p_sourceid'=>$sourceId,
            'p_sourcetype'=>$sourceType,
        );
        //如果指明媒体类型,则添加上该条件
        if($picType){
            $conditionArray['p_type']=$picType;
        }
        return $this->findAllByAttributes($conditionArray);
    }
    /**
     * 根据条件来判断是否有图片房源
     * @param <type> $sourceId 房源id
     * @param <type> $sourceType 房源类型
     * @return <integer>
     */
    public  function  isHavePicture($sourceId,$sourceType){
        return Picture::model()->count('p_sourceid=:p_sourceid AND p_sourcetype=:p_sourcetype',array(":p_sourceid"=>$sourceId,'p_sourcetype'=>$sourceType));
    }
}