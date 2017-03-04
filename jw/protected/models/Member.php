<?php

/**
 * This is the model class for table "{{member}}".
 *
 * The followings are the available columns in table '{{member}}':
 * @property integer $mem_id
 * @property integer $mem_userid
 * @property integer $mem_sex
 * @property string $mem_telephone
 * @property string $mem_company
 * @property string $mem_jobnumber
 */
class Member extends CActiveRecord
{
    public $mem_telhide = array(
        "0"=>"显示",
        "1"=>"隐藏",
    );
    public $mem_qqhide = array(
        "0"=>"显示",
        "1"=>"隐藏",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Member the static model class
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
		return '{{member}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mem_userid, mem_sex, mem_telephone', 'required'),
			array('mem_userid, mem_sex,  mem_birthday, mem_height, mem_weight,', 'numerical', 'integerOnly'=>true),
			array('mem_telephone', 'length', 'max'=>11),
			array('mem_company', 'length', 'max'=>32),
			array('mem_jobnumber', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('mem_id, mem_userid, mem_sex, mem_telephone, mem_company, mem_jobnumber, mem_threesize', 'safe', 'on'=>'search'),
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
			'mem_id' => 'Mem',
			'mem_userid' => 'Mem Userid',
			'mem_sex' => '性别',
			'mem_telephone' => '手机号码',
			'mem_company' => '公司',
			'mem_jobnumber' => '工号',
            'mem_birthday' => '出生日期',
            'mem_height' => '身高',
            'mem_weight' => '体重',
            'mem_threesize' => '三维',
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
/*
		$criteria->compare('mem_id',$this->mem_id);

		$criteria->compare('mem_userid',$this->mem_userid);

		$criteria->compare('mem_sex',$this->mem_sex);

		$criteria->compare('mem_telephone',$this->mem_telephone,true);


		$criteria->compare('mem_company',$this->mem_company,true);

		$criteria->compare('mem_jobnumber',$this->mem_jobnumber,true);
*/
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 获取公司名称
     * @param <type> $memberModel
     * @return <string>
     */
    public function getMemberCompany($memberModel){
        $return = "自由职业";
        if($memberModel->mem_company){
            $return = Companymanage::model()->getNameById($memberModel->mem_company);
        }
        return $return;
    }
    /**
     * 获取用户最后更新的相册的图片
     * @param <type> $userId
     * @param <type> $suffix
     * @return <string>
     */
    public function getLastUpdateAlbum($userId,$suffix){
        $return = "/images/default/noalbum.jpg";
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("am_userid"=>$userId));
        $criteria->order = "am_updatetime desc";
        $albumModel = Album::model()->find($criteria);
        if($albumModel){
            $return = Album::model()->getAlbumcoverUrl($albumModel,$suffix);
        }
        return $return;
    }
}