<div class="view">
    
    <div class="right-tip">
        <div class="font-20" style="float:left;">Id&nbsp;</div>
        <div class="right-id-tip deepskyblue">
            <?php echo CHtml::link(CHtml::encode($data->sbi_buildingid), array('buildingView', 'id'=>$data->sbi_buildingid)); ?>
        </div>
    </div>

	<b>楼盘名称:</b>
	<?=CHtml::encode($data->sbi_buildingname); ?>
	<br />

	<b>行政区:</b>
	<?=Region::model()->getNameById($data->sbi_district); ?>
	<br />

	<b>版块:</b>
	<?=Region::model()->getNameById($data->sbi_section); ?>
	<br />

	<b>全景数量:</b>
	<font style="color: red"><?=Panorama::model()->getPanoramaCount($data->sbi_buildingid); ?></font>
	<br />
</div>