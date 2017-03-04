<?php

/**
 * This is the model class for table "{{propcenter}}".
 *
 * The followings are the available columns in table '{{propcenter}}':
 * @property integer $pc_key
 * @property string $pc_name
 * @property string $pc_describe
 * @property integer $pc_price
 * @property integer $pc_optnumber
 * @property string $pc_url
 */
class Propcenter extends CActiveRecord {
    /**
     * 大喇叭
     */
    const horn = 1;
    /**
     * 抹黑
     */
    const reduceblackboard = 2;
    /**
     * 道具标识
     * @var <type>
     */
    public static $pc_key = array(
            "1"=>"大喇叭",
            "2"=>"抹黑牌",
    );
    /**
     * 图片尺寸 服务器上不存在包含后缀的文件
     * @var <type>
     */
    public static $pc_urlSize = array(
            1 => array(
                            'suffix'=>"_xx",
                            'width'=>'210',
                            'height'=>'240',
            ),
    );
    /**
     * Returns the static model of the specified AR class.
     * @return Propcenter the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{propcenter}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                array('pc_key, pc_name, pc_describe', 'required'),
                array('pc_key, pc_price, pc_optnumber', 'numerical', 'integerOnly'=>true),
                array('pc_name, pc_url', 'length', 'max'=>50),
                array("pc_optnumber","CNumberValidator", 'min'=>1, 'tooSmall'=>'操作数最小为1'),
                array("pc_url","file","allowEmpty"=>true,"maxSize"=>"5242880","tooLarge"=>"文件最大允许上传5M","types"=>"jpg","wrongType"=>"请上传jpg格式的图片"),
                array('pc_key, pc_name, pc_describe, pc_price, pc_optnumber, pc_url', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
                'pc_key' => 'Pc Key',
                'pc_name' => '名称',
                'pc_describe' => '描述',
                'pc_price' => '价格',
                'pc_optnumber' => '操作数',
                'pc_url' => '图片',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('pc_key',$this->pc_key);

        $criteria->compare('pc_name',$this->pc_name,true);

        $criteria->compare('pc_describe',$this->pc_describe,true);

        $criteria->compare('pc_price',$this->pc_price);

        $criteria->compare('pc_optnumber',$this->pc_optnumber);

        $criteria->compare('pc_url',$this->pc_url,true);

        return new CActiveDataProvider(get_class($this), array(
                        'criteria'=>$criteria,
        ));
    }
    /**
     * 判断是否可以给该用户赠送道具
     * @param <type> $receiveUser 接收者
     * @return <type>
     */
    public function checkCanSendProp($receiveUser) {
        $userId = User::model()->getId();
        $count = Attention::model()->count("at_userid=".$userId." and at_attentionuserid=".$receiveUser);
        if($count) {
            return true;
        }else {
            return false;
        }
    }
    /**
     * 使用大喇叭
     * @param <type> $key
     * @param <type> $title
     * @param <type> $content
     */
    public function useHorn($key,$title,$content) {
        $userId = User::model()->getId();
        $criteria=new CDbCriteria;
        $criteria->addCondition("u_id!=".$userId);
        $allUser = User::model()->findAll($criteria);
        foreach($allUser as $value) {
            $model = new Usermessage();
            $model->um_userid = $value->u_id;
            $model->um_fromid = $userId;
            $model->um_title = htmlspecialchars($title);
            $model->um_content = htmlspecialchars($content);
            $model->um_createtime = time();
            $model->um_readstate = 0;
            $model->um_delstate = 0;
            $model->save();
        }
    }
    /**
     * 使用清黑牌道具
     * @param <type> $key
     */
    public function useReduceblackboard($key) {
        $userId = User::model()->getId();
        $model = $this->findByPk($key);
        if($model) {
            $memberModel = Member::model()->findByAttributes(array("mem_userid"=>$userId));
            $memberModel->mem_blackboard -= $model->pc_optnumber;
            $memberModel->mem_blackboard<0?$memberModel->mem_blackboard=0:"";
            $memberModel->update();
            //消除成功，发送系统消息
            Systemmessage::model()->sendMessage("使用道具（".$model->pc_name."）消除".$model->pc_optnumber."个黑牌");
        }
    }
    /**
     * 上传礼物道具图片
     * @param <type> $tempFile
     * @param <type> $oldPicName
     * @return <string> 新文件名
     */
    public function uploadImg($tempFile,$oldPicName){
        $path = "/gift";
        $fileName = time().rand(100,999);
        $filePath = $path."/".$fileName.".jpg";
        $targetFile =  PIC_PATH.$filePath;
        $boolUploadFile = move_uploaded_file($tempFile,$targetFile);
//      处理缩略图
        $imageDeal = new Image();
        $imageDeal->formatWithPicture($targetFile,Propcenter::$pc_urlSize);//处理缩略图
        unlink($targetFile);
        $suffixName = str_replace(".","_xx.",$targetFile);
        rename($suffixName, $targetFile);
        //删除原来的头像
        if($oldPicName){
            @unlink(DOCUMENTROOT.$oldPicName);
        }
        return "/upload".$filePath;
    }
}