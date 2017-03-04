<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fl_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fl_id), array('view', 'id'=>$data->fl_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fl_value')); ?>:</b>
	<?php echo CHtml::encode($data->fl_value); ?>
	<br />
    <b><?php echo CHtml::encode($data->getAttributeLabel('fl_type')); ?>:</b>
	<?php 
    echo CHtml::encode(Friendlink::$fl_type[$data->fl_type]);
    if($data->fl_type==6){
        echo CHtml::image($data->fl_picurl,"",array("width"=>"90px","height"=>"30px"));
    }
    ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fl_url')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fl_url),$data->fl_url,array("target"=>"_blank")); ?>
	<br />
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('fl_createtime')); ?>:</b>
	<?php echo CHtml::encode(date("Y-m-d H:i:s", $data->fl_createtime)); ?>
	<br />


</div>