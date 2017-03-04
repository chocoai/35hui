<?php
$this->breadcrumbs=array(
	'资讯',
);
$this->currentMenu = 34;
$this->menu=array(
	array('label'=>'添加资讯', 'url'=>array('create')),
	array('label'=>'管理资讯', 'url'=>array('admin')),
);
?>

<h1>资讯</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
