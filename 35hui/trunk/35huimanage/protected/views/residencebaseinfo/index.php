<?php
$this->breadcrumbs=array(
	'住宅房源基本信息表',
);
$this->currentMenu = 79;
$this->menu=array(
	array('label'=>'住宅管理', 'url'=>array('admin')),
);
?>

<h1>浏览住宅基本数据</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
