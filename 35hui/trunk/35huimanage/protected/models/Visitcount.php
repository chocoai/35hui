<?php

class Visitcount extends CActiveRecord
{
    const buildingType = 1;//楼盘类型
    const officeTpye = 2;//写字楼
    const companyTpye = 3;//中介公司类型。
    const businessType = 4;//商务中心房源类型
    const shopType = 5;//商铺类型
	/**
	 * The followings are the available columns in table '{{visitcount}}':
	 * @var integer $vc_id
	 * @var integer $vc_type
	 * @var integer $vc_tid
	 * @var integer $vc_value
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
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
		return '{{visitcount}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vc_id, vc_type, vc_tid, vc_value', 'required'),
			array('vc_id, vc_type, vc_tid, vc_value', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('vc_id, vc_type, vc_tid, vc_value', 'safe', 'on'=>'search'),
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
			'vc_id' => 'Vc',
			'vc_type' => 'Vc Type',
			'vc_tid' => 'Vc Tid',
			'vc_value' => 'Vc Value',
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

		$criteria->compare('vc_id',$this->vc_id);

		$criteria->compare('vc_type',$this->vc_type);

		$criteria->compare('vc_tid',$this->vc_tid);

		$criteria->compare('vc_value',$this->vc_value);

		return new CActiveDataProvider('Visitcount', array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 根据传入类型和资源id得到点击数。
     * @param <int> $type 类型
     * @param <int> $tid 资源id
     * @return <int>
     */
    public function getHits($type,$tid){
        $row = $this->findbyAttributes(array('vc_type'=>$type,'vc_tid'=>$tid));
        $hits = 0;
        if($row!=""){
            $hits = $row->vc_value;
        }
        return $hits;
    }
    /**
     * 增加点击次数
     * @param <type> $type
     * @param <type> $sourceId
     * @return boolean
     */
    public function addHits($type,$sourceId){
        $result = false;
        $dba = dba();
        $model = $this->findByAttributes(array('vc_type'=>$type,'vc_tid'=>$sourceId));
        if($model){
            $model->vc_value = intval($model->vc_value)+1;
            if($model->save())
                $result = true;
        }else{
            $model = new Visitcount;
            $model->vc_id = $dba->id('35_visitcount');
            $model->vc_type = $type;
            $model->vc_tid = $sourceId;
            $model->vc_value = 1;
            if($model->save())
                $result = true;
        }
        return $result;
    }
    /**
     * 根据Cookie判断是否增加访问次数
     * @param <type> $type 访问类型
     * @param <type> $sourceId 访问的数据的id
     */
    public function addVisit($type,$sourceId){
        $cookieName = 'viewIds';//cookie名称
        $expiretime = time()+86400;//cookie的保存时间
        $tempCookie = Yii::app()->request->cookies[$cookieName];
        if(isset($tempCookie) && $tempCookie!=""){//已经看过楼盘
            $viewIdStr = $tempCookie->value;
            $viewIdArray = json_decode($viewIdStr,true);
            if(array_key_exists($type,$viewIdArray) && in_array($sourceId, $viewIdArray[$type])){//表明看过该种类型的该数据
                return null;
            }else{//表明没看过
                $viewIdArray[$type][] = $sourceId;
                $viewIdStr = json_encode($viewIdArray);
                $cookie=new CHttpCookie($cookieName,$viewIdStr);
                $cookie->expire = $expiretime;
                Yii::app()->request->cookies[$cookieName]=$cookie;
                //点击数加1
                $this->addHits($type,$sourceId);//增加一次点击次数
            }
        }else{//Cookie中还没有记录任何访问的cookie数据
            $cookieArray = array();
            $cookieArray[$type][] = $sourceId;
            $cookieStr = json_encode($cookieArray);
            $cookie=new CHttpCookie($cookieName,$cookieStr);
            $cookie->expire = $expiretime;
            Yii::app()->request->cookies[$cookieName]=$cookie;
            //点击数加1
            $this->addHits($type,$sourceId);//增加一次点击次数
        }
    }
}