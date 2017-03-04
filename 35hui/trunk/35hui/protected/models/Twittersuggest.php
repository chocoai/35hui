<?php

/**
 * This is the model class for table "{{twittersuggest}}".
 *
 * The followings are the available columns in table '{{twittersuggest}}':
 * @property integer $ts_id
 * @property integer $ts_userid
 * @property integer $ts_buildingid
 * @property string $ts_content
 * @property integer $ts_suggesttime
 */
class Twittersuggest extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Twittersuggest the static model class
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
		return '{{twittersuggest}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ts_id', 'required'),
			array('ts_id, ts_userid, ts_buildingid, ts_suggesttime', 'numerical', 'integerOnly'=>true),
			array('ts_content', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ts_id, ts_userid, ts_buildingid, ts_content, ts_suggesttime', 'safe', 'on'=>'search'),
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
			'ts_id' => 'Ts',
			'ts_userid' => 'Ts Userid',
			'ts_buildingid' => 'Ts Buildingid',
			'ts_content' => 'Ts Content',
			'ts_suggesttime' => 'Ts Suggesttime',
		);
	}
    /**
     * 根据id和类型，得到要显示的名称
     * @param <type> $sourceId
     * @param <type> $type
     * @return <type>
     */
    public function getBuildName($sourceId, $type){
        $title = "";
        if($type==1){//楼盘
            $model = Systembuildinginfo::model()->findByPk($sourceId);
            if($model)
                $title = $model->sbi_buildingname;
        }elseif($type==2){//住宅
            $model = Communitybaseinfo::model()->findByPk($sourceId);
            if($model)
                $title = $model->comy_name;
        }
        return $title;
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

		$criteria->compare('ts_id',$this->ts_id);

		$criteria->compare('ts_userid',$this->ts_userid);

		$criteria->compare('ts_buildingid',$this->ts_buildingid);

		$criteria->compare('ts_content',$this->ts_content,true);

		$criteria->compare('ts_suggesttime',$this->ts_suggesttime);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}