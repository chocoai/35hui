<?php
class Forum_thread  extends MyActiveRecord {
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
		return 'pre_forum_thread';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fid, posttableid, typeid, sortid, readperm, price, authorid, replies, displayorder, highlight, digest, rate, special, attachment, moderated, closed, stickreply, recommends, recommend_add, recommend_sub, status, isgroup, favtimes, sharetimes, stamp, icon, pushedaid, cover, replycredit', 'numerical', 'integerOnly'=>true),
			array('author, lastposter', 'length', 'max'=>15),
			array('subject', 'length', 'max'=>80),
			array('dateline, lastpost, views, heats', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('tid, fid, posttableid, typeid, sortid, readperm, price, author, authorid, subject, dateline, lastpost, lastposter, views, replies, displayorder, highlight, digest, rate, special, attachment, moderated, closed, stickreply, recommends, recommend_add, recommend_sub, heats, status, isgroup, favtimes, sharetimes, stamp, icon, pushedaid, cover, replycredit', 'safe', 'on'=>'search'),
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
			'tid' => 'Tid',
			'fid' => 'Fid',
			'posttableid' => 'Posttableid',
			'typeid' => 'Typeid',
			'sortid' => 'Sortid',
			'readperm' => 'Readperm',
			'price' => 'Price',
			'author' => 'Author',
			'authorid' => 'Authorid',
			'subject' => 'Subject',
			'dateline' => 'Dateline',
			'lastpost' => 'Lastpost',
			'lastposter' => 'Lastposter',
			'views' => 'Views',
			'replies' => 'Replies',
			'displayorder' => 'Displayorder',
			'highlight' => 'Highlight',
			'digest' => 'Digest',
			'rate' => 'Rate',
			'special' => 'Special',
			'attachment' => 'Attachment',
			'moderated' => 'Moderated',
			'closed' => 'Closed',
			'stickreply' => 'Stickreply',
			'recommends' => 'Recommends',
			'recommend_add' => 'Recommend Add',
			'recommend_sub' => 'Recommend Sub',
			'heats' => 'Heats',
			'status' => 'Status',
			'isgroup' => 'Isgroup',
			'favtimes' => 'Favtimes',
			'sharetimes' => 'Sharetimes',
			'stamp' => 'Stamp',
			'icon' => 'Icon',
			'pushedaid' => 'Pushedaid',
			'cover' => 'Cover',
			'replycredit' => 'Replycredit',
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

		$criteria->compare('tid',$this->tid);
		$criteria->compare('fid',$this->fid);
		$criteria->compare('posttableid',$this->posttableid);
		$criteria->compare('typeid',$this->typeid);
		$criteria->compare('sortid',$this->sortid);
		$criteria->compare('readperm',$this->readperm);
		$criteria->compare('price',$this->price);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('authorid',$this->authorid);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('dateline',$this->dateline,true);
		$criteria->compare('lastpost',$this->lastpost,true);
		$criteria->compare('lastposter',$this->lastposter,true);
		$criteria->compare('views',$this->views,true);
		$criteria->compare('replies',$this->replies);
		$criteria->compare('displayorder',$this->displayorder);
		$criteria->compare('highlight',$this->highlight);
		$criteria->compare('digest',$this->digest);
		$criteria->compare('rate',$this->rate);
		$criteria->compare('special',$this->special);
		$criteria->compare('attachment',$this->attachment);
		$criteria->compare('moderated',$this->moderated);
		$criteria->compare('closed',$this->closed);
		$criteria->compare('stickreply',$this->stickreply);
		$criteria->compare('recommends',$this->recommends);
		$criteria->compare('recommend_add',$this->recommend_add);
		$criteria->compare('recommend_sub',$this->recommend_sub);
		$criteria->compare('heats',$this->heats,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('isgroup',$this->isgroup);
		$criteria->compare('favtimes',$this->favtimes);
		$criteria->compare('sharetimes',$this->sharetimes);
		$criteria->compare('stamp',$this->stamp);
		$criteria->compare('icon',$this->icon);
		$criteria->compare('pushedaid',$this->pushedaid);
		$criteria->compare('cover',$this->cover);
		$criteria->compare('replycredit',$this->replycredit);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
}
