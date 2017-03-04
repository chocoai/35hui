<?php
//set_time_limit(180);
Yii::import('ext.GoogleChartImage');
class ChartController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column3';
    protected $db;
    protected $timestamp;
    protected $timeToday;

    public function init(){
        $this->timestamp=time();
        $this->timeToday=strtotime(date('Ymd',$this->timestamp));
        $this->db=Yii::app()->db;
        $this->db->active=true;
    }

    protected function chartCsd($chdsMax,$step=5){
        $stepConfig=array('50'=>'10','100'=>'20','200'=>'30','400'=>'50');
        foreach($chart['chd']['all'] as $v){
            if($chdsMax < $v)
                $chdsMax=$v;
        }

        foreach($stepConfig as $key=>$v){
            if($key > $chdsMax)
                break;
        }
        $chdsMax=ceil($chdsMax/$v)*$v;
        $chdsStep=floor($chdsMax/$step);
        return array($chdsMax,$chdsStep);
    }

    /**
     * 用户注册柱形图
     */
    public function actionIndex() {
        $chart=array();
        $chart['chxl']='';
        $chart1=array();
        $chart1['chxl']='';
        $startTime=0;
        $month=array();
        $month['self']=date('Ym',$this->timestamp).'01';
        if(empty($_GET['st'])){
            $chart['chtt']='最近30天普通用户注册柱形图';
            $chart1['chtt']='最近30天经纪人注册柱形图';
            $startTime=strtotime(date('Ymd',strtotime('-30 day', $this->timestamp)));
            $month['last']=date('Ym',strtotime('last month')).'01';
            $month['next']=date('Ym',strtotime('next month')).'01';
        }else{
            $startTime=strtotime($_GET['st']);
            $chart['chtt']=date('Y年m月',$startTime).'普通用户注册柱形图';
            $chart1['chtt']=date('Y年m月',$startTime).'经纪人注册柱形图';
            $month['last']=date('Ym',strtotime('last month',$startTime)).'01';
            $month['next']=date('Ym',strtotime('next month',$startTime)).'01';
        }
        $endTime=strtotime($month['next']);
        if($endTime>$this->timeToday){
            $endTime=$this->timeToday+86400;
        }
        $this->breadcrumbs=array(
            '用户注册',
        );
        $this->menu=array(
            array('label'=>'最近30天', 'url'=>array('index')),
            array('label'=>'本　月', 'url'=>array('index','st'=>$month['self'])),
            array('label'=>'上个月', 'url'=>array('index','st'=>$month['last'])),
        );
        $this->menuAction=array(
            array('label'=>'用户每日登录', 'url'=>array('login')),
            array('label'=>'房源发布柱形图', 'url'=>array('release')),
            array('label'=>'用户注册分布（区）', 'url'=>array('distribution')),
            array('label'=>'用户注册', 'url'=>array('index')),
        );
        if($month['next']<$month['self']){
            $this->menu[]=array('label'=>'下个月', 'url'=>array('index','st'=>$month['next']));
        }

        $timeMonth=strtotime(date('Ymd',strtotime('-30day', $this->timestamp)));
        $temp=array();
        $i=$startTime;
        while($i<$endTime){
            $key=date('Ymd',$i);
            $temp[$key]=0;
            $chart['chxl'].=date('d',$i).'|';
            $i+=86400;
        }
        $chart['chxl']=rtrim($chart['chxl'],'|');
        $chart['chd']['user']=$temp;//普通用户
        $chart1['chd']['uagent']=$temp;//经纪人
        $sql='SELECT `user_id`,`user_regtime`as t,FROM_UNIXTIME(`user_regtime`,\'%Y%m%d\') as ymd FROM {{user}} WHERE `user_regtime`>'.$startTime.' AND `user_regtime`<'.$endTime.' AND `user_role`=1 ORDER BY `user_regtime` ;';
        $userRS=$this->db->createCommand($sql)->queryAll();
        foreach ($userRS as $rs) {
            $chart['chd']['user'][$rs['ymd']]++;
        }
        $sql='SELECT `user_id`,`user_regtime`as t,FROM_UNIXTIME(`user_regtime`,\'%Y%m%d\') as ymd FROM {{user}} WHERE `user_regtime`>'.$startTime.' AND `user_regtime`<'.$endTime.' AND `user_role`=2 ORDER BY `user_regtime` ;';
        $userRS=$this->db->createCommand($sql)->queryAll();
        foreach ($userRS as $rs) {
            $chart1['chd']['uagent'][$rs['ymd']]++;
        }
        $stepConfig=array('50'=>'10','100'=>'20','200'=>'30','400'=>'50');
        $chdsMax=20;
        $chdsStep=20;
        foreach($chart['chd']['user'] as $v){
            if($chdsMax < $v)
                $chdsMax=$v;
        }
         foreach($chart1['chd']['uagent'] as $v){
            if($chdsMax < $v)
                $chdsMax=$v;
        }
        foreach($stepConfig as $key=>$v){
            if($key > $chdsMax)
                break;
        }
        $chdsMax=ceil($chdsMax/$v)*$v;
        $chdsStep=floor($chdsMax/5);
        $test1=new GoogleChartImage();
        $test1->data=array(
            'chs'=>'800x300',
             'chds'=>'0,'.$chdsMax,
             'chxt'=>'x,y',
             'chts'=>'000000,15',
             'cht'=>'bvs',
             'chdl'=>'经纪人',
             'chma'=>'5,5,5,5|40,40',
             'chco'=>'00FF00',
             'chbh'=>'r,.3',
             'chm'=>'N,0000FF,-1,,12',
        );
        $chd='t:';
        foreach ($chart1['chd'] as $key => $values) {
            foreach ($values as $key => $val) {
                $chd.=$val.',';
            }
            $chd=rtrim($chd, ',').'|';
        }
        $chd=rtrim($chd, '|');
        
        $test1->addData('chd', $chd);
        $test1->addData('chxl', '0:|'.$chart['chxl']);
        $test1->addData('chtt', $chart1['chtt'].' ['.date('m/d/Y H:i', $this->timestamp).']');
        $test1->addData('chxr', '1,0,'.$chdsMax.','.$chdsStep);
        
        $test=new GoogleChartImage();
        $test->data=array(
            'chs'=>'800x300',
             'chds'=>'0,'.$chdsMax,
             'chxt'=>'x,y',
             'chts'=>'000000,15',
             'cht'=>'bvs',
             'chdl'=>'普通用户',
             'chma'=>'5,5,5,5|40,40',
             'chco'=>'00FF00',
             'chbh'=>'r,.3',            
             'chm'=>'N,0000FF,-1,,12',
        );
        $chd='t:';
        foreach ($chart['chd'] as $key => $values) {
            foreach ($values as $key => $val) {
                $chd.=$val.',';
            }
            $chd=rtrim($chd, ',').'|';
        }
        $chd=rtrim($chd, '|');
        $test->addData('chd', $chd);
        $test->addData('chxl', '0:|'.$chart['chxl']);
        $test->addData('chtt', $chart['chtt'].' ['.date('m/d/Y H:i', $this->timestamp).']');
        $test->addData('chxr', '1,0,'.$chdsMax.','.$chdsStep);

        $this->render('index',array(
                'charturl'=>$test->chart,
                 'charturl2'=>$test1->chart,
        ));   
    }
    /**
     * 房源发布的数量柱形图
     */
    public function actionRelease() {
        $type='office';
        if(!empty($_GET['t']) && in_array($_GET['t'], array('office','shop','zhuzhai')) ){
            $type=$_GET['t'];
        }
        $typeDesc=array('office'=>'写字楼','shop'=>'商铺','zhuzhai'=>'住宅');
        $chart=array();
        $chart['chxl']='';
        $startTime=0;
        $month=array();
        $month['self']=date('Ym',$this->timestamp).'01';
        if(empty($_GET['st'])){
            $chart['chtt']='最近30天'.$typeDesc[$type].'发布出租情况柱形图';
            $chart1['chtt']='最近30天'.$typeDesc[$type].'发布出售情况柱形图';
            $startTime=strtotime(date('Ymd',strtotime('-30 day', $this->timestamp)));
            $month['last']=date('Ym',strtotime('last month')).'01';
            $month['next']=date('Ym',strtotime('next month')).'01';
        }else{
            $startTime=strtotime($_GET['st']);
            $chart['chtt']=date('Y年m月',$startTime).$typeDesc[$type].'发布出租情况柱形图';
            $chart1['chtt']=date('Y年m月',$startTime).$typeDesc[$type].'发布出售情况柱形图';
            $month['last']=date('Ym',strtotime('last month',$startTime)).'01';
            $month['next']=date('Ym',strtotime('next month',$startTime)).'01';
        }
        $endTime=strtotime($month['next']);
        if($endTime>$this->timeToday){
            $endTime=$this->timeToday+86400;
        }
        $this->breadcrumbs=array(
            '写字楼'=>array('release','t'=>'office'),
            '商铺'=>array('release','t'=>'shop'),
            '住宅'=>array('release','t'=>'zhuzhai'),
        );
        $this->menuAction=array(
            array('label'=>'用户每日登录', 'url'=>array('login')),
            array('label'=>'房源发布柱形图', 'url'=>array('release')),
            array('label'=>'用户注册分布（区）', 'url'=>array('distribution')),
            array('label'=>'用户注册', 'url'=>array('index')),
        );
        $this->menu=array(
            array('label'=>'最近30天', 'url'=>array('release','t'=>$type)),
            array('label'=>'本　月', 'url'=>array('release','t'=>$type,'st'=>$month['self'])),
            array('label'=>'上个月', 'url'=>array('release','t'=>$type,'st'=>$month['last'])),
        );
        if($month['next']<$month['self']){
            $this->menu[]=array('label'=>'下个月', 'url'=>array('index','t'=>$type,'st'=>$month['next']));
        }

        $timeMonth=strtotime(date('Ymd',strtotime('-30day', $this->timestamp)));
        $temp=array();
        $i=$startTime;
        while($i<$endTime){
            $key=date('Ymd',$i);
            $temp[$key]=0;
            $chart['chxl'].=date('d',$i).'|';
            $i+=86400;
        }
        $chart['chxl']=rtrim($chart['chxl'],'|');
        $chart['chd']['rent']=$temp;//出租
        $chart1['chd']['sale']=$temp;//出售

        $sql='SELECT `ob_officeid`,`ob_releasedate`as t,FROM_UNIXTIME(`ob_releasedate`,\'%Y%m%d\') as ymd 
            FROM {{officebaseinfo}} WHERE `ob_releasedate`>'.$startTime.' AND `ob_releasedate`<'.$endTime.' AND `ob_sellorrent` =1  ORDER BY `ob_officeid` ;';
        $sql2='SELECT `ob_officeid`,`ob_sellorrent` AS r,`ob_releasedate`as t,FROM_UNIXTIME(`ob_releasedate`,\'%Y%m%d\') as ymd
            FROM {{officebaseinfo}} WHERE `ob_releasedate`>'.$startTime.' AND `ob_releasedate`<'.$endTime.' AND `ob_sellorrent` =2  ORDER BY `ob_officeid` ;';
        if($type=='shop'){
            $sql='SELECT `sb_shopid`,`sb_sellorrent` AS r,`sb_releasedate`as t,FROM_UNIXTIME(`sb_releasedate`,\'%Y%m%d\') as ymd
            FROM {{shopbaseinfo}} WHERE `sb_releasedate`>'.$startTime.' AND `sb_releasedate`<'.$endTime.'  AND `sb_sellorrent` =1  ORDER BY `sb_shopid` ;';
            $sql2='SELECT `sb_shopid`,`sb_sellorrent` AS r,`sb_releasedate`as t,FROM_UNIXTIME(`sb_releasedate`,\'%Y%m%d\') as ymd
            FROM {{shopbaseinfo}} WHERE `sb_releasedate`>'.$startTime.' AND `sb_releasedate`<'.$endTime.'  AND `sb_sellorrent` =2  ORDER BY `sb_shopid` ;';

        }elseif($type=='zhuzhai'){
            $sql='SELECT `rbi_id`,`rbi_rentorsell` AS r,`rbi_releasedate`as t,FROM_UNIXTIME(`rbi_releasedate`,\'%Y%m%d\') as ymd
            FROM {{residencebaseinfo}} WHERE `rbi_releasedate`>'.$startTime.' AND `rbi_releasedate`<'.$endTime.'  AND `rbi_rentorsell` =1  ORDER BY `rbi_id` ;';
            $sql2='SELECT `rbi_id`,`rbi_rentorsell` AS r,`rbi_releasedate`as t,FROM_UNIXTIME(`rbi_releasedate`,\'%Y%m%d\') as ymd
            FROM {{residencebaseinfo}} WHERE `rbi_releasedate`>'.$startTime.' AND `rbi_releasedate`<'.$endTime.'  AND `rbi_rentorsell` =2  ORDER BY `rbi_id` ;';
        }
        $userRS=$this->db->createCommand($sql)->queryAll();
        foreach ($userRS as $rs) {
            $chart['chd']['rent'][$rs['ymd']]++;
        }
        $userRS2=$this->db->createCommand($sql2)->queryAll();
        foreach ($userRS2 as $rs) {
            $chart1['chd']['sale'][$rs['ymd']]++;
        }
        $stepConfig=array('50'=>'20','200'=>'50','500'=>'100');
        $chdsMax=20;
        $chdsStep=20;
        foreach($chart['chd']['rent'] as $v){
            if($chdsMax < $v)
                $chdsMax=$v;
        }
        foreach($chart1['chd']['sale'] as $v){
            if($chdsMax < $v)
                $chdsMax=$v;
        }

        foreach($stepConfig as $key=>$v){
            if($key > $chdsMax)
                break;
        }
        $chdsMax=ceil($chdsMax/$v)*$v;
        $chdsStep=floor($chdsMax/5);

        $test=new GoogleChartImage();
        $test->data=array(
            'chs'=>'800x300',
             'chds'=>'0,'.$chdsMax,
             'chxt'=>'x,y',
             'chts'=>'000000,15',
             'cht'=>'bvs',
             'chdl'=>'出租',
             'chma'=>'5,5,5,5|40,40',
             'chco'=>'00FF00',
             'chbh'=>'r,.3',
             'chm'=>'N,0000FF,-1,,12',
        );
        $chd='t:';
        foreach ($chart['chd'] as $key => $values) {
            foreach ($values as $key => $val) {
                $chd.=$val.',';
            }
            $chd=rtrim($chd, ',').'|';
        }
        $chd=rtrim($chd, '|');
        $test->addData('chd', $chd);
        $test->addData('chxl', '0:|'.$chart['chxl']);
        $test->addData('chtt', $chart['chtt'].' ['.date('m/d/Y H:i', $this->timestamp).']');
        $test->addData('chxr', '1,0,'.$chdsMax.','.$chdsStep);

        $test1=new GoogleChartImage();
        $test1->data=array(
            'chs'=>'800x300',
             'chds'=>'0,'.$chdsMax,
             'chxt'=>'x,y',
             'chts'=>'000000,15',
             'cht'=>'bvs',
             'chdl'=>'出售',
             'chma'=>'5,5,5,5|40,40',
             'chco'=>'00FF00',
             'chbh'=>'r,.3',
             'chm'=>'N,0000FF,-1,,12',
        );
        $chd='t:';
        foreach ($chart1['chd'] as $key => $values) {
            foreach ($values as $key => $val) {
                $chd.=$val.',';
            }
            $chd=rtrim($chd, ',').'|';
        }
        $chd=rtrim($chd, '|');
        $test1->addData('chd', $chd);
        $test1->addData('chxl', '0:|'.$chart['chxl']);
        $test1->addData('chtt', $chart1['chtt'].' ['.date('m/d/Y H:i', $this->timestamp).']');
        $test1->addData('chxr', '1,0,'.$chdsMax.','.$chdsStep);
        $this->render('index',array(
                'charturl'=>$test->chart,
                'charturl2'=>$test1->chart,
        ));
    }
    /**
     * 经纪人注册分布图
     */
    public function actionDistribution(){
        $chart=array();
        $chart['chxl']='';
        $chart['chtt']='上海地区经纪人注册分布图';
        $this->breadcrumbs=array(
            '用户注册分布图（区）',
        );
        $this->menuAction=array(
            array('label'=>'用户每日登录', 'url'=>array('login')),
            array('label'=>'房源发布柱形图', 'url'=>array('release')),
            array('label'=>'用户注册分布（区）', 'url'=>array('distribution')),
            array('label'=>'用户注册', 'url'=>array('index')),
        );
        $regions=$this->db->createCommand('SELECT `re_id` AS id,`re_name` AS name FROM `35_region` WHERE `re_parent_id`=35 ORDER BY `re_order`')->queryAll();
        $temp=array();//上海
        foreach($regions as $r){  
            $temp[$r['id']]=0;
            $chart['chxl'].=$r['name'].'|';
        }
        $chart['chxl']=rtrim($chart['chxl'],'|');
        $chart['chd']['agent']=$temp;//经纪人
        $sql='SELECT `ua_district` AS k,COUNT(`ua_district`) AS sum FROM {{uagent}} WHERE `ua_city`=35 GROUP BY `ua_district`';
        $userRS=$this->db->createCommand($sql)->queryAll();
        foreach ($userRS as $rs) {
            $chart['chd']['agent'][$rs['k']]+=$rs['sum'];
        }
        $stepConfig=array('50'=>'10','100'=>'20','200'=>'30','400'=>'50');
        $chdsMax=20;
        $chdsStep=20;
        foreach($chart['chd']['agent'] as $v){
            if($chdsMax < $v)
                $chdsMax=$v;
        }
        foreach($stepConfig as $key=>$v){
            if($key > $chdsMax)
                break;
        }
        $chdsMax=ceil($chdsMax/$v)*$v;
        $chdsStep=floor($chdsMax/5);
        $test=new GoogleChartImage();
        $test->data=array(
            'chs'=>'800x300',
             'chds'=>'0,'.$chdsMax,
             'chxt'=>'x,y',
             'chts'=>'000000,15',
             'cht'=>'bvs',
             'chdl'=>'经纪人',
             'chma'=>'5,5,5,5|40,40',
             'chco'=>'00FF00',
             'chbh'=>'r,.60',
             'chm'=>'N,0000FF,-1,,12',
        );
        $chd='t:';
        foreach ($chart['chd'] as $values) {
            foreach ($values as $val) {
                $chd.=$val.',';
            }
            $chd=rtrim($chd, ',').'|';
        }
        $chd=rtrim($chd, '|');
        $test->addData('chd', $chd);
        $test->addData('chxl', '0:|'.$chart['chxl']);
        $test->addData('chtt', $chart['chtt'].' ['.date('m/d/Y H:i', $this->timestamp).']');
        $test->addData('chxr', '1,0,'.$chdsMax.','.$chdsStep);
        $this->render('index',array(
            'charturl'=>$test->chart,
        ));
    }
    /**
     * 用户登录
     */
    public function actionLogin(){
        $getUid=empty($_GET['id'])?0:(int)$_GET['id'];//单个用户登录情况
        if($getUid){
            $userStr=User::model()->getUserShowLink($getUid,false);
            $userWhere=" AND `ul_userid`='".$getUid."'";
            if($userStr)
                $userStr='-'.$userStr;
            else
                $userStr='[ID:'.$getUid.']';
        }else{
            $userStr=$userWhere='';
        }
        $chart=array();
        $chart1=array();
        $chart['chxl']='';
        $chart1['chxl']='';
        $startTime=0;
        $month=array();
        $month['self']=date('Ym',$this->timestamp).'01';
        if(empty($_GET['st'])){
            $chart['chtt']='最近30天用户登录次数柱形图';
            $chart1['chtt']='最近30天经纪人登录次数柱形图';
            $startTime=strtotime(date('Ymd',strtotime('-30 day', $this->timestamp)));
            $month['last']=date('Ym',strtotime('last month')).'01';
            $month['next']=date('Ym',strtotime('next month')).'01';
        }else{
            $startTime=strtotime($_GET['st']);
            $chart['chtt']=date('Y年m月',$startTime).'用户登录次数柱形图';
            $chart1['chtt']=date('Y年m月',$startTime).'经济人登录次数柱形图';
            $month['last']=date('Ym',strtotime('last month',$startTime)).'01';
            $month['next']=date('Ym',strtotime('next month',$startTime)).'01';
        }
        $endTime=strtotime($month['next']);
        if($endTime>$this->timeToday){
            $endTime=$this->timeToday+86400;
        }
        if($getUid){
            $this->breadcrumbs=array(
                '用户每日登录'=>array('login'),
                ''.$userStr,
             );
        }else{
            $this->breadcrumbs=array(
                '用户每日登录',
            );
        }
        $this->menu=array(
            array('label'=>'最近30天', 'url'=>array('login')),
            array('label'=>'本　月', 'url'=>array('login','st'=>$month['self'])),
            array('label'=>'上个月', 'url'=>array('login','st'=>$month['last'])),
        );
        $this->menuAction=array(
            array('label'=>'用户每日登录', 'url'=>array('login')),
            array('label'=>'房源发布柱形图', 'url'=>array('release')),
            array('label'=>'用户注册分布（区）', 'url'=>array('distribution')),
            array('label'=>'用户注册', 'url'=>array('index')),
        );

       
        if($month['next']<$month['self']){
            $this->menu[]=array('label'=>'下个月', 'url'=>array('login','st'=>$month['next']));
        }
        if($getUid){
            foreach($this->menu as $k=>$v)
                $this->menu[$k]['url']['id']=$getUid;
        }
        $timeMonth=strtotime(date('Ymd',strtotime('-30day', $this->timestamp)));
        $temp=array();
        $i=$startTime;
        while($i<$endTime){
            $key=date('Ymd',$i);
            $temp[$key]=0;
            $chart['chxl'].=date('d',$i).'|';
            $i+=86400;
        }
        $chart['chxl']=rtrim($chart['chxl'],'|');
        $chart['chd']['user']=$temp;
        $sql='SELECT`ul_date`as ymd FROM {{userloginlog}} WHERE `ul_timestamp`>'.$startTime.' AND `ul_timestamp`<'.$endTime.$userWhere.' AND  `ul_userid`='.$getUid.';';
        $userRS=$this->db->createCommand($sql)->queryAll();
         foreach ($userRS as $rs) {
                    $chart['chd']['user'][$rs['ymd']]++;
         }
         if(!$getUid){
                $chart['chd']['user']=$temp;//普通用户
                $chart1['chd']['uagent']=$temp;//经纪人
                $sql='SELECT`ul_date`as ymd FROM {{userloginlog}} WHERE `ul_timestamp`>'.$startTime.' AND `ul_timestamp`<'.$endTime.$userWhere.' AND `ul_role`=2;';
                $userRS=$this->db->createCommand($sql)->queryAll();
                foreach ($userRS as $rs) {
                        $chart1['chd']['uagent'][$rs['ymd']]++;
                }
                $sql='SELECT`ul_date`as ymd FROM {{userloginlog}} WHERE `ul_timestamp`>'.$startTime.' AND `ul_timestamp`<'.$endTime.$userWhere.' AND `ul_role`=1;';
                $userRS=$this->db->createCommand($sql)->queryAll();
                foreach ($userRS as $rs) {
                        $chart['chd']['user'][$rs['ymd']]++;
                }
           }
            $stepConfig=array('50'=>'10','100'=>'20','200'=>'30','400'=>'50');
            $chdsMax=20;
            $chdsStep=20;

            foreach($chart['chd']['user'] as $v){
                if($chdsMax < $v)
                    $chdsMax=$v;
            }
         if(!$getUid){
            foreach($chart1['chd']['uagent'] as $v){
                if($chdsMax < $v)
                    $chdsMax=$v;
            }
         }
            foreach($stepConfig as $key=>$v){
                if($key > $chdsMax)
                    break;
            }
            $chdsMax=ceil($chdsMax/$v)*$v;
            $chdsStep=floor($chdsMax/5);

            $test=new GoogleChartImage();
            $test->data=array(
                'chs'=>'800x300',
                 'chds'=>'0,'.$chdsMax,
                 'chxt'=>'x,y',
                 'chts'=>'000000,15',
                 'cht'=>'bvs',
                 'chdl'=>'用户'.$userStr,
                 'chma'=>'5,5,5,5|40,40',
                 'chco'=>'00FF00',
                 'chbh'=>'r,.60',
                 'chm'=>'N,0000FF,-1,,12',
             );
        if(!$getUid){
            $test->data=array(
                'chs'=>'800x300',
                 'chds'=>'0,'.$chdsMax,
                 'chxt'=>'x,y',
                 'chts'=>'000000,15',
                 'cht'=>'bvs',
                 'chdl'=>'普通用户',
                 'chma'=>'5,5,5,5|40,40',
                 'chco'=>'00FF00',
                 'chbh'=>'r,.3',
                 'chm'=>'N,0000FF,-1,,12',
             );
            $test1=new GoogleChartImage();
            $test1->data=array(
                'chs'=>'800x300',
                 'chds'=>'0,'.$chdsMax,
                 'chxt'=>'x,y',
                 'chts'=>'000000,15',
                 'cht'=>'bvs',
                 'chdl'=>'经纪人',
                 'chma'=>'5,5,5,5|40,40',
                 'chco'=>'00FF00',
                 'chbh'=>'r,.3',
                 'chm'=>'N,0000FF,-1,,12',

            );
        }
            $chd='t:';
            foreach ($chart['chd'] as $values) {
                foreach ($values as $val) {
                    $chd.=$val.',';
                }
                $chd=rtrim($chd, ',').'|';
            }

            $chd=rtrim($chd, '|');

            $test->addData('chd', $chd);
            $test->addData('chxl', '0:|'.$chart['chxl']);
            $test->addData('chtt', $chart['chtt'].' ['.date('m/d/Y H:i', $this->timestamp).']');
            $test->addData('chxr', '1,0,'.$chdsMax.','.$chdsStep);
        if(!$getUid){
            $chd='t:';
            foreach ($chart1['chd'] as $values) {
                foreach ($values as $val) {
                    $chd.=$val.',';
                }
                $chd=rtrim($chd, ',').'|';
            }

            $chd=rtrim($chd, '|');
            $test1->addData('chd', $chd);
            $test1->addData('chxl', '0:|'.$chart['chxl']);
            $test1->addData('chtt', $chart1['chtt'].' ['.date('m/d/Y H:i', $this->timestamp).']');
            $test1->addData('chxr', '1,0,'.$chdsMax.','.$chdsStep);

            $this->render('index',array(
                    'charturl'=>$test->chart,
                    'charturl2'=>$test1->chart,
            ));
         }else{
             $this->render('index',array(
                    'charturl'=>$test->chart,
                  
            ));
         }

    }
   
}
