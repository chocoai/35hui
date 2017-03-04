<?php
$this->breadcrumbs=array(
	'Buyregions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'列表', 'url'=>array('index')),
	array('label'=>'添加新纪录', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('buyregion-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Buyregions</h1>

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
	'id'=>'buyregion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'br_id',
        array(
            "name"=>"br_regionid",
            "value"=>'Buyregion::model()->getShowRegionName($data->br_regionid)',
        ),
        array(
            "name"=>"br_sourcetype",
            "value"=>'Buyregion::$br_sourcetype[$data->br_sourcetype]',
        ),
        array(
            "name"=>"br_sellorrent",
            "value"=>'Buyregion::$br_sellorrent[$data->br_sellorrent]',
        ),
        array(
            "name"=>"br_buytime",
            "value"=>'date("y-m-d H:i",$data->br_buytime)',
        ),
        array(
            "name"=>"br_expiredate",
            "value"=>'(($data->br_expiredate)/86400)."天"',
        ),
        array(
            "name"=>"br_status",
            "value"=>'Buyregion::$br_status[$data->br_status]',
        ),
		array(
			'class'=>'CButtonColumn',
            'template'=>'{view}'
		),
	),
)); ?>
