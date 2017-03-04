<?php

class Impression extends CActiveRecord
{
    const systembuilding = 1;//楼盘类型
    const officebaseinfo = 2;//写字楼类型
    const communitybaseinfo = 3;//小区类型
	/**
	 * The followings are the available columns in table '{{impression}}':
	 * @var integer $im_id
	 * @var integer $im_sourceid
	 * @var integer $im_sourcetype
	 * @var string $im_description
	 * @var integer $im_pro
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
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
		return '{{impression}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('im_id', 'required'),
			array('im_id, im_sourceid, im_sourcetype, im_pro', 'numerical', 'integerOnly'=>true),
			array('im_description', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('im_id, im_sourceid, im_sourcetype, im_description, im_pro', 'safe', 'on'=>'search'),
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
//            'userimpression'=>array(self::HAS_ONE,'userimpression','ui_impressionid)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'im_id' => 'Im',
			'im_sourceid' => 'Im Sourceid',
			'im_sourcetype' => 'Im Sourcetype',
			'im_description' => 'Im Description',
			'im_pro' => 'Im Pro',
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

		$criteria->compare('im_id',$this->im_id);

		$criteria->compare('im_sourceid',$this->im_sourceid);

		$criteria->compare('im_sourcetype',$this->im_sourcetype);

		$criteria->compare('im_description',$this->im_description,true);

		$criteria->compare('im_pro',$this->im_pro);

		return new CActiveDataProvider('Impression', array(
			'criteria'=>$criteria,
		));
	}
    public function scopes()
    {
        return array(
            'several'=>array(
                'order'=>'im_pro desc',
                'limit'=>'30',
            ),
            'all'=>array(
                'order'=>'im_pro desc',
            )
        );
    }
    /**
     * 得到部分印象
     * @param <type> $sourceId 房源id
     * @param <type> $sourceType 房源类型
     * @return <type> 部分印象
     */
    public function getSeveralImpression($sourceId,$sourceType){
        return $this->several()->findAllByAttributes(array('im_sourceid'=>$sourceId,'im_sourcetype'=>$sourceType));
    }
    /**
     * 得到所有印象
     * @param <type> $sourceId 房源id
     * @param <type> $sourceType 房源类型
     * @return <type> 全部印象
     */
    public function getAllImpression($sourceId,$sourceType){
        return $this->all()->findAllByAttributes(array('im_sourceid'=>$sourceId,'im_sourcetype'=>$sourceType));
    }
    /**
     *得到部分印象
     * @param <type> $sourceId房源id
     * @param <type> $sourceType房源类型
     * @param <type> $limit 
     */
    public function getLimitImpression($sourceId,$sourceType,$limit){
        if($sourceId){
            $criteria=new CDbCriteria(array(
                'limit'=>$limit,
                'order'=>'im_pro desc',
                'condition'=>'im_sourceid='.$sourceId.' and im_sourcetype='.$sourceType,
            ));
            return $this->findAll($criteria);
        }
    }
    /**
     * 判断是否已经发表过意见
     * @param <int> $userId 用户的id
     * @param <int> $sourceId 房源或者楼盘的id
     * @param <int> $sourceType 房源或者楼盘的类型
     * @return <boolean> 是否已经发表过
     */
    public function checkPublished($userId,$sourceId,$sourceType){
        $dba = dba();
        $countNum = $dba->select_one("select count(*) from `35_impression` inner join `35_userimpression`
                        on 35_impression.`im_id`=35_userimpression.`ui_impressionid`
                        where 35_impression.`im_sourceid`=? and 35_impression.`im_sourcetype`=? and 35_userimpression.`ui_userid`=?",$sourceId,$sourceType,$userId);
        if($countNum>0){
            return true;
        }else{
            return false;
        }
    }
    public function addImpression($impression)
	{
        $dba = dba();
        $impression->im_id =$dba->id('35_impression');
        $impression->im_pro=0;
		return $impression->save();//印象表里增加了条新的印象
	}
}