<script type="text/javascript">
document.domain = "<?=JS_DOMAIN?>";
var parameter_<?=$items["swfObjectId"]?> = <?=json_encode($items)?>;
function changePanoXml(xml){
    window.frames["<?=$items['swfObjectId']?>"].clickChangePano(xml);
}
</script>
<iframe src="<?=PIC_URL?>/site/index/swfObjectId/<?=$items["swfObjectId"]?>" name="<?=$items['swfObjectId']?>" id="<?=$items['swfObjectId']?>" width="100%" height="100%" frameborder="0" scrolling="no"></iframe>

