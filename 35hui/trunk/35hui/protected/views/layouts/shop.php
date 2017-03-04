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
                    <div class="sty" >
                        <p>上海</p>
                        <span onmouseover="document.getElementById('cty_1').style.display='';" onmouseout="document.getElementById('cty_1').style.display='none';" >商铺频道
						<div id="cty_1" style="width:100px;display:none">
						<a  href="/">写字楼频道</a>
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
                        <li class="<?=$meconandaction=="shopindex"?"cll":"clk"?>"><a href="/shop">首&nbsp;&nbsp;页</a></li>
						<li class="<?=$actionID=="rentindex"?"cll":"clk"?>"><?=CHtml::link("在租",array("/shop/rentindex"));?></li>
                        <li class="<?=$actionID=="sellindex"?"cll":"clk"?>"><?=CHtml::link("在售",array("/shop/sellindex"));?></li>
                        <li class="<?=$actionID=="transferindex"?"cll":"clk"?>"><?=CHtml::link("转让",array("/shop/transferindex"));?></li>
                        <li class="<?=$controllerID=="newsystembuildinfo"?"cll":"clk"?>"><?=CHtml::link("新盘",array("/newsystembuildinfo/newbuildindex"));?></li>
						<li class="<?=$controllerID=="uagent"?"cll":"clk"?>">
                            <div class="tnav" style="display: none">
                                <a href="<?=Yii::app()->createUrl("/uagent/shoprent");?>">经纪人出租</a>
                                <a href="<?=Yii::app()->createUrl("/uagent/shopsale");?>">经纪人出售</a>
								<a href="<?=Yii::app()->createUrl("/uagent/shoptransfer");?>">经纪人转让</a>
                            </div>
                            <a href="<?=Yii::app()->createUrl("/uagent/shoprent");?>">经纪人</a>
                        </li>
						<li class="clk"><?=CHtml::link("论&nbsp;&nbsp;坛",BBS_DOMAIN,array("target"=>"_blank"));?></li>
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