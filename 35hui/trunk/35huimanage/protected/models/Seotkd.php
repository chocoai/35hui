<?php
/**
 * This is the model class for table "{{seotkd}}".
 *
 * The followings are the available columns in table '{{seotkd}}':
 * @property integer $stkd_id
 * @property integer $stkd_position
 * @property string $stkd_title
 * @property string $stkd_keyword
 * @property string $stkd_dec
 */
class Seotkd extends CActiveRecord
{
    public static $position = array(
        1=>'网站首页 --------- http://www.360dibiao.com/',
        2=>'写字楼出租 --------- http://www.360dibiao.com/officebaseinfo/rentIndex',
        3=>'写字楼出售 --------- http://www.360dibiao.com/officebaseinfo/saleIndex',
        4=>'商务中心 --------- http://www.360dibiao.com/businesscenter/list',
        5=>'楼盘中心 --------- http://www.360dibiao.com/systembuildinginfo/buildlist',
        6=>'商铺首页 --------- http://www.360dibiao.com/shop',
        7=>'地图找房 --------- http://www.360dibiao.com/map/map',
        8=>'资讯 --------- http://www.360dibiao.com/news/newslist',
        9=>'经纪人写字楼出租 --------- http://www.360dibiao.com/uagent/officerent',
        10=>'经纪人写字楼出售 --------- http://www.360dibiao.com/uagent/officesale',
        11=>'住宅 --------- http://www.360dibiao.com/zhuzhai',
		12=>'创意园区 --------- http://www.360dibiao.com/creativeparkbaseinfo/creativelist',
		13=>'经纪人出租创意园区 --------- http://www.360dibiao.com/uagent/creativesource',
		14=>'商铺出租 --------- http://www.360dibiao.com/shop/rentindex',
		15=>'商铺出售 --------- http://www.360dibiao.com/shop/sellindex',
		16=>'商铺转让 --------- http://www.360dibiao.com/shop/transferindex',
		17=>'经纪人商铺出租 --------- http://www.360dibiao.com/uagent/shoprent',
		18=>'经纪人商铺出售 --------- http://www.360dibiao.com/uagent/shopsale',
		19=>'经纪人商铺转让 --------- http://www.360dibiao.com/uagent/shoptransfer',
    );
    /**
     * Returns the static model of the specified AR class.
     * @return Seotkd the static model class
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
        return '{{seotkd}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('stkd_id, stkd_title, stkd_keyword, stkd_dec', 'required'),
            array('stkd_id', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('stkd_id,stkd_title, stkd_keyword, stkd_dec', 'safe', 'on'=>'search'),
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
            'stkd_id' => 'ID',
            'stkd_title' => '标题',
            'stkd_keyword' => '关键字',
            'stkd_dec' => '描述',
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

        $criteria->compare('stkd_id',$this->stkd_id);

        $criteria->compare('stkd_title',$this->stkd_title,true);

        $criteria->compare('stkd_keyword',$this->stkd_keyword,true);

        $criteria->compare('stkd_dec',$this->stkd_dec,true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }

    public function getPosition($intPosition) {
        $positionName = "";
        if(key_exists($intPosition, self::$position)){
            $positionName = self::$position[$intPosition];
        }
        return $positionName;
    }
} 
?>
