<?php
$this->breadcrumbs=array(
	'Domainkeys'=>array('index'),
	$model->dk_id,
);

$this->menu=array(
	array('label'=>'列表', 'url'=>array('index')),
	array('label'=>'新建', 'url'=>array('create')),
	array('label'=>'删除', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->dk_id),'confirm'=>'确定删除此条记录吗？')),
	array('label'=>'修改', 'url'=>array('update', 'id'=>$model->dk_id)),
    array('label'=>'管理', 'url'=>array('admin')),
);
?>

<h1>View Domainkey #<?php echo $model->dk_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'dk_id',
        array(
            "name"=>"dk_name",
            'type'=>'raw',
            "value"=>Domainkey::model()->getValue($model->dk_name),
        ),
		'kd_key',
	),
)); ?>
