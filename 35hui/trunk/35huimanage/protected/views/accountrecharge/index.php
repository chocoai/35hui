<?php
$this->breadcrumbs=array(
	'用户充值管理',
);
?>

<h1>用户充值管理</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
