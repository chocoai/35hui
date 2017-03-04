<?php
$this->breadcrumbs=array(
	'所有记录'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'所有记录', 'url'=>array('index')),
	array('label'=>'新建记录', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('demendcollect-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理记录</h1>

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
	'id'=>'demendcollect-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'dc_id',
		'dc_buildtype',
		'dc_type',
		'dc_buildname',
		'dc_address',
		'dc_area',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
