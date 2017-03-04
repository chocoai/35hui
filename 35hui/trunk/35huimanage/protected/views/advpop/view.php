<?php
$this->breadcrumbs=array(
	'Advpops'=>array('index'),
	$model->adp_id,
);

$this->menu=array(
	array('label'=>'List Advpop', 'url'=>array('index')),
	array('label'=>'Create Advpop', 'url'=>array('create')),
	array('label'=>'Update Advpop', 'url'=>array('update', 'id'=>$model->adp_id)),
	array('label'=>'Delete Advpop', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->adp_id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Advpop', 'url'=>array('admin')),
);
?>

<h1>View Advpop #<?php echo $model->adp_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'adp_id',
        array(
            'name'=>'adp_position',
            'value'=>Advpop::$positionConfig[$model->adp_position],
        ),
        array(
            'name'=>'adp_picurl',
            'type'=>'raw',
            'value'=>CHtml::image(PIC_URL.$model->adp_picurl,"",array("width"=>"500px")),
        ),
		'adp_linkurl',
		'adp_title',
        array(
            'name'=>'adp_uploadtime',
            'value'=>date('Y-m-d H:i',$model->adp_uploadtime),
        ),
	),
)); ?>
