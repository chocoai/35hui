<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cbl_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cbl_id), array('view', 'id'=>$data->cbl_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cbl_uid')); ?>:</b>
	<?php echo CHtml::encode($data->cbl_uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cbl_content')); ?>:</b>
	<?php echo CHtml::encode($data->cbl_content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cbl_starttime')); ?>:</b>
	<?php echo CHtml::encode($data->cbl_starttime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cbl_endtime')); ?>:</b>
	<?php echo CHtml::encode($data->cbl_endtime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cbl_muid')); ?>:</b>
	<?php echo CHtml::encode($data->cbl_muid); ?>
    <br />

</div>