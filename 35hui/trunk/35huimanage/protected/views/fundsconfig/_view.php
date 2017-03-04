<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fc_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fc_id), array('view', 'id'=>$data->fc_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fc_rmbprice')); ?>:</b>
	<?php echo CHtml::encode($data->fc_rmbprice?$data->fc_rmbprice.'元':'面议'); ?>&nbsp;
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fc_giveprice')); ?>:</b>
	<?php echo CHtml::encode($data->fc_giveprice?$data->fc_giveprice:($data->fc_type==1?"不赠送":'面议')); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fc_givepoint')); ?>:</b>
	<?php echo CHtml::encode($data->fc_givepoint?$data->fc_givepoint:($data->fc_type==1?"不赠送":'面议')); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fc_givepanoramadevice')); ?>:</b>
	<?php echo CHtml::encode($data->fc_givepanoramadevice?$data->fc_givepanoramadevice:($data->fc_type==1?"不赠送":'面议')); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('fc_type')); ?>:</b>
	<?php echo CHtml::encode(Fundsconfig::$fc_type[$data->fc_type]); ?>
	<br />
    <b><?php echo CHtml::encode($data->getAttributeLabel('fc_vipexp')); ?>:</b>
	<?php echo CHtml::encode($data->fc_vipexp); ?>
	<br />


</div>