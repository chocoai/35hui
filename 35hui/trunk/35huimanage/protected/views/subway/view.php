<?php
$this->breadcrumbs=array(
	'所有站点'=>array('index'),
	$model->sw_id,
);

$this->menu=array(
	array('label'=>'所有站点', 'url'=>array('index')),
	array('label'=>'创建站点', 'url'=>array('create')),
	array('label'=>'更新站点', 'url'=>array('update', 'id'=>$model->sw_id)),
	array('label'=>'删除站点', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->sw_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理所有站点', 'url'=>array('admin')),
);
?>

<h1>View Subway #<?php echo $model->sw_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'sw_id',
		'sw_stationname',
		'sw_parentid',
		'sw_x',
		'sw_y',
	),
)); ?>
