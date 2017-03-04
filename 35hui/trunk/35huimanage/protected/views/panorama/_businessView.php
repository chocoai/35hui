<div class="view">

    <div class="right-tip">
        <div class="font-20" style="float:left;">Id&nbsp;</div>
        <div class="right-id-tip deepskyblue">
            <?php echo CHtml::link(CHtml::encode($data->ob_officeid), array('businessView', 'sid'=>$data->ob_officeid)); ?>
        </div>
    </div>

	<b>商务中心名称:</b>
	<?php echo CHtml::encode($data->ob_officename); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('ob_province')); ?>:</b>
	<?php echo CHtml::encode(Region::model()->getNameById($data->ob_province)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ob_city')); ?>:</b>
	<?php echo CHtml::encode(Region::model()->getNameById($data->ob_city)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ob_district')); ?>:</b>
	<?php echo CHtml::encode(Region::model()->getNameById($data->ob_district)); ?>
	<br />
    
    <b>全景数量:</b>
	<font style="color: red"><?=Panorama::model()->getPanoramaCount($data->ob_officeid, Panorama::business); ?></font>
	<br />

</div>