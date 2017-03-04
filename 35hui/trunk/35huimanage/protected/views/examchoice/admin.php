<?php
$this->breadcrumbs=array(
	'Examchoices'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'列表', 'url'=>array('index')),
	array('label'=>'新建', 'url'=>array('create')),
    array('label'=>'管理等级描述', 'url'=>array('/examdescribe/admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('examchoice-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Examchoices</h1>

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
	'id'=>'examchoice-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ec_id',
		'ec_question',
		/*
		'ec_answer',
		'ec_type',
		'ec_time',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
