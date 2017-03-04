<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('kdl_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->kdl_id), array('view', 'id'=>$data->kdl_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kdl_name')); ?>:</b>
	<?php echo CHtml::encode($data->kdl_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kdl_url')); ?>:</b>
	<?php echo CHtml::encode($data->kdl_url); ?>
	<br />


</div>