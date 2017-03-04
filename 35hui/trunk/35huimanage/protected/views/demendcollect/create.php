<?php
$this->breadcrumbs=array(
	'所有记录'=>array('index'),
	'新建',
);

$this->menu=array(
	array('label'=>'所有记录', 'url'=>array('index')),
	array('label'=>'管理记录', 'url'=>array('admin')),
);
?>

<h1>新增记录</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>