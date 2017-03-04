<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('hl_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->hl_id), array('view', 'id'=>$data->hl_id)); ?>
	<div style="float:right;width:100px"><?if(in_array($data->hl_type,array(1,2,3)))echo Homelist::$type[$data->hl_type];?></div>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hl_type')); ?>:</b>
	<?php echo CHtml::encode($data->hl_type); ?>
	
	
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hl_piclist')); ?>:</b>
	<?php echo CHtml::encode($data->hl_piclist); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hl_titlelist')); ?>:</b>
	<?php echo CHtml::encode($data->hl_titlelist); ?>
	<br />


</div>