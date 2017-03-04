<?php
$this->breadcrumbs=array(
	'图片新闻'=>array('index'),
	'管理所有',
);
$this->currentMenu = 29;
$this->menu=array(
	array('label'=>'查看清单', 'url'=>array('index')),
	array('label'=>'创建图片新闻', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('newspic-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理所有</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'newspic-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'np_title',
		'np_linkurl',
		'np_type',
		'np_order',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
