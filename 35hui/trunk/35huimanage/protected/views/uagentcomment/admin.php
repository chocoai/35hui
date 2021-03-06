<?php
$this->breadcrumbs=array(
	'经纪人评论'=>array('index'),
	'评论管理',
);

$this->menu=array(
	array('label'=>'评论列表', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('Uagentcomment-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>经纪人评论管理</h1>

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
	'id'=>'Uagentcomment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'uac_id',
		'uac_cid',
		'uac_agentid',
		'uac_quality',
		'uac_service',
		'uac_comment',
		/*
		'uac_comdate',
		*/
		array(
			'class'=>'CButtonColumn',
              'template'=>'{view},{delete}'
		),
	),
)); ?>
