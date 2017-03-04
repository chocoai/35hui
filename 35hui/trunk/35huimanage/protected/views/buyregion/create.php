<?php
$this->breadcrumbs=array(
	'Buyregions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'列表', 'url'=>array('index')),
	array('label'=>'管理', 'url'=>array('admin')),
);
?>

<h1>Create Buyregion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>