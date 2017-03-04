<?php
$this->breadcrumbs=array(
	'News'=>array('index'),
	$model->n_id,
);

$this->menu=array(
	array('label'=>'List news', 'url'=>array('index')),
	array('label'=>'Create news', 'url'=>array('create')),
	array('label'=>'Update news', 'url'=>array('update', 'id'=>$model->n_id)),
	array('label'=>'Delete news', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->n_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage news', 'url'=>array('admin')),
);
?>

<h1>View news #<?php echo $model->n_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'n_id',
		'n_title',
		'n_content',
		'n_date',
		'n_picture',
		'n_from',
		'n_state',
	),
)); ?>
