<?php
$this->breadcrumbs=array(
	'Oprationconfigs'=>array('index'),
	$model->ocf_id=>array('view','id'=>$model->ocf_id),
	'Update',
);

$this->menu=array(
	array('label'=>'配置列表', 'url'=>array('index')),
	array('label'=>'新建配置', 'url'=>array('create')),
	array('label'=>'查看所有配置', 'url'=>array('view', 'id'=>$model->ocf_id)),
	array('label'=>'配置管理', 'url'=>array('admin')),
);
?>

<h1>修改配置<?php echo $model->ocf_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>