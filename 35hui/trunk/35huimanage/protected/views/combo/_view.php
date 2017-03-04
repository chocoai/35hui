<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cb_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cb_id), array('view', 'id'=>$data->cb_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cb_issuednum')); ?>:</b>
	<?php echo CHtml::encode($data->cb_issuednum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cb_inputnum')); ?>:</b>
	<?php echo CHtml::encode($data->cb_inputnum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cb_refreshnum')); ?>:</b>
	<?php echo CHtml::encode($data->cb_refreshnum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cb_comboprice')); ?>:</b>
	<?php echo CHtml::encode($data->cb_comboprice); ?>元/月
	<br />
</div>