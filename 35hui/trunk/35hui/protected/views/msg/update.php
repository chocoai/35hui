<?php
$this->breadcrumbs=array(
	'Msgs'=>array('index'),
	$model->msg_id=>array('view','id'=>$model->msg_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List msg', 'url'=>array('index')),
	array('label'=>'Create msg', 'url'=>array('create')),
	array('label'=>'View msg', 'url'=>array('view', 'id'=>$model->msg_id)),
	array('label'=>'Manage msg', 'url'=>array('admin')),
);
?>

<h1>Update msg <?php echo $model->msg_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>