<?php
$this->currentMenu = 18;
$this->breadcrumbs=array(
	'楼盘管理',
    '基本信息管理'
);

$this->menu=array(
	array('label'=>'返回该楼盘信息', 'url'=>array('systembuildinginfo/view/id/'.$id)),
);
?>

<h1>楼盘印象</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewImpression',
)); ?>
