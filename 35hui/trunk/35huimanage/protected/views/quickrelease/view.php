<?php
$this->currentMenu = 27;
$this->breadcrumbs=array(
	'快速发布房源信息'=>array('index'),
	$model->qrl_id,
);

$this->menu=array(
	array('label'=>'查看所有快速发布房源信息', 'url'=>array('index')),
	array('label'=>'删除此条信息', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->qrl_id),'confirm'=>'你确定要删除这条信息?')),
	array('label'=>'查看所有快速发布房源信息', 'url'=>array('admin')),
);
?>

<h1>查看快速发布房源信息 Id: #<?php echo $model->qrl_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'qrl_id',
        array(
            'name'=>'qrl_province',
            'value'=>Region::model()->getNameById($model->qrl_province)
        ),
        array(
            'name'=>'qrl_city',
            'value'=>Region::model()->getNameById($model->qrl_city)
        ),
        array(
            'name'=>'qrl_district',
            'value'=>Region::model()->getNameById($model->qrl_district)
        ),
		'qrl_address',
        array(
            'name'=>'qrl_rstype',
            'value'=>Lookup::item('relsrtype',$model->qrl_rstype)
        ),
        array(
            'name'=>'qrl_usetype',
            'value'=>Lookup::item('usetype',$model->qrl_usetype)
        ),
		'qrl_title',
        array(
            'name'=>'qrl_desc',
            'value'=>htmlspecialchars_decode($model->qrl_desc)
        ),
		'qrl_contact',
		'qrl_telephone',
		'qrl_qq',
		'qrl_msn',
        array(
            'name'=>'qrl_releasedate',
            'value'=>showFormatDateTime($model->qrl_releasedate)
        ),
        array(
            'name'=>'qrl_expiredate',
            'value'=>round($model->qrl_expiredate/86400).'天'
        )
	),
)); ?>
