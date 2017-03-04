<?php
$this->breadcrumbs=array(
	'Homelists'=>array('index'),
	$model->hl_id=>array('view','id'=>$model->hl_id),
	'Update',
);

$this->menu=array(
	array('label'=>'查看', 'url'=>array('index')),
	array('label'=>'创建', 'url'=>array('create')),
	array('label'=>'详细', 'url'=>array('view', 'id'=>$model->hl_id)),
	array('label'=>'管理', 'url'=>array('admin')),
);
?>

<h1>Update Homelist <?php echo $model->hl_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>