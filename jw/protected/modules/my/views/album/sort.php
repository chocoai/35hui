<style type="text/css">
    .img{float:left;width: 135px;text-align: center;margin-bottom: 8px}
    .imgcontent{width: 128px;height: 140px;border: 1px dashed gray}
    .notes{
        float:left;
        background: #FEFFE5;
        border: 1px solid #F9F2A7;
        color: #D4A639;
        display: inline-block;
        height: 23px;
        line-height: 23px;
        padding: 1px 0px;
        text-align: center;
        width: 650px;
    }
</style>
<div class="slctit">
    <span class="notes">*拖动排序：按下鼠标左键选中照片，拖动到想要放的位置松开鼠标即可将照片移动到该位置。</span>
    <span style="float:left;margin-left: 50px">
        <input type="button" value="保存" onclick="saveSort()" id="saveBun" style="display:none" />
    </span>
    <span class="slc_4">
        <?=CHtml::link("返回我的相册", array("/my/album/view","id"=>$_GET["id"]))?>
    </span>
    <form action="" method="post" id="sortForm" style="display:none">
        <input type="hidden" name="newsort" />
        <input type="hidden" name="albumid" value="<?=$_GET["id"]?>"/>
    </form>
</div>
<div class="scc_main">
    <div id="allimgs">
        <?php
        foreach($albumphoto as $value){
            ?>
        <div class="img">
            <img src="<?=Albumphoto::model()->getStaticPhotoUrl($value->ap_url, "_230x250")?>" width="128px" height="140px" />
            <span style="display:none"><?=$value->ap_id?></span>
        </div>
            <?php
        }
        ?>
    </div>
</div>

<script type="text/javascript" src="/js/dragsort/jquery.dragsort-0.5.0.min.js"></script>
<script type="text/javascript">
    $("#allimgs").dragsort({ dragSelector: "div", dragBetween: true, dragEnd: saveOrderHtml, placeHolderTemplate: "<div class='img'><div class='imgcontent'>&nbsp;</div></div>" });
    function saveOrderHtml() {
        var data = $("#allimgs div").map(function() { return $(this).children("span").html(); }).get();
        $("#saveBun").css("display","block")
        $("#sortForm input[name='newsort']").val(data.join("|"));
    };
    function saveSort(){
        $.post("<?=Yii::app()->createUrl("/my/album/savesort");?>", $("#sortForm").serialize(), function(msg){
            var info = "";
            if(msg=="success"){
                info = "排序保存成功！";
            }else{
                info = "排序保存失败！";
            }
            jw.pop.alert(info,{
                icon: 1,
                autoClose:1000
            });
            setTimeout(function(){location.href="<?=Yii::app()->createUrl("/my/album/view",array("id"=>$_GET["id"]));?>"},1500);
        }, "json");
    }
</script>
