<?
if($pictures){
?>
<p id="image_wrap"><img id="largeImg" alt="<?=$alt?>" src="<?=Yii::app()->baseUrl;?>/tools/img/scrollable/blank.gif" width="546" height="364" /></p>

<div class="thumbs">
    <a class="prev browse left disabled"></a>
    <div id="otherPic" class="scrollable" style="width:500px;height:120px;margin-left: auto;margin-right: auto;">
        <div class="items">
            <?php
                foreach($pictures as $key=>$picture){
            ?>
            <img alt="<?=$alt?>" i="<?=$key?>" src="<?=PIC_URL.$picture['thumb']?>">
            <?
                }
            ?>
        </div>
    </div>
    <a class="next browse right"></a>
</div>
<?
}else{
?>
    <div style="height: 100px;width:650px;"><?php     
   if($type==1){
      echo '尚未上传平面图';
   } elseif($type==2){
       echo '尚未上传房源照片';
   }else{
       echo '尚未照片';
    }

?></div>
<?
}
?>
<script type="text/javascript" language="javascript">
    var pathUrl = "<?=PIC_URL?>";
    var picArray = <?=json_encode($pictures)?>;
    $(".scrollable").scrollable({
        keyboard:true
    });

    $("#otherPic .items img").click(function() {

        // see if same thumb is being clicked
        if ($(this).hasClass("active")) { return; }

        // calclulate large image's URL based on the thumbnail URL (flickr specific)
        var i = $(this).attr("i");
        var url = pathUrl+picArray[i]['large'];
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
    }).filter(":first").click();
</script>