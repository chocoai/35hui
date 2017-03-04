<?php
$this->currentMenu = 62;
$this->breadcrumbs=array(
	'全景资源管理'=>array('index'),
	'管理',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('panorama-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理所有全景资源</h1>

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
	'id'=>'panorama-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'p_id',
		'p_title',
        array(
            'name'=>'p_type',
            'value'=>'@Panorama::$typeDescription[$data->p_type]."(".$data->p_type.")"'
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
