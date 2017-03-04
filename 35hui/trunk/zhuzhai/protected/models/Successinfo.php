<?php

/**
 * This is the model class for table "{{successinfo}}".
 *
 * The followings are the available columns in table '{{successinfo}}':
 * @property integer $si_id
 * @property integer $si_userid
 * @property integer $si_buildid
 * @property string $si_buildname
 * @property string $si_companyname
 * @property integer $si_floortype
 * @property double $si_area
 * @property integer $si_successtime
 */
class Successinfo extends CActiveRecord
{
    /**
     * 楼层信息
     * @var <type>
     */
    public static $si_floortype = array(
            "1"=>"高区",
            "2"=>"中区",
            "3"=>"低区",
    );
    /**
     * Returns the static model of the specified AR class.
     * @return Successinfo the static model class
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
        return '{{successinfo}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                array('si_userid, si_buildid, si_buildname, si_companyname, si_floortype, si_area, si_successtime', 'required'),
                array('si_userid, si_buildid, si_floortype, si_successtime', 'numerical', 'integerOnly'=>true),
                array('si_area', 'numerical'),
                array('si_buildname', 'length', 'max'=>200),
                array('si_companyname', 'length', 'max'=>300),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('si_id, si_userid, si_buildid, si_buildname, si_companyname, si_floortype, si_area, si_successtime', 'safe', 'on'=>'search'),
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
                'si_id' => 'Si',
                'si_userid' => '用户ID',
                'si_buildid' => '写字楼ID',
                'si_buildname' => '写字楼名称',
                'si_companyname' => '公司名称',
                'si_floortype' => '楼层类型',
                'si_area' => '面积',
                'si_successtime' => '成交时间',
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

        $criteria->compare('si_id',$this->si_id);

        $criteria->compare('si_userid',$this->si_userid);

        $criteria->compare('si_buildid',$this->si_buildid);

        $criteria->compare('si_buildname',$this->si_buildname,true);

        $criteria->compare('si_companyname',$this->si_companyname,true);

        $criteria->compare('si_floortype',$this->si_floortype);

        $criteria->compare('si_area',$this->si_area);

        $criteria->compare('si_successtime',$this->si_successtime);

        return new CActiveDataProvider(get_class($this), array(
                        'criteria'=>$criteria,
        ));
    }
    /**
     * 得到最近的成功案例
     * @param <type> $userId
     * @param <type> $limit 条数
     * @return <type>
     */
    public function getRecentInfo($userId, $limit){
        $criteria=new CDbCriteria;
        $criteria->order = "si_successtime desc";
        $criteria->limit = $limit;
        $criteria->addColumnCondition(array("si_userid"=>$userId));
        $all = Successinfo::model()->findAll($criteria);
        return $all;
    }
}
