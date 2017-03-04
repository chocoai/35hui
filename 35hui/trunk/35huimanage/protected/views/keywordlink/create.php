<?php
$this->breadcrumbs=array(
	'Keywordlinks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'关键词列表', 'url'=>array('index')),
	array('label'=>'管理关键词', 'url'=>array('admin')),
);
?>

<h1>Create Keywordlink</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>