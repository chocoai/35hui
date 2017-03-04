<?php
$this->breadcrumbs=array(
	'图片管理'=>array('index'),
    '写字楼图片管理'=>array('officeIndex'),
	$sourceName=>array('sourceView','sId'=>$sId,'sType'=>$sType),
    Picture::$typeDescription[$pType]
);

//$this->menu=array(
//	array('label'=>'List Picture', 'url'=>array('index')),
//	array('label'=>'Create Picture', 'url'=>array('create')),
//	array('label'=>'Update Picture', 'url'=>array('update', 'id'=>$model->p_id)),
//	array('label'=>'Delete Picture', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->p_id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage Picture', 'url'=>array('admin')),
//);
?>
<style type="text/css">
.picshow img {
    height:75px;
    width: 100px;
}
</style>
<h1><?=$sourceName."&nbsp;".Picture::$typeDescription[$pType]."&nbsp;管理"?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'picture-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'p_id',
		array(
          'name'=>'p_sourceid',
          'value'=>'Picture::model()->getSourceName($data->p_sourceid,$data->p_sourcetype)',
          'header'=>'房源名称',
        ),
		array(
          'name'=>'p_sourcetype',
          'value'=>'Picture::$sourceDescription[$data->p_sourcetype]'
        ),
        array(
          'name'=>'p_type',
          'value'=>'Picture::$typeDescription[$data->p_type]'
        ),
        array(
            'name'=>'p_tinyimg',
            'value'=>'PIC_URL.$data->p_tinyimg',
            'type'=>'image',
            'htmlOptions'=>array("class"=>"picshow"),
            'visible'=>true
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
    'htmlOptions'=>array(
        
    )
)); ?>
