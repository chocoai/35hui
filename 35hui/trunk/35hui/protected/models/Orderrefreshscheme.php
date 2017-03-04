<?php

/**
 * This is the model class for table "{{orderrefreshscheme}}".
 *
 * The followings are the available columns in table '{{orderrefreshscheme}}':
 * @property integer $ors_id
 * @property integer $ors_userid
 * @property string $ors_schemename
 * @property string $ors_schemetime
 */
class Orderrefreshscheme extends CActiveRecord
{
    public static $template = array(
        array(
            "800","900","1000","1100","1200","1300","1400","1500"
        ),
        array(
            "820","920","1020","1120","1220","1320","1420","1520"
        ),
        array(
            "840","940","1040","1140","1240","1340","1440","1540"
        ),
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Orderrefreshscheme the static model class
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
		return '{{orderrefreshscheme}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ors_userid, ors_schemename, ors_schemetime', 'required'),
			array('ors_userid', 'numerical', 'integerOnly'=>true),
			array('ors_schemename', 'length', 'max'=>50),
			array('ors_schemetime', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ors_id, ors_userid, ors_schemename, ors_schemetime', 'safe', 'on'=>'search'),
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
			'ors_id' => 'Ors',
			'ors_userid' => '用户id',
			'ors_schemename' => '方案名称',
			'ors_schemetime' => '方案内容',
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

		$criteria->compare('ors_id',$this->ors_id);

		$criteria->compare('ors_userid',$this->ors_userid);

		$criteria->compare('ors_schemename',$this->ors_schemename,true);

		$criteria->compare('ors_schemetime',$this->ors_schemetime,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     *得到此用户的所以预约方案
     * @param <type> $userId
     * @return <type>
     */
    public function getAllSchemeByUserId($userId){
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("ors_userid"=>$userId));
        $criteria->order = "ors_id";
        $schemes = Orderrefreshscheme::model()->findAll($criteria);//已有的方案
        return $schemes;
    }
}