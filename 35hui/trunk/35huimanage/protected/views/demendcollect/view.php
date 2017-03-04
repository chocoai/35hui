<?php
$this->breadcrumbs=array(
	'所有记录'=>array('index'),
	$model->dc_id,
);

$this->menu=array(
	array('label'=>'所有记录', 'url'=>array('index')),
	array('label'=>'新建记录', 'url'=>array('create')),
	array('label'=>'编辑记录', 'url'=>array('update', 'id'=>$model->dc_id)),
	array('label'=>'删除记录', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->dc_id),'confirm'=>'确认删除这条记录')),
	array('label'=>'管理记录', 'url'=>array('admin')),
);
?>

<h1>查看 ID为<?php echo $model->dc_id; ?>的记录</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'dc_id',
                array(
                    'name'=>'dc_buildtype',
                    'value'=>  Demendcollect::$dc_buildtype[$model->dc_buildtype]
                ),
                array(
                    'name'=>'dc_type',
                    'value'=>  Demendcollect::$dc_type[$model->dc_type]
                ),
		'dc_buildname',
		'dc_address',
		'dc_area',
		'dc_price',
		'dc_floor',
		'dc_contactname',
		'dc_register',
		'dc_time',
		'dc_memo',
		'dc_tel',
		'dc_mobile',
		'dc_email',
		'dc_qq',
	),
)); ?>
