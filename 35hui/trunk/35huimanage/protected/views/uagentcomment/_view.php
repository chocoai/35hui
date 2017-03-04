<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('uac_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->uac_id), array('view', 'id'=>$data->uac_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uac_cid')); ?>:</b>
	<?php echo CHtml::encode($data->uac_cid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uac_agentid')); ?>:</b>
	<?php echo CHtml::encode($data->uac_agentid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uac_quality')); ?>:</b>
	<?php echo CHtml::encode($data->uac_quality); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uac_service')); ?>:</b>
	<?php echo CHtml::encode($data->uac_service); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uac_comment')); ?>:</b>
	<?php echo CHtml::encode($data->uac_comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uac_comdate')); ?>:</b>
	<?php echo CHtml::encode($data->uac_comdate); ?>
	<br />


</div>