<?php
$this->breadcrumbs=array(
	'Oprationconfigs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'配置列表', 'url'=>array('index')),
	array('label'=>'新建配置', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('oprationconfig-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>配置管理</h1>


<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'oprationconfig-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ocf_id',
		'ocf_name',
		'ocf_key',
		'ocf_val',
		'ocf_desc',
		array(
			'class'=>'CButtonColumn',
             "template"=>"{view}&nbsp;&nbsp;&nbsp;&nbsp;{update}"
		),
	),
)); ?>
