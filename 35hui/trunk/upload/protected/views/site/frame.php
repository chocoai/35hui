<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('/js/swfobject.js', CClientScript::POS_HEAD);
?>
<div id="flashContent" style="width: 100%; height: 100%; background-color: black"></div>
<script type="text/javascript" language="javascript">
document.domain = "<?=JS_DOMAIN?>";
var swfVersionStr = "10.0.0";
var xiSwfUrlStr = "<?=PIC_URL?>/pano/playerProductInstall.swf";
var flashvars = {};
flashvars.autoPlay = "true";
flashvars.panoId = "<?=$panoId?>";
flashvars.panoDomain = "<?=PIC_URL?>/panorama";
var params = {};
params.quality = "high";
params.allowscriptaccess = "always";
params.allowfullscreen = "true";
params.wmode = "transparent";
var attributes = {};
attributes.id = "panoPlayer";
attributes.name = "panoPlayer";
attributes.swLiveConnect= "true";
swfobject.embedSWF(
    "<?=PIC_URL?>/pano/preViewPlayer.swf", "flashContent",
    700,400,
    swfVersionStr, xiSwfUrlStr,
    flashvars, params, attributes);

</script>