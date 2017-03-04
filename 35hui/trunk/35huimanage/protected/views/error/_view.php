<div class="view">
    <div class="right-tip">
        <div class="font-20" style="float:left;">Id&nbsp;</div>
        <div class="right-id-tip deepskyblue">
            <?php echo CHtml::link(CHtml::encode($data->e_id), array('view', 'id'=>$data->e_id)); ?>
        </div>
    </div>

	<b><?php echo CHtml::encode($data->getAttributeLabel('e_buildid')); ?>:</b>
	<a target='_blank' href='<?=MAINHOST?>/systembuildinginfo/view/id/<?=$data->e_buildid?>'><?=Systembuildinginfo::model()->getBuildingName($data->e_buildid)?></a>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('e_userid')); ?>:</b>
	<?=$data->e_userid?User::model()->getRealNamebyid($data->e_userid):"无"; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('e_nickname')); ?>:</b>
	<?php echo CHtml::encode($data->e_nickname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('e_telphone')); ?>:</b>
	<?php echo CHtml::encode($data->e_telphone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('e_email')); ?>:</b>
	<?php echo CHtml::encode($data->e_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('e_content')); ?>:</b>
	<?php echo CHtml::encode($data->e_content); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('e_state')); ?>:</b>
	<?php echo CHtml::encode($data->e_state); ?>
	<br />

	*/ ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('e_date')); ?>:</b>
	<?=  showFormatDateTime($data->e_date); ?>
	<br />

</div>