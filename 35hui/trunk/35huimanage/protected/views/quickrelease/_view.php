<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrl_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->qrl_id), array('view', 'id'=>$data->qrl_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrl_srtp')); ?>:</b>
	<?php echo CHtml::encode($data->qrl_srtp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrl_sysid')); ?>:</b>
	<?php echo CHtml::encode($data->qrl_sysid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrl_floor')); ?>:</b>
	<?php echo CHtml::encode($data->qrl_floor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrl_area')); ?>:</b>
	<?php echo CHtml::encode($data->qrl_area); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrl_zhuang')); ?>:</b>
	<?php echo CHtml::encode($data->qrl_zhuang); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrl_toward')); ?>:</b>
	<?php echo CHtml::encode($data->qrl_toward); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('qrl_contact')); ?>:</b>
	<?php echo CHtml::encode($data->qrl_contact); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrl_tel')); ?>:</b>
	<?php echo CHtml::encode($data->qrl_tel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrl_remark')); ?>:</b>
	<?php echo CHtml::encode($data->qrl_remark); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrl_user')); ?>:</b>
	<?php echo CHtml::encode($data->qrl_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrl_timestamp')); ?>:</b>
	<?php echo CHtml::encode($data->qrl_timestamp); ?>
	<br />

	*/ ?>

</div>