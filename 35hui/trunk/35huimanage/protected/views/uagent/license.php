<?php
$this->breadcrumbs=array(
	'会员管理',
    '经纪人管理',
    '运营认证'
);
$this->currentMenu = 39;
?>
<table width="100%" style="margin: 0px" >
    <tr>
        <th width="10%">ID</th>
        <th width="10%">用户Id</th>
        <th width="30%"></th>
        <th width="15%">真实姓名</th>
        <th width="15%">电话号码</th>
        <th >审核状态</th>
    </tr>
</table>

<?php
//$this->widget('zii.widgets.CListView', array(
//    'dataProvider'=>$dataProvider,
//    'itemView'=>'_licenseview',
//    'summaryText'=>'',
//    'summaryCssClass'=>'',
//));
?>
<div style="display:none" id="showTip">
    <form action="#" id="auditform">
        <div style="float:right"><img onClick="closetip()" src="<?php echo IMAGE_URL."/3.gif";?>"/></div>
        <div>
            <input type="hidden" name="ua_id" id="uagentid" />
            营业执照：<input type="text" name="ua_comid" id="ua_comid" /><br />
            <input type="button" value="确定" onclick="pass()" />
        </div>
    </form>
</div>
<script type="text/javascript">
/**
 * 用户审核
 */
function audit(check,id){
    if(check=="1"){//通过。通过需要填写编号
        HidTip(id);
    }else{//未通过
        $.ajax({
            url:"<?php echo Yii::app()->createUrl("/uagent/auditlicense") ?>",
            type:"GET",
            data:"id="+id+"&check="+check,
            success:function(){
                window.location.reload();
            }
        })
    }
}
function pass(){
    var id = $("#uagentid").val();
    var comid = $("#ua_comid").val();
    if(comid==""){
        alert("请输入执照编号");
        return ;
    }
    $.ajax({
        url:"<?php echo Yii::app()->createUrl("/uagent/auditlicense") ?>",
        type:"GET",
        data:"id="+id+"&check=1&comid="+comid,
        success:function(){
            window.location.reload();
        }
    })
}
var docEle = function() {return document.getElementById(arguments[0]) || false;}
function HidTip(id) {
    $("#uagentid").val(id);
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
}
</script>