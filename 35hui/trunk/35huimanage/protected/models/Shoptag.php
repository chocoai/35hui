<?php

/**
 * This is the model class for table "{{shoptag}}".
 *
 * The followings are the available columns in table '{{shoptag}}':
 * @property integer $st_id
 * @property integer $st_shopid
 * @property integer $st_ishigh
 * @property integer $st_isrecommend
 * @property integer $st_ishomepage
 * @property integer $st_isvideo
 * @property integer $st_ispanorama
 * @property integer $st_isconsign
 * @property integer $st_consignid
 * @property integer $st_isnew
 * @property integer $st_ishurry
 * @property integer $st_check
 * @property integer $st_isread
 */
class Shoptag extends CActiveRecord
{
    public static $st_ishigh = array(
        "0"=>"否",
        "1"=>"是",
    );
    //房源状态
    public static $st_check = array(
        1=>"彻底删除",
        2=>"回收站",
        3=>"下线",
        4=>"已发布",
        5=>"未审核",
        6=>"已过期",
        7=>"已提交",
        8=>"草稿",
        9=>"违规",
    );
    /**
     *后台是否已阅
     * @var <type>
     */
    public static $st_isread = array(
        "0"=>"否",
        "1"=>"是",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Shoptag the static model class
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
		return '{{shoptag}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('st_shopid, st_ishigh, st_isrecommend, st_ishomepage, st_isvideo, st_ispanorama, st_isconsign, st_consignid, st_isnew, st_ishurry, st_check, st_isread', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('st_id, st_shopid, st_ishigh, st_isrecommend, st_ishomepage, st_isvideo, st_ispanorama, st_isconsign, st_consignid, st_isnew, st_ishurry, st_check, st_isread', 'safe', 'on'=>'search'),
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
			'st_id' => 'St',
			'st_shopid' => 'St Shopid',
			'st_ishigh' => '是否优质',
			'st_isrecommend' => '是否推荐',
			'st_ishomepage' => '是否首页显示',
			'st_isvideo' => '是否有视频',
			'st_ispanorama' => '是否有全景',
			'st_isconsign' => '是否委托',
			'st_consignid' => 'St Consignid',
			'st_isnew' => '是否新房源',
			'st_ishurry' => '是否急房源',
			'st_check' => '审核状态',
            'st_isread'=>'是否已阅',
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

		$criteria->compare('st_id',$this->st_id);

		$criteria->compare('st_shopid',$this->st_shopid);

		$criteria->compare('st_ishigh',$this->st_ishigh);

		$criteria->compare('st_isrecommend',$this->st_isrecommend);

		$criteria->compare('st_ishomepage',$this->st_ishomepage);

		$criteria->compare('st_isvideo',$this->st_isvideo);

		$criteria->compare('st_ispanorama',$this->st_ispanorama);

		$criteria->compare('st_isconsign',$this->st_isconsign);

		$criteria->compare('st_consignid',$this->st_consignid);

		$criteria->compare('st_isnew',$this->st_isnew);

		$criteria->compare('st_ishurry',$this->st_ishurry);

		$criteria->compare('st_check',$this->st_check);

        $criteria->compare('st_isread',$this->st_isread);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     *判断已有的shop信息，为修改做准备。所有修改都不更改最近更新时间。
     * @param <type> $model
     * @return <type>
     */
    public function validateTagModel($model){
        //如果是已经发布的房源，则判断是否是急房源，急房源审核状态不变，普通房源则要变成未审核状态；如果是还没有发布的房源，统一不改变审核状态。
        if($model->st_check==4){
            if(!$model->st_ishurry){
                $model->st_check = 5;//普通房源则要变成未审核状态。
            }
        }
        return $model;
    }
    /**
     *计算此房源已经花费的商务币
     * @param <array> $shops
     * @return <type>
     */
    public function countCostMoney($shops){
        $money = 0;
        if($shops){
            foreach($shops as $value){
                $model = $this->findByAttributes(array("st_shopid"=>$value));
                //计算要扣的商务币。
                $money += 4;
                if($model->st_isrecommend==1){
                    $money += 6;
                }
                if($model->st_ishurry==1){
                    $money += 10;
                }
            }
        }
        return $money;
    }
}