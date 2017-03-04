<div class="view">

    <div class="right-tip">
        <div class="font-20" style="float:left;">Id&nbsp;</div>
        <div class="right-id-tip deepskyblue">
            <?php echo CHtml::link(CHtml::encode($data->msg_id), array('view', 'id'=>$data->msg_id)); ?>
        </div>
    </div>

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_sendid')); ?>:</b>
	<?php echo CHtml::encode(User::model()->getUserName($data->msg_sendid))?CHtml::encode(User::model()->getUserName($data->msg_sendid)):"管理员"; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_revid')); ?>:</b>
	<?php echo CHtml::encode(User::model()->getUserName($data->msg_revid))?CHtml::encode(User::model()->getUserName($data->msg_revid)):"管理员"; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_title')); ?>:</b>
	<?php echo CHtml::encode($data->msg_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_content')); ?>:</b>
	<?php echo strCut(CHtml::encode($data->msg_content),100); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_type')); ?>:</b>
	<?php echo CHtml::encode(Msg::$msgTypeDescription[$data->msg_type]); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_time')); ?>:</b>
	<?php echo CHtml::encode(showFormatDateTime($data->msg_time)); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_senddel')); ?>:</b>
	<?php echo CHtml::encode($data->msg_senddel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_revdel')); ?>:</b>
	<?php echo CHtml::encode($data->msg_revdel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msg_isread')); ?>:</b>
	<?php echo CHtml::encode($data->msg_isread); ?>
	<br />

	*/ ?>

</div>