<?php
$this->breadcrumbs=array(
	'Keywordlinks'=>array('index'),
	$model->kdl_id,
);

$this->menu=array(
	array('label'=>'关键词列表', 'url'=>array('index')),
	array('label'=>'新建关键词', 'url'=>array('create')),
	array('label'=>'修改', 'url'=>array('update', 'id'=>$model->kdl_id)),
	array('label'=>'删除', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->kdl_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理关键词', 'url'=>array('admin')),
);
?>

<h1>View Keywordlink #<?php echo $model->kdl_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'kdl_id',
		'kdl_name',
		'kdl_url',
	),
)); ?>
