<?php
$this->breadcrumbs=array(
	'地区信息'=>array('index'),
	'新建',
);

$this->menu=array(
	array('label'=>'浏览数据', 'url'=>array('index')),
	array('label'=>'管理数据', 'url'=>array('admin')),
);
?>

<h1>新建 地区信息</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'region-grid',
	'dataProvider'=>$searchModel->search(),
	'filter'=>$searchModel,
	'columns'=>array(
		're_id',
		're_name',
		're_parent_id',
        "re_recommendprice",
	),
)); ?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>