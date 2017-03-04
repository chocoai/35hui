<?php
$sbi_city = Region::model()->getNameById($model->sbi_city);
$sbi_district = Region::model()->getNameById($model->sbi_district);
$sbi_section = Region::model()->getNameById($model->sbi_section);
$sbi_buildingname = $model->sbi_buildingname;
$keywords = $sbi_city.$sbi_buildingname.','.$sbi_buildingname.'写字楼,'.$sbi_buildingname.'写字楼租赁,360°全景看房';
$description='找'.$sbi_city.'出售房源和租房,'.$sbi_city.'360°全景看房，就在新地标全景看房。';
$description.=$sbi_city.$sbi_district.$sbi_section.'/'.$sbi_buildingname.'最新出售和出租房源查询就上新地标。';
Yii::app()->clientScript->registerMetaTag($keywords,'keywords');
Yii::app()->clientScript->registerMetaTag($description,'description');
$this->pageTitle = $keywords.' - 新地标';
//fancybox-1.3.4
Yii::app()->clientScript->registerScriptFile('/js/fancybox-1.3.4/jquery.mousewheel-3.0.4.pack.js');
Yii::app()->clientScript->registerScriptFile('/js/fancybox-1.3.4/jquery.fancybox-1.3.4.pack.js');
Yii::app()->clientScript->registerCssFile('/js/fancybox-1.3.4/jquery.fancybox-1.3.4.css');
?>


    <div class="space">
		<div class="lfspace"><a href="/">首页</a>&gt;<?php echo CHtml::link($model->sbi_buildingname,array('systembuildinginfo/view','id'=>$model->sbi_buildingid)) ?>&gt;<em>相册</em></div>
		<div class="rtspace">浏览次数：<?php echo CHtml::encode($model->sbi_visit) ?></div>
	</div>
	<div class="loutit">
		<div class="lflou">
			<div class="title"><?php echo CHtml::encode($model->sbi_buildingname) ?></div>
			<div class="egtit"><?php echo CHtml::encode($model->sbi_buildingenglishname) ?></div>
		</div>
	</div>
	<?php $this->renderPartial('_viewHead', array('get'=>$_GET,"select"=>"album")); ?>
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
<?php
$albums = Picture::model()->findAll(array('condition'=>'p_sourcetype=1 AND p_sourceid='.$model->sbi_buildingid));
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
                        <?php echo CHtml::image($src,CHtml::encode($model->sbi_buildingname)) ?>
                        <span class="PicNameF fl"><?php echo CHtml::encode($pic->p_title) ?></span>
                    </a>
                <?php } ?>
	          </div>
		</div>
	</div>
<?php } ?>
<br />
