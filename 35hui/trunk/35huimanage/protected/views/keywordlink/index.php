<?php
$this->breadcrumbs=array(
	'Keywordlinks',
);

$this->menu=array(
	array('label'=>'新建关键词', 'url'=>array('create')),
	array('label'=>'管理关键词', 'url'=>array('admin')),
);
?>

<h1>Keywordlinks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
