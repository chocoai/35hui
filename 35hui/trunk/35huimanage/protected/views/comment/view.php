<?php
$this->breadcrumbs=array(
	'新闻评论'=>array('index'),
	$model->c_id,
);

$this->menu=array(
	array('label'=>'评论列表', 'url'=>array('index')),
	array('label'=>'删除评论', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->c_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'评论管理', 'url'=>array('admin')),
);
?>

<h1>查看评论 #<?php echo $model->c_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'c_id',
		'n_id',
		'user_id',
		'c_comment',
		'c_date',
	),
)); ?>
