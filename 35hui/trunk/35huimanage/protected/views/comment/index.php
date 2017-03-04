<?php
$this->breadcrumbs=array(
	'新闻评论',
);

$this->menu=array(
	array('label'=>'评论管理', 'url'=>array('admin')),
);
?>

<h1>新闻评论</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
