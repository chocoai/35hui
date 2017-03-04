<?php
$this->breadcrumbs=array(
	'Subways',
);

$this->menu=array(
	array('label'=>'创建站点', 'url'=>array('create')),
	array('label'=>'管理数据', 'url'=>array('admin')),
);
?>


<?php
$array = array();
$frameurl = Yii::app()->createUrl("/map/framemap",$array);
?>
<iframe id="framemap" name="framemap" src="<?=$frameurl;?>" width="100%" height="500px" frameborder="0" scrolling="no"></iframe>

<form action="/subway/updateposition" target="savePosition" method="post">
    <table width="100%">
        <tr>
            <th width="10%"><font id="lineName">1号线</font></th>
            <td width="15%">站台：<font id="stationname"></font></td>
            <td width="35%">X坐标：<input type="text" name="sw_x" readonly="true" id="Systembuildinginfo_sbi_x" size="15"/></td>
            <td width="35%">Y坐标：<input type="text" name="sw_y" readonly="true" id="Systembuildinginfo_sbi_y" size="15"/></td>
            <td><input type="submit" value="修改" /></td>
        </tr>
    </table>
    <input type="hidden" name="stationid" value="" id="stationid" />
</form>
<iframe id="savePosition" name="savePosition" style="display: none"></iframe>
<div id="line">
<?php
if($line){
    foreach($line as $value){
        echo CHtml::link($value->sw_stationname,"#",array("onClick"=>"changeLine('".$value->sw_id."','".$value->sw_stationname."')"))."&nbsp;&nbsp;";
    }
}
?>
</div>
<br />
<div id="station" style="line-height: 30px;">
<?php
if($line){
    $station = Subway::model()->getAllByParentId($line[0]['sw_id']);
    if($station){
        foreach($station as $value){
            echo CHtml::link($value->sw_stationname,"#",array("onClick"=>"changeToStation(".$value->sw_id.")"))."&nbsp;&nbsp;";
        }
    }
}
?>
</div>

<script type="text/javascript">
    function changeLine(id, name){
        $("#lineName").html(name);
        $.ajax({
            url :"/subway/getallstation",
            type : "GET",
            data: {"id":id},
            success: function(msg) {
                var msg = eval("("+msg+")");
                $("#station").html("");
                for(var i=0;i<msg.length;i++){
                    var html = "<a href='#' onClick='changeToStation("+msg[i]['sw_id']+")'>"+msg[i]['sw_stationname']+"</a>&nbsp;&nbsp;";
                    $("#station").append(html);
                }
            }
        });
    }
    function changeToStation(id) {
        $.ajax({
            url :"/subway/getstationinfo",
            type : "GET",
            data: {"id":id},
            success: function(msg) {
                var msg = eval("("+msg+")");
                $("#stationid").val(msg['sw_id']);
                $("#stationname").html(msg['sw_stationname']);
                $("#Systembuildinginfo_sbi_x").val(msg['sw_x']);
                $("#Systembuildinginfo_sbi_y").val(msg['sw_y']);
                if(msg['sw_x']&&msg['sw_y']){
                    window.frames['framemap'].addPoint(msg['sw_x'],msg['sw_y'],msg['sw_stationname']);
                }else{
                    var center = window.frames['framemap'].mapObj.getCenter();//当前中心点坐标
                    window.frames['framemap'].addPoint(center.lngX,center.latY,msg['sw_stationname']);
                }
            }
        });
    }
    function saveSuccess(){
        alert("保存成功");
    }
</script>