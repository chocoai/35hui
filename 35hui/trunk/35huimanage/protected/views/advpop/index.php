<?php
$this->breadcrumbs=array(
	'Advpops',
);

$this->menu=array(
	array('label'=>'Create Advpop', 'url'=>array('create')),
);
?>

<h1>Advpops</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
