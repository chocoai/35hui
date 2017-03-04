<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('/js/swfobject.js', CClientScript::POS_HEAD);
?>
<div id="flashContent" style="width: 100%; height: 100%; background-color: black"></div>
<script type="text/javascript" language="javascript">
document.domain = "<?=JS_DOMAIN?>";
var flashParameter = window.parent.parameter_<?=$swfObjectId?>;
var swfVersionStr = "10.0.0";
var xiSwfUrlStr = "<?=PIC_URL?>/pano/playerProductInstall.swf";
var flashvars = {};
flashvars.autoPlay = flashParameter.autoPlay?"true":"false";
flashvars.mainXml = flashParameter.mainXml;
flashvars.backgroundImg = flashParameter.backgroundImg;
//flashvars.panoId = flashParameter.panoId;
//flashvars.panoDomain = flashParameter.panoDomain;
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
    "<?=PIC_URL?>/pano/panoPlayer_1.4.swf", "flashContent",
    flashParameter.width,flashParameter.height,
    swfVersionStr, xiSwfUrlStr,
    flashvars, params, attributes);

function clickChangePano(xml){
    getSWF("panoPlayer").changePanoXml(xml);
}
function getSWF(movieName){
   if (navigator.appName.indexOf("Microsoft") != -1){
       return window[movieName]
   }
   else {
       return document[movieName]
   }
}
</script>