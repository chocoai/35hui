<?php
$this->breadcrumbs=array(
	'Quickreleases',
);

$this->menu=array(
	array('label'=>'Manage Quickrelease', 'url'=>array('admin')),
);
?>

<h1>Quickreleases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
