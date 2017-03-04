<?php
$this->breadcrumbs=array(
	'友情链接'=>array('index'),
	$model->fl_id,
);

$this->menu=array(
	array('label'=>'友情链接列表', 'url'=>array('index')),
	array('label'=>'创建友情链接', 'url'=>array('create')),
	array('label'=>'修改', 'url'=>array('update', 'id'=>$model->fl_id)),
	array('label'=>'删除', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->fl_id),'confirm'=>'确定要删除此条数据吗？')),
	array('label'=>'管理友情链接', 'url'=>array('admin')),
);
?>

<h1>查看 #<?php echo $model->fl_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fl_id',
        array(
            "name"=>"fl_type",
            "value"=>Friendlink::$fl_type[$model->fl_type],
        ),
		'fl_value',
        array(
            "name"=>"fl_url",
            "value"=>$model->fl_url,
            "type"=>"url",
        ),
        array(
            "name"=>"fl_createtime",
            "fl_createtime"=>$model->fl_createtime,
            "type"=>"datetime"
        ),
	),
)); ?>
