<div class="view" style="background-color: #f0f8ff">

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrq_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->qrq_id), array('view', 'id'=>$data->qrq_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrq_title')); ?>:</b>
	<?php echo CHtml::encode($data->qrq_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrq_rstype')); ?>:</b>
	<?php echo Lookup::item('relsrtype',$data->qrq_rstype); ?>
	&nbsp;&nbsp;

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrq_usetype')); ?>:</b>
	<?php echo Lookup::item('usetype',$data->qrq_usetype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrq_province')); ?>:</b>
	<?php echo CHtml::encode(Region::model()->getNameById($data->qrq_province)); ?>
	&nbsp;&nbsp;

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrq_city')); ?>:</b>
	<?php echo CHtml::encode(Region::model()->getNameById($data->qrq_city)); ?>
	&nbsp;&nbsp;

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrq_district')); ?>:</b>
	<?php echo CHtml::encode(Region::model()->getNameById($data->qrq_district)); ?>
	&nbsp;&nbsp;

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrq_address')); ?>:</b>
	<?php echo CHtml::encode($data->qrq_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrq_desc')); ?>:</b>
    <div style="background-color:#ffffff;padding:5px"><?=htmlspecialchars_decode($data->qrq_desc);?></div>

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrq_contact')); ?>:</b>
	<?php echo CHtml::encode($data->qrq_contact); ?>
	&nbsp;&nbsp;

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrq_telephone')); ?>:</b>
	<?php echo CHtml::encode($data->qrq_telephone); ?>
	&nbsp;&nbsp;

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrq_qq')); ?>:</b>
	<?php echo CHtml::encode($data->qrq_qq); ?>
	&nbsp;&nbsp;

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrq_msn')); ?>:</b>
	<?php echo CHtml::encode($data->qrq_msn); ?>
	&nbsp;&nbsp;

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrq_releasedate')); ?>:</b>
	<?=common::showFormatDateTime($data->qrq_releasedate); ?>
	&nbsp;&nbsp;

	<b><?php echo CHtml::encode($data->getAttributeLabel('qrq_expiredate')); ?>:</b>
	<?=round($data->qrq_expiredate/86400).'天'?>
	<br />
</div>
<br/>