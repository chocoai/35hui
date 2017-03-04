<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->msg_id), array('view', 'id'=>$data->msg_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_sendid')); ?>:</b>
	<?php echo CHtml::encode($data->msg_sendid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_revid')); ?>:</b>
	<?php echo CHtml::encode($data->msg_revid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_title')); ?>:</b>
	<?php echo CHtml::encode($data->msg_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_content')); ?>:</b>
	<?php echo CHtml::encode($data->msg_content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_type')); ?>:</b>
	<?php echo CHtml::encode($data->msg_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_time')); ?>:</b>
	<?php echo CHtml::encode($data->msg_time); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_senddel')); ?>:</b>
	<?php echo CHtml::encode($data->msg_senddel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_revdel')); ?>:</b>
	<?php echo CHtml::encode($data->msg_revdel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_isread')); ?>:</b>
	<?php echo CHtml::encode($data->msg_isread); ?>
	<br />

	*/ ?>

</div>