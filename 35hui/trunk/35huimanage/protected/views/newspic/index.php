<?php
$this->breadcrumbs=array(
    '图片新闻'=>array('index'),
);
$this->currentMenu = 29;
$this->menu=array(
	array('label'=>'创建图片新闻', 'url'=>array('create')),
	array('label'=>'管理所有', 'url'=>array('admin')),
);
?>

<h1>图片新闻</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
