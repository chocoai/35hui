<?php
$this->breadcrumbs=array(
	'Combos',
);

$this->menu=array(
	array('label'=>'新建套餐', 'url'=>array('create')),
	array('label'=>'管理套餐', 'url'=>array('admin')),
);
?>

<h1>Combos</h1>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
