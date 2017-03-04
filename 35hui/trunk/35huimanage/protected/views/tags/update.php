<?php
$this->breadcrumbs=array(
	'Tags'=>array('index'),
	$model->tag_id=>array('view','id'=>$model->tag_id),
	'Update',
);

$this->menu=array(
	array('label'=>'标签列表', 'url'=>array('index')),
	array('label'=>'新建标签', 'url'=>array('create')),
	array('label'=>'查看标签', 'url'=>array('view', 'id'=>$model->tag_id)),
	array('label'=>'管理标签', 'url'=>array('admin')),
);
?>

<h1>Update Tags <?php echo $model->tag_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>