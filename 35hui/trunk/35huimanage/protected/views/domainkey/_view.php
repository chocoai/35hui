<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('dk_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->dk_id), array('view', 'id'=>$data->dk_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dk_name')); ?>:</b>
    <?php echo Domainkey::model()->getValue($data->dk_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kd_key')); ?>:</b>
	<?php echo CHtml::encode($data->kd_key); ?>
	<br />


</div>