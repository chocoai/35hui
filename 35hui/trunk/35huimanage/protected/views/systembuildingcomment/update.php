<?php
$this->breadcrumbs=array(
	'Systembuildingcomments'=>array('index'),
	$model->sbc_id=>array('view','id'=>$model->sbc_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Systembuildingcomment', 'url'=>array('index')),
	array('label'=>'Create Systembuildingcomment', 'url'=>array('create')),
	array('label'=>'View Systembuildingcomment', 'url'=>array('view', 'id'=>$model->sbc_id)),
	array('label'=>'Manage Systembuildingcomment', 'url'=>array('admin')),
);
?>

<h1>Update Systembuildingcomment <?php echo $model->sbc_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>