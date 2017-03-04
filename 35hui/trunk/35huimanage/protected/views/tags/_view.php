<div class="view">

	<b>标签ID：</b>
	<?php echo CHtml::link(CHtml::encode($data->tag_id), array('view', 'id'=>$data->tag_id)); ?>
	<br />

	<b>标签名称：</b>
	<?php echo CHtml::encode($data->tag_name); ?>
	<br />

	<b>所属房源类型：</b>
	<?php echo Tags::$tag_belong[$data->tag_belong]; ?>
	<br />

	<b>点击率：</b>
	<?php echo CHtml::encode($data->tag_frequency); ?>
	<br />
	<b>租售类型：</b>
	<?php echo  Tags::$markettype[$data->markettype]; ?>
	<br />


</div>