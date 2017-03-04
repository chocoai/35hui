<?php
$this->breadcrumbs=array(
	$sourceName,
);
$this->menu=array(
    array('label'=>'上传 图片','url'=>array('uploadPic','sId'=>$sId,'sType'=>$sType)),
    array('label'=>'查看房源信息','url'=>Picture::model()->realSourceViewLink($sId,$sType)),
);
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/scrollable-horizontal.css" />
<style type="text/css">
.split {
    width:613px;
    height:20px;
    background-color: #3cb371;
    margin:10px 0px 10px 40px;
    font-size:15px;
    color:white;
    font-weight: bold;
}
.split a {
    text-decoration:none;
	color:#f0fff0;
	cursor:pointer;
}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/scrollable-horizontal.css" />
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/scrollable.js"></script>
<h1>
<?=$sourceName?>
</h1>
标题图：
<?php echo CHtml::image(Picture::model()->getPicByTitleInt($headpic,"_large"),"",array('class'=>'img_border')); ?>
<? 
    if($pictures){
        foreach($pictures as $type=>$pictureObject){
?>
        <div class='split'>
            <span><?=@Picture::$typeDescription[$type]?></span>
        </div>
        <a id="<?=$type."prev"?>" class="browse left"></a>
            <div id="<?="scroll".$type?>" class="scrollable" style="width:610px;height:120px;">
               <div class="items">
                   <div>
                    <?
                    foreach($pictureObject as $i=>$picture){
                        ?>
                        <li class="item_vessel">
                           <a href='<?php echo Yii::app()->createUrl('/picture/showPic',array('id'=>$picture['p_id'])) ?>'><?=CHtml::image(PIC_URL.Picture::showStandPic($picture->p_img,"_large"),"",array("url"=>PIC_URL.$picture['p_img'],"title"=>$picture['p_title']));?></a>
                            <div class="item_title"><?=CHtml::link("删除",'',array("onClick"=>"return delpic(".$picture['p_id'].")","style"=>"cursor:pointer"))?>
                                   <?php if(Picture::model()->getNum($picture->p_img)==1){?>
                                   <?=CHtml::link("设标题","",array("onClick"=>"settitle(".$sId.",".$picture['p_id'].")","style"=>"cursor:pointer"));?>
                                   <?=CHtml::link("精品",array('revertBuild', 'id'=>$picture['p_id']),array("style"=>"cursor:pointer"))?>
                                   <?php }else{?>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=CHtml::link("设标题","",array("onClick"=>"settitle(".$sId.",".$picture['p_id'].")","style"=>"cursor:pointer"));?>
                                   <?php }?>
                            </div>
                       </li>
                       <?
                       if(($i+1)%5==0){
                           echo "</div><div style='width:610px;'>";
                        }
                    }
                    ?>
                   </div>
                </div>
            </div><a id="<?=$type."next"?>" class="browse right"></a>
        <div class="c"></div>
<?
        }
    }else{
        echo "<h5 style='color:red'>此房源暂时没有上传任何图片</h1>";
    }
?>
<script type="text/javascript" language="javascript">
$(function() {
    <?
        foreach($pictures as $type=>$pictureObject){
    ?>
    $("<?="#scroll".$type?>").scrollable({prev:"<?="#".$type."prev"?>",next:"<?="#".$type."next"?>"});
    <?
        }
    ?>
});
function settitle(sourceid,picid){
	$.ajax({
		url: "<?php echo Yii::app()->createUrl('/picture/settitle');?>",
		data: "sourceid="+sourceid+"&picid="+picid,
		type:"POST",
        acync:"false",
		success:function(item){
			alert('设置标题图片成功！');
            window.location.reload();
		}
	});
}
function delpic(id){
    if(confirm("确定要删除此图片吗？")){
        $.ajax({
            url: "<?php echo Yii::app()->createUrl('/picture/delete');?>",
            data: "id="+id,
            type:"GET",
            acync:"false",
            success:function(){
                window.location.reload();
            }
        });
    }
}
</script>
