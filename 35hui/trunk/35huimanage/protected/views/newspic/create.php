<?php
$this->breadcrumbs=array(
	'图片新闻'=>array('index'),
	'创建图片新闻',
);
$this->currentMenu = 29;
$this->menu=array(
	array('label'=>'查看清单', 'url'=>array('index')),
	array('label'=>'管理所有', 'url'=>array('admin')),
);
?>

<h1>创建图片新闻</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>