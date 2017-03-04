<?php
$this->breadcrumbs=array(
	'Reports'=>array('index'),
	$model->r_id,
);
$this->currentMenu = 50;
$this->menu=array(
	array('label'=>'查看全部', 'url'=>array('index')),
	array('label'=>'删除数据', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->r_id),'confirm'=>'确定删除此信息吗？')),
);
?>
<h1>View Report #<?php echo $model->r_id; ?></h1>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'r_id',
		'r_sinfuluserid',
		'r_sinfulbuildid',
		'r_type',
        array(
            'name'=>'r_type',
            'value'=>Report::$reportmeg[$model->r_type]
        ),
        array(
            'name'=>'r_buildtype',
            'value'=>Report::$buildtype[$model->r_buildtype]
        ),
		'r_informantusername',
		'r_informantip',
		'r_informanttelphone',
		'r_informantemail',
        array(
            'name'=>'r_state',
            'value'=>$model->r_state==1?"已受理":"未受理"
        ),
        array(
            'name'=>'r_date',
            'value'=>date("Y-m-d h:i:s", $model->r_date),
        ),
	),
)); ?>