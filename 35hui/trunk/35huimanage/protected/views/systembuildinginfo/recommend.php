<?php
$this->breadcrumbs=array(
	'房源管理',
    '推荐管理',
    '楼盘推荐',
);
$this->currentMenu = 48;
?>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/overlay.min.js"></script>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/toolbox.expose.min.js"></script>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider_5,
    'itemView'=>'_recommend',
    'summaryText'=>'',
    'summaryCssClass'=>'',
    "viewData"=>array("type"=>1)
));
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider_9,
    'itemView'=>'_recommend',
    'summaryText'=>'',
    'summaryCssClass'=>'',
    "viewData"=>array("type"=>2)
));
?>
<div id="newDiv" style="display:none;position: fixed;width: 650px;height: 500px;border: 1px solid #860001;padding: 5px;background-color:#EFEFEF; "></div>
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

function buyposition(pgid,type) {
    var link = "<?php echo Yii::app()->createUrl('/systembuildinginfo/sourceframe');?>";
    if(type==2){
        link += '/tab/shop';
    }
    link = link+"/pgid/"+pgid;
    var html = '<div><div style="float:right"><img onClick="closetip()" src="<?php echo IMAGE_URL."/3.gif";?>"/></div>';
    html += "<iframe src='"+link+"' width='650px' height='480px' frameborder='no'/>";
    html += "</div>";

    $("#newDiv").html(html);
    $("#newDiv").overlay().load();

}
function closetip(){
    $("#newDiv").overlay().close();
}
function unbuyposition(pgid){
    $.ajax({
       type: "GET",
       url: "<?php echo Yii::app()->createUrl('/officebaseinfo/undoproduct');?>",
       data:"pgid="+pgid,
       async: false,
       success:function(msg){
            alert("取消成功");
            window.parent.location.reload();
       }
    });
}
</script>