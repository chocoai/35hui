<?php

class Communitybaseinfo extends CActiveRecord
{
    public static $pictureNorm = array(
        1 => array(
            'suffix'=>'_large',
            'width'=>'546',
            'height'=>'364',
        ),
        2 => array(
            'suffix'=>'_normal',
            'width'=>'300',
            'height'=>'200',
        ),
        3 => array(
            'suffix'=>'_small',
            'width'=>'150',
            'height'=>'100',
        ),
        4 => array(
            'suffix'=>'_thumb',
            'width'=>'100',
            'height'=>'75',
        ),
    );
    /**
     *朝向
     */
    public static $towards = array(
        1 => '东',
        2 => '南',
        3 => '西',
        4 => '北',
        5 => '东南',
        6 => '西南',
        7 => '西北',
        8 => '东北',
        9 => '南北',
        10 => '东西',
    );
    /**
     *物业类型
     */
    public static $comy_propertytypes = array(
        0 => '其它',
        1 => '公寓',
        2 => '别墅',
        3 => '新里洋房',
        4 => '老公房',
    );
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{communitybaseinfo}}';
	}

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comy_name,comy_propertytype, comy_buildingera, comy_province, comy_city,comy_district, comy_section, comy_developer, comy_avgsellprice, comy_address, comy_x, comy_y, comy_cubagerate, comy_buildingera, comy_afforestation', 'required'),
			array('comy_propertytype, comy_province, comy_city, comy_district, comy_section,comy_iscollect,comy_loushu, comy_hetong', 'numerical', 'integerOnly'=>true),
			array('comy_avgsellprice, comy_cubagerate, comy_afforestation, comy_houseown, comy_titlepic, comy_buildingarea,comy_inserttime,comy_score,comy_ratingnum', 'numerical'),
			array('comy_name, comy_pinyinshortname, comy_propertyname, comy_propertytel, comy_saletel, comy_traffic, comy_line', 'length', 'max'=>50),
			array('comy_address, comy_pinyinlongname, comy_parking, comy_saleaddress, comy_x, comy_y', 'length', 'max'=>200),
			array('comy_developer', 'length', 'max'=>60),
			array('comy_school,comy_shopping, comy_bank, comy_hospital, comy_dining, comy_other', 'length', 'max'=>400),
			array('comy_introduce', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('comy_id, comy_name, comy_propertytype, comy_developer, comy_propertyname, comy_avgsellprice, comy_buildingera, comy_province, comy_city, comy_district, comy_section, comy_address, comy_inserttime, comy_traffic, comy_buildingarea,comy_iscollect,comy_line', 'safe', 'on'=>'search'),
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
            'comment'=>array(self::HAS_MANY,'communitycomment','comyc_comyid'),
            'rating'=>array(self::HAS_ONE,'communityrating','cr_comyid'),
		);
	}

    public function getPropertytypeName($intToward) {
        $typeName = "";
        if(key_exists($intToward, self::$comy_propertytypes)){
            $typeName = self::$comy_propertytypes[$intToward];
        }
        return $typeName;
    }

    public function getTowardName($intToward) {
        $towardName = "";
        if(key_exists($intToward, self::$towards)){
            $towardName = self::$towards[$intToward];
        }
        return $towardName;
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'comy_id' => '小区id',
			'comy_name' => '小区名称',
            'comy_pinyinshortname' => '小区名称缩写',
            "comy_pinyinlongname"=> '小区名称完整拼音',
			'comy_introduce' => '小区介绍',
			'comy_address' => '小区地址',
			'comy_propertytype' => '物业类型',
			'comy_developer' => '开发商',
			'comy_propertyname' => '物业公司名称',
			'comy_propertytel' => '物业电话',
			'comy_avgsellprice' => '平均售价',
			'comy_cubagerate' => '容积率',
			'comy_afforestation' => '绿化率',
			'comy_householdnum' => '总户数',
			'comy_parking' => '停车位',
			'comy_buildingera' => '建筑年代',
            'comy_saleaddress' => '售楼地址',
			'comy_houseown' => '得房率',
			'comy_province' => '所属省份',
			'comy_city' => '所属城市',
			'comy_district' => '所属区域',
			'comy_section' => '所属板块',
			'comy_inserttime' => '录入时间',
			'comy_titlepic' => '标题图片id',
			'comy_saletel' => '售楼中心电话',
			'comy_x' => 'X轴',
			'comy_y' => 'Y轴',
            'comy_loushu'=>'楼书',
            'comy_hetong'=>'合同',
			'comy_traffic' => '交通',
			'comy_buildingarea' => '总建筑面积',
			'comy_school' => '学校',
			'comy_shopping' => '购物',
			'comy_bank' => '银行',
			'comy_hospital' => '医院',
			'comy_dining' => '饮食',
			'comy_other' => '其他',
			'comy_iscollect' => '是否用户添加，1是',
			'comy_score' => '总分',
			'comy_ratingnum' => '评分人数',
			'comy_line' => '地铁线路',
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

		$criteria->compare('comy_id',$this->comy_id);

		$criteria->compare('comy_name',$this->comy_name,true);

        $criteria->compare('comy_propertytype',$this->sbi_buildtype);

        $criteria->compare('sbi_developer',$this->sbi_developer,true);

        $criteria->compare('comy_propertyname',$this->comy_propertyname,true);

        $criteria->compare('comy_avgsellprice',$this->comy_avgsellprice);

		$criteria->compare('comy_province',$this->comy_province);

		$criteria->compare('comy_city',$this->comy_city);

		$criteria->compare('comy_district',$this->comy_district);

		$criteria->compare('comy_section',$this->comy_section);

        $criteria->compare('comy_address',$this->comy_address,true);

		$criteria->compare('comy_inserttime',$this->comy_inserttime);
        
        $criteria->compare('comy_traffic',$this->comy_traffic,true);
        
        $criteria->compare('comy_iscollect',$this->comy_iscollect,true);
        
        $criteria->compare('comy_line',$this->comy_line,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

     public function addComment($comment)
	{
        $result = array('state'=>false,'speak'=>'');
        if(Yii::app()->user->isGuest){
            $result['speak']="请先登录!";
        }else{
            $dba = dba();
            $comment->comyc_uid =Yii::app()->user->id;
            $comment->comyc_id = $dba->id('35_communitycomment');
            $comment->comyc_comyid=$this->comy_id;
            $comment->comyc_comdate=time();

            $isok = $comment->save();
            if($isok){
                $result['state']=true;
                $result['speak']="发表评论成功!";
            }else{
                $result['speak']="发表评论失败!";
            }
        }
        return $result;
	}

     public function getNums($communityId,$type=1){
        $dba = dba();
        if($type==2){
            $sellNums = $dba->select_one("select count(*) from 35_residencebaseinfo a inner join 35_residencetag b on a.rbi_id=b.rt_rbiid and b.rt_check=4  where a.rbi_communityid=? and a.rbi_rentorsell=2",$communityId);
            return $sellNums;
        }else{
            $rentNums = $dba->select_one("select count(*) from 35_residencebaseinfo a inner join 35_residencetag b on a.rbi_id=b.rt_rbiid and b.rt_check=4  where a.rbi_communityid=? and a.rbi_rentorsell=1",$communityId);
            return $rentNums;
        }

    }

      /**
     *通过租售类型，得到热门小区
     * @param <int> $sellorrent 租或售。
     * @param <int> $limit 显示条数
     * @return <type>
     */
    public function getHotCommunity($sellorrent,$limit=5){
        $criteria = new CDbCriteria;
        $criteria->condition = " rbi_rentorsell=".$sellorrent;
        $criteria->limit = $limit;
        $criteria->with = array(
            'residenceTag'=>array(
                'condition'=>'rt_check=4',
            ),
            'community'
        );
        $criteria->group = "rbi_communityid";
        $criteria->order = "count(*) desc";
        $list = Residencebaseinfo::model()->findAll($criteria);
        return $list;
    }
    /**
     *自动完成中需要用到的小区数据
     * @return <array>
     */
    public function getAutoCompleteData(){
        $dba = dba();
        $sql = "select comy_id id, comy_name name, comy_pinyinshortname egshort, comy_pinyinlongname eglong from 35_communitybaseinfo";
        return $dba->select($sql);
    }

    public function getAllCommunitys($urserId){
        $dba = dba();
        $sql = "SELECT b.* FROM 35_residencebaseinfo a left join 35_communitybaseinfo b on a.rbi_communityid=b.comy_id  where a.rbi_uid=".$urserId." group by a.rbi_communityid";
        $communitys = $dba->select($sql);
        return $communitys;
    }

     /**
     *通过传入小区id，得到小区名称
     */
    public function getCommunityNameById($comyId){
        $return  = "";
        if($comyId){
            $comy = self::findByPk($comyId);
            if($comy){
                $return = $comy->comy_name;
            }
        }
        return $return;
    }
}