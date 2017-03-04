<?php

/**
 * This is the model class for table "{{businesscenter}}".
 *
 */
class Businesscenter extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Businesscenter the static model class
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
		return '{{businesscenter}}';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'sysbuild'=>array(self::BELONGS_TO,'Systembuildinginfo','bc_sysid','select'=>'`sbi_buildingid`,`sbi_buildingname`'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'bc_id' => 'Bc',
			'bc_name' => 'Bc Name',
			'bc_pinyinshortname' => 'Bc Pinyinshortname',
			'bc_pinyinlongname' => 'Bc Pinyinlongname',
			'bc_englishname' => 'Bc Englishname',
			'bc_sysid' => 'Bc Sysid',
			'bc_address' => 'Bc Address',
			'bc_district' => 'Bc District',
			'bc_floor' => 'Bc Floor',
			'bc_completetime' => 'Bc Completetime',
			'bc_rentprice' => 'Bc Rentprice',
			'bc_serverbrand' => 'Bc Serverbrand',
			'bc_serverlanguage' => 'Bc Serverlanguage',
			'bc_decoratestyle' => 'Bc Decoratestyle',
			'bc_introduce' => 'Bc Introduce',
			'bc_freeserver' => 'Bc Freeserver',
			'bc_payserver' => 'Bc Payserver',
			'bc_traffic' => 'Bc Traffic',
			'bc_peripheral' => 'Bc Peripheral',
			'bc_connecttel' => 'Bc Connecttel',
			'bc_releasetime' => 'Bc Releasetime',
			'bc_visit' => 'Bc Visit',
		);
	}
    public function getTempleteSearchCriteria($criteria,$get){
        $baseKey = "rbPrice";
        $filed = "bc_rentprice";
        $inPutSearch = SearchMenu::getAllInPutSearch();//所有的input输入
        foreach($get as $key=>$value){
            if($key==$baseKey){//直接搜索租金
                $condition = Searchcondition::model()->findByPk($value);//得到数据库的对应搜索信息
                if($condition) {
                    $criteria->addBetweenCondition($filed,$condition->sc_minvalue,$condition->sc_maxvalue);
                }
                
            }elseif(array_key_exists($key, $inPutSearch)){//看看是否是自动输入的
                if($inPutSearch[$key]."a"==$key){//大于
                    $criteria->addCondition($filed.">=".$value);
                }else{//小于等于
                    $criteria->addCondition($filed."<=".$value);
                }
            }
        }
        return $criteria;
    }

    /**
     * 关注商务中心
     * @param int $limit
     */
    public function getLikeBC($limit=5){
        $db = Yii::app()->db;
        $gt = floor($limit/2)+1;
        $sql = 'SELECT *
            FROM {{businesscenter}} WHERE `bc_rentprice`>'.$this->bc_rentprice.'
                 LIMIT '.$gt;
        $gtrs = $db->createCommand($sql)->queryAll();
        $lt = $limit-count($gtrs);
        $sql = 'SELECT *
            FROM {{businesscenter}} WHERE `bc_rentprice`<'.$this->bc_rentprice.'
                 LIMIT '.$lt;
        $ltrs = $db->createCommand($sql)->queryAll();
        return array_merge($gtrs,$ltrs);
     }
         /**
     * 记录并返回楼盘访问历史。
     * @param int $id 当前访问楼盘id
     * @return array
     */
    public function businessViewMemory($id){
        $index = '_BCVM';
        $cookies=Yii::app()->request->cookies;
        if(!isset($cookies[$index])){
            $val = new CHttpCookie($index,$id);
            $val->expire = time()+86400;
            $cookies[$index]=$val;
            return array($id);
        }else{
            $_arr=explode('|', $cookies[$index]->value);
            if( ($key = array_search($id, $_arr))!==false ){
                unset($_arr[$key]);
            }
            $_arr[]=$id;
            $val=new CHttpCookie($index,implode('|', $_arr));
            $val->expire = time()+86400;
            $cookies[$index]=$val;
        }
        return $_arr;
    }
}