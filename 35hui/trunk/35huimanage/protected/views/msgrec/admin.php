<?php
$this->breadcrumbs=array(
	'意见管理'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'查看所有意见', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('msg-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理意见</h1>

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
	'id'=>'msgrec-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'mr_id',
        array(
            'name'=>'mr_sendid',
            'value'=>'User::model()->getUserName($data->mr_sendid)."(".$data->mr_sendid.")"'
        ),
		'mr_content',
        array(
            'name'=>'mr_time',
            'value'=>'date("Y-m-d",$data->mr_time)."(".$data->mr_time.")"'
        ),
		/*
		'msg_time',
		'msg_senddel',
		'msg_revdel',
		'msg_isread',
		*/
		array(
			'class'=>'CButtonColumn',
            'template'=>'{view}{delete}'
		),
	),
)); ?>
