<?php
$this->breadcrumbs=array(
	'写字楼基本房源信息'=>array('index'),
	$model->ob_officeid=>array('view','id'=>$model->ob_officeid),
	'修改',
);
$this->currentMenu = 11;
$this->menu=array(
	array('label'=>'浏览所有数据', 'url'=>array('index')),
	array('label'=>'新建数据', 'url'=>array('create')),
	array('label'=>'查看数据', 'url'=>array('view', 'id'=>$model->ob_officeid)),
	array('label'=>'管理数据', 'url'=>array('admin')),
);
?>

<h1>Update officebaseinfo <?php echo $model->ob_officeid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>