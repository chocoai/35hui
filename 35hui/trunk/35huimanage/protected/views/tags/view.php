<?php
$this->breadcrumbs=array(
	'Tags'=>array('index'),
	$model->tag_id,
);

$this->menu=array(
	array('label'=>'标签列表', 'url'=>array('index')),
	array('label'=>'新建标签', 'url'=>array('create')),
	array('label'=>'修改标签', 'url'=>array('update', 'id'=>$model->tag_id)),
	array('label'=>'删除标签', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->tag_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理标签', 'url'=>array('admin')),
);
?>

<h1>View Tags #<?php echo $model->tag_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'tag_id',
		'tag_name',
		'tag_belong',
		'tag_frequency',
		'markettype',
	),
)); ?>
