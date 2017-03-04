<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->p_id), array('view', 'id'=>$data->p_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_sourcetype')); ?>:</b>
	<?php echo CHtml::encode($data->p_sourcetype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_sourceid')); ?>:</b>
	<?php echo CHtml::encode($data->p_sourceid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_type')); ?>:</b>
	<?php echo CHtml::encode($data->p_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_description')); ?>:</b>
	<?php echo CHtml::encode($data->p_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_url')); ?>:</b>
	<?php echo CHtml::encode($data->p_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_recordtime')); ?>:</b>
	<?php echo CHtml::encode($data->p_recordtime); ?>
	<br />


</div>