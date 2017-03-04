<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$this->pageTitle?></title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/default.css"  />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/Font.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/nav.css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/sphead.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/layout.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/menu.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/help/layout.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/help/menu.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/help/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/shipinnav.js"></script>
<style type="text/css">
#topnav {height:37px;margin-top:17px;background:url(./images/topnavbg.gif) transparent repeat-x 0 100%;}
.navMenu ul li span {width:80px;display:block;}
.navMenu ul li span ul {display:block;display:none;}
body {width:100%;text-align:center;	margin:0 auto;}
#welcom {width:1003px;	text-align:center;	margin:0 auto;}
.links {float: right;color: #4D4D4D;top:0;}
.links a {color:#4D4D4D;}
.links span {color: #4D4D4D;margin: 0 5px;}
.loginbtn{border:0; background:none; cursor:pointer; margin-left:10px;_margin-top:4px; width:28px; height:18px; display:inline;}
.navMenu ul li span {width:80px;display:block;}
.navMenu ul li span ul {display:block;	display:none;}
</style>
</head>
<?php
Yii::app()->clientScript->registerCoreScript('jquery');
?>
<body>
    <?
    $controllerID = $this->getId();
    $actionID = $this->getAction()->getId();
    ?>
    <div id="login">
        <div style="width:1000px; text-align: center; margin: 0 auto;">
        <div id="welcom">
            <div id="lgn_wrap">
                <?php
                if(isset(Yii::app()->user->id)&&!empty(Yii::app()->user->id)){
                ?>
                <div>您好<?=CHtml::link(Yii::app()->user->name,User::model()->getUrl(),array('class'=>'blueline'))?>，欢迎来新地标！[<?=CHtml::link('退出',array('site/logout'))?>]&nbsp;</div>
                <?php
                }else{
                ?>
                <form id="head-login-form" name="head-login-form" method="post" action="<?=Yii::app()->createUrl('/site/login');?>">
                    <span class="lgn_ipt">
                        <span class="w">用户名:</span>
                        <input type="text" value="" id="LoginForm_username" name="LoginForm[username]" class="ipt" style="width:80px;"/>
                    </span>
                    <span class="lgn_ipt">
                        <span class="w">密码:</span>
                        <input type="password" value="" id="LoginForm_username" name="LoginForm[password]" class="ipt" style="width:80px;"/>
                    </span>
                    <span class="lgn_lnk">
                        <!--<input type="image" alt="登录" src="<?=Yii::app()->request->baseUrl; ?>/images/lgnbtn.gif" width="44" height="15" border="0"/>-->
                        <input type="submit" alt="登录" class="loginbtn" value="登录"/>
                        &nbsp;&nbsp;&nbsp;
                        [<a href="<?php echo Yii::app()->createUrl('/site/register'); ?>">注册</a>]&nbsp;&nbsp;&nbsp;
                        [<a href="<?php echo Yii::app()->createUrl('/site/findPwd'); ?>">忘记密码</a>]
                    </span>
                    <input name="backUrl" id="backUrl" type="hidden" value=""/>
                </form>
                <?php
                    }
                ?>
            </div>
			<div class="links">
        <?=CHtml::link("写字楼","/office");?>
        <span>-</span>
        <?=CHtml::link("地图找房","/map");?>
        <span>-</span>
        <?=CHtml::link("论坛",BBS_DOMAIN,array("target"=>"_blank"));?>
    </div>
        </div>
    </div>
    </div>
    <div class="box">
		<div class="head"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/help/banner11.jpg" width="1000px" height="130" border="0" /></div>
    <!--header end-->
    <div style="background-color:white">
    <?php echo $content; ?>
    </div>
    <div style="height:20px"></div>
    <?=$this->renderPartial('/site/_footer');?>
</div>
<!-- page -->
<script type="text/javascript">
function list_submenu(obj){
	$(".ubaboutmenu").each(function(){ //隐藏所有有子菜单li
			$(this).css('visibility','hidden');
			$(this).css('display','none');
			$(this).prev().css('visibility','visible');
			$(this).prev().css('display','block');
		}
	);
	$(".currentmenu").each(function(){
        if($(this).find("ul").length>0){
            $(this).css('visibility','hidden');
            $(this).css('display','none');
        }
        $(this).removeClass('currentmenu');
    });
	//设置当前子菜单
	$(obj).next().css('visibility','visible');
	$(obj).next().css('display','block');
	//调整样式

	$(obj).toggleClass('currentmenu');
	$(obj).next().toggleClass('currentmenu');
}
			//登录后返回上一页，取得上一页，并上一页检查是否是本站页面
			if(location.href.indexOf('site/login')>=0){
				$("#head-login-form").find("#backUrl").attr('value',document.referrer);
			}else{
				$("#head-login-form").find("#backUrl").attr('value',location.href);
			}
</script>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F306fe6e44f34941fd008214b147aa51d' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>
