<?php
$this->breadcrumbs=array(
	'创意园区'=>array('admin'),
	$model->cp_id=>array('view','id'=>$model->cp_id),
	'Update',
);

$this->menu=array(
	array('label'=>'创建', 'url'=>array('create')),
	array('label'=>'查看', 'url'=>array('view', 'id'=>$model->cp_id)),
	array('label'=>'管理', 'url'=>array('admin')),
);
?>

<h1>Update Creativeparkbaseinfo <?php echo $model->cp_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>