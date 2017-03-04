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
 * @property integer $rt_check
 * @property string $rt_illegalreason
 */
class Residencetag extends CActiveRecord
{
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
			array('rt_rbiid, rt_ishigh, rt_isrecommend, rt_ishomepage, rt_ishurry, rt_ispanorama, rt_check', 'numerical', 'integerOnly'=>true),
			array('rt_illegalreason', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rt_id, rt_rbiid, rt_ishigh, rt_isrecommend, rt_ishomepage, rt_ishurry, rt_ispanorama, rt_check, rt_illegalreason', 'safe', 'on'=>'search'),
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

		$criteria->compare('rt_check',$this->rt_check);

		$criteria->compare('rt_illegalreason',$this->rt_illegalreason,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    //得到房源的四个特征:急房源,推荐房源,全景房源,优质房源
    public function getFourFeatures($id){
        $fectures = array(
            'hurry'=>false,//急房源
            'recommend'=>false,//推荐房源
            'panorama'=>false,//全景房源
            'high'=>false,//优质房源
        );
        $officeTag = $this->findByAttributes(array('rt_rbiid'=>$id));
        if($officeTag){
            if($officeTag->rt_ishurry==1){
                $fectures['hurry']=true;
            }
            if($officeTag->rt_ishigh==1){
                $fectures['high']=true;
            }
            if($officeTag->rt_isrecommend==1){
                $fectures['recommend']=true;
            }
            if($officeTag->rt_ispanorama==1){
                $fectures['panorama']=true;
            }
        }
        return $fectures;
    }
    //显示房源的四个基本特征
    public function showFourFeatures($id,$tiny=false,$template=""){
        $html = "{hurry}{high}{panorama}{recommend}";
        $mark = array('{hurry}','{high}','{panorama}','{recommend}');
        $values = array('hurry'=>'','high'=>'','panorama'=>'','recommend'=>'');
        $titleArray = array('hurry'=>'急房源','high'=>'优质房源','panorama'=>'全景房源','recommend'=>'推荐房源');
        $features = $this->getFourFeatures($id);
        if($template!==""){//如果没有上传模板,就引用默认的模板
            $html = $template;
        }
        foreach ($features as $key => $feature){
            if($feature){
                if($tiny){
                    $values[$key] = "<img src='".IMAGE_URL."/".$key."_tiny.gif' title='".$titleArray[$key]."'>";
                }else{
                    $values[$key] = "<img src='".IMAGE_URL."/".$key.".gif' title='".$titleArray[$key]."'>";
                }
            }
        }
        return str_replace($mark, $values, $html);
    }
}