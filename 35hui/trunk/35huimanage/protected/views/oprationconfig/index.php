<?php
$this->breadcrumbs=array(
	'Oprationconfigs',
);

$this->menu=array(
	array('label'=>'新建配置', 'url'=>array('create')),
	array('label'=>'配置管理', 'url'=>array('admin')),
);
?>

<h1>配置列表</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
