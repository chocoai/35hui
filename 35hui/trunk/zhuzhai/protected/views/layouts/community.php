<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link href="/css/newglobal.css" type="text/css" rel="stylesheet" />
        <link href="/css/css.css" type="text/css" rel="stylesheet" />
		
        <meta name="keywords" content="新地标" />
        <link href="/css/default.css" type="text/css" rel="stylesheet" />
        <link href="/css/head.css" type="text/css" rel="stylesheet" />
        <link href="/css/menu.css" type="text/css" rel="stylesheet" />
        <link href="/css/style.css" type="text/css" rel="stylesheet" />
        <link href="/css/layout.css" type="text/css" rel="stylesheet" />
        <link href="/css/nav.css" type="text/css" rel="stylesheet" />
        <link href="/css/index.css" type="text/css" rel="stylesheet" />
        <link href="/css/scrollable-horizontal.css" type="text/css" rel="stylesheet" />
        <link href="/css/ss.css" type="text/css" rel="stylesheet" />
        <link href="/css/homehead.css" type="text/css" rel="stylesheet" />
        <link href="/css/homemenu.css" type="text/css" rel="stylesheet" />
        <link href="/css/home.css" type="text/css" rel="stylesheet" />
        <link href="/css/homespecial.css" type="text/css" rel="stylesheet" />
        <link href="/css/brow.css" type="text/css" rel="stylesheet" />
        <style type="text/css">
            .links a:hover{ text-decoration: underline; }
        </style>
        <script type="text/javascript" src="/js/tabs.js"></script>
        <?php
        Yii::app()->clientScript->registerCoreScript('jquery');
        $controllerID = $this->getId();
        $actionID = $this->getAction()->getId();
        $navID=strtolower($controllerID.$actionID);
        $isCommunity = in_array($navID,array('communitybaseinfosearchindex','communitybaseinfoview','communitybaseinfodtsearchindex'));
        $isSale = in_array($navID,array('communitybaseinfosellindex','communitybaseinfoviewsell','communitybaseinfodtsellindex'));
        ?>
        <script>document.domain = "<?=JS_DOMAIN?>";</script>
    </head>
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <body>
        <div class="container">
            <div class="header">
                <div class="top">
                    <?php
                    if(isset(Yii::app()->user->id)&&!empty(Yii::app()->user->id)) {
                        ?>
                    <?=CHtml::link(Yii::app()->user->name,User::model()->getUrl())?>您好，欢迎来新地标！<?=CHtml::link('退出',array('site/logout'))?>
                        <?php
                    }else {
                        ?>
                    您好，欢迎来新地标找房！<a href="<?php echo Yii::app()->createUrl('/site/login'); ?>">登录</a>|<a href="<?php echo Yii::app()->createUrl('/site/register'); ?>">注册</a>|<a href="<?php echo Yii::app()->createUrl('/site/agentlogin'); ?>">新地标房产经纪</a>
                        <?php
                    }
                    ?>

                </div>
                <div class="logoline" cll>
                    <div class="logo" style="position: relative;"><div style=" position: absolute;left:-40px; top: -42px;z-index: -999;"><img src="/images/jieri.png"  /></div><a href="/"><img src="/images/logo.gif" alt="新地标" height="57" /></a></div>
                    <div class="step"><img src="/images/hstep.jpg" /></div>
                </div>
                <div class="nav">
                    <?php
                    $controllerID = $this->getId();
                    $actionID = $this->getAction()->getId();
                    ?>
                    <ul>
                        <li class="<?=$controllerID=="site"?"cll":"clk"?>"><a href="/">首&nbsp;&nbsp;页</a></li>
                        <? /*<li class="<?=$controllerID=="officebaseinfo"||$controllerID=="businesscenter"||$controllerID=="creativesource"?"cll":"clk"?>">
                            <div class="tnav" style="display: none">
                                <a href="<?=Yii::app()->createUrl("/officebaseinfo/rentIndex");?>">写字楼出租</a>
                                <a style=" border-bottom:1px dashed #15305F;" href="<?=Yii::app()->createUrl("/officebaseinfo/saleIndex");?>">写字楼出售</a>
                                <a href="<?=Yii::app()->createUrl("/businesscenter/index");?>">商务中心</a>
                                <a href="<?=Yii::app()->createUrl("/creativesource/index");?>">创意园区</a>
                            </div>
                            <a href="#">写字楼</a>
                        </li>
                        <li class="clk">
                            <div class="tnav" style="display: none">
                                <a href="<?=Yii::app()->createUrl("/shop/rentIndex");?>">商铺出租</a>
                                <a href="<?=Yii::app()->createUrl("/shop/sellIndex");?>">商铺出售</a>
                            </div>
                            <a href="#">商&nbsp;&nbsp;铺</a>
                        </li>
                        <li class="<?=$controllerID=="uagent"?"cll":"clk"?>">
                            <div class="tnav" style="display: none">
                                <a href="<?=Yii::app()->createUrl("/uagent/officerent");?>">写字楼出租</a>
                                <a href="<?=Yii::app()->createUrl("/uagent/officesale");?>">写字楼出售</a>
                            </div>
                            <a href="#">经纪人</a>
                        </li>
									
						 <li class="<?=$controllerID=="systembuildinginfo"||$controllerID=="creativeparkbaseinfo"?"cll":"clk"?>">
                            <div class="tnav" style="display: none">
                                <a href="<?=Yii::app()->createUrl("/systembuildinginfo/buildlist");?>">写字楼</a>
                                <a href="<?=Yii::app()->createUrl("/creativeparkbaseinfo/creativelist");?>">创意园区</a>
                            </div>
                            <a href="#">楼盘字典</a>
                        </li>
                        <li class="<?=$controllerID=="quickrelease"?"cll":"clk"?>"><?=CHtml::link("业主委托",array('/quickrelease'));?></li>
                        <li class="clk"><?=CHtml::link("论&nbsp;&nbsp;坛",BBS_DOMAIN,array("target"=>"_blank"));?></li>
                        <li class="clk"><?=CHtml::link("地图看房","/map",array("target"=>"_blank"));?></li>
                         *
                         */?><li class="clk">
                            <?/*<div class="tnav" style="display: none">
                                <a href="<?=Yii::app()->createUrl("/communitybaseinfo/rentIndex");?>">住宅出租</a>
                                <a href="<?=Yii::app()->createUrl("/communitybaseinfo/sellIndex");?>">住宅出售</a>
                            </div>*/?>
                            <a href="<?=Yii::app()->createUrl("/communitybaseinfo");?>">住&nbsp;&nbsp;宅</a>
                        </li>
						
						 
                        
                    </ul>
                </div>
            </div>
            <?php echo $content; ?>
        </div>
        <?=$this->renderPartial('/site/_footer');?>
        <?php Yii::app()->clientScript->registerScriptFile("/js/officeHead.js",CClientScript::POS_END);?>
        <script type="text/javascript">document.domain="<?=JS_DOMAIN?>";</script>
    </body>
</html>