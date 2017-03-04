<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('puser_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->puser_id), array('view', 'id'=>$data->puser_id)); ?>
	<br />

	<b>登录名:</b>
	<?php echo CHtml::encode($data->user->user_name); ?>
	<br />

</div>