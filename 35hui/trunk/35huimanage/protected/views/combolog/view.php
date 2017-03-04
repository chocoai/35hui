<?php
$this->breadcrumbs=array(
	'Combologs'=>array('index'),
	$model->cbl_id,
);

$this->menu=array(
	array('label'=>'查看套餐信息', 'url'=>array('showall')),
	array('label'=>'删除套餐信息', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cbl_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理套餐信息', 'url'=>array('admin')),
);
?>

<h1>View Combolog #<?php echo $model->cbl_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cbl_id',
		'cbl_uid',
		'cbl_content',
		'cbl_starttime',
		'cbl_endtime',
        'cbl_muid',
	),
)); ?>
