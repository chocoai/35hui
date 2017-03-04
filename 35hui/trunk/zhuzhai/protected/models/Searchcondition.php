<?php

class Searchcondition extends CActiveRecord {

    const loopTypeId = 15;//内外环
    const sellPriceTypeId = 20;//售价
    const rentPriceTypeId = 30;//写字楼、商铺租价
    const businessPriceTypeId = 91;//商务中心租金
    const metroTypeId = 40;//地铁
    const industryTypeId = 59;//适用行业
    const avgSellPriceTypeId = 74;//平均售价
    const avgRentPriceTypeId = 67;//平均租金
    const filterdate = 81;//过滤发布日期
    const filteropendate = 86;//过滤开盘日期
    /**
     * The followings are the available columns in table '{{searchcondition}}':
     * @var integer $sc_id
     * @var string $sc_title
     * @var integer $sc_parentid
     * @var integer $sc_maxvalue
     * @var integer $sc_minvalue
     */

    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{searchcondition}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('sc_id, sc_title, sc_parentid, sc_maxvalue, sc_minvalue', 'required'),
            array('sc_id, sc_parentid, sc_maxvalue, sc_minvalue', 'numerical', 'integerOnly'=>true),
            array('sc_title', 'length', 'max'=>200),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('sc_id, sc_title, sc_parentid, sc_maxvalue, sc_minvalue', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'sc_id' => 'Sc',
            'sc_title' => 'Sc Title',
            'sc_parentid' => 'Sc Parentid',
            'sc_maxvalue' => 'Sc Maxvalue',
            'sc_minvalue' => 'Sc Minvalue',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('sc_id',$this->sc_id);

        $criteria->compare('sc_title',$this->sc_title,true);

        $criteria->compare('sc_parentid',$this->sc_parentid);

        $criteria->compare('sc_maxvalue',$this->sc_maxvalue);

        $criteria->compare('sc_minvalue',$this->sc_minvalue);

        return new CActiveDataProvider('searchcondition', array(
                'criteria'=>$criteria,
        ));
    }
    /**
     * 返回搜索类型的大类
     * @param <string> $req_type_int 大类的主键,格式为:1,3,4;默认没有的情况下,搜索所有的
     * @return <type>
     */
    public function getSearchTypes($req_type_int=null) {
        $criteria = new CDbCriteria;
        if($req_type_int==null) {
            $criteria->condition = "sc_parentid=0";
        }else {
            $criteria->condition = "sc_parentid=0 and sc_id in (".$req_type_int.")";
        }
        return $this->findAll($criteria);
    }
    /**
     * 根据搜索条件类型的id查找其种类
     * @param <type> $type_id 搜索条件类型的id
     * @return <type>
     */
    public function findConditionsByType($type_id) {
        if(!$type_id) {
            return array();
        }else {
            $criteria = new CDbCriteria;
            $criteria->order = "sc_id";
            $criteria->addColumnCondition(array('sc_parentid'=>$type_id));
            return $this->findAll($criteria);
        }
    }
    /**
     * 根据类型id和最小值得到名称
     * @param <type> $typeId
     * @param <type> $value
     * @return <type>
     */
    public function getNameByTypeAndValue($typeId,$value) {
        $condition = $this->findByAttributes(array('sc_parentid'=>$typeId,'sc_minvalue'=>$value));
        if($condition) {
            return $condition->sc_title;
        }else {
            return "";
        }
    }
    public function getLoopName($value) {
        return $this->getNameByTypeAndValue(self::loopTypeId,$value);
    }
    public function getNameById($id) {
        $condition = $this->getSearchConditionById($id);
        return $condition->sc_title;
    }
    public function getSearchConditionById($id){
        return $this->findByAttributes(array('sc_id'=>$id));
    }
    /**
     * 得到条件的最大值和最小值
     * @param <type> $id
     * @return <array>
     */
    public function getConditionValue($id){
        $value = array();
        $condition = $this->getSearchConditionById($id);
        if($condition){
            $value['min'] = $condition->sc_minvalue;
            $value['max'] = $condition->sc_maxvalue;
        }
        return $value;
    }
    /**
     *得到适用行业的名称
     * @param <int> $value
     * @return <string>
     */
    public function getForIndustryName($value) {
        return $this->getNameByTypeAndValue(self::industryTypeId,$value);
    }
    /**
     * 返回所有的地铁信息
     * @return <object>
     */
    public function getAllMetros($formatToArray = 0) {
        $data = $this->findConditionsByType(self::metroTypeId);
        if($formatToArray){
            $data = self::formatDataToArray($data);
        }
        return $data;
    }
    public function getSellPriceCondition(){
        return $this->findConditionsByType(self::sellPriceTypeId);
    }
    public function getRentPriceCondition(){
        return $this->findConditionsByType(self::rentPriceTypeId);
    }
    public function getAvgRentPriceCondition(){
        return $this->findConditionsByType(self::avgRentPriceTypeId);
    }
    public function getAvgSellPriceCondition(){
        return $this->findConditionsByType(self::avgSellPriceTypeId);
    }
    /**
     * 得到条件表中关于租价的id集合
     * @return <array>
     */
    public function getRentPriceConditionIds(){
        $dba = dba();
        $rentIds = $dba->select_col("select `sc_id` from 35_searchcondition where `sc_parentid`=?",self::rentPriceTypeId);
        return $rentIds;
    }
    /**
     * 得到条件表中关于售价的id结合
     * @return <array>
     */
    public function getSellPriceConditionIds(){
        $dba = dba();
        $sellIds = $dba->select_col("select `sc_id` from 35_searchcondition where `sc_parentid`=?",self::sellPriceTypeId);
        return $sellIds;
    }
    /**
     * 根据类型id返回子id的最大值和最小值
     * @param <type> $typeId
     * @return <type>
     */
    public function getIdsRangeByTypeId($typeId){
        $dba = dba();
        $rangeInfo = $dba->select_row("SELECT MAX(`sc_id`) as max,MIN(`sc_id`) as min FROM 35_searchcondition WHERE `sc_parentid` =?",$typeId);
        return $rangeInfo;
    }
    /**
     * 得到所有的地段
     * @return <array>
     */
    public function getAllLoops($formatToArray = 0){
        $data = self::findAllByAttributes(array('sc_parentid'=>Searchcondition::loopTypeId));
        if($formatToArray){
            $data = self::formatDataToArray($data);
        }
        return $data;
    }
    /**
     *搜索条件下的按日期查找
     * @return <array>
     */
    public function getAllFilterDate($formatToArray = 1){
        $data = self::findAllByAttributes(array('sc_parentid'=>Searchcondition::filterdate));
        $return = array();
        if($data){
            foreach($data as $value){
                $return[$value->sc_id] = $value->sc_title;
            }
        }
        return $return;
    }
    /**
     *搜索条件下的按开盘时间查找
     * @return <array>
     */
    public function getAllFilterOpenDate($formatToArray = 1){
        $data = self::findAllByAttributes(array('sc_parentid'=>Searchcondition::filteropendate));
        $return = array();
        if($data){
            foreach($data as $value){
                $return[$value->sc_id] = $value->sc_title;
            }
        }
        return $return;
    }
    /**
     *格式化数据变成数组类型
     * @param <type> $data
     * @return <array>
     */
    public function formatDataToArray($data){
        $allLoop = array();
        foreach($data as $value){
            $allLoop[$value->sc_minvalue]=$value->sc_title;
        }
        return $allLoop;
    }
}