<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ocf_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ocf_id), array('view', 'id'=>$data->ocf_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ocf_name')); ?>:</b>
	<?php echo CHtml::encode($data->ocf_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ocf_key')); ?>:</b>
	<?php echo CHtml::encode($data->ocf_key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ocf_val')); ?>:</b>
	<?php echo CHtml::encode($data->ocf_val); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ocf_desc')); ?>:</b>
	<?php echo CHtml::encode($data->ocf_desc); ?>
	<br />


</div>