<?php
class Forum_post  extends MyActiveRecord {
	public  function  getDbConnection()
	{
	return  self::getAdvertDbConnection();
	}
    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function tableName()
	{
		return 'pre_forum_post';
	}
	
}
