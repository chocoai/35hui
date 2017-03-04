<?php
$this->breadcrumbs=array(
    '会员管理'=>array('user/index/'),
	'套餐管理'=>array('showall'),
	'管理套餐信息',
);

$this->menu=array(
	array('label'=>'查看套餐信息', 'url'=>array('showall')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('combolog-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
    
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'combolog-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'cbl_id',
		'cbl_uid',
		'cbl_content',
		'cbl_starttime',
		'cbl_endtime',
        'cbl_muid',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{view} {delete}',
		),
	),
)); ?>
