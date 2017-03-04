<?php
$this->breadcrumbs=array(
	'完善与纠错',
);
$this->currentMenu = 57;
?>

<h1>完善与纠错</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
