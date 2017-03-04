<?php
$this->breadcrumbs=array(
        "赠送积分和商务币"
);
$this->currentMenu = 1;
$template = array(
    1=>"您对网站推广的积极配合与大力支持",
    2=>"您发布了很多全景房源",
);
?>
<?php if(Yii::app()->user->hasFlash('message')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('message'); ?>
        消息内容：<br />
        <?php if(Yii::app()->user->hasFlash('message1')): ?>
            <?php echo Yii::app()->user->getFlash('message1'); ?><br />
        <?php endif; ?>
        <?php if(Yii::app()->user->hasFlash('message2')): ?>
                <?php echo Yii::app()->user->getFlash('message2'); ?><br />
        <?php endif; ?>
    </div>
<?php endif; ?>


<form action="" method="post" onsubmit="return checkForm()">
    接收者：<?=$name?><br />
    <div id="type">赠送类型：<?=CHtml::radioButtonList("type",1,array(1=>"全部","2"=>"只送积分","3"=>"只送商务币"),array("separator"=>"","onClick"=>"changeType(this)"))?></div>
    <div>
        <div style="width:auto;float: left">
            <font id="msg_1">消息：由于</font><input type="text" name="reason" id="reason" style="width:300px"/>
            <font id="msg_2">，系统奖励</font>
        </div>
        <div id="div_point" style="width:auto;float: left;"><input type="text" name="point" id="point" style="width:50px" />积分</div>
        <div id="div_money" style="width:auto;float: left;"><input type="text" name="money" id="money" style="width:50px"/>商务币</div>
    </div>
    <div style="clear:both">
        消息模板：<br /><?=CHtml::radioButtonList("template",'',$template,array("onClick"=>"changeTemplate(this)"))?><br />
        <br /><input type="submit" value="赠送" />
    </div>
</form>
<script type="text/javascript">
function changeType(obj){
    var value = $(obj).val();
    if(value==1){
        $("#div_point").css("display","inline");
        $("#div_money").css("display","inline");
    }else if(value==2){
        $("#div_point").css("display","inline");
        $("#div_money").css("display","none");
    }else{
        $("#div_point").css("display","none");
        $("#div_money").css("display","inline");
    }
}
function changeTemplate(obj){
    var html = $(obj).next("label").html();
    $("#reason").val(html);
}
function checkForm(){
    var reason = $("form #reason").val();
    if(reason==""){
        alert("请填写原因！");
        return false;
    }
    var type = $("form #type input:checked").val();
    var point = $("form #point").val();
    var point_check = 1;
    if(point==""||isNaN(point)){
        point_check = 0;
    }
    var money = $("form #money").val();
    var money_check = 1;
    if(money==""||isNaN(money)){
        money_check = 0;
    }
    if(type==1){//全部
        if(!money_check||!point_check){
            alert("请填写积分和商务币！");
            return false;
        }
    }else if(type==2){//积分
        if(!point_check){
            alert("请填写积分！");
            return false;
        }
    }else{
        if(!money_check){
            alert("请填写商务币！");
            return false;
        }
    }
    return true;
}
</script>