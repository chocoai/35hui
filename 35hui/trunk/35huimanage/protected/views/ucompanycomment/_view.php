<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ucc_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ucc_id), array('view', 'id'=>$data->ucc_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ucc_cid')); ?>:</b>
	<?php echo CHtml::encode($data->ucc_cid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ucc_comid')); ?>:</b>
	<?php echo CHtml::encode($data->ucc_comid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ucc_quality')); ?>:</b>
	<?php echo CHtml::encode($data->ucc_quality); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ucc_service')); ?>:</b>
	<?php echo CHtml::encode($data->ucc_service); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ucc_comment')); ?>:</b>
	<?php echo CHtml::encode($data->ucc_comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ucc_comdate')); ?>:</b>
	<?php echo CHtml::encode($data->ucc_comdate); ?>
	<br />


</div>