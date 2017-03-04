<?php
/**
 * Description of SouFunOffice
 *
 * @author skding
 */

class SouFunOffice {
    public $content;
    public $courl;
    private $userid;
    private $issell;
    private $office;
    private $building;
    private $inser_id;//数据库里插入的id
    private $imageurl;//房源的图片
    public $outdoorimgs;//存放外景图（出售）
    private $sfTrack_id;
    public function __construct($sell_rent){
        $this->issell = $sell_rent==='esf';
        $this->userid = $_POST['userid'];
        $this->inser_id = 0;
    }
    public function fetchContent($url) {
        $md5url = md5(trim($url));
        $sfTrackModel = Soufuntracking::model()->findByAttributes(array("md5url"=>$md5url));
        if($sfTrackModel){
            return FALSE;
        }else{
            $sfTrackModel = new Soufuntracking();
            $attValue = array('sw_type'=>1,'sw_id'=>0,'url'=>$url,'md5url'=>$md5url,
                'infotype'=>'0','codate'=>date('Ymd'),'timestamp'=>time(),'errors'=>'');
            $sfTrackModel->attributes = $attValue;
            $sfTrackModel->save();
            $this->sfTrack_id = $sfTrackModel->id;
        }
        $reg_int = "'\d{1,10}'";
        $reg_float = "'(\d+)(\.\d+)?'";
        $reg_span = "'<span.*\/span\>'i";
        $snoopy = new Snoopy;
        $snoopy->fetch($url);
        $htmlStr = $snoopy->results;
        $htmlStr = @iconv('GBK','UTF-8',$htmlStr);
//内容查询
        $reg_outpic = "'\[\{(.*?)\}\]'i";
        preg_match($reg_outpic, $htmlStr, $matches);
        if( ! empty($matches[1]) ){
            $reg_picurl = "'bigpic\':\'(.*?)\''i";
            preg_match_all($reg_picurl, $matches[1], $temp);
            $this->outdoorimgs = empty($temp[1])?'':$temp[1];
        }
        $office_info = array();
        $html = str_get_html($htmlStr);
        $div_info = $html->find('div.info',0);//beizhu
        $office_info['descript'] = trim($html->find('div.beizhu',0)->innertext);
        if(empty($office_info['descript'])) {
            echo '<h2 style="color:red">描述为空</h2>';
            return FALSE;}
        $office_info['title'] = trim($div_info->children(0)->children(0)->plaintext);
        $temp = $div_info->children(0)->children(1)->plaintext;
        $temp = explode('：', $temp);
        $temp = explode('(',$temp[2]);
        $office_info['releasetime'] = strtotime($temp[0]);
        if($this->issell) {//出售
            $temp = $div_info->children(1)->children(0)->plaintext;
            preg_match($reg_int, $temp, $match);
            $office_info['sprice'] = empty($match[0])?'0':$match[0];

            $temp = $div_info->children(1)->children(2)->plaintext;
            preg_match($reg_int, $temp, $match);
            $office_info['ob_officearea'] = empty($match[0])?'0':$match[0];

            $temp = $div_info->children(1)->children(3)->plaintext;
            preg_match($reg_int, $temp, $match);
            $office_info['sellprice'] = empty($match[0])?'0':$match[0];//万元
        }else {
            $temp = $div_info->children(1)->children(0)->plaintext;
            preg_match($reg_int, $temp, $match);
            $office_info['mouth_price'] = empty($match[0])?'0':$match[0];
            $temp = $div_info->children(1)->children(1)->plaintext;
            preg_match($reg_float, $temp, $match);
            $office_info['day_price'] = empty($match[0])?'0':$match[0];
            $office_info['ishavepprice'] = strpos($temp, '不')===FALSE?'1':'0';
            $temp = $div_info->children(1)->children(3)->plaintext;
            preg_match($reg_int, $temp, $match);
            $office_info['ob_officearea'] = empty($match[0])?'0':$match[0];
        }

//大楼信息
        $building = array();
        $temp1 = $div_info->children(2)->children(0);
        $building['buildingname'] = $temp1->children(1)->plaintext;
        $building['href'] = $temp1->children(1)->href;
        $building['bankuai'] = $temp1->children(2)->plaintext.'-'.$temp1->children(3)->plaintext;
        $temp1 = $div_info->children(2);

        $building['sbi_address'] = $snoopy->_striptext(preg_replace($reg_span, '', $temp1->children(1)->innertext));
        $temp = $temp1->children(2)->plaintext;
        preg_match_all($reg_int, $temp, $match);
        $building['allfloor'] = empty($match[0][1])?0:$match[0][1];
        $building['atfloor'] = empty($match[0][0])?0:$match[0][0];

        $building['usemianji'] = preg_replace($reg_span, '', $temp1->children(3)->innertext);
//preg_match($reg_float, $temp1->children(4)->plaintext, $match);
        $building['sbi_propertyprice'] = $temp1->children(4)->plaintext;
        $building['sbi_propertyname'] = trim(preg_replace($reg_span, '', $temp1->children(5)->innertext));
        $building['sbi_propertydegree'] = preg_replace($reg_span, '', $temp1->children(6)->innertext);
        $building['zhuangxiu'] = preg_replace($reg_span, '', $temp1->children(7)->innertext);
        if($this->issell) {//出售
            $building['officetype'] = preg_replace($reg_span, '', $temp1->children(8)->innertext);
            $temp = $temp1->children(9)->plaintext;
            preg_match($reg_int, $temp, $match);
            $building['ob_buildingera'] = empty($match[0])?'0':$match[0];
            $building['ob_buildingera'] = strtotime($building['ob_buildingera']);
            if(empty($building['ob_buildingera']))
                $building['ob_buildingera'] = 0;
            $building['peitao'] = trim(preg_replace($reg_span, '', $temp1->children(10)->innertext));
        }else {
            $building['ob_buildingera'] = 0;//SouFun出租没有此概念
            $building['renttype'] = preg_replace($reg_span, '', $temp1->children(8)->innertext);
            $temp = $temp1->children(9)->plaintext;
            preg_match($reg_int, $temp, $match);
            $building['basetime'] = empty($match[0])?'0':$match[0];
            if(count($temp1->children)<=11){//2011/08/03 18:50
                $building['officetype'] = '写字楼';
                $building['peitao'] = trim(preg_replace($reg_span, '', $temp1->children(10)->innertext));
            }else{
                $building['officetype'] = preg_replace($reg_span, '', $temp1->children(10)->innertext);
                $building['peitao'] = trim(preg_replace($reg_span, '', $temp1->children(12)->innertext));
            }
        }
        $temp1 = $html->find('dl.xqpic',0);
        if($temp1)
            $this->fetchImages($temp1->children);
        $html->clear();
        unset($temp1,$html);
        
        $temp = Systembuildinginfo::model()->findByAttributes(array("sbi_buildingname"=>trim($building['buildingname']) ));
        if($temp){
            $office_info['ob_sysid'] = $temp->sbi_buildingid;
        }else{
            $office_info['ob_sysid'] = $this->creatSystemBuild($building);
        }
        print_r($office_info);print_r($building);echo '<br />';
        $this->office = $office_info;
        $this->building = $building;
        $this->creatOffice( $office_info, $building );
    }
    /**
     * 地区map
     * @var array
     */
    public $bankuaiMap=array(
        '浦东'=>array(
            '周浦'=>'周康',
            '康桥'=>'周康',
            '世博'=>'世博滨江',
        ),
        '徐汇'=>array(
            '植物园'=>'上海植物园',
            '南站'=>'上海南站',
            '龙华'=>'龙华滨江',
        ),
        '卢湾'=>array(
            '世博滨江'=>'卢湾世博滨江',
        ),
        '闸北'=>array(
            '大宁'=>'大宁绿地',
            '彭浦'=>'彭浦新村',
        ),
        '杨浦'=>array(
            '中原'=>'中原地区',
            '大场'=>'大场镇',
        ),
    );
    public function creatSystemBuild($building){
        $sbModel = new Systembuildinginfo();
        $sbModel->sbi_province = 9;
        $sbModel->sbi_city = 35;
        $sbModel->sbi_district = 48;//陆家嘴
        //$sbModel->sbi_section = 108;//世纪公园
        $sbModel->sbi_loop = 2;//中环以内
        if( ! empty($building['bankuai'])){
            $temp = explode('-', $building['bankuai']);
            $temp[0]=trim($temp[0]);
            $temp[1] = trim($temp[1]);
            if( isset($this->$bankuaiMap[$temp[0]][$temp[1]]) ){
                $temp[1]=$this->$bankuaiMap[$temp[0]][$temp[1]];
            }
            $region = Region::model()->findByAttributes(array("re_name"=>trim($temp[0]),'re_parent_id'=>35));
            if($region){
                $sbModel->sbi_district = $region->re_id;
                $region = Region::model()->findByAttributes(array("re_name"=>$temp[1],'re_parent_id'=>$sbModel->sbi_district));
                if($region) {
                    $sbModel->sbi_section = $region->re_id;
                }elseif(!empty($temp[1])){
                    $region = new Region();
                    $region->re_name = $temp[1];
                    $region->re_parent_id = $sbModel->sbi_district;
                    $region->save();
                    $sbModel->sbi_section = $region->re_id;
                }
            }
        }
        if($sbModel->sbi_district == 48)
            $sbModel->sbi_section = 108;//世纪公园
        $sbModel->sbi_buildingname = trim($building['buildingname']);
        //计算拼音缩写
        $pinyin = new Pinyin;
        $pinYinArray = $pinyin->doWord(trim($sbModel->sbi_buildingname));
        $sbModel->sbi_pinyinshortname = $pinYinArray['short'];
        $sbModel->sbi_pinyinlongname = $pinYinArray['long'];
            
//        $sbModel->sbi_pinyinshortname = 'sx';
        $sbModel->sbi_address =$building['sbi_address'];
        $sbModel->sbi_foreign = 0;
        $sbModel->sbi_propertyname = $building['sbi_propertyname'];
        $sbModel->sbi_developer = '';
        preg_match("'(\d+)(\.\d+)?'", $building['sbi_propertyprice'], $match);
        $temp = empty($match[0])?'0':$match[0];
        if(strpos($building['sbi_propertyprice'], '月')===FALSE){
            $temp = $temp*365/12;//转换成月
        }
        $sbModel->sbi_propertyprice = $temp;
        $sbModel->sbi_propertydegree = 1;//物业等级
        if(strpos($building['sbi_propertydegree'], '甲')!==FALSE){//甲乙丙
            $sbModel->sbi_propertydegree = 1;
        }elseif(strpos($building['sbi_propertydegree'], '乙')!==FALSE){//甲乙丙
            $sbModel->sbi_propertydegree = 2;
        }elseif(strpos($building['sbi_propertydegree'], '丙')!==FALSE){//甲乙丙
            $sbModel->sbi_propertydegree = 3;
        }
        $sbModel->sbi_isnew = 0;
        $sbModel->sbi_x = '0';
        $sbModel->sbi_y = '0';
        $sbModel->sbi_avgrentprice = 0;
        $sbModel->sbi_avgsellprice = 0;
        $sbModel->sbi_recordtime = time();
        $sbModel->sbi_updatetime = 1304985600;//记录一个特殊的时间2011/05/10
        if( ! $sbModel->save()){
            $sfTrackModel = Soufuntracking::model()->findByPk($this->sfTrack_id);
            $sfTrackModel->infotype = 1;
            $sfTrackModel->errors = serialize($sbModel->errors);
            $sfTrackModel->save();
            exit;
        }

        return $sbModel->sbi_buildingid;
        
    }
    public function creatOffice( $office_info, $building ){
        $sysModel = Systembuildinginfo::model()->findByPk($office_info['ob_sysid']);
        //if(empty($sysModel)) return false;
        $officeModel = new Officebaseinfo();
        $officeModel->ob_sysid = $office_info['ob_sysid'];
        $officeModel->ob_uid = $this->userid;
        $officeModel->ob_province = 9;
        $officeModel->ob_city = 35;
        $officeModel->ob_buildingtype = 3;//写字楼
        $officeModel->ob_officename = $building['buildingname'];
        $type = array(1=>'商住楼',2=>'纯写字楼',3=>'商业综合体楼',4=>'酒店写字楼');
        $officeModel->ob_officetype = 2;//默认纯写字楼
        foreach($type as $key=>$val){
            if($val == $building['officetype'])
                $officeModel->ob_officetype = $key;
        }
        $officeModel->ob_district = $sysModel->sbi_district;
        $officeModel->ob_section = $sysModel->sbi_section;
        $officeModel->ob_loop = 2;//中环以内
        $officeModel->ob_officeaddress = $sysModel->sbi_address;
        $officeModel->ob_propertycomname = $sysModel->sbi_propertyname;
        preg_match("'(\d+)(\.\d+)?'", $building['sbi_propertyprice'], $match);
        $temp = empty($match[0])?'0':$match[0];
        if(strpos($building['sbi_propertyprice'], '月')===FALSE){
            $temp = $temp*365/12;//转换成月
        }
        $officeModel->ob_propertycost = $temp;
        $officeModel->ob_officearea = $office_info['ob_officearea'];

        //计算楼层
        if($building['atfloor']&&$building['allfloor']){
            $percent = $building['atfloor']/$building['allfloor'];
            $percent<0.3?$officeModel->ob_floortype=0:"";
            $percent>0.6?$officeModel->ob_floortype=2:"";
        }

        $officeModel->ob_floornature = 1;
        $officeModel->ob_towards = 0;
        $officeModel->ob_buildingera = $building['ob_buildingera'];

        $officeModel->ob_cancut = strpos($building['zhuangxiu'], '不')===FALSE?1:0;
        if(strpos($building['zhuangxiu'], '精')!==FALSE){//精装修
            $officeModel->ob_adrondegree = 3;
        }elseif(strpos($building['zhuangxiu'], '毛')!==FALSE){//毛坯
            $officeModel->ob_adrondegree = 1;
        }else{//甲乙丙
            $officeModel->ob_adrondegree = 2;
        }

        if(strpos($building['sbi_propertydegree'], '甲')!==FALSE){//甲乙丙
            $officeModel->ob_officedegree = 1;
        }elseif(strpos($building['sbi_propertydegree'], '丙')!==FALSE){//甲乙丙
            $officeModel->ob_officedegree = 3;
        }else{//甲乙丙
            $officeModel->ob_officedegree = 2;
        }
        //$officeModel->ob_busway = '';
        $officeModel->ob_sellorrent = $this->issell?2:1;//2出售
        $officeModel->ob_releasedate = $office_info['releasetime'];
        $temp = strtotime(date('Y-m-d',strtotime('-'.rand(1,2).' day')));
        $temp = $temp+rand(8,14)*3600+rand(0,59);
        $officeModel->ob_updatedate = $temp;
        $officeModel->ob_expiredate = 86400*30;
        if($officeModel->save()){
            $sfTrackModel = Soufuntracking::model()->findByPk($this->sfTrack_id);
            $sfTrackModel->sw_id = $officeModel->ob_officeid;
            $sfTrackModel->infotype = 1;
            $sfTrackModel->save();

            $this->inser_id = $officeModel->ob_officeid;
            $model = new Officepresentinfo();
            $model->op_officeid = $officeModel->ob_officeid;
            $model->op_officetitle = $office_info['title'];
            $model->op_officedesc = $office_info['descript'];
            $model->op_serialnum = '';
            if( ! $model->save()) {
                //$sfTrackModel = Soufuntracking::model()->findByPk($this->sfTrack_id);
                $sfTrackModel->infotype = 3;
                $sfTrackModel->errors = serialize($model->errors);
                $sfTrackModel->save();
                return FALSE;
            }
            if($this->issell){//出售
                $model = new Officesellinfo();
                $model->os_officeid = $officeModel->ob_officeid;
                $model->os_avgprice = $office_info['sprice'];
                $model->os_sumprice = $office_info['sellprice'];

            }else{
                $model = new Officerentinfo();
                $model->or_officeid = $officeModel->ob_officeid;
                $model->or_rentprice = $office_info['day_price'];
                $model->or_monthrentprice = $office_info['mouth_price'];
                $model->or_iscontainprocost = $office_info['ishavepprice'];
                $model->or_renttype = $building['renttype'] == '整租'?1:2;
                $model->or_payway = 0;
                $model->or_basetime = $building['basetime'];
            }
            if( ! $model->save()){
                //$sfTrackModel = Soufuntracking::model()->findByPk($this->sfTrack_id);
                $sfTrackModel->infotype = 4;
                $sfTrackModel->errors = serialize($model->errors);
                $sfTrackModel->save();
                return FALSE;
            }

            $model = new Officetag();
            $model->ot_officeid = $officeModel->ob_officeid;
            $model->ot_isrecommend = rand(0,1);
            $model->ot_isnew = rand(0,1);
            $model->ot_ishurry = rand(0,1);
            $model->ot_check = 4;
            if( ! $model->save()){
                //$sfTrackModel = Soufuntracking::model()->findByPk($this->sfTrack_id);
                $sfTrackModel->infotype = 5;
                $sfTrackModel->errors = serialize($model->errors);
                $sfTrackModel->save();
                return FALSE;
            }

            $peitao = array('客梯','货梯','停车位','暖气','空调','网络');
            $model = new Officefacilityinfo();
            $model->of_officeid = $officeModel->ob_officeid;//$building['peitao']
            $peitao2 = explode(',', $building['peitao']);//array_uintersect
            //客梯,货梯,停车位,暖气,空调,网络
            $model->of_carparking = in_array('停车位', $peitao2)?1:0;
            $model->of_warming = in_array('暖气', $peitao2)?1:0;
            $model->of_network = in_array('网络', $peitao2)?1:0;
            $model->of_elecwater = 1;
            $model->of_elevator = in_array('货梯', $peitao2)?1:0;
            $model->of_lift = 1;
            $model->of_gas = 1;
            $model->of_aircondition = in_array('空调', $peitao2)?1:0;
            $model->of_tv = 0;
            $model->of_door = 1;
            $model->save();

            $sfTrackModel->infotype = 6;
            $sfTrackModel->save();

            $this->saveImage();

            $sfTrackModel->infotype = 10;
            $sfTrackModel->save();
        }else{
            $sfTrackModel = Soufuntracking::model()->findByPk($this->sfTrack_id);
            $sfTrackModel->infotype = 1;
            $sfTrackModel->errors = serialize($officeModel->errors);
            $sfTrackModel->save();
            return FALSE;
        }


    }
    public function getFuangInfo(){
        return $this->office;
    }
    public function getBuildingInfo(){
        return $this->building;
    }
    /*
     *  1=>'/ichnopic/',//房型图
        2=>'/outdoorpic/',//外景图
        3=>'/indoorpic/',//内景图
    */
    public function fetchImages($picdoc) {
        //$picdoc = $html->find('dl.xqpic',0)->children;
        $imageurl = array();
        $index = '';
        foreach ($picdoc as $key => $cdoc) {
            $tag = trim($cdoc->tag);
            if($tag == 'li' || $tag == 'dt') {// li是出租的结构 dt是二手房的结构 2011-05-07 14:28
                if($tag == 'li') {
                    //echo $cdoc->children(0)->plaintext,'<br />';
                    $temp = trim($cdoc->children(0)->plaintext);
                }else {
                    //echo $cdoc->plaintext,'<br />';
                    $temp = trim($cdoc->plaintext);
                }
                switch ($temp) {
                    case '平面图':
                        $index = 'ichnopic';//'ichnograph';
                        break;
                    case '内景图':
                        $index = 'indoorpic';
                        break;
                    case '外景图':
                        $index = 'outdoorpic';
                        break;
                    default:
                        $index = '';
                }

                if($index == '' || $tag == 'dt') continue;
                $temp = $this->stripImg($cdoc->children(1)->innertext);
                if ( ! empty($temp) )
                    $imageurl[$index][] = $temp[0];
            }
            if($index == '') continue;
            $temp = $this->stripImg($cdoc->innertext);
            if ( ! empty($temp) )
                $imageurl[$index][] = $temp[0];
        }//$this->outdoorimgs
        if( empty($imageurl['outdoorpic']) && $this->outdoorimgs ) $imageurl['outdoorpic'] = $this->outdoorimgs;
        $this->imageurl = $imageurl;
        //$this->saveImage($imageurl);
        return $imageurl;
    }
    private function stripImg($document) {
        $match = array();
        preg_match_all("'<\s*img\s.*?src2\s*=\s*			# find <img src2= SouFun采用延迟加载img技术
						([\"\'])?					# find single or double quote
						(?(1) (.*?)\\1 | ([^\s\>]+))		# if quote found, match up to next matching
													# quote, otherwise match up to next space
						'isx",$document,$links);

        // catenate the non-empty matches from the conditional subpattern

        while(list($key,$val) = each($links[2])) {
            if(!empty($val))
                $match[] = $val;
        }

        while(list($key,$val) = each($links[3])) {
            if(!empty($val))
                $match[] = $val;
        }

        // return the links
        return $match;
    }
    /*
     *  请确保$this->imageurl，$this->inser_id赋值过后再使用此方法
     */
    private function saveImage() {
        $imageurl = $this->imageurl;
        if( empty($imageurl) ) {
            echo 'imageurl empty';
            return FALSE;
        }
        $imageDeal = new Image();
        $standard = Officebaseinfo::$officePictureNorm;//同一个缩略图配置
        $ptypearr = array('ichnopic'=>1,'indoorpic'=>3,'outdoorpic'=>2);
        $titlepicurl = 0;
        foreach($imageurl as $type=>$urls) {
            $path = PIC_PATH.'/'.$type.'/';
            foreach($urls as $url) {
                //echo $url,'<br />';
                $picdata = file_get_contents($url);
                if( $picdata ) {
                    $imgname = time().rand(111,999).'.'.pathinfo($url,PATHINFO_EXTENSION);
                    file_put_contents($path.$imgname, $picdata);
                    $imageDeal->formatWithPicture($path.$imgname,$standard,true,true,'/images/mark2.jpg');
                    $dba = dba();
                    $picModel = new Picture();
                    $picModel->p_id = $dba->id('35_picture');
                    $picModel->p_sourceid = $this->inser_id;
                    $picModel->p_sourcetype = 2;//Picture::$sourceType;
                    $picModel->p_type = $ptypearr[$type];
                    $picModel->p_img = '/'.$type.'/'.$imgname;
                    $picModel->p_tinyimg = $picModel->p_img;
                    $picModel->p_uploadtime = time();
                    if( ! $picModel->save()){
                        print_r($picModel->errors);
                    }else {
                        $titlepicurl = $picModel->p_id;
                    }

                }else {
                    echo '====下载失败='.$url.'===<br />';
                }

            }
        }
        if( $titlepicurl )
            Officepresentinfo::model()->updateAll(array('op_titlepicurl'=>$titlepicurl),'op_officeid='.$this->inser_id);
        return TRUE;
    }
}