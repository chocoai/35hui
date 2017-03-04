<?php

/**
 * This is the model class for table "{{officetag}}".
 *
 * The followings are the available columns in table '{{officetag}}':
 * @property integer $ot_id
 * @property integer $ot_officeid
 * @property integer $ot_ishigh
 * @property integer $ot_isrecommend
 * @property integer $ot_ishomepage
 * @property integer $ot_isvideo
 * @property integer $ot_is3d
 * @property integer $ot_isconsign
 * @property integer $ot_consignid
 * @property integer $ot_isnew
 * @property integer $ot_ishurry
 * @property integer $ot_check
 * @property string $ot_illegalreason
 * @property integer $ot_isread
 */
class Officetag extends CActiveRecord
{
    //房源状态
    public static $ot_check = array(
        1=>"删除",
        2=>"回收站",
        3=>"下线",
        4=>"已发布",
        5=>"未审核",
        6=>"审核中",
        7=>"已提交",
        8=>"草稿",
        9=>"违规"
    );
    /**
     *后台是否已阅
     * @var <type>
     */
    public static $ot_isread = array(
        "0"=>"否",
        "1"=>"是",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Officetag the static model class
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
		return '{{officetag}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ot_officeid, ot_check', 'required'),
			array('ot_officeid, ot_ishigh, ot_isrecommend, ot_ishomepage, ot_isvideo,ot_ispanorama, ot_isconsign, ot_consignid, ot_isnew, ot_ishurry, ot_check, ot_isread', 'numerical', 'integerOnly'=>true),
			array('ot_illegalreason', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ot_id, ot_officeid, ot_ishigh, ot_isrecommend, ot_ishomepage, ot_isvideo,ot_ispanorama,ot_isconsign, ot_consignid, ot_isnew, ot_ishurry, ot_check, ot_illegalreason, ot_isread', 'safe', 'on'=>'search'),
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
			'ot_id' => 'Ot',
			'ot_officeid' => 'Ot Officeid',
			'ot_ishigh' => 'Ot Ishigh',
			'ot_isrecommend' => 'Ot Isrecommend',
			'ot_ishomepage' => 'Ot Ishomepage',
			'ot_isvideo' => 'Ot Isvideo',
			'ot_is3d' => 'Ot Is3d',
			'ot_isconsign' => 'Ot Isconsign',
			'ot_consignid' => 'Ot Consignid',
			'ot_isnew' => 'Ot Isnew',
			'ot_ishurry' => 'Ot Ishurry',
			'ot_check' => 'Ot Check',
			'ot_illegalreason' => 'Ot Illegalreason',
            'ot_isread'=>"是否已阅",
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

		$criteria->compare('ot_id',$this->ot_id);

		$criteria->compare('ot_officeid',$this->ot_officeid);

		$criteria->compare('ot_ishigh',$this->ot_ishigh);

		$criteria->compare('ot_isrecommend',$this->ot_isrecommend);

		$criteria->compare('ot_ishomepage',$this->ot_ishomepage);

		$criteria->compare('ot_isvideo',$this->ot_isvideo);

		$criteria->compare('ot_is3d',$this->ot_is3d);

		$criteria->compare('ot_isconsign',$this->ot_isconsign);

		$criteria->compare('ot_consignid',$this->ot_consignid);

		$criteria->compare('ot_isnew',$this->ot_isnew);

		$criteria->compare('ot_ishurry',$this->ot_ishurry);

		$criteria->compare('ot_check',$this->ot_check);

		$criteria->compare('ot_illegalreason',$this->ot_illegalreason,true);

        $criteria->compare('ot_isread',$this->ot_isread);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}