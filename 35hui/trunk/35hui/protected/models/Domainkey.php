<?php

/**
 * This is the model class for table "{{domainkey}}".
 *
 * The followings are the available columns in table '{{domainkey}}':
 * @property integer $dk_id
 * @property string $dk_name
 * @property string $kd_key
 */
class Domainkey extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Domainkey the static model class
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
		return '{{domainkey}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dk_name, kd_key', 'required'),
			array(' kd_key', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
            array('kd_key', 'exist'),
			array('dk_id, dk_name, kd_key', 'safe', 'on'=>'search'),
		);
	}
    public function exist(){
        $model = self::model()->findByAttributes(array("kd_key"=>$this->kd_key));
        if($model){
            $this->addError('dk_name', '该域名已经存在key了！');
        }
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
			'dk_id' => 'ID',
			'dk_name' => '域名',
			'kd_key' => 'key',
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

		$criteria->compare('dk_id',$this->dk_id);

		$criteria->compare('dk_name',$this->dk_name,true);

		$criteria->compare('kd_key',$this->kd_key,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 判断当然url是否合法
     * @param <type> $key
     * @return <type>
     */
    public function validateKey($key){
        if($key==""){
            return false;
        }
        $model = self::model()->findByAttributes(array("kd_key"=>$key));
        if(!$model){//不正确的key
            return false;
        }

        $dk_name = $model->dk_name;
        $arr = @unserialize($dk_name);
        $localUrl = $_SERVER["HTTP_REFERER"];
        $localUrlArray = explode("://", $localUrl);
        $domainArray = explode("/", $localUrlArray[1]);
        $domain = $domainArray[0];
        if($arr&&in_array($domain, $arr)){
            return true;
        }
        return false;
    }
}