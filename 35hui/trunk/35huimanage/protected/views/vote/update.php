<?php
$this->breadcrumbs=array(
	'Votes'=>array('index'),
	$model->vt_id=>array('view','id'=>$model->vt_id),
	'Update',
);

$this->menu=array(
	array('label'=>'返回列表', 'url'=>array('index')),
	array('label'=>'新建调查', 'url'=>array('create')),
);
?>

<h1>Update Vote <?php echo $model->vt_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>