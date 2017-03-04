<?php
$this->breadcrumbs=array(
	'Businesscenters'=>array('index'),
	$model->bc_id=>array('view','id'=>$model->bc_id),
	'Update',
);

$this->menu=array(
	array('label'=>'新建商务中心', 'url'=>array('create')),
	array('label'=>'查看', 'url'=>array('view', 'id'=>$model->bc_id)),
	array('label'=>'管理', 'url'=>array('admin')),
);
?>

<h1>Update Businesscenter <?php echo $model->bc_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>