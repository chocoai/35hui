<?php
$this->breadcrumbs=array(
	'商务中心评论',
);

$this->menu=array(
	array('label'=>'评论管理', 'url'=>array('admin')),
);
?>

<h1>商务中心评论列表</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
