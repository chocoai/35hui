<?php
$this->breadcrumbs=array(
	'Systembuildinginfos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Systembuildinginfo', 'url'=>array('index')),
	array('label'=>'Create Systembuildinginfo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('systembuildinginfo-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Systembuildinginfos</h1>

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
	'id'=>'systembuildinginfo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'sbi_buildingid',
		'sbi_buildingname',
		'sbi_pinyinshortname',
		'sbi_province',
		'sbi_city',
		'sbi_district',
		/*
		'sbi_section',
		'sbi_loop',
		'sbi_tradecircle',
		'sbi_busway',
		'sbi_address',
		'sbi_foreign',
		'sbi_openingtime',
		'sbi_propertyname',
		'sbi_developer',
		'sbi_berthnum',
		'sbi_rentberth',
		'sbi_propertyprice',
		'sbi_propertydegree',
		'sbi_elevatornum',
		'sbi_fireelevatornum',
		'sbi_buildingarea',
		'sbi_floorarea',
		'sbi_floor',
		'sbi_floordownground',
		'sbi_floorupground',
		'sbi_roomnum',
		'sbi_buildingintroduce',
		'sbi_peripheral',
		'sbi_traffic',
		'sbi_decoration',
		'sbi_floorinformation',
		'sbi_parkinginformation',
		'sbi_otherinformation',
		'sbi_titlepic',
		'sbi_avgrentprice',
		'sbi_avgsellprice',
		'sbi_isnew',
		'sbi_x',
		'sbi_y',
		'sbi_tag',
		'sbi_recordtime',
		'sbi_updatetime',
		'sbi_tel',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
