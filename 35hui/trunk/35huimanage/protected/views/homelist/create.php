<?php
$this->breadcrumbs=array(
	'首页模块'=>array('index'),
	'创建',
);

$this->menu=array(
	array('label'=>'查看', 'url'=>array('index')),
	array('label'=>'管理', 'url'=>array('admin')),
);
?>

<h1>Create Homelist</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>