<?php
$this->breadcrumbs=array(
	'价目列表'=>array('index'),
	'管理价目',
);

$this->menu=array(
	array('label'=>'价目列表', 'url'=>array('index')),
	array('label'=>'新建价目', 'url'=>array('create')),
);

?>

<h1>管理价目</h1>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'fundsconfig-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'fc_id',
		'fc_rmbprice',
		'fc_giveprice',
		'fc_givepoint',
		'fc_givepanoramadevice',
        'fc_vipexp',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
