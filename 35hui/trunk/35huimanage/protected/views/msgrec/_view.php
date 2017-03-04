<div class="view">

    <div class="right-tip">
        <div class="font-20" style="float:left;">Id&nbsp;</div>
        <div class="right-id-tip deepskyblue">
            <?php echo CHtml::link(CHtml::encode($data->mr_id), array('view', 'id'=>$data->mr_id)); ?>
        </div>
    </div>

	<b><?php echo CHtml::encode($data->getAttributeLabel('mr_sendid')); ?>:</b>
	<?php echo User::model()->getUserShowLink($data->mr_sendid),CHtml::encode(User::model()->getUserName($data->mr_sendid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mr_content')); ?>:</b>
	<?php echo strCut(CHtml::encode($data->mr_content),100); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('mr_replay')); ?>:</b>
	<?php echo $data->mr_replay?CHtml::encode($data->mr_replay):'<font style="color:red">未处理</font>'; ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('mr_time')); ?>:</b>
	<?php echo CHtml::encode(showFormatDateTime($data->mr_time)); ?>
	<br />
    <?php if($data->mr_rtime){?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('mr_rtime')); ?>:</b>
	<?php echo CHtml::encode(showFormatDateTime($data->mr_rtime)); ?>
	<br />
    <?php }?>

</div>