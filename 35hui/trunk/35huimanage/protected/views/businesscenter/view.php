<?php
$this->breadcrumbs=array(
	'Businesscenters'=>array('index'),
	$model->bc_id,
);

$this->menu=array(
	array('label'=>'新建', 'url'=>array('create')),
	array('label'=>'修改', 'url'=>array('update', 'id'=>$model->bc_id)),
	array('label'=>'删除', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->bc_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理', 'url'=>array('admin')),
    array('label'=>'图片', 'url'=>array('/picture/sourceView', 'sId'=>$model->bc_id,"sType"=>"3")),
    array('label'=>'全景', 'url'=>array('/subpanorama/sourcepanorama', 'id'=>$model->bc_id,"type"=>"3")),
);
?>

<h1>View Businesscenter #<?php echo $model->bc_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'bc_id',
		'bc_name',
		'bc_pinyinshortname',
		'bc_pinyinlongname',
		'bc_englishname',
		'bc_sysid',
		'bc_address',
		'bc_district',
		'bc_floor',
		'bc_completetime',
		'bc_rentprice',
		'bc_serverbrand',
		'bc_serverlanguage',
		'bc_decoratestyle',
		'bc_introduce',
		'bc_freeserver',
		'bc_payserver',
		'bc_traffic',
		'bc_peripheral',
		'bc_connecttel',
		'bc_releasetime',
		'bc_visit',
		'bc_titlepic',
	),
)); ?>
