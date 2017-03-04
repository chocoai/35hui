<?php

/**
 * This is the model class for table "{{downloadlog}}".
 *
 * The followings are the available columns in table '{{downloadlog}}':
 * @property integer $id
 * @property integer $uid
 * @property integer $buid_id
 * @property integer $buid_type
 * @property integer $att_type
 */
class Downloadlog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Downloadlog the static model class
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
		return '{{downloadlog}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, buid_id, buid_type, att_type', 'required'),
			array('uid, buid_id, buid_type, att_type', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, buid_id, buid_type, att_type', 'safe', 'on'=>'search'),
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
    public function haveDownload($buidid,$buidtype,$atttype,$money){
        $count = $this->count('uid=? and buid_id=? and buid_type=? and att_type=?',array(Yii::app()->user->id,$buidid,$buidtype,$atttype));
        if($count == 0){
            $model = new Downloadlog();
            $model->uid = Yii::app()->user->id;
            $model->buid_id = $buidid;
            $model->buid_type = $buidtype;
            $model->att_type = $atttype;
            $model->save();
            $description = "下载".Attachment::$buidTypeName[$buidtype].$buidid . Attachment::$attTypeName[$atttype]."，扣除{:money}新币";
            //$description = "下载".Attachment::$buidTypeName[$attachment->buid_type].$attachment->buid_id . Attachment::$attTypeName[$attachment->att_type]."，扣除{:money}新币";
            Userproperty::model()->deductMoney(Yii::app()->user->id, $money ,$description);
            return FALSE;
        }
        return TRUE;
    }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uid' => 'Uid',
			'buid_id' => 'Buid',
			'buid_type' => 'Buid Type',
			'att_type' => 'Att Type',
		);
	}
}