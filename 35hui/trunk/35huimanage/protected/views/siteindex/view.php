<?php
$this->breadcrumbs=array(
	'Siteindexes'=>array('index'),
	$model->si_id,
);

$this->menu=array(
	array('label'=>'返回列表', 'url'=>array('index')),
	array('label'=>'更改信息', 'url'=>array('update', 'id'=>$model->si_id)),
	array('label'=>'删除首页显示', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->si_id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Siteindex #<?php echo $model->si_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'si_id',
		'si_typeid',
		'si_desc',
		'si_advantages',
		'si_inferior',
		'si_link',
		'si_type',
		'si_time',
		'si_img',
		'si_num',
		'si_pricetype',
	),
)); ?>
