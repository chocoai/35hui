<?php
$this->breadcrumbs=array(
	'News',
);

$this->menu=array(
	array('label'=>'Create news', 'url'=>array('create')),
	array('label'=>'Manage news', 'url'=>array('admin')),
);
?>

<h1>News</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
