<?php
$this->breadcrumbs=array(
	'Oprationconfigs'=>array('index'),
	$model->ocf_id,
);

$this->menu=array(
	array('label'=>'配置列表', 'url'=>array('index')),
	array('label'=>'新建配置', 'url'=>array('create')),
	array('label'=>'修改配置', 'url'=>array('update', 'id'=>$model->ocf_id)),
	
	array('label'=>'配置管理', 'url'=>array('admin')),
);
?>

<h1>所有配置 #<?php echo $model->ocf_id; ?></h1>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ocf_id',
		'ocf_name',
		'ocf_key',
		'ocf_val',
		'ocf_desc',
	),
)); ?>
