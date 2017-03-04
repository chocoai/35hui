<?php

/**
 * This is the model class for table "{{buyregion}}".
 *
 * The followings are the available columns in table '{{buyregion}}':
 * @property integer $br_id
 * @property integer $br_userid
 * @property integer $br_regionid
 * @property integer $br_sourcetype
 * @property integer $br_sellorrent
 * @property integer $br_buytime
 * @property integer $br_expiredate
 * @property integer $br_status
 */
class Buyregion extends CActiveRecord
{
    /**
     * 状态
     * @var <type>
     */
    public static $br_status = array(
        "1"=>"可用",
        "2"=>"下线",
    );
    /**
     * 租售类型
     * @var <type>
     */
    public static $br_sellorrent =array(
        "1"=>"出租",
        "2"=>"出售",
    );
    /**
     * 资源类型
     * @var <type>
     */
    public static $br_sourcetype = array(
        "1"=>"写字楼",
        "2"=>"商铺",
        "3"=>"住宅",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Buyregion the static model class
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
		return '{{buyregion}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('br_userid, br_regionid, br_sourcetype, br_sellorrent, br_expiredate', 'required'),
			array('br_userid, br_regionid, br_sourcetype, br_sellorrent, br_buytime, br_expiredate, br_status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('br_id, br_userid, br_regionid, br_sourcetype, br_sellorrent, br_buytime, br_expiredate, br_status', 'safe', 'on'=>'search'),
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
			'br_id' => 'Br',
			'br_userid' => '购买者',
			'br_regionid' => '购买区域',
			'br_sourcetype' => '资源类型',
			'br_sellorrent' => '租售类型',
			'br_buytime' => '购买日期',
			'br_expiredate' => '有效期',
			'br_status' => '状态',
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

		$criteria->compare('br_id',$this->br_id);

		$criteria->compare('br_userid',$this->br_userid);

		$criteria->compare('br_regionid',$this->br_regionid);

		$criteria->compare('br_sourcetype',$this->br_sourcetype);

		$criteria->compare('br_sellorrent',$this->br_sellorrent);

		$criteria->compare('br_buytime',$this->br_buytime);

		$criteria->compare('br_expiredate',$this->br_expiredate);

		$criteria->compare('br_status',$this->br_status);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 同一个版块在过期时间内只能有一个人购买
     * @param <type> $br_regionid
     * @param <type> $br_sourcetype
     * @param <type> $br_sellorrent
     * @return <type>
     */
    public function checkRegionCanBuy($br_regionid, $br_sourcetype, $br_sellorrent){
        $model = self::model()->findByAttributes(array(
            "br_regionid"=>$br_regionid,
            "br_sourcetype"=>$br_sourcetype,
            "br_sellorrent"=>$br_sellorrent,
            "br_status"=>1,
        ));
        if($model){
            return false;
        }else{
            return true;
        }
    }
    /**
     * 得到展示的购买信息
     * @param <type> $br_regionid
     * @return <type>
     */
    public function getShowRegionName($br_regionid){
        $return = "";
        $model = Region::model()->findByPk($br_regionid);
        if($model){
            $section = $model->re_name;
            $district = Region::model()->getNameById($model->re_parent_id);
            $return = $district."-".$section;
        }
        return $return;
    }
    /**
     * 把此版块下的所有房源都去除版块精选功能
     * @param <type> $model
     */
    public function updateAllSourceToZero($model){
        $sourcetype = $model->br_sourcetype;//房源类型
        $regionid = $model->br_regionid;//版块
        $sellorrent = $model->br_sellorrent;//租售类型
        $userId = $model->br_userid;//购买者

        $criteria = new CDbCriteria;
        switch($sourcetype){
            case 1://写字楼
                $criteria->addColumnCondition(array(
                    "ob_section"=>$regionid,
                    "ob_sellorrent"=>$sellorrent,
                ));
                $allSource = Officebaseinfo::model()->findAll($criteria);
                if($allSource){
                    $ids = array();
                    foreach($allSource as $value){
                        $ids[] = $value->ob_officeid;
                    }
                    $criteriaTag = new CDbCriteria;
                    $criteriaTag->addInCondition("ot_officeid",$ids);
                    $criteriaTag->addColumnCondition(array("ot_isbuyregion"=>1));
                    Officetag::model()->updateAll(array("ot_isbuyregion"=>0),$criteriaTag);
                }
                break;
            case 2://商铺
                $criteria->addColumnCondition(array(
                    "sb_section"=>$regionid,
                    "sb_sellorrent"=>$sellorrent,
                ));
                $allSource = Shopbaseinfo::model()->findAll($criteria);
                if($allSource){
                    $ids = array();
                    foreach($allSource as $value){
                        $ids[] = $value->sb_shopid;
                    }
                    $criteriaTag = new CDbCriteria;
                    $criteriaTag->addInCondition("st_shopid",$ids);
                    $criteriaTag->addColumnCondition(array("st_isbuyregion"=>1));
                    Shoptag::model()->updateAll(array("st_isbuyregion"=>0),$criteriaTag);
                }
                break;
            case 3://住宅
                $criteria->addColumnCondition(array(
                    "comy_section"=>$regionid,
                    "rbi_rentorsell"=>$sellorrent,
                ));
                $criteria->with = array("xiaoqu");
                $allSource = Residencebaseinfo::model()->findAll($criteria);
                if($allSource){
                    $ids = array();
                    foreach($allSource as $value){
                        $ids[] = $value->rbi_id;
                    }
                    $criteriaTag = new CDbCriteria;
                    $criteriaTag->addInCondition("rt_rbiid",$ids);
                    $criteriaTag->addColumnCondition(array("rt_isbuyregion"=>1));
                    Residencetag::model()->updateAll(array("rt_isbuyregion"=>0),$criteriaTag);
                }
                break;
        }
    }
}