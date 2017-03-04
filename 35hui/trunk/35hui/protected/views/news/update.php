<?php
$this->breadcrumbs=array(
	'News'=>array('index'),
	$model->n_id=>array('view','id'=>$model->n_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List news', 'url'=>array('index')),
	array('label'=>'Create news', 'url'=>array('create')),
	array('label'=>'View news', 'url'=>array('view', 'id'=>$model->n_id)),
	array('label'=>'Manage news', 'url'=>array('admin')),
);
?>

<h1>Update news <?php echo $model->n_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>