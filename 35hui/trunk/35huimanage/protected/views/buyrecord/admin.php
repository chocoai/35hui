<?php
$this->breadcrumbs=array(
	'所有购买记录'=>array('index'),
	'管理购买记录',
);

$this->menu=array(
	array('label'=>'所有购买记录', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('buyrecord-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理购买记录</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'buyrecord-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'br_id',
		'br_mrid',
		'br_fcid',
		'br_other',
		'br_amount',
		'br_contractno',
		/*
		'br_time',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
