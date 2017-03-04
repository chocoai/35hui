<?php
$this->breadcrumbs=array(
	'创意园区房源信息表'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'查看', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('creativesource-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Creativesources</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'creativesource-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'cr_id',
		'cr_cpid',
		'cr_userid',
		'cr_dongname',
		'cr_floortype',
		'cr_area',
		/*
		'cr_dayrentprice',
		'cr_monthrentprice',
		'cr_ispanorama',
		'cr_titlepicurl',
		'cr_visit',
		'cr_releasedate',
		'cr_updatedate',
		'cr_expiredate',
		'cr_check',
		*/
		array(
			'class'=>'CButtonColumn',
			"template"=>"{view}"
		),
	),
)); ?>
