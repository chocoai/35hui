<?php
$this->currentMenu = 77;
$this->breadcrumbs=array(
	'小区管理',
    '基本信息管理'
);

$this->menu=array(
	array('label'=>'返回该小区信息', 'url'=>array('communitybaseinfo/view/id/'.$id)),
);
?>

<h1>小区评分</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewRating',
)); ?>