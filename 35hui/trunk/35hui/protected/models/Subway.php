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
            'lines'=>array(self::HAS_MANY,'Subway','sw_parentid','order'=>'lines.sw_id'),
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

    public function getInfoById($id) {
        if(isset($id)){
            $condition = $this->findByAttributes(array('sw_id'=>$id));
            if($condition) {
                return $condition;
            }
        }
        return "";
    }

     /**
     * 获取地铁的所有线路和站点
     * @param <int> $city_id
     * @return <type>
     */
    public function getLineAndStation($city_id='1') {
        $resultInfo = array();//将要返回的结果信息结合
        return $this->with('lines')->findByPk($city_id);
    }

     /**
     * 根据id找到父类的信息
     * @param <int> $id
     * @return <object>
     */
    public function getParentInfoById($id){
        $thisInfo = $this->findByAttributes(array('sw_id'=>$id));
        if($thisInfo->sw_parentid){
            return $this->findByAttributes(array('sw_id'=>$thisInfo->sw_parentid));
        }
        return null;
    }
    /**
     *通过id得到名称
     * @param <type> $id
     * @return <type> 
     */
    public function getNameById($id){
        $model = $this->findByPk($id);
        $return = "";
        if($model){
            $return = $model->sw_stationname;
        }
        return $return;
    }
}