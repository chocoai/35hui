<?php
$this->breadcrumbs=array(
	'房源管理',
    '违规处理'
);
$this->currentMenu = 50;

?>

<h1>违规处理</h1>
<table>
    <tr>
        <td width="5%">Id</td>
        <td width="10%">被举报者</td>
        <td width="10%">被举报的房源</td>
        <td width="20%">举报类型</td>
        <td width="10%">房源类型</td>
        <td width="10%">举报者(会员)</td>
        <td width="10%">举报者</td>
        <td>举报时间</td>
        <td width="10%">&nbsp;</td>
    </tr>
</table>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
<div style="display:none" id="showTip2">
    <form action="#" id="illegalreason">
        <div style="float:right"><img onClick="closetip()" src="<?php echo IMAGE_URL."/3.gif";?>"/></div>
        <div>
            <input type="hidden" name="id" id="illegalofficeid" />
            违规原因：<textarea name="illegalreason" cols="40" rows="5"></textarea>
            <input type="button" value="确定" onclick="report()" />
        </div>
    </form>
</div>

<script type="text/javascript">
function report(){
    var data = $("#illegalreason").serialize();
    $.ajax({
        url:"<?php echo Yii::app()->createUrl("/report/update") ?>",
        type:"GET",
        data:data,
        success:function(){
            window.location.reload();
        }
    })
}
function report_illegal(id){
    var data = 'id='+id+'&type=legal';
    $.ajax({
        url:"<?php echo Yii::app()->createUrl("/report/update") ?>",
        type:"GET",
        data:data,
        success:function(){
            window.location.reload();
        }
    })
}
//违规原因
function illegal(id){
    $("#illegalofficeid").val(id);
    $("#showTip2").css("display","block");
    $("#showTip2").css("zIndex","9999");
    $("#showTip2").css("position","absolute");
    $("#showTip2").css("width","400px");
    $("#showTip2").css("height","150px");
    $("#showTip2").css("top","160px");
    $("#showTip2").css("left",(parseInt(document.body.scrollWidth) - 300) / 2 + "px");
    $("#showTip2").css("background","white");
    $("#showTip2").css("border","1px solid #860001");
    $("#showTip2").css("padding","5px");
    HidTip();
}
var docEle = function() {return document.getElementById(arguments[0]) || false;}
function HidTip() {
    var m = "mask";
    if (docEle(m)) document.removeChild(docEle(m));
    // mask图层
    var newMask = document.createElement("div");
    newMask.id = m;
    newMask.style.position = "absolute";
    newMask.style.zIndex = "1";
    newMask.style.width = document.body.scrollWidth + "px";
    newMask.style.height = document.body.scrollHeight + "px";
    newMask.style.top = "0px";
    newMask.style.left = "0px";
    newMask.style.background = "#000";
    newMask.style.filter = "alpha(opacity=40)";
    newMask.style.opacity = "0.40";
    document.body.appendChild(newMask);
}
function closetip(){
    document.body.removeChild(docEle("mask"));
    $("#showTip2").css("display","none");
}
</script>