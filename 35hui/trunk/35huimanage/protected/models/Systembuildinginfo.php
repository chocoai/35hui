<?php

/**
 * This is the model class for table "{{systembuildinginfo}}".
 *
 * The followings are the available columns in table '{{systembuildinginfo}}':
 * @property integer $sbi_buildingid
 * @property string $sbi_buildingname
 * @property string $sbi_pinyinshortname
 * @property string sbi_pinyinlongname
 * @property integer $sbi_province
 * @property integer $sbi_city
 * @property integer $sbi_district
 * @property integer $sbi_section
 * @property integer $sbi_loop
 * @property integer $sbi_tradecircle
 * @property string $sbi_busway
 * @property string $sbi_address
 * @property integer $sbi_foreign
 * @property integer $sbi_openingtime
 * @property string $sbi_propertyname
 * @property string $sbi_developer
 * @property double $sbi_propertyprice
 * @property integer $sbi_propertydegree
 * @property double $sbi_buildingarea
 * @property double $sbi_floorarea
 * @property integer $sbi_floor
 * @property string $sbi_buildingintroduce
 * @property string $sbi_peripheral
 * @property string $sbi_traffic
 * @property string $sbi_decoration
 * @property string $sbi_floorinformation
 * @property string $sbi_parkinginformation
 * @property string $sbi_otherinformation
 * @property integer $sbi_titlepic
 * @property integer sbi_titlepanorama
 * @property double $sbi_avgrentprice
 * @property integer $sbi_avgsellprice
 * @property integer $sbi_isnew
 * @property string $sbi_x
 * @property string $sbi_y
 * @property string $sbi_tag
 * @property integer $sbi_recordtime
 * @property integer $sbi_updatetime
 * @property string $sbi_tel
 * @property string $sbi_danyuanfenge
 */
class Systembuildinginfo extends CActiveRecord
{
    public static $propertyDegree = array(
            1=>'甲级',
            2=>'乙级',
            3=>'丙级',
    );
    /**
     *楼盘类型
     * @var <array>
     */
    public static $sbi_buildtype = array(
            1=>"写字楼",
            2=>'商业广场'
    );
    public static $pictureNorm = array(
        1 => array(
            'suffix'=>"_large",
            'width'=>'240',
            'height'=>'180',
        ),
        2 => array(
            'suffix'=>"_normal",
            'width'=>'120',
            'height'=>'160',
        ),
    );
    /**
     * Returns the static model of the specified AR class.
     * @return Systembuildinginfo the static model class
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
        return '{{systembuildinginfo}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                array('sbi_buildingname, sbi_buildtype, sbi_province, sbi_city,sbi_district, sbi_section,sbi_loop, sbi_propertyprice,sbi_address,sbi_x,sbi_y,sbi_avgrentprice,sbi_avgsellprice', 'required'),
                array('sbi_buildtype,sbi_province, sbi_city, sbi_district, sbi_section, sbi_loop, sbi_tradecircle, sbi_foreign, sbi_propertydegree, sbi_floor, sbi_titlepic,sbi_titlepanorama, sbi_avgsellprice, sbi_isnew, sbi_recordtime, sbi_updatetime', 'numerical', 'integerOnly'=>true),
                array('sbi_propertyprice, sbi_floorarea, sbi_avgrentprice', 'numerical'),
                array('sbi_pinyinshortname', 'length', 'max'=>50),
                array('sbi_busway, sbi_buildingname, sbi_pinyinlongname,sbi_developer, sbi_propertyname, sbi_address, sbi_x, sbi_y, sbi_tag', 'length', 'max'=>200),
                array('sbi_tel,sbi_propertytel,sbi_buildingarea', 'length', 'max'=>20),
                array('sbi_buildingintroduce, sbi_peripheral, sbi_traffic, sbi_decoration, sbi_floorinformation, sbi_parkinginformation, sbi_otherinformation,sbi_openingtime,sbi_danyuanfenge,sbi_wailimian,sbi_buildingenglishname,sbi_defanglv', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('sbi_buildingid, sbi_buildingname, sbi_pinyinshortname, sbi_province, sbi_city, sbi_district, sbi_section, sbi_loop, sbi_tradecircle, sbi_busway, sbi_address, sbi_foreign, sbi_openingtime, sbi_propertyname, sbi_developer, sbi_propertyprice, sbi_propertydegree, sbi_buildingarea, sbi_floorarea, sbi_floor, sbi_buildingintroduce, sbi_peripheral, sbi_traffic, sbi_decoration, sbi_floorinformation, sbi_parkinginformation, sbi_otherinformation, sbi_titlepic,sbi_titlepanorama, sbi_avgrentprice, sbi_avgsellprice, sbi_isnew, sbi_x, sbi_y, sbi_tag, sbi_recordtime, sbi_updatetime, sbi_tel', 'safe', 'on'=>'search'),
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
                'twitterSuggest'=>array(self::HAS_MANY,'Twittersuggest','ts_buildingid')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
                'sbi_buildingid' => '楼盘Id',
                'sbi_buildingname' => '楼盘名称',
                'sbi_pinyinshortname' => '楼盘名称缩写',
                "sbi_pinyinlongname"=> '楼盘名称完整拼音',
                'sbi_buildtype'=>'楼盘类型',
                'sbi_province' => '所属省份',
                'sbi_city' => '所属城市',
                'sbi_district' => '所属行政区',
                'sbi_section' => '所属板块',
                'sbi_loop' => '几环',
                'sbi_tradecircle' => '附近商圈',
                'sbi_busway' => '临近轨道',
                'sbi_address' => '楼盘地址',
                'sbi_foreign' => '是否涉外',
                'sbi_visit'=>"访问数",
                'sbi_loushu'=>"楼书",
                'sbi_hetong'=>"合同",
                'sbi_openingtime' => '开盘时间',
                'sbi_propertyname' => '物业管理公司',
                'sbi_propertytel' => '物业公司电话',
                'sbi_developer' => '开发商',
                'sbi_propertyprice' => '物业管理费',
                'sbi_propertydegree' => '物业级别',
                'sbi_buildingarea' => '建筑总面积',
                'sbi_floorarea' => '标准层面积',
                'sbi_floor' => '总层数',
                'sbi_buildingintroduce' => '楼盘介绍',
                'sbi_peripheral' => '周边配套',
                'sbi_traffic' => '交通配套',
                'sbi_titlepic' => '标题图片Id',
                'sbi_titlepanorama' => '标题全景Id',
                'sbi_avgrentprice' => '平均租价',
                'sbi_avgsellprice' => '平均售价',
                'sbi_isnew' => '是否是新楼盘',
                'sbi_x' => 'x坐标',
                'sbi_y' => 'y坐标',
                'sbi_tag' => '标签',
                'sbi_recordtime' => '入库时间',
                'sbi_updatetime' => '最近更新时间',
                'sbi_tel'=>"售楼中心联系电话",
                'sbi_dongnum'=>"楼宇总楼数",
                'sbi_wailimian'=>"外立面",

                'sbi_datang'=>"大堂",
                'sbi_zoulang'=>"公共走廊",
                'sbi_floorinfo'=>'楼层信息',
                'sbi_danyuanfenge'=>'单元分割面积',
                'sbi_biaozhun'=>'交屋标准',
                'sbi_toiletwater'=>'卫生间供水',
                'sbi_liftinfo'=>'电梯配置',
                'sbi_communication'=>'通讯系统',
                'sbi_aircon'=>'空调系统',
                'sbi_security'=>'安防系统',
                'sbi_carport'=>'车位配置',
                'sbi_roommating'=>'楼内配套',
                'sbi_propertyserver'=>'物业服务',
                'sbi_buildingenglishname'=>'英文名字',
                'sbi_defanglv'=>'得房率',
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

        $criteria->compare('sbi_buildingid',$this->sbi_buildingid);

        $criteria->compare('sbi_buildingname',$this->sbi_buildingname,true);

        $criteria->compare('sbi_pinyinshortname',$this->sbi_pinyinshortname,true);

        $criteria->compare('sbi_buildtype',$this->sbi_buildtype);

        $criteria->compare('sbi_province',$this->sbi_province);

        $criteria->compare('sbi_city',$this->sbi_city);

        $criteria->compare('sbi_district',$this->sbi_district);

        $criteria->compare('sbi_section',$this->sbi_section);

        $criteria->compare('sbi_loop',$this->sbi_loop);

        $criteria->compare('sbi_tradecircle',$this->sbi_tradecircle);

        $criteria->compare('sbi_busway',$this->sbi_busway,true);

        $criteria->compare('sbi_address',$this->sbi_address,true);

        $criteria->compare('sbi_foreign',$this->sbi_foreign);

        $criteria->compare('sbi_openingtime',$this->sbi_openingtime);

        $criteria->compare('sbi_propertyname',$this->sbi_propertyname,true);

        $criteria->compare('sbi_developer',$this->sbi_developer,true);

        $criteria->compare('sbi_propertyprice',$this->sbi_propertyprice);

        $criteria->compare('sbi_propertydegree',$this->sbi_propertydegree);

        $criteria->compare('sbi_buildingarea',$this->sbi_buildingarea);

        $criteria->compare('sbi_floorarea',$this->sbi_floorarea);

        $criteria->compare('sbi_floor',$this->sbi_floor);

        $criteria->compare('sbi_buildingintroduce',$this->sbi_buildingintroduce,true);

        $criteria->compare('sbi_peripheral',$this->sbi_peripheral,true);

        $criteria->compare('sbi_traffic',$this->sbi_traffic,true);

        $criteria->compare('sbi_decoration',$this->sbi_decoration,true);

        $criteria->compare('sbi_floorinformation',$this->sbi_floorinformation,true);

        $criteria->compare('sbi_parkinginformation',$this->sbi_parkinginformation,true);

        $criteria->compare('sbi_otherinformation',$this->sbi_otherinformation,true);

        $criteria->compare('sbi_titlepic',$this->sbi_titlepic);

        $criteria->compare('sbi_titlepanorama',$this->sbi_titlepanorama);

        $criteria->compare('sbi_avgrentprice',$this->sbi_avgrentprice);

        $criteria->compare('sbi_avgsellprice',$this->sbi_avgsellprice);

        $criteria->compare('sbi_isnew',$this->sbi_isnew);

        $criteria->compare('sbi_x',$this->sbi_x,true);

        $criteria->compare('sbi_y',$this->sbi_y,true);

        $criteria->compare('sbi_tag',$this->sbi_tag,true);

        $criteria->compare('sbi_recordtime',$this->sbi_recordtime);

        $criteria->compare('sbi_updatetime',$this->sbi_updatetime);

        $criteria->compare('sbi_tel',$this->sbi_tel,true);

        return new CActiveDataProvider(get_class($this), array(
                        'criteria'=>$criteria,
        ));
    }
    public function getAllBuildingName($sbi_buildtype=1){
        $dba = dba();
        $result = array();
        $allData = $dba->select("select * from `35_systembuildinginfo` where sbi_buildtype=$sbi_buildtype order by `sbi_buildingid`");
        foreach($allData as $data){
            $result[$data['sbi_buildingid']]=$data['sbi_buildingname'];
        }
        return $result;
    }
    public function getBuildingName($buildingId){
        $name = "";
        $model = Systembuildinginfo::model()->findByPk($buildingId);
        if($model){
            $name = $model->sbi_buildingname;
        }
        return $name;
    }
    public function getSerializeValueByName($name,$array){
        $return = "";
        if($array&&array_key_exists($name, $array)){
            $return = $array[$name];
        }
        return $return;
    }
    /**
     * 序列化输入的参数
     * @param <string> $key post中的键名
     * @param <array> $templete 保存的所有数据
     * @param <string or array> $emptyValue 没有传值时使用的数据 如果是string则表示全部都使用此值，array只指定其中的部分空值，未指定的使用空
     * @return <type> 可用于保存的数据
     */
    public function formatSerializeValue($key,$templete,$emptyValue=""){
        $return = array();
        foreach($templete as $value){
//            $postkey = "\'".$value."\'";
            $postkey = $value;
            if(isset($_POST[$key])&&isset($_POST[$key][$postkey])){
                $return[$value] = $_POST[$key][$postkey];
            }else{
                if(is_array($emptyValue)){
                    if(array_key_exists($value, $emptyValue)){//假如指定了空值
                        $return[$value] = $emptyValue[$value];
                    }else{
                        $return[$value] = "";
                    }
                }else{
                    $return[$value] = $emptyValue;
                }
            }
        }
        return serialize($return);
    }
    /**
     * 前台显示使用
     * @param <serialize> $serialize 序列化的值
     * @param <boolean> $trueOrFalse 是否只包含是和否
     * @param <array> $notTrue 如果只包含是和否，这里面的是要去除是和否的。
     * @return <string>
     */
    public function getFormatSerializeValue($serialize,$trueOrFalse=false,$notTrue=array()){
        $return = "";
        if($notTrue){
            $notTrue = array_flip($notTrue);
        }
        if($serialize){
            $all = unserialize($serialize);
            foreach($all as $key=>$value){
                if($trueOrFalse){//假如只有是和否状态
                    if(!array_key_exists($key, $notTrue)){
                        $value = $value=="1"?"是":"否";
                    }
                }
                $return .= "<b>".$key."：</b>&nbsp;&nbsp;".$value."<br />";
            }
        }
        return $return;
    }
}