<?php
$this->breadcrumbs=array(
	'经纪人评论',
);

$this->menu=array(
	array('label'=>'评论管理', 'url'=>array('admin')),
);
?>

<h1>经纪人评论</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
