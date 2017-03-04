<?php
$this->breadcrumbs=array(
	'首页模块'=>array('index'),
	$model->hl_id,
);

$this->menu=array(
	array('label'=>'查看', 'url'=>array('index')),
	array('label'=>'创建', 'url'=>array('create')),
	array('label'=>'更新', 'url'=>array('update', 'id'=>$model->hl_id)),
	array('label'=>'删除', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->hl_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理', 'url'=>array('admin')),
);
?>

<h1>模块详细#<?php echo $model->hl_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'hl_id',
		'hl_type',
		'hl_piclist',
		'hl_titlelist',
	),
)); ?>
