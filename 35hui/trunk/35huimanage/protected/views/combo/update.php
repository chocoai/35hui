<?php
$this->breadcrumbs=array(
	'Combos'=>array('index'),
	$model->cb_id=>array('view','id'=>$model->cb_id),
	'Update',
);

$this->menu=array(
	array('label'=>'所有等级', 'url'=>array('index')),
	array('label'=>'创建等级', 'url'=>array('create')),
	array('label'=>'查看等级', 'url'=>array('view', 'id'=>$model->cb_id)),
	array('label'=>'管理等级', 'url'=>array('admin')),
);
?>

<h1>Update Combo <?php echo $model->cb_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>