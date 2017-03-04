<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('n_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->n_id), array('view', 'id'=>$data->n_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('n_title')); ?>:</b>
	<?php echo CHtml::encode($data->n_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('n_content')); ?>:</b>
	<?php echo CHtml::encode($data->n_content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('n_date')); ?>:</b>
	<?php echo CHtml::encode($data->n_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('n_picture')); ?>:</b>
	<?php echo CHtml::encode($data->n_picture); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('n_from')); ?>:</b>
	<?php echo CHtml::encode($data->n_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('n_state')); ?>:</b>
	<?php echo CHtml::encode($data->n_state); ?>
	<br />


</div>