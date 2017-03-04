<?php
$this->breadcrumbs=array(
	'图片新闻'=>array('index'),
	$model->np_id=>array('view','id'=>$model->np_id),
	'更新',
);
$this->currentMenu = 29;
$this->menu=array(
	array('label'=>'查看清单', 'url'=>array('index')),
	array('label'=>'创建图片新闻', 'url'=>array('create')),
	array('label'=>'查看图片新闻', 'url'=>array('view', 'id'=>$model->np_id)),
	array('label'=>'管理所有', 'url'=>array('admin')),
);
?>

<h1>更新图片新闻<?php echo $model->np_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'action'=>"update")); ?>