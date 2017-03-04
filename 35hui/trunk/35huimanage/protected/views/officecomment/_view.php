<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('oc_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->oc_id), array('view', 'id'=>$data->oc_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('oc_cid')); ?>:</b>
	<?php echo CHtml::encode($data->oc_cid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('oc_officeid')); ?>:</b>
	<?php echo CHtml::encode($data->oc_officeid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('oc_traffice')); ?>:</b>
	<?php echo CHtml::encode($data->oc_traffice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('oc_facility')); ?>:</b>
	<?php echo CHtml::encode($data->oc_facility); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('oc_adorn')); ?>:</b>
	<?php echo CHtml::encode($data->oc_adorn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('oc_comment')); ?>:</b>
	<?php echo CHtml::encode($data->oc_comment); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('oc_comdate')); ?>:</b>
	<?php echo CHtml::encode($data->oc_comdate); ?>
	<br />

	*/ ?>

</div>