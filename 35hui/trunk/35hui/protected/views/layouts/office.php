<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link href="/css/newglobal.css" type="text/css" rel="stylesheet" />
        <link href="/css/css.css" type="text/css" rel="stylesheet" />
    </head>
    <?php Yii::app()->clientScript->registerCoreScript('jquery');?>
    <body>
        <div class="container">
            <div class="header">
                <div class="top">
                    <?php $this->renderDynamic("getTopUserState"); ?>
                </div>
                <div class="logoline" cll>
                    <div class="logo" style="position: relative;"><a title="360dibiao.com - 商业地产第一推广平台" href="/"><img src="/images/logo.gif" alt="新地标" height="57" /></a></div>
                    <div class="sty"  >
                        <p>上海</p>
                        <span onmouseover="document.getElementById('cty_1').style.display='';" onmouseout="document.getElementById('cty_1').style.display='none';" >写字楼频道
						<div id="cty_1" style="width:100px;display:none">
						<a  href="<?=Yii::app()->createUrl('/shop')?>">商铺频道</a>
						</div>
						</span>
                    </div>
                    <div class="step"><img src="/images/hstep.jpg" title="专业的房地产中介服务，专业的360实景商业地产房源展现 " alt="专业的房地产中介服务，专业的360实景商业地产房源展现 " /></div>
                </div>
                <div class="nav">
                    <?php
                    $controllerID = $this->getId();
                    $actionID = $this->getAction()->getId();
                    $meconandaction = $controllerID.$actionID;
                    ?>
                    <ul>
                        <li class="<?=$controllerID=="site"?"cll":"clk"?>"><a href="/">首&nbsp;&nbsp;页</a></li>
                        <li class="<?=$controllerID=="officebaseinfo"||$meconandaction=="businesscenterindex"||$controllerID=="creativesource"?"cll":"clk"?>">
                            <div class="tnav" style="display: none">
                                <a href="<?=Yii::app()->createUrl("/officebaseinfo/rentIndex");?>">写字楼出租</a>
                                <a href="<?=Yii::app()->createUrl("/officebaseinfo/saleIndex");?>">写字楼出售</a>
                            </div>
                            <a href="<?=Yii::app()->createUrl("/officebaseinfo/rentIndex");?>">写字楼</a>
                        </li>
                        <li class="<?=$controllerID=="uagent"?"cll":"clk"?>">
                            <div class="tnav" style="display: none">
                                <a href="<?=Yii::app()->createUrl("/uagent/officerent");?>">经纪人出租</a>
                                <a href="<?=Yii::app()->createUrl("/uagent/officesale");?>">经纪人出售</a>
                            </div>
                            <a href="<?=Yii::app()->createUrl("/uagent/officerent");?>">经纪人</a>
                        </li>
						<li class="<?=$controllerID=="businesscenter"&&$meconandaction!="businesscenterindex"?"cll":"clk"?>"><?=CHtml::link("商务中心",array("/businesscenter/list"));?></li>
                        <li class="<?=$controllerID=="creativeparkbaseinfo"?"cll":"clk"?>"><?=CHtml::link("创意园区",array("/creativeparkbaseinfo/creativelist"));?></li>
                        <li class="<?=$controllerID=="systembuildinginfo"?"cll":"clk"?>"><?=CHtml::link("楼盘",array("/systembuildinginfo/buildlist"));?></li>
                        <li class="<?=$controllerID=="newsystembuildinfo"?"cll":"clk"?>"><?=CHtml::link("新盘",array("/newsystembuildinfo/newbuildlist"));?></li>
                        <li class="<?=$controllerID=="quickrelease"?"cll":"clk"?>"><?=CHtml::link("业主委托",array('/quickrelease'));?></li>
                        <li class="clk"><?=CHtml::link("论&nbsp;&nbsp;坛",BBS_DOMAIN,array("target"=>"_blank"));?></li>
                        <li class="clk"><?=CHtml::link("地图看房","/map",array("target"=>"_blank"));?></li>
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