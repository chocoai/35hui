<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sw_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sw_id), array('view', 'id'=>$data->sw_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sw_stationname')); ?>:</b>
	<?php echo CHtml::encode($data->sw_stationname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sw_parentid')); ?>:</b>
	<?php echo CHtml::encode($data->sw_parentid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sw_x')); ?>:</b>
	<?php echo CHtml::encode($data->sw_x); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sw_y')); ?>:</b>
	<?php echo CHtml::encode($data->sw_y); ?>
	<br />


</div>