<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ec_question')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ec_question), array('view', 'id'=>$data->ec_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ec_a')); ?>:</b>
	<?php echo CHtml::encode($data->ec_a); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ec_b')); ?>:</b>
	<?php echo CHtml::encode($data->ec_b); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ec_c')); ?>:</b>
	<?php echo CHtml::encode($data->ec_c); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ec_d')); ?>:</b>
	<?php echo CHtml::encode($data->ec_d); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ec_answer')); ?>:</b>
	<?php echo CHtml::encode(Examchoice::model()->getTrueAnswerCode($data->ec_answer)); ?> &nbsp;&nbsp;&nbsp;&nbsp;
	<b><?php echo CHtml::encode($data->getAttributeLabel('ec_type')); ?>:</b>
	<?php echo CHtml::encode(Examchoice::$ec_type[$data->ec_type]); ?>
	<br />

</div>