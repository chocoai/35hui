<?php
$this->breadcrumbs=array(
	'Systembuildinginfos'=>array('index'),
	$model->sbi_buildingid=>array('view','id'=>$model->sbi_buildingid),
	'Update',
);

$this->menu=array(
	array('label'=>'List systembuildinginfo', 'url'=>array('index')),
	array('label'=>'Create systembuildinginfo', 'url'=>array('create')),
	array('label'=>'View systembuildinginfo', 'url'=>array('view', 'id'=>$model->sbi_buildingid)),
	array('label'=>'Manage systembuildinginfo', 'url'=>array('admin')),
);
?>

<h1>Update systembuildinginfo <?php echo $model->sbi_buildingid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>