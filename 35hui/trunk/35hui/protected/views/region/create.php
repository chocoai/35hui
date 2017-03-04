<?php
$this->breadcrumbs=array(
	'Regions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List region', 'url'=>array('index')),
	array('label'=>'Manage region', 'url'=>array('admin')),
);
?>

<h1>Create region</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>