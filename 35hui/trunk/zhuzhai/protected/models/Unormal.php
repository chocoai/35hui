<?php

class Unormal extends CActiveRecord
{
	/**
	 * The followings are the available columns in table '{{unormal}}':
	 * @var integer $puser_id
	 * @var integer $puser_uid
	 * @var string $puser_logopath
	 * @var string $puser_vip
	 */
     public static $pictureNorm = array(
        1 => array(
            'suffix'=>'_large',
            'width'=>'116',
            'height'=>'145',
        ),
        2 => array(
            'suffix'=>'_normal',
            'width'=>'80',
            'height'=>'100',
        ),
        3 => array(
            'suffix'=>'_small',
            'width'=>'50',
            'height'=>'50',
        ),
    );
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
		return '{{unormal}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('puser_uid, ', 'required'),
			array('puser_uid', 'numerical', 'integerOnly'=>true),
			array('puser_logopath', 'length', 'max'=>200),
			array('puser_vip', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('puser_id, puser_uid,  puser_logopath, puser_vip', 'safe', 'on'=>'search'),
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
			'puser_id' => '个人信息主键',
			'puser_uid' => '用户表Id',
			'puser_logopath' => '头像',
            'puser_logoaudit' => '头像审核',
			'puser_vip' => '是否Vip会员',
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

		$criteria->compare('puser_id',$this->puser_id);

		$criteria->compare('puser_uid',$this->puser_uid);

		$criteria->compare('puser_logopath',$this->puser_logopath,true);

		$criteria->compare('puser_vip',$this->puser_vip,true);

		return new CActiveDataProvider('Unormal', array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 根据用户id得到个人id
     * @param <type> $userId
     * @return <type>
     */
    public function getPersonalIdByUserId($userId){
        $dba = dba();
        $personalId = $dba->select_one("select `puser_id` from 35_unormal where `puser_uid`=?",$userId);
        return $personalId;
    }

    /**
     *得到用户每一类房源可发布房源总数、可录入房源总数、每日可刷新数,可设急房源数、可设推荐房源数。普通用户不能购买套餐
     * @param <int> $userid 用户id
     * @param <int> $type 1可发布房源总数、2可录入房源总数、3每日可刷新数、4可设急房源数、5可设推荐房源数
     * @return <int> 返回此用户可操作数目
     */
    public function getAllOperateNum($userid,$type){
        //通过判断$r值得到能够发布数
        if($type==1||$type==2||$type==3){
            $i = $type-1;
            $allCertificate = array_values(Oprationconfig::model()->getConfigByName('unormalOpration'));
            $num=$allCertificate[$i];
        }else{
            $type==4?$num = Oprationconfig::model()->getConfigByName("default_hurry_num",0):"";//可设急房源数
            $type==5?$num = Oprationconfig::model()->getConfigByName("default_recommend_num",0):"";//可设推荐房源数
        }
        return $num;
    }
    /**
     *得到用户每一类房源已发布房源数、已录入房源数、今日已刷新数
     * @param <int> $userid 用户id
     * @param <int> $type 1已发布房源数、2已录入房源数、3今日已刷新数、4已发布的急房源、5已发布的推荐房源。
     * @param <int> $sourceType 房源类型 1写字楼 2商铺 3住宅
     * @return <int> 返回此用户已操作数目
     */
    public function getNowOperateNum($userid,$type,$sourceType=1){
        $num = 0;
        if($type==3){
            $sourceType==1?$operationType=Dayoperation::buildFlush:"";
            $sourceType==2?$operationType=Dayoperation::shopFlush:"";
            $sourceType==3?$operationType=Dayoperation::residenceFlush:"";
            $num = Dayoperation::model()->getPerationNumByUidAndType($userid, $operationType);
        }else if($type==2){//已录入房源数。只要不是已经删除的，都统计。
            if($sourceType==1){//写字楼
                $criteria = new CDbCriteria;
                $criteria->condition = "ob_uid=".$userid." and ob_buildingtype=3";
                $criteria->with = array(
                    'offictag'=>array(
                        'condition'=>"ot_check!=1",
                    ),
                );
                $num = Officebaseinfo::model()->count($criteria);
            }elseif($sourceType==2){//商铺
                $criteria = new CDbCriteria;
                $criteria->condition = "sb_uid=".$userid;
                $criteria->with = array(
                    'shopTag'=>array(
                        'condition'=>"st_check!=1",
                    ),
                );

                $num = Shopbaseinfo::model()->count($criteria);
            }elseif($sourceType==3){//住宅
                $criteria = new CDbCriteria;
                $criteria->condition = "rbi_uid=".$userid;
                $criteria->with = array(
                    'residenceTag'=>array(
                        'condition'=>"rt_check!=1",
                    ),
                );

                $num = Residencebaseinfo::model()->count($criteria);
            }
        }else if($type==1||$type==4||$type==5){//已发布房源数、急房源、推荐房源。只统计状态为发布的房源
             if($sourceType==1){//写字楼
                $criteria = new CDbCriteria;
                $criteria->condition = "ob_uid=".$userid." and ob_buildingtype=3";
                $criteria->with = array(
                    'offictag'=>array(
                        'condition'=>"ot_check=4",
                    ),
                );
                $type==4?$criteria->addColumnCondition(array("ot_ishurry"=>1)):"";
                $type==5?$criteria->addColumnCondition(array("ot_isrecommend"=>1)):"";
                $num = Officebaseinfo::model()->count($criteria);
            }elseif($sourceType==2){//商铺
                $criteria = new CDbCriteria;
                $criteria->condition = "sb_uid=".$userid;
                $criteria->with = array(
                    'shopTag'=>array(
                        'condition'=>"st_check=4",
                    ),
                );
                $type==4?$criteria->addColumnCondition(array("st_ishurry"=>1)):"";
                $type==5?$criteria->addColumnCondition(array("st_isrecommend"=>1)):"";
                $num = Shopbaseinfo::model()->count($criteria);
            }elseif($sourceType==3){//住宅
                $criteria = new CDbCriteria;
                $criteria->condition = "rbi_uid=".$userid;
                $criteria->with = array(
                    'residenceTag'=>array(
                        'condition'=>"rt_check=4",
                    ),
                );
                $type==4?$criteria->addColumnCondition(array("rt_ishurry"=>1)):"";
                $type==5?$criteria->addColumnCondition(array("rt_isrecommend"=>1)):"";
                $num = Residencebaseinfo::model()->count($criteria);
            }
        }
        return $num;
    }
    /**
     * 根据userId返回头像
     * @param <string> $userId
     * @return <string>
     */
    public function getLogoPathByUserId($userId){
        $model = $this->findByAttributes(array('puser_uid'=>$userId));
        if($model){
            return $model->puser_logopath;
        }else{
            return "";
        }
    }
}