<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->c_id), array('view', 'id'=>$data->c_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('n_id')); ?>:</b>
	<?php echo CHtml::encode($data->n_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_comment')); ?>:</b>
	<?php echo CHtml::encode($data->c_comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_date')); ?>:</b>
	<?php echo CHtml::encode($data->c_date); ?>
	<br />


</div>