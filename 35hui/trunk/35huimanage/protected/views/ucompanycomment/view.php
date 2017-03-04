<?php
$this->breadcrumbs=array(
	'中介公司评论'=>array('index'),
	$model->ucc_id,
);

$this->menu=array(
	array('label'=>'评论列表', 'url'=>array('index')),
	array('label'=>'删除评论', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ucc_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'评论管理', 'url'=>array('admin')),
);
?>

<h1>查看评论 #<?php echo $model->ucc_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ucc_id',
		'ucc_cid',
		'ucc_comid',
		'ucc_quality',
		'ucc_service',
		'ucc_comment',
		'ucc_comdate',
	),
)); ?>
