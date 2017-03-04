<?php
$this->breadcrumbs=array(
	$prevNavigation[0]['title']=>$prevNavigation[0]['value'],
	$prevNavigation[1]['title']=>$prevNavigation[1]['value'],
    Picture::$typeDescription[$picType],
);
$this->pageTitle = Picture::$typeDescription[$picType];
?>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl; ?>/css/scrollable-horizontal.css" />
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl; ?>/css/global.css" />
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl; ?>/css/lou.css" />
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/jquery.tools.min.js"></script>
<style type="text/css">
.scrollable {
	border:1px solid #ccc;
	background:url(<?=Yii::app()->request->baseUrl?>/tools/img/scrollable/h300.png) repeat-x;
}
</style>
<div style="width:1000px;height:560px;background-color: white;">
    <div id="image_wrap">
        <img alt="<?=$prevNavigation[1]['title']?>" src="http://static.flowplayer.org/tools/img/blank.gif" width="546" height="364" />
    </div>
    <div style="width:765px;height: 130px;margin-left: auto;margin-right: auto;">
        <a class="prev browse left disabled"></a>
        <div class="scrollable" style="width:680px;height:120px;margin-left: auto;margin-right: auto;">
            <div class="items">
            <?php
                foreach($picArray as $key=>$picture){
            ?>
                <img alt="<?=$prevNavigation[1]['title']?>" i="<?=$key?>" src="<?=$picture['tiny']?>">
            <?
                }
            ?>
            </div>
        </div>
        <a class="next browse right"></a>
    </div>
</div>
<script type="text/javascript" language="javascript">
    var picArray = <?=json_encode($picArray)?>;
    $(".scrollable").scrollable({
        keyboard:true
    });
    var index = ":first";
    <?
        if($pId){
    ?>
        index = "[i='<?=$pId?>']";
    <?
        }
    ?>
    $(".items img").click(function() {

        // see if same thumb is being clicked
        if ($(this).hasClass("active")) { return; }

        // calclulate large image's URL based on the thumbnail URL (flickr specific)
        var i = $(this).attr("i");
        var url = picArray[i]['large'];
        //var url = $(this).attr("src").replace("_t", "");

        // get handle to element that wraps the image and make it semi-transparent
        var wrap = $("#image_wrap").fadeTo("medium", 0.5);

        // the large image from www.flickr.com
        var img = new Image();


        // call this function after it's loaded
        img.onload = function() {

            // make wrapper fully visible
            wrap.fadeTo("fast", 1);

            // change the image
            wrap.find("img").attr("src", url);

        };

        // begin loading the image from www.flickr.com
        img.src = url;

        // activate item
        $(".items img").removeClass("active");
        $(this).addClass("active");

    // when page loads simulate a "click" on the first image
    }).filter(index).click();
</script>