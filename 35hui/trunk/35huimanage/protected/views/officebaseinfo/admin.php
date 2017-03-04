<?php
$this->breadcrumbs=array(
	'Officebaseinfos'=>array('index'),
	'Manage',
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
	$.fn.yiiGridView.update('officebaseinfo-grid', {
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
	'id'=>'officebaseinfo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ob_officeid',
		'ob_sysid',
		'ob_uid',
		'ob_officearea',
		'ob_floortype',
		'ob_adrondegree',
		/*
		'ob_sellorrent',
		'ob_releasedate',
		'ob_updatedate',
		'ob_expiredate',
		'ob_visit',
		'ob_rentprice',
		'ob_monthrentprice',
		'ob_avgprice',
		'ob_sumprice',
		'ob_titlepicurl',
		'ob_ispanorama',
		'ob_check',
		*/
		array(
			'class'=>'CButtonColumn',
            "template"=>"{view}"
		),
	),
)); ?>
