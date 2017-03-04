<?php
$this->breadcrumbs=array(
	'Officecomments'=>array('index'),
	$model->oc_id,
);

$this->menu=array(
	array('label'=>'评论列表', 'url'=>array('index')),
	array('label'=>'删除评论', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->oc_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'评论管理', 'url'=>array('admin')),
);
?>

<h1>View Officecomment #<?php echo $model->oc_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'oc_id',
		'oc_cid',
		'oc_officeid',
		'oc_traffice',
		'oc_facility',
		'oc_adorn',
		'oc_comment',
		'oc_comdate',
	),
)); ?>
