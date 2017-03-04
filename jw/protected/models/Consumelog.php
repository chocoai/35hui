<?php

/**
 * This is the model class for table "{{consumelog}}".
 *
 * The followings are the available columns in table '{{consumelog}}':
 * @property integer $cl_id
 * @property integer $cl_userid
 * @property integer $cl_gainorlose
 * @property integer $cl_goldnum
 * @property string $cl_description
 * @property integer $cl_recodetime
 */
class Consumelog extends CActiveRecord
{
    /**
     * 获得类型
     */
    const GAIN = 1;
    /**
     * 花费类型
     */
    const LOSE = 2;
    /**
     * 类型
     * @var <type>
     */
    public $cl_gainorlose = array(
        "1"=>"获得",
        "2"=>"花费"
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Consumelog the static model class
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
		return '{{consumelog}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cl_userid, cl_gainorlose, cl_goldnum, cl_description, cl_recodetime', 'required'),
			array('cl_id, cl_userid, cl_gainorlose, cl_goldnum, cl_recodetime', 'numerical', 'integerOnly'=>true),
			array('cl_description', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cl_id, cl_userid, cl_gainorlose, cl_goldnum, cl_description, cl_recodetime', 'safe', 'on'=>'search'),
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
			'cl_id' => 'Cl',
			'cl_userid' => 'Cl Userid',
			'cl_gainorlose' => 'Cl Gainorlose',
			'cl_goldnum' => 'Cl Score',
			'cl_description' => 'Cl Description',
			'cl_recodetime' => 'Cl Recodetime',
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

		$criteria->compare('cl_id',$this->cl_id);

		$criteria->compare('cl_userid',$this->cl_userid);

		$criteria->compare('cl_gainorlose',$this->cl_gainorlose);

		$criteria->compare('cl_goldnum',$this->cl_goldnum);

		$criteria->compare('cl_description',$this->cl_description,true);

		$criteria->compare('cl_recodetime',$this->cl_recodetime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 写log记录
     * @param <int> $userId 用户userid
     * @param <int> $gainorlose 获得还是扣除
     * @param <int> $num 数量值
     * @param <string> $description 描述
     * @return <boolean> 写log成功or失败
     */
    public function writeLog($userId,$gainorlose,$num,$description){
        if(!$num) return false;
        $model = new Consumelog();
        $model->cl_userid = $userId;
        $model->cl_gainorlose = $gainorlose;
        $model->cl_goldnum = $num;
        $model->cl_description = $description;
        $model->cl_recodetime = time();
        if($model->save()){
            return true;
        }else{
            return false;
        }
    }
}