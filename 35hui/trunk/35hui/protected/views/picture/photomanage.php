<?php
$this->temp=$menu;
$this->breadcrumbs=array(
	"我的新地标"=>array('/site/userindex'),
	'图片管理',
);
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/scrollable-horizontal.css" />
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/scrollable.js"></script>
<style type="text/css">
.split { width:650px; height:20px; background-color: #E5ECF4; margin:10px 0px 10px 40px; color: #052C3D; font-size:15px; font-weight: normal;}
.split a { text-decoration:none;cursor:pointer;}
</style>
<div style="margin:0 auto;width:742px;">
    <div class="manage_righttitleone">更新房源图片信息</div>
    <div class="manage_rightboxthree">
        <div style="height:150px">
            <div class='split'>
                <span style="margin-left:10px">标题图</span>
            </div>
            <div style="margin-left:50px">
                <?php echo CHtml::image(Picture::model()->getPicByTitleInt($headpic,"_small"),"",array('style'=>'width:150px;height:100px;','class'=>'img_border')); ?>
            </div>
        </div>
    <?php
        foreach($photolist as $type=>$pictureObject){
            if($type<4){
    ?>
    <div style="height:170px;margin: 10px;">
            <div class='split'>
                <div style="float:right;margin-right: 10px">
                    <?=CHtml::link("管理图片",Yii::app()->createUrl("/picture/uploadphoto",array("id"=>$sourceId,"sourcetype"=>$sourceType,'type'=>$type,'menu'=>$this->temp)),array("style"=>"color:blue"))?>
                </div>
                <span style="margin-left:10px"><?=@Picture::$typeDescription[$type]?></span>
            </div>
            <a id="<?=$type."prev"?>" class="browse left"></a>
            <div id="<?="scroll".$type?>" class="scrollable" style="width:630px;height:150px;">
                   <div class="items">
                       <div>
            <?php
                foreach($pictureObject as $key=>$picture){
                    ?>
                   <li class="item_vessel">
                       <img src="<?php echo PIC_URL.$picture['p_tinyimg'];?>" width="100" height="40" url="<?php echo PIC_URL.$picture['p_img'];?>"/>
                       <div class="item_title"><?=CHtml::link("设为标题图","",array("onClick"=>"settitle(".$picture['p_id'].")","style"=>"cursor:pointer"));?></div>
                   </li>
                   <?php
                   if(($key+1)%5==0){
                       echo "</div><div>";
                   }
                }
            ?>
                       </div>
                </div>
            </div><a id="<?=$type."next"?>" class="browse right"></a>
    </div>
            <div class="c"></div>
    <?php
            }
        }
    ?>
    </div>
    <div class="manage_righttwoline"></div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    <?php
        foreach($photolist as $type=>$pictureObject){
            if($type<4){
        ?>
        $("<?="#scroll".$type?>").scrollable({prev:"<?="#".$type."prev"?>",next:"<?="#".$type."next"?>",keyboard:true});
        <?php
            }
        }
    ?>
    $(".items img").css("cursor","pointer");
  
});
$(".items img").click(function(){
    var url = $(this).attr("url");
    window.open(url);
});
function settitle(id){
	$.ajax({
		url: "<?php echo Yii::app()->createUrl('/picture/settitle');?>",
		data: "id="+id,
		type:"POST",
        acync:"false",
		success:function(item){
			alert('设置标题图片成功！');
            window.location.reload();
		}
	});
}
</script>