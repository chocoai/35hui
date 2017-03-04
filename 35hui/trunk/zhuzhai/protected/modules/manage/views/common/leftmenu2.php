<div id="leftmenu">
<!--<h2>房源管理</h2>-->
<!--<p><a href="<?php// echo Yii::app()->createUrl('/manage/release/rent');?>" target="frame">发布出租房源</a></p>
<p><a href="<?php// echo Yii::app()->createUrl('/manage/release/sell');?>" target="frame">发布出售房源</a></p>
<p><a href="<?php// echo Yii::app()->createUrl('/manage/manage/rent');?>" target="frame">管理出租房源</a></p>
<p><a href="<?php// echo Yii::app()->createUrl('/manage/manage/sell');?>" target="frame">管理出售房源</a></p>-->
<h2>会员互动</h2>
<!--<p><a href="<?php// echo Yii::app()->createUrl('/manage/share/index');?>" target="frame">中介合作</a></p>-->
<p><a href="<?php echo Yii::app()->createUrl('/manage/manage/upattachment');?>" target="frame">楼盘文档</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/manage/correction/index');?>" target="frame">完善纠错</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/manage/quickrelease/index');?>" target="frame">业主委托</a></p>
<h2>账户信息</h2>
<p><a href="<?php echo Yii::app()->createUrl('/manage/user/index');?>" target="frame">用户信息</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/manage/user/changepwd');?>" target="frame">修改密码</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/manage/medal/index');?>" target="frame">我的勋章</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/manage/manage/viewIntegral');?>" target="frame">积分管理</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/manage/buycombo/index');?>" target="frame">推广方案</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/manage/invite/index');?>" target="frame">邀请注册</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/manage/exam/index');?>" target="frame">用户考试</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/manage/successinfo/index');?>" target="frame">成功案例</a></p>
<h2>店铺管理</h2>
<p><a href="<?php echo Yii::app()->createUrl('/manage/dianpu/gonggao');?>" target="frame">公告设置</a></p>
<h2>站点功能</h2>
<p><a href="<?php echo Yii::app()->createUrl('/manage/msg/receivebox');?>" target="frame">留言与公告</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/manage/manage/showMsgrec');?>" target="frame">建议与意见</a></p>
<!--<p><a href="/help" target="_blank">帮助中心</a></p>-->
</div>
<script type="text/javascript">
    $("#leftmenu a").click(function(){
        $("#leftmenu p").removeClass("clk");
        $(this).parent("p").addClass("clk");
    })
</script>
