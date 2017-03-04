<?php

/**
 * This is the model class for table "{{buildcollect}}".
 *
 * The followings are the available columns in table '{{buildcollect}}':
 * @property integer $bc_id
 * @property integer $bc_userid
 * @property integer $bc_sysid
 * @property string $bc_buildname
 * @property string $bc_buildaddress
 * @property integer $bc_province
 * @property integer $bc_city
 * @property integer $bc_district
 * @property integer $bc_section
 * @property integer $bc_loop
 * @property integer $bc_state
 * @property integer $bc_audituser
 * @property integer $bc_releasetime
 */
class Buildcollect extends CActiveRecord
{
    public static $bc_state = array(
        "0"=>"未审核",
        "1"=>"已审核",
        "2"=>"审核未通过",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Buildcollect the static model class
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
		return '{{buildcollect}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bc_userid, bc_buildname,bc_buildaddress, bc_province, bc_city, bc_district, bc_section, bc_loop, bc_releasetime', 'required'),
			array('bc_id, bc_userid, bc_sysid, bc_province, bc_city, bc_district, bc_section, bc_loop, bc_state, bc_audituser, bc_releasetime', 'numerical', 'integerOnly'=>true),
			array('bc_buildname', 'length', 'max'=>50),
			array('bc_buildaddress', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('bc_id, bc_userid, bc_sysid, bc_buildname, bc_buildaddress, bc_province, bc_city, bc_district, bc_section, bc_loop, bc_state, bc_audituser, bc_releasetime', 'safe', 'on'=>'search'),
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
			'bc_id' => 'id',
			'bc_userid' => '用户id',
			'bc_sysid' => '关联楼盘id',
			'bc_buildname' => '楼盘名称',
			'bc_buildaddress' => '楼盘地址',
			'bc_province' => '省',
			'bc_city' => '城市',
			'bc_district' => '行政区',
			'bc_section' => '板块',
			'bc_loop' => '环线',
			'bc_state' => '审核状态',
			'bc_audituser' => '审核者',
			'bc_releasetime' => '提交时间',
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

		$criteria->compare('bc_id',$this->bc_id);

		$criteria->compare('bc_userid',$this->bc_userid);

		$criteria->compare('bc_sysid',$this->bc_sysid);

		$criteria->compare('bc_buildname',$this->bc_buildname,true);

		$criteria->compare('bc_buildaddress',$this->bc_buildaddress,true);

		$criteria->compare('bc_province',$this->bc_province);

		$criteria->compare('bc_city',$this->bc_city);

		$criteria->compare('bc_district',$this->bc_district);

		$criteria->compare('bc_section',$this->bc_section);

		$criteria->compare('bc_loop',$this->bc_loop);

		$criteria->compare('bc_state',$this->bc_state);

		$criteria->compare('bc_audituser',$this->bc_audituser);

		$criteria->compare('bc_releasetime',$this->bc_releasetime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     *查看是否已经有此楼盘。
     * @param <type> $name 楼盘名称
     * @return <type> 
     */
    function checkBuildExist($name){
        $model = Systembuildinginfo::model()->findByAttributes(array("sbi_buildingname"=>$name));
        if($model){
            return true;
        }else{
            return false;
        }
    }
}