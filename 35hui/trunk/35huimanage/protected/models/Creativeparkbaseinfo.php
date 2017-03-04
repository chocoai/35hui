<?php

class Creativeparkbaseinfo extends CActiveRecord
{
    public static $pictureNorm = array(
        1 => array(
            'suffix'=>"_large",
            'width'=>'240',
            'height'=>'180',
        ),
    );
    /**
     * 物业服务
     * @var <type> 
     */
    public static $cp_propertyserver = array(
        "1"=>"收发邮件",
        "2"=>"订阅报刊",
        "3"=>"订阅机票酒店",
    );
    /**
     * 园内配套
     * @var <type> 
     */
    public static $cp_roommating = array(
        "1"=>"会议室",
        "2"=>"商务中心",
        "3"=>"简餐",
        "4"=>"娱乐",
        "5"=>"ATM",
        "6"=>"便利店",
        "7"=>"零售",
        "8"=>"食堂",
        "9"=>"会展中心",
        "10"=>"银行",
        "11"=>"干洗店",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Creativeparkbaseinfo the static model class
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
		return '{{creativeparkbaseinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cp_name', 'required'),
			array('cp_avgrentprice, cp_propertyprice, cp_defanglv, cp_area', 'numerical'),
			array('cp_name, cp_pinyinlongname, cp_address, cp_developer, cp_propertyname', 'length', 'max'=>200),
			array('cp_englishname, cp_x, cp_y', 'length', 'max'=>100),
			array('cp_pinyinshortname, cp_form', 'length', 'max'=>50),
			array('cp_fengearea, cp_floorheight', 'length', 'max'=>20),
			array('cp_introduce, cp_traffic, cp_carport, cp_propertyserver, cp_roommating, cp_peripheral, cp_district', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cp_id, cp_name, cp_englishname, cp_pinyinshortname, cp_pinyinlongname, cp_district, cp_address, cp_avgrentprice, cp_developer, cp_propertyprice, cp_propertyname, cp_openingtime, cp_defanglv, cp_area, cp_fengearea, cp_floorheight, cp_form, cp_introduce, cp_traffic, cp_carport, cp_propertyserver, cp_roommating, cp_peripheral, cp_x, cp_y', 'safe', 'on'=>'search'),
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
			'cp_id' => 'Cp',
			'cp_name' => 'Cp Name',
			'cp_englishname' => 'English Name',
			'cp_pinyinshortname' => 'Cp Pinyinshortname',
			'cp_pinyinlongname' => 'Cp Pinyinlongname',
			'cp_district' => '行政区',
			'cp_address' => '地址',
            'cp_avgrentprice' => '平均租金',
			'cp_developer' => '开发商',
			'cp_propertyprice' => '物业费',
			'cp_propertyname' => '物业名称',
			'cp_openingtime' => '改建年代',
			'cp_defanglv' => '得房率',
			'cp_area' => '总面积',
			'cp_fengearea' => '分割面积',
			'cp_floorheight' => '层高',
			'cp_form' => '园区形态',
			'cp_introduce' => '园区介绍',
			'cp_traffic' => '交通情况',
			'cp_carport' => '车位配置',
			'cp_propertyserver' => '物业服务',
			'cp_roommating' => '园内配套',
            'cp_peripheral' => '周边配套',
            'cp_x'=> 'x坐标',
            'cp_y' => 'y坐标',
            'cp_titlepic' => '',
            'cp_releasedate'=>''
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

		$criteria->compare('cp_id',$this->cp_id);

		$criteria->compare('cp_name',$this->cp_name,true);
/*
		$criteria->compare('cp_englishname',$this->cp_englishname,true);

		$criteria->compare('cp_pinyinshortname',$this->cp_pinyinshortname,true);

		$criteria->compare('cp_pinyinlongname',$this->cp_pinyinlongname,true);

		$criteria->compare('cp_district',$this->cp_district);

		$criteria->compare('cp_address',$this->cp_address,true);

		$criteria->compare('cp_avgrentprice',$this->cp_avgrentprice);

		$criteria->compare('cp_developer',$this->cp_developer,true);

		$criteria->compare('cp_propertyprice',$this->cp_propertyprice);

		$criteria->compare('cp_propertyname',$this->cp_propertyname,true);

		$criteria->compare('cp_openingtime',$this->cp_openingtime);

		$criteria->compare('cp_defanglv',$this->cp_defanglv);

		$criteria->compare('cp_area',$this->cp_area);

		$criteria->compare('cp_fengearea',$this->cp_fengearea,true);

		$criteria->compare('cp_floorheight',$this->cp_floorheight,true);

		$criteria->compare('cp_form',$this->cp_form,true);

		$criteria->compare('cp_introduce',$this->cp_introduce,true);

		$criteria->compare('cp_traffic',$this->cp_traffic,true);

		$criteria->compare('cp_carport',$this->cp_carport,true);

		$criteria->compare('cp_propertyserver',$this->cp_propertyserver,true);

		$criteria->compare('cp_roommating',$this->cp_roommating,true);

		$criteria->compare('cp_peripheral',$this->cp_peripheral,true);

		$criteria->compare('cp_x',$this->cp_x,true);

		$criteria->compare('cp_y',$this->cp_y,true);
*/
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
     /**
     * 可以把数组的键值替换掉
     * @param <type> $arr 传递需要替换键的数组
     * @param <type> $numOrArr 传递需要替换的数组 格式是 数组需要替换的键 值是需要替换的值 也可以数字 默认给1 2 3 个默认数组
     * @return <type>
     */
   function ArrayKeyReplice($arr,$numOrArr=""){
		$arrays[1]=array("shangchang"=>"商场","shangjie"=>"商界","jiudian"=>"酒店","yinhang"=>"银行","canyin"=>"餐饮");
        $arrays[2]=array("dishang"=>"地上","dishangyue"=>"地上月租金","dishangshi"=>"地上时租","dixia"=>"地下","dixiayue"=>"地下月租金","dixiashi"=>"地下时租金");
        $arrays[3]=array("guidao"=>"轨道交通","gaojia"=>"高架","jichang"=>"机场","gongjiao"=>"公交车","huoche"=>"火车站");
        $array="";
        if(is_numeric($numOrArr)){
            switch ($numOrArr){
                case 1:$array=$arrays[1];break;
                case 2:$array=$arrays[2];break;
                case 3:$array=$arrays[3];break;
            }
        }
        if(is_array($numOrArr)){
            $array=$numOrArr;
        }
		$len=count($array);
		foreach ($arr as $key1=>$val1){
			$i=1;
			foreach($array as $key2=>$val2){
				if($key1==$key2){
				$arr1[$val2]=$val1;break;
				}else{
				$i++;
				}
			}if($i>$len){
			$arr1[$key1]=$val1;
			}
		}
		return $arr1;
    }
    /**
     *  可以吧数组转换成字符串形式
     * @param <type> $arr 需要分割的数组
     * @param <type> $str1 数组键值之间的链接符 默认 ：
     * @param <type> $str2 数组每一条值之间的划分符 默认<hr/>
     * @return string
     */
    function getStrByArray($arr,$str1="",$str2=""){
		$str1=$str1?$str1:" : ";
		$str2=$str2?$str2:"<hr/>";
        $str="";
        foreach ($arr as $key => $value) {
            if($value){
            $str.=$key .$str1. $value.$str2;
            }
        }
        return $str;
	}
}