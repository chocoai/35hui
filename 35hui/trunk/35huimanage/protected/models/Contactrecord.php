<?php
/**
 * This is the model class for table "{{contactrecord}}".
 *
 * The followings are the available columns in table '{{contactrecord}}':
 * @property integer $cr_id
 * @property integer $cr_peid
 * @property string $cr_company
 * @property string $cr_realname
 * @property integer $cr_province
 * @property integer $cr_city
 * @property integer $cr_district
 * @property integer $cr_section
 * @property string $cr_tel
 * @property string $cr_mobile
 * @property string $cr_email
 * @property string $cr_qq
 * @property integer $cr_mainbusiness
 * @property integer $cr_isregistered
 * @property string $cr_salesman
 * @property string $cr_remark
 * @property integer $cr_time
 */
class Contactrecord extends CActiveRecord
{
     public static $cr_mainbusiness = array(
        1 => '写字楼',
        2 => '商铺',
        3 => '住宅',
    );
     public static $cr_type = array(
        0 => '否',
        1 => '是',
    );
     public static $cr_grade = array(
         0=>'未知',
        1 => '最佳客户',
        2 => '好客户',
        3 => '次等客户',
        4 => '比较次等',
    );
    /**
     * Returns the static model of the specified AR class.
     * @return Contactrecord the static model class
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
        return '{{contactrecord}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cr_company, cr_realname, cr_province, cr_city, cr_district, cr_section, cr_mainbusiness, cr_salesman, cr_time,cr_mobile,cr_remark,cr_type,cr_grade', 'required'),
            array('cr_userid, cr_province, cr_city, cr_district, cr_section, cr_mainbusiness, cr_isregistered, cr_time, cr_type, cr_grade', 'numerical', 'integerOnly'=>true),
            array('cr_company, cr_mobile, cr_email', 'length', 'max'=>50),
            array('cr_realname, cr_tel, cr_qq, cr_salesman', 'length', 'max'=>20),
            array('cr_remark', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('cr_id, cr_userid, cr_company, cr_realname, cr_province, cr_city, cr_district, cr_section, cr_tel, cr_mobile, cr_email, cr_qq, cr_mainbusiness, cr_isregistered, cr_salesman, cr_remark, cr_time', 'safe', 'on'=>'search'),
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
            'cr_id' => 'ID',
            'cr_userid' => '关联表35_uagent中ID',
            'cr_company' => '所属公司',
            'cr_realname' => '联系人姓名',
            'cr_province' => '所属省份',
            'cr_city' => '所属城市',
            'cr_district' => '所属区域',
            'cr_section' => '所属板块',
            'cr_tel' => '电话号码',
            'cr_mobile' => '手机号码',
            'cr_email' => 'Email地址',
            'cr_qq' => 'QQ号码',
            'cr_mainbusiness' => '主营业务',
            'cr_isregistered' => '是否注册',
            'cr_salesman' => '登记人',
            'cr_remark' => '备注',
            'cr_time' => '创建时间',
            'cr_type' => '是否跟进',
            'cr_grade' => '客户等级',
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

        $criteria->compare('cr_id',$this->cr_id);

        $criteria->compare('cr_userid',$this->cr_userid);

        $criteria->compare('cr_company',$this->cr_company,true);

        $criteria->compare('cr_realname',$this->cr_realname,true);

        $criteria->compare('cr_province',$this->cr_province);

        $criteria->compare('cr_city',$this->cr_city);

        $criteria->compare('cr_district',$this->cr_district);

        $criteria->compare('cr_section',$this->cr_section);

        $criteria->compare('cr_tel',$this->cr_tel,true);

        $criteria->compare('cr_mobile',$this->cr_mobile,true);

        $criteria->compare('cr_email',$this->cr_email,true);

        $criteria->compare('cr_qq',$this->cr_qq,true);

        $criteria->compare('cr_mainbusiness',$this->cr_mainbusiness);

        $criteria->compare('cr_isregistered',$this->cr_isregistered);

        $criteria->compare('cr_salesman',$this->cr_salesman,true);

        $criteria->compare('cr_remark',$this->cr_remark,true);

        $criteria->compare('cr_time',$this->cr_time);
        
        $criteria->compare('cr_time',$this->cr_type);
        
        $criteria->compare('cr_time',$this->cr_grade);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }

    public function getMainBussinessName($num) {
        $name = "";
        if(key_exists($num, self::$cr_mainbusiness)){
            $name = self::$cr_mainbusiness[$num];
        }
        return $name;
    }

} 

?>
