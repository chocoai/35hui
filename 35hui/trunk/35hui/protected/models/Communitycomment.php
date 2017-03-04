<?php

class Communitycomment extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{communitycomment}}';
	}

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comyc_uid, comyc_comyid', 'required'),
			array('comyc_comment', 'length', 'max'=>3000),
			array('comyc_comment', 'safe'),
			array('comyc_id, comyc_uid, comyc_comyid, comyc_comment, comyc_comdate', 'safe', 'on'=>'search'),
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
            'communityInfo'=>array(self::BELONGS_TO,'Communitybaseinfo','comyc_comyid'),
            'userInfo'=>array(self::BELONGS_TO,'User','comyc_uid'),
		);
	}
    
     public function getCommentByCommunityId($communityId,$pageNum=5){
        $criteria=new CDbCriteria(array(
            'condition'=>"comyc_comyid=".$communityId,
            'order'=>'comyc_comdate DESC',
        ));
        $dataProvider = new CActiveDataProvider('Communitycomment',array(
            'pagination'=>array(
                'pageSize'=>$pageNum,
            ),
            'criteria'=>$criteria,
        ));
        return $dataProvider;
    }

}