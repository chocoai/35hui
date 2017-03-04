<div id="leftmenu">
<h2>二手房浏览记录</h2>
<p><a href="<?php echo Yii::app()->createUrl('/manage/findcondition/myfindcondition/sr/2');?>" target="frame">我的买房条件</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/manage/housecollect/mycollect/sr/2');?>" target="frame">我的选房单</a></p>
<h2>租房浏览记录</h2>
<p><a href="<?php echo Yii::app()->createUrl('/manage/findcondition/myfindcondition/sr/1');?>" target="frame">我的租房条件</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/manage/housecollect/mycollect/sr/1');?>" target="frame">我的选房单</a></p>
<h2>账户信息</h2>
<p><a href="<?php echo Yii::app()->createUrl('/manage/user/perindex');?>" target="frame">用户信息</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/manage/user/changepwd');?>" target="frame">修改密码</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/manage/manage/viewIntegral');?>" target="frame">积分管理</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/manage/invite/index');?>" target="frame">邀请注册</a></p>
<h2>站点功能</h2>
<p><a href="<?php echo Yii::app()->createUrl('/manage/msg/receivebox');?>" target="frame">留言与公告</a></p>
<p><a href="<?php echo Yii::app()->createUrl('/manage/manage/showMsgrec');?>" target="frame">建议与意见</a></p>
<p><a href="/help" target="_blank">帮助中心</a></p>
</div>
<script type="text/javascript">
    $("#leftmenu a").click(function(){
        $("#leftmenu p").removeClass("clk");
        $(this).parent("p").addClass("clk");
    })
</script>
