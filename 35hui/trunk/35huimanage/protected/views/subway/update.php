<?php
$this->breadcrumbs=array(
	'所有站点'=>array('index'),
	$model->sw_id=>array('view','id'=>$model->sw_id),
	'更新',
);

$this->menu=array(
	array('label'=>'所有站点', 'url'=>array('index')),
	array('label'=>'创建站点', 'url'=>array('create')),
	array('label'=>'查看此站点', 'url'=>array('view', 'id'=>$model->sw_id)),
	array('label'=>'管理所有站点', 'url'=>array('admin')),
);
?>

<h1>Update Subway <?php echo $model->sw_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>