<?php
$this->currentMenu = 77;
$this->breadcrumbs=array(
	'小区管理'=>array('index'),
	'新建',
);

$this->menu=array(
	array('label'=>'查看所有小区', 'url'=>array('index')),
	array('label'=>'管理小区', 'url'=>array('admin')),
);
?>

<h1>新建小区</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>