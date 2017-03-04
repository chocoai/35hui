<?php
/*
 * sNews Version:	1.7.1
 * Copyright (C)
 * Licence:		sNews is licensed under a Creative Commons License.
 * 基于 sNews Version:1.7.1 二次开发
 * 升级snews请注释/修改 snews 同名方法
 * 新增楼盘字典分类
 */
define('API_DIBIAO', 'http://www.test360dibiao.com/');
define('PIC_URL', 'http://35upload.test360dibiao.com');
define('SH_BUSINESS_TEL', '400-820-8077');//业务电话
//define('API_DIBIAO', 'http://www.360dibiao.com/');
//define('PIC_URL', 'http://35upload.360dibiao.com');
// DISPLAY PAGES
function pages() {
	global $categorySEF,$_No3;
	$qwr = !_ADMIN ? ' AND visible=\'YES\'' : '';
	$class = empty($categorySEF) ? ' class="current"' : '';
	echo '<li><a'.$class.' href="'._SITE.'">'.l('home').'</a></li>';
	$class = ($categorySEF == 'news') ? ' class="current"' : '';
	echo '<li><a'.$class.' href="'._SITE.'news/">公司新闻</a></li>';
	$query = "SELECT id, seftitle, title FROM "._PRE.'articles'." WHERE position = 3 $qwr ORDER BY artorder ASC, id";
	$result = mysql_query($query);
	$num = mysql_num_rows($result);
	while ($r = mysql_fetch_array($result)) {
		$title = $r['title'];
		$class = ($categorySEF == $r['seftitle'])? ' class="current"' : '';
		if ($r['id'] != s('display_page')) {
			echo '<li><a'.$class.' href="'._SITE.$r['seftitle'].'/">'.$title.'</a></li>';
		}
	}
    $class = ($categorySEF == 'building') ? ' class="current"': '';
	echo '<li id="nav_building"><a'.$class.' href="'._SITE.'building/">'.l('building').'</a>
				<div class="tc" style="display:none">
					<p><a href="'._SITE.'building/office/">写字楼</a></p>
					<p><a class="drop" href="'._SITE.'building/creative_park/">创意园区</a></p>
                    <p><a class="drop" href="'._SITE.'building/business_center/">商务中心</a></p>
                </div></li>';
    $class = ($categorySEF == 'case') ? ' class="current"': '';
	echo '<li><a'.$class.' href="#">成功案例</a>
                <div class="tc" style="display:none">
					<p><a href="'._SITE.'case/proxy/">营销代理</a></p>
					<p><a class="drop" href="'._SITE.'case/customer/">成交项目</a></p>
                </div></li>';
	$class = ($categorySEF == 'contact') ? ' class="current"': '';
	echo '<li><a'.$class.' href="'._SITE.'contact/">'.l('contact').'</a></li>';
	$class = ($categorySEF == 'sitemap') ? ' class="current"': '';
	echo '<li><a'.$class.' href="'._SITE.'sitemap/">'.l('sitemap').'</a></li>';
	if ($num) $_No3 = true;
}
// PAGINATOR
function paginator($pageNum, $maxPage, $pagePrefix) {
	global $categorySEF,$subcatSEF, $articleSEF,$_ID, $_catID,$_POS, $_XNAME;
	switch (true){
		case !$_ID && !$_catID :
			$uri ='';
			break;
		case $_ID && $_XNAME :
			$uri = $categorySEF.'/'.$subcatSEF.'/'.$articleSEF.'/';
			break;
		case $_POS == 1 || $_XNAME :
			$uri = $categorySEF.'/'.$subcatSEF.'/';
			break;
		default :
			$uri = $categorySEF.'/';
	}
    if($categorySEF=='building'){
        if(!empty($articleSEF)) {
            $articleSEF = preg_replace('/-?p_\d+/','',$articleSEF);
            if($articleSEF) $pagePrefix = '-'.$pagePrefix;
        }
        $uri = $categorySEF.'/'.$subcatSEF.'/'.$articleSEF;
    }

	$link = '<a href="'._SITE.$uri ;
	$prefix = !empty($pagePrefix) ? $pagePrefix : '';
	if ($pageNum > 1) {
		$goTo =  $link;
		$prev = (($pageNum-1)==1 ? $goTo :
			$link.$prefix.($pageNum - 1).'/').'" title="'.l('page').' '.($pageNum - 1).'">'.l('previous_page').'</a> ';
		$first = $goTo.'" title="'.l('first_page').' '.l('page').'">'.l('first_page').'</a>';
    } else {
		$prev = l('previous_page');
		$first = l('first_page');
	}
	if ($pageNum < $maxPage) {
		$next = $link.$prefix.($pageNum + 1).'/" title="'.l('page').' '.($pageNum + 1).'">
			'.l('next_page').'</a> ';
		$last = $link.$prefix.$maxPage.'/" title="'.l('last_page').' '.l('page').'">
			'.l('last_page').'</a> ';
	} else {
		$next = l('next_page');
		$last = l('last_page');
	}
	echo '
		<div class="paginator">
			'.$first.' '.$prev.'
			<strong>['.$pageNum.'</strong> / <strong>'.$maxPage.']</strong>
			'.$next.' '.$last.'
		</div>';
}
// CENTER
function center() {
	// fatal session produced on failed login, and will display error message.
 	if (isset($_SESSION[_SITE.'fatal'])) {
		echo $_SESSION[_SITE.'fatal'];
		unset($_SESSION[_SITE.'fatal']);
	} else {
		global $categorySEF, $subcatSEF, $articleSEF;
		switch(true) {
			case isset($_GET['category']):
			    $action = $categorySEF;
			break;
			case isset($_GET['action']): // Patch #7 - 1.7.0
			    $action = $categorySEF == '404' ? $categorySEF : clean(cleanXSS($_GET['action']));
			break;
		}
		switch(true) {
			case isset($_POST['search_query']):
				search(); return; break;
			case isset($_POST['comment']):
				comment('comment_posted'); return; break;
			case isset($_POST['contactform']):
				contact(); return; break;
			case isset($_POST['Loginform']):
				administration(); return; break;
			case isset($_POST['submit_text']):
				processing(); return; break;
		}
		if (_ADMIN) {
	 		switch ($action) {
				case 'administration':
					administration(); return; break;
				case 'snews_settings':
					settings(); return; break;
				case 'snews_categories':
					admin_categories(); return; break;
				case 'admin_category':
					form_categories(); return; break;
				case 'admin_subcategory':
					form_categories('sub'); return; break;
				case 'groupings':
					admin_groupings(); return; break;
				case 'admin_groupings':
					form_groupings(); return; break;
				case 'snews_articles':
					admin_articles('article_view'); return; break;
				case 'extra_contents':
					admin_articles('extra_view'); return; break;
				case 'snews_pages':
					admin_articles('page_view'); return; break;
				case 'admin_article':
					form_articles(''); return; break;
				case 'article_new':
					form_articles('article_new'); return; break;
				case 'extra_new':
					form_articles('extra_new'); return; break;
				case 'page_new':
					form_articles('page_new'); return; break;
				case 'editcomment':
					edit_comment(); return; break;
				case 'snews_files':
					files(); return; break;
				case 'process':
					processing(); return; break;
				case 'logout':
					session_destroy();
					echo '<meta http-equiv="refresh" content="2; url='._SITE.'">';
					echo '<h2>'.l('log_out').'</h2>';
					return; break;
			}
		}
		switch ($action) {
			case 'archive':
				archive(); break;
			case 'sitemap':
				sitemap(); break;
            case 'building':
                building(); break;
			case 'contact':
				contact(); break;
			case 'login':
				login(); break;
			case '404':
			        echo '<p class="warning">'.l('error_404').'</p>'; // Patch #404 - 1.7.1 - message string revised.
			        sitemap(); break; // Patch #404 - 1.7.1 - show sitemap with message.
			default:
				articles(); break;
		}
	}
}

/* =============================== 楼盘字典 ============================== */
global $searchOpts;
$searchOpts = array(
    'price' => array(
        '11'=>array('2以下',array(0,2)),
        '12'=>array('2-4',array(2,4)),
        '13'=>array('4-6',array(4,6)),
        '14'=>array('6-8',array(6,8)),
        '15'=>array('8-10',array(8,10)),
        '16'=>array('10以上',array(10,0)),
    ),
    'sale'  => array(
        '41'=>array('10000以下',array(0,10000)),
        '42'=>array('10000-15000',array(10000,15000)),
        '43'=>array('15000-20000',array(15000,20000)),
        '44'=>array('20000-30000',array(20000,30000)),
        '45'=>array('30000以上',array(30000,0)),
    ),
);

// 楼盘字典
function building(){
    global $categorySEF, $subcatSEF, $articleSEF,$searchOpts;
    $subcatSEF = strtolower($subcatSEF);
    if(empty($subcatSEF) || !in_array($subcatSEF,array('office','creative_park','business_center')))
            $subcatSEF = 'office';
    if(!empty($articleSEF) && preg_match('/^\d+$/', $articleSEF)){//视为查看
        buildingView();
        return;
    }
    $searchParams = resolveSearch(trim($articleSEF));
    if(isset($searchParams['page'])){
        $_page = $searchParams['page'][0];
        unset($searchParams['page']);
    }else
        $_page='';
    
    $uri = $categorySEF.'/'.$subcatSEF.'/';
?>
<div class="search">
    <div class="sctit">
        <input type="text" value="<?php echo isset($searchParams['q'][0])?$searchParams['q'][0]:l('building_keywords') ?>" onblur="if(this.value=='<?php echo l('building_keywords') ?>' || this.value==''){this.value = '<?php echo l('building_keywords') ?>'}" onfocus="if(this.value=='<?php echo l('building_keywords') ?>'){this.value = ''}" name="kwords" id="params_q" class="txt_1 ac_input" />
        <input type="submit" value="搜索" onclick="return searchGo('q');" class="btn_1" />
    </div>
    <div id="yw0" class="portlet">
<div class="portlet-content">
<div class="scclick"><em>搜房条件:</em>
<?php
displaySearchParams($uri,$searchParams);
?>
        <a href="<?php echo $uri; ?>" style="background:none; border:none;line-height:20px;">清空条件</a>
</div>

</div>
</div><div id="yw1" class="portlet">
<div class="portlet-content">
    <?php 
    regionSearchOpt($uri,$searchParams);
    priceSearchOpt($uri,$searchParams);
    if($subcatSEF == 'office') saleSearchOpt($uri,$searchParams);
    ?>
</div>
</div></div>
<?php
    buildingList($searchParams,$subcatSEF,$_page);
}
// 查看页面
function buildingView(){
    global $categorySEF, $subcatSEF, $articleSEF;
    $url = API_DIBIAO.'api/search/buildingone?sub='.$subcatSEF.'&id='.$articleSEF;
    $ex = httpRequest($url);
    if($ex===false){
        echo '<p class="warning">'.l('error_404').'</p>';
		sitemap(); return 0;
    }
    //echo $ex;return;
    $data = json_decode($ex);
    $view = 'view/'.strtolower($subcatSEF).'.php';
    if($data->count && file_exists($view))
        require $view;
}
// 楼盘列表
function buildingList($searchParams,$subcat,$page){
    global $searchOpts;
    if($page < 1) $page = 1;
    $params = array();
    if(isset($searchParams['price'])){
        $searchParams['pricea'] = array($searchOpts['price'][$searchParams['price'][0]][1][0]);
        $searchParams['priceb'] = array($searchOpts['price'][$searchParams['price'][0]][1][1]);
        unset($searchParams['price']);
    }
    if(isset($searchParams['sale'])){
        $searchParams['salea'] = array($searchOpts['sale'][$searchParams['sale'][0]][1][0]);
        $searchParams['saleb'] = array($searchOpts['sale'][$searchParams['sale'][0]][1][1]);
        unset($searchParams['sale']);
    }
    foreach ($searchParams as $k => $v) {
        $params[] = $k.'='.$v[0];
    }
    if($page)
        $params[] = 'page='.$page;
    $get = implode('&', $params);
    $url = API_DIBIAO.'api/search/'.$subcat;
    if($get)
        $url.='?'.$get;
    $ex = httpRequest($url);
    if($ex === false){
        echo '<p class="warning">系统正忙，请稍后再试!</p>';
    }else{
        $data = (array)json_decode($ex);
        if($subcat == 'office') 
            echoOfficeList($data['data']);
        elseif($subcat == 'creative_park')
            echoCreativeList($data['data']);
        else
            echoBusinessList($data['data']);
        if($data['maxPage']>1) paginator($page, $data['maxPage'], 'p_');
    }
}

function fImage($src,$f){
    if(($pos=strripos($src, '.')) !== false){
        return substr($src,0,$pos).$f.substr($src,$pos);
    }
    return $src;
}
//商务中心列表
function echoBusinessList($data){
    global $categorySEF, $subcatSEF;
    $uri = $categorySEF.'/'.$subcatSEF.'/';
    $reg = getRegions();
    foreach($data as $d){
    ?>
<div class="schcont">
    <div class="schdes">
        <div class="schpic"><a target="_blank" href="<?php echo $uri.$d->id ?>"><img alt="<?php echo $d->name ?>" src="<?php
        if($d->p_img){
            $d->p_img;
            echo 'http://35upload.360dibiao.com'.fImage($d->p_img,'_large');
        }else{
            echo 'http://www.360dibiao.com/images/default/build_default.jpg';
        } ?>"></a></div>
		<div class="schtxt">
			<h2><a target="_blank" href="<?php echo $uri.$d->id ?>"><?php echo $d->name ?></a></h2>
			<p>[<?php echo $reg[$d->d] ?>]&nbsp;&nbsp;&nbsp;<?php echo $d->address ?></p>
			<p><span class="scht_2">改建年代：<?php echo $d->open?date('Y-m-d',$d->open):'暂无资料' ?></span></p>
			<p><span class="scht_2">服务商品牌：<?php echo $d->ptname?$d->ptname:'暂无资料' ?></span></p>
            <p>置业咨询：<?php echo SH_BUSINESS_TEL ?></p>
		</div>
		<div class="schpk">
			<div class="pkt">
                    <?php echo $d->price?'<em>'.$d->price.'</em>元/月/工位':'暂无资料' ?><br>
            </div>
		</div>
	</div>
</div>
<?php }
}

//创意园区列表
function echoCreativeList($data){
    global $categorySEF, $subcatSEF;
    $uri = $categorySEF.'/'.$subcatSEF.'/';
    $reg = getRegions();
    $ext = getDataElement($data, 'id', 'creativeext');
    foreach($data as $d){
    ?>
<div class="schcont">
    <div class="schdes">
        <div class="schpic"><a target="_blank" href="<?php echo $uri.$d->id ?>"><img alt="<?php echo $d->name ?>" src="<?php
        if($d->p_img){
            $d->p_img;
            echo 'http://35upload.360dibiao.com'.fImage($d->p_img,'_normal');
        }else{
            echo 'http://www.360dibiao.com/images/default/build_default.jpg';
        } ?>"></a></div>
		<div class="schtxt">
			<h2><a target="_blank" href="<?php echo $uri.$d->id ?>"><?php echo $d->name ?></a></h2>
			<p>[<?php echo $reg[$d->d] ?>]&nbsp;&nbsp;&nbsp;<?php echo $d->address ?></p>
			<p><span class="scht_1">得房率：<?php echo $d->lv?$d->lv.'%':'暂无资料' ?></span><span class="scht_2">改建年代：<?php echo $d->open?date('Y-m-d',$d->open):'暂无资料' ?></span></p>
			<p><span class="scht_1">物业费：<?php echo $d->ptprice?$d->ptprice.'元/平米/月':'暂无资料' ?></span><span class="scht_2">管理公司：<?php echo $d->ptname?$d->ptname:'暂无资料' ?></span></p>
			<p>空置面积：<?php echo $ext[$d->id]; echo _ADMIN?' <a href="javascript:;" onclick="updateEmpty('.$d->id.',2)">修改</a>':'' ?></p>
            <p>置业咨询：<?php echo SH_BUSINESS_TEL ?></p>
		</div>
		<div class="schpk">
			<div class="pkt">
                    <?php echo $d->price?'<em>'.$d->price.'</em>元/平米/天':'暂无资料' ?><br>
            </div>
		</div>
	</div>
</div>
<?php }
}
//得到扩展字段
function getDataElement(&$data,$element,$table,$default='暂无资料'){
    $eles = array();
    foreach($data as $d)
        $eles[$d->$element] = $default;
    if(empty($eles)) return array();
    $ids = implode(',', array_keys($eles));//_PRE.
    $sql = 'SELECT id,emptyarea FROM `'._PRE.$table.'` WHERE id in('.$ids.');';
    $R = mysql_query($sql);
    if ($R) {
        while ($row = mysql_fetch_array($R, MYSQL_ASSOC))
            $eles[$row['id']] = $row['emptyarea'];
    }
    return $eles;
}

// 写字楼列表
function echoOfficeList($data){
    global $categorySEF, $subcatSEF;
    $uri = $categorySEF.'/'.$subcatSEF.'/';
    $reg = getRegions();
    $ext = getDataElement($data, 'id', 'officeext');
    foreach($data as $d){
    ?>
<div class="schcont">
    <div style=" height: 170px;" class="schdes">
        <div class="schpic"><a target="_blank" href="<?php echo $uri.$d->id ?>"><img alt="<?php echo $d->name ?>" src="<?php
        if($d->p_img){
            $d->p_img;
            echo 'http://35upload.360dibiao.com'.fImage($d->p_img,'_normal');
        }else{
            echo 'http://www.360dibiao.com/images/default/build_default.jpg';
        } ?>"></a></div>
		<div class="schtxt">
			<h2><a target="_blank" href="<?php echo $uri.$d->id ?>"><?php echo $d->name ?></a></h2>
			<p>[<?php echo $reg[$d->d] ?>]&nbsp;&nbsp;&nbsp;<?php echo $d->address ?></p>
			<p><span class="scht_1">得房率：<?php echo $d->lv?$d->lv.'%':'暂无资料' ?></span><span class="scht_2">竣工时间：<?php echo $d->open?date('Y-m-d',$d->open):'暂无资料' ?></span></p>
			<p><span class="scht_1">物业费：<?php echo $d->ptprice?$d->ptprice.'元/平米/月':'暂无资料' ?></span><span class="scht_2">管理公司：<?php echo $d->ptname?$d->ptname:'暂无资料' ?></span></p>
			<p>空置面积：<?php echo $ext[$d->id]; echo _ADMIN?' <a href="javascript:;" onclick="updateEmpty('.$d->id.',1)">修改</a>':'' ?></p>
            <p>置业咨询：<?php echo SH_BUSINESS_TEL ?></p>
		</div>
        <div class="schpk">
			<div class="pkt">
                    <?php echo $d->price?'参考租金： <em>'.$d->price.'</em>元/平米/天':'暂无资料' ?><br>
                    <?php echo $d->sale?'参考售价： <em>'.$d->sale.'</em>元/平米':'暂无售价' ?>
            </div>
		</div>
	</div>
</div>
<?php }
}

// 区域
$l['file_cache_time'] = 86400;
function getRegions($city=35){
    static $regtions=array();
    if(isset($regtions[$city])) return $regtions[$city];
    $cacheFile = 'cache/regions_'.$city.'.php';
    if(!file_exists($cacheFile) || filemtime($cacheFile)+l('file_cache_time') < time()){
        $url = API_DIBIAO.'api/search/region?city='.$city;
        $ex = httpRequest($url);
        if($ex !== false){
            @ unlink($cacheFile);
            $regtions[$city] = (array)json_decode($ex);
            file_put_contents($cacheFile, '<?php return '.var_export($regtions[$city], true).';');
        }
    }else{
        $regtions[$city] = require $cacheFile;
    }
    return $regtions[$city];
}
/* =============================== Functions ============================== */
// 显示模板显示
function dTemplates(){
    echo '<label for="template">'.l('template').':</label> ';
    echo '<select onchange="loadTemplate(this.value);" id="template">
        <option value="">=请选择=</option>
        <option value="proxy">营销代理</option>
        <option value="customer">成交项目</option>
        </select>';
}
// 请求数据
function httpRequest($url,$timeout=30){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,CURLOPT_TIMEOUT,$timeout);
    $ex = curl_exec($ch);
    curl_close($ch);
    return $ex;
}
// 解析查询
function resolveSearch($querystr){
    $q = array();
    if($querystr){
        foreach(explode('-', $querystr) as $param){
            if(preg_match ("/^q/i", $param))
                $q['q'] = array(substr($param, 1),$param);
            elseif(preg_match ("/^district\d+/i", $param))
                $q['district'] = array(substr($param, 8),$param);
            elseif(preg_match ("/^price\d+/i", $param))
                $q['price'] = array(substr($param, 5),$param);
            elseif(preg_match ("/^sale\d+/i", $param))
                $q['sale'] = array(substr($param, 4),$param);
            elseif(preg_match ("/^price[ab]\d+/i", $param))
                $q[substr($param, 0, 6)] = array(substr($param, 6),$param);
            elseif(preg_match ("/^sale[ab]\d+/i", $param))
                $q[substr($param, 0, 5)] = array(substr($param, 5),$param);
            elseif(preg_match ("/^p_\d+/i", $param))//分页
                $q['page'] = array(substr($param, 2),$param);
        }
        if(isset($q['pricea']) && isset($q['priceb']) && $q['pricea'][0] > $q['priceb'][0] ){
            $temp = $q['pricea'];
            $q['pricea'] = $q['priceb'];
            $q['priceb'] = $temp;
        }
        if(isset($q['salea']) && isset($q['saleb']) && $q['salea'][0] > $q['saleb'][0] ){
            $temp = $q['salea'];
            $q['salea'] = $q['saleb'];
            $q['saleb'] = $temp;
        }
    }
    return $q;
}
// 显示搜索条件
function displaySearchParams($uri,$searchParams){
    global $searchOpts;
    $_t1 = $_t2 = array();
    foreach($searchParams as $k=>$v)
        $_t1[$k] = $v[1];

    if(isset($searchParams['district'])){
        $_t2 = $_t1;unset($_t2['district']);
        $r = getRegions();
        echo '<a href="'.$uri.(implode('-', $_t2)).'" class="close_clear">'.$r[$searchParams['district'][0]].'</a>';
    }

    $pricea = isset($searchParams['pricea'])?$searchParams['pricea'][0]:0;
    $priceb = isset($searchParams['priceb'])?$searchParams['priceb'][0]:0;
    if(isset($searchParams['price'])){
        $pricea = $searchOpts['price'][$searchParams['price'][0]][1][0];
        $priceb = $searchOpts['price'][$searchParams['price'][0]][1][1];
    }
    if($pricea || $priceb){
        $_t2 = $_t1;
        unset($_t2['price'],$_t2['pricea'],$_t2['priceb']);
        if($pricea && $priceb)
            $_dis = $pricea.'-'.$priceb;
        else
            $_dis = ($pricea+$priceb).($pricea?'以上':'以下');
        echo '<a href="'.$uri.(implode('-', $_t2)).'" class="close_clear">'.$_dis.'</a>';
    }

    $salea = isset($searchParams['salea'])?$searchParams['salea'][0]:0;
    $saleb = isset($searchParams['saleb'])?$searchParams['saleb'][0]:0;
    if(isset($searchParams['sale'])){
        $salea = $searchOpts['sale'][$searchParams['sale'][0]][1][0];
        $saleb = $searchOpts['sale'][$searchParams['sale'][0]][1][1];
    }
    if($salea || $saleb){
        $_t2 = $_t1;
        unset($_t2['sale'],$_t2['salea'],$_t2['saleb']);
        if($salea && $saleb)
            $_dis = $salea.'-'.$saleb;
        else
            $_dis = ($salea+$saleb).($salea?'以上':'以下');
        echo '<a href="'.$uri.(implode('-', $_t2)).'" class="close_clear">'.$_dis.'</a>';
    }

    $_t2 = $_t1;unset($_t2['q']);
    if(isset($searchParams['q'])){
        echo '<a href="'.$uri.(implode('-', $_t2)).'" class="close_clear">'.$searchParams['q'][0].'</a>';
    }
    echo '<a id="search_noq" href="'.$uri.(implode('-', $_t2)).'" style="display:none">none</a>';

}

// 区域搜索
function regionSearchOpt($uri,$params){
?>
<div class="srline">
    <em>区域：</em>
<?php
    $uri = rtrim($uri,'/').'/';
    $cur = 0;
    foreach($params as $k=>$v){
        if($k=='district'){ $cur = $v[0]; continue;}
        $uri .= $v[1].'-';
    }
    echo '<a href="'.rtrim($uri,'-').'"'.(empty($params['district'])?' class="srclk"':'').'>不限</a>';
    foreach(getRegions() as $k=>$v)
        echo '<a href="'.($uri.'district'.$k).'"'.($cur==$k?' class="srclk"':'').'>'.$v.'</a>';

?>
</div>
<?php
}

// 租金搜索
function priceSearchOpt($uri,$params){
    global $searchOpts;
?>
<div class="srline">
    <em>租金：</em>
<?php
    $uri = rtrim($uri,'/').'/';
    $cur = 0;
    foreach($params as $k=>$v){
        if(in_array($k,array('price','pricea','priceb'))){ $cur = $v[0]; continue;}
        $uri .= $v[1].'-';
    }
    echo '<a id="search_noprice" href="'.rtrim($uri,'-').'"'.(empty($params['price'])?' class="srclk"':'').'>不限</a>';
    foreach($searchOpts['price'] as $k=>$v)
        echo '<a href="'.($uri.'price'.$k).'"'.($cur==$k?' class="srclk"':'').'>'.$v[0].'</a>';

?>
    <input id="params_pricea" size="6" type="text" name="pricea" class="txt_2" value="<?php echo !empty($params['pricea'])?$params['pricea'][0]:'' ?>"><span class="heng">-</span>
        <input  id="params_priceb" size="6" type="text" name="priceb" class="txt_2" value="<?php echo !empty($params['priceb'])?$params['priceb'][0]:'' ?>"><font class="heng">平均租金(元/平米·天)</font>
        <input type="button" style="float:left;" value="确定"  onclick="return searchGo('price');">
</div>
<?php
}

// 售价搜索
function saleSearchOpt($uri,$params){
    global $searchOpts;
?>
<div class="srline">
    <em>售价：</em>
<?php
    $uri = rtrim($uri,'/').'/';
    $cur = 0;
    foreach($params as $k=>$v){
        if(in_array($k,array('sale','salea','saleb'))){ $cur = $v[0]; continue;}
        $uri .= $v[1].'-';
    }
    echo '<a id="search_nosale" href="'.rtrim($uri,'-').'"'.(empty($params['sale'])?' class="srclk"':'').'>不限</a>';
    foreach($searchOpts['sale'] as $k=>$v)
        echo '<a href="'.($uri.'sale'.$k).'"'.($cur==$k?' class="srclk"':'').'>'.$v[0].'</a>';

?>
    <input id="params_salea" size="6" type="text" name="salea" class="txt_2" value="<?php echo !empty($params['salea'])?$params['salea'][0]:'' ?>"><span class="heng">-</span>
        <input id="params_saleb" size="6" type="text" name="saleb" class="txt_2" value="<?php echo !empty($params['saleb'])?$params['saleb'][0]:'' ?>"><font class="heng">平均售价(元/平米)</font>
        <input type="button" style="float:left;" value="确定" onclick="return searchGo('sale');">
</div>
<?php
}

//展示图片
function showImageFlash($dir='flash'){
    $dir = rtrim($dir, '\\/').'/';
    if (!is_dir($dir)) return;
    echo '<div id="slider"><ul>';
    if (($dh=opendir($dir))) {
        while (($file = readdir($dh)) !== false) {
            if($file==='.' || $file==='..') continue;
            if(preg_match('/\.(jpg|gif|jpeg)$/i', $file))
            echo "<li><a href=\"#\"><img src=\"".$dir.$file."\" alt=\"\" /></a></li>\n";
        }
        closedir($dh);
    }

    echo '</ul></div>';
}
//添加钩子(需要确认文章已经插入数据库)
function addArticleHook(){
    $basedir = 'caseimg/';
    if(isset($_POST['add_article'])){
        $result=mysql_query('select last_insert_id()');
        $rs = mysql_fetch_array( $result );
        if($rs){
            $last_id=$rs[0];
            !is_dir($basedir.$last_id) && mkdir($basedir.$last_id);
        }
    }
}
function dispalyCaseImgs($aid){
    if(!$aid) return;
    $dir = 'caseimg/'.$aid.'/';
    if (!is_dir($dir)) return;
    $imgs = array();
    if (($dh=opendir($dir))) {
        while (($file = readdir($dh)) !== false) {
            if($file==='.' || $file==='..') continue;
            if(preg_match('/\.(jpg|gif|jpeg)$/i', $file))
                $imgs[]=$dir.$file;
        }
        closedir($dh);
    }
    if($imgs){ 
?>
<div class="bpic"><img src="<?php echo $imgs[0] ?>" alt="" height="215" width="400" /></div>
<div class="psic">
    <?php
    $i = 0;
    foreach($imgs as $img){
        $i++;
        ?>
    <div class="ppic<?php if($i==1) echo ' bg' ?>"><img src="<?php echo $img ?>" alt="" height="52" width="69" /></div>
    <?php
    if($i==5) break;
    } ?>
</div>
<?php }
}
class CHtml
{
    public static function encode($text)
	{
		return htmlspecialchars($text,ENT_QUOTES);
	}
}