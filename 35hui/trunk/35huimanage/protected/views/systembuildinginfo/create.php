<?php
$this->currentMenu = 18;
$this->breadcrumbs=array(
	'楼盘管理'=>array('index'),
	'新建',
);

$this->menu=array(
	array('label'=>'查看所有楼盘', 'url'=>array('index')),
	array('label'=>'管理楼盘', 'url'=>array('admin')),
);
?>

<h1>新建楼盘</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>