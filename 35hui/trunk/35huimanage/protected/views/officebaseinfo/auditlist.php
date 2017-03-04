<?php
$this->breadcrumbs=array(
	'房源管理',
    '房源审核'
);
$this->currentMenu = 38;
?>
<table width="100%" style="margin: 0px">
    <tr>
        <th width="40%">房源标题</th>
        <th width="10%">用户Id</th>
        <th width="8%">用户</th>
        <th width="7%">租售</th>
        <th width="20%">套餐类型</th>
        <th>操作</th>
    </tr>
</table>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$model->getUnAuditSource(),
    'itemView'=>'_auditlist',
    'summaryText'=>'',
    'summaryCssClass'=>'',
));
?>
<div style="display:none" id="showTip">
    <form action="#" id="auditform">
        <div style="float:right"><img onClick="closetip()" src="<?php echo IMAGE_URL."/3.gif";?>"/></div>
        <div>
            <input type="hidden" name="auditofficeid" id="auditofficeid" />
            是否优质：<input type="checkbox" name="ot_ishigh" id="ot_ishigh" onclick="showPoint(this)"/>是<br />
            <div id="sendpoint" style="display:none">
                请选择要赠送的积分和商务币数:
                <input type="radio" name="point" value="1" checked/>1点&nbsp;
                <input type="radio" name="point" value="2" />2点&nbsp;
                <input type="radio" name="point" value="3" />3点&nbsp;
                <input type="radio" name="point" value="4" />4点&nbsp;
            </div>
            <input type="button" value="确定" onclick="pass()" />
        </div>
    </form>
</div>
<div style="display:none" id="showTip2">
    <form action="#" id="illegalreason">
        <div style="float:right"><img onClick="closetip()" src="<?php echo IMAGE_URL."/3.gif";?>"/></div>
        <div>
            <input type="hidden" name="auditofficeid" id="illegalofficeid" />
            违规原因：<textarea name="illegalreason" cols="40" rows="5"></textarea>
            <input type="button" value="确定" onclick="unPass()" />
        </div>
    </form>
</div>
<script type="text/javascript">
    function showPoint(obj){
        if(obj.checked){
            $("#sendpoint").css("display","block");
        }else{
            $("#sendpoint").css("display","none");
        }
    }
function pass(){
    var data = $("#auditform").serialize();
    $.ajax({
        url:"<?php echo Yii::app()->createUrl("/officebaseinfo/audit") ?>",
        type:"GET",
        data:data+"&type=pass",
        success:function(){
            window.location.reload();
        }
    })
}
function unPass(){
    var data = $("#illegalreason").serialize();
    $.ajax({
        url:"<?php echo Yii::app()->createUrl("/officebaseinfo/audit") ?>",
        type:"GET",
        data:data+"&type=unpass",
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
    $("#showTip2").css("width","450px");
    $("#showTip2").css("height","150px");
    $("#showTip2").css("top","160px");
    $("#showTip2").css("left",(parseInt(document.body.scrollWidth) - 300) / 2 + "px");
    $("#showTip2").css("background","white");
    $("#showTip2").css("border","1px solid #860001");
    $("#showTip2").css("padding","5px");
    HidTip();
}
//审核通过
function audit(id){
    $("#auditofficeid").val(id);
    $("#showTip").css("display","block");
    $("#showTip").css("zIndex","9999");
    $("#showTip").css("position","absolute");
    $("#showTip").css("width","200px");
    $("#showTip").css("height","150px");
    $("#showTip").css("top","160px");
    $("#showTip").css("left",(parseInt(document.body.scrollWidth) - 300) / 2 + "px");
    $("#showTip").css("background","white");
    $("#showTip").css("border","1px solid #860001");
    $("#showTip").css("padding","5px");
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
    $("#showTip").css("display","none");
    $("#showTip2").css("display","none");
}
</script>