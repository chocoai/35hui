<?php
$this->breadcrumbs=array(
	'Oprationconfigs'=>array('index'),
	'Create',
);


$this->menu=array(
	array('label'=>'配置列表', 'url'=>array('index')),
	array('label'=>'配置管理', 'url'=>array('admin')),
);
?>

<h1>新建配置</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>