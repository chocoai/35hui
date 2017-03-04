<?php
$this->breadcrumbs=array(
	'意见管理'=>array('index'),
	$model->mr_id,
);

$this->menu=array(
	array('label'=>'查看所有意见', 'url'=>array('index')),
    array('label'=>'管理意见', 'url'=>array('admin')),
);
$msgtemplate = array(
   '1'=>"感谢您对网站推广的积极配合与大力支持，您的宝贵意见我们已经采纳",
   '2'=>"您的宝贵意见我们已经采纳，欢迎继续关注新地标全景看房",
);
$template = array(
    1=>"您对网站推广的积极配合与大力支持",
);
?>
<?php if(Yii::app()->user->hasFlash('message')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('message'); ?><br />
        答复内容：<br />
        <?php if(Yii::app()->user->hasFlash('reply')): ?>
            <?php echo Yii::app()->user->getFlash('reply'); ?><br />
        <?php endif; ?>
        消息内容：<br />
        <?php if(Yii::app()->user->hasFlash('message1')): ?>
            <?php echo Yii::app()->user->getFlash('message1'); ?><br />
        <?php endif; ?>
        <?php if(Yii::app()->user->hasFlash('message2')): ?>
                <?php echo Yii::app()->user->getFlash('message2'); ?><br />
        <?php endif; ?>
    </div>
<?php endif; ?>
<h1>查看意见 ID:<?php echo $model->mr_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        array(
            'name'=>'mr_content',
            'value'=>$model->mr_content
        ),
        array(
            'name'=>'mr_replay',
            'value'=>$model->mr_replay
        ),
	),
));
if(!$model->mr_replay){
?>
<h3>意见受理</h3>
<form action="" method="post" onsubmit="return checkForm()">
<div style="clear:both">
    内容模板：<br /><?=CHtml::radioButtonList("msgtemplate",'',$msgtemplate,array("onClick"=>"changeMsgTemplate(this)"))?><br />
    答复内容：<br /><textarea id="mr_replay" name="mr_replay" cols="50" rows="4"></textarea>
</div><br />
<h3>意见奖励</h3>
    <div id="type">赠送类型：<?=CHtml::radioButtonList("type",1,array(0=>"不奖励",1=>"全部","2"=>"只送积分","3"=>"只送商务币"),array("separator"=>"","onClick"=>"changeType(this)"))?></div>
    <div id="msgall">
        <div style="width:auto;float: left">
            <font id="msg_1">消息：由于</font><input type="text" name="reason" id="reason" style="width:300px"/>
            <font id="msg_2">，系统奖励</font>
        </div>
        <div id="div_point" style="width:auto;float: left;"><input type="text" name="point" id="point" style="width:50px" />积分</div>
        <div id="div_money" style="width:auto;float: left;"><input type="text" name="money" id="money" style="width:50px"/>商务币</div>
        <br /><br />
    </div>
    <div style="clear:both" id="msgtem">
        消息模板：<br /><?=CHtml::radioButtonList("template",'',$template,array("onClick"=>"changeTemplate(this)"))?><br />
        <br />
    </div>
    <div><input type="submit" value="处理" /></div>
</form>
<script type="text/javascript">
function changeType(obj){
    var value = $(obj).val();
    if(value==0){
        $("#msgall").css("display","none");
        $("#msgtem").css("display","none");
    }else if(value==1){
        $("#div_point").css("display","inline");
        $("#div_money").css("display","inline");
         $("#msgall").css("display","inline");
        $("#msgtem").css("display","inline");
    }else if(value==2){
        $("#div_point").css("display","inline");
        $("#div_money").css("display","none");
         $("#msgall").css("display","inline");
        $("#msgtem").css("display","inline");
    }else{
        $("#div_point").css("display","none");
        $("#div_money").css("display","inline");
         $("#msgall").css("display","inline");
        $("#msgtem").css("display","inline");
    }
}
function changeTemplate(obj){
    var html = $(obj).next("label").html();
    $("#reason").val(html);
}
function changeMsgTemplate(obj){
    var html = $(obj).next("label").html();
    $("#mr_replay").val(html);
}
function checkForm(){
    var type = $("form #type input:checked").val();
    if(type != 0){
        var reason = $("form #reason").val();
        if(reason==""){
            alert("请填写原因！");
            return false;
        }
    }
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
    }else if(type==3){
        if(!money_check){
            alert("请填写商务币！");
            return false;
        }
    }
    if(!$("#mr_replay").val()){
        alert("请填写答复内容！");
        return false;
    }
    return true;
}
</script>
<?php }

