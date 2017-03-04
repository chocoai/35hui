<?php
$this->breadcrumbs=array(
	'News'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List news', 'url'=>array('index')),
	array('label'=>'Manage news', 'url'=>array('admin')),
);
?>

<h1>Create news</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>