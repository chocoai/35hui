<?php
$this->currentMenu = 53;
$this->breadcrumbs=array(
	'商务中心房源管理'=>array('index'),
	$model->ob_officename=>array('view','id'=>$model->ob_officeid),
    '修改商务中心标题图片'
);
$this->menu=array(
	array('label'=>'浏览所有商务中心', 'url'=>array('index')),
	array('label'=>'新建商务中心', 'url'=>array('create')),
	array('label'=>'查看商务中心基本信息', 'url'=>array('view', 'id'=>$model->ob_officeid)),
);
?>
<h1>修改Id为 <?php echo $model->ob_officeid; ?> 的商务中心标题图片</h1>
<div id="picBox" class="pic-box" style="width: 700px;height:400px;background-color: #f0f8ff">
    <ul style="width: 680px;height:400px;">
        <?
            foreach($pictures as $picture){
                echo "<li>";
                echo CHtml::image(PIC_URL.Picture::showStandPic($picture->p_img,"_normal"),"",array('height'=>'150px','pid'=>$picture->p_id));
                echo "</li>";
            }
        ?>
    </ul>
</div>
<form id="titlePicForm" method="post">
    <input type="hidden" name="id" value="<?=$model->ob_officeid?>">
    <input type="hidden" name="picId" id="picId">
<P style="text-align: center; padding-top: 20px;"><input type="button" value="提交" onclick="submitTitlePic()"></P>
</form>
<script type="text/javascript" language="javascript">
    $("#picBox img").click(function(){
        $("#picBox li").removeClass();
        $(this).parent().addClass("bg-yellow");
    });
    function submitTitlePic(){
        var chooseId = $("#picBox li.bg-yellow img").attr("pid");
        $("#picId").val(chooseId);
        $("#titlePicForm").submit();
    }
</script>