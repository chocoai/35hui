<div class="view">

	<b>印象内容：</b>
	<?php echo CHtml::encode($data->im_description); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php echo CHtml::link('删除印象', '#', array('submit'=>array('deleteImpression','id'=>$data->im_id),'confirm'=>'确定删除此印象吗?'));?>
	<br />

	<b>支持数:</b>
	<?php echo CHtml::encode($data->im_pro); ?>
        <br />
</div>