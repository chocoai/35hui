<?php
$this->breadcrumbs=array(
	'所有跟进记录'=>array('index'),
	$model->fr_id=>array('view','id'=>$model->fr_id),
	'编辑',
);

$this->menu=array(
	array('label'=>'所有跟进记录', 'url'=>array('index')),
	array('label'=>'查看跟进记录', 'url'=>array('view', 'id'=>$model->fr_id)),
	array('label'=>'管理跟进记录', 'url'=>array('admin')),
);
?>

<h1>修改ID为 <?php echo $model->fr_id; ?>的跟进记录</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'contactmodel'=>$contactmodel,'userid'=>$userid,'msgtip'=>$msgtip)); ?>