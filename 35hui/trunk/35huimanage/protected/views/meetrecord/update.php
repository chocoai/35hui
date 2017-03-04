<?php
$this->breadcrumbs=array(
	'所有面谈记录'=>array('index'),
	$model->mr_id=>array('view','id'=>$model->mr_id),
	'编辑',
);

$this->menu=array(
	array('label'=>'所有面谈记录', 'url'=>array('index')),
	array('label'=>'查看面谈记录', 'url'=>array('view', 'id'=>$model->mr_id)),
	array('label'=>'管理面谈记录', 'url'=>array('admin')),
);
?>

<h1>编辑ID为 <?php echo $model->mr_id; ?>的面谈记录</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>