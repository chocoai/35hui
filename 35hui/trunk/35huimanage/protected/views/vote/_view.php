<div class="view">
	<b>ID:</b>
	<?php echo CHtml::encode($data->vt_id);?>
	<br />
	<b>调查描述:</b>
	<?php echo CHtml::encode($data->vt_vote),' ';
        echo CHtml::link('修改', array('update', 'id'=>$data->vt_id));
        echo '/';
        echo CHtml::link('删除','#',array('submit'=>array('delete','id'=>$data->vt_id),'confirm'=>'Are you sure you want to delete this item?'));
    ?>
	<br />

    <?php if(empty($vote_parent)){ ?>
    <b>选择模式:</b>
	<?php echo $data->vt_num?'多选':'单选'; ?>
	<br />
    <b><?php echo CHtml::link('查看调查选项',array('index','parent'=>$data->vt_id)),' / ',CHtml::link('添加调查选项',array('create','parent'=>$data->vt_id)) ?></b>
	<br />
    <?php }else{ ?>
	<b>投票数:</b>
	<?php echo CHtml::encode($data->vt_num); ?>
	<br />
    <?php } ?>
</div>