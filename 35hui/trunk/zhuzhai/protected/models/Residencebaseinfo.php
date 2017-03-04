<?php

/**
 * This is the model class for table "{{residencebaseinfo}}".
 *
 * The followings are the available columns in table '{{residencebaseinfo}}':
 * @property integer $rbi_id
 * @property integer $rbi_communityid
 * @property integer $rbi_uid
 * @property integer $rbi_rentorsell
 * @property double $rbi_area
 * @property integer $rbi_room
 * @property integer $rbi_office
 * @property integer $rbi_bathroom
 * @property integer $rbi_floor
 * @property integer $rbi_allfloor
 * @property integer $rbi_buildingera
 * @property integer $rbi_toward
 * @property string $rbi_decoration
 * @property integer $rbi_number
 * @property string $rbi_title
 * @property string $rbi_residencedesc
 * @property integer $rbi_releasedate
 * @property integer $rbi_updatedate
 * @property integer $rbi_titlepicurl
 * @property integer $rr_validdate
 */
class Residencebaseinfo extends CActiveRecord
{
    public static $rbi_adrondegree = array(
        1 => '毛坯',
        2 => '简单装修',
        3 => '精装修',
        4 => '豪华装修',
    );
    /**
     *朝向
     */
    public static $rbi_towards = array(
        1 => '东',
        2 => '南',
        3 => '西',
        4 => '北',
        5 => '东南',
        6 => '西南',
        7 => '西北',
        8 => '东北',
        9 => '南北',
        10 => '东西',
    );
    /**
     * 租售类型
     */
    public static $rbi_sellorrent = array(
        "1"=>"出租",
        "2"=>"出售",
    );
	/**
	 * Returns the static model of the specified AR class.
	 * @return Residencebaseinfo the static model class
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
		return '{{residencebaseinfo}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rbi_communityid, rbi_uid, rbi_rentorsell, rbi_area, rbi_room, rbi_office, rbi_bathroom, rbi_floor, rbi_allfloor, rbi_toward, rbi_decoration, rbi_title, rbi_releasedate, rbi_updatedate, rr_validdate', 'required'),
			array('rbi_communityid, rbi_uid, rbi_rentorsell, rbi_room, rbi_office, rbi_bathroom, rbi_floor, rbi_allfloor, rbi_buildingera, rbi_toward, rbi_releasedate, rbi_updatedate, rbi_titlepicurl, rr_validdate', 'numerical', 'integerOnly'=>true),
			array('rbi_area', 'numerical'),
			array('rbi_decoration', 'length', 'max'=>10),
			array('rbi_title, rbi_number', 'length', 'max'=>100),
			array('rbi_residencedesc, rbi_number', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rbi_id, rbi_communityid, rbi_uid, rbi_rentorsell, rbi_area, rbi_room, rbi_office, rbi_bathroom, rbi_floor, rbi_allfloor, rbi_buildingera, rbi_toward, rbi_decoration, rbi_number, rbi_title, rbi_residencedesc, rbi_releasedate, rbi_updatedate, rbi_titlepicurl, rr_validdate', 'safe', 'on'=>'search'),
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
            'rentInfo'=>array(self::HAS_ONE,"Residencerentinfo","rr_rbiid"),
            'sellInfo'=>array(self::HAS_ONE,"Residencesellinfo","rs_rbiid"),
            'user'=>array(self::BELONGS_TO,'User','rbi_uid'),
            'community'=>array(self::BELONGS_TO,'Communitybaseinfo','rbi_communityid'),
            'residenceTag'=>array(self::HAS_ONE,'Residencetag','rt_rbiid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rbi_id' => 'Rbi',
			'rbi_communityid' => 'Rbi Communityid',
			'rbi_uid' => 'Rbi Uid',
			'rbi_rentorsell' => 'Rbi Rentorsell',
			'rbi_area' => 'Rbi Area',
			'rbi_room' => 'Rbi Room',
			'rbi_office' => 'Rbi Office',
			'rbi_bathroom' => 'Rbi Bathroom',
			'rbi_floor' => 'Rbi Floor',
			'rbi_allfloor' => 'Rbi Allfloor',
			'rbi_buildingera' => 'Rbi Buildingera',
			'rbi_toward' => 'Rbi Toward',
			'rbi_decoration' => 'Rbi Decoration',
			'rbi_number' => 'Rbi Number',
			'rbi_title' => 'Rbi Title',
			'rbi_residencedesc' => 'Rbi Residencedesc',
			'rbi_releasedate' => 'Rbi Releasedate',
			'rbi_updatedate' => 'Rbi Updatedate',
			'rbi_titlepicurl' => 'Rbi Titlepicurl',
            'rbi_order' => 'Rbi Order',
            'rbi_visit' => 'Rbi Visit',
			'rr_validdate' => 'Rr Validdate',
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

		$criteria->compare('rbi_id',$this->rbi_id);

		$criteria->compare('rbi_communityid',$this->rbi_communityid);

		$criteria->compare('rbi_uid',$this->rbi_uid);

		$criteria->compare('rbi_rentorsell',$this->rbi_rentorsell);

		$criteria->compare('rbi_area',$this->rbi_area);

		$criteria->compare('rbi_room',$this->rbi_room);

		$criteria->compare('rbi_office',$this->rbi_office);

		$criteria->compare('rbi_bathroom',$this->rbi_bathroom);

		$criteria->compare('rbi_floor',$this->rbi_floor);

		$criteria->compare('rbi_allfloor',$this->rbi_allfloor);

		$criteria->compare('rbi_buildingera',$this->rbi_buildingera);

		$criteria->compare('rbi_toward',$this->rbi_toward);

		$criteria->compare('rbi_decoration',$this->rbi_decoration,true);

		$criteria->compare('rbi_number',$this->rbi_number);

		$criteria->compare('rbi_title',$this->rbi_title,true);

		$criteria->compare('rbi_residencedesc',$this->rbi_residencedesc,true);

		$criteria->compare('rbi_releasedate',$this->rbi_releasedate);

		$criteria->compare('rbi_updatedate',$this->rbi_updatedate);

		$criteria->compare('rbi_titlepicurl',$this->rbi_titlepicurl);

		$criteria->compare('rr_validdate',$this->rr_validdate);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

    public function getSellorRentInfoByCommunityid($comy_id,$sellorrent,$limit=10){
        $criteria = new CDbCriteria;
        $criteria->limit=$limit;
        $criteria->with['residenceTag']=array('condition'=>'rt_check=4');
        $criteria->order= "rbi_updatedate desc";
        $criteria->addColumnCondition(array("rbi_communityid"=>$comy_id,"rbi_rentorsell"=>$sellorrent));
        return Residencebaseinfo::model()->findAll($criteria);
    }
    /**
     * 保存发布住宅
     */
    public function saveReleseHouse($baseM,$baseExtM,$tagM,$picture,$issell = 1){
        if($baseM->save()){
            if($issell){
                $baseExtM->rs_rbiid = $baseM->rbi_id;
            }else{
                $baseExtM->rr_rbiid = $baseM->rbi_id;
            }
            
            $baseExtM->save();
            $tagM->rt_rbiid = $baseM->rbi_id;
            $tagM->save();

            //保存图片
            Picture::model()->insertImg($picture,$baseM->rbi_id,Picture::$sourceType['residencebaseinfo']);//默认使用最后上传的图片做为标题图
            return $baseM->rbi_id;
        }else{
            return false;
        }
    }
     /**
     *检查传入住宅id是否属于当前用户
     * @param <array> $shopIdArr
     * @return <boolean>
     */
    public function checkResidenceIdIsCurrentUser($shopIdArr){
        $return = true;
        $nowId = Yii::app()->user->id;
        if($shopIdArr){
            foreach($shopIdArr as $value){
                $residenceBaseInfo = $this->findByPk($value);
                if(!$residenceBaseInfo||$nowId != $residenceBaseInfo->rbi_uid){
                    $return = false;
                    break;
                }
            }
        }
        return $return;
    }

     /*
     * 通过传入的get，得到写字楼基本的DataProvider
     * @param $get get方法传递的参数
     * @param 租或售 ，与officebaseinfo中对应。为3表示不限
	 * @return integer
     */
    public function getManageDataProvider($state,$sellorrent,$request){
        $userId = Yii::app()->user->id;
        $criteria = new CDbCriteria;
        $criteria->condition = "rbi_uid=".$userId;
        if(!empty($request['kwd'])){//搜索标题
            $criteria->addSearchCondition('rbi_title',$request['kwd']);// = "op_officetitle like '%".$get['kwd']."%'";
        }
        if($sellorrent!=3){//租售不限
            $criteria->addCondition("rbi_rentorsell=".$sellorrent);
        }
        if(!empty($request['serialnum'])){
            $criteria->addSearchCondition("rbi_number",$request['serialnum']);
        }
        //排序
        if(empty($request['od'])) $request['od'] = 5;
        if($request['od']==1){
            $criteria->order = 'rbi_updatedate';
        }else if($request['od']==2){
            $criteria->order = 'rbi_updatedate desc';
        }else if($request['od']==3){
            $criteria->order = 'rbi_releasedate';
        }else if($request['od']==4){
            $criteria->order = 'rbi_releasedate desc';
        }else{
            $criteria->order = 'rbi_id desc';
        }
        //关联标签表
        $tagCondition = 'rt_check='.$state;//已发布
        if( isset($request['officeState']) ){
            if($request['officeState']==1){//显示急房源
                $tagCondition .= " and rt_ishurry=1";
            }else if ($request['officeState']==2){//显示热推房源
                $tagCondition .= " and rt_isrecommend=1";
            }else if ($request['officeState']==3){//显示优质房源
                $tagCondition .= " and rt_ishigh=1";
            }else if ($request['officeState']==4){//显示全景房源
                $tagCondition .= " and rt_ispanorama=1";
            }elseif($request['officeState']==5){//显示置顶推广房源
                $criteria->addColumnCondition(array(
                    "tr_sourcetype"=>3,
                ));
                $criteria->addCondition("tr_endtime>".time());//只显示还没过期的。
            }
        }
        $communityCondition = "";
        if(isset($request['buildTypeId'])&&$request['buildTypeId']!=""){//搜索标题
            $communityCondition = "rbi_communityid=".$request['buildTypeId'];
        }
        
        //关联展示表
        $criteria->with = array(
            'residenceTag'=>array(
                'condition'=>$tagCondition,
            ),
            'community'=>array(
                'condition'=>$communityCondition,
            ),
        );
        $dataProvider=new CActiveDataProvider('Residencebaseinfo', array(
            'pagination'=>array(
                'pageSize'=>10,
            ),
            'criteria'=>$criteria,
        ));
        return $dataProvider;
    }

    public function getDataProvider($get, $rentOrSale,$condition,$params=array()) {
        $regionParamToColumn = array(
            'province'=>'comy_province',
            'city'=>'comy_city',
            'district'=>'comy_district',
            'section'=>'comy_section',
        );
        $criteria=new CDbCriteria(array(
                'condition'=>$condition,
                'params'=>$params,
                'with'=>array(
                    'community',
                    'residenceTag'=>array(
                        'condition'=>"rt_check=4",//只显示发布状态的。
                    )
                ),//留着给租金和售价条件使用
        ));

        if(isset($get['keyword']) && $get['keyword']!="") {
            $keyword = $get['keyword'];
            $idArr = @common::getIdsBySphinxSearch($keyword, Yii::app()->params['residenceIndex'],"array");
            $criteria->addInCondition('rbi_id', $idArr);//print_r($criteria);exit;
        }

        $searchParams = SearchMenu::getSearchConditionParams();//得到其他搜索条件参数名称集合
        $searchParams = array_diff($searchParams,array('type'));//过滤掉已有的type类型
        $regionParams = SearchMenu::getRegionParams();//得到地区搜索条件参数名称集合
        foreach($searchParams as $pkey=>$searchParam) {
            if(isset($get[$searchParam]) && $get[$searchParam]!="") {
                $searchCondition = $this->getSearchCondition($get[$searchParam]);//根据搜索条件的id得到搜索信息
                if($searchCondition) {
                    if($pkey==20 || $pkey==107 ) {//查询租金和售价
                        if($rentOrSale=='sale' && $pkey==20) {
                            $withName = "sellInfo";
                            $criteria->with[$withName]=array('condition'=>$searchCondition['field'].">=".$searchCondition['min']." and ".$searchCondition['field']."<=".$searchCondition['max']);
                            if(isset($get['order'])){
                                if($get['order']=='smu'){//按总价升序
                                    $criteria->order =" rs_price asc,rt_ispanorama desc,rt_isrecommend desc";
                                }elseif($get['order']=='smd'){//按总价降序
                                    $criteria->order =" rs_price desc,rt_ispanorama desc,rt_isrecommend desc";
                                }elseif($get['order']=='vgu'){//按单价升序
                                    $criteria->order =" rs_unitprice asc,rt_ispanorama desc,rt_isrecommend desc";
                                }elseif($get['order']=='vgd'){//按单价降序
                                    $criteria->order =" rs_unitprice desc,rt_ispanorama desc,rt_isrecommend desc";
                                }
                            }
                        }elseif($rentOrSale=='rent' && $pkey==107) {
                            $withName = "rentInfo";
                            $criteria->with[$withName]=array('condition'=>$searchCondition['field'].">=".$searchCondition['min']." and ".$searchCondition['field']."<=".$searchCondition['max']);
                            if(isset($get['order'])){
                                if($get['order']=='ru'){//按租金升序
                                    $criteria->order =" rr_rentprice asc,rt_ispanorama desc,rt_isrecommend desc";
                                }elseif($get['order']=='rd'){//按租金降序
                                    $criteria->order =" rr_rentprice desc,rt_ispanorama desc,rt_isrecommend desc";
                                }
                            }
                        }
                    }elseif($pkey==56) {//查询房源
                        if($searchCondition['min']==2){//代表是个人房源
                            $criteria->with['user']=array('condition'=>$searchCondition['field']."=".User::personal);
                        }else{//代表的则是中介房源了,中介房源寻找门店和经纪人两种
                            $criteria->with['user']=array('condition'=>$searchCondition['field']." in (".User::agent.",".User::company.")");
                        }
                    }else {
                        $criteria->addCondition($searchCondition['field'].">=".$searchCondition['min']." and ".$searchCondition['field']."<=".$searchCondition['max']);
                    }
                }
            }
        }
        /*区域找房*/
        foreach($regionParams as $regionParam) {
            if(isset($get[$regionParam]) && $get[$regionParam]!="") {
                if(array_key_exists($regionParam,$regionParamToColumn)) {
                    $criteria->addColumnCondition(array($regionParamToColumn[$regionParam]=>$get[$regionParam]));
                }
            }
        }
        /*地铁找房*/
        if(isset($get['line'])&&$get['line']!=""){
            $criteria->addCondition("comy_line like '%".",".$get['line'].","."%'");
        }
        if(isset($get['station'])&&$get['station']!=""){
            $criteria->addCondition("comy_traffic like '%".",".$get['station'].","."%'");
        }
        
        if(isset($get['id'])&&$get['id']!=""){
            $criteria->addCondition("rbi_communityid =".$get['id']);
        }

        //得到其他的过滤条件
        $criteria = $this->getOtherOrderCondition($criteria,$get);
        //其他排序
        if(!isset($get['order'])||$get['order']==""){
            //$criteria->order ="rt_ispanorama desc,rt_isrecommend desc,rbi_updatedate desc";old order
            $criteria->order ="rt_isbuyregion desc,rbi_order desc,rbi_updatedate desc";
            //$criteria->order ="rbi_updatedate desc";
        }else{
            if($get['order']=='au'){//按面积升序
                $criteria->order =" rbi_area asc,rt_ispanorama desc,rt_isrecommend desc";
            }elseif($get['order']=='ad'){//按面积降序
                $criteria->order =" rbi_area desc,rt_ispanorama desc,rt_isrecommend desc";
            }
        }
        $dataProvider=new CActiveDataProvider('Residencebaseinfo', array(
                'pagination'=>array(
                    'pageSize'=>Yii::app()->params['postsPerPage'],
                ),
                'criteria'=>$criteria,
        ));
        return $dataProvider;
    }
    /**
     * 根据条件的主键返回对应的条件
     * @param <type> $id 条件的主键id
     * @return <array> field:对应的条件字段 max:最大值 min:最小值
     */
    public function getSearchCondition($id) {
        $residenceCondition=array(//用来对应residencebaseinfo表中的条件字段(键对应的是searchcondition表中的大类sc_id,值对应的是residencebaseinfo表中的字段名称)
            1=>'rbi_rentorsell',
            6=>'rbi_area',
            20=>'rs_price',//售价,这里对应的是residencesellinfo表的字段
            107=>'rr_rentprice',//租价,这里对应的是residencerentinfo表的字段
            119=>'rbi_room',//房型,这里对应的是residencebaseinfo表的字段
            126=>'comy_propertytype',//物业类型,这里对应的是communitybaseinfo表的字段
            56=>'user_role',//房源,这里对应的user表中的字段,还需要特殊处理
        );
        if(!$id) {
            return array();
        }else {
            $result=array();
            $condition = Searchcondition::model()->findByPk($id);//得到数据库的对应搜索信息
            if($condition!=null && array_key_exists($condition->sc_parentid,$residenceCondition)) {
                $result['field']=$residenceCondition[$condition->sc_parentid];
                $result['max']=$condition->sc_maxvalue;
                $result['min']=$condition->sc_minvalue;
            }
            return $result;
        }
    }
    /**
     *得到其他的查询条件和排序条件
     * f排序 vgu单价升序 vgd单价降序 smu总价升序 smd总价降序 au面积升序 ad面积降序
     * type房源类型 1推荐房源 2多媒体房源 3全景房源 4急房源
     * @param <type> $criteria
     * @return <type>
     */
    public function getOtherOrderCondition($criteria,$get){
        //过滤排序状态
        if(isset($get['order'])&&$get['order']=="vgu"){//如果设置的单价的排序，并且排序向上
            if(!isset($criteria->with['sellInfo'])){
                $criteria->with['sellInfo']=array('order'=>'rs_unitprice');
            }else{
                $criteria->with['sellInfo']['order'] ='rs_unitprice';
            }
        }
        if(isset($get['order'])&&$get['order']=="vgd"){//如果设置的单价的排序，并且排序向下
            if(!isset($criteria->with['sellInfo'])){
                $criteria->with['sellInfo']=array('order'=>'rs_unitprice desc');
            }else{
                $criteria->with['sellInfo']['order'] ='rs_unitprice desc';
            }
        }
        if(isset($get['order'])&&$get['order']=="ru"){//如果设置的单价的排序，并且排序向上
            if(!isset($criteria->with['rentInfo'])){
                $criteria->with['rentInfo']=array('order'=>'rr_rentprice');
            }else{
                $criteria->with['rentInfo']['order'] ='rr_rentprice';
            }
        }
        if(isset($get['order'])&&$get['order']=="rd"){//如果设置的单价的排序，并且排序向下
            if(!isset($criteria->with['rentInfo'])){
                $criteria->with['rentInfo']=array('order'=>'rr_rentprice desc');
            }else{
                $criteria->with['rentInfo']['order'] ='rr_rentprice desc';
            }
        }
        if(isset($get['order'])&&$get['order']=="smu"){//如果设置的总价的排序，并且排序向下
            if(!isset($criteria->with['sellInfo'])){
                $criteria->with['sellInfo']=array('order'=>'rs_price');
            }else{
                $criteria->with['sellInfo']['order'] ='rs_price';
            }
        }
        if(isset($get['order'])&&$get['order']=="smd"){//如果设置的总价的排序，并且排序向下
            if(!isset($criteria->with['sellInfo'])){
                $criteria->with['sellInfo']=array('order'=>'rs_price desc');
            }else{
                $criteria->with['sellInfo']['order'] ='rs_price desc';
            }
        }
        if(isset($get['order'])&&$get['order']=="au"){//如果设置的面积的排序，并且排序向上
           $criteria->order = "rbi_area";
        }
        if(isset($get['order'])&&$get['order']=="ad"){//如果设置的面积的排序，并且排序向下
           $criteria->order = "rbi_area desc";
        }
        //开始过滤显示房源类型
        if(isset($get['sourcetag'])&&$get['sourcetag']!=""){//如果只推荐房源
            if($criteria->with['residenceTag']['condition']==""){
                $criteria->with['residenceTag']['condition'] = "1";
            }
            switch ($get['sourcetag']){
                case 1: //推荐房源
                    $criteria->with['residenceTag']['condition'] .= " and rt_isrecommend=1";
                    break;
                case 2: //多媒体房源
                    break;
                case 3: //全景房源
                    $criteria->with['residenceTag']['condition'] .= " and rt_ispanorama=1";
                    break;
                case 4: //急房源
                    $criteria->with['residenceTag']['condition'] .= " and rt_ishurry=1";
                    break;
            }
        }
        //根据时间过滤
        if(isset($get['filterdate'])&&$get['filterdate']!=""){
            $filterdate = $get['filterdate'];
            $allFilterDate = Searchcondition::model()->getAllFilterDate();
            if(array_key_exists($filterdate, $allFilterDate)){//数据准确
                $condition = Searchcondition::model()->getConditionValue($filterdate);//得到查询值
                $time = time();
                $begin = $time-$condition['max'];//从当前时间减去数据库中保存的时间
                if($condition['max']!=0){//0是不限
                    $criteria->addBetweenCondition("rbi_updatedate",$begin,$time);
                }
            }
        }
        return $criteria;
    }
    
     public function getFitment($intFitment) {
        $fitment = "";
        if(array_key_exists($intFitment, self::$rbi_adrondegree)){
            $fitment = self::$rbi_adrondegree[$intFitment];
        }
        return $fitment;
    }

     public function getNewPanoramaSource($limit){
        $criteria=new CDbCriteria();
        $criteria->addColumnCondition(array("spn_sourcetype"=>4,"spn_state"=>2));
        $criteria->select = "spn_sourceid";
        $criteria->order = "spn_completetime desc";
        $criteria->group = "spn_sourceid";
        $criteria->limit = $limit;
        $panorama = Subpanorama::model()->findAll($criteria);
        $sourceIdArr = array();
        foreach($panorama as $value){
            $sourceIdArr[] = $value["spn_sourceid"];
        }
         
        $criteria=new CDbCriteria();
        $criteria->addInCondition("rbi_id",$sourceIdArr);
        $criteria->addColumnCondition(array("rt_check"=>4));
        $criteria->with = array("residenceTag","community");
        $model = $this->findAll($criteria);
        return $model;
    }

    public function getTowardName($intToward) {
        $towardName = "";
        if(array_key_exists($intToward, self::$rbi_towards)){
            $towardName = self::$rbi_towards[$intToward];
        }
        return $towardName;
    }
    /**
     *根据房源id，得到房源的第一个全景id
     * @param <type> $residenceId
     */
    public function getPanoIdBySourceId($residenceId){
        $url = Subpanorama::model()->getOnePanoramaBySourceIdAndSourceType($residenceId, Subpanorama::residence);
        if($url==""){//如果没全景，则用房源标题图。
            $residenceInfo = Residencebaseinfo::model()->findByPk($residenceId);
            $imgId = @$residenceInfo->rbi_titlepicurl;
            echo $residenceId,'=>',$imgId,'<br />';
            $url = Picture::model()->getPicByTitleInt($imgId,"_large");
        }else{//如果找到全景。要从url中提取出全景id
            $url = substr($url, strrpos($url, "/")+1);
        }
        return $url;
    }


    /**
     *得到最近发布的住宅
     * @param <int> $sellOrRent 出租还是出售 1出租2出售
     * @param <int> $limit 搜索条数
     */
    public function getRecentZhuzhai($sellOrRent,$limit){
        $criteria=new CDbCriteria();
        $criteria->with = array("rentInfo","sellInfo","residenceTag");
        $criteria->addColumnCondition(array(
            "rbi_rentorsell"=>$sellOrRent,
            "rt_check"=>4,
        ));
        $criteria->limit = $limit;
        $criteria->order = "rbi_releasedate desc";
        $all= Residencebaseinfo::model()->findAll($criteria);
        return $all;
    }
     /**
     *得到用户曾经选过的小区
     * @param <int> $sellOrRent 出租还是出售 1出租2出售
     */
    public function getSelectResidence($userid,$sellorrent){
        $criteria=new CDbCriteria();
        $criteria->with = array("community");
        $criteria->addColumnCondition(array(
            "rbi_uid"=>$userid,
        ));
        $criteria->addColumnCondition(array(
            "rbi_rentorsell"=>$sellorrent,
        ));
        $criteria->group = "rbi_communityid";
        $all= Residencebaseinfo::model()->findAll($criteria);
        return $all;
    }
    /**
     * 让已经过期的房源下线
     */
    public function updateOutTimeSource(){
        //先查找所有发布的已过期房源
        $time = time();
        $criteria=new CDbCriteria();
        $criteria->addCondition("rbi_releasedate+rr_validdate<".$time);
        $criteria->addColumnCondition(array("rt_check"=>4));
        $criteria->with = array("residenceTag");
        $criteria->select = "rbi_id";
        $all = Residencebaseinfo::model()->findAll($criteria);
        $ids = array();
        if($all){
            foreach($all as $value){
                $ids[] = $value["rbi_id"];
            }
            $criteria=new CDbCriteria();
            $criteria->addInCondition("rt_rbiid",$ids);
            Residencetag::model()->updateAll(array("rt_check"=>6),$criteria);
        }
        return $ids;
    }
    /**
     * 计算当前用户房源的排序分数
     */
    public function calculateOrder($id){
        $order=common::getOrderConfig('new');
        $tmodel=Residencetag::model()->find('rt_rbiid='.$id);
        if($tmodel){
            if($tmodel->rt_isrecommend) $order+=common::getOrderConfig('recommend');
            if($tmodel->rt_ishurry) $order+=common::getOrderConfig('hurry');
            if($tmodel->rt_ispanorama) $order+=common::getOrderConfig('subpanorama');
            if($tmodel->rt_ishigh) $order+=common::getOrderConfig('high');
        }
        return $order;
    }
}