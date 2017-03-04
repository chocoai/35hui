<?php
$this->breadcrumbs=array(
	'Friendlinks'=>array('index'),
	$model->fl_id=>array('view','id'=>$model->fl_id),
	'修改',
);

$this->menu=array(
	array('label'=>'列表', 'url'=>array('index')),
	array('label'=>'增加友情链接', 'url'=>array('create')),
	array('label'=>'查看', 'url'=>array('view', 'id'=>$model->fl_id)),
	array('label'=>'管理', 'url'=>array('admin')),
);
?>

<h1>修改<?php echo $model->fl_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>