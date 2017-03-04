<div class="view">

	<b>自增ID：</b>
	<?php echo CHtml::encode($data->comyc_id); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php echo CHtml::link('删除评论', '#', array('submit'=>array('deleteComment','id'=>$data->comyc_id),'confirm'=>'确定删除此评论吗?'));?>
    <br />
	<b>用户ID：</b>
	<?php echo CHtml::encode($data->comyc_uid); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
	<b>小区ID：</b>
	<?php echo CHtml::encode($data->comyc_comyid); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
	<b>评论内容：</b>
	<?php echo CHtml::encode($data->comyc_comment); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
	<b>发表时间：</b>
	<?php echo CHtml::encode(date("Y-m-d",$data->comyc_comdate)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<br />
        
</div>