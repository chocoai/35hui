<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ad_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ad_id), array('view', 'id'=>$data->ad_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ad_position')); ?>:</b>
	<?php echo CHtml::encode($data->ad_position); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ad_picurl')); ?>:</b>
	<?php echo CHtml::encode($data->ad_picurl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ad_linkurl')); ?>:</b>
	<?php echo CHtml::encode($data->ad_linkurl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ad_alt')); ?>:</b>
	<?php echo CHtml::encode($data->ad_alt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ad_uploadtime')); ?>:</b>
	<?php echo CHtml::encode($data->ad_uploadtime); ?>
	<br />


</div>