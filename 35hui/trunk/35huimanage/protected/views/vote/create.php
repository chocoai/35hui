<?php
$this->breadcrumbs=array(
	'Votes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'返回列表', 'url'=>array('index')),
);
?>

<h1>Create Vote</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>