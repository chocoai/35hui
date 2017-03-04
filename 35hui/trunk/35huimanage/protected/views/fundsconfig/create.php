<?php
$this->breadcrumbs=array(
	'价目列表'=>array('index'),
	'新建',
);

$this->menu=array(
	array('label'=>'价目列表', 'url'=>array('index')),
	array('label'=>'管理价目', 'url'=>array('admin')),
);
?>

<h1>新建价目</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>