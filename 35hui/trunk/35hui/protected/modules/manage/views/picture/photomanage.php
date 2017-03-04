<?php
$this->breadcrumbs=array(
        '图片管理',
);
?>
<style type="text/css">
    .split { width:650px; height:20px; background-color: #E5ECF4; margin:10px 0px 10px 40px; color: #052C3D; font-size:15px; font-weight: normal;}
    .split a { text-decoration:none;cursor:pointer;}
</style>
<div class="htit">更新房源图片信息</div>
<div class="gltit">标题图</div>
<div class="gltu">
    <div class="glmodl">
        <?php echo CHtml::image(Picture::model()->getPicByTitleInt($headpic,"_large"),"",array('style'=>'width:150px;height:100px;')); ?>
    </div>
</div>
<?php
foreach($photolist as $type=>$pictureObject){
    //if($type==3){
        ?>
<div class="gltit">
    <span><?php echo @Picture::$typeDescription[$type] ;?></span>
    <span class="normal"><?php echo CHtml::link("管理图片",Yii::app()->createUrl("/manage/picture/uploadphoto",array("id"=>$sourceId,"sourcetype"=>$sourceType,'type'=>$type)))?></span>
</div>
<div class="gltu">
            <?php foreach($pictureObject as $key=>$picture){ ?>
    <div class="glmodle">
        <img src="<?php echo Picture::model()->showStandPic(PIC_URL.$picture['p_img'],"_large");?>" width="100" height="40" url="<?php echo PIC_URL.$picture['p_img'];?>"/>
        <p><?php echo CHtml::link("设为标题图","",array("onClick"=>"settitle(".$picture['p_id'].")","style"=>"cursor:pointer"));?></p>
    </div>
                <?php } ?>
</div>
        <?php
 //   }
}
?>

<script type="text/javascript">

    $(".items img").click(function(){
        var url = $(this).attr("url");
        window.open(url);
    });
    function settitle(id){
        $.ajax({
            url: "<?php echo Yii::app()->createUrl('/manage/picture/settitle');?>",
            data: {"id":id},
            type:"POST",
            acync:"false",
            success:function(item){
                alert('设置标题图片成功！');
                window.location.reload();
            }
        });
    }
</script>