<?php
$this->breadcrumbs=array(
	'Examchoices'=>array('index'),
	$model->ec_id=>array('view','id'=>$model->ec_id),
	'Update',
);

$this->menu=array(
	array('label'=>'列表', 'url'=>array('index')),
	array('label'=>'创建题目', 'url'=>array('create')),
	array('label'=>'查看', 'url'=>array('view', 'id'=>$model->ec_id)),
	array('label'=>'管理', 'url'=>array('admin')),
);
?>

<h1>修改考题： <?php echo $model->ec_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>