<?php
$this->breadcrumbs=array(
	'公告管理'=>array('index'),
	$model->post_id,
);

$this->menu=array(
	array('label'=>'查看当前有效公告', 'url'=>array('index')),
	array('label'=>'发布公告', 'url'=>array('create')),
);
?>

<h1>修改公告<?php echo $model->post_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>