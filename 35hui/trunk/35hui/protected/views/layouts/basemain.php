<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/tabs.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/default.css"  />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/Font.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/index.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/nav.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/head.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/layout.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/menu.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ss.css" />
        <style type="text/css">
            body { width:100%; margin:0 auto;}
            .navMenu ul li span { width:80px; display:block; }
            .navMenu ul li span ul { display:block; display:none;}
            #welcom { width:1003px; text-align:left; margin:0 auto; }
            .links { float: right; color: #4D4D4D; position: relative; right: 0; top: 0; }
            .links a { color:#4D4D4D; }
            .links span { color: #4D4D4D; margin: 0 5px;}
            a.blueline:visited,a.blueline:link{font-weight:bold}
            a.blueline:hover{color:#FF6600;text-decoration: underline}
            .lgn_lnk,.lgn_ipt { color: #4D4D4D; height: 23px; line-height: 23px; margin-left: 4px; }
            .lgn_ipt { border: 1px solid #DDD7C1; float: left; margin-left: 4px; width: 130px;}
            .lg{display: block; height: 25px; line-height: 25px;}
            .loginbtn a{_padding-bottom:15px; _margn-bottom:10px;}
            a{ outline:none; }
            #kw{width:301px;}
            .ss_wz { TEXT-ALIGN:left; LINE-HEIGHT:24px; WIDTH:214px; HEIGHT:24px; padding-bottom:10px !important; padding-top:5px; clear:both; display:block; }
            .qjss{_position: relative;}
            .searchbar{position:relative; left:300px; top: 60px;}
            #mMenu{z-index: 999}
        </style>
        <script type="text/javascript">
            sfHover = function() {
                //var sfEls = document.getElementById("navMenu").getElementsByTagName("LI");
                 var sfEls = $(".navMenu LI");
                for (var i=0; i<sfEls.length; i++) {
                    sfEls[i].onmouseover=function() {
                        this.className+=" sfhover";
                    }
                    sfEls[i].onmouseout=function() {
                        this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
                    }
                }
            }
            if (window.attachEvent) window.attachEvent("onload", sfHover);
        </script>
        <script>document.domain = "<?=JS_DOMAIN?>";</script>
    </head>
    <?php
    Yii::app()->clientScript->registerCoreScript('jquery');
    ?>
    <body>
        <?
        $controllerID = $this->getId();
        $actionID = $this->getAction()->getId();
        $navID=strtolower($controllerID.$actionID);
        $isSale=in_array($navID,array('officebaseinfosaleindex','officebaseinfosaleview'));
        $isBusiness=in_array($navID,array('officebaseinfobusinessindex','officebaseinforentbusinesslist'));
        $isBuild=in_array($navID,array('systembuildinginfoindex','systembuildinginfoview','systembuildinginfobuildlist'));
        ?>
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
                        <span>-</span>
                        <?=CHtml::link("论坛",BBS_DOMAIN,array("target"=>"_blank"));?>
                    </div>
                </div>
            </div>
        </div>

        <!--header start-->
        <div class="box">
            <div class="head">
                <div class="header">
                    <div class="n_logo" onclick="window.location.href='<?=DOMAIN?>'"></div>
                    <div class="n_title">写字楼</div>
                    <div class="n_city">
                        <p>上海</p>
                        <a href="" class="n_down">切换城市</a>
                    </div>
                    <div class="search">
                        <div id="fmc" class="n_select">
                            <?php if($isBuild){?>
                            <div id="mConc"><span>楼盘</span></div>
                            <?php }else if($isBusiness){?>
                            <div id="mConc"><span>商务中心</span></div>
                            <?php }else{?>
                            <div id="mConc"><span>写字楼</span></div>
                            <?php }?>
                            <div id="mMenucc" class="sct_cont hidden">
                                <p onclick="ChangeHtml(1)"><a hidefocus="true" name="ime_hw" href="#">写字楼</a></p>
                                <p onclick="ChangeHtml(2)"><a hidefocus="true" name="ime_py" href="#">商务中心</a></p>
                                <!--<p onclick="ChangeHtml(3)"><a hidefocus="true" name="ime_py" href="#">楼盘</a></p>-->
                            </div>
                        </div>
                        <div class="sct_zss" id="zsc">
                            <span onclick="ChangeSelect(1)"><a <?php echo $isSale||$isBuild?'':'class="clk_sear"'?>>租</a></span>
                            <span onclick="ChangeSelect(2)"><a <?php echo $isSale?'class="clk_sear"':''?>>售</a></span>
                        </div>
                        <div class="n_sch">
                            <form method="post" id="headSearchForm" action="<?php echo Yii::app()->createUrl('site/officeheadsearch');?>">
                                <button class="btn_04" type="submit"></button>
                                <?php $this->widget('CAutoComplete',
                                        array(
                                        'name'=>'kwords',
                                        'url'=>array('site/ajaxautocomplete'),
                                        'max'=>10,//显示最大数
                                        'minChars'=>1,//最小输入多少开始匹配
                                        'delay'=>500, //两次按键间隔小于此值，则启动等待
                                        'scrollHeight'=>200,
                                        "extraParams"=>array("type"=>"1"),//表示是楼盘、商业广场还是小区
                                        'htmlOptions'=>array('class'=>'input_3'),
                                        "methodChain"=>".result(function(event,item){\$(\"#headSearchForm\").submit()})",//回调函数
                                ));
                                $form_type=1;
                                if($isBusiness){
                                    $form_type=2;
                                }else if($isBuild){
                                     $form_type=3;
                                }
                                ?>
                                <input type="hidden" name="type" id="form_type" value="<?php echo $form_type;?>" />
                                <input type="hidden" name="sellorrent" id="form_sellorrent" value="<?php echo $isSale?2:1?>" />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="l_nav">
                    <ul>
                        <li<?php echo $navID=='officeindex'?' class="clk"':'' ?>><a href="<?php echo Yii::app()->createUrl('/office'); ?>">写字楼</a></li>
                        <li<?php echo in_array($navID,array('officebaseinforentindex','officebaseinforentview'))?' class="clk"':'' ?>> <span>
                                <a href="<?php echo Yii::app()->createUrl('/officebaseinfo/rentIndex'); ?>">在租写字楼</a>
                            </span>
                        </li>
                        <li<?php echo $isSale?' class="clk"':'' ?>> <span>
                                <a href="<?php echo Yii::app()->createUrl('/officebaseinfo/saleIndex'); ?>">在售写字楼</a>
                            </span>
                        </li>
                        <li<?php echo $navID=='officebaseinfobusinessindex'||$navID=='officebaseinforentbusinesslist'?' class="clk"':'' ?>  style="position:relative;">
                            <em class="top_new"></em></li>
                        <li<?php echo $isBusiness?' class="clk"':'' ?>>
                            <a href="<?php echo Yii::app()->createUrl('/officebaseinfo/businessIndex'); ?>">商务中心</a>
                        </li>
                        <li<?php echo in_array($navID,array('systembuildinginfoindex','systembuildinginfoview','systembuildinginfobuildlist'))?' class="clk"':'' ?>></li>
                        
                    </ul>
                </div>
            </div>
            <!--header end-->
            <div style="background-color:white">
                <?php echo $content; ?>
            </div>
            <?=$this->renderPartial('/site/_footer');?>
        </div>
        <!-- page -->
       <script type="text/javascript" src="/js/officeHead.js"></script>
    </body>
</html>