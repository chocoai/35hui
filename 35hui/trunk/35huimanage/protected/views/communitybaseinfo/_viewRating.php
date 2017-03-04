<div class="view">

	<b>自增ID：</b>
	<?php echo CHtml::encode($data->cr_id); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php echo CHtml::link('删除评分', '#', array('submit'=>array('deleteRating','id'=>$data->cr_id),'confirm'=>'确定删除此评分吗?'));?>
    <br />
	<b>用户ID：</b>
	<?php echo CHtml::encode($data->cr_uid); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
	<b>小区ID：</b>
	<?php echo CHtml::encode($data->cr_comyid); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
	<b>分数：</b>
	<?php echo CHtml::encode($data->cr_score); ?>/10&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
	<b>评分时间：</b>
	<?php echo CHtml::encode(date("Y-m-d",$data->cr_ratdate)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<br />
        
</div>