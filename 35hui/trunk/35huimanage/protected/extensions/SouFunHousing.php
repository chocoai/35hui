<?php
/**
 * Description of SouFunHousing
 *
 * @author skding
 */

class SouFunHousing {
    public $content;
    public $courl;
    private $userid;
    private $issell;
    private $housing;
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
        echo $url,'<br />';
        $md5url = md5(trim($url));
        $sfTrackModel = Soufuntracking::model()->findByAttributes(array("md5url"=>$md5url));
        if($sfTrackModel) {
            return FALSE;
        }else {
            $sfTrackModel = new Soufuntracking();
            $attValue = array('sw_type'=>3,'sw_id'=>0,'url'=>$url,'md5url'=>$md5url,
                    'infotype'=>'0','codate'=>date('Ymd'),'timestamp'=>time(),'errors'=>'');
            $sfTrackModel->attributes = $attValue;
            $sfTrackModel->save();
            $this->sfTrack_id = $sfTrackModel->id;
        }

        $reg_int = "'\d{1,10}'";
        $reg_float = "'(\d+)(\.\d+)?'";
        $reg_span = "'<span.*\/span\>'i";
        $reg_span_c = "'<span.*?>(.*?)<'i";
        $snoopy = new Snoopy;
        $snoopy->fetch($url);
        $htmlStr = $snoopy->results;
        $htmlStr = iconv('GBK','UTF-8',$htmlStr);
//内容查询
        $reg_outpic = "'\[\{(.*?)\}\]'i";
        preg_match($reg_outpic, $htmlStr, $matches);
        if( ! empty($matches[1]) ) {
            $reg_picurl = "'bigpic\':\'(.*?)\''i";
            preg_match_all($reg_picurl, $matches[1], $temp);
            $this->outdoorimgs = empty($temp[1])?'':$temp[1];
        }
        $html = str_get_html($htmlStr);
        $div_info = $html->find('div.info',0);//beizhu
        $housing_info = array();
        $housing_info['descript'] = trim($html->find('div.beizhu',0)->innertext);
        if(empty($housing_info['descript'])) {
            echo '<h2 style="color:red">描述为空</h2>';
            return FALSE;}
        if($this->issell) {//出售
            $housing_info['title'] = trim($div_info->children(1)->children(0)->plaintext);
            $temp = $div_info->children(1)->children(1)->plaintext;
            $temp = explode('：', $temp);
//print_r($temp);exit;
            $temp = explode('(',$temp[count($temp)-1]);
            $housing_info['releasetime'] = strtotime($temp[0]);
            $temp = $div_info->children(2)->children(2)->plaintext;
            preg_match($reg_int, $temp, $match);
            $housing_info['sprice'] = empty($match[0])?'0':$match[0];

            $temp = $div_info->children(2)->children(5)->plaintext;
            preg_match($reg_int, $temp, $match);
            $housing_info['mianji'] = empty($match[0])?'0':$match[0];
            $temp = $div_info->children(2)->children(0)->plaintext;
            preg_match($reg_int, $temp, $match);
            $housing_info['sellprice'] = empty($match[0])?'0':$match[0];//万元
        }else {
            $housing_info['title'] = trim($div_info->children(0)->children(0)->plaintext);
            $temp = $div_info->children(0)->children(1)->plaintext;
            $temp = explode('：', $temp);
//print_r($temp);exit;
            $temp = explode('(',$temp[count($temp)-1]);
            $housing_info['releasetime'] = strtotime($temp[0]);
            $temp = $div_info->children(1)->children(0)->plaintext;
            preg_match($reg_int, $temp, $match);
            $housing_info['mouth_price'] = empty($match[0])?'0':$match[0];
            $temp = $div_info->children(1)->children(3)->plaintext;
            preg_match($reg_int, $temp, $match);
            $housing_info['mianji'] = empty($match[0])?'0':$match[0];
            $housing_info['hoseunit'] = preg_replace($reg_span, '', $div_info->children(1)->children(2)->children(0)->plaintext);
            $housing_info['paytype'] = trim(preg_replace($reg_span, '', $div_info->children(1)->children(4)->plaintext));
            $housing_info['renttype'] = preg_replace($reg_span, '', $div_info->children(1)->children(5)->plaintext);

        }

        $building = array();
        if($this->issell) {//出售
            $temp1 = $div_info->children(3)->children(0);
            $building['name'] = $temp1->children(1)->plaintext;
            $building['href'] = $temp1->children(1)->href;
            $building['bankuai'] = $temp1->children(2)->plaintext.'-'.$temp1->children(3)->plaintext;
            $temp1 = $div_info->children(3);

            $building['addres'] = $snoopy->_striptext(preg_replace($reg_span, '', $temp1->children(1)->innertext));
            //$housing_info['paytype'] = preg_replace($reg_span, '', $temp1->children(2)->innertext);

        }else {
            $temp1 = $div_info->children(2)->children(0);
            //echo $temp1->innertext;exit;
            $building['name'] = $temp1->children(1)->plaintext;
            $building['href'] = $temp1->children(1)->href;
            $building['bankuai'] = $temp1->children(2)->plaintext.'-'.$temp1->children(3)->plaintext;
            $temp1 = $div_info->children(2);

            $building['addres'] = $snoopy->_striptext(preg_replace($reg_span, '', $temp1->children(1)->innertext));
            //$housing_info['hoseunit'] = preg_replace($reg_span, '', $temp1->children(2)->innertext);
        }
        $hash_key = array(
                '_hoseunit'  =>'30109bd44a8e6c66bcc6a2a9b6a5da40',
                '_builyear'  =>'19c9f017ded1969abbeeb143efa1134d',
                '_towords'   =>'eb5d0f62217ff049ba26b78dfee206a4',
                '_hosetype'  =>'86f59be8e5679fd74b45a7536985615b',
                '_floor'     =>'d60ee98f0a89e51e5470008ae3884442',
                '_zhuangxiu' =>'f46f1182583f4fb224b10284e3aa70a1',
                '_hosebutype'=>'3e5e65d6fd782c46efc2616712d05b29',
                '_chanquan'  =>'724d744206e36c1a454743978c8c3b4b',
                '_seetime'   =>'38e233f6e3bdbd364664f0be88e3d98f',
                '_peitao2'   =>'60d6d381ab9d6309eec5534cb46c8c9b',
                '_peitao'    =>'1eabba5eeff6c077810c412c01e3550d',
        );
        $hash_building = array (//key = md5(注释:utf8)
                '30109bd44a8e6c66bcc6a2a9b6a5da40' => '',//户型：
                '19c9f017ded1969abbeeb143efa1134d' => '',//建筑年代：
                'eb5d0f62217ff049ba26b78dfee206a4' => '',//朝向：
                '86f59be8e5679fd74b45a7536985615b' => '',//住宅类别：
                'd60ee98f0a89e51e5470008ae3884442' => '',//楼层：
                'f46f1182583f4fb224b10284e3aa70a1' => '',//装修：
                '3e5e65d6fd782c46efc2616712d05b29' => '',//房屋结构：
                '724d744206e36c1a454743978c8c3b4b' => '',//产权性质：
                '38e233f6e3bdbd364664f0be88e3d98f' => '',//看房时间：
                '60d6d381ab9d6309eec5534cb46c8c9b' => '',//室内设施：
                '1eabba5eeff6c077810c412c01e3550d' => '',//配套设施：
        );

        for($i = 2,$c = count($temp1->children);$i<$c;$i++) {
            $str = $temp1->children($i)->innertext;
            //echo $temp1->children($i)->children(0)->tag,$str,'<br />';
            if(preg_match($reg_span_c, $str,$match)) {
                $temp = trim($match[1]);
                $temp = str_replace("　",'',$temp);
                $temp = str_replace(" ",'',$temp);
                $hash_building[md5($temp)] = trim(preg_replace($reg_span, '', $str));
            }
        }
        $this->issell || $building['builyear'] = (int)$hash_building[$hash_key['_builyear']];
        $this->issell && $building['hoseunit'] = $hash_building[$hash_key['_hoseunit']];
        $building['towords'] = $hash_building[$hash_key['_towords']];
        //$building['type'] = $hash_building[$hash_key['_hosetype']];
        preg_match_all($reg_int, $hash_building[$hash_key['_floor']], $match);
        $building['allfloor'] = empty($match[0][1])?0:$match[0][1];
        $building['atfloor'] = empty($match[0][0])?0:$match[0][0];
        $building['zhuangxiu'] = $hash_building[$hash_key['_zhuangxiu']];
        $building['peitao'] = $hash_building[$hash_key['_peitao']];
        $this->issell || $building['peitao2'] = $hash_building[$hash_key['_peitao2']];

        $temp1 = $html->find('dl.xqpic',0);
        if($temp1)
            $this->fetchImages($temp1->children);
        $html->clear();
        unset($temp1,$html);

        $temp = Communitybaseinfo::model()->findByAttributes(array("comy_name"=>trim($building['name']) ));
        if($temp) {
            $housing_info['communityid'] = $temp->comy_id;
        }else {
            $housing_info['communityid'] = $this->creatSystemBuild($building);
        }


        print_r($housing_info);
        print_r($building);
        echo '<br />';
        $this->housing = $housing_info;
        $this->building = $building;
        $this->creatHousing( $housing_info, $building );
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
    public function creatSystemBuild($building) {
        $building['name'] = trim($building['name']);
        if(empty($building['name'])) exit('没有名称');
        $default = '暂无资料';
        $model=new Communitybaseinfo();
//计算拼音缩写
        /*
         *   `comy_pinyinshortname` varchar(50) default NULL COMMENT '小区英文缩写',
  `comy_pinyinlongname`
         */
        $pinyin = new Pinyin;
        $pinYinArray = $pinyin->doWord($building['name']);
        $model->comy_pinyinshortname = $pinYinArray['short'];
        $model->comy_pinyinlongname = $pinYinArray['long'];

        $model->comy_name = $building['name'];
        $model->comy_introduce = $default;
        $model->comy_address = $building['addres'];
        $model->comy_propertytype = 5;
        //$model->comy_propertytype = $default;//1公寓2别墅3新里洋房4老公房5其他',//$building['type']
        $model->comy_developer = $default;
        $model->comy_propertyname = $default;
        $model->comy_propertytel = $default;
        $model->comy_propertyprice = 0;
        $model->comy_avgsellprice = 0;
        $model->comy_cubagerate = 0;
        $model->comy_afforestation = 0;
        $model->comy_householdnum = 0;
        $model->comy_parking = 0;
        $model->comy_buildingera = empty($building['builyear'])?'0':$building['builyear'];//builyear
        $model->comy_saleaddress = $default;
        $model->comy_houseown = 0;
        $model->comy_province = 9;
        $model->comy_city = 35;
        $model->comy_district = 0;
        $model->comy_section = 0;
        if( ! empty($building['bankuai'])) {
            $temp = explode('-', $building['bankuai']);
            $temp[0]=trim($temp[0]);
            $temp[1] = trim($temp[1]);
            if( isset($this->$bankuaiMap[$temp[0]][$temp[1]]) ){
                $temp[1]=$this->$bankuaiMap[$temp[0]][$temp[1]];
            }
            $region = Region::model()->findByAttributes(array("re_name"=>trim($temp[0]),'re_parent_id'=>35));
            if($region) {
                $model->comy_district = $region->re_id;
                $region = Region::model()->findByAttributes(array("re_name"=>$temp[1],'re_parent_id'=>$model->comy_district));
                if($region) {
                    $model->comy_section = $region->re_id;
                }elseif(!empty($temp[1])) {
                    $region = new Region();
                    $region->re_name = $temp[1];
                    $region->re_parent_id = $model->comy_district;
                    $region->save();
                    $model->comy_section = $region->re_id;
                }
            }
        }
        if($model->comy_district == 0) {
            echo empty($building['bankuai'])?'':$building['bankuai'],'<br />';
            eixt('板块信息不完善');
        }
        $model->comy_titlepic = 0;
        $model->comy_saletel = '';
        $model->comy_x = 0;
        $model->comy_y = 0;
        $model->comy_traffic = 0;
        $model->comy_buildingarea = 0;
        $model->comy_school = $default;
        $model->comy_shopping = $default;
        $model->comy_bank = $default;
        $model->comy_hospital = $default;
        $model->comy_dining = $default;
        $model->comy_vegetables = $default;
        $model->comy_other = '';
        $model->comy_inserttime = time();
        $model->comy_score = 0;
        $model->comy_ratingnum = 0;
        $model->comy_line = '';
        $model->comy_iscollect = 1;

        if( ! $model->save() ) {
            print_r($model->errors);
            exit();
        }

        return $model->comy_id;

    }

    public function creatHousing( $housing_info, $building ) {
        $residModel = new Residencebaseinfo();
        $residModel->rbi_communityid = $housing_info['communityid'];
        $residModel->rbi_uid = $this->userid;
        $residModel->rbi_rentorsell = $this->issell?2:1;//2出售
        $residModel->rbi_area = $housing_info['mianji'];
        $temp = $this->issell?$building['hoseunit']:$housing_info['hoseunit'];//一室一厅一卫一厨
        $numarr = array('一','二','三','四','五','六','七','八');//零
        $numarr = array(
                array('一','二','三','四','五','六','七','八'),
                array('1','2','3','4','5','6','7','8'),
        );
        $c = 8;
        $rr = array('rbi_room'=>1,'rbi_office'=>1,'rbi_bathroom'=>1);
        $t = $this->issell?0:1;
        while ($c--) {
            if(strpos($temp, $numarr[$t][$c].'室') !== FALSE) {
                $rr['rbi_room'] = $c+1;
            }
            if(strpos($temp, $numarr[$t][$c].'厅') !== FALSE) {
                $rr['rbi_office'] = $c+1;
            }
            if(strpos($temp, $numarr[$t][$c].'卫') !== FALSE) {
                $rr['rbi_bathroom'] = $c+1;
            }
        }
        $residModel->rbi_room = $rr['rbi_room'];
        $residModel->rbi_office = $rr['rbi_office'];
        $residModel->rbi_bathroom = $rr['rbi_bathroom'];
        $residModel->rbi_floor = $building['atfloor'];
        $residModel->rbi_allfloor = $building['allfloor'];
        $residModel->rbi_buildingera = empty($building['builyear'])?'0':$building['builyear'];//builyear
        $towardarr = array('ssss','东','南','西','北','东南','西南','西北','东北','南北','东西');//key是对应的值
        $residModel->rbi_toward = 1;
        $key = array_search($building['towords'], $towardarr);
        if ( $key ) $residModel->rbi_toward = $key;
        $zhuangxiuarr = array('ss','毛坯','简单装修','精装修','豪华装修');
        $zhuangxiuarr = array('ss','毛坯','dddd','精装修','豪华装修');
        $residModel->rbi_decoration = 2;
        $key = array_search($building['zhuangxiu'], $zhuangxiuarr);
        if ( $key ) $residModel->rbi_decoration = $key;
        $residModel->rbi_number = '';
        $residModel->rbi_title = $housing_info['title'];
        $residModel->rbi_residencedesc = $housing_info['descript'];
        $residModel->rbi_releasedate = $housing_info['releasetime'];
        $temp = strtotime(date('Y-m-d',strtotime('-'.rand(1,2).' day')));
        $temp = $temp+rand(8,14)*3600+rand(0,59);
        $residModel->rbi_updatedate = $temp;
        $residModel->rbi_titlepicurl = 0;
        $residModel->rr_validdate = 86400*30;
        if( ! $residModel->save() ) {
            print_r($residModel->errors);
            $sfTrackModel = Soufuntracking::model()->findByPk($this->sfTrack_id);
            $sfTrackModel->infotype = 1;
            $sfTrackModel->errors = serialize($residModel->errors);
            $sfTrackModel->save();
            return FALSE;
        }else {//rbi_id
            $sfTrackModel = Soufuntracking::model()->findByPk($this->sfTrack_id);
            $sfTrackModel->sw_id = $residModel->rbi_id;
            $sfTrackModel->infotype = 1;
            $sfTrackModel->save();

            $this->inser_id = $residModel->rbi_id;

            if($this->issell) {
                $model = new Residencesellinfo();
                $model->rs_rbiid = $residModel->rbi_id;
                $model->rs_price = $housing_info['sellprice'];
                $model->rs_unitprice = $housing_info['sprice'];
                $model->rs_lease = 0;

            }else {
                $model = new Residencerentinfo();
                $model->rr_rbiid = $residModel->rbi_id;
                $model->rr_rentprice = $housing_info['mouth_price'];
                $model->rr_renttype = strpos($housing_info['renttype'], '整') !== FALSE?'1':'2';
                $model->rr_rentdetain = 1;
                $model->rr_rentpay = 3;
                $temp = $housing_info['paytype'];
                $temparr = array('1'=>'一','2'=>'二','3'=>'三','6'=>'半');
                foreach ($temparr as $key=>$val) {
                    if(strpos($temp, '押'.$val) !== FALSE)
                        $model->rr_rentdetain = $key;
                    if(strpos($temp, '付'.$val) !== FALSE)
                        $model->rr_rentpay = $key;
                }
                if(strpos($temp, '无押') !== FALSE)
                    $model->rr_rentdetain = 0;
                if(strpos($temp, '年付') !== FALSE)
                    $model->rr_rentpay = 6;

                $temp = $building['peitao2'];//$building['peitao'].
                $model->rr_facilities =
                        $temparr = array('ss','电视机','冰箱','空调','洗衣机','热水器','微波炉');
                $detain = array();
                if($temp) {
                    foreach ($temparr as $key => $val) {
                        if(strpos($temp, $val) !== FALSE)
                            $detain[] = $key;
                    }
                }
                if ($detain)
                    $model->rr_facilities = implode(',', $detain);
                else
                    $model->rr_facilities = '';

            }
            if( ! $model->save() ) {
                $sfTrackModel->infotype = 4;
                $sfTrackModel->errors = serialize($model->errors);
                $sfTrackModel->save();
                return false;
            }
            $model = new Residencetag();
            $model->rt_rbiid = $residModel->rbi_id;
            $model->rt_isrecommend = rand(0,1);
            $model->rt_ishurry = rand(0,1);
            $model->rt_check = 4;
            $model->save();
            
            $sfTrackModel->infotype = 6;
            $sfTrackModel->save();

            $this->saveImage();

            $sfTrackModel->infotype = 10;
            $sfTrackModel->save();

        }
    }
    public function getFuangInfo() {
        return $this->housing;
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
                    case '户型图':
                        $index = 'ichnopic';//'ichnograph';
                        break;
                    case '室内图':
                        $index = 'indoorpic';
                        break;
                    case '楼盘相关图':
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
                    $picModel->p_sourcetype = 8;//Picture::$sourceType;
                    $picModel->p_type = $ptypearr[$type];
                    $picModel->p_img = '/'.$type.'/'.$imgname;
                    $picModel->p_tinyimg = $picModel->p_img;
                    $picModel->p_uploadtime = time();
                    if( ! $picModel->save()) {
                        print_r($picModel->errors);
                    } else {
                        $titlepicurl = $picModel->p_id;
                    }

                }else {
                    echo '====下载失败='.$url.'===<br />';
                }

            }
        }
        if ( $titlepicurl )
            Residencebaseinfo::model()->updateAll(array('rbi_titlepicurl'=>$titlepicurl),'rbi_id='.$this->inser_id);
        return TRUE;
    }
}