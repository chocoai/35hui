<div class="view">
    <div class="right-tip">
        <div class="font-20" style="float:left;">ID&nbsp;</div>
        <div class="right-id-tip deepskyblue">
            <?php echo CHtml::link($data->rbi_id, array('view', 'id'=>$data->rbi_id),array ("class"=>"right-id-tip deepskyblue")); ?>
        </div>
    </div>
	<b>小区名称:</b>
	<?php echo CHtml::encode($data->xiaoqu->comy_name); ?>
	<br />
    <b>房源标题:</b>
	<?php echo CHtml::encode($data->rbi_title); ?>
	<br />

	<b>租售类型:</b>
	<?php echo $data->rbi_rentorsell==2?'售出':'出租'; ?>
	<br />

	<b>用户:</b>
	<?=isset($data->user)?CHtml::encode($data->user->user_name):""; ?>
	<br />

	<b>状态:</b>
	<?php
    echo $data->tag->rt_ispanorama==1?"<font color='green'>景</font>&nbsp;&nbsp;":"";
    echo $data->tag->rt_ishurry==1?"<font color='green'>急</font>&nbsp;&nbsp;":"";
    echo $data->tag->rt_isrecommend==1?"<font color='green'>推</font>&nbsp;&nbsp;":"";
    echo $data->tag->rt_ishigh==1?"<font color='green'>优</font>&nbsp;&nbsp;":"";
    echo $data->tag->rt_read==0?"<font color='red'>未阅</font>&nbsp;&nbsp;":"已阅";
    ?>
	<br />
</div>