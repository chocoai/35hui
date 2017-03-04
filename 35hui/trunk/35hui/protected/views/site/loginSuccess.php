<?php
$this->pageTitle='登录-新地标';
$this->breadcrumbs=array(
	'登录',
);
?>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.errorMessage{  color:red;}
a.a1:link,a.a1:visited{color:blue}
a.a1:hover{color:orange}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/global.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lou.css" />
<div id="center">
    <div style="width:984px;margin:0px auto; padding-top:20px;">
        <div id="left-bar" class="main_content" style="border:0px;margin:0 auto;text-align:center;padding-top:50px">
            <div class="hint" style="height:100px;line-height: 100px"><img alt="登录成功"src="/images/success.gif"><?php echo isset($_GET['action']) && $_GET['action']?'您已经登录本站，不能重复登录！':'恭喜您，登录成功';?>，
                <span>系统&nbsp;<span id="time_count" style="color:red">5</span>&nbsp;秒后将自动
                    <?php
                      if($backUrl){?>
                    <a class="a1" href="<?php echo $backUrl;?>">返回</a>上一页!</span>
                <span>或
                    <?php } ?>
                    <a class="a1" href="/site/userIndex">进入个人管理中心</a></span></div>
        </div>
        <img alt="" class="right-img" src="<?=IMAGE_URL; ?>/loginpic.png">
    </div>
</div>
<script type="text/javascript" language="javascript">
var i=6;
function change_text(){
    if(i<1){
        i=1;
    }
    if(i==1){
        location.href='<?php echo $backUrl;?>';
    }
    i--;
    $('#time_count').html(i);
    window.setTimeout(change_text,1000);
}
change_text();
</script>