<?php
$this->breadcrumbs=array(
	'所有站点'=>array('index'),
	'创建',
);

$this->menu=array(
	array('label'=>'所有站点', 'url'=>array('index')),
	array('label'=>'管理站点', 'url'=>array('admin')),
);
?>

<h1>Create Subway</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>