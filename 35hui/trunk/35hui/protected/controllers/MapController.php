<?php 
class MapController extends CController {
    public $defaultAction='map';
    /*
	 * 用于搜集客户请求
    */
    private $_form;
    public $layout='map';
    //地图初始化中心点坐标
    private $coordinates = array('x'=>'121.46775','y'=>'31.2414','rp_buildname'=>'人民广场');
    /**
     *默认城市
     */
    private $city = 35;
    /**
     *窗口中最大显示的楼盘数目
     * @var <type> 
     */
    private $maxShowNum = 50;
    /**
     *缓存时间，单位秒
     * @var <type> 
     */
    private $cacheTime = 3600;
    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image
            // this is used by the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xEBF4FB,
            ),
        );
    }
    //构造函数
    function __construct($id) {
        parent::__construct($id);
        $this->_form = new SearchForm();
    }
    /**
     * 新房地图action 可选参数：kwd、tab(shop/office)
     */
    public function actionMap() {
        $va = va();
        $va->check(array(
            'kwd'=>array('not_blank'),
        ));
        $coordinates =  $this->coordinates;//初始中心点
        if(isset($_GET['coordinate'])&&is_numeric($_GET['coordinate'])){
            $sCoordinate = Subway::model()->getInfoById($_GET['coordinate']);
            $coordinates = array('x'=>$sCoordinate->sw_x,'y'=>$sCoordinate->sw_y,'rp_buildname'=>$sCoordinate->sw_stationname);
        }
        if(isset($_GET['id'])){
            $idArray = explode('-',$_GET['id']);
            if(isset($idArray[0])&&isset($idArray[1])&& is_numeric($idArray[1])){
                if($idArray[0] == 1 ){
                    $data=Systembuildinginfo::model()->findByPk($idArray[1]);
                    if($data->sbi_x){
                        $coordinates = array('x'=>$data->sbi_x,'y'=>$data->sbi_y,'rp_buildname'=>$data->sbi_buildingname);
                    }
                }else{
                    $data=Communitybaseinfo::model()->findByPk($idArray[1]);
                    if($data->comy_x){
                        $coordinates = array('x'=>$data->comy_x,'y'=>$data->comy_y,'rp_buildname'=>$data->comy_name);
                    }
                }
            }
        }
        $sellorrent = "nh";//新房
        $kwd = "";
        if($va->success){
            $kwd = urldecode($va->valid['kwd']);
        }
        //默认类型
        $seotkd = Seotkd::model()->findByPk(7);//SEO优化
        $this->render('map',array(
            'coordinates'=>$coordinates,
            'sellorrent'=>$sellorrent,
            'kwd'=>$kwd,
            'seotkd'=>$seotkd,
        ));
    }
    /**
     * 定位到二手房地图 可选参数：kwd、tab(shop/office)
     */
    public function actionSendHand() {
        $coordinates =  $this->coordinates;//初始中心点
        $sellorrent = 2;//售房
        $kwd = "";
        $seotkd = Seotkd::model()->findByPk(7);//SEO优化
        if(isset($_GET['kwd'])&&!empty ($_GET['kwd'])){
            $kwd = urldecode($_GET['kwd']);
        }
        $this->render('second',array(
            'coordinates'=>$coordinates,
            'sellorrent'=>$sellorrent,
            'kwd'=>$kwd,
            'seotkd'=>$seotkd,
        ));
    }

    /**
     * 定位到租房地图 可选参数：kwd、tab(shop/office)
     */
    public function actionRent() {
        $va = va();
        $va->check(array(
            'kwd'=>array('not_blank')
        ));
        $coordinates =  $this->coordinates;
        $sellorrent = 1;//租房
        $kwd = "";
        if($va->success){
            $kwd = urldecode($va->valid['kwd']);
        }
        $seotkd = Seotkd::model()->findByPk(7);//SEO优化
        $this->render('rent',array(
            'coordinates'=>$coordinates,
            'sellorrent'=>$sellorrent,
            'kwd'=>$kwd,
            'seotkd'=>$seotkd,
        ));
    }
    public function actionSearchCondition(){
        $this->layout = "frame";
        $this->render("searchcondition");
    }
    /**
     *
     * @param <int> $type 1区域 2交通
     * @param <int> $region 查询的值区域或者交通线，为0取默认值
     * @return <array>
     */
    public function actionFindCenter(){
        $type = $_POST['type'];
        $region = $_POST['region'];
        $coordinates = $this->coordinates;
        $connection = Yii::app()->db;
        try {
            if($type==1){
                //查询区域
                $sql = "select rp_x x,rp_y y ,rp_buildname from 35_areacoordinates where rp_type = 1 and rp_regionid=".$region;

            }else if($type==2){
                //查询交通线
                $sql = "select rp_x x, rp_y y, rp_buildname  from 35_areacoordinates where rp_type =2 and  rp_buildname = '".$region."号线'";
            }else{
                //默认查询区域
                $sql = "select rp_x x,rp_y y ,rp_buildname from 35_areacoordinates where rp_regionid=".$region;
            }
            $command=$connection->createCommand($sql);
            $data = $command->queryAll();
            if(!empty($data)){
                $coordinates = $data[0];
            }
        }
        catch(Exception $e) {
        }
        echo json_encode($coordinates);
    }
    /**
     * 移动地图统一方法
     */
    public function actionMoveMap() {
        $url = $_SERVER["HTTP_REFERER"];
        //根据地址来判断属于哪个页面
        $action = $this->defaultAction;
        $head = DOMAIN."/map/";
        $action_tmp = strtolower(substr($url, strlen($head)));
        $position = stripos($action_tmp, "/");
        if($action_tmp){//计算得到地址栏中的action。不是当前在执行的action。
            if($position){
                $action = substr($action_tmp, 0, $position);
            }else{
                $action = substr($action_tmp, 0);
            }
        }
        switch($action){
            default:
                $return = array();
                break;
            case "map"://新房
                $return = $this->ChangeDataNHouse();
                break;
            case "sendhand":
                $return = $this->ChangeData("2");
                break;
            case "rent":
                $return = $this->ChangeData("1");
                break;
        }
        echo json_encode($return);
        exit;
    }
    /**
     * 周边楼盘
     */
    public function actionOtherOffice(){
        $return = $this->ChangeDataNHouse();
        echo json_encode($return);
    }

    /**
     * 新房移动地图改变数据
     */
    private function ChangeDataNHouse (){
        $type = $_POST['type'];//物业类型
        $price = $_POST['price'];//楼盘均价
        
        switch($type){
            default:
                $allDate = array();
                break;
            case 1://写字楼
                $allDate = Yii::app()->cache->get("map_systembuding_xiezilou");
                if($allDate==false){
                    $allDate = $this->getAllBuildInfo(1);
                    Yii::app()->cache->set("map_systembuding_xiezilou",$allDate,$this->cacheTime);
                }
                $field = "systembuildinginfo_sale";
                break;
            case 2://商业广场
                $allDate = Yii::app()->cache->get("map_systembuding_shangye");
                if($allDate==false){
                    $allDate = $this->getAllBuildInfo(2);
                    Yii::app()->cache->set("map_systembuding_shangye",$allDate,$this->cacheTime);
                }
                $field = "systembuildinginfo_sale";
                break;
            case 3://小区
                $allDate = Yii::app()->cache->get("map_community");
                if($allDate==false){
                    $allDate = $this->getAllCommunityInfo();
                    Yii::app()->cache->set("map_community",$allDate,$this->cacheTime);
                }
                $field = "communitybaseinfo_sale";
                break;
        }
        $return = array();
        if($allDate){
            foreach($allDate as $value){
//                if(count($return)>=$this->maxShowNum)break;
//                if(!$this->filterXAndY($value)){//不在当前窗口内
//                    continue;
//                }
                if(!$this->filterZoomAndPrice($value, $field, $price)){//在当前级别不可以显示
                    continue;
                }
                $return[] = $value;
            }
        }
        return $return;
    }
    /**
     * 移动出租出售地图使用
     */
    private function ChangeData($sellorrent) {
        $type = $_POST['type'];//物业类型
        switch($type){
            default:
                $allDate = array();
                break;
            case 1://写字楼
                $allDate = $this->getAllBuildInfo(1,$sellorrent);
                $field = $sellorrent==1?"systembuildinginfo_rent":"systembuildinginfo_sale";
                break;
            case 2://商铺
                $allDate = $this->getAllBuildInfo(2,$sellorrent);
                $field = $sellorrent==1?"systembuildinginfo_rent":"systembuildinginfo_sale";
                break;
            case 4://住宅
                $allDate = $this->getAllCommunityInfo($sellorrent);
                $field = "communitybaseinfo_sale";//住宅只有平均售价
                break;
        }
        $return = array();
        if($allDate){
            foreach($allDate as $value){
//                if(count($return)>=$this->maxShowNum)break;
//                if(!$this->filterXAndY($value)){//不在当前窗口内
//                    continue;
//                }
                if(!$this->filterZoomAndPrice($value, $field, "0-0")){//在当前级别不可以显示。房源页面都使用模板中的默认值来过滤
                    continue;
                }
                $return[] = $value;
            }
        }
        return $return;
    }
    /**
     *判断一条数据是否在当前窗口内
     * @param <type> $value
     * @return <type>
     */
    private function filterXAndY($value){
        $swX = $_POST['swX'];
        $swY = $_POST['swY'];
        $neX = $_POST['neX'];
        $neY = $_POST['neY'];
        $x = $value['x'];
        $y = $value['y'];
        if($x<$neX&&$x>$swX&&$y<$neY&&$y>$swY){
            return true;
        }
        return false;
    }
    /**
     *过滤显示级别和楼盘中的平均价格
     * @param <type> $value 一条数据
     * @param <type> $field 使用哪条模板 可以选择为$filterTemplate中的key值
     * @param <type> $price 过滤平均价格条件 如20-360
     * @return <boolean>
     */
    private function filterZoomAndPrice($value, $field, $price){
        $zoom = $_POST['zoom'];//过滤级别
        $priceArr = explode("-", $price);
        $filterTemplate = array(
            "systembuildinginfo_rent"=>array("11"=>"7","12"=>"6","13"=>"5","14"=>"4","15"=>"3","16"=>"2", "field"=>"avgrentprice"),//每一个zoom级别可以显示的最小值
            "systembuildinginfo_sale"=>array("11"=>"80000","12"=>"60000","13"=>"40000","14"=>"30000","15"=>"20000","16"=>"15000", "field"=>"avgsellprice"),
            "communitybaseinfo_sale"=>array("11"=>"100000","12"=>"80000","13"=>"60000","14"=>"50000","15"=>"30000","16"=>"15000", "field"=>"avgsellprice"),
        );
        
        if(count($priceArr)!=2){
            return false;
        }
        $maxPrice = $priceArr[1];//比较的最大值
        $minPrice = 0;//比较的最小值
        //如果在模板中，则先选择模板中的值
        if(array_key_exists($zoom, $filterTemplate[$field])){
            //$minPrice = $filterTemplate[$field][$zoom];
        }
        
        if($priceArr[0]==$priceArr[1]&&$priceArr[1]==0){//不限的时候就是要模板中的值
        }else{
            $minPrice = $priceArr[0];
        }
        
        $comparePrice = $value[$filterTemplate[$field]["field"]];//结果集中的值

        if($maxPrice&&$comparePrice>$maxPrice){//如果有最大值，则不能大于最大值。没有最大值的时候就是选择了多少以上。
            return false;
        }
        if($comparePrice>$minPrice){
            return true;
        }
        return false;
    }
    
    /**
     *得到楼盘表的所有数据
     * @param <type> $type  1写字楼 2商业广场
     * @param <type> $sellorrent 为all的时候表示要搜索全部，不管其中的房源信息
     * @return <type>
     */
    private function getAllBuildInfo($type, $sellorrent="all"){
        if($sellorrent=="all"){//新房使用。不去看房源信息。
            $sql = "select sbi_buildingid buildingid, sbi_buildingname, sbi_x x, sbi_y y, sbi_avgsellprice avgsellprice from";
            $sql .=" 35_systembuildinginfo where sbi_buildtype =".$type;
        }else{//要同时查看有多少套出租出售信息
            $sql = "select count(*) num, sbi_buildingid buildingid, sbi_buildingname, sbi_x x, sbi_y y, sbi_avgrentprice avgrentprice, sbi_avgsellprice avgsellprice from ";
            if($type==1){//写字楼
                $sql .=" 35_officebaseinfo left join 35_systembuildinginfo on 35_systembuildinginfo.sbi_buildingid = 35_officebaseinfo.ob_sysid";
                $sql .= " where ob_check=4  and ob_sellorrent = ".$sellorrent;
                //过滤租金或售价
                $price = $_POST['price'];//价格
                $priceArr = explode("-", $price);
                if(count($priceArr)!=2){
                    exit;
                }else{
                    if($sellorrent==2){//售
                        $cloum = "ob_sumprice";
                    }else{//租
                        $cloum = "ob_rentprice";
                    }
                    if($priceArr[1]==""){//出现此种情况只会是选择多少以上。
                        $sql .=" and ".$cloum.">=".$priceArr[0];
                    }elseif($priceArr[0]==$priceArr[1]&&$priceArr[1]==0){//不限的时候不加条件
                    }else{
                        $sql .= " and ".$cloum." between ".$priceArr[0]." and ".$priceArr[1];
                    }
                }
                //过滤面积
                $area = $_POST['area'];//面积
                $areaArr = explode("-", $area);
                if(count($areaArr)!=2){
                    exit;
                }else{
                    if($areaArr[1]==""){//出现此种情况只会是选择多少以上。
                        $sql .=" and 35_officebaseinfo.ob_officearea>=".$areaArr[0];
                    }elseif($areaArr[0]==$areaArr[1]&&$areaArr[1]==0){//不限的时候不加条件
                    }else{
                        $sql .= " and 35_officebaseinfo.ob_officearea between ".$areaArr[0]." and ".$areaArr[1];
                    }
                }
            }elseif($type==2){//商铺 操作shopbaseinfo表
                $sql .= " 35_shopbaseinfo left join 35_systembuildinginfo on 35_systembuildinginfo.sbi_buildingid = 35_shopbaseinfo.sb_sysid";
                $sql .=" left join 35_shoptag on 35_shoptag.st_shopid = 35_shopbaseinfo.sb_shopid";
                if($sellorrent==2){//售
                    $tmp = " left join 35_shopsellinfo on 35_shopsellinfo.ss_shopid = 35_shopbaseinfo.sb_shopid ";
                }else{//租
                    $tmp = " left join 35_shoprentinfo on 35_shoprentinfo.sr_shopid = 35_shopbaseinfo.sb_shopid ";
                }
                $sql .= $tmp." where st_check=4 and sb_sellorrent = ".$sellorrent;
                //过滤租金或售价
                $price = $_POST['price'];//价格
                $priceArr = explode("-", $price);
                if(count($priceArr)!=2){
                    exit;
                }else{
                    if($sellorrent==2){//售
                        $cloum = "35_shopsellinfo.ss_sumprice";
                    }else{//租
                        $cloum = "35_shoprentinfo.sr_rentprice";
                    }
                    if($priceArr[1]==""){//出现此种情况只会是选择多少以上。
                        $sql .=" and ".$cloum.">=".$priceArr[0];
                    }elseif($priceArr[0]==$priceArr[1]&&$priceArr[1]==0){//不限的时候不加条件
                    }else{
                        $sql .= " and ".$cloum." between ".$priceArr[0]." and ".$priceArr[1];
                    }
                }
                //过滤面积
                $area = $_POST['area'];//面积
                $areaArr = explode("-", $area);
                if(count($areaArr)!=2){
                    exit;
                }else{
                    if($areaArr[1]==""){//出现此种情况只会是选择多少以上。
                        $sql .=" and 35_shopbaseinfo.sb_shoparea>=".$areaArr[0];
                    }elseif($areaArr[0]==$areaArr[1]&&$areaArr[1]==0){//不限的时候不加条件
                    }else{
                        $sql .= " and 35_shopbaseinfo.sb_shoparea between ".$areaArr[0]." and ".$areaArr[1];
                    }
                }
            }
            $sql .= " group by sbi_buildingid";
        }
        $dba = dba();
        $data = $dba->select($sql);
        return $data;
    }
    /**
     *得到所有小区的信息
     * @param <type> $sellorrent 为all的时候表示要搜索全部，不管其中的房源信息
     */
    public function getAllCommunityInfo($sellorrent="all"){
        if($sellorrent=="all"){//新房使用。不去看房源信息。
            $sql = "select comy_id buildingid, comy_name sbi_buildingname, comy_x x, comy_y y,comy_avgsellprice avgsellprice from";
            $sql .=" 35_communitybaseinfo";
        }else{
            $sql = "select count(*) num, comy_id buildingid, comy_name sbi_buildingname, comy_x x, comy_y y, comy_avgsellprice avgsellprice from ";
            $sql .= " 35_residencebaseinfo left join 35_communitybaseinfo on 35_communitybaseinfo.comy_id = 35_residencebaseinfo.rbi_communityid";
            $sql .=" left join 35_residencetag on 35_residencetag.rt_rbiid = 35_residencebaseinfo.rbi_id";
            if($sellorrent==2){//售
                $tmp = " left join 35_residencesellinfo on 35_residencesellinfo.rs_rbiid = 35_residencebaseinfo.rbi_id ";
            }else{//租
                $tmp = " left join 35_residencerentinfo on 35_residencerentinfo.rr_rbiid = 35_residencebaseinfo.rbi_id ";
            }
            $sql .= $tmp." where rt_check=4 and rbi_rentorsell = ".$sellorrent;
            //过滤租金或售价
            $price = $_POST['price'];//价格
            $priceArr = explode("-", $price);
            if(count($priceArr)!=2){
                exit;
            }else{
                if($sellorrent==2){//售
                    $cloum = "35_residencesellinfo.rs_price";
                }else{//租
                    $cloum = "35_residencerentinfo.rr_rentprice";
                }
                if($priceArr[1]==""){//出现此种情况只会是选择多少以上。
                    $sql .=" and ".$cloum.">=".$priceArr[0];
                }elseif($priceArr[0]==$priceArr[1]&&$priceArr[1]==0){//不限的时候不加条件
                }else{
                    $sql .= " and ".$cloum." between ".$priceArr[0]." and ".$priceArr[1];
                }
            }
            //过滤面积
            $area = $_POST['area'];//面积
            $areaArr = explode("-", $area);
            if(count($areaArr)!=2){
                exit;
            }else{
                if($areaArr[1]==""){//出现此种情况只会是选择多少以上。
                    $sql .=" and 35_residencebaseinfo.rbi_area>=".$areaArr[0];
                }elseif($areaArr[0]==$areaArr[1]&&$areaArr[1]==0){//不限的时候不加条件
                }else{
                    $sql .= " and 35_residencebaseinfo.rbi_area between ".$areaArr[0]." and ".$areaArr[1];
                }
            }
            $sql .= " group by comy_id";
        }
        $dba = dba();
        $data = $dba->select($sql);
        return $data;
    }
    
    /**
     * 点击分页之后查询具体的列表（写字楼）
     */
    public function actionOfficeAjaxPage(){
        $sellorrent = $_POST['sellorrent'];//1租2售
        $buildid = $_POST['buildid'];//楼盘id
        $price = $_POST['price'];//楼盘均价
        $area = $_POST['area'];//楼盘面积
        $buildInfo = Systembuildinginfo::model()->findByPk($buildid);
        if(!$buildInfo){//如果没有楼盘
            exit;
        }
        $criteria=new CDbCriteria();
        //只显示发布房源
        $criteria->addColumnCondition(array("ob_check"=>4,"ob_sellorrent"=>$sellorrent));

        $criteria->addColumnCondition(array("ob_sysid"=>$buildid));

        //过滤面积
        $areaArr = explode("-", $area);
        if(count($areaArr)!=2){
            exit;
        }else{
            if($areaArr[1]==""){//出现此种情况只会是选择多少以上。
                $criteria->addCondition("ob_officearea>=".$areaArr[0]);
            }elseif($areaArr[0]==$areaArr[1]&&$areaArr[1]==0){//不限的时候不加条件
            }else{
                $criteria->addBetweenCondition("ob_officearea",$areaArr[0],$areaArr[1]);
            }
        }
        
        //过滤租金或售价
        $priceArr = explode("-", $price);
        if(count($priceArr)!=2){
            exit;
        }else{
            if($sellorrent==2){//售
                $cloum = "ob_sumprice";
            }else{//租
                $cloum = "ob_rentprice";
            }
            if($priceArr[1]==""){//出现此种情况只会是选择多少以上。
                $criteria->addCondition($cloum.">=".$priceArr[0]);
            }elseif($priceArr[0]==$priceArr[1]&&$priceArr[1]==0){//不限的时候不加条件
            }else{
                $criteria->addBetweenCondition($cloum,$priceArr[0],$priceArr[1]);
            }
        }
        $listAll = Officebaseinfo::model()->findAll($criteria);
        $return = $this->splitPage($listAll,10);
        if($sellorrent==1){//租
            $renderName = "ajaxPageRent";
        }else{//售
            $renderName = "ajaxPageScend";
        }
        $this->renderPartial($renderName,array(
            'buildInfo'=>$buildInfo,
            'list'=>$return['list'],
            'pageNum'=>$return['pageNum'],//总页数，分页使用
            'nowPage'=>$return['nowPage'],
            'allNum'=>$return['allNum'],//总条数
            'post'=>$_POST,
            'sourceType' => "office",
        ));
    }
    /**
     * 点击分页之后查询具体的列表(商铺)
     */
    public function actionShopAjaxPage(){
        $sellorrent = $_POST['sellorrent'];//1租2售
        $buildid = $_POST['buildid'];//楼盘id
        $price = $_POST['price'];//楼盘均价
        $area = $_POST['area'];//楼盘面积
        $buildInfo = Systembuildinginfo::model()->findByPk($buildid);
        if(!$buildInfo){//如果没有楼盘
            exit;
        }
        $criteria=new CDbCriteria();
        $criteria->addColumnCondition(array("sb_sysid"=>$buildid,"sb_sellorrent"=>$sellorrent));
        //只显示发布房源
        $criteria->addColumnCondition(array("st_check"=>4));
        //过滤面积
        $areaArr = explode("-", $area);
        if(count($areaArr)!=2){
            exit;
        }else{
            if($areaArr[1]==""){//出现此种情况只会是选择多少以上。
                $criteria-> addCondition("sb_shoparea>=".$areaArr[0]);
            }elseif($areaArr[0]==$areaArr[1]&&$areaArr[1]==0){//不限的时候不加条件
            }else{
                $criteria->addBetweenCondition("sb_shoparea",$areaArr[0],$areaArr[1]);
            }
        }

        //过滤租金或售价
        $priceArr = explode("-", $price);
        if(count($priceArr)!=2){
            exit;
        }else{
            if($sellorrent==2){//售
                $with = "sellInfo";
                $cloum = "ss_sumprice";
            }else{//租
                $with = "rentInfo";
                $cloum = "sr_rentprice";
            }
            if($priceArr[1]==""){//出现此种情况只会是选择多少以上。
                $criteria-> addCondition($cloum.">=".$priceArr[0]);
            }elseif($priceArr[0]==$priceArr[1]&&$priceArr[1]==0){//不限的时候不加条件
            }else{
                $criteria->addBetweenCondition($cloum,$priceArr[0],$priceArr[1]);
            }
        }
        $listAll = Shopbaseinfo::model()->with($with,"shopTag")->findAll($criteria);

        $return = $this->splitPage($listAll);

        if($sellorrent==1){//租
            $renderName = "ajaxPageRent";
        }else{//售
            $renderName = "ajaxPageScend";
        }
        $this->renderPartial($renderName,array(
            'buildInfo'=>$buildInfo,
            'list'=>$return['list'],
            'pageNum'=>$return['pageNum'],//总页数，分页使用
            'nowPage'=>$return['nowPage'],
            'allNum'=>$return['allNum'],//总条数
            'post'=>$_POST,
            'sourceType' => "shop",
        ));
    }
    /**
     * 点击分页之后查询具体的列表(住宅)
     */
    public function actionResidenceAjaxPage(){
        $sellorrent = $_POST['sellorrent'];//1租2售
        $buildid = $_POST['buildid'];//楼盘id
        $price = $_POST['price'];//小区均价
        $area = $_POST['area'];//小区面积
        $communityInfo = Communitybaseinfo::model()->findByPk($buildid);
        if(!$communityInfo){//如果没有楼盘
            exit;
        }
        $criteria=new CDbCriteria();
        $criteria->addColumnCondition(array("rbi_communityid"=>$buildid,"rbi_rentorsell"=>$sellorrent));
        //只显示发布房源
        $criteria->addColumnCondition(array("rt_check"=>4));
        //过滤面积
        $areaArr = explode("-", $area);
        if(count($areaArr)!=2){
            exit;
        }else{
            if($areaArr[1]==""){//出现此种情况只会是选择多少以上。
                $criteria-> addCondition("rbi_area>=".$areaArr[0]);
            }elseif($areaArr[0]==$areaArr[1]&&$areaArr[1]==0){//不限的时候不加条件
            }else{
                $criteria->addBetweenCondition("rbi_area",$areaArr[0],$areaArr[1]);
            }
        }

        //过滤租金或售价
        $priceArr = explode("-", $price);
        if(count($priceArr)!=2){
            exit;
        }else{
            if($sellorrent==2){//售
                $with = "sellInfo";
                $cloum = "rs_price";
            }else{//租
                $with = "rentInfo";
                $cloum = "rr_rentprice";
            }
            if($priceArr[1]==""){//出现此种情况只会是选择多少以上。
                $criteria-> addCondition($cloum.">=".$priceArr[0]);
            }elseif($priceArr[0]==$priceArr[1]&&$priceArr[1]==0){//不限的时候不加条件
            }else{
                $criteria->addBetweenCondition($cloum,$priceArr[0],$priceArr[1]);
            }
        }
        $listAll = Residencebaseinfo::model()->with($with,"residenceTag")->findAll($criteria);
        
        $return = $this->splitPage($listAll);

        $renderName = "";
        if($sellorrent==1){//租
            $renderName = "ajaxPageRentR";
        }else{//售
            $renderName = "ajaxPageScendR";
        }
        $this->renderPartial($renderName,array(
            'communityInfo'=>$communityInfo,
            'list'=>$return['list'],
            'pageNum'=>$return['pageNum'],//总页数，分页使用
            'nowPage'=>$return['nowPage'],
            'allNum'=>$return['allNum'],//总条数
            'post'=>$_POST,
            'sourceType' => "residence",
        ));
    }

    public function actionNewHouseTip (){
        $buildid = $_POST['buildid'];//楼盘id
        $type = $_POST['type'];
        $buildInfo=array();
        if($type!=3){
            $buildInfo = Systembuildinginfo::model()->findByPk($buildid);
        }else{
            $buildInfo = Communitybaseinfo::model()->findByPk($buildid);
        }
        $this->renderPartial("ajaxPageMap",array(
            'buildInfo'=>$buildInfo,
            'type'=>$type,
        ));
    }
    /**
     *分页
     * @param <type> $listAll
     * @param <type> $onePageNum 每页显示条数
     * @return <type> 
     */
    private function splitPage($listAll,$onePageNum = 5){
        //分页
        $allNum = count($listAll);//得到总条数
        $pageNum = (int)(($allNum+$onePageNum-1)/$onePageNum);//总页数
        $nowPage = 1;//当前页数
        if(isset($_POST['page'])&&!empty($_POST['page'])){
            $nowPage = $_POST['page'];
        }
        $pageNum<=0?$pageNum=1:1;
        $nowPage>$pageNum?$nowPage=$pageNum:1;
        $nowPage<=0?$nowPage=1:1;

        //根据当前页数，还有总页数，过滤总数组，得到要显示的所有数据
        $list = array();
        $beginSource = ($nowPage-1)*$onePageNum;//开始显示的编号
        $tmp_num=0;//看有多少条数据了，此值不能大于每页最大数。
        foreach($listAll as $key=>$value){
            if($key>=$beginSource&&$tmp_num<$onePageNum){
                $tmp_num += 1;
                $list[] = $value;
            }
        }
        $return = array("list"=>$list,"pageNum"=>$pageNum,"nowPage"=>$nowPage,"allNum"=>$allNum);
        return $return;
    }
    public function actionShowMap(){
        $this->layout = "frame";

        $width = $_GET['width'];
        $height = $_GET['height'];
        $type = $_GET['type'];
        $this->render('showMap',array(
            'width'=>$width,
            'height'=>$height,
            'type'=>$type,
        ));
    }
}