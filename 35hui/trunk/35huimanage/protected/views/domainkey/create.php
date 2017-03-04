<?php
$this->breadcrumbs=array(
	'Domainkeys'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'列表', 'url'=>array('index')),
	array('label'=>'管理', 'url'=>array('admin')),
);
?>

<h1>Create Domainkey</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>