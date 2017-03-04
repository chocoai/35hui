<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/zj.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrap">
  <div id="box">
    <div id="head"><a href="<?=DOMAIN?>"><img src="<?=IMAGE_URL; ?>/zj/llogo.gif" border="0" /></a></div>
    <div class="name"><span cla><?php echo CHtml::encode($this->temp); ?></span>的网上店铺</div>
    <div id="nav"><img src="<?=IMAGE_URL; ?>/zj/nav.gif" border="0" usemap="#Map" />
      <map name="Map" id="Map">
        <area shape="rect" coords="20,9,102,48" href="/office" />
        <area shape="rect" coords="109,10,182,46" href="/shop" />
        <area shape="rect" coords="192,9,270,47" href="<?=Yii::app()->createUrl("communitybaseinfo/index");?>" />
        <area shape="rect" coords="287,9,380,47" href="/map" />
        <area shape="rect" coords="399,7,495,48" href="/ucom/showcompany" />
        <area shape="rect" coords="509,5,599,48" href="/uagent/showuagent" />
        <area shape="rect" coords="603,6,688,49" href="<?=Yii::app()->createUrl("news/day");?>" />
      </map>
    </div>
    <div id="main">
       <?=$content?>
  </div>
    <div id="footer">
    <div style="padding-top:25px;">
    <div style="text-align: center; padding-top: 8px; height: 25px; line-height: 25px;"> <span class="link_span"><a href="/help" rel="nofollow">关于我们</a></span>| <span class="link_span"><a href="/help/connect" rel="nofollow">联系我们</a></span>| <span class="link_span"><a href="/help/contract">用户协议</a></span>| <span class="link_span"><a href="/help/qjtakephoto" rel="nofollow">全景看房</a></span> </div>
    <div class="copyright"> <span>客服热线：400-820-9181&nbsp;&nbsp;邮箱：<a href="#">service@360dibiao.com</a>&nbsp;&nbsp;虚假信息举报：400-820-9181</span><br />
        <span>Copyright ⓒ 2010 www.360dibiao.com  All Rights Rserved &nbsp;&nbsp;<a href="http://www.miibeian.gov.cn" target="_blank">沪ICP备10201522号-3</a></span> </div></div>
</div>
  </div>
</div>
</body>
</html>