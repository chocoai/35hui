<?php
$this->breadcrumbs=array(
	'Regions'=>array('index'),
	$model->re_id,
);

$this->menu=array(
	array('label'=>'List region', 'url'=>array('index')),
	array('label'=>'Create region', 'url'=>array('create')),
	array('label'=>'Update region', 'url'=>array('update', 'id'=>$model->re_id)),
	array('label'=>'Delete region', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->re_id),'confirm'=>'Are you sure to delete this item?')),
	array('label'=>'Manage region', 'url'=>array('admin')),
);
?>

<h1>View region #<?php echo $model->re_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		're_id',
		're_name',
		're_parent_id',
	),
)); ?>
