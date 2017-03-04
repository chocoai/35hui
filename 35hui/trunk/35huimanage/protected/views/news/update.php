<?php
$this->breadcrumbs=array(
	'资讯'=>array('index'),
	$model->n_id=>array('view','id'=>$model->n_id),
	'修改',
);
$this->currentMenu = 34;
$this->menu=array(
	array('label'=>'查看清单', 'url'=>array('index')),
	array('label'=>'创建资讯', 'url'=>array('create')),
	array('label'=>'查看资讯', 'url'=>array('view', 'id'=>$model->n_id)),
	array('label'=>'管理资讯', 'url'=>array('admin')),
);
?>

<h1>修改 资讯 <?php echo $model->n_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>