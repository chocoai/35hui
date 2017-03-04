<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('dc_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->dc_id), array('view', 'id'=>$data->dc_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dc_buildtype')); ?>:</b>
	<?php echo CHtml::encode(Demendcollect::$dc_buildtype[$data->dc_buildtype]); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dc_type')); ?>:</b>
	<?php echo CHtml::encode(Demendcollect::$dc_type[$data->dc_type]); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dc_buildname')); ?>:</b>
	<?php echo CHtml::encode($data->dc_buildname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dc_address')); ?>:</b>
	<?php echo CHtml::encode($data->dc_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dc_area')); ?>:</b>
	<?php echo CHtml::encode($data->dc_area?$data->dc_area.'平米':''); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dc_price')); ?>:</b>
	<?php echo CHtml::encode($data->dc_price); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('dc_floor')); ?>:</b>
	<?php echo CHtml::encode($data->dc_floor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dc_contactname')); ?>:</b>
	<?php echo CHtml::encode($data->dc_contactname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dc_register')); ?>:</b>
	<?php echo CHtml::encode($data->dc_register); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dc_time')); ?>:</b>
	<?php echo CHtml::encode($data->dc_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dc_memo')); ?>:</b>
	<?php echo CHtml::encode($data->dc_memo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dc_tel')); ?>:</b>
	<?php echo CHtml::encode($data->dc_tel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dc_mobile')); ?>:</b>
	<?php echo CHtml::encode($data->dc_mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dc_email')); ?>:</b>
	<?php echo CHtml::encode($data->dc_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dc_qq')); ?>:</b>
	<?php echo CHtml::encode($data->dc_qq); ?>
	<br />

	*/ ?>

</div>