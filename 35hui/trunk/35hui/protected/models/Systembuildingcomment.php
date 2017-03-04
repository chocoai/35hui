<?php

/**
 * This is the model class for table "{{systembuildingcomment}}".
 *
 * The followings are the available columns in table '{{systembuildingcomment}}':
 * @property integer $sbc_id
 * @property integer $sbc_cid
 * @property integer $sbc_buildingid
 * @property integer $sbc_evaluation
 * @property integer $sbc_num
 * @property string $sbc_comment
 * @property integer $sbc_comdate
 */
class Systembuildingcomment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Systembuildingcomment the static model class
	 */
	public $verify;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{systembuildingcomment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sbc_cid, sbc_buildingid, sbc_evaluation, sbc_num, sbc_comment, sbc_comdate', 'required'),
			array('sbc_cid, sbc_buildingid, sbc_evaluation, sbc_num, sbc_comdate', 'numerical', 'integerOnly'=>true),
			array('sbc_comment', 'length', 'max'=>1500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sbc_id, sbc_cid, sbc_buildingid, sbc_evaluation, sbc_num, sbc_comment, sbc_comdate', 'safe', 'on'=>'search'),
			array('verify', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
		
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
		'buildingInfo'=>array(self::BELONGS_TO,'Systembuildinginfo','sbc_buildingid'),
            'userInfo'=>array(self::BELONGS_TO,'User','sbc_cid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sbc_id' => 'Sbc',
			'sbc_cid' => 'Sbc Cid',
			'sbc_buildingid' => 'Sbc Buildingid',
			'sbc_evaluation' => 'Sbc Evaluation',
			'sbc_num' => 'Sbc Num',
			'sbc_comment' => 'Sbc Comment',
			'sbc_comdate' => 'Sbc Comdate',
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

		$criteria->compare('sbc_id',$this->sbc_id);

		$criteria->compare('sbc_cid',$this->sbc_cid);

		$criteria->compare('sbc_buildingid',$this->sbc_buildingid);

		$criteria->compare('sbc_evaluation',$this->sbc_evaluation);

		$criteria->compare('sbc_num',$this->sbc_num);

		$criteria->compare('sbc_comment',$this->sbc_comment,true);

		$criteria->compare('sbc_comdate',$this->sbc_comdate);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
		
	}
	public function recently($limit=5)
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition'=>'CHAR_LENGTH(sbc_comment)>0',
            'order'=>'sbc_comdate DESC',
            'limit'=>$limit,
        ));
        return $this;
    }
    //通过评分得到描述
    public static function int2describe($comInt){
        $starNum = $comInt/2;
        return $starNum."颗星";
    }
    /**
     * 得到最近的楼盘点评信息
     * @param <type> $count 返回的点评条数
     * @return <object>
     */
    public function getRecentComment($count=5,$sbi_buildtype=1){
        return $this->recently($count)->with(array('buildingInfo'=>array('condition'=>'sbi_buildtype='.$sbi_buildtype),'userInfo'))->findAll();
    }
    /**
     * 根据楼盘id得到评论信息
     * @param <type> $buildingId 楼盘id
     * @param <type> $pageNum 每页显示数量
     * @return <type>
     */
    public function getCommentByBuildingId($buildingId,$pageNum=5){
        $criteria=new CDbCriteria(array(
            'condition'=>"sbc_buildingid=".$buildingId,
            'order'=>'sbc_comdate DESC',
        ));
        $dataProvider = new CActiveDataProvider('Systembuildingcomment',array(
            'pagination'=>array(
                'pageSize'=>$pageNum,
            ),
            'criteria'=>$criteria,
        ));
        return $dataProvider;
    }
    /**
     *得到楼盘最近的评论。
     * @param <int> $buildingId 楼盘id
     */
    public function getRecentCommentByBuildId($buildingId){
        $criteria=new CDbCriteria(array(
            'order'=>'sbc_comdate DESC',
        ));
        $criteria->addColumnCondition(array('sbc_buildingid'=>$buildingId));
        return $this->find($criteria);
    }	
}