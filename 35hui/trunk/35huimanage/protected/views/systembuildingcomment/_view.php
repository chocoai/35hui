<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbc_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sbc_id), array('view', 'id'=>$data->sbc_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbc_cid')); ?>:</b>
	<?php echo CHtml::encode($data->sbc_cid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbc_buildingid')); ?>:</b>
	<?php echo CHtml::encode($data->sbc_buildingid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbc_traffice')); ?>:</b>
	<?php echo CHtml::encode($data->sbc_traffice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbc_facility')); ?>:</b>
	<?php echo CHtml::encode($data->sbc_facility); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbc_adorn')); ?>:</b>
	<?php echo CHtml::encode($data->sbc_adorn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbc_comment')); ?>:</b>
	<?php echo CHtml::encode($data->sbc_comment); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sbc_comdate')); ?>:</b>
	<?php echo CHtml::encode($data->sbc_comdate); ?>
	<br />

	*/ ?>

</div>