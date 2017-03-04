<div class="view">
    <div class="right-tip">
        <div class="font-20" style="float:left;">ID&nbsp;</div>
        <div class="right-id-tip deepskyblue">
            <?php echo CHtml::link($data->id, array('view', 'id'=>$data->id),array ("class"=>"right-id-tip deepskyblue")); ?>
        </div>
    </div>

	<b><?php echo CHtml::encode($data->getAttributeLabel('buid_type')); ?>:</b>
	<?php echo CHtml::encode(Attachment::$buidTypeName[$data->buid_type]); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('buid_id')); ?>:</b>
	<?php echo CHtml::encode($data->buid_id); ?>
    <?php if($data->buid_type == 1){ ?>
    <a href="<?php echo MAINHOST.Yii::app()->createUrl('/systembuildinginfo/view',array('id'=>$data->buid_id)) ?>" target="_blank">查看</a>
    <?php }elseif($data->buid_type == 2){ ?>
    <a href="<?php echo MAINHOST.Yii::app()->createUrl('/communitybaseinfo/view',array('id'=>$data->buid_id)) ?>" target="_blank">查看</a>
    <?php } ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('att_type')); ?>:</b>
	<?php echo CHtml::encode(Attachment::$attTypeName[$data->att_type]); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('up_uid')); ?>:</b>
	<?php echo CHtml::encode($data->up_uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('path')); ?>:</b>
	<?php echo CHtml::link($data->path,array('/attachment/download', 'id'=>$data->id),array('target'=>'_blank')); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isuse')); ?>:</b>
	<?php echo CHtml::encode($data->isuse); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('downloads')); ?>:</b>
	<?php echo CHtml::encode($data->downloads); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('money')); ?>:</b>
	<?php echo CHtml::encode($data->money); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time')); ?>:</b>
	<?php echo CHtml::encode($data->time); ?>
	<br />

</div>