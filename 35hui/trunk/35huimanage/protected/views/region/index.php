<?php
$this->breadcrumbs=array(
	'地区信息',
);

$this->menu=array(
	array('label'=>'新建数据', 'url'=>array('create')),
	array('label'=>'管理数据', 'url'=>array('admin')),
);
?>

<h1>Regions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
