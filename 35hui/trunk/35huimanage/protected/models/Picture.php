<?php

/**
 * This is the model class for table "{{picture}}".
 *
 * The followings are the available columns in table '{{picture}}':
 * @property integer $p_id
 * @property integer $p_sourceid
 * @property integer $p_sourcetype
 * @property integer $p_type
 * @property string $p_img
 * @property string $p_tinyimg
 * @property integer $p_uploadtime
 */
class Picture extends CActiveRecord
{
    public static $sourceType = array(
        'systembuilding'=>1,//楼盘
        'officebaseinfo'=>2,//写字楼
    	'businesscenter'=>3,//商务中心
        'factorybaseinfo'=>4,
    	'shopbaseinfo'=>5,
    	'projectbaseinfo'=>6,
        'communitybaseinfo'=>7,
        'residencebaseinfo'=>8,//住宅
        "cyparkbaseinfo"=>9,//创意园区
        "cyparksource"=>10,//创意园区房源
    );
    public static $sourceDescription = array(
        1=>"楼盘",
        2=>"写字楼",
        3=>"商务中心",
        4=>"工业厂房",
        5=>"商铺",
        6=>"大型项目",
        7=>"小区",
        8=>"住宅",
    );
    public static $picType = array(
        'ichnograph'=>1,//房型图
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
	 * Returns the static model of the specified AR class.
	 * @return Picture the static model class
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
			array('p_id', 'required'),
			array('p_id, p_sourceid, p_sourcetype, p_type, p_uploadtime', 'numerical', 'integerOnly'=>true),
			array('p_img, p_tinyimg', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('p_id, p_sourceid, p_sourcetype, p_type, p_img, p_tinyimg, p_uploadtime,p_title', 'safe', 'on'=>'search'),
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
			'p_id' => '主键Id',
			'p_sourceid' => '房源Id',
			'p_sourcetype' => '房源类型',
			'p_type' => '图片类型',
            "p_title"=>"图片标题",
			'p_img' => '图片完整路径',
			'p_tinyimg' => '缩略图路径',
			'p_uploadtime' => '上传时间',
            'p_quote' => '是否引用',
            'p_check' => '',
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

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
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
     * 返回根据图片类型分类的图片结果集
     * @param <type> $sourceId
     * @param <type> $sourceType
     * @param <type> $picType
     * @return <type>
     */
    public function getFormatPicturesByCondition($sourceId,$sourceType,$picType=0){
        $result = array();
        $activeData = $this->getPicturesByCondition($sourceId, $sourceType,$picType);
        foreach($activeData as $pictureModel){
                $result[$pictureModel->p_type][] = $pictureModel;
        }
        return $result;
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
     * 根据房源id和房源类型得到房源名称
     * @param <type> $sourceId 房源id
     * @param <type> $sourceType 房源类型
     * @return <string>
     */
    public function getSourceName($sourceId,$sourceType){
        $source = $this->findSourceByCondition($sourceId, $sourceType);
        if($source){
            if($sourceType==self::$sourceType['systembuilding']){
                return $source->sbi_buildingname;
            }elseif($sourceType==self::$sourceType['officebaseinfo']){
                return $source->op_officetitle;
            }elseif($sourceType==self::$sourceType['businesscenter']){
                return $source->bc_name;
            }elseif($sourceType==self::$sourceType['communitybaseinfo']){
                return $source->comy_name;
            }
        }else{
            return "";
        }
    }
    /**
     * 根据房源id和房源类型得到房源信息
     * @param <type> $sourceId 房源id
     * @param <type> $sourceType 房源类型
     * @return <type>
     */
    public function findSourceByCondition($sourceId,$sourceType){
        if(isset($sourceId) && in_array($sourceType, self::$sourceType)){
            if($sourceType==self::$sourceType['systembuilding']){
                $systemBuilding = Systembuildinginfo::model()->findByPk($sourceId);
                return $systemBuilding;
            }elseif($sourceType==self::$sourceType['officebaseinfo']){
                $officePrentInfo = Officepresentinfo::model()->findByAttributes(array('op_officeid'=>$sourceId));
                return $officePrentInfo;
            }elseif($sourceType==self::$sourceType['businesscenter']){
                return Businesscenter::model()->findByPk($sourceId);
            }elseif($sourceType==self::$sourceType['communitybaseinfo']){
                $officePrentInfo = Communitybaseinfo::model()->findByAttributes(array('comy_id'=>$sourceId));
                return $officePrentInfo;
            }
        }
        return null;
    }
    /**
     * 得到以id为键,名称为值的array(供dropDownList使用)
     * @param <int> $sourceType 房源类型
     * @return <array>
     */
    public function findAllSourceNameByType($sourceType){
        $result = array();
        if(in_array($sourceType, self::$sourceType)){
            $dba = dba();
            if($sourceType==self::$sourceType['systembuilding']){
                $systemBuildingInfo = Systembuildinginfo::model()->findAll();
                foreach($systemBuildingInfo as $info){
                    $result[$info->sbi_buildingid]=$info->sbi_buildingname;
                }
            }elseif($sourceType==self::$sourceType['officebaseinfo']){
                $officeInfo = Officebaseinfo::model()->findAll();
                foreach($officeInfo as $info){
                    $result[$info->ob_officeid]=$info->ob_officename;
                }
            }elseif($sourceType==self::$sourceType['communitybaseinfo']){
                $communitybaseinfo = Communitybaseinfo::model()->findAll();
                foreach($communitybaseinfo as $info){
                    $result[$info->comy_id]=$info->comy_name;
                }
            }
        }
        return $result;
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
//        $path = "/test/";
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
     * 根据房源id和房源类型返回查看的链接
     * @param <type> $sourceId
     * @param <type> $sourceType
     * @return <type>
     */
    public function realSourceViewLink($sourceId,$sourceType){
        $link = array("#");
        if($sourceId && $sourceType){
            if($sourceType==self::$sourceType['systembuilding']){
                $link = array('systembuildinginfo/view','id'=>$sourceId);
            }elseif($sourceType==self::$sourceType['officebaseinfo']){
                $link = array('officebaseinfo/view','id'=>$sourceId);
            }elseif($sourceType==self::$sourceType['businesscenter']){
                $link = array('businesscenter/view','id'=>$sourceId);
            }elseif($sourceType==self::$sourceType['communitybaseinfo']){
                $link = array('communitybaseinfo/view','id'=>$sourceId);
            }
        }
        return $link;
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
     *录入房源时添加照片
     * @param <type> $picture
     * @param <type> $offiid
     * @param <type> $sourcetype 
     */
    public function insertImg($picture,$officeId,$sourcetype){
        $titlePic = "";//标题图
        if($picture['titlepic']){
            $titlePic = $picture['titlepic'];
        }
        if($picture['ichnograph']){//添加平面图
            $pictureArray = explode("|",$picture['ichnograph']);
            $type = self::$picType['ichnograph'];
            $this->insertOneTypePicture($pictureArray,$type,$officeId,$sourcetype,$titlePic);
        }
        if($picture['outdoor']){//添加外景图
            $pictureArray = explode("|",$picture['outdoor']);
            $type = self::$picType['outdoor'];
            $this->insertOneTypePicture($pictureArray,$type,$officeId,$sourcetype,$titlePic);
        }
        if($picture['indoor']){//添加内景图
            $pictureArray = explode("|",$picture['indoor']);
            $type = self::$picType['indoor'];
            $this->insertOneTypePicture($pictureArray,$type,$officeId,$sourcetype,$titlePic);
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
    private function insertOneTypePicture($pictureArray,$type,$officeId,$sourcetype,$titlePic){
        $dba = dba();
        if($pictureArray && $type!=0){
            for($i=1;$i<count($pictureArray);$i++){
                $pictureModel = new Picture();
                $pictureModel->p_id = $dba->id('35_picture');
                $pictureModel->p_sourceid = $officeId;
                $pictureModel->p_sourcetype = $sourcetype;
                $pictureModel->p_type = $type;
                $pictureModel->p_img = $pictureArray[$i];
                $pictureModel->p_tinyimg = $pictureArray[$i];
                $pictureModel->p_uploadtime = time();
                $pictureModel->save();

                //查看是否是标题图
                if($pictureArray[$i]==$titlePic){
                    switch ($sourcetype){
                        case Picture::$sourceType['systembuilding'] :
                            break;
                        case Picture::$sourceType["officebaseinfo"] :
                            $model = Officepresentinfo::model()->findByAttributes(array('op_officeid'=>$officeId));
                            $model->op_titlepicurl = $pictureModel->p_id;
                            $model->save();
                            break;
                        case Picture::$sourceType['businesscenter'] :
                            $model = Businesscenter::model()->findByPk($officeId);
                            $model->bc_titlepic = $pictureModel->p_id;
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
                    }
                }
            }
        }
    }
    /**
     * 展示图片
     * @param <string> $path 原始图片路径
     * @param <string> $suffix 添加的后缀名
     * @return <string>
     */
    public static function showStandPic($path,$suffix){
        $separatorIndex = strrpos($path, ".");
        $fileName = substr($path, 0,$separatorIndex);//.号之前的,不包括.
        $extention = substr($path, $separatorIndex);//.号之后的,包括.
        return $fileName.$suffix.$extention;
    }

    public function getNum($p_img) {
        $dba = dba();
        $num = $dba->select_one("select count(*) from 35_picture where p_img=?",$p_img);
        return $num;
    }
    /**
     * 根据 source 给用户通知
     * @param array $source
     */
    public function sendPicDelMsg(array $source){
        $connection = Yii::app()->db;
        $_uidSourceid=array();
        foreach($source as $key=>$val){
            $sql='';
            switch ($key) {
                case '2':
                    $sql="SELECT `ob_uid` AS uid,`p_sourceid` AS id FROM {{picture}} t1 LEFT JOIN {{officebaseinfo}} t2 ON t1.p_sourceid=t2.ob_officeid
                        WHERE t1.p_id";
                    break;
                case '5':
                    $sql="SELECT `sb_uid` AS uid,`p_sourceid` AS id FROM {{picture}} t1 LEFT JOIN {{shopbaseinfo}} t2 ON t1.p_sourceid=t2.sb_shopid
                        WHERE t1.p_id";
                    break;
                case '8':
                    $sql="SELECT `rbi_uid` AS uid,`p_sourceid` AS id FROM {{picture}} t1 LEFT JOIN {{residencebaseinfo}} t2 ON t1.p_sourceid=t2.rbi_id
                        WHERE t1.p_id";
                    break;
            }
            
            if($sql){
                $sql .= " IN(".implode(',', array_unique($val)).");";
                $rs=$connection->createCommand($sql)->queryAll();
                if(empty($rs)) continue;
                foreach($rs as $_val){
                    $_uidSourceid[$_val['uid']][$key][]=$_val['id'];
                }
            }
        }
        //print_r($_uidSourceid);
        foreach ($_uidSourceid as $uid=>$val) {
            foreach($val as $_k=>$_v){
                $old=$connection->createCommand("SELECT * FROM {{msgfang}} WHERE `mf_uid`='{$uid}' AND `mf_type`='{$_k}' AND `mf_ttg`=0")->queryRow();
                if($old){
                    $mf_msg=$old['mf_msg'].','.implode(',', $_v);
                    $mf_msg=implode(',',array_unique(explode(',', $mf_msg)));
                    $update="UPDATE {{msgfang}} SET `mf_title`=`mf_title`+".count($_v).",`mf_msg`='{$mf_msg}',`mf_tm`=".time()." WHERE `mf_id`={$old['mf_id']} ";
                    //echo $update;
                    $connection->createCommand($update)->execute();
                }else{
                    $insert="INSERT {{msgfang}} (`mf_type`,`mf_uid`,`mf_title`,`mf_msg`,`mf_tm`)
                        VALUES('{$_k}','{$uid}','".count($_v)."','".implode(',', array_unique($_v))."','".time()."');";
                    //echo $insert;
                    $connection->createCommand($insert)->execute();
                }
            }
        }
    }
}