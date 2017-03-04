<?php
$this->breadcrumbs=array(
	'News'=>array('index'),
	'添加资讯',
);
$this->currentMenu = 34;
$this->menu=array(
	array('label'=>'查看清单', 'url'=>array('index')),
	array('label'=>'管理资讯', 'url'=>array('admin')),
);
?>

<h1>添加资讯</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>