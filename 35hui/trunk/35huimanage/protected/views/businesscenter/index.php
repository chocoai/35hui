<?php
$this->breadcrumbs=array(
	'商务中心',
);

$this->menu=array(
	array('label'=>'新建商务中心', 'url'=>array('create')),
	array('label'=>'管理', 'url'=>array('admin')),
);
?>

<h1>Businesscenters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
