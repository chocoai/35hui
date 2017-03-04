<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('arc_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->arc_id), array('view', 'id'=>$data->arc_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('arc_ordernum')); ?>:</b>
	<?php echo CHtml::encode($data->arc_ordernum); ?>
	<br />

	<b>充值金额:</b>
	<?php echo CHtml::encode($data->fundsconfig->fc_rmbprice); ?>元
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('arc_state')); ?>:</b>
	<?php echo CHtml::encode(Accountrecharge::$arc_state[$data->arc_state]); ?>
	<br />
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('arc_releasetime')); ?>:</b>
	<?php echo date("Y-m-d H:i", $data->arc_releasetime); ?>
	<br />


</div>