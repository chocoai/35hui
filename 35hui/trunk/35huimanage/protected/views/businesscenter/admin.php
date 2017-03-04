<?php
$this->breadcrumbs=array(
	'Businesscenters'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'新建商务中心', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('businesscenter-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Businesscenters</h1>

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
	'id'=>'businesscenter-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'bc_id',
		'bc_name',
		//'bc_pinyinshortname',
		//'bc_pinyinlongname',
		'bc_englishname',
        array(
            'name'=>'bc_sysid',
            'value'=>'@$data->sysbuild->sbi_buildingname',
        ),
		'bc_address',
		'bc_district',
		'bc_floor',
        array(
            'name'=>'bc_completetime',
            'value'=>'date("Y-m-d",$data->bc_completetime)',
        ),
		'bc_rentprice',
		//'bc_serverbrand',
		//'bc_serverlanguage',
		//'bc_decoratestyle',
		//'bc_introduce',
		//'bc_freeserver',
		//'bc_payserver',
		//'bc_traffic',
		//'bc_peripheral',
		'bc_connecttel',
        array(
            'name'=>'bc_releasetime',
            'value'=>'date("Y-m-d H:s",$data->bc_releasetime)',
        ),
		'bc_visit',
		//'bc_titlepic',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{view} {update} {delete}<br />{picture} {panorama}',
            'buttons'=>array(
                'picture'=>array(
                    'label'=>'图',
                    'url'  =>'Yii::app()->createUrl("picture/sourceView",array("sId"=>$data->bc_id,"sType"=>"3"),array("target"=>"_blank"))',
                ),
                'panorama'=>array(//subpanorama/sourcepanorama/id/470/type/4
                    'label'=>'景',
                    'url'  =>'Yii::app()->createUrl("subpanorama/sourcepanorama",array("id"=>$data->bc_id,"type"=>"3"),array("target"=>"_blank"))',
                ),
            ),
		),
	),
)); ?>
