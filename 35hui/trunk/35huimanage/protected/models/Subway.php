<?php

/**
 * This is the model class for table "{{subway}}".
 *
 * The followings are the available columns in table '{{subway}}':
 * @property integer $sw_id
 * @property string $sw_stationname
 * @property integer $sw_parentid
 * @property string $sw_x
 * @property string $sw_y
 */
class Subway extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Subway the static model class
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
		return '{{subway}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sw_stationname, sw_parentid', 'required'),
			array('sw_id, sw_parentid', 'numerical', 'integerOnly'=>true),
			array('sw_stationname', 'length', 'max'=>200),
			array('sw_x, sw_y', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sw_id, sw_stationname, sw_parentid, sw_x, sw_y', 'safe', 'on'=>'search'),
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
			'sw_id' => '站点ID',
			'sw_stationname' => '站点名称',
			'sw_parentid' => '站点父ID',
			'sw_x' => 'X坐标',
			'sw_y' => 'Y坐标',
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

		$criteria->compare('sw_id',$this->sw_id);

		$criteria->compare('sw_stationname',$this->sw_stationname,true);

		$criteria->compare('sw_parentid',$this->sw_parentid);

		$criteria->compare('sw_x',$this->sw_x,true);

		$criteria->compare('sw_y',$this->sw_y,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>20,
            ),

		));
	}
    /**
     *通过父id。得到所有信息
     * @param <type> $pid
     * @return <type>
     */
    public function getAllByParentId($pid) {
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("sw_parentid"=>$pid));
        $criteria->order = "sw_id";
        return $this->findAll($criteria);
    }

    public function getTarafUnits($parent_id){
        if($parent_id!=null){
            $dba = dba();
            if($parent_id!=null){
                $datas = $dba->select("SELECT * FROM `35_subway` WHERE `sw_parentid`=?",$parent_id);
                return $this->formatTrafficData($datas);
            }
        }
        return array();
    }
    
    protected function formatTrafficData($trafficData){
        $result = array();
        foreach($trafficData as $data){
            $result[$data['sw_id']] = $data['sw_stationname'];
        }
        return $result;
    }

    public function getFormatChildrenData($parentId){
        $stations = $this->getChildrenById($parentId);
        $result = $this->formatTrafficData($stations);
        return $result;
    }

     public function getChildrenById($id){
        $dba = dba();
        $children = $dba->select("select * from `35_subway` where `sw_parentid`=?",$id);
        return $children;
    }

     public function getNameByTrafficId($id){
        $children = $dba->select("select * from `35_subway` where `sw_parentid`=?",$id);
        return $children;
    }

    public function getNameById($id) {
        if(isset($id)){
            $condition = $this->findByAttributes(array('sw_id'=>$id));
            if($condition) {
                return $condition;
            }
        }
        return "";
    }

}