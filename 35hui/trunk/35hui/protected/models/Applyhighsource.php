//<?php
//
///**
// * This is the model class for table "{{applyhighsource}}".
// *
// * The followings are the available columns in table '{{applyhighsource}}':
// * @property integer $ahs_id
// * @property integer $ahs_userid
// * @property integer $ahs_type
// * @property integer $ahs_sourceid
// * @property integer $ahs_status
// * @property string $ahs_message
// * @property integer $ahs_releasetime
// */
//class Applyhighsource extends CActiveRecord
//{
//    /**
//     * 类型
//     * @var <type>
//     */
//    public static $ahs_type =  array(
//        "1"=>"写字楼",
//        "2"=>"商铺",
//        "3"=>"住宅",
//    );
//    /**
//     * 状态
//     * @var <type>
//     */
//    public static $ahs_status = array(
//        "0"=>"未审核",
//        "1"=>"审核通过",
//        "2"=>"审核不通过",
//    );
//
//	/**
//	 * Returns the static model of the specified AR class.
//	 * @return Applyhighsource the static model class
//	 */
//	public static function model($className=__CLASS__)
//	{
//		return parent::model($className);
//	}
//
//	/**
//	 * @return string the associated database table name
//	 */
//	public function tableName()
//	{
//		return '{{applyhighsource}}';
//	}
//
//	/**
//	 * @return array validation rules for model attributes.
//	 */
//	public function rules()
//	{
//		// NOTE: you should only define rules for those attributes that
//		// will receive user inputs.
//		return array(
//			array('ahs_userid, ahs_type, ahs_sourceid, ahs_releasetime', 'required'),
//			array('ahs_userid, ahs_type, ahs_sourceid, ahs_status, ahs_releasetime', 'numerical', 'integerOnly'=>true),
//			array('ahs_message', 'safe'),
//			// The following rule is used by search().
//			// Please remove those attributes that should not be searched.
//			array('ahs_id, ahs_userid, ahs_type, ahs_sourceid, ahs_status, ahs_message, ahs_releasetime', 'safe', 'on'=>'search'),
//		);
//	}
//
//	/**
//	 * @return array relational rules.
//	 */
//	public function relations()
//	{
//		// NOTE: you may need to adjust the relation name and the related
//		// class name for the relations automatically generated below.
//		return array(
//		);
//	}
//
//	/**
//	 * @return array customized attribute labels (name=>label)
//	 */
//	public function attributeLabels()
//	{
//		return array(
//			'ahs_id' => 'Ahs',
//			'ahs_userid' => '用户id',
//			'ahs_type' => '资源类型',
//			'ahs_sourceid' => '资源id',
//			'ahs_status' => '审核状态',
//			'ahs_message' => '消息',
//			'ahs_releasetime' => '录入时间',
//		);
//	}
//
//	/**
//	 * Retrieves a list of models based on the current search/filter conditions.
//	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
//	 */
//	public function search()
//	{
//		// Warning: Please modify the following code to remove attributes that
//		// should not be searched.
//
//		$criteria=new CDbCriteria;
//
//		$criteria->compare('ahs_id',$this->ahs_id);
//
//		$criteria->compare('ahs_userid',$this->ahs_userid);
//
//		$criteria->compare('ahs_type',$this->ahs_type);
//
//		$criteria->compare('ahs_sourceid',$this->ahs_sourceid);
//
//		$criteria->compare('ahs_status',$this->ahs_status);
//
//		$criteria->compare('ahs_message',$this->ahs_message,true);
//
//		$criteria->compare('ahs_releasetime',$this->ahs_releasetime);
//
//		return new CActiveDataProvider(get_class($this), array(
//			'criteria'=>$criteria,
//		));
//	}
//    /**
//     * 返回前台描述文字
//     * @param <type> $ahs_status
//     * @return <type>
//     */
//    public function getStatusName($ahs_status){
//        switch ($ahs_status){
//            default:
//                $return = "";
//                break;
//            case 0:
//                $return = "审核中";
//                break;
//            case 1:
//                $return = "<font color='green'>优质</font>";
//                break;
//            case 2:
//                $return = "<font color='red'>未通过</font>";
//                break;
//        }
//        return $return;
//    }
//    /**
//     * 根据查询的结果集，计算每类的数目
//     * @param <type> $userId
//     * @return <type>
//     */
//    public function cuontNum($userId){
//        $criteria=new CDbCriteria;
//        $criteria->addColumnCondition(array("ahs_userid"=>$userId));
//        $allInfo = Applyhighsource::model()->findAll($criteria);
//
//        $officeNum = $shopNum = $zhuzhaiNum = 0;
//        if($allInfo){
//            foreach ($allInfo as $value){
//                $value["ahs_type"]==1?$officeNum+=1:"";
//                $value["ahs_type"]==2?$shopNum+=1:"";
//                $value["ahs_type"]==3?$zhuzhaiNum+=1:"";
//            }
//        }
//        return array("officeNum"=>$officeNum, "shopNum"=>$shopNum, "zhuzhaiNum"=>$zhuzhaiNum);
//    }
//    /**
//     * 返回最大发布数
//     * @param <type> $userId
//     * @return <type>
//     */
//    public function getMaxHighSourceNum($userId){
//        //先看是否购买了套餐。
//        $grade = User::model()->getUserGrade($userId);
//        $num = 0;
//        if($grade=="0"){//表示如果此用户没购买套餐，则使用默认值
//            //查看用户的认证情况。根据不同的认证情况的到值
//            switch(User::model()->getCurrentRole()){
//                case 1://个人
//                    $num = Oprationconfig::model()->getConfigByName("default_high_num",0);
//                    break;
//                case 2://经纪人 需要通过所有认证
//                    if(Uagent::model()->getIdentityCertification($userId)&&Uagent::model()->getSeniorityCertification($userId)){
//                        $num = Oprationconfig::model()->getConfigByName("default_high_num",0);
//                    }
//                    break;
//            }
//        }else{//使用套餐中的值
//            $combo = Combo::model()->findByAttributes(array('cb_userlevel'=>$grade));
//            $num = $combo['cb_highnum'];//设优数目
//        }
//        return $num;
//    }
//    /**
//     * 验证是否还能申请
//     * @param <type> $userId
//     * @param <type> $type 类型 1写字楼 2商铺 3住宅
//     * @return <boolean>
//     */
//    public function validateApplyAuthority($userId, $type){
//        $return = false;
//        $maxNum = $this->getMaxHighSourceNum($userId);
//        $nowNum = $this->cuontNum($userId);
//        switch ($type){
//            default:
//                break;
//            case 1://写字楼
//                $maxNum>$nowNum["officeNum"]?$return=true:"";
//                break;
//            case 2://商铺
//                $maxNum>$nowNum["shopNum"]?$return=true:"";
//                break;
//            case 3://住宅
//                $maxNum>$nowNum["zhuzhaiNum"]?$return=true:"";
//                break;
//        }
//        return $return;
//    }
//}