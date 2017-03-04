<?php
$this->breadcrumbs=array(
	'全景资源管理',
);

$this->menu=array(
	array('label'=>'管理全景', 'url'=>array('admin')),
    array('label'=>'获取唯一地址', 'url'=>array('getdir')),
);
?>

<h1>浏览所有全景</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_buildingView',
)); ?>
