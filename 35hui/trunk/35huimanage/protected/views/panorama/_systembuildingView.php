<div class="view">

    <div class="right-tip">
        <div class="font-20" style="float:left;">Id&nbsp;</div>
        <div class="right-id-tip deepskyblue">
            <?php echo CHtml::link(CHtml::encode($data->sbi_buildingid), array('systembuildingView', 'sid'=>$data->sbi_buildingid)); ?>
        </div>
    </div>

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_buildingname')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_buildingname); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('sbi_province')); ?>:</b>
	<?php echo CHtml::encode(Region::model()->getNameById($data->sbi_province)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_city')); ?>:</b>
	<?php echo CHtml::encode(Region::model()->getNameById($data->sbi_city)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_district')); ?>:</b>
	<?php echo CHtml::encode(Region::model()->getNameById($data->sbi_district)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_openingtime')); ?>:</b>
	<?php echo CHtml::encode(showFormatDateTime($data->sbi_openingtime)); ?>
	<br />
    
    <b>全景数量:</b>
	<font style="color: red"><?=Panorama::model()->getPanoramaCount($data->sbi_buildingid, Panorama::systembuilding); ?></font>
	<br />

</div>