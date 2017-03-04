<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link href="/css/global.css" type="text/css" rel="stylesheet" />
        <link href="/css/ugent.css" rel="stylesheet" type="text/css" />
        <link href="/css/style.css" type="text/css" rel="stylesheet" />
        <link href="/css/jjren.css" type="text/css" rel="stylesheet" />
        <link href="/css/index.css" type="text/css" rel="stylesheet" />
        <?php
        Yii::app()->clientScript->registerCoreScript('jquery');
        ?>
    </head>
    <body>
        <div class="utop">
            <div class="ctopcont">
                <div class="utleft">
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
                <div class="utright">
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
        <?php $this->renderPartial('_indexHead');?>
        <div class="box">
            <?php echo $content; ?>
        </div>
        <?=$this->renderPartial('/site/_footer');?>
        <script type="text/javascript">
            $('#headNav ul li').bind('mouseover', function() {
                $(this).children(".sellorrenttype").removeClass("hide").addClass("show");
                $(this).children(".headfont").addClass("mouseover");
            });
            $('#headNav ul li').bind('mouseout', function() {
                $(this).children(".sellorrenttype").removeClass("show").addClass("hide");
                $(this).children(".headfont").removeClass("mouseover");
            });
        </script>
    </body>
</html>