<?php
$this->breadcrumbs=array(
	'价目列表'=>array('index'),
	$model->fc_id,
);

$this->menu=array(
	array('label'=>'价目列表', 'url'=>array('index')),
	array('label'=>'新建价目', 'url'=>array('create')),
	array('label'=>'更新价目', 'url'=>array('update', 'id'=>$model->fc_id)),
	array('label'=>'删除价目', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->fc_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理价目', 'url'=>array('admin')),
);
?>

<h1>查看价目： ID<?php echo $model->fc_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fc_id',
        array(
            "name"=>"fc_rmbprice",
            "value"=>$model->fc_rmbprice?$model->fc_rmbprice." 元":'面议',
        ),
        array(
            "name"=>"fc_giveprice",
            "value"=>$model->fc_giveprice?$model->fc_giveprice:($model->fc_type==1?"不赠送":'面议'),
        ),
        array(
            "name"=>"fc_givepoint",
            "value"=>$model->fc_givepoint?$model->fc_givepoint:($model->fc_type==1?"不赠送":'面议'),
        ),
        array(
            "name"=>"fc_givepanoramadevice",
            "value"=>$model->fc_givepanoramadevice?$model->fc_givepanoramadevice:($model->fc_type==1?"不赠送":'面议'),
        ),
        array(
            "name"=>"fc_type",
            "value"=>Fundsconfig::$fc_type[$model->fc_type],
        ),
        'fc_vipexp',
	),
)); ?>
