<div class="view">

	<b>操作：</b>
	<?php echo CHtml::link(CHtml::encode('修改'), array('update', 'id'=>$data->si_id)); ?> /
    <?php echo CHtml::link(CHtml::encode('取消首页显示'), '#', array('submit'=>array('delete','id'=>$data->si_id),'confirm'=>'确定取消首页显示？')) ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('si_typeid')); ?>:</b>
	<?php echo CHtml::encode($data->si_typeid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('si_desc')); ?>:</b>
	<?php echo CHtml::encode($data->si_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('si_advantages')); ?>:</b>
	<?php echo CHtml::encode($data->si_advantages); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('si_inferior')); ?>:</b>
	<?php echo CHtml::encode($data->si_inferior); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('si_link')); ?>:</b>
	<?php echo CHtml::encode($data->si_link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('si_type')); ?>:</b>
	<?php echo CHtml::encode($data->si_type); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('si_time')); ?>:</b>
	<?php echo CHtml::encode($data->si_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('si_img')); ?>:</b>
	<?php echo CHtml::encode($data->si_img); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('si_num')); ?>:</b>
	<?php echo CHtml::encode($data->si_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('si_pricetype')); ?>:</b>
	<?php echo CHtml::encode($data->si_pricetype); ?>
	<br />

	*/ ?>

</div>