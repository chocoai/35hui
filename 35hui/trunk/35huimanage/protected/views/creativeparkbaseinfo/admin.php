<?php
$this->breadcrumbs=array(
	'创意园区'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'创建', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('creativeparkbaseinfo-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>创意园区管理</h1>

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
	'id'=>'creativeparkbaseinfo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'cp_id',
		'cp_name',
		'cp_englishname',
		'cp_pinyinshortname',
		'cp_district',
		/*
		'cp_address',
		'cp_avgrentprice',
		'cp_developer',
		'cp_propertyprice',
		'cp_propertyname',
		'cp_openingtime',
		'cp_defanglv',
		'cp_area',
		'cp_fengearea',
		'cp_floorheight',
		'cp_form',
		'cp_introduce',
		'cp_traffic',
		'cp_carport',
		'cp_propertyserver',
		'cp_roommating',
		'cp_peripheral',
		'cp_x',
		'cp_y',
		*/
		array(
			'class'=>'CButtonColumn',
            'template'=>'{view} {update} {delete}<br />{picture} {panorama} {loudong}',
            'buttons'=>array(
                'picture'=>array(
                    'label'=>'图',
                    'url'  =>'Yii::app()->createUrl("picture/sourceView",array("sId"=>$data->cp_id,"sType"=>"9"),array("target"=>"_blank"))',
                ),
                'panorama'=>array(//subpanorama/sourcepanorama/id/470/type/4
                    'label'=>'景',
                    'url'  =>'Yii::app()->createUrl("panorama/buildingView",array("id"=>$data->cp_id,"p_ptype"=>"3"),array("target"=>"_blank"))',
                ),
                'loudong'=>array(
                    'label'=>'楼栋',
                    'url'=>'Yii::app()->createUrl("creativedong/admin",array("cpid"=>$data->cp_id))',
                ),
            ),
		),
	),
)); ?>
