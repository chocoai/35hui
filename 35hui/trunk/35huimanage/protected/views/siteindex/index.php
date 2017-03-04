<?php
$this->breadcrumbs=array(
	'首页楼盘显示列表',
);
?>

<h1>Siteindexes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
