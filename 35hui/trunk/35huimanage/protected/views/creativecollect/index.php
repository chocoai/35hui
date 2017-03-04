<?php
$this->breadcrumbs=array(
	'Creativecollects',
);
$this->currentMenu = 128;

?>

<h1>创意园区征集</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
