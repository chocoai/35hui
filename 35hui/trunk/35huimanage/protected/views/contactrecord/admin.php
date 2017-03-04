<?php
$this->currentMenu = 77;
$this->breadcrumbs=array(
	'所有联系人'=>array('index'),
	'管理联系人',
);

$this->menu=array(
	array('label'=>'查看所有联系人', 'url'=>array('index')),
	array('label'=>'新建联系人', 'url'=>array('isregister')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('contactrecord-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理小区信息</h1>

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
	'id'=>'contactrecord-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'cr_id',
		'cr_company',
		'cr_realname',
		'cr_salesman',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{delete}'
		),
	),
)); ?>