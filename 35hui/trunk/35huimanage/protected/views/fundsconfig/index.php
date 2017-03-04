<?php
$this->breadcrumbs=array(
	'价目表',
);

$this->menu=array(
	array('label'=>'新建价目', 'url'=>array('create')),
	array('label'=>'管理价目', 'url'=>array('admin')),
);
?>

<h1>账务充值价目表</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
