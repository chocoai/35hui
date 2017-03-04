<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('/js/swfobject.js', CClientScript::POS_HEAD);
?>

<?php
if($role=="2"){
    $this->breadcrumbs=array('修改头像');
    $this->renderPartial('_head');
}elseif($role=="3"){
    $this->breadcrumbs=array('修改logo');
    $this->renderPartial('_comhead');
}elseif($role=="1"){
    $this->breadcrumbs=array('修改头像');
    $this->renderPartial('_perhead');
}
?>

<div class="rgcont" style="border: 1px solid #CCC;height: 450px;">
    <div class="thrtlf">
        <div id="flashContent" style="width: 100%; height: 100%;"></div>
    </div>
    <div class="thrtrt">
            <h6>请严格遵守头像上传要求： </h6>
            <p> 1. 本人半身正面相片，请勿带帽，比例适中。</p>
            <p>2. 着正装，西服或者衬衫，男士最好能系领带。</p>
            <p>3. 相片清晰，不模糊。</p>
            <p>4. 背景色为白色或者灰色等浅色调，请勿以Logo墙或者景点为背景。</p>
            <p>5. 请勿加印公司水印 </p>
            <h6>示例展示：</h6>
            <div style=" padding: 10px 0 0 20px"><img src="../../images/jjrpic.gif"></div>
    </div>
</div>
<script type="text/javascript" language="javascript">
var swfVersionStr = "10.0.0";
var flashvars = {};
flashvars.type = "<?=$type?>";
flashvars.saveUrl = "/manage/imageinfo/saveheadpic";
flashvars.oldHead = "<?=$userHead?>";
var params = {};
params.quality = "high";
params.allowscriptaccess = "always";
params.allowfullscreen = "true";
params.wmode = "transparent";
var attributes = {};
attributes.id = "flashContent";
attributes.name = "flashContent";
swfobject.embedSWF(
    "/images/avatar_1.1.swf", "flashContent",
    470,420,
    swfVersionStr, "",
    flashvars, params, attributes);
</script>