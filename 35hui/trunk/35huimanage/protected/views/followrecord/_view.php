<div class="view">
    <div class="right-tip">
        <div class="font-20" style="float:left;">Id&nbsp;</div>
        <div class="right-id-tip deepskyblue">
            <?php echo CHtml::link(CHtml::encode($data->fr_id), array('view', 'id'=>$data->fr_id)); ?>
        </div>
    </div>

	<b><?php echo CHtml::encode($data->getAttributeLabel('fr_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fr_id), array('view', 'id'=>$data->fr_id)); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('fr_crid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->contact->cr_realname), array('contactrecord/view', 'id'=>$data->fr_crid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fr_content')); ?>:</b>
	<?php echo CHtml::encode($data->fr_content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fr_salesman')); ?>:</b>
	<?php echo CHtml::encode($data->fr_salesman); ?>
	<br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('fr_reservetime')); ?>:</b>
	<?php echo CHtml::encode($data->fr_reservetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fr_address')); ?>:</b>
	<?php echo CHtml::encode($data->fr_address); ?>
	<br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('fr_followtime')); ?>:</b>
	<?php echo CHtml::encode(date("Y-m-d H:i:s",$data->fr_followtime)); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('fr_address')); ?>:</b>
	<?php echo CHtml::encode($data->fr_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fr_status')); ?>:</b>
	<?php echo CHtml::encode($data->fr_status); ?>
	<br />

	*/ ?>

</div>