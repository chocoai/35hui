<?php

/**
 * This is the model class for table "{{albumrecommend}}".
 *
 * The followings are the available columns in table '{{albumrecommend}}':
 * @property integer $ar_id
 * @property integer $ar_amid
 * @property integer $ar_recommendtime
 * @property integer $ar_createtime
 */
class Albumrecommend extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Albumrecommend the static model class
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
		return '{{albumrecommend}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ar_amid, ar_recommendtime, ar_createtime', 'required'),
			array('ar_amid, ar_recommendtime, ar_createtime', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ar_id, ar_amid, ar_recommendtime, ar_createtime', 'safe', 'on'=>'search'),
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
			'ar_id' => 'Ar',
			'ar_amid' => 'Ar Amid',
			'ar_recommendtime' => 'Ar Recommendtime',
			'ar_createtime' => 'Ar Createtime',
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

		$criteria->compare('ar_id',$this->ar_id);

		$criteria->compare('ar_amid',$this->ar_amid);

		$criteria->compare('ar_recommendtime',$this->ar_recommendtime);

		$criteria->compare('ar_createtime',$this->ar_createtime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 判断此相册今日是否能推荐
     * @param <type> $amId
     * @return <boolean>
     */
    public function checkCanRecommend($amId){
       $today = strtotime(date("Y-m-d"));
       $count = $this->count("ar_amid=".$amId." and ar_recommendtime=".$today);
       if($count==0){
           return true;
       }
       return false;
    }
    /**
     * 获取首页推荐
     * @param <type> $limit 返回数目
     * @return <array>
     */
    public function getAllRecommend($limit){
        //先找出推荐的
        $criteria=new CDbCriteria;
        $criteria->group = "ar_amid";
        $criteria->order = "ar_createtime desc";
        $criteria->limit = $limit;
        $recommend = Albumrecommend::model()->findAll($criteria);
        $return = array();
        $amIdArr = array();
        foreach($recommend as $value){
            $albumModel = Album::model()->findByPk($value->ar_amid);
            if($albumModel){
                $amIdArr[] = $value->ar_amid;
                $return[] = $albumModel;
            }
        }
        $len = $limit-count($return);
        if($len){
            $criteria=new CDbCriteria;
            $criteria->addNotInCondition("am_id",$amIdArr);
            $criteria->limit = $len;
            $criteria->order = "am_updatetime desc";
            $albumAll = Album::model()->findAll($criteria);
            foreach($albumAll as $value){
                $return[] = $value;
            }
        }
        return $return;
    }
}