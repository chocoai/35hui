<?php
$this->breadcrumbs=array(
	'地区信息'=>array('index'),
	$model->re_id,
);

$this->menu=array(
	array('label'=>'浏览数据', 'url'=>array('index')),
	array('label'=>'新建数据', 'url'=>array('create')),
	array('label'=>'修改数据', 'url'=>array('update', 'id'=>$model->re_id)),
	array('label'=>'删除数据', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->re_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理数据', 'url'=>array('admin')),
);
?>

<h1>View Region #<?php echo $model->re_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		're_id',
		're_name',
		're_parent_id',
        "re_recommendprice",
	),
)); ?>
