<?php

/**
 * This is the model class for table "{{housecollect}}".
 *
 * The followings are the available columns in table '{{housecollect}}':
 * @property integer $hc_id
 * @property integer $hc_puserid
 * @property integer $hc_officetype
 * @property integer $hc_presentid
 * @property integer $hc_rentorsell
 * @property integer $hc_recordtime
 */
class Housecollect extends CActiveRecord
{
    const office = 1;//写字楼
    const business = 2;//商务中心
    const shop = 3;//商铺
    const community = 4;//小区
    const residence = 5;//住宅
    const build = 6;//楼盘

    const rent = 1;//出租
    const sell = 2;//出售
    public static $officeTypeDes = array(
        1=>"写字楼",
        2=>"商务中心",
        3=>"商铺",
        5=>"住宅",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Housecollect the static model class
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
		return '{{housecollect}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hc_id', 'required'),
			array('hc_id, hc_puserid, hc_officetype, hc_presentid, hc_rentorsell, hc_recordtime', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('hc_id, hc_puserid, hc_officetype, hc_presentid, hc_rentorsell, hc_recordtime', 'safe', 'on'=>'search'),
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
			'hc_id' => 'Id',
			'hc_puserid' => '普通用户Id',
			'hc_officetype' => '房源类型',
			'hc_presentid' => '房源Id',
			'hc_rentorsell' => '租或售',
			'hc_recordtime' => '保存时间',
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

		$criteria->compare('hc_id',$this->hc_id);

		$criteria->compare('hc_puserid',$this->hc_puserid);

		$criteria->compare('hc_officetype',$this->hc_officetype);

		$criteria->compare('hc_presentid',$this->hc_presentid);

		$criteria->compare('hc_rentorsell',$this->hc_rentorsell);

		$criteria->compare('hc_recordtime',$this->hc_recordtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 根据条件得到详细访问页面的链接
     * @param <type> $presentId 展示房源的id
     * @param <type> $officeType 房源类型
     * @param <type> $rentorsell 租售类型
     * @return <type>
     */
    public function getOfficeLink($presentId,$officeType,$rentorsell){
        $url = array();
        if($officeType==self::office){//写字楼
            if($rentorsell==self::rent){
                $url = Yii::app()->createUrl('officebaseinfo/rentView',array('id'=>$presentId));
            }else{
                $url = Yii::app()->createUrl("officebaseinfo/saleView",array('id'=>$presentId));
            }
        }elseif($officeType==self::business){//商务中心
            $url = Yii::app()->createUrl("officebaseinfo/businessSummarize",array('opid'=>$presentId));
        }
        return DOMAIN.$url;
    }
}