<?php
$this->currentMenu = 18;
$this->breadcrumbs=array(
	'楼盘管理'=>array('index'),
	$model->sbi_buildingname=>array('view','id'=>$model->sbi_buildingid),
	'修改基本信息',
);

$this->menu=array(
	array('label'=>'查看所有楼盘', 'url'=>array('index')),
	array('label'=>'新增楼盘', 'url'=>array('create')),
	array('label'=>'查看此楼盘信息', 'url'=>array('view', 'id'=>$model->sbi_buildingid)),
	array('label'=>'管理楼盘', 'url'=>array('admin')),
);
?>

<h1>修改楼盘Id为 <?php echo $model->sbi_buildingid; ?>的数据</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>