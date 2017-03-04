<?php
$this->breadcrumbs=array(
	'需求登记',
);

$this->menu=array(
	array('label'=>'管理', 'url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
