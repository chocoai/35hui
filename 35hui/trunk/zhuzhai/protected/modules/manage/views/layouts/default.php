<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="/css/umanage.css" rel="stylesheet" type="text/css" />
        <title>新地标后台管理系统</title>
        <?php
        Yii::app()->clientScript->registerCoreScript('jquery');
        ?>
    </head>
    <body>
        <div class="header">
            <div class="logo"><a href="<?=DOMAIN?>" target="_blank">&nbsp;</a></div>
            <div class="head">
                <div class="welcome">    
                   <div class="weright"><?=CHtml::link("首页",DOMAIN,array("target"=>"_blank"));?>|<?=CHtml::link("论坛",BBS_DOMAIN,array("target"=>"_blank"));?>|<span>客服热线：400-820-9181</span>|<?=CHtml::link('安全退出',array('/site/logout'));?></div>
                    <div class="weleft"><?php echo CHtml::link(Yii::app()->user->name,array('/manage')); ?>,您好！</div>               
                </div>
            </div>
        </div>
        <div class="container">
            <div class="leftside">
                <?php $this->renderPartial('/common/leftmenu'.Yii::app()->user->role); ?>
            </div>
            <div class="rightside">
                <iframe src="<?=$this->defaultCenterAction?>" frameborder="no" scrolling="no" id= "frame" width="100%"  height="100%" name="frame"></iframe>
            </div>
            <?php $this->renderPartial('/common/_footer'); ?>
            <div id="newDiv" style="display:none;position: fixed;width: 640px;height: 570px;padding: 2px;background-color:white;">
                <iframe width="100%" height="100%" frameborder="0" src=""></iframe>
            </div>
            <script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/overlay.min.js"></script>
            <script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/toolbox.expose.min.js"></script>
            <script type="text/javascript">
                $("#newDiv").overlay({
                    top:'center',
                    mask: {
                        color: '#111111',
                        loadSpeed: 200,
                        opacity: 0.5
                    },
                    closeOnClick: false
                });
                function openTip(url,width,height){
                    $("#newDiv iframe").attr("src",url);
                    $("#newDiv").css("width",width);
                    $("#newDiv").css("height",height);
                    $("#newDiv").overlay().load();
                }
                function openTipContent(content,width,height){
                    $("#newDiv").html(content);
                    $("#newDiv").css("width",width);
                    $("#newDiv").css("height",height);
                    $("#newDiv").overlay().load();
                }
                //传递参数为true表示关闭的同时要刷新frame页面
                function closeTip(refeach){
                    $("#newDiv").overlay().close();
                    $("#newDiv").html('<iframe width="100%" height="100%" frameborder="0" src=""></iframe>');
                    if(refeach==true){
                        window.frames["frame"].location.reload();
                    }
                }
                function frameLocation(url){
                    closeTip();
                    window.frames["frame"].location = url;
                }
            </script>
        </div>
    </body>
</html>
