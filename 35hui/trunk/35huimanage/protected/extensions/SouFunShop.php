<?php
/**
 * Description of SouFunShop
 *
 * @author skding
 */
class SouFunShop {
    public $content;
    public $courl;
    private $userid;
    private $issell;
    private $shop;
    private $building;
    private $inser_id;//数据库里插入的id
    private $imageurl;//房源的图片
    public $outdoorimgs;//存放外景图（出售）
    private $sfTrack_id;
    public function __construct($sell_rent) {
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
            $attValue = array('sw_type'=>2,'sw_id'=>0,'url'=>$url,'md5url'=>$md5url,
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
        $htmlStr = iconv('GBK','UTF-8',$htmlStr);

        $reg_outpic = "'\[\{(.*?)\}\]'i";
        preg_match($reg_outpic, $htmlStr, $matches);
        if( ! empty($matches[1]) ){
            $reg_picurl = "'bigpic\':\'(.*?)\''i";
            preg_match_all($reg_picurl, $matches[1], $temp);
            $this->outdoorimgs = empty($temp[1])?'':$temp[1];
        }

        $shop_info = array();
        $html = str_get_html($htmlStr);
        $div_info = $html->find('div.info',0);//beizhu
        $shop_info['title'] = trim($div_info->children(0)->children(0)->plaintext);
        $temp = $div_info->children(0)->children(1)->plaintext;
        $temp = explode('：', $temp);
        $temp = explode('(',$temp[2]);
        $shop_info['releasetime'] = strtotime($temp[0]);
        if($this->issell) {//出售
            $shop_info['descript'] = trim($html->find('div.beizhu',0)->children(0)->innertext);
            $temp = $div_info->children(1)->children(2)->plaintext;
            preg_match($reg_int, $temp, $match);
            $shop_info['sprice'] = empty($match[0])?'0':$match[0];

            $temp = $div_info->children(1)->children(3)->plaintext;
            preg_match($reg_int, $temp, $match);
            $shop_info['mianji'] = empty($match[0])?'0':$match[0];

            $temp = $div_info->children(1)->children(0)->plaintext;
            preg_match($reg_int, $temp, $match);
            $shop_info['sellprice'] = empty($match[0])?'0':$match[0];;//万元
            $temp = $div_info->children(1)->children(4)->plaintext;
            $temp = explode('：', $temp);
            $shop_info['shoptype'] = empty($temp[1])?'':trim($temp[1]);
        }else {
            $shop_info['descript'] = trim($html->find('div.beizhu',0)->innertext);
            $temp = $div_info->children(1)->children(0)->plaintext;
            preg_match($reg_int, $temp, $match);
            $shop_info['month_price'] = empty($match[0])?'0':$match[0];
            $temp = $div_info->children(1)->children(1)->plaintext;
            preg_match($reg_float, $temp, $match);
            $shop_info['day_price'] = empty($match[0])?'0':$match[0];
            $shop_info['ishavepprice'] = strpos($temp, '不')?'0':'1';
            $temp = $div_info->children(1)->children(3)->plaintext;
            preg_match($reg_int, $temp, $match);
            $shop_info['mianji'] = empty($match[0])?'0':$match[0];

            $temp = $div_info->children(1)->children(4)->plaintext;
            $temp = explode('：', $temp);
            $shop_info['shoptype'] = empty($temp[1])?'':trim($temp[1]);
        }
        if(empty($shop_info['descript'])) {
            echo '<h2 style="color:red">描述为空</h2>';
            return FALSE;}
        print_r($shop_info);
        echo '<br />';
//大楼信息
        $building = array();
        $temp1 = $div_info->children(2)->children(0);
        $building['name'] = $temp1->children(1)->plaintext;
        $building['href'] = $temp1->children(1)->href;
        $building['bankuai'] = $temp1->children(2)->plaintext.'-'.$temp1->children(3)->plaintext;
        $temp1 = $div_info->children(2);

        $building['sb_shopaddress'] = $snoopy->_striptext(preg_replace($reg_span, '', $temp1->children(1)->innertext));
        $temp = $temp1->children(2)->plaintext;
        preg_match_all($reg_int, $temp, $match);
        $building['allfloor'] = empty($match[0][1])?0:$match[0][1];
        $building['atfloor'] = empty($match[0][0])?0:$match[0][0];

        $building['usemianji'] = preg_replace($reg_span, '', $temp1->children(3)->innertext);
//preg_match($reg_float, $temp1->children(4)->plaintext, $match);
        $building['property_price'] = $temp1->children(4)->plaintext;
        $building['property_name'] = preg_replace($reg_span, '', $temp1->children(5)->innertext);
//$building['property_dengji'] = preg_replace($reg_span, '', $temp1->children(6)->innertext);

        if($this->issell) {//出售
            $temp = $temp1->children(6)->innertext;//铺面类型有可能不存在
            if(strpos($temp, '铺面类型') === FALSE) {
                $building['shopfronttype'] = '';
                $building['zhuangxiu'] = preg_replace($reg_span, '', $temp1->children(6)->innertext);
                $building['cancut'] = strpos($temp1->children(7)->plaintext, '不') === FALSE?'1':'0';
                $building['builyear'] = 0;
                $building['peitao'] = preg_replace($reg_span, '', $temp1->children(8)->innertext);
            } else {
                $building['shopfronttype'] = preg_replace($reg_span, '', $temp);
                $building['zhuangxiu'] = preg_replace($reg_span, '', $temp1->children(8)->innertext);
                $building['cancut'] = strpos($temp1->children(9)->plaintext, '不') === FALSE?'1':'0';
                $building['builyear'] = (int)preg_replace($reg_span, '', $temp1->children(7)->innertext);
                $building['peitao'] = preg_replace($reg_span, '', $temp1->children(10)->innertext);
            }
        }else {
            $building['shopfronttype'] = preg_replace($reg_span, '', $temp1->children(6)->innertext);
            $temp = $temp1->children(8)->innertext;//起租年限
            if(strpos($temp, '起租年限') === FALSE) {
                $building['basetime'] = 0;
                $building['zhuangxiu'] = preg_replace($reg_span, '', $temp1->children(8)->innertext);
                $building['renttype'] = preg_replace($reg_span, '', $temp1->children(7)->innertext);
                $building['cancut'] = strpos($temp1->children(9)->plaintext, '不') === FALSE?'1':'0';
                $building['peitao'] = preg_replace($reg_span, '', $temp1->children(10)->innertext);
            }else {
                $building['basetime'] = (int)preg_replace($reg_span, '', $temp1->children(8)->innertext);
                $building['zhuangxiu'] = preg_replace($reg_span, '', $temp1->children(10)->innertext);
                $building['renttype'] = preg_replace($reg_span, '', $temp1->children(9)->innertext);
                $building['cancut'] = strpos($temp1->children(11)->plaintext, '不') === FALSE?'1':'0';
                $building['peitao'] = preg_replace($reg_span, '', $temp1->children(12)->innertext);
            }


        }
        $temp1 = $html->find('dl.xqpic',0);
        if($temp1)
            $this->fetchImages($temp1->children);
        $html->clear();
        unset($temp1,$html);
        print_r($building);
        echo '<br />==========<br />';

        $this->creatShop($shop_info, $building);
    }
    public function creatSystemBuild($building) {

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
    private function creatShop( $shop_info, $building ) {
        //return false;
        $shopModel = new Shopbaseinfo();
        $shopModel->sb_uid = $this->userid;
        $shopType = array('住宅底商','商业街商铺','酒店底商','旅游商铺','社区商铺','沿街门脸',
                '写字楼配套底商','购物中心/综合体','卖场','卖场（如百货、服装、家具、电子等）');
        $shopModel->sb_shoptype = 9;
        switch ($shop_info['shoptype']) {
            case '住宅底商':
                $shopModel->sb_shoptype = 1;
                break;
            case '商业街商铺':
                $shopModel->sb_shoptype = 2;
                break;
            case '酒店底商':
                $shopModel->sb_shoptype = 3;
                break;
            case '旅游商铺':
                $shopModel->sb_shoptype = 4;
                break;
            case '社区商铺':
                $shopModel->sb_shoptype = 5;
                break;
            case '沿街门脸':
                $shopModel->sb_shoptype = 6;
                break;
            case '写字楼配套底商':
                $shopModel->sb_shoptype = 7;
                break;
            case '购物中心/综合体':
                $shopModel->sb_shoptype = 8;
                break;
        }
        $shopModel->sb_province = 9;
        $shopModel->sb_city = 35;
        $temp = explode('-', $building['bankuai']);
        $temp[0]=trim($temp[0]);
        $temp[1] = trim($temp[1]);
        if( isset($this->$bankuaiMap[$temp[0]][$temp[1]]) ){
            $temp[1]=$this->$bankuaiMap[$temp[0]][$temp[1]];
        }
        $region = Region::model()->findByAttributes(array("re_name"=>trim($temp[0]),'re_parent_id'=>35));
        if($region) {
            $shopModel->sb_district = $region->re_id;
            $region = Region::model()->findByAttributes(array("re_name"=>$temp[1],'re_parent_id'=>$shopModel->sb_district));
            if($region) {
                $shopModel->sb_section = $region->re_id;
            }elseif(!empty($temp[1])) {
                $region = new Region();
                $region->re_name = $temp[1];
                $region->re_parent_id = $shopModel->sb_district;
                $region->save();
                $shopModel->sb_section = $region->re_id;
            }
        }
        $shopModel->sb_shopaddress = $building['sb_shopaddress'];
        $shopModel->sb_shopfronttype = 1;//1店铺2摊位3柜台
        if($building['shopfronttype']=='摊位') {
            $shopModel->sb_shopfronttype = 2;
        }elseif($building['shopfronttype']=='柜台') {
            $shopModel->sb_shopfronttype = 3;
        }
        $shopModel->sb_propertycomname = $building['property_name'];
        preg_match("'(\d+)(\.\d+)?'", $building['property_price'], $match);
        $temp = empty($match[0])?'0':$match[0];
        if(strpos($building['property_price'], '月')===FALSE) {
            $temp = $temp*365/12;//转换成月
        }
        $shopModel->sb_propertycost = $temp;
        $shopModel->sb_shoparea = $shop_info['mianji'];
        $shopModel->sb_loop = 2;
        $shopModel->sb_floor = $building['atfloor'];
        $shopModel->sb_allfloor = $building['allfloor'];
        $shopModel->sb_towards = 0;
        $shopModel->sb_cancut = $building['cancut'];
        if(strpos($building['zhuangxiu'], '精')!==FALSE) {//精装修
            $shopModel->sb_adrondegree = 3;
        }elseif(strpos($building['zhuangxiu'], '毛')!==FALSE) {//毛坯
            $shopModel->sb_adrondegree = 1;
        }else {//甲乙丙
            $shopModel->sb_adrondegree = 2;
        }
        $shopModel->sb_recommendtrade = 1;
        //$shopModel->sb_buildingage = $building['builyear'];
        $shopModel->sb_sellorrent = $this->issell?2:1;//2出售
        $shopModel->sb_releasedate = $shop_info['releasetime'];
        $temp = strtotime(date('Y-m-d',strtotime('-'.rand(1,2).' day')));
        $temp = $temp+rand(8,14)*3600+rand(0,59);
        $shopModel->sb_updatedate = $temp;
        $shopModel->sb_expiredate = 86400*30;
        if( ! $shopModel->save()) {
            $sfTrackModel = Soufuntracking::model()->findByPk($this->sfTrack_id);
            $sfTrackModel->infotype = 1;
            $sfTrackModel->errors = serialize($shopModel->errors);
            $sfTrackModel->save();
            return FALSE;
        }else {//保存其它信息
            $sfTrackModel = Soufuntracking::model()->findByPk($this->sfTrack_id);
            $sfTrackModel->sw_id = $shopModel->sb_shopid;
            $sfTrackModel->infotype = 1;
            $sfTrackModel->save();

            $this->inser_id = $shopModel->sb_shopid;
            $model = new Shoppresentinfo();
            $model->sp_shopid = $shopModel->sb_shopid;
            $model->sp_shoptitle = $shop_info['title'];
            $model->sp_shopdesc = $shop_info['descript'];
            if( ! $model->save()) {
                //$sfTrackModel = Soufuntracking::model()->findByPk($this->sfTrack_id);
                $sfTrackModel->infotype = 3;
                $sfTrackModel->errors = serialize($model->errors);
                $sfTrackModel->save();
                return FALSE;
            }
            if($this->issell) {//出售
                $model = new Shopsellinfo();
                $model->ss_shopid = $shopModel->sb_shopid;
                $model->ss_avgprice = $shop_info['sprice'];
                $model->ss_sumprice = $shop_info['sellprice'];

            }else {
                $model = new Shoprentinfo();
                $model->sr_shopid = $shopModel->sb_shopid;
                $model->sr_rentprice = $shop_info['day_price'];
                $model->sr_monthrentprice = $shop_info['month_price'];
                $model->sr_iscontainprocost = $shop_info['ishavepprice'];
                $model->sr_renttype = $building['renttype']=='整租'?1:2;
                $model->sr_basetime = $building['basetime'];

            }
            if( ! $model->save()) {
                //$sfTrackModel = Soufuntracking::model()->findByPk($this->sfTrack_id);
                $sfTrackModel->infotype = 4;
                $sfTrackModel->errors = serialize($model->errors);
                $sfTrackModel->save();
                return FALSE;
            }
            $model = new Shoptag();
            $model->st_shopid = $shopModel->sb_shopid;
            $model->st_isrecommend = rand(0,1);
            $model->st_isnew = rand(0,1);
            $model->st_ishurry = rand(0,1);
            $model->st_check = 4;
            $model->save();

            $peitao = array('客梯','货梯','停车位','暖气','空调','网络','燃气');
            $peitao2 = explode(',', $building['peitao']);//array_uintersect
            $model = new Shopfacilityinfo();
            $model->sf_shopid = $shopModel->sb_shopid;
            //客梯,货梯,停车位,暖气,空调,网络
            $model->sf_carparking = in_array('停车位', $peitao2)?1:0;
            $model->sf_warming = in_array('暖气', $peitao2)?1:0;
            $model->sf_network = in_array('网络', $peitao2)?1:0;
            $model->sf_elecwater = 1;
            $model->sf_elevator = in_array('货梯', $peitao2)?1:0;
            $model->sf_lift = in_array('客梯', $peitao2)?1:0;
            $model->sf_gas = in_array('燃气', $peitao2)?1:0;
            ;
            $model->sf_aircondition = in_array('空调', $peitao2)?1:0;
            $model->sf_tv = 0;
            $model->sf_door = 1;
            $model->save();

            //$sfTrackModel = Soufuntracking::model()->findByPk($this->sfTrack_id);
            $sfTrackModel->infotype = 6;
            $sfTrackModel->save();

            $this->saveImage();

            $sfTrackModel->infotype = 10;
            $sfTrackModel->save();
        }
    }
    public function getFuangInfo() {
        return $this->shop;
    }
    public function getBuildingInfo() {
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
        }
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
                echo $url,'<br />';
                $picdata = file_get_contents($url);
                if( $picdata ) {
                    $imgname = time().rand(111,999).'.'.pathinfo($url,PATHINFO_EXTENSION);
                    echo $path.$imgname,'<br />';
                    file_put_contents($path.$imgname, $picdata);
                    $imageDeal->formatWithPicture($path.$imgname,$standard,true,true,'/images/mark2.jpg');
                    $dba = dba();
                    $picModel = new Picture();
                    $picModel->p_id = $dba->id('35_picture');
                    $picModel->p_sourceid = $this->inser_id;
                    $picModel->p_sourcetype = 5;//Picture::$sourceType;
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
            Shoppresentinfo::model()->updateAll(array('sp_titlepicurl'=>$titlepicurl),'sp_shopid='.$this->inser_id);
        return TRUE;
    }
}