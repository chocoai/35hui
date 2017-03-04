<?php
$this->breadcrumbs=array(
	'Systembuildinginfos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List systembuildinginfo', 'url'=>array('index')),
	array('label'=>'Manage systembuildinginfo', 'url'=>array('admin')),
);
?>

<h1>Create systembuildinginfo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>