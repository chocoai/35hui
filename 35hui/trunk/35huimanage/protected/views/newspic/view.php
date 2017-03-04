<?php
$this->breadcrumbs=array(
	'图片新闻'=>array('index'),
	$model->np_id,
);
$this->currentMenu = 29;
$this->menu=array(
	array('label'=>'查看清单', 'url'=>array('index')),
	array('label'=>'创建图片新闻', 'url'=>array('create')),
	array('label'=>'更新图片新闻', 'url'=>array('update', 'id'=>$model->np_id)),
	array('label'=>'删除图片新闻', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->np_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理所有', 'url'=>array('admin')),
);
?>

<h1>查看 #<?php echo $model->np_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'np_title',
        array(
            'name'=>"np_picurl",
            'type'=>'raw',
            'value'=>CHtml::image(PIC_URL.$model->np_picurl,"",array("width"=>"345px","height"=>"200px")),
        ),
        array(
            'name'=>'np_linkurl',
            'type'=>'raw',
            'value'=>CHtml::link($model->np_linkurl,$model->np_linkurl,array("target"=>"_blank")),
        ),
        array(
            "name"=>"np_type",
            "value"=>Newspic::$pictype[$model->np_type],
        ),
		'np_order',
	),
)); ?>
