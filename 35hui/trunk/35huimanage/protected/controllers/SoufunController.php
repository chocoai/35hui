<?php
Yii::import('application.extensions.*');
Yii::import('application.common.*');
require 'protected/extensions/simple_html_dom.php';
require_once('image.php');
set_time_limit(0);
class SoufunController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    /**
     * Lists all models.
     */
    public function actionFetch() {
        $rentorsell = $_POST['rentorsell'];
        if(empty($_POST['userid'])) {
            exit('No userid');
        }
        $clinks = $_POST['sfurl'];
        print_r($clinks);
        $clinks_fenlei = array();
        $c = count($clinks);
        while($c--) {//链接分类
            $t = substr($clinks[$c], strrpos($clinks[$c], '/')+1, 1);// /chushou/7_24306973.htm only
            if(in_array($t, array(6,7,3)))//3,住宅 10,别墅 7,写字楼 6,商铺
                $clinks_fenlei[$t][] = $clinks[$c];
        }
        $sftype = array('3'=>'housing','6'=>'shop','7'=>'office');
        foreach ($clinks_fenlei as $tt => $links) {
            $sf = FetchSouFun::Factory($rentorsell, $sftype[$tt]);
            foreach ($links as $value) {
                $sf->fetchContent($value);
            }
            unset($sf);
        }
        exit('<h1>OK</h1>');
    }
    public function actionView(){
        exit('<h1>OK</h1>');
    }
    public function actionIndex() {
        $clinks_fenlei = array();
        $clinks = array();
        $user_info = array();
        $rentorsell = '';
        if(!empty($_GET['agentname'])) {
            $user_name = $_GET['agentname'];
            $rentorsell = $_GET['rentorsell'];
            $fangtype = $_GET['type'];
            if( ! in_array($fangtype, array(6,7)))//3,住宅 10,别墅 7,写字楼 6,商铺
                $fangtype = '0';//不限
            if( ! in_array($rentorsell, array('esf','rent')) )
                $rentorsell = 'esf';
            $doman = $rentorsell == 'esf'?'http://esf.sh.soufun.com':'';
            $co_url = 'http://esf.sh.soufun.com/agent/agentnew/alone'.$rentorsell.'hlist.aspx?&managername='.$user_name;

            $snoopy = new Snoopy;

            $reg = "/\/chu(shou|zu)\/[763]_.*?\.htm$/";///chushou/7_24306973.htm 3,住宅 10,别墅 7,写字楼 6,商铺
            $i = 0;
            do {
                ++$i;
                $html = file_get_html($co_url);
                $div_main = $html->find('div.houstlist02',0);
                if(!$div_main) break;
                $links = $snoopy->_striplinks($div_main->innertext);
                $c = count($links);
                while($c--) {
                    if(!in_array($doman.$links[$c], $clinks) && preg_match($reg, $links[$c])) {
                        $clinks[]=$doman.$links[$c];
                    }
                }
                //if($i == 5) break;
                $next_page = $html->find('a#PageControl1_hlk_next',0);
                $co_url = '';
                if($next_page) {
                    $co_url = 'http://esf.sh.soufun.com'.$next_page->href.'&page='.($i+1);
                    unset($next_page);
                }
                if($i == 1) {

                    $user_info = $this->fech_agentinfo_doc($html,$user_name);
                    $user_info['user_name'] = $user_name;
                    $path = PIC_PATH.'/ua/'.$user_name.'/';
                    !is_dir($path) && mkdir($path);
                    $imgpath = $user_info['ua_photourl'];
                    $imgname = time().rand(111,999).'.'.pathinfo($imgpath,PATHINFO_EXTENSION);
                    $pic = file_get_contents($imgpath);
                    if($pic) {
                        file_put_contents($path.$imgname, $pic);
                        $user_info['ua_photourl'] = '/ua/'.$user_name.'/'.$imgname;
                    }else {
                        $user_info['ua_photourl'] = '';
                    }
                    $imageDeal = new Image();
                    $imageDeal->formatWithPicture($path.$imgname,Uagent::$headPicNorm);//处理缩略图
                    unset($imageDeal);
                    $user = User::model()->findByAttributes(array("user_name"=>'_'.$user_name));
                    if($user) {//存在该用
                        $user_info['user_id'] = $user->user_id;
                    }else {
                        $user_info['user_id'] = $this->createAgent($user_info);
                    }
                }
                $html->clear();
            }while($co_url);
            $c = count($clinks);
            while($c--) {//链接分类
                $t = substr($clinks[$c], strrpos($clinks[$c], '/')+1, 1);// /chushou/7_24306973.htm only
                if($fangtype !== '0' && $t != $fangtype)
                    continue;
                //if($t==6)//3,住宅 10,别墅 7,写字楼 6,商铺
                $clinks_fenlei[$t][] = $clinks[$c];
            }
        }
        $this->render('index',array(
                //'clinks_fenlei'=>$clinks,
                'clinks_fenlei'=>$clinks_fenlei,
                'user_info'=>$user_info,
                'rentorsell'=>$rentorsell,
        ));
    }
    /**
     * 查找经纪人的基本信息，如果不存在将会自动注册
     */
    protected function fech_agentinfo_doc($agenthtmlDoc,$regname) {
        //`user_id` `user_name` `user_salt` `user_pwd` `user_role` `user_regtime` `user_loginnum` `user_lasttime` `user_lastip` `user_value`
        $user_info = array();
        if($agenthtml = $agenthtmlDoc->find('div.leftbar',0)) {
            //`ua_uid`，`ua_province`，`ua_city`，`ua_district`，`ua_section`，`ua_realname`，`ua_tel`，`ua_msn`，`ua_email`,
            //`ua_comid`，`ua_company`，`ua_photourl`，`ua_scardurl`，`ua_scardaudit`，`ua_scardtime`，`ua_bcardurl`,
            //`ua_bcardaudit`，`ua_bcardtime``ua_licenseurl`，`ua_licenseaudit`，`ua_licensetime`，`ua_scardid`，`ua_check`
            $user_info['ua_district'] = iconv('gb2312','UTF-8',$agenthtml->children(0)->children(1)->children(2)->find('a',0)->plaintext);
            $user_info['ua_photourl'] = $agenthtml->children(0)->children(0)->find('img',0)->src;
            $temp = iconv('gb2312','UTF-8',$agenthtml->children(0)->children(3)->children(1)->plaintext);
            $temp = explode('：', $temp);
            $user_info['ua_section'] = explode(',', empty($temp[1])?'':$temp[1]);

            $temp = iconv('gb2312','UTF-8',$agenthtml->children(0)->children(1)->children(0)->plaintext);
            $temp = explode('：', $temp);
            $user_info['ua_realname'] = $temp[1];

            $temp = iconv('gb2312','UTF-8',$agenthtml->children(0)->children(3)->children(0)->plaintext);
            $temp = explode('：', $temp);
            $user_info['ua_company'] = trim($temp[1]);

            $temp = iconv('gb2312','UTF-8',$agenthtml->children(0)->children(3)->children(4)->plaintext);
            $temp = explode('：', $temp);
            $user_info['user_regtime'] = trim($temp[1]);

            $temp = iconv('gb2312','UTF-8',$agenthtml->children(0)->children(2)->plaintext);
            $temp = explode('：', $temp);
            $user_info['ua_tel'] = trim($temp[1]);

            $user_info['ua_msn'] = $user_info['ua_email'] = '';
            $agenticonli = $agenthtml->find('li.iconli',0);
            foreach($agenticonli->find('a') as $e) {
                if(substr_count ( $e->href , 'mailto:')) {
                    $temp = explode(':', $e->href);
                    $user_info['ua_email'] = $temp[1];
                }elseif(substr_count ( $e->href , 'msnim:chat?')) {
                    $temp = explode('?', $e->href);
                    $user_info['ua_msn'] = $temp[1];
                }
            }
        }elseif( ($agenthtml = $agenthtmlDoc->find('div.reldiv',0)) ) {
            exit('没有找到用户的信息div.reldiv 1111。');
            $temp = iconv('gb2312','UTF-8',$agenthtml->children(1)->children(7)->find('a',0)->plaintext);
            $temp = explode('(', $temp);
            $user_info['district'] = empty($temp[1])?'':rtrim($temp[1], ')');
            $user_info['shangquan'] = explode(',', empty($temp[0])?'':$temp[0]);
            $temp = iconv('gb2312','UTF-8',$agenthtml->children(1)->children(5)->plaintext);
            $temp = explode('：', $temp);
            $user_info['regdate'] = trim($temp[1]);
            $temp = iconv('gb2312','UTF-8',$agenthtml->children(1)->children(0)->plaintext);
            $temp = explode('：', $temp);
            $user_info['name'] = $temp[1];

            $temp = iconv('gb2312','UTF-8',$agenthtml->children(1)->children(3)->plaintext);
            $temp = explode('：', $temp);
            $user_info['com_name'] = trim($temp[1]);

            $user_info['msn'] = $user_info['mail'] = '';
            $agenticonli = $agenthtml->children(0)->children(1);
            foreach($agenticonli->find('a') as $e) {
                if(substr_count ( $e->href , 'mailto:')) {
                    $temp = explode(':', $e->href);
                    $user_info['mail'] = $temp[1];
                }elseif(substr_count ( $e->href , 'msnim:chat?')) {
                    $temp = explode('?', $e->href);
                    $user_info['msn'] = $temp[1];
                }
            }
        }else {
            exit('没有找到用户的信息。');
        }
        $user_info['com_tel'] = '';
        $userInfo['user_name'] = $regname;
        return $user_info;
    }

    protected function createAgent($userInfo) {
        $userModel = new User;
        $userModel->user_name = '_'.$userInfo['user_name'];
        $time = time();
        $uid = 0;
        $salt = md5(microtime());
        $pwd = $userInfo['user_name'].'dibiao';
        $reg_time = empty($userInfo['regdate'])?1303257600:strtotime($userInfo['regdate']);//2011-04-20 00:00:00
        $userModel->user_regtime = $reg_time;
        empty($userInfo['regdate']) && $reg_time-=rand(30, 45)*86400;//后推30-45天注册
        $reg_time += rand(0,1)?rand(9,17)*3600-rand(0,59):rand(9,17)*3600+rand(0,59);
        $userModel->user_salt = $salt;
        $userModel->user_pwd = md5($salt.$pwd);
        $userModel->user_role = 2;//经纪人
        $userModel->user_loginnum = 1;
        $userModel->user_lasttime = time()-rand(10,86400);
        //print_r($userModel->attributes);exit;
        $userModel->save();
//$sql = "SELECT `re_id` FROM `35_region` WHERE `re_name` = '".$re_name."' AND `re_parent_id` = '".$parent_id."'; ";

        $userId = $userModel->user_id;

        $uagentModel = new Uagent;
        $uagentModel->attributes = $userInfo;
        $uagentModel->ua_uid = $userId;
        $uagentModel->ua_province = 9;
        $uagentModel->ua_city = 35;
        $uagentModel->ua_district = $this->getParentId(trim($uagentModel->ua_district));
        $regionModel = Region::model()->findByAttributes(array("re_name"=>$userInfo['ua_section'],'re_parent_id'=>$uagentModel->ua_district));
        $uagentModel->ua_section = 0;
        if($regionModel) {
            $uagentModel->ua_section = $regionModel->re_id;
        }
        $temp = '/ua/360dibiao/log.jpg';
        $time = time();
        $uagentModel->ua_scardurl = $temp;
        $uagentModel->ua_scardaudit = 1;
        $uagentModel->ua_scardtime = $time;
        $uagentModel->ua_bcardurl = $temp;
        $uagentModel->ua_bcardaudit = 1;
        $uagentModel->ua_bcardtime = $time;
        /*
        $uagentModel->ua_licenseurl = $temp;
        $uagentModel->ua_licenseaudit = 0;//营业执照
        $uagentModel->ua_licensetime = $time;
         */
        $uagentModel->ua_scardid = '';
        $uagentModel->ua_check = 1;
        if(!$uagentModel->save()){
            print_r($uagentModel->errors);
            exit;
        }
        Userproperty::model()->addUserProperty($userId,20,20);
        return $userId;
    }
    protected function getParentId($district) {//此md5UTF8编码
        $area_hash = array ( 'fb96d27024cbfbb53b4a301b8b1e5608' => array ( 0 => '36', 1 => '黄浦', ),
                '9eee33bfec3fd8b2f62733d6d6cb3607' => array ( 0 => '54', 1 => '崇明', ),
                '61f2b555ba2caaecd7fa995187580239' => array ( 0 => '53', 1 => '奉贤', ),
                '63faa375f9188c608bdf9cbedff08323' => array ( 0 => '51', 1 => '青浦', ),
                'f6abc275c3ebcfa291db2189300e763c' => array ( 0 => '50', 1 => '松江', ),
                '334facb5d20ccbf41e86e20a618cee3a' => array ( 0 => '49', 1 => '金山', ),
                '883ab81ed2c52742781c7f3e9f6d507b' => array ( 0 => '48', 1 => '浦东新', ),
                'f84cd9d7914cc67b2f53894e35b49a9c' => array ( 0 => '48', 1 => '南汇', ),
                '673ccc0a0cac8665769e56e8e751f36d' => array ( 0 => '48', 1 => '浦东', ),
                'c50a9ffae3607340c518a21748595f19' => array ( 0 => '47', 1 => '嘉定', ),
                '9ca75ac59a94374fab75106f0675bfb8' => array ( 0 => '46', 1 => '宝山', ),
                'edf3b5195cdbeb962a8bea56a8a7d96b' => array ( 0 => '45', 1 => '闵行', ),
                '146d8169b415c1469b98fdf782e7d3fb' => array ( 0 => '44', 1 => '杨浦', ),
                '59fcede97efb81015ede5cc9beb6f859' => array ( 0 => '43', 1 => '虹口', ),
                '1ab64fd0484277f109d3ede3b480690f' => array ( 0 => '42', 1 => '闸北', ),
                '2f7e14abbd80c7c0ab3989ab6fb3d631' => array ( 0 => '41', 1 => '普陀', ),
                'a84d642b3c2873e0eb9df6c98f08a51e' => array ( 0 => '40', 1 => '静安', ),
                '44098250f7f2651e98d9ccaaa73ade87' => array ( 0 => '39', 1 => '长宁', ),
                '0af3bc8c735c8fa564dd8a19e0951d69' => array ( 0 => '38', 1 => '徐汇', ),
                '73418bdd61de5204a328ca494ad8b66f' => array ( 0 => '37', 1 => '卢湾', ),
                '7a20efaddd87e05edb5ca9f80fefd049' => array ( 0 => '244', 1 => '上海周边', ), );
        $hash = md5($district);
        if(array_key_exists($hash,$area_hash)) {
            return $area_hash[$hash][0];
        }else {
            //fileLog('collect_log', $district.'区未匹配到');
            return 0;
        }
    }

}
