<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="all" name="robots" />
<title>新地标经纪人管理后台</title>
<meta name="description" content="新地标经纪人管理后台" />
<meta name="keywords" content="新地标经纪人管理后台" />
<?php
if(isset($_GET['imgpath']) && isset($_GET['imgpath'])){
    ?>
<META HTTP-EQUIV="Cache-Control" CONTENT="no-store, must-revalidate"> 
<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/imageinfo/jquery-pack.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/imageinfo/jquery.imgareaselect.min.js"></script>
<?php
}else{
    Yii::app()->clientScript->registerCoreScript('jquery');
}
?>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/manage.css" rel="stylesheet" type="text/css" />
<style type="text/css">
a.blueline:visited,a.blueline:link{font-weight:bold}
a.blueline:hover{color:#FF6600;text-decoration: underline}
</style>
</head>
<body>
  <div class="managebody">
<!--header start-->
    <div class="header clearfix">
        <a href="<?=DOMAIN; ?>"><img src="<?=IMAGE_URL; ?>/manage_logo.gif" alt="" class="manage_logo" /></a><img src="<?=IMAGE_URL; ?>/ua_manage_font.gif" alt="经纪人管理系统" class="manage_font" />
	  <ul>
	    <li class="three"></li>
		<li class="two"><span><a class="blueline" href="<?php echo User::model()->getUrl()?>"><?=Yii::app()->user->name; ?></a>您好！</span><code><?=CHtml::link("论坛",BBS_DOMAIN,array("target"=>"_blank"));?>|&nbsp;客服热线：400-820-9181&nbsp;|<a href="<?php echo Yii::app()->createUrl('/site/logout'); ?>">安全退出</a></code></li>
		<li class="one"></li>
	  </ul>
	</div>
	<div class="navigation clearfix">
	  <img src="<?=IMAGE_URL; ?>/manage_navl.jpg" style="float:left;" />
       <?php $this->renderPartial('/viewuagent/swHuiPost'); ?>
	  <img src="<?=IMAGE_URL; ?>/manage_navr.jpg" style="float:right;" />
   </div>
<!--header end-->
    <div class="clearfix">
        <!--left start-->
        <div class="manage_left">
            <?php
            $this->renderPartial('/viewuagent/leftmenu');
            ?>
        </div>
        <!--left end-->
        <!--right start-->
        <div class="manage_right">
            <div class="manage_ad">
                <?
                    $ad6 = Advertisement::showAdvertise(6);
                    if($ad6){
                        echo $ad6;
                    }else{
                ?>
                <img src="<?=IMAGE_URL; ?>/manage_04.gif" alt="" />
                <?
                    }
                ?>
            </div>
            <div class="manage_rightnav clearfix">
                <code>
                    <?php //调用方法页面会出错，所有要自己写。
                        $k = 0;
                        foreach($this->breadcrumbs as $key=>$value){
                            if($k!=0){
                                echo "&gt;&nbsp;";
                            }
                            $k = 1;
                            if(is_int($key)){//直接输出span
                                echo "<font>".$value."</font>";
                            }else{
                                echo CHtml::link($key,$value);
                            }
                        }
                    ?>
                </code>
            </div>
            <?php echo $content; ?>
        </div>
        <!--right end-->
    </div>
</div>
<!--foot start-->
  <?=$this->renderPartial('/site/_footer');?>
<!--foot end-->
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F306fe6e44f34941fd008214b147aa51d' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>