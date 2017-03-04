<?php
$this->breadcrumbs=array(
	'价目列表'=>array('index'),
	$model->fc_id=>array('view','id'=>$model->fc_id),
	'更新',
);

$this->menu=array(
	array('label'=>'价目列表', 'url'=>array('index')),
	array('label'=>'创建价目', 'url'=>array('create')),
	array('label'=>'查看价目', 'url'=>array('view', 'id'=>$model->fc_id)),
	array('label'=>'管理价目', 'url'=>array('admin')),
);
?>

<h1>更新价目ID:<?php echo $model->fc_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>