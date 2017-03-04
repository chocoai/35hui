<?php
//fancybox-1.3.4
Yii::app()->clientScript->registerScriptFile('/js/fancybox-1.3.4/jquery.mousewheel-3.0.4.pack.js');
Yii::app()->clientScript->registerScriptFile('/js/fancybox-1.3.4/jquery.fancybox-1.3.4.pack.js');
Yii::app()->clientScript->registerCssFile('/js/fancybox-1.3.4/jquery.fancybox-1.3.4.css');
?>


    <div class="space">
		<div class="lfspace"><a href="/">首页</a>&gt;<?php echo CHtml::link($model->bc_name,array('view','id'=>$model->bc_id)) ?>&gt;<em>相册</em></div>
		<div class="rtspace">浏览次数：<?php echo CHtml::encode($model->bc_visit) ?></div>
	</div>
	<div class="loutit">
		<div class="lflou">
			<div class="title"><?php echo CHtml::encode($model->bc_name) ?></div>
			<div class="egtit"><?php echo CHtml::encode($model->bc_englishname) ?></div>
		</div>
	</div>
	<?php $this->renderPartial('_nav',array('model'=>$model)); 
$albums = Picture::model()->findAll(array('condition'=>'p_sourcetype=3 AND p_sourceid='.$model->bc_id));
if($albums){
?>
	<div class="detcont">
        <div class="dllcont">
			<div class="phinecont" id="fancybox_list">
                <?php 
                foreach($albums as $pic){// /images/1.jpg
                    $src = PIC_URL.Picture::showStandPic($pic->p_img,"_large");
                    $typeDsc = isset(Picture::$typeDescription[$pic->p_type])?Picture::$typeDescription[$pic->p_type]:'';
                ?><a rel="fancybox_group" href="<?php echo PIC_URL.$pic->p_img ?>" title="<?php echo $typeDsc ?>">
                        <?php echo CHtml::image($src,CHtml::encode($model->bc_name)) ?>
                        <span class="PicNameF fl"><?php echo CHtml::encode($pic->p_title) ?></span>
                    </a>
                <?php } ?>
	          </div>
		</div>
	</div>
<?php } ?>
<br />
<script type="text/javascript">

$(document).ready(function() {
    $("a[rel=fancybox_group]").fancybox({
        'transitionIn': 'none',
        'transitionOut': 'none',
        'titlePosition': 'over',
        'titleFormat': function(title, currentArray, currentIndex, currentOpts) {
            return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
        }
    });
});
</script>