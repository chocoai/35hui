<?php
$this->breadcrumbs=array(
	'用户充值管理',
);
$this->menu=array(
	array('label'=>'返回所有', 'url'=>array('index')),
);
?>

<h1>用户充值管理</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'arc_id',
		'arc_ordernum',
        'arc_uid',
        array(
            'name'=>'充值金额',
            'value'=>$model->fundsconfig->fc_rmbprice,
        ),
        'arc_alipaynum',
        array(
            'name'=>'arc_rechargetime',
            'value'=>showFormatDateTime($model->arc_rechargetime),
        ),
        array(
            'name'=>'arc_state',
            'value'=>Accountrecharge::$arc_state[$model->arc_state],
        ),
        array(
            'name'=>'arc_releasetime',
            'value'=>showFormatDateTime($model->arc_releasetime),
        ),
	),
)); ?>
