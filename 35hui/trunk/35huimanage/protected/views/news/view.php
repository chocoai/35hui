<?php
$this->breadcrumbs=array(
	'资讯'=>array('index'),
	$model->n_id,
);
$this->currentMenu = 34;
$this->menu=array(
	array('label'=>'查看清单', 'url'=>array('index')),
	array('label'=>'创建资讯', 'url'=>array('create')),
	array('label'=>'更新资讯', 'url'=>array('update', 'id'=>$model->n_id)),
	array('label'=>'删除资讯', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->n_id),'confirm'=>'确定要删除此资讯吗？')),
	array('label'=>'管理资讯', 'url'=>array('admin')),
);
?>

<h1>查看资讯 #<?php echo $model->n_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'n_id',
		'n_title',
        'n_summary',
		array(
			'name'=>"n_content",
			'type'=>'raw',
			'value'=>$model->n_content,
		),
        array(
            "name"=>"n_date",
            "value"=>date("m/d/y", $model->n_date),
        ),
		'n_from',
        array(
            "name"=>"n_state",
            "value"=>News::$state[$model->n_state],
        ),
        array(
            "name"=>"n_leave",
            "value"=>News::$leave[$model->n_leave],
        ),
		'n_click',
		'n_keyword',
	),
)); ?>
