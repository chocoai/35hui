<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('/js/pano.js', CClientScript::POS_HEAD);
?>
<script type="text/javascript">
<!--
function getFlashMovie(movieName) {
    var isIE = navigator.appName.indexOf("Microsoft") != -1;
    return (isIE) ? window[movieName] : document[movieName];
}
if ((window.p2q_Version) && (window.p2q_Version>=2.0)) {
    var flashvars="";
    // enable javascript interface
    flashvars += "panorama=" + escape('<?=$panorama?>')+"&";
    flashvars +="externalinterface=1";
    p2q_EmbedFlashId("pano",'/pano/mainplay.swf','700','300','allowFullScreen','true','FlashVars',flashvars);
    if (!DetectFlashVer(9,0,0)) {
        document.write('<p class="warning">This content requires Adobe Flash Player Version 9 or higher. '
                     + '<a href="http://www.adobe.com/go/getflash/">Get Flash<\/a><\/p>');
    }
} else {
    document.writeln('<p class="warning">p2q_embed_object.js is not included or it is too old!');
    document.writeln(' Please copy this file into your html directory.<\/p>');
}
function showPan(pan, tilt, fov){
    $("#pan").html(parseInt(pan));
    $("#tilt").html(parseInt(tilt));
    $("#fov").html(parseInt(fov));
}
//-->
</script>
<noscript>
    <p class="warning">Please enable Javascript!</p>
</noscript>
<div style="width: 100%;margin-top: 15px">
    <div style="width: 200px;float: left">平移：<font id="pan"><?=$start_pan?></font></div>
    <div style="width: 200px;float: left">俯仰：<font id="tilt"><?=$start_tilt?></font></div>
    <div style="width: 200px;float: left">缩进：<font id="fov"><?=$start_fov?></font></div>
    <a onClick="showPan(pano.getPan(),pano.getTilt(),pano.getFov())" href="#">查看当前参数</a>
</div>
