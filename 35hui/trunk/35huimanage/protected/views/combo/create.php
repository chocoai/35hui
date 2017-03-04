<?php
$this->breadcrumbs=array(
	'Combos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'所有等级', 'url'=>array('index')),
	array('label'=>'管理等级', 'url'=>array('admin')),
);
?>

<h1>Create Combo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>