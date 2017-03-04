<?php
$this->breadcrumbs=array(
        '房源设优',
);
?>
<style type="text/css">
    .manage_rightfoutbox table td span{color:red;}
</style>

<div class="msg">
    <strong>优质房源说明：</strong><br />
    1、房源标题醒目、重点突出、有意义。<br />
    2、房源描述大于30字，原创、非拷贝，对房源租售有正面积极影响，描述格式规整。<br />
    3、至少3张高清房源内景图+1张房型图+1张外景图。<br />
    4、价格合理。<br />
    5、房源标题图已设定并清晰可见。
</div>
<div class="htit">优质房源</div>
<div class="jifentit">
    <span class="fygl2">写字楼： 已设优<?=$numInfo["officeNum"]?>条(共可设优<?=$maxNum?>条)</span>
    <span class="fygl2">商铺：	已设优<?=$numInfo["shopNum"]?>条(共可设优<?=$maxNum?>条)</span>
    <span class="fygl2">住宅：	已设优<?=$numInfo["zhuzhaiNum"]?>条(共可设优<?=$maxNum?>条)</span>
</div>
<div class="htguanl">
    <ul>
        <li class="<?=$type==""?"clk":""?>"><a href="<?=Yii::app()->createUrl("/manage/applyhighsource/index")?>"><strong>所有房源</strong></a></li>
        <li class="<?=$type=="1"?"clk":""?>"><a href="<?=Yii::app()->createUrl("/manage/applyhighsource/index",array("type"=>1))?>"><strong>写字楼</strong></a></li>
        <li class="<?=$type=="2"?"clk":""?>"><a href="<?=Yii::app()->createUrl("/manage/applyhighsource/index",array("type"=>2))?>"><strong>商铺</strong></a></li>
        <li class="<?=$type=="3"?"clk":""?>"><a href="<?=Yii::app()->createUrl("/manage/applyhighsource/index",array("type"=>3))?>"><strong>住宅</strong></a></li>
    </ul>
    <div class="slct">
        <?=CHtml::dropDownList("type","",Applyhighsource::$ahs_type);?>
        <input onclick="openTip()" type="button" value="添加房源" />
    </div>
</div>

<div class="rgcont">
    <table cellspacing="0" cellpadding="0" border="0" class="table_01">
        <tr>
            <td class="ftit">房源标题</td>
            <td class="ftit">类型</td>
            <td class="ftit">状态</td>
        </tr>
<?php
            if($allInfo){
                foreach($allInfo as $value){
                    $this->renderPartial('_list',array("value"=>$value));
                }
            }else{
        ?>
        <tr>
            <td colspan="3">您还未设置任何优质房源！</td>
        </tr>
<?php } ?>
    </table>
</div>

<div id="newDiv" style="display:none;position: fixed;width: 650px;height: 570px;padding: 2px;background-color:white; ">
    <iframe width="650px" height="570px" frameborder="0" scrolling="no" src=""></iframe>
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
function openTip(){
    var type = $("#type").val();
    $("#newDiv").children("iframe").attr("src","/manage/applyhighsource/choosesource/type/"+type);
    $("#newDiv").overlay().load();
}
function closetip(){
    $("#newDiv").overlay().close();
}
function showMsg(obj){
    var msg = $(obj).children("font").html()
    alert(msg);
}
function unSetSource(id){
    if(confirm("确定要取消此优质房源标签吗？")){
        $.ajax({
           type: "GET",
           url: "<?php echo Yii::app()->createUrl('/manage/applyhighsource/unsetsource');?>",
           data:{"id":id},
           async: false,
           success:function(msg){
               if(msg=="success"){
                    alert("取消成功！");
                    window.parent.location.reload();
               }else{
                    alert(msg);
               }
           }
        });
    }
}
</script>