<?php
$this->breadcrumbs=array(
	'所有购买记录'=>array('index'),
	$model->br_id=>array('view','id'=>$model->br_id),
	'修改',
);

$this->menu=array(
	array('label'=>'所有购买记录', 'url'=>array('index')),
	array('label'=>'查看购买记录', 'url'=>array('view', 'id'=>$model->br_id)),
	array('label'=>'管理购买记录', 'url'=>array('admin')),
);
?>

<h1>修改ID为 <?php echo $model->br_id; ?>的购买记录</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>