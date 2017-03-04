<?php
$this->breadcrumbs=array(
	'Demendcollects'=>array('index'),
	$model->dc_id=>array('view','id'=>$model->dc_id),
	'Update',
);

$this->menu=array(
	array('label'=>'所有记录', 'url'=>array('index')),
	array('label'=>'新建记录', 'url'=>array('create')),
	array('label'=>'查看记录', 'url'=>array('view', 'id'=>$model->dc_id)),
	array('label'=>'管理记录', 'url'=>array('admin')),
);
?>

<h1>编辑ID为<?php echo $model->dc_id; ?>的记录</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>