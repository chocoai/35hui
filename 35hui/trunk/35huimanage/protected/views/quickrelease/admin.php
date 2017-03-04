<?php
$this->breadcrumbs=array(
	//'Quickreleases'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Quickrelease', 'url'=>array('index')),
	//array('label'=>'Create Quickrelease', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('quickrelease-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>业主委托</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'quickrelease-grid',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'qrl_id',
        array(
            'name'=>'qrl_srtp',
            'value'=>'$data->qrl_srtp==1?"出租":"出售"',
        ),
        array(
            'name'=>'qrl_sysid',
            'value'=>'@$data->buildname->sbi_buildingname',
        ),
		'qrl_floor',
		'qrl_area',
        array(
            'name'=>'qrl_zhuang',
            'value'=>'isset(Officebaseinfo::$adrondegree[$data->qrl_zhuang])?Officebaseinfo::$adrondegree[$data->qrl_zhuang]:""',
        ),
		'qrl_contact',
		'qrl_tel',
		'qrl_remark',
        array(
            'name'=>'qrl_timestamp',
            'value'=>'date("Y-m-d H:i",$data->qrl_timestamp)'
        ),
		array(
			'class'=>'CButtonColumn',
            'template'=>'{check} {delete}',
            'buttons'=>array(
                'check'=>array(
                    'label'=>'通过',
                    'url'  =>'Yii::app()->createUrl("quickrelease/check",array("id"=>$data->qrl_id,"page"=>isset($_GET["page"])?$_GET["page"]:""))',
                    'visible'=>'!$data->qrl_check',
                ),
            ),
		),
	),
)); ?>
