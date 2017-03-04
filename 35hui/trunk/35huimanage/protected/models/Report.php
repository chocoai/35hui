<?php

/**
 * This is the model class for table "{{report}}".
 *
 * The followings are the available columns in table '{{report}}':
 * @property integer $r_id
 * @property integer $r_sinfuluserid
 * @property integer $r_sinfulbuildid
 * @property integer $r_type
 * @property integer $r_buildtype
 * @property integer $r_informantuserid
 * @property string $r_informantusername
 * @property string $r_informantip
 * @property string $r_informanttelphone
 * @property string $r_informantemail
 * @property integer $r_state
 * @property integer $r_date
 */
class Report extends CActiveRecord
{
    /**
     *举报消息
     * @var <array>
     */    
    const office = 1;//写字楼
    const shop = 2;//商铺
    const residence = 3;//住宅
    public static $reportmeg = array(
        "1"=>"房源不存在或已售",
        "2"=>"价格、面积严重失实",
        "3"=>"图片，资料失实",
    );
    /**
     *房源类型
     * @var <array>
     */
    public static $buildtype = array(
        "1"=>"写字楼",
        "2"=>"商铺",
        "3"=>"住宅"
    );

	/**
	 * Returns the static model of the specified AR class.
	 * @return Report the static model class
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
		return '{{report}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('r_sinfuluserid, r_sinfulbuildid, r_type, r_buildtype, r_informantip, r_state', 'required'),
			array('r_sinfuluserid, r_sinfulbuildid, r_type, r_buildtype, r_informantuserid, r_state, r_date', 'numerical', 'integerOnly'=>true),
			array('r_informantusername, r_informantip, r_informanttelphone, r_informantemail', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('r_id, r_sinfuluserid, r_sinfulbuildid, r_type, r_buildtype, r_informantuserid, r_informantusername, r_informantip, r_informanttelphone, r_informantemail, r_state, r_date', 'safe', 'on'=>'search'),
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
			'r_id' => '举报Id',
			'r_sinfuluserid' => '被举报的UserID',
			'r_sinfulbuildid' => '被举报的房源ID',
			'r_type' => '举报类型',
			'r_buildtype' => '被举报的房源类型',
			'r_informantuserid' => '举报者的UserID',
			'r_informantusername' => '举报者姓名',
			'r_informantip' => '举报者IP',
			'r_informanttelphone' => '举报者联系电话',
			'r_informantemail' => '举报者Email',
			'r_state' => '举报状态',
			'r_date' => '举报日期',
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

		$criteria->compare('r_id',$this->r_id);

		$criteria->compare('r_sinfuluserid',$this->r_sinfuluserid);

		$criteria->compare('r_sinfulbuildid',$this->r_sinfulbuildid);

		$criteria->compare('r_type',$this->r_type);

		$criteria->compare('r_buildtype',$this->r_buildtype);

		$criteria->compare('r_informantuserid',$this->r_informantuserid);

		$criteria->compare('r_informantusername',$this->r_informantusername,true);

		$criteria->compare('r_informantip',$this->r_informantip,true);

		$criteria->compare('r_informanttelphone',$this->r_informanttelphone,true);

		$criteria->compare('r_informantemail',$this->r_informantemail,true);

		$criteria->compare('r_state',$this->r_state);

		$criteria->compare('r_date',$this->r_date);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 返回被举报房源的链接
     * @param <type> $sourceId 房源id
     * @param <type> $sourceType 房源类型
     * @return <type>
     */
    public function getHouseLink($sourceId,$sourceType){
        $result = "";
        $houseInfo = $this->getHouseInfo($sourceId, $sourceType);
        if($houseInfo){
            if($sourceType==self::office){//如果是写字楼类型
                if($houseInfo->ob_sellorrent==Officebaseinfo::rent){
                    $link = MAINHOST.Yii::app()->createUrl('officebaseinfo/rentView',array('id'=>$sourceId));
                }else{
                    $link = MAINHOST.Yii::app()->createUrl('officebaseinfo/saleView',array('id'=>$sourceId));
                }
                $result = "<a target='_blank' href='".$link."'>".CHtml::encode($houseInfo->presentInfo['op_officetitle'])."</a>";
            }if($sourceType==self::shop){//如果是商铺类型

                if($houseInfo->sb_sellorrent=Shopbaseinfo::rent){
                    
                    $link = MAINHOST.Yii::app()->createUrl('shopbaseinfo/rentView',array('id'=>$sourceId));
                }else{
                    $link = MAINHOST.Yii::app()->createUrl('shopbaseinfo/saleView',array('id'=>$sourceId));
                }
                $result = "<a target='_blank' href='".$link."'>".CHtml::encode($houseInfo->presentInfo['sp_shoptitle'])."</a>";
            }if($sourceType==self::residence){//如果是住宅类型
                $link = MAINHOST.Yii::app()->createUrl('communitybaseinfo/viewResidence',array('id'=>$sourceId));
                $result = "<a target='_blank' href='".$link."'>".CHtml::encode($houseInfo->rbi_title)."</a>";
            }
        }
        return $result;
    }
    public function getHouseInfo($sourceId,$sourceType){
        $result = array();
        if($sourceType==self::office){//如果是写字楼类型
            $result = Officebaseinfo::model()->with("presentInfo")->findByAttributes(array('ob_officeid'=>$sourceId));
        }elseif($sourceType==self::shop){
            $result = Shopbaseinfo::model()->with("presentInfo")->findByAttributes(array('sb_shopid'=>$sourceId));
        }elseif($sourceType==self::residence){
            $result = Residencebaseinfo::model()->findByAttributes(array('rbi_id'=>$sourceId));
        }
        return $result;
    }
}