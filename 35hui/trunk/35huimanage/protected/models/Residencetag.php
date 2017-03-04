<?php

/**
 * This is the model class for table "{{residencetag}}".
 *
 * The followings are the available columns in table '{{residencetag}}':
 * @property integer $rt_id
 * @property integer $rt_rbiid
 * @property integer $rt_ishigh
 * @property integer $rt_isrecommend
 * @property integer $rt_ishomepage
 * @property integer $rt_ishurry
 * @property integer $rt_ispanorama
 * @property integer $rt_read
 * @property integer $rt_check
 * @property string $rt_illegalreason
 */
class Residencetag extends CActiveRecord
{
    //房源状态
    public static $rt_check = array(//1删除2回收站3已发布4已过期5草稿6违规
        1=>"删除",
        2=>"回收站",
        3=>"已发布",
        4=>"已过期",
        5=>"草稿",
        6=>"违规",
        //7=>"已提交",
        //8=>"草稿",
        //9=>"违规"
    );
    /**
     *后台是否已阅
     * @var <type>
     */
    public static $rt_read = array(
        "0"=>"否",
        "1"=>"是",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Residencetag the static model class
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
		return '{{residencetag}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rt_rbiid, rt_check', 'required'),
			array('rt_rbiid, rt_ishigh, rt_isrecommend, rt_ishomepage, rt_ishurry, rt_ispanorama, rt_read, rt_check', 'numerical', 'integerOnly'=>true),
			array('rt_illegalreason', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rt_id, rt_rbiid, rt_ishigh, rt_isrecommend, rt_ishomepage, rt_ishurry, rt_ispanorama, rt_read, rt_check, rt_illegalreason', 'safe', 'on'=>'search'),
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
			'rt_id' => 'Rt',
			'rt_rbiid' => 'Rt Rbiid',
			'rt_ishigh' => 'Rt Ishigh',
			'rt_isrecommend' => 'Rt Isrecommend',
			'rt_ishomepage' => 'Rt Ishomepage',
			'rt_ishurry' => 'Rt Ishurry',
			'rt_ispanorama' => 'Rt Ispanorama',
			'rt_read' => 'Rt Read',
			'rt_check' => 'Rt Check',
			'rt_illegalreason' => 'Rt Illegalreason',
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

		$criteria->compare('rt_id',$this->rt_id);

		$criteria->compare('rt_rbiid',$this->rt_rbiid);

		$criteria->compare('rt_ishigh',$this->rt_ishigh);

		$criteria->compare('rt_isrecommend',$this->rt_isrecommend);

		$criteria->compare('rt_ishomepage',$this->rt_ishomepage);

		$criteria->compare('rt_ishurry',$this->rt_ishurry);

		$criteria->compare('rt_ispanorama',$this->rt_ispanorama);

		$criteria->compare('rt_read',$this->rt_read);

		$criteria->compare('rt_check',$this->rt_check);

		$criteria->compare('rt_illegalreason',$this->rt_illegalreason,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}