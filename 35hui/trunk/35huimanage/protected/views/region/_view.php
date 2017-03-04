<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('re_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->re_id), array('view', 'id'=>$data->re_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('re_name')); ?>:</b>
	<?php echo CHtml::encode($data->re_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('re_parent_id')); ?>:</b>
	<?php echo CHtml::encode($data->re_parent_id); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('re_recommendprice')); ?>:</b>
	<?php echo CHtml::encode($data->re_recommendprice); ?>
	<br />


</div>