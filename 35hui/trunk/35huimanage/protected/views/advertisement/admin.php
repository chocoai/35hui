<?php
$this->breadcrumbs=array(
	'管理广告图片'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'返回广告首页', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('advertisement-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style type="text/css">
.pic img{
    width: 200px;
}
</style>
<h1>管理广告图片信息</h1>

<p>
你可以在文本框里填入这些对比符号 (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) 去指定你想要找到的值.
</p>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'advertisement-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ad_id',
		'ad_position',
        array(
            'name'=>'ad_picurl',
            'type'=>'image',
            'value'=>'PIC_URL.$data->ad_picurl',
            'htmlOptions'=>array('class'=>'pic')
        ),
        array(
            'name'=>'ad_linkurl',
            'value'=>'urldecode($data->ad_linkurl)',
        ),
		'ad_alt',
        array(
            'name'=>'ad_uploadtime',
            'value'=>'showFormatDateTime($data->ad_uploadtime)'
        ),
		array(
			'class'=>'CButtonColumn',
            'updateButtonUrl'=>'Yii::app()->createUrl("advertisement/update",array("position"=>$data->ad_position))',
            'viewButtonUrl'=>'Yii::app()->createUrl("advertisement/view",array("position"=>$data->ad_position))',
		),
	),
)); ?>
