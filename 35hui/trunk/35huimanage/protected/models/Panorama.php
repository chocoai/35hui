<?php
Yii::import('application.common.*');
require_once('Zip.php');
require_once('ZipPeter.php');
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
    /*-- 全景类型 --*/
    public static $typeDescription = array(
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
			array('p_buildingid,p_url,p_title', 'required'),
			array('p_id, p_buildingid, p_type, p_uploadtime', 'numerical', 'integerOnly'=>true),
			array('p_title, p_tag, p_url', 'length', 'max'=>200),
			array('p_description, p_remark', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('p_id, p_title, p_description, p_remark, p_tag, p_url, p_buildingid, p_type, p_uploadtime', 'safe', 'on'=>'search'),
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
			'p_url' => '全景唯一地址',
			'p_buildingid' => '所属资源',
			'p_type' => '全景类型',
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
    /**
     * 根据条件返回全景资源数量
     * @param <int> $buildingId 楼盘Id
     * @param <int> $panoramaType 全景类型
     * @return <int> 全景资源数量
     */
    public function getPanoramaCount($buildingId,$panoramaType=null){
        $panoramaCounts =0;//全景资源视频
        if(isset($buildingId)){
            $criteria=new CDbCriteria(array(
                'condition'=>'p_buildingid=:buildingId',
                'params'=>array(':buildingId'=>$buildingId)
            ));
            if($panoramaType){
                $criteria->addColumnCondition(array('p_type'=>$panoramaType));
            }
            $panoramaCounts = $this->count($criteria);
        }
        return $panoramaCounts;
    }
    /**
     * 在制定的路径下,新建以id命名的文件夹
     * @param <string> $path 路径
     * @param <int> $id id
     * @return <boolean> 新建文件夹是否成功
     */
    public function addSourceFolder($path,$id){
        $sourceFolder = $path.DS.$id.DS;//在全景文件夹下的对应类别中的以id命名的文件夹
        if(!is_dir($sourceFolder)){
            return mkdir($sourceFolder);
        }else{
            return TRUE;
        }
    }
    /**
     * 生成一个随机的文件夹名称
     * @return <string> 随机的文件夹名称
     */
    public function randomFolderName(){
        $folderName = strval(time().rand(1000, 9999));
        return $folderName;
    }
    /**
     * 判断是否是一个空文件夹
     * @param <string> $path 路径
     */
    public function isEmptyFolder($path){
        if(is_dir($path)){
            if ($dh = opendir($path)) {
                while (($file = readdir($dh)) !== false) {
                    if($file!=".." && $file!=".")
                        return true;
                }
                closedir($dh);
            }
        }
        return false;
    }
    /**
     *得到展示全景详细信息时的名称
     * @param <type> $sourceId资源id
     * @param <type> $type资源类型 商铺还是写字楼
     * @return <string> 展示的名称
     */
    public function getPanoramaViewName($sourceId){
        $name = Systembuildinginfo::model()->getBuildingName($sourceId);
        return $name;
    }
    /**
     * 得到一个全景的所有文件
     * @param string $dir
     * @param string $dser 目录分离符号
     * @return array
     */
    private function getPanoramaFiles($dir,$dser = DIRECTORY_SEPARATOR) {
        $files = array();
        if ( ($handle = opendir($dir)) ) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    if (is_dir($dir.$dser.$file)) {
                        $temp = getDirFiles($dir.$dser.$file);
                        foreach ($temp as $value)
                            $files[] = $file.$dser.$value;
                    }
                    else
                        $files[] = $file;
                }
            }
            closedir($handle);
        }
        return $files;
    }
    /**
     * 上传全景视频
     * @param <array> $fileForm 上传表单
     * @param <array> $updateFileDir 要上传的目录
     * @return <mix> 如果失败就返回false,成功就返回相对upload的文件夹路径
     */
    public function uploadPanoramaContent($fileForm,$updateFileDir){
        /** 不知何故,yii取不到文件类型了,所以只能用后缀名去判断了
            $suffix = array('application/zip');
            $fileType = $fileForm->getType();
            if(in_array($fileType,$suffix)){//上传的文件在符合的要求内
         *
         */
        $suffix = array('zip');
        $fileType = $fileForm->getExtensionName();
        if(in_array($fileType,$suffix)){//上传的文件在符合的要求内
            $fileDir = PIC_PATH.$updateFileDir;//生成的文件夹路径
            if(!is_dir($fileDir)){//没有文件夹就上传一个
                $addDir = @mkdir($fileDir);
            }
            if(is_dir($fileDir)){//文件夹建好了
                $boolUploadFile = $fileForm->saveAs($fileDir.DS.$fileForm->name);//上传图片
                if($boolUploadFile){//上传成功
                    if(substr(PHP_OS,0,3)=="WIN"){
                        $zip_obj = new Zip();
                    }else{
                        $zip_obj = new zipPeter();
                    }
                    $result = $zip_obj->Extract($fileDir.DS.$fileForm->name,$fileDir);//解压压缩文件
                    if($result)//如果全部解压完成,就删除原文件
                        @unlink($fileDir.DS.$fileForm->name);
                    require_once 'image.php';
                    $image = new Image();
                    $image->markTimes = 2;
                    $files = $this->getPanoramaFiles($fileDir);
                    foreach($files as $file){
                        if( ! in_array(strtolower(substr($file, strripos($file,'.')+1)), array('gif','jpg','jpeg','png')))
                                continue;
                        if(!preg_match("'thumbnail'", $file)) {
                                $image->textMark($fileDir.DIRECTORY_SEPARATOR.$file,'© 360dibiao.com');
                        }
                    }
                    return true;
                }
            }
        }
        return false;
    }
    /**
     *稍后上传全景，现在只生成文件夹，里面放一个index.html
     * @param <type> $dir
     * @return <type>
     */
    public function uploadPanoramaLater($dir){
        $dir = PIC_PATH.$dir;
        if(!is_dir($dir)){//没有文件夹就上传一个
            @mkdir($dir);
        }
        file_put_contents($dir."/index.html", "");
//        $defaultThumbnail = PIC_PATH."/panorama/default/thumbnail.jpg";
//        $defaultPanorama = PIC_PATH."/panorama/default/index.swf";
//
//        $file = file_get_contents($defaultThumbnail);
//        $fp = fopen($dir."/thumbnail.jpg","w");
//        fwrite($fp,$file);
//        fclose($fp);
//
//        $file = file_get_contents($defaultPanorama);
//        $fp = fopen($dir."/index.html","w");
//        fwrite($fp,$file);
//        fclose($fp);

        return true;
    }
    public function getNum($p_url) {
        $dba = dba();
        $num = $dba->select_one("select count(*) from 35_panorama where p_url=?",$p_url);
        return $num;
    }
}