<?php
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
$this->pageTitle = $seotkd->stkd_title;
$this->breadcrumbs = array(
    "小区搜索"=>array("searchIndex"),
    CHtml::encode($model->comy_name),
);
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/zhai.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/global.css" />
<style type="text/css">
    .fydj{margin-top:10px;}
    ul,li{margin:0; padding:0;}
    .serach_moremenu{width: 1003px; padding-left: 0;}
</style>
<div class="xiezilou_left">
    <h1><?=@CHtml::encode($model->comy_name)?></h1>
</div>
<ul class="serach_moremenu">
    <li class="two"id="louright1"><strong><?=CHtml::link("小区概况",array("communitybaseinfo/view","id"=>$model->comy_id))?></strong></li>
    <li class="two" id="louright2"><strong><a href="<?=Yii::app()->createUrl("communitybaseinfo/sellIndex",SearchMenu::dealOptions(array(), "keyword", urlencode($model->comy_name)))?>">二手房(<?=$model->getNums($model->comy_id,2)?>套)</a></strong></li>
    <li class="two" id="louright3"><strong><a href="<?=Yii::app()->createUrl("communitybaseinfo/rentIndex",SearchMenu::dealOptions(array(), "keyword", urlencode($model->comy_name)))?>">租房(<?=$model->getNums($model->comy_id,1)?>套)</a></strong></li>
    <li class="one" id="louright4"><strong><?=CHtml::link("小区图片",array("communitybaseinfo/picture","id"=>$model->comy_id))?></strong></li>
    <li class="three" id="louright5">
        <strong>
            <?=CHtml::link("小区点评",array("communitybaseinfo/comment","id"=>$model->comy_id))?>
        </strong>
    </li>
</ul>
<div class="communityimg">
<div class="commnityleft">
    <?php
        $pic_size = count($pictures);
        if($pic_size > 0){
        for($i=1;$i<=$pic_size;$i++) {
            $url = PIC_URL.Picture::showStandPic($pictures[$i-1]['p_img'],"_large");
    ?>
        <img src="<?php echo $url; ?>" width="546px;" height="364px" id="img_large_pic_<?php echo $i; ?>" alt="<?=$model->comy_name?>"style="display:none"/>
        <?php }?>
        <ul class="pageul"><li><a href="javascript:pre_pic();"><img src="<?=IMAGE_URL?>/pre.gif" alt=""/></a></li>
            <li><span id="current_num">1</span>/<?php echo $pic_size;?></li>
        <li><a href="javascript:next_pic();"><img src="<?=IMAGE_URL?>/next.gif" alt=""/></a></li>
        </ul>
    <?php
        } else {
            echo '暂无图片';
        }
    ?>
</div>
<div class="commnityright">
<h5>小区概述</h5>
<table border="0" style="margin-left:10px; margin-top:7px;">
<tr>
<td>区域：</td>
<td><?=Region::model()->getNameById($model->comy_district);?></td>
<td><?=Region::model()->getNameById($model->comy_section);?></td>
</tr>
<tr>
<td>类型：</td>
<td><?=$model->getPropertytypeName($model->comy_propertytype);?></td>
<td></td>
</tr>
</table>
<?php
    if($pic_size > 0){
    $per_page_num = 9;//每页显示条数
    $page_num = ceil($pic_size / $per_page_num);//总页数
    $yu_num = $pic_size % $per_page_num;//余数
    for($j = 1; $j <=$page_num; $j++){
?>
    <ul class="smalljj" id="ul_show_<?php echo $j;?>" style="display:none">
        <?php
            $start_num = ($j-1) * $per_page_num+1;//开始显示的第一条
            $end_num = $start_num+$per_page_num-1;
            
            for($i=$start_num;$i<=$end_num&&$i<=$pic_size;$i++) {
                $picUrl_thumb=PIC_URL.Picture::showStandPic($pictures[$i-1]['p_img'],"_thumb");
        ?>
        <li><a href="javascript:show(<?php echo $j;?>,<?php echo $i;?>);"><img alt="<?=$model->comy_name?>" src="<?php echo $picUrl_thumb;?>" width="100px" height="75px" /></a></li>
        <?php }?>
    </ul>
<?php }?>
    <input type="hidden" id="page_num" name="page_num"value="<?php echo $page_num;?>"/>
    <ul class="smallpg">
        <li><a href="javascript:pre_page();">上一页</a></li>
        <li><a href="javascript:void(0);" style="border:0;"><span id="span_current_page">1</span>/<?php echo $page_num;?></a></li>
        <li><a href="javascript:next_page();">下一页</a></li>
    </ul>
<?php }?>
</div>
</div>
<script type="text/javascript">
    function show(current_page,current_num){
        document.getElementById("img_large_pic_"+current_num).style.display="block";
        for(i=1;i<=<?php echo $pic_size;?>;i++){
            if(i != current_num){
                document.getElementById("img_large_pic_"+i).style.display="none";
            }
        }
        document.getElementById("span_current_page").innerHTML = current_page;
        document.getElementById("current_num").innerHTML = current_num;
    }
    function pre_pic(){
        var current_num = parseInt(document.getElementById("current_num").innerHTML);
        if(current_num > 1){
            for(i=1;i<=<?php echo $pic_size;?>;i++){
                if(i != current_num-1){
                    document.getElementById("img_large_pic_"+i).style.display="none";
                }
            }
            document.getElementById("img_large_pic_"+(current_num-1)).style.display="block";
            document.getElementById("current_num").innerHTML = current_num-1;
        }
    }
    function next_pic(){
        var current_num = parseInt(document.getElementById("current_num").innerHTML);
        if(current_num < <?php echo $pic_size;?>){
            for(i=1;i<=<?php echo $pic_size;?>;i++){
                if(i != current_num+1){
                    document.getElementById("img_large_pic_"+i).style.display="none";
                }
            }
            document.getElementById("img_large_pic_"+(current_num+1)).style.display="block";
            document.getElementById("current_num").innerHTML = current_num+1;
        }
    }
    function next_page(){
        var current_page =  parseInt(document.getElementById("span_current_page").innerHTML)+1;
        var page_num = document.getElementById("page_num").value;
        if(current_page<=page_num){
            document.getElementById("span_current_page").innerHTML = current_page;
            document.getElementById("ul_show_"+current_page).style.display="block";
            for(var i = 1; i <= page_num;i++){
                if (i != current_page) {
                    document.getElementById("ul_show_"+i).style.display="none";
                }
            }
        }
    }
    function pre_page(){
        var current_page =  parseInt(document.getElementById("span_current_page").innerHTML)-1;
        var page_num = document.getElementById("page_num").value;
        if(current_page>=1){
            document.getElementById("span_current_page").innerHTML = current_page;
            document.getElementById("ul_show_"+current_page).style.display="block";
            for(var i = 1; i <= page_num;i++){
                if (i != current_page) {
                    document.getElementById("ul_show_"+i).style.display="none";
                }
            }
        }
    }
    <?php if($pic_size > 0){?>
    var page_num = document.getElementById("page_num").value;
    document.getElementById("ul_show_1").style.display="block";
    document.getElementById("img_large_pic_1").style.display="block";
    <?php }?>
</script>