<?php
$this->breadcrumbs=array(
	'Businesscenters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'管理', 'url'=>array('admin')),
);
?>

<h1>Create Businesscenter</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>