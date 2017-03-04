<?php
$this->breadcrumbs=array(
	'Domainkeys',
);

$this->menu=array(
	array('label'=>'新建', 'url'=>array('create')),
	array('label'=>'管理', 'url'=>array('admin')),
);
?>

<h1>Domainkeys</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
