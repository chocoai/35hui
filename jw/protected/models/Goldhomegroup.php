<?php

/**
 * This is the model class for table "{{goldhomegroup}}".
 *
 * The followings are the available columns in table '{{goldhomegroup}}':
 * @property integer $ghg_id
 * @property integer $ghg_userid
 * @property string $ghg_groupname
 * @property integer $ghg_createtime
 */
class Goldhomegroup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Goldhomegroup the static model class
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
		return '{{goldhomegroup}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ghg_userid, ghg_groupname, ghg_createtime', 'required'),
			array('ghg_userid, ghg_createtime', 'numerical', 'integerOnly'=>true),
			array('ghg_groupname', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ghg_id, ghg_userid, ghg_groupname, ghg_createtime', 'safe', 'on'=>'search'),
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
			'ghg_id' => 'Ghg',
			'ghg_userid' => 'Ghg Userid',
			'ghg_groupname' => 'Ghg Groupname',
			'ghg_createtime' => 'Ghg Createtime',
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

		$criteria->compare('ghg_id',$this->ghg_id);

		$criteria->compare('ghg_userid',$this->ghg_userid);

		$criteria->compare('ghg_groupname',$this->ghg_groupname,true);

		$criteria->compare('ghg_createtime',$this->ghg_createtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 检查用户是否还能创建金屋分组，创建分组有上线
     * @param <type> $userId
     * @param <type> $maxGroupNum
     * @return <boolean>
     */
    public function checkCanCreate($userId,$maxGroupNum){
        $now = $this->count("ghg_userid=".$userId);
        if($now<$maxGroupNum){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 所有的金屋类型
     * @param <type> $userId
     * @return <type>
     */
    public function getAllGroupsById($userId){
        $criteria=new CDbCriteria;
        $criteria->order="ghg_createtime";
        $criteria->addColumnCondition(array("ghg_userid"=>$userId));
        return $this->findAll($criteria);
    }
    /**
     * 获取分组名称
     * @param <type> $ghgId 分组ID
     * @return <type>
     */
    public function getGroupNameById($ghgId){
        $return = "未分组";
        if(!$ghgId){
            return $return;
        }
        $model = $this->findByPk($ghgId);
        if(!$model){
            return $return;
        }
        return $model->ghg_groupname;
    }
}