<?php
$this->breadcrumbs=array(
	'Regions'=>array('index'),
	$model->re_id=>array('view','id'=>$model->re_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Region', 'url'=>array('index')),
	array('label'=>'Create Region', 'url'=>array('create')),
	array('label'=>'View Region', 'url'=>array('view', 'id'=>$model->re_id)),
	array('label'=>'Manage Region', 'url'=>array('admin')),
);
?>

<h1>Update Region <?php echo $model->re_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>