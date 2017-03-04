<?php

/**
 * This is the model class for table "{{advertisement}}".
 *
 * The followings are the available columns in table '{{advertisement}}':
 * @property integer $ad_id
 * @property integer $ad_position
 * @property string $ad_picurl
 * @property string $ad_linkurl
 * @property string $ad_alt
 * @property integer $ad_uploadtime
 */
class Advertisement extends CActiveRecord
{
    public static $advertiseConfig = array(
        1=>array(
            'description'=>'首页 – 新推楼盘模块上方的长方形区',
            'width'=>718,
            'height'=>100,
        ),
        2=>array(
            'description'=>'首页 - 按标志物找房的上方长方形区',
            'width'=>718,
            'height'=>100,
        ),
        3=>array(
            'description'=>'商务中心首页 – 主题大图',
            'width'=>631,
            'height'=>221,
        ),
        4=>array(
            'description'=>'商务中心首页 – 按标志物找房模块的上片区域',
            'width'=>713,
            'height'=>118,
        ),
        5=>array(
            'description'=>'商务中心首页 – 按标志物找房模块的下片区域',
            'width'=>713,
            'height'=>118,
        ),
        6=>array(
            'description'=>'用户管理后台 – 顶部长形的广告位',
            'width'=>743,
            'height'=>102,
        ),
        7=>array(
            'description'=>'写字楼首页 – 右侧房源登记下第一个广告位',
            'width'=>260,
            'height'=>100,
        ),
        8=>array(
            'description'=>'写字楼首页 – 右侧房源登记下第二个广告位',
            'width'=>260,
            'height'=>100,
        ),
        9=>array(
            'description'=>'商铺首页 – 右侧房源登记下第一个广告位',
            'width'=>270,
            'height'=>100,
        ),
        10=>array(
            'description'=>'商铺首页 – 右侧房源登记下第二个广告位',
            'width'=>270,
            'height'=>100,
        ),
        11=>array(
            'description'=>'写字楼首页 – 右侧品牌中介广告位',
            'width'=>260,
            'height'=>100,
        ),
        12=>array(
            'description'=>'商铺首页 – 右侧品牌中介广告位',
            'width'=>270,
            'height'=>100,
        ),
        13=>array(
            'description'=>'资讯首页 - 头条下方长方形区',
            'width'=>718,
            'height'=>100,
        ),
        14=>array(
            'description'=>'合作伙伴 -   写字楼右侧栏位置1',
            'width'=>110,
            'height'=>50,
        ),
        15=>array(
            'description'=>'合作伙伴 - 写字楼右侧栏位置2',
            'width'=>110,
            'height'=>50,
        ),
        16=>array(
            'description'=>'合作伙伴 - 写字楼右侧栏位置3',
            'width'=>110,
            'height'=>50,
        ),
        17=>array(
            'description'=>'合作伙伴 - 写字楼右侧栏位置4',
            'width'=>110,
            'height'=>50,
        ),
        18=>array(
            'description'=>'合作伙伴 - 写字楼右侧栏位置5',
            'width'=>110,
            'height'=>50,
        ),
        19=>array(
            'description'=>'住宅首页 - 左侧热门小区上广告位',
            'width'=>718,
            'height'=>100,
        ),
        20=>array(
            'description'=>'住宅首页 - 左侧金牌经纪人下广告位',
            'width'=>718,
            'height'=>100,
        ),
        21=>array(
            'description'=>'住宅首页 - 右侧最近浏览过的房源下广告位',
            'width'=>270,
            'height'=>100,
        ),
        22=>array(
            'description'=>'合作伙伴 -   住宅左侧栏位置1',
            'width'=>100,
            'height'=>100,
        ),
        23=>array(
            'description'=>'合作伙伴 -   住宅左侧栏位置2',
            'width'=>100,
            'height'=>100,
        ),
        24=>array(
            'description'=>'合作伙伴 -   住宅左侧栏位置3',
            'width'=>100,
            'height'=>100,
        ),
        25=>array(
            'description'=>'合作伙伴 -   住宅左侧栏位置4',
            'width'=>100,
            'height'=>100,
        ),
        26=>array(
            'description'=>'合作伙伴 -   住宅左侧栏位置5',
            'width'=>100,
            'height'=>100,
        ),
        27=>array(
            'description'=>'网站首页 -   右侧广告位置1',
            'width'=>260,
            'height'=>96,
        ),
        28=>array(
            'description'=>'网站首页 -   右侧广告位置2',
            'width'=>260,
            'height'=>268,
        ),
        29=>array(
            'description'=>'网站首页 -   右侧广告位置3',
            'width'=>260,
            'height'=>105,
        ),
        30=>array(
            'description'=>'网站首页 -   右侧广告位置4',
            'width'=>260,
            'height'=>105,
        ),
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Advertisement the static model class
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
		return '{{advertisement}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ad_id, ad_position, ad_picurl, ad_uploadtime', 'required'),
			array('ad_id, ad_position, ad_uploadtime', 'numerical', 'integerOnly'=>true),
			array('ad_picurl', 'length', 'max'=>200),
			array('ad_linkurl', 'length', 'max'=>100),
			array('ad_alt', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ad_id, ad_position, ad_picurl, ad_linkurl, ad_alt, ad_uploadtime', 'safe', 'on'=>'search'),
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
			'ad_id' => 'Ad',
			'ad_position' => 'Ad Position',
			'ad_picurl' => 'Ad Picurl',
			'ad_linkurl' => 'Ad Linkurl',
			'ad_alt' => 'Ad Alt',
			'ad_uploadtime' => 'Ad Uploadtime',
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

		$criteria->compare('ad_id',$this->ad_id);

		$criteria->compare('ad_position',$this->ad_position);

		$criteria->compare('ad_picurl',$this->ad_picurl,true);

		$criteria->compare('ad_linkurl',$this->ad_linkurl,true);

		$criteria->compare('ad_alt',$this->ad_alt,true);

		$criteria->compare('ad_uploadtime',$this->ad_uploadtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 展示广告
     * @param <int> $position 位置
     * @return <string> 广告图片
     */
    public static function showAdvertise($position){
        $config = self::$advertiseConfig[$position];
        $model = Advertisement::model()->findByAttributes(array('ad_position'=>$position));
        
        if($model){
            $url=urldecode($model->ad_linkurl);
            return "<a href='".($url?$url:'#')."'><img title='".CHtml::encode($model->ad_alt)."' src='".PIC_URL.$model->ad_picurl."' style='width:".$config['width']."px;height:".$config['height']."px;border:0px;'></a>";
        }else{
            return "";
        }
    }
}