<?php
$this->breadcrumbs=array(
	'Regions'=>array('index'),
	$model->re_id=>array('view','id'=>$model->re_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List region', 'url'=>array('index')),
	array('label'=>'Create region', 'url'=>array('create')),
	array('label'=>'View region', 'url'=>array('view', 'id'=>$model->re_id)),
	array('label'=>'Manage region', 'url'=>array('admin')),
);
?>

<h1>Update region <?php echo $model->re_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>