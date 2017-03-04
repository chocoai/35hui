<?php
$this->breadcrumbs=array(
	'Examchoices',
);

$this->menu=array(
	array('label'=>'新建题目', 'url'=>array('create')),
	array('label'=>'管理题目', 'url'=>array('admin')),
    array('label'=>'管理等级描述', 'url'=>array('/examdescribe/admin')),
);
?>

<h1>经纪人考试</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
