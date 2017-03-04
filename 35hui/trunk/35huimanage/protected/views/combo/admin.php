<?php
$this->breadcrumbs=array(
	'Combos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'所有套餐', 'url'=>array('index')),
	array('label'=>'创建套餐', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('combo-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Combos</h1>

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
	'id'=>'combo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'cb_id',
        'cb_name',
		'cb_issuednum',
		'cb_inputnum',
		'cb_refreshnum',
		 array(
            "name"=>"cb_comboprice",
            "value"=>'$data->cb_comboprice."元/月"'
        ),
        array(
            "name"=>"cb_iconurl",
            "type"=>"image",
            "value"=>'MAINHOST.$data->cb_iconurl',
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
