<?php
$this->breadcrumbs=array(
	'全景资源管理'=>array('index'),
    '楼盘中心'
);

$this->menu=array(
	array('label'=>'商务中心全景', 'url'=>array('businessIndex')),
	array('label'=>'管理全景', 'url'=>array('admin')),
);
?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_systembuildingView',
)); ?>