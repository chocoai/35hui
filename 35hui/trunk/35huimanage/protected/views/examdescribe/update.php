<?php
$this->breadcrumbs=array(
	'Examdescribes'=>array('index'),
	$model->ed_id=>array('view','id'=>$model->ed_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Examdescribe', 'url'=>array('index')),
	array('label'=>'Create Examdescribe', 'url'=>array('create')),
	array('label'=>'View Examdescribe', 'url'=>array('view', 'id'=>$model->ed_id)),
	array('label'=>'Manage Examdescribe', 'url'=>array('admin')),
);
?>

<h1>Update Examdescribe <?php echo $model->ed_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>