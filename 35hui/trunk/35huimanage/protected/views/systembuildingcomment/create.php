<?php
$this->breadcrumbs=array(
	'Systembuildingcomments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Systembuildingcomment', 'url'=>array('index')),
	array('label'=>'Manage Systembuildingcomment', 'url'=>array('admin')),
);
?>

<h1>Create Systembuildingcomment</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>