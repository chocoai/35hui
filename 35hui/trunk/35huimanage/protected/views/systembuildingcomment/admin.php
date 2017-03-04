<?php
$this->breadcrumbs=array(
	'Systembuildingcomments'=>array('index'),
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
	$.fn.yiiGridView.update('Systembuildingcomment-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>楼盘中心或商业广场评论</h1>

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
	'id'=>'Systembuildingcomment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'sbc_id',
		'sbc_cid',
		'sbc_buildingid',
		'sbc_comment',
		/*
		'sbc_comment',
		'sbc_comdate',
		*/
		array(
			'class'=>'CButtonColumn',
              'template'=>'{view},{delete}'
		),
	),
)); ?>
