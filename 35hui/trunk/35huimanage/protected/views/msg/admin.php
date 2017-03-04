<?php
$this->breadcrumbs=array(
	'站内信管理'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'查看所有站内信', 'url'=>array('index')),
	array('label'=>'选择用户发送站内信', 'url'=>array('user/index')),
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

<h1>管理站内信</h1>

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
	'id'=>'msg-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'msg_id',
        array(
            'name'=>'msg_sendid',
            'value'=>'User::model()->getUserName($data->msg_sendid)."(".$data->msg_sendid.")"'
        ),
        array(
            'name'=>'msg_revid',
            'value'=>'User::model()->getUserName($data->msg_revid)."(".$data->msg_revid.")"'
        ),
		'msg_title',
		'msg_content',
        array(
            'name'=>'msg_type',
            'value'=>'Msg::$msgTypeDescription[$data->msg_type]."(".$data->msg_type.")"'
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
