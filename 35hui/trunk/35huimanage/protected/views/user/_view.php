<div class="view">

    <div class="right-tip">
        <div class="font-20" style="float:left;">Id&nbsp;</div>
        <div class="right-id-tip deepskyblue">
            <?php echo CHtml::encode($data->user_id); ?>
        </div>
    </div>

    <div class="sendMail">
        <?=CHtml::link('发送站内信', array('msg/create','toUserId'=>$data->user_id))?>
    </div>
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('user_name')); ?>:</b>
	<?php echo User::model()->getUserShowLink($data->user_id),'[',CHtml::encode($data->user_name),']'; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_role')); ?>:</b>
	<?php echo CHtml::encode(@User::$roleDescription[$data->user_role]); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_regtime')); ?>:</b>
	<?php echo CHtml::encode($data->user_regtime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_loginnum')); ?>:</b>
	<?php echo CHtml::encode($data->user_loginnum); ?>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<?=CHtml::link('详情', array('chart/login/','id'=>$data->user_id))?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_lasttime')); ?>:</b>
	<?php echo CHtml::encode($data->user_lasttime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_lastip')); ?>:</b>
	<?php echo CHtml::encode($data->user_lastip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_value')); ?>:</b>
	<?php echo CHtml::encode($data->user_value); ?>
	<br />

	*/ ?>

</div>