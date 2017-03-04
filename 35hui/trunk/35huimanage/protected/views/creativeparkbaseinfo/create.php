<?php
$this->breadcrumbs=array(
	'创意园区'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'管理', 'url'=>array('admin')),
);
?>

<h1>Create Creativeparkbaseinfo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>