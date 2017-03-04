<?php
$this->breadcrumbs=array(
	'Systembuildingcomments'=>array('index'),
	$model->sbc_id,
);

$this->menu=array(
	array('label'=>'评论列表', 'url'=>array('index')),
	array('label'=>'删除评论', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->sbc_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'评论管理', 'url'=>array('admin')),
);
?>

<h1>View Systembuildingcomment #<?php echo $model->sbc_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'sbc_id',
		'sbc_cid',
		'sbc_buildingid',
		'sbc_traffice',
		'sbc_facility',
		'sbc_adorn',
		'sbc_comment',
		'sbc_comdate',
	),
)); ?>
