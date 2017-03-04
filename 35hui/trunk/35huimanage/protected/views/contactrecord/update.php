<?php
$this->currentMenu = 100;
$this->breadcrumbs=array(
	'所有联系人'=>array('index'),
	$model->cr_realname=>array('view','id'=>$model->cr_id),
	'修改基本信息',
);

$this->menu=array(
	array('label'=>'查看所有联系人', 'url'=>array('index')),
	array('label'=>'新增联系人', 'url'=>array('create')),
	array('label'=>'查看此联系人信息', 'url'=>array('view', 'id'=>$model->cr_id)),
	array('label'=>'管理联系人', 'url'=>array('admin')),
);
?>

<h1>修改联系人Id为 <?php echo $model->cr_id; ?>的信息</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>