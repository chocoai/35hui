<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
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
    <body>
        <div id="login">
            <div style="width:1003px; text-align: center; margin: 0 auto; height: 25px; line-height: 25px;">
                <div id="welcom">
                    <div id="lgn_wrap">
                        <?php
                        if(isset(Yii::app()->user->id)&&!empty(Yii::app()->user->id)) {
                            ?>
                        <div>您好<?=CHtml::link(Yii::app()->user->name,User::model()->getUrl(),array('class'=>'blueline'))?>，欢迎来新地标！[<?=CHtml::link('退出',array('site/logout'))?>]&nbsp;</div>
                            <?php
                        }else {
                            ?>

                        <form id="head-login-form" name="head-login-form" method="post" action="<?=Yii::app()->createUrl('/site/login');?>">
                            <span class="lgn_ipt">
                                <span class="w">用户名:</span>
                                <input type="text" value="" id="LoginForm_username" name="LoginForm[username]" class="ipt" style="width:80px; _width:60px; _height:20px;"/>
                            </span>
                            <span class="lgn_ipt">
                                <span class="w">密码:</span>
                                <input type="password" value="" id="LoginForm_username" name="LoginForm[password]" class="ipt" style="width:80px; _width:60px; _height:20px;"/>
                            </span>
                            <span class="lgn_lnk">
                                <input type="submit" alt="登录" class="loginbtn" value="登录"/>
                                &nbsp;&nbsp;&nbsp;
                                <a href="<?php echo Yii::app()->createUrl('/site/register'); ?>" hidefocus="true">[注册]</a>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo Yii::app()->createUrl('/site/findPwd'); ?>" hidefocus="true">[忘记密码]</a>
                            </span>
                            <input name="backUrl" id="backUrl" type="hidden" value=""/>
                        </form>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="links">
                        <?=CHtml::link("写字楼",array("/office"));?>
                        <span>-</span>
                        <?=CHtml::link("商铺",array("/shop"));?>
                        <span>-</span>
                        <?=CHtml::link("住宅",array("/communitybaseinfo/index"));?>
                        <span>-</span>
                        <?=CHtml::link("地图找房","/map");?>
                        <span>-</span>
                        <?=CHtml::link("中介公司",array("/ucom/showcompany"));?>
                        <span>-</span>
                        <?=CHtml::link("经纪人",array("/uagent/showuagent"));?>
                        <span>-</span>
                        <?=CHtml::link("资讯",array("/news/day"));?>
                    </div>
                </div>

            </div>
        </div>
        <div class="box">
            <div class="head">
                <div class="header">
                    <div class="n_logo" onclick="window.location.href='<?=DOMAIN?>'"></div>
                    <div class="n_title">住&nbsp;宅</div>
                    <div class="n_city">
                        <p>上海</p>
                        <a href="" class="n_down">切换城市</a>
                    </div>
                    <div class="search">
                        <div id="fmc" class="n_select">
                            <?php if($isCommunity){?>
                            <div id="mConc"><span>小区</span></div>
                            <?php } else{?>
                            <div id="mConc"><span>住宅</span></div>
                            <?php }?>
                            <div id="mMenucc" class="sct_cont hidden">
                                <p onclick="ChangeHtml(1)"><a hidefocus="true" name="ime_hw" href="#">住宅</a></p>
                                <p onclick="ChangeHtml(2)"><a hidefocus="true" name="ime_py" href="#">小区</a></p>
                            </div>
                        </div>
                        <div class="sct_zss" id="zsc">
                            <span onclick="ChangeSelect(1)"><a <?php echo $isSale||$isCommunity?'':'class="clk_sear"'?>>租</a></span>
                            <span onclick="ChangeSelect(2)"><a <?php echo $isSale?'class="clk_sear"':''?>>售</a></span>
                        </div>
                        <div class="n_sch">
                            <form method="post" id="headSearchForm" action="<?php echo Yii::app()->createUrl('/site/communityheadsearch');?>">
                                <button class="btn_04" type="submit"></button>
                                <?php $this->widget('CAutoComplete',
                                        array(
                                        'name'=>'kwords',
                                        //'class'=>'input_03',
                                        'url'=>array('site/ajaxautocomplete'),
                                        'max'=>10,//显示最大数
                                        'minChars'=>1,//最小输入多少开始匹配
                                        'delay'=>500, //两次按键间隔小于此值，则启动等待
                                        'scrollHeight'=>200,
                                        "extraParams"=>array("type"=>"3"),//表示是楼盘、商业广场还是小区
                                        'htmlOptions'=>array('class'=>'input_3'),
                                        "methodChain"=>".result(function(event,item){\$(\"#headSearchForm\").submit()})",//回调函数
                                ));
                                ?>
                                <input type="hidden" name="type" id="form_type" value="<?php echo $isCommunity?2:1?>" />
                                <input type="hidden" name="sellorrent" id="form_sellorrent" value="<?php echo $isSale?2:1?>" />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="z_nav">
                    <ul>
                        <li><a href="<?php echo DOMAIN; ?>">首&nbsp;页</a></li>
                        <li<?php echo $navID=='communitybaseinfoindex'?' class="clk"':'' ?>>
                            <a href="<?php echo Yii::app()->createUrl('/communitybaseinfo/index'); ?>">住&nbsp;宅</a>
                        </li>
                        <li<?php echo $isSale?' class="clk"':'' ?>> <span>
                                <a href="<?php echo Yii::app()->createUrl('/communitybaseinfo/sellIndex'); ?>">二手房</a>
                            </span>
                        </li>
                        <li<?php echo in_array($navID,array('communitybaseinforentindex','communitybaseinfoviewrent','communitybaseinfodtrentindex'))?' class="clk"':'' ?>> <span>
                                <a href="<?php echo Yii::app()->createUrl('/communitybaseinfo/rentIndex'); ?>">租房</a>
                            </span>
                        </li>
                        <li<?php echo $isCommunity?' class="clk"':'' ?>> <span>
                                <a href="<?php echo Yii::app()->createUrl('/communitybaseinfo/searchIndex'); ?>">楼盘小区</a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="center">
                <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                        "homeLink"=>"<a href='".DOMAIN."'>首页</a>",
                        'links'=>$this->breadcrumbs,
                        'htmlOptions'=>array('style'=>'padding: 10px 0;')
                )); ?><!-- breadcrumbs -->
                <?php echo $content; ?>
            </div>
            <?=$this->renderPartial('/site/_footer');?>
        </div>
        <script type="text/javascript" src="/js/communityHead.js"></script>
    </body>
</html>
