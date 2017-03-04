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
        "0"=>"政策",
        "1"=>"成交数据",
        "2"=>"调查报告",
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
     /**
     *通过资讯类型得到一定数目的资讯。
     * @param <type> $state对应资讯类型。如果为all表示全部资讯。
     * @param <type> $limit
     * @return <type>
     */
    public function getNewsByType($state,$limit=10){
        $criteria=new CDbCriteria;
        $criteria->condition = "n_state=".$state;
        $criteria->limit = $limit;
        $criteria->order = "n_date desc";
        $news = $this->findAll($criteria);
        return $news;
    }
    /**
     *得到所有的排序。第一条是头条，之后的排序都只按时间排序
     * @param <type> $limit
     * @return <array>
     */
    public function getAllNews($limit=10){
        $return  = array();
        $leaveOne = $this->findByAttributes(array("n_leave"=>1));//头条，头条只会有一条
        $criteria=new CDbCriteria;
        if($leaveOne){//如果有头条
            $return[] = $leaveOne->attributes;//头条放第一位
            $criteria->addCondition("n_id!=".$leaveOne->n_id);//之后的查询条件不能有头条
            $limit -= 1;//之后的查询条件减一
        }
        $criteria->limit = $limit;
        $criteria->order = "n_date desc";
        $newsOther = $this->findAll($criteria);
        if($newsOther){
            foreach($newsOther as $value){
                $return[] = $value->attributes;
            }
        }
        return $return;
    }
    /**
     *得到最新的资讯
     * @param <type> $limit
     * @return <type>
     */
    public function getRecentNews($limit=10){
        $criteria=new CDbCriteria;
        $criteria->limit = $limit;
        $criteria->order = "n_date desc";
        $news = $this->findAll($criteria);
        return $news;
    }
    /**
     *通过点击数对新闻排行
     * @param <type> $limit
     * @return <type>
     */
    public function getNewsByClick($limit=10){
        $criteria=new CDbCriteria;
        $criteria->limit = $limit;
        $criteria->order = "n_click desc";
        $news = $this->findAll($criteria);
        return $news;
    }

	/**
     *增加点击数
     * @param <type> $nid 资讯id
     */
	public function updateClick($nid)
	{
        $click = News::model()->findByPK($nid);
        $click->n_click = $click->n_click+1;
        $click->save();
	}
}