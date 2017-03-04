<?php
$this->breadcrumbs=array(
	'楼盘纠错管理'=>array('index'),
    '查看纠错历史'
);
$this->menu=array(
	array('label'=>'查看所有纠错信息', 'url'=>array('index')),
);
?>

<h1>纠错历史</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
