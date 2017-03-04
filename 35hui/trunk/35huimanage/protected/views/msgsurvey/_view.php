<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ms_id')); ?>:</b>
	<?php echo CHtml::encode($data->ms_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ms_name')); ?>:</b>
	<?php echo CHtml::encode($data->ms_name); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('ms_email')); ?>:</b>
	<?php echo CHtml::encode($data->ms_email); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('ms_status')); ?>:</b>
	<?php echo CHtml::encode(Msgsurvey::getStatus($data->ms_status)); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('ms_time')); ?>:</b>
	<?php echo CHtml::encode(showFormatDateTime($data->ms_time)); ?>
	<br />
</div>