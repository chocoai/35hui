<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="keywords" content="新地标" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/default.css"  />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/Font.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/nav.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/sphead.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/layout.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/spmenu.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ss.css" />
        <style type="text/css">
            body { width:100%; margin:0 auto;}
            .navMenu ul li span { width:80px; display:block; }
            .navMenu ul li span ul {display:block; display:none;}
            .selected {background:url(/images/spbg.gif) 0 0 no-repeat; }
            .menu1 LI:hover UL, .menu1 LI.sfhover UL { MARGIN-TOP: 31px; padding:4px; Z-INDEX: 5; MARGIN-LEFT: 0px; WIDTH: 120px; POSITION: absolute; _top: 132px; background-color:#fce6d5; opacity: 0.90;+CLEAR: both; +MARGIN-TOP: 0px;  _clear:both;  }
            .menu1 LI:hover UL LI A, .menu1 LI.sfhover UL LI A { DISPLAY: block;PADDING: 0px 0px 0px 25px;FONT-WEIGHT: normal; FONT-SIZE: 13px; MARGIN: 0px; WIDTH: 85px; color:#333; TEXT-ALIGN: left;}
            .menu1 LI:hover UL LI A:hover, .menu1 LI.sfhover UL LI A:hover {  BACKGROUND-COLOR: #fce6d5;  color:#dd4d04;  }
            #welcom { width:1003px; text-align:left; margin:0 auto;}
            .links { float: right; color: #4D4D4D;  top:0; }
            .links a { color:#4D4D4D; }
            .links span { color: #4D4D4D; margin: 0 5px;}
            a.blueline:visited,a.blueline:link{font-weight:bold}
            a.blueline:hover{color:#FF6600;text-decoration: underline}
            .menu1 li.selected a{color:#fff;}
            .loginbtn { background: none repeat scroll 0 0 transparent;  border: 0 none;  cursor: pointer; margin-left: 10px; height: 14px; width: 28px; display: inline;}
            .lg{display: block; height: 25px; line-height: 25px;}
            .loginbtn a{_padding-bottom:15px; _margn-bottom:10px;}
            .lg{display: block; height: 25px; line-height: 25px;}
            a{ outline:none;}
            .searchbar{position:relative; left:300px; top: 60px;}
        </style>
        <?php
        Yii::app()->clientScript->registerCoreScript('jquery');
        $controllerID = $this->getId();
        $actionID = $this->getAction()->getId();
        $navID=strtolower($controllerID.$actionID);
        $isBuild=in_array($navID,array('systembuildinginfoshopindex','systembuildinginfoshopbuildlist'));
        $isSale=$navID=='shopsellindex';
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
                    <div class="n_logo"><img src="/images/logo.png" /></div>
                    <div class="n_title">商&nbsp;铺</div>
                    <div class="n_city">
                        <p>上海</p>
                        <a href="" class="n_down">切换城市</a>
                    </div>
                    <div class="search">
                        <div id="fmc" class="n_select">
                            <?php if($isBuild){?>
                            <div id="mConc"><span>商业广场</span></div>
                            <?php } else{?>
                            <div id="mConc"><span>商铺</span></div>
                            <?php }?>
                            <div id="mMenucc" class="sct_cont hidden">
                                <p onclick="ChangeHtml(1)"><a hidefocus="true" name="ime_hw" href="#">商铺</a></p>
                                <p onclick="ChangeHtml(2)"><a hidefocus="true" name="ime_py" href="#">商业广场</a></p>
                            </div>
                        </div>
                        <div class="sct_zss" id="zsc">
                            <span onclick="ChangeSelect(1)"><a <?php echo $isSale||$isBuild?'':'class="clk_sear"'?>>租</a></span>
                            <span onclick="ChangeSelect(2)"><a <?php echo $isSale?'class="clk_sear"':''?>>售</a></span>
                        </div>
                        <div class="n_sch">
                            <form method="post" id="headSearchForm" action="<?php echo Yii::app()->createUrl('/site/shopheadsearch');?>">
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
                                        "extraParams"=>array("type"=>"2"),//表示是楼盘、商业广场还是小区
                                        'htmlOptions'=>array('class'=>'input_3'),
                                        "methodChain"=>".result(function(event,item){\$(\"#headSearchForm\").submit()})",//回调函数
                                ));
                                ?>
                                <input type="hidden" name="type" id="form_type" value="<?php echo $isBuild?2:1?>" />
                                <input type="hidden" name="sellorrent" id="form_sellorrent" value="<?php echo $isSale?2:1?>" />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="p_nav">
                    <ul>
                        
                       <li<?php echo in_array($navID,array('shopindex','shopview'))?' class="clk"':'' ?>>
                            <a href="/shop">商&nbsp;铺</a>
                        </li>
                        <li<?php echo $navID=='shoprentindex'?' class="clk"':'' ?>> <span>
                                <a href="<?php echo Yii::app()->createUrl('/shop/rentIndex'); ?>">在租商铺</a>
                            </span>
                        </li>
                        <li<?php echo $isSale?' class="clk"':'' ?>> <span>
                                <a href="<?php echo Yii::app()->createUrl('/shop/sellIndex'); ?>">在售商铺</a>
                            </span>
                        </li>
                           <li<?php echo $isSale?' class="clk"':'' ?>> <span>
                                <a href="<?php echo Yii::app()->createUrl('/shop/transferIndex'); ?>">转让商铺</a>
                            </span>
                        </li>
                        
                    </ul>
                </div>
            </div>
            <div>
                <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                        "homeLink"=>"<a href='".DOMAIN."'>首页</a>",
                        'links'=>$this->breadcrumbs,
                        'htmlOptions'=>array('style'=>'padding: 10px 0;')
                )); ?><!-- breadcrumbs -->
                <?php echo $content; ?>
            </div>
            <?=$this->renderPartial('/site/_footer');?>
        </div>
        <script type="text/javascript" src="/js/shopHead.js"></script>
    </body>
</html>
