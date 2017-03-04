<?php
$this->breadcrumbs=array(
	'经纪人评论'=>array('index'),
	$model->uac_id,
);

$this->menu=array(
	array('label'=>'评论列表', 'url'=>array('index')),
	array('label'=>'删除评论', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->uac_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'评论管理', 'url'=>array('admin')),
);
?>

<h1>View Uagentcomment #<?php echo $model->uac_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'uac_id',
		'uac_cid',
		'uac_agentid',
		'uac_quality',
		'uac_service',
		'uac_comment',
		'uac_comdate',
	),
)); ?>
