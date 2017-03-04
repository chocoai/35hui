<?php
$this->breadcrumbs=array(
	'Combos'=>array('index'),
	$model->cb_id,
);

$this->menu=array(
	array('label'=>'所有套餐', 'url'=>array('index')),
	array('label'=>'创建套餐', 'url'=>array('create')),
	array('label'=>'修改套餐', 'url'=>array('update', 'id'=>$model->cb_id)),
	array('label'=>'删除套餐', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cb_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理套餐', 'url'=>array('admin')),
);
?>

<h1>View Combo #<?php echo $model->cb_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cb_id',
        'cb_name',
		'cb_issuednum',
		'cb_inputnum',
		'cb_refreshnum',
        array(
            "name"=>"cb_comboprice",
            "value"=>$model->cb_comboprice."元/月"
        ),
        array(
            "name"=>"cb_iconurl",
            "type"=>"image",
            "value"=>MAINHOST.$model->cb_iconurl,
        ),
	),
)); ?>
