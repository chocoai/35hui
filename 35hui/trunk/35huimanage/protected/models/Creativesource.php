<?php

/**
 * This is the model class for table "{{creativesource}}".
 *
 * The followings are the available columns in table '{{creativesource}}':
 * @property integer $cr_id
 * @property integer $cr_cpid
 * @property integer $cr_userid
 * @property string $cr_dongname
 * @property integer $cr_floortype
 * @property double $cr_area
 * @property double $cr_dayrentprice
 * @property integer $cr_monthrentprice
 * @property integer $cr_ispanorama
 * @property integer $cr_titlepicurl
 * @property integer $cr_visit
 * @property integer $cr_releasedate
 * @property integer $cr_updatedate
 * @property integer $cr_expiredate
 * @property integer $cr_check
 */
class Creativesource extends CActiveRecord
{
	public static $cyParkPicNorm = array(
        1 => array(
            'suffix'=>"_large",
            'width'=>'240',
            'height'=>'180',
        ),
        2 => array(
            'suffix'=>"_normal",
            'width'=>'120',
            'height'=>'160',
        ),
    );
	 public static $cr_floortype= array(
        "0"=>"低区",
        "1"=>"中区",
        "2"=>"高区",
    );
	 public static $checktype=array(
        "1"=>"删除",
        "2"=>"回收站",
        "3"=>"下线",
        "4"=>"已发布",
        "5"=>"未审核",
        "6"=>"已过期",
        "7"=>"已提交",
        "8"=>"草稿",
        "9"=>"违规"
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Creativesource the static model class
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
		return '{{creativesource}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cr_cpid, cr_userid, cr_dongname, cr_ispanorama', 'required'),
			array('cr_cpid, cr_userid, cr_floortype, cr_monthrentprice, cr_ispanorama, cr_titlepicurl, cr_visit, cr_releasedate, cr_updatedate, cr_expiredate, cr_check', 'numerical', 'integerOnly'=>true),
			array('cr_area, cr_dayrentprice', 'numerical'),
			array('cr_dongname', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cr_id, cr_cpid, cr_userid, cr_dongname, cr_floortype, cr_area, cr_dayrentprice, cr_monthrentprice, cr_ispanorama, cr_titlepicurl, cr_visit, cr_releasedate, cr_updatedate, cr_expiredate, cr_check', 'safe', 'on'=>'search'),
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
			'user'=>array(self::BELONGS_TO,'User','cr_userid'),
            'parkbaseinfo'=>array(self::BELONGS_TO,'Creativeparkbaseinfo','cr_cpid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cr_id' => 'Cr',
			'cr_cpid' => 'Cr Cpid',
			'cr_userid' => 'Cr Userid',
			'cr_dongname' => 'Cr Dongname',
			'cr_floortype' => 'Cr Floortype',
			'cr_area' => 'Cr Area',
			'cr_dayrentprice' => 'Cr Dayrentprice',
			'cr_monthrentprice' => 'Cr Monthrentprice',
			'cr_ispanorama' => 'Cr Ispanorama',
			'cr_titlepicurl' => 'Cr Titlepicurl',
			'cr_visit' => 'Cr Visit',
			'cr_releasedate' => 'Cr Releasedate',
			'cr_updatedate' => 'Cr Updatedate',
			'cr_expiredate' => 'Cr Expiredate',
			'cr_check' => 'Cr Check',
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

		$criteria->compare('cr_id',$this->cr_id);

		$criteria->compare('cr_cpid',$this->cr_cpid);

		$criteria->compare('cr_userid',$this->cr_userid);

		$criteria->compare('cr_dongname',$this->cr_dongname,true);

		$criteria->compare('cr_floortype',$this->cr_floortype);

		$criteria->compare('cr_area',$this->cr_area);

		$criteria->compare('cr_dayrentprice',$this->cr_dayrentprice);

		$criteria->compare('cr_monthrentprice',$this->cr_monthrentprice);

		$criteria->compare('cr_ispanorama',$this->cr_ispanorama);

		$criteria->compare('cr_titlepicurl',$this->cr_titlepicurl);

		$criteria->compare('cr_visit',$this->cr_visit);

		$criteria->compare('cr_releasedate',$this->cr_releasedate);

		$criteria->compare('cr_updatedate',$this->cr_updatedate);

		$criteria->compare('cr_expiredate',$this->cr_expiredate);

		$criteria->compare('cr_check',$this->cr_check);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}