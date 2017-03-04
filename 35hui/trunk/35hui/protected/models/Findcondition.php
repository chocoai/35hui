<?php

/**
 * This is the model class for table "{{findcondition}}".
 *
 * The followings are the available columns in table '{{findcondition}}':
 * @property integer $fc_id
 * @property integer $fc_puserid
 * @property integer $fc_officetype
 * @property integer $fc_rentorsell
 * @property string $fc_conditionstr
 * @property integer $fc_recordtime
 */
class Findcondition extends CActiveRecord
{
    const office = 1;//写字楼
    const building = 2;//楼盘
    const business = 3;//商务中心
    const quickRelease = 4;//快速发布
    const shop = 5;//商铺
    const residence = 6;//住宅

    const rent = 1;//出租
    const sell = 2;//出售
    public static $officeTypeDes = array(
        1=>"写字楼",
        2=>"楼盘",
        3=>"商务中心",
        4=>"快速发布",
        5=>"商铺",
        6=>"住宅"
    );
    public $searchConditionArray = array(//可用的查询条件
        'district'=>1, //区域
        'section'=>2, //地段
        'area'=>3,   //面积
        'loop'=>4,   //地段
        'sPrice'=>5, //售价
        'rPrice'=>6, //租金
        'metro'=>7,  //附近交通
        'fitment'=>8, //装修程度
        'source'=>9, //房源
        'keyword'=>10,//关键字
        'sourceType'=>12,//房源类型
        'type'=>2,//出租出售求租求购类型
        'rbPrice'=>15, //商务中心出租租金
        'cavgPrice'=>16, //小区均价
        'rrPrice'=>17, //住宅租金
        'hType'=>19, //住宅租金
        'pType'=>20,//物业类型
        'line'=>21,//地铁
        'station'=>22,//站台
         'tType'=>132,//物业类型
        'mrPrice'=>143,//商铺月租
        'sumPrice'=>150//商铺总价
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Findcondition the static model class
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
		return '{{findcondition}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fc_id', 'required'),
			array('fc_id, fc_puserid, fc_officetype, fc_rentorsell, fc_recordtime', 'numerical', 'integerOnly'=>true),
			array('fc_conditionstr', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('fc_id, fc_puserid, fc_officetype, fc_rentorsell, fc_conditionstr, fc_recordtime', 'safe', 'on'=>'search'),
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
			'fc_id' => 'Id',
			'fc_puserid' => '普通用户Id',
			'fc_officetype' => '房源类型',
			'fc_rentorsell' => '租或售',
			'fc_conditionstr' => '找房条件',
			'fc_recordtime' => '保存时间',
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

		$criteria->compare('fc_id',$this->fc_id);

		$criteria->compare('fc_puserid',$this->fc_puserid);

		$criteria->compare('fc_officetype',$this->fc_officetype);

		$criteria->compare('fc_rentorsell',$this->fc_rentorsell);

		$criteria->compare('fc_conditionstr',$this->fc_conditionstr,true);

		$criteria->compare('fc_recordtime',$this->fc_recordtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 根据搜索条件的数组返回描述集合数组
     * @param <array> $options 搜索条件数组 或 json
     * @return <array> 描述集合数组
     */
    public function getFindConditionDescription($condition){
        $html = array();
        $options = is_array($condition)?$condition:json_decode($condition,true);
//        print_r($options);
        $searchConditionArray=$this->searchConditionArray;
        if(isset($options['tag'])){//标签条件因为没办法在条件表中，所以在此处加入，以便能够显示该标签条件（林）
            $searchConditionArray['tag']=11;
        }
       
        $route = Yii::app()->controller->route;
        if(is_array($options)){
            foreach($searchConditionArray as $key=>$value){
                $temp = $condition;
                if(isset($options[$key])&&$options[$key]!=""){//如果是可用的查询条件，并且不为空
                    if($key=="district" || $key=="section"){
                        $html[] = CHtml::link(CHtml::encode(Region::model()->getNameById($options[$key])),
                                Yii::app()->createUrl($route,
                                        SearchMenu::dealOptions($condition, array_key_exists('district', $condition)?'district':'section')),
                                array('class'=>'close_clear')
                                );
                    }elseif($key=="keyword"){
                        $html[] = CHtml::link(urldecode($options[$key]),
                                Yii::app()->createUrl($route,
                                        SearchMenu::dealOptions($condition, 'keyword')),
                                array('class'=>'close_clear')
                                );
                    }elseif($key=="line" || $key=="station"){
                        $html[] = CHtml::link(CHtml::encode(Subway::model()->getNameById($options[$key])),
                                Yii::app()->createUrl($route,
                                        SearchMenu::dealOptions($condition, array_key_exists('line', $condition)?'line':'station')),
                                array('class'=>'close_clear')
                                );
                    }else{
                        $html[] = CHtml::link(CHtml::encode(Searchcondition::model()->getNameById($options[$key])),
                                Yii::app()->createUrl($route,
                                        SearchMenu::dealOptions($condition, $key)),
                                array('class'=>'close_clear')
                                );
                    }
                }
            }
        }
        return $html;
    }
    /**
     * 后台提供描述 没有url
     * @param <type> $condition
     * @return <type>
     */
    public function getFindCondition($condition){
        $html = array();
        $options = is_array($condition)?$condition:json_decode($condition,true);
        $searchConditionArray=$this->searchConditionArray;
        if(isset($options['tag'])){//标签条件因为没办法在条件表中，所以在此处加入，以便能够显示该标签条件（林）
            $searchConditionArray['tag']=11;
        }

        $route = Yii::app()->controller->route;
        if(is_array($options)){
            foreach($searchConditionArray as $key=>$value){
                $temp = $condition;
                if(isset($options[$key])&&$options[$key]!=""){//如果是可用的查询条件，并且不为空
                    if($key=="district" || $key=="section"){
                        $html[] = CHtml::encode(Region::model()->getNameById($options[$key]));
                    }elseif($key=="keyword"){
                        $html[] = urldecode($options[$key]);
                    }elseif($key=="line" || $key=="station"){
                        $html[] = CHtml::encode(Subway::model()->getNameById($options[$key]));
                    }else{
                        $html[] = CHtml::encode(Searchcondition::model()->getNameById($options[$key]));
                    }
                }
            }
        }
        return $html;
    }
    public function getFindConditionUrl($condition){
        $linkArray = json_decode($condition,true);
        $linkStr = "#";
        if(!empty($linkArray)){
            $linkArrayStr = array();
            foreach($linkArray as $key=>$value){
                $linkArrayStr[] = $key."=".$value;
            }
            $linkStr = implode("&", $linkArrayStr);
        }
        return $linkStr;
    }
}