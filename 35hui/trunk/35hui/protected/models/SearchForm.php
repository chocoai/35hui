<?php

/**
 * SearchForm 类.
 * SearchForm 是用来搜集用户搜索条件的类
 */
class SearchForm extends CFormModel
{
	public $exact; //精确查找条件
	public $type;  //物业类型
	public $price; //楼盘均价
	public $area;  //楼盘面积
	public $region; //区域
	public $traffic; //轨道交通
	public $hotM;   //热门地图


	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
	     return array(
	     	
	     );
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
	        'exact'=>'楼盘地址定位',
		);
	}

	/**
	 * 用于提交数据
	 */
	public function getAttribute()
	{
		if(!$this->hasErrors())  // we only want to authenticate when no input errors
		{
			return array( 
			      'exact'=>$this->exact,
				  'type'=>$this->type,
				  'price'=>$this->price,
				  'area'=>$this->area,
				  'region'=>$this->region,
				  'traffic'=>$this->traffic,
				  'hotM'=>$this->hotM,
				  );  			
		}
	}
}
