<?php
$this->breadcrumbs=array(
	'Domainkeys'=>array('index'),
	$model->dk_id,
);
$this->menu=array(
	array('label'=>'列表', 'url'=>array('index')),
	array('label'=>'新建', 'url'=>array('create')),
    array('label'=>'管理', 'url'=>array('admin')),
);
?>

<h1>修改<?php echo $model->dk_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>