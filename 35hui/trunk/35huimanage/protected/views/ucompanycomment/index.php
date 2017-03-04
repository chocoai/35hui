<?php
$this->breadcrumbs=array(
	'中介公司评论',
);

$this->menu=array(
	array('label'=>'评论管理', 'url'=>array('admin')),
);
?>

<h1>中介公司评论</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
