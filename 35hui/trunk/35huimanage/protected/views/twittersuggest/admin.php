<?php 
$this->breadcrumbs=array(
	'Twittersuggests',
	'Manage',
);
$this->currentMenu = 49;
$this->menu=array(
	array('label'=>'所有楼盘微博', 'url'=>array('buildIndex')),
	array('label'=>'所有小区微博', 'url'=>array('communityIndex')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('twittersuggest-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Twittersuggests</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php  echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php
$this->renderPartial('_search',array(
	'model'=>$model,
));
?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'twittersuggest-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ts_id',
		'ts_userid',
		'ts_buildingid',
		'ts_content',
		'ts_suggesttime',
		'ts_type',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}'
		),
	),
)); ?>
