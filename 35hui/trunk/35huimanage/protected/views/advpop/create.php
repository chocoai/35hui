<?php
$this->breadcrumbs=array(
	'Advpops'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Advpop', 'url'=>array('index')),
);
?>

<h1>Create Advpop</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>