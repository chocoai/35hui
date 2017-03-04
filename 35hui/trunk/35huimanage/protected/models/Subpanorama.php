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
 * @property string $spn_parameter
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
			array('spn_sourceid, spn_releasetime', 'required'),
			array('spn_sourceid, spn_sourcetype, spn_handler, spn_state, spn_releasetime, spn_completetime', 'numerical', 'integerOnly'=>true),
			array('spn_panoramaname', 'length', 'max'=>50),
			array('spn_panoramaurl, spn_parameter', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('spn_id, spn_sourceid, spn_sourcetype, spn_fisheyephoto, spn_handler, spn_panoramaurl, spn_panoramaname, spn_parameter, spn_state, spn_releasetime, spn_completetime', 'safe', 'on'=>'search'),
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
			'spn_sourcetype' => '资源类型',
			'spn_fisheyephoto' => '鱼眼图片',
			'spn_handler' => '全景处理者',
			'spn_panoramaurl' => '全景地址',
			'spn_panoramaname' => '全景名称',
			'spn_parameter' => '全景参数',
			'spn_state' => '审核状态',
			'spn_releasetime' => '录入时间',
			'spn_completetime' => '操作完成时间',
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

		$criteria->compare('spn_parameter',$this->spn_parameter,true);

		$criteria->compare('spn_state',$this->spn_state);

		$criteria->compare('spn_releasetime',$this->spn_releasetime);

		$criteria->compare('spn_completetime',$this->spn_completetime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /*
     * 通过资源ID和资源类型
     * 取得房源和经纪人的名称或标题
    */
    function get_name($sourceId,$sbp_type=1) {
        $criteria = new CDbCriteria;
        //取得房源和经纪人信息数组
        $title='暂无资料';
        $role = "";
        $sellorrent="";
        switch($sbp_type){
            case 2 ://商铺
                $criteria->addColumnCondition(array('sb_shopid'=>$sourceId));
                $model=Shopbaseinfo::model()->find($criteria);
                if($model){
                    $role=$model->user->user_role;
                    $title=$model->presentInfo->sp_shoptitle;
                    $sellorrent=$model->sb_sellorrent;
                }
                break;
            case 1:
            case 3://写字楼和商务中心
                $criteria->addColumnCondition(array('ob_officeid'=>$sourceId));
                $model=Officebaseinfo::model()->find($criteria);
                if($model){
                    $role=@$model->user->user_role;
                    $title=@$model->buildingInfo->sbi_buildingname;
                    $sellorrent=$model->ob_sellorrent;
                }
                
                break;
            case 4 ://住宅
                $criteria->addColumnCondition(array('rbi_id'=>$sourceId));
                $model=Residencebaseinfo::model()->find($criteria);
                if($model){
                    $role=$model->user->user_role;
                    $title=$model->rbi_title;
                    $sellorrent=$model->rbi_rentorsell;
                }
                break;
            default:
                return array('新地标','暂无资料','');
                break;
        }
        $real_name = "暂无资料";
        switch($role) {
            case User::personal:
                $real_name=$model->user->user_name;
                break;
            case User::agent:
                $real_name=$model->user->agentinfo->ua_realname;
                break;
            case User::company:
                $real_name=$model->user->companyinfo->uc_fullname;
                break;
            default:
                $real_name="新地标";
                break;
        }
        return array($title,$real_name,$sellorrent);
    }
    /*
     * 通过资源ID和资源类型
     * 取得房源和经纪人的名称或标题
    */
    function getUserId($sourceId,$sbp_type=1) {
        $model='';
        switch($sbp_type){
            case 2 ://商铺
                $model=Shopbaseinfo::model()->findByPk($sourceId);
                break;
            case 1:
            case 3://写字楼和商务中心
                $model=Officebaseinfo::model()->findByPk($sourceId);
                break;
            case 4 ://住宅
                $model=Residencebaseinfo::model()->findByPk($sourceId);
                break;
        }
        if($model && $model->user){
            return $model->user->user_id;
        }else{
            return 0;
        }
    }
    /**
     *删除客服为用户制作的全景
     * @param <string> $path 数据库中保存的值，不能包含PIC_PATH
     */
    public function delPanorama($path){
        $dir = PIC_PATH.$path;
        common::deldir($dir);
        return true;
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