<?php
$this->breadcrumbs=array(
	'Keywordlinks'=>array('index'),
	$model->kdl_id=>array('view','id'=>$model->kdl_id),
	'Update',
);

$this->menu=array(
	array('label'=>'关键词列表', 'url'=>array('index')),
	array('label'=>'新建关键词', 'url'=>array('create')),
	array('label'=>'查看详细', 'url'=>array('view', 'id'=>$model->kdl_id)),
	array('label'=>'管理关键词', 'url'=>array('admin')),
);
?>

<h1>Update Keywordlink <?php echo $model->kdl_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>