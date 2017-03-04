<?php

/**
 * This is the model class for table "{{keywordlink}}".
 *
 * The followings are the available columns in table '{{keywordlink}}':
 * @property integer $kdl_id
 * @property string $kdl_name
 * @property string $kdl_url
 */
class Keywordlink extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Keywordlink the static model class
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
		return '{{keywordlink}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kdl_name, kdl_url', 'required'),
			array('kdl_name', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('kdl_id, kdl_name, kdl_url', 'safe', 'on'=>'search'),
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
			'kdl_id' => 'Kdl',
			'kdl_name' => '名称',
			'kdl_url' => '链接地址',
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

		$criteria->compare('kdl_id',$this->kdl_id);

		$criteria->compare('kdl_name',$this->kdl_name,true);

		$criteria->compare('kdl_url',$this->kdl_url,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

    /**
     *
     * @param <type> $content
     * @return <type> 
     */
    public function regContentByAllKeyword($content){
        $kwd = $this->findAll();
        if($kwd){
            foreach($kwd as $value){
                $content = str_replace($value->kdl_name, CHtml::link($value->kdl_name,$value->kdl_url,array("target"=>"_blank")), $content);
            }
        }
        return $content;
    }
}