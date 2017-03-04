<?php
$this->breadcrumbs=array(
	'优质房源申请',
);
$this->currentMenu = 108;
$templete = array(
    "0"=>"您没有达到规定的图片数目。不能设置优房源！",
    "1"=>"您的描述文字不符合要求。不能设置优房源！",
);
?>

<h1>优质房源申请</h1>
<?php if(Yii::app()->user->hasFlash('message')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('message'); ?>
    </div>
<?php endif; ?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/overlay.min.js"></script>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/toolbox.expose.min.js"></script>
<div style="display:none;position: fixed;width: 400px;height: 250px;border: 1px solid #000000;padding: 5px;background-color:#EFEFEF;" id="showTip">
    <form action="/applyhighsource/audit" method="get" onsubmit="return checkInput()">
        <input type="hidden" name="id" value="" id="id" />
        <div style="float:right"><img onClick="closetip('showTip')" src="<?php echo IMAGE_URL."/3.gif";?>"/></div>
        <div>不通过原因：
            <textarea rows="5" cols="50" id="message" name="message"></textarea>
            <div>
                <?=CHtml::radioButtonList("templete","",$templete,array("labelOptions"=>array("onClick"=>"changeValue(this)")))?>
            </div>
            <div style="float:right;padding-right: 30px">
                <input type="submit" value="确定"/>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
$("#showTip").overlay({
    top:'center',
    mask: {
		color: '#111111',
		loadSpeed: 200,
		opacity: 0.5
	},
    closeOnClick: false
});

function showtip(id){
    $("#id").val(id);
    $("#showTip").overlay().load();
    if($("#showTip").css('display')=='none'){
       $("#showTip").css('display','block');
    }
}
function closetip(id){
    $("#"+id).overlay().close();
    if($("#"+id).css('display')=='block'){
       $("#"+id).css('display','none');
    }
}
function changeValue(obj){
    var value = $(obj).html();
    $("#message").val(value);
}
function checkInput(){
    var message = $("#message").val();
    if(message==""){
        alert("请填写未通过原因！")
        return false;
    }
    return true;
}
</script>