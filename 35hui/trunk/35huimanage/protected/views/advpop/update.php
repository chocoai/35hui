<?php
$this->breadcrumbs=array(
	'Advpops'=>array('index'),
	$model->adp_id=>array('view','id'=>$model->adp_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Advpop', 'url'=>array('index')),
	array('label'=>'Create Advpop', 'url'=>array('create')),
	array('label'=>'View Advpop', 'url'=>array('view', 'id'=>$model->adp_id)),
	array('label'=>'Manage Advpop', 'url'=>array('admin')),
);
?>

<h1>Update Advpop <?php echo $model->adp_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>