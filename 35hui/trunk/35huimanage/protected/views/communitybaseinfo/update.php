<?php
$this->currentMenu = 18;
$this->breadcrumbs=array(
	'小区管理'=>array('index'),
	$model->comy_name=>array('view','id'=>$model->comy_id),
	'修改基本信息',
);

$this->menu=array(
	array('label'=>'查看所有小区', 'url'=>array('index')),
	array('label'=>'新增小区', 'url'=>array('create')),
	array('label'=>'查看此小区信息', 'url'=>array('view', 'id'=>$model->comy_id)),
	array('label'=>'管理小区', 'url'=>array('admin')),
);
?>

<h1>修改楼盘Id为 <?php echo $model->comy_id; ?>的数据</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>