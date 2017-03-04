<?php

/**
 * This is the model class for table "{{news}}".
 *
 * The followings are the available columns in table '{{news}}':
 * @property integer $n_id
 * @property string $n_title
 * @property string $n_summary
 * @property string $n_content
 * @property integer $n_date
 * @property string $n_from
 * @property integer $n_state
 * @property integer $n_click
 * @property string $n_keyword
 * @property integer $n_leave
 */
class News extends CActiveRecord
{
    //新闻类型
	public static $state = array(
        "0"=>"政策法规",
        "1"=>"统计数据",
        "2"=>"市场行情",
        "3"=>"研究报告"
    );
    //新闻等级
    public static $leave = array(
        "4"=>"普通",
        "3"=>"重要",
        "2"=>"较重要",
        "1"=>"头条",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return News the static model class
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
		return '{{news}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('n_title, n_summary, n_content, n_from, n_state, n_keyword', 'required'),
			array('n_date, n_state, n_click, n_leave', 'numerical', 'integerOnly'=>true),
			array('n_title, n_from, n_keyword', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('n_id, n_title, n_summary, n_content, n_date, n_from, n_state, n_click, n_keyword, n_leave', 'safe', 'on'=>'search'),
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
            'n_id' => 'ID',
			'n_title' => '标题',
            'n_summary' => '摘要',
			'n_content' => '内容',
			'n_date' => '新闻日期',
			'n_from' => '新闻来源',
			'n_state' => '新闻类型',
			'n_click' => '点击率',
			'n_keyword' => '关键字',
			'n_leave' => '新闻等级',
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

		$criteria->compare('n_id',$this->n_id);

		$criteria->compare('n_title',$this->n_title,true);

		$criteria->compare('n_summary',$this->n_summary,true);

		$criteria->compare('n_content',$this->n_content,true);

		$criteria->compare('n_date',$this->n_date);

		$criteria->compare('n_from',$this->n_from,true);

		$criteria->compare('n_state',$this->n_state);

		$criteria->compare('n_click',$this->n_click);

		$criteria->compare('n_keyword',$this->n_keyword,true);

		$criteria->compare('n_leave',$this->n_leave);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    public function updateLeave(){
        $list = $this->findAll("n_leave=1");
        foreach($list as $value){
            $value->n_leave = 4;//把头条都设置为普通
            $value->save();
        }
    }
}