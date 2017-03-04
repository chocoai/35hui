<?php
/*------------------------------
   sNews 1.7.1 - Template file
--------------------------------*/
// Include all system function files here
include('snews.php');
//--------------------------------------------
include('site_snews.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<?php title(); ?>
	<meta name="robots" content="index,follow" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/css.css" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
                    $("#top ul li").bind("mouseenter",function(){
                    var obj = $(this).children(".tc");
                    if($(obj).length){
                        $(obj).css("display","");
                    }
                     }).bind("mouseleave",function(){
                      var obj = $(this).children(".tc");
                      if($(obj).length){
                        $(obj).css("display","none");
                    }
                 });
<?php if($subcatSEF=='proxy'){ ?>
                $("div.ppic img").bind("click",function(){
                    var obj = $(this).parent();
                    obj.parent().prev().find('img').attr('src',this.src);
                    obj.siblings().removeClass('bg');
                    obj.addClass('bg');

                });
<?php } ?>
            });
        </script>
<?php
if(empty($categorySEF)){
?>
        <script type="text/javascript" src="js/easySlider1.7.js"></script>
        <script type="text/javascript">
            $(function(){
     $("#slider").easySlider({
                        auto: true,
                        continuous: true,
                        numeric: true,
                        pause: 3000
                    });    });
    </script>
        
<?php }
if(!empty($categorySEF) && $categorySEF=='building' && !empty($articleSEF) && preg_match('/^\d+$/', $articleSEF)){
?>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=1.2"></script>
<?php } ?>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="logo"><img src="images/logo.gif"/></div>
		<div id="top">
			<ul><?php pages(); ?></ul>
		</div>
	</div>
    <!--<div><img src="images/neibanner.jpg"/></div>-->
    <?php if(empty($categorySEF) && !isset($_GET['action'])){ showImageFlash(); ?>
    <div class="clear" style="height: 20px;"></div>
	<div class="wh-cont">
		<div class="whcont">
			<h6>企业文化</h6>
			<p>我的企业文化是</p>
			<p>我的企业文化是</p>
			<p>我的企业文化是</p>
		</div>
		<div class="whcont">
			<h6>服务理念</h6>
			<p>我们的服务理念是：</p>
			<p>我们的服务理念是：</p>
			<p>我们的服务理念是：</p>
		</div>
		<div class="whcont" style="background:none;">
			<h6>人才观念</h6>
			<p>我们的人才观念：</p>
			<p>我们的人才观念：</p>
			<p>我们的人才观念：</p>
		</div>
	</div>
    <?php } ?>
    <div id="crumbs" style="display:none;"><h1><?php if(!empty($subcatSEF)){
        switch ($subcatSEF){
            case 'office':
                echo '写字楼';
                break;
            case 'creative_park':
                echo '创意园区';
                break;
            case 'business_center':
                echo '商务中心';
                break;
            case 'proxy':
                echo '代理成交案例';
                break;
            case 'customer':
                echo '项目成交案例';
                break;
        }
    } ?></h1></div>
	<div id="content">
        <div id="<?php echo $categorySEF!='building'?(empty($categorySEF)?'main2':'main'):'fmain' ?>">
			<?php center(); ?>
		</div>
<?php if(empty($categorySEF)){
?>
        <div id="side2">
            <h3 style="color: #1C5334; font-weight: bold; font-size: 18px;font-family: 'Microsoft YaHei'; ">成功案例</h3>
<?php
    $query = 'SELECT
			text
            FROM '._PRE.'articles
		WHERE position = 1
			AND category = 5
			AND visible = \'YES\'
		ORDER BY date DESC
			LIMIT 4';
        $result = mysql_query($query);
		$count = mysql_num_rows($result);
		if ( $count === 0) {
			echo '<li>'.l('no_articles').'</li>';
		} else {
			while ($r = mysql_fetch_array($result)) {
				echo $r['text'];
            }
        }
?>
        </div>
    <?php }elseif($categorySEF=='case'){ ?>
        <div id="side">
		 	<div class="right_anpic"><img src="images/management.gif"/></div>
			<div class="right_antxt">
				<p><a href="<?php echo _SITE?>case/proxy/">营销代理</a></p>
                <p><a href="<?php echo _SITE?>case/customer/">成交项目</a></p>
			</div>
		</div>
    <?php }elseif($categorySEF!='building') { ?>
        <div id="side">
			<div class="single">
				<h3><img src="images/title.gif"/></h3>
				<ul><?php menu_articles(0,3); ?></ul>
				<h3><img src="images/management.gif"/></h3>
				<ul>
                    <li><a href="<?php echo _SITE?>case/proxy/">营销代理</a></li>
                    <li><a href="<?php echo _SITE?>case/customer/">成交项目</a></li>
                </ul>
			</div>
            <div class="ggpic"><img src="images/201216160136.gif"/></div>
		</div>
        
    <?php } ?>
	</div>
	<div id="footer"><?php addArticleHook(); ?>
        <div class="f_left">版权所有：&copy;<?php echo date('Y'),' ',s('website_title'); ?></div>
        <div class="f_right"><?php login_link(); ?></div>
	</div>
</div>
<?php
if($categorySEF == 'building'){
?>
    <script type="text/javascript">
        function searchGo(param){
            var uri,params=[];
            switch (param){
                case 'q':
                    var val=trim(ID('params_q').value);
                    if(val=="<?php echo l('building_keywords') ?>") val = '';
                    if(!val) {alert('请输入楼盘关键字'); ID('params_q').focus(); return false;}
                    params.push('q'+val);
                    break;
                case 'price'://parseInt
                    var vala=Math.abs(parseInt(trim(ID('params_pricea').value)));
                    var valb=Math.abs(parseInt(trim(ID('params_priceb').value)));
                    if(vala || valb){
                        if(vala)
                            params.push('pricea'+vala);
                        if(valb)
                            params.push('priceb'+valb);
                    }else{
                        alert('请填写一个租金，仅支持整数');
                        return false;
                    }
                    break;
                case 'sale':
                    var vala=Math.abs(parseInt(trim(ID('params_salea').value)));
                    var valb=Math.abs(parseInt(trim(ID('params_saleb').value)));
                    if(vala || valb){
                        if(vala)
                            params.push('salea'+vala);
                        if(valb)
                            params.push('saleb'+valb);
                    }else{
                        alert('请填写一个售价，仅支持整数');
                        return false;
                    }
                    break;
            }
            //ID('search_no'+param).href;
            if(params.length)
                location.href = ID('search_no'+param).href+'-'+params.join('-');
            return false;
        }
        function ID(id){
            return document.getElementById(id);
        }
        function trim(str){
            str = str.replace(/^\s*/,'');
            str = str.replace(/\s*$/,'');
            return str;
        }
    </script>
<?php 
if(!empty($articleSEF) && preg_match('/^\d+$/', $articleSEF)){
?>
<script type="text/javascript">
var mapObj=null;
function  mapInit() {
    var xy = _MAPxy;
    mapObj = new BMap.Map("mapabc_box");
    var point = new BMap.Point(xy.x, xy.y);
    mapObj.centerAndZoom(point,15);
    mapObj.setCurrentCity("上海");
    var marker = new BMap.Marker(point);
    mapObj.addOverlay(marker);
    marker.disableMassClear();
    var label = new BMap.Label(xy.name,{"offset":new BMap.Size(25,-30)});
    marker.setLabel(label);
    label.setStyle({background:"#0099FF",borderColor:"#0099FF",color:"#fff",cursor:"pointer",padding:"3px"});
    label.hide();
    //marker.setAnimation(BMAP_ANIMATION_BOUNCE);
    (function(){
            var _label = label;
            marker.addEventListener("mouseover",function(){
                   _label.show();
            });
            marker.addEventListener("mouseout",function(){
                   _label.hide();
            });
    })()
}

mapInit();
</script>
<?php
    }
} ?>
</body>
</html>
