<?php
$this->breadcrumbs=array(
	'需求登记'=>array('index'),
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
	$.fn.yiiGridView.update('quickrequire-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>



<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'quickrequire-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'qrq_id',
		'qrq_require',
		'qrq_tel',
		'qrq_name',
		'qrq_email',
		'qrq_check',
		/*
		'qrq_releasedate',
		'qrq_settledate',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view} {delete}',
		),
	),
)); ?>
