<div class="view">
        <div class="right-tip">
            <div class="font-20" style="float:left;">Id&nbsp;</div>
            <div class="right-id-tip deepskyblue">
                <?php echo CHtml::link(CHtml::encode($data->mr_id), array('view', 'id'=>$data->mr_id)); ?>
            </div>
        </div>

        <b><?php echo CHtml::encode($data->getAttributeLabel('mr_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->mr_id), array('view', 'id'=>$data->mr_id)); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('mr_crid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->contact->cr_realname), array('contactrecord/view', 'id'=>$data->mr_crid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mr_remark')); ?>:</b>
	<?php echo CHtml::encode($data->mr_remark); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mr_salesman')); ?>:</b>
	<?php echo CHtml::encode($data->mr_salesman); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mr_time')); ?>:</b>
	<?php echo CHtml::encode(date("Y-m-d H:i:s",$data->mr_time)); ?>
	<br />


</div>