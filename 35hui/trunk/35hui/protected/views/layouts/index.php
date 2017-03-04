<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="新地标"  name="Author" />
<meta name="alexaVerifyID" content="64mGbuZtI5z_rSOc9J_dY2b-IY8" />
<title>新地标</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/global.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/index_new.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/tanchu.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/default.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/head.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/index.css" />
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-22655838-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? ' https://ssl' : ' http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php
Yii::app()->clientScript->registerCoreScript('jquery');
?>
</head>
<body>
<div id="login" style="border-bottom: none;">
    <div style="width:1003px; text-align: center; margin: 0 auto; height: 25px; line-height: 25px;">
        <div id="welcom">
            <div class="n_welcome" style="float:right">
                <?php
                if(isset(Yii::app()->user->id)&&!empty(Yii::app()->user->id)) {
                    ?>
                您好&nbsp;<?=CHtml::link(Yii::app()->user->name,User::model()->getUrl())?>。欢迎来到360新地标网！[<?=CHtml::link('退出',array('site/logout'))?>]&nbsp
                    <?php
                }else {
                ?>
                欢迎来到360新地标网，<a href="<?php echo Yii::app()->createUrl('/site/login'); ?>">[请登录]</a>新用户？<a href="<?php echo Yii::app()->createUrl('/site/register'); ?>" style="color:#ff2200;">[请注册]</a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
    <div class="header">
    <div class="logo"><img src="<?=IMAGE_URL?>/newlogo.gif" alt="新地标" /></div>
    <div class="search" id="searchbar">
        <img src="<?=IMAGE_URL?>/banner.gif" alt="新地标" usemap="#Map"/>
    </div>
</div>
<div class="nav" id="divType">
    <ul>
        <li onclick="changeClassName(this);"><?=CHtml::link("每日地产","/")?></li>
        <li onclick="changeClassName(this);"><?=CHtml::link("写字楼","/office")?></li>
        <li onclick="changeClassName(this);"><?=CHtml::link("商&nbsp;铺","/shop")?></li>
        <li onclick="changeClassName(this);"><?=CHtml::link("住&nbsp;宅",array("/communitybaseinfo/index"));?></li>
        <li onclick="changeClassName(this);"><?=CHtml::link("商务中心",array("/officebaseinfo/businessIndex"))?></li>
        <li onclick="changeClassName(this);"><?=CHtml::link("地图找房","/map")?></li>
        <li onclick="changeClassName(this);"><?=CHtml::link("资&nbsp;讯",array("/news/day"))?></li>
        <li onclick="changeClassName(this);"><?=CHtml::link("经纪人",array("/uagent/showuagent"))?></li>
        <li onclick="changeClassName(this);"><?=CHtml::link("论坛",BBS_DOMAIN)?></li>
    </ul>
</div>
<div class="main">
    <?php echo $content; ?>
</div>
<?=$this->renderPartial('_footer');?>
    <script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F306fe6e44f34941fd008214b147aa51d' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>